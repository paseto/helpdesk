// show SLA for admin and user ticket add page
function aaJSSLAFetch() {
	
	var gid = $("#category").val();
	var pid = $("#priority").val();
	
	$.ajax({
		url: "ajax/a-ticket-get-sla.php",
		type: "post",
		data: { p_gid : gid, p_pid : pid },
		cache: false,
		success: function(data){
			//alert(data);
			if(data.length > 0) {
				$("#sla").show().html(data);
			} else {
				$("#sla").hide();
			}
		},
		error:function(){
			alert("Failed to get SLA");
		}
	});
	
}
	
$(document).ready(function() {
	
	// popup window change password on user profile page
	$("#chgpwd").click(function(event){
		
		var uid = $("#user_id").val();
		var newpwd = $("#newpwd").val();
		var confirmedpwd = $("#confirmpwd").val();
				
		if (newpwd == "" || confirmedpwd == "") {
			
			$("#pwd_result").html( "<span class='error'>! You must enter your password in both fields.</span>" );
				
		} else if (newpwd != confirmedpwd) {
		
			$("#pwd_result").html( "<span class='error'>! Your new passwords don't match. Try again.</span>" );

		} else if (newpwd.length < 6) {
			
			$("#pwd_result").html( "<span class='error'>! Your new password must be longer than 6 characters.</span>" );
			
		} else {
			
			$.ajax({
				url: "../admin/ajax/a-pwchange.php",
				type: "post",
				data: { user : uid, new_pwd : newpwd },
				cache: false,
				success: function(pwchgdata){
					$("#pwd_result").html( "<div class=\"success\">" + pwchgdata + "</div>" );
					$('#profile_pw_change').trigger("reset");
				},
				error:function(){
					$("#pwd_result").html( pwchgdata );
				}
			});
				
		}
		
		return false;

	});
	

	// open the popup window
	$(".open_popup").click(function(){

	var popup_id = $(this).attr("popup");
			
		$(".overlay, .popup#"+ popup_id).fadeToggle();
		
	});
	
	// close the popup window
	$(".overlay, .close_popup").click(function(){
		
		$( ".overlay" ).hide();
		$( ".popup" ).hide();
			
	})		
	
	
	// change user langauge
	$('#lang').change(function() {

		var lang = $(this).val();
		
			$.ajax({  
				url: "ajax/a-change-lang.php",
				data: {p_lang: lang},
				type: 'POST',  
				cache: false,  
				success: function(data) {		
					
					location.reload();
										
				},
			
			});
		
	});

    $(document).off().on('click', '#Add', function () {
        $(this).attr('readonly', 'readonly');
        $(this).val('Aguarde enquanto enviamos seu chamado...');
    });
	
});		