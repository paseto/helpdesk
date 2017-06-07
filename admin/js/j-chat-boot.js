// check chats for new or pending
function aa_chats(){
		
	
		$.ajax({ 
			url: "ajax/a-chats.php",
			type: "POST",
			cache: false,	
			success: function(chatdata){
				
				$("#livechat, #aa_chats").html(chatdata); // set html to header and aachats sidebar on page.chat

				// turn online or offline
				$(".aa-chat-toggle").click(function() {
			
					var aachat_status = $(this).attr("status");
					
					$.ajax({  
						url: "ajax/a-chat-status-toggle.php",
						type: 'POST',  
						data: {p_status: aachat_status},
						cache: false,
						success: function(data) {	
							$(this).addClass('offline');
							location.reload();
						},
					
					});
					
				});
					
				// set icon color if online or offline
				var aachat_agent_status = $("#aachat-agent-status").val();
				if (aachat_agent_status < 1) {
					$(".navigation-chat .fa").css("color", "red");
				} else {
					$(".navigation-chat .fa").css("color", "#78c846");
				}
				
				var aachat_newchats_no = $("#aachat-new-status").val(); // no of new chats in hidden input
				var aachat_newchats_values = $("#aa-chat-new-values").html(); // new chats html
				var aachat_newchats_new = localStorage.getItem('aachat_newalerts'); // get localstorage of new chats

				var aachat_pendingchats_no = $("#aachat-pending-status").val(); // no of pending chat messages in hidden input
				
				if (aachat_newchats_no > 0) {
					
					// blink page title for new messages
					setTimeout(function(){
						var title = document.title;
						document.title = (title == "Acorn Aid Admin" ? "New chat message" : "Acorn Aid Admin");
					}, 250);
					
					// show red notification box for new chat
					$("#aachat_notification").css("display","block").html(aachat_newchats_no);
					
					// play new chat sound if number of new chats is greater than 1
					if (aachat_newchats_values != aachat_newchats_new) {
						$('#alertAudio')[0].play();
						localStorage.setItem('aachat_newalerts', aachat_newchats_values); // set localstorage for new chats
					}
					
				} else if (aachat_pendingchats_no >= 1) {
					$("#aachat_notification").css("display","block").html(aachat_pendingchats_no);
				} else { // if pending chat messages is zero then hide notification box
					$("#aachat_notification").css("display","none");
				}
				
				
			},
			error: function(err) {
				$("#livechat").html(err);
			}
		});
 // time equal to timeout between vistor and agent
	
}

$(document).ready(function() {
	//alert("Chat ON")
	aa_chats();
	timer = setInterval(function(){
		aa_chats();
	}, 5000);	
});