<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Acorn Aid Live Chat</title>
<link href="aa-chat.css" rel="stylesheet" type="text/css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
html, body {
	margin:0;
	padding:0;
	height:100%;
	background-color:#EEE;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

	function addZero(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}
	
	function gettime() {
	var d = new Date();
	var n = addZero(d.getHours()) + ':' + addZero(d.getMinutes());  
	return n;
	}
	
	function aa_chat_close(vcid, vname) {
		
		$.ajax({  
			url: "aa-chat-close.php",
			data: {p_cid: vcid, p_name: vname},
			type: 'POST',  
			async:false
			
		});

	}
	
	
	// initial volume
	$('#aa-chat-options-volume').html('<i class="fa fa-volume-up"></i> Sound: On');
	
	var wid = $('#widget-id').val(); // chat id from post.php
	var cname = $('#chat-name').val(); // chat name
	
	$('#aa-chat-message #aa-chat-message-scrollable').load("aa-chat-load.php?g_cid=" + wid, function() {
		$('#aa-chat-message #aa-chat-message-scrollable').scrollTop($('#aa-chat-message #aa-chat-message-scrollable').prop('scrollHeight'));
	});	
	
	// check for updates from the agent
	setTimeout(function auto_update() { 
		
		setTimeout(auto_update, 2500); 
				var crid = $('.last_crid').last().val(); // last id from staff-updates.php
				var aachat_status = $('.aa-chat-status').last().val(); 
				//alert(crid)
				$.ajax({  
					url: "aa-chat-staff-updates.php",
					data: {wtid: wid, p_crid: crid},
					type: 'POST',  
					success: function(data) {
						
						if (data.length > 4) {
						
							curtime = gettime();
																																							
							$('#aa-chat-message #aa-chat-message-scrollable').append('<p>' + data + '</p>');
							
							$('.chattime').last().html(curtime);
							$('#aa-chat-message #aa-chat-message-scrollable').scrollTop($('#aa-chat-message #aa-chat-message-scrollable').prop('scrollHeight'));
							
							var volume_status = $('#aa-chat-options-toggle-volume').attr('volume-status');
							if (volume_status == 'on') {						
								$('#chatAudio')[0].play();
							}
						
						}
						
						if (aachat_status == 'Closed') {
							
							$('#aa-chat-reply').attr("disabled","disabled"); 
							
						}
						
					},
				
				});
				
	}, 2000);

	
	// email chat
	$('#aa-chat-options-email').click(function() {
		$.ajax({  
			url: "aa-chat-email.php",
			data: {p_cid: wid},
			type: 'POST',  
			success: function(data) {
				alert("Email sent!" + data);
			},
		
		});

	});
	
	// close button
	$('#aa-chat-options-close').click(function() {
		window.close();
	});


	// turn chat sound on and off
	$('#aa-chat-options-toggle-volume').click(function() {
		var volume_status = $('#aa-chat-options-toggle-volume').attr('volume-status');
		if (volume_status == 'on') {
			$('#aa-chat-options-volume').html('<i class="fa fa-volume-off"></i> Sound: Off');
			$('#aa-chat-options-toggle-volume').attr('volume-status', 'off');	
		} else {
			$('#aa-chat-options-volume').html('<i class="fa fa-volume-up"></i> Sound: On');
			$('#aa-chat-options-toggle-volume').attr('volume-status', 'on');			
		}
	
	});
	
	// before exiting
	window.onbeforeunload = function() {
		
		return 'Are you sure you want to exit chat?';
		
	};
	
	// on exit
	window.onunload = function() {
	
		aa_chat_close(wid, cname);
		
	};

	// post user reply
	$("#aa-chat-reply").keypress(function (e) {
		
		if (e.which == 13) {

			var cureply = $('#aa-chat-reply').val().trim();
			
			if (cureply === "") {
					
				$('#aa-chat-reply').addClass('error');
				$('#aa-chat-reply').focus();
				
			} else {
				$.ajax({  
					url: "aa-chat-post-u-reply.php",
					data: {p_cid: wid, p_cname: cname, p_cureply: cureply},
					type: 'POST',  
					cache: false, 
					async: false,
					success: function(data) {
						
						curtime = gettime();
							
						$('#aa-chat-message #aa-chat-message-scrollable').append('<p>' + data + '</p>');
						
						$('.chattime').last().html(curtime);
												
						$('#aa-chat-message #aa-chat-message-scrollable').scrollTop($('#aa-chat-message #aa-chat-message-scrollable').prop('scrollHeight'));
						
						$('#aa-chat-reply').removeClass('error').val('');
						$('#aa-chat-reply').focus();
					},
				
				});

			}
			
			// ensure form stays open
			return false;
			
		}
	
	});
	
});
</script>
</head>

<body>

<?php
session_start();
// include db info
require_once "../lib/db.php";
require_once "../lib/global.php";
require '../public/language/english.php';

$pdo_conn = pdo_conn();
?>


<audio id="chatAudio">
<source src="ting.ogg" type="audio/ogg">
<source src="ting.mp3" type="audio/mpeg">
</audio>

<div id="aa-chat">
<input type="hidden" class="last_crid" value="1" /> <!-- default value for crid to begin variable -->
<table>
<tr><td class="aa-chat-table-td" id="aa-chat-header"><?php echo get_settings('Company_Name'); ?></td></tr>
<tr>
    <td class="aa-chat-table-td" id="aa-chat-options">
    	<a id="aa-chat-options-email" href="#"><i class="fa fa-envelope"></i> <?php echo $lang['u-aachat-email']; ?></a> | 
        <a id="aa-chat-options-toggle-volume" volume-status="on" href="#"><span id="aa-chat-options-volume"></span></a>  | 
        <a id="aa-chat-options-close" href="#"><i class="fa fa-times"></i>  <?php echo $lang['u-aachat-close']; ?></a>
    </td>
</tr>
<tr>
    <td id="aa-chat-message">

        <div id="aa-chat-message-scrollable">
        </div>

    </td>
</tr>
<tr>
    <td class="aa-chat-table-td" id="aa-chat-form">
    <input type="hidden" id="widget-id" name="widget-id" value="<?php echo $_SESSION["aachat-id"]; ?>" />
    <input type="hidden" id="chat-name" name="chat-name" value="<?php echo $_SESSION["aachat-name"]; ?>" />    
    <textarea id="aa-chat-reply"></textarea>
    </td>
</tr>
</table>
</div>

</body>
</html>
<?php
ob_end_flush();
?>