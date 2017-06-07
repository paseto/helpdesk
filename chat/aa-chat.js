// JavaScript Document
(function() {

// Localize jQuery variable
var jQuery;

/******** Load jQuery if not present *********/
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js");
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else {
      script_tag.onload = scriptLoadHandler;
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
} else {
    // The jQuery version on the window is the one we want to use
    jQuery = window.jQuery;
    main();
}

/******** Called once jQuery has loaded ******/
function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
    jQuery = window.jQuery.noConflict(true);
    // Call our main function
    main(); 
}

function validateEmail(sEmail) {
	var filter = /^[\w-.+]+@[a-zA-Z0-9.-]+.[a-zA-z0-9]{2,4}$/;
	if (filter.test(sEmail)) {
		return true;
	} else {
		return false;
	}
}

/******** Our main function ********/
function main() { 
    jQuery(document).ready(function($) { 
        /******* Load CSS *******/
        var css_link = $("<link>", { 
            rel: "stylesheet", 
            type: "text/css", 
            href: "aa-chat.css" 
        });
        css_link.appendTo('head');   
		
		// load html for widget from widget.html
        $('#aa-widget').load('aa-chat-inc.php', function() {
			
			$('#form').hide();
			
			// on clicking help or banner close
			$('#example-widget-container, #form-close').click(function() {
				
				if ($('#form').is(':visible')) {
				
					$('#form').slideToggle();

				} else {
					
					$('#form').slideToggle();
					// clear errors on minimise of widget
					$('#widget-name,#widget-email,#widget-subject,#widget-msg').removeClass('error');

				}
				
			});
			
			$("#aa-widget-close").click(function() {
				
				$('#form').slideToggle();				
				
			});
			
			// function to send widget data	
			$('#aa-widget-form').submit(function (e) {
				
				var error;
				var wstatus = $('#aa-chat-status').val();
				var wname = $('#widget-name').val();
				var wemail = $('#widget-email').val();
				var wsubject = $('#widget-subject').val();
				var wmsg = $('#widget-msg').val();
		
				if (wname === "") {
					$('#widget-name').addClass('error');
					error = true;		
				} else {
					$('#widget-name').removeClass('error');
				}	
				
				if (wemail === "") {
					$('#widget-email').addClass('error');
					error = true;
				/*} else if (!validateEmail(wemail)) {
					$('#widget-email').addClass('error');
					error = true; */
				} else {
					$('#widget-email').removeClass('error');
				}	
				
				if (wsubject === "") {
					$('#widget-subject').addClass('error');
					error = true;		
				} else  {
					$('#widget-subject').removeClass('error');
				}	
				
				if (wmsg === "") {
					$('#widget-msg').addClass('error');
					error = true;
				} else {
					$('#widget-msg').removeClass('error');
				}
				
				// if any errors stop form action
				if (error) {
					e.preventDefault();
				}
				
				if (!error) {
					
					// if offline post
					if (wstatus == 'offline') {

						e.preventDefault();
						$.ajax({  
							url: "aa-chat-offline-post.php",
							data: {w_name: wname, w_email: wemail, w_subject: wsubject, w_msg: wmsg},
							type: 'post',  
							cache: false,  
							success: function(data) {
															
								$('.form-inner').html(data);
							
							},
							error:function(){
								
								alert ( "Failed to post data" );
							
							}
						
						}); // end ajax post

					// if online	
					} else {
					
						// date and time for unique popup windows for multiple chats
						var d = new Date();
						var n = d.getTime();  
						
						function popupwindow(url, title, w, h) {
							var left = (screen.width/2)-(w/2);
							var top = (screen.height/2)-(h/2);
							
							var Popup = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
							Popup.focus();
													
						}
						// open popup. use action of form as url for popup
						popupwindow('', 'Chat', '500', '600');
						
						// send form values to 
						this.target = 'Chat';
												
						// if you want to close widget and clear form fields remove forward slashes below
						// location.reload();
						
					} // end if online or offline 
					
				} // end if no error
		
			}); // end widget send button function
			

		});


	});
}

})();