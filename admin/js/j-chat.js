$(document).ready(function() {

	var cid = $('#tid').attr('tid');
	var uid = $('#tid').attr('uid');

	// set collision on
	$.ajax({  
		url: "ajax/a-ticket-collision-on.php",
		data: {p_tid: cid, p_uid: uid},
		type: 'POST',  
		cache: false,
		async:false, 
		success: function(data) {		
			
			if (data != "") { // if error because another person already looking
				
				// disable all functionality with ticket page
				$("#aa_ticket_error, #aachat-accept, #aachat-done").hide();
				// display block error
				$("#aa_collision").css("display","block");
				// prepend langauge file with data from call
				$("#aa_collision .pad10").prepend(data);
				
			}
								
		},
	});
	
	// set collision off	
	window.onunload = function () {
		$.ajax({  
			url: "ajax/a-ticket-collision-off.php",
			data: {p_tid: cid, p_uid: uid},
			type: 'POST',  
			async:false //async false fixed safari issue
		});
	}
	
	
	// accept chat
	$("#aachat-accept").click(function() {
	
	var tid = $('#tid').attr('tid');
	var uid = $('#tid').attr('uid');
			
		$.ajax({  
			url: "ajax/a-chat-accept.php",
			data: {p_tid: tid, p_uid: uid},
			type: 'POST',  
			cache: false,  
			success: function(data) {		
				
				location.reload();
									
			},
		
		});
			
	});	
	
	// agent close chat
	$("#aachat-done").click(function() {

	var cid = $('#tid').attr('tid');
	var uid = $('#tid').attr('uid');

		$.ajax({  
			url: "ajax/a-chat-closed.php",
			data: {p_cid: cid, p_uid: uid},
			type: 'POST',  
			cache: false,  
			success: function(data) {		
				
				location.reload();
									
			},
		
		});
		
	});	


	// get chat updates
	function aachat_get_updates () {
		var crid = $('.last_crid').last().val(); // last id from staff-updates.php
		$.ajax({  
		url: "ajax/a-chat-updates.php",
		data: {p_cid: cid, p_crid: crid},
		type: 'POST',  
		async: true,
		success: function(data) {
		
			if (data.length > 4) {
																																											
				$('#aa-chat-message').append('<p>' + data + '</p>');
				$('#aa-chat-message').scrollTop($('#aa-chat-message').prop('scrollHeight'));
				
				var aachat_user = $(".aachat_user").last().val();
				
				// if update is from user then play sound
				if (!$.isNumeric(aachat_user)) { 
					$('#chatAudio')[0].play();
				}
				// check ticket status
				var aachat_status = $(".aachat_status").last().val();
				if (aachat_status == "Closed") {
					
					$('#chat_reply').attr("disabled","disabled"); 
					$("#table_generic").html("");
					
				}
				
				
		
			}
			
		},
		
		});
	}
	
	//$("#aa_chats").load('aa-chats.php');	

	$("#aa-chat-message").load("ajax/a-chat-load.php?g_cid=" + cid, function() {
	$('#aa-chat-message').scrollTop($('#aa-chat-message').prop('scrollHeight'));
	});
	
	
	//check for updates from the agent
	setTimeout(function aa_chat_auto_update() { 
		
		setTimeout(aa_chat_auto_update, 1500); 
				
				aachat_get_updates();
				
	}, 1500);
	
	
	// on chat return / enter
	$("#chat_reply").keypress(function (e) {

		var running = false;

		if (e.which == 13) {
										
				var cureply = $('#chat_reply').val().trim();
	
				if (cureply === "") {
						
					$('#chat_reply').addClass('error_form');
					$('#chat_reply').focus();
					
				} else {
					
					$.ajax({  
						url: "ajax/a-chat-post.php",
						data: {p_cid: cid, p_uid: uid, p_cureply: cureply},
						type: 'POST',  
						cache: false, 
						async: true, 
						success: function(data) {
														
							aachat_get_updates(); // call function to get instant post
							$('#aa-chat-message').scrollTop($('#aa-chat-message').prop('scrollHeight'));
							
							// clear reply field and focus
							$('#chat_reply').removeClass('error').val('');
							$('#chat_reply').focus();
							
						},
						error: function() {
							alert('broken');
						},
					
					});
	
				}
				return false;
			  		
		} // end if enter pressed

	});
	
	
});