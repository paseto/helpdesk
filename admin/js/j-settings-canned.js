$(document).ready(function() {
	// canned replies settings page
	
	$(".can_edit").click(function(event) {

		event.preventDefault();
		var $body = $(tinymce.activeEditor.getBody());
		
		canid = $(this).attr("canid");
		cantitle = $(this).attr("cantitle");
		canmsg = $(this).attr("canmsg");

		$("#can_id").val(canid);
		$("#can_title").val(cantitle);
		$body.html($('<span>' + canmsg + '</span>'));
	
	});
		
	// end of canned replies setting page
});