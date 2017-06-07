$(document).ready(function() {
	
	//alert( '123' );
	$('#s_popup').click(function() {
		$('.popup, .overlay').fadeToggle();
	});
	
	$('#s-submit').click(function() {
		
		var name = $('#s_name').val();
		var uname = $('#s_uname').val();

		$.ajax({
			url: "ajax/a-ticket-add-search-user.php",
			type: "post",
			data: { p_name : name, p_uname : uname },
			cache: false,
			success: function(data){
				$('#s_results').html(data);
	
				$('.s-select-user').click(function(event) {
					
					var uid = $(this).attr('s-uid-val');
					var name = $(this).attr('s-fname-val');
					var email = $(this).attr('s-email-val');
					
					//alert (uid + '---' + name + '---' + email);
					$('#ticket-add-fname').val(name).prop('readonly', true);
					$('#ticket-add-email').val(email).prop('readonly', true);
					$('.popup, .overlay').fadeToggle();
					
					event.preventDefault();
					return false;
					
				});
				
			},
			error:function(){
				alert("Failed to search for user");
			}
		});
						
		//$('#s_results').html(name + ' - ' + email + ' - ' + uname);
		return false;
	});
	
	aaJSSLAFetch();
	$("#category, #priority").change(function () {
		
		aaJSSLAFetch();
		
	});
	
});	

// search users on ticket add
			