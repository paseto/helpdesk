$(document).ready(function() {
	
	// user ticket rating
	$( "#rating li" ).click(function() {
	
		var rating_value = $(this).attr("rval");
		var tid = $("#ticket_values").attr("ticket_id");
		var uid = $("#ticket_values").attr("user_id");
		
		//alert (rating_value + ' ' + tid + ' ' + uid);
		
			$.ajax({
				url: "ajax/a-ticket-rate.php",
				type: "post",
				data: {rating: rating_value, ticket_id: tid, ticket_user: uid},
				cache: false,
				success: function(data){
					// refresh page
					window.location.reload();
				},
				error:function(){
					alert("Failed to rate ticket");
				}
			});
	
	});
	

	// show ticket detail for mobile view	
	$('#u-show-ticket-detail').click(function() {
	
		$('.u-ticket-detail').toggle();
	
	});

	$(document).on('click', '#user_submit', function () {
		// $(this).attr('disabled','disabled');
		$(this).val('Aguarde...');
		// $(this).submit();
	});
	
});	