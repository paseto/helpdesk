$(document).ready(function() {
	// custom fields page functions	
	
	function show_options () {
		
		var type = $("#custom_type").val();
		
		if (type == "Text" || type == "Textbox") {
			
			$("#custom_options").hide();
			$("#custom_maxlen").show();
			
		} else if (type == "Select" || type == "Radio" || type == "Checkbox") {

			$("#custom_maxlen").hide();
			$("#custom_maxlen_input").val("0");
			$("#custom_options").show();		
		}
		
	}

	show_options();
	
	// on changing field type
	$("#custom_type").change(function(event) {
											
		event.preventDefault();	
		show_options();
	});
	
	
	$(".delete_field").click(function() {
	var dialogue_text = $('#Delete_Text').val();
	var status = confirm(dialogue_text);
		if(status == false){
			return false;
		} else {
			location.reload();
		}
	});

// end of custom fields page
});