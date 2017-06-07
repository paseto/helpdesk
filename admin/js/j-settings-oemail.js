$(document).ready(function() {
	// outbound email settings page
	
	// smtp options
	$("#smtp_options").hide();
	
	// for page load
	if ($("#input_smtp").is(':checked')) {
			
		$("#smtp_options").show();
	
	}
	// toggle smtp options
	$("#input_phpmail").click(function() {
		$("#smtp_options").hide();								
	});
	$("#input_smtp").click(function() {
		$("#smtp_options").fadeIn();								
	});
	
	// outbound email setting page
});