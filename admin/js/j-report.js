$(document).ready(function() {
	// functions on report page
	
	// set tr as hidden
	if ($("#report_set_period option:selected").val() == 'custom') {
		$("#report_custom_dates").show();
	} else {
		$("#report_custom_dates").hide();
	}
	
	function aa_report_type() {
		var rtype = $("#report_type").val();
		if (rtype !== 'ticket_summary' && rtype != 'time_spent') {
			$("#report_groupby_div").hide();
		} else {
			$("#report_groupby_div").show();
		}
	}
	
	aa_report_type();
	// show and hide group by option
	$('#report_type').change(function(){
		aa_report_type();
	});
	
	// show and hide custom date fields
	$('#report_set_period').change(function(){
	
		if($(this).val() == 'custom'){ // or this.value == 'volvo'
		
			$("#report_custom_dates").show();
		
		} else {
		
			$("#report_custom_dates").hide();
		
		}
	
	});
	
	// date picker
	$(function() {
		
		$( "#rep_period_from" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#rep_period_to" ).datepicker( "option", "minDate", selectedDate );
		}
		});
		
		$( "#rep_period_to" ).datepicker({
		dateFormat: "yy-mm-dd",	
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#rep_period_from" ).datepicker( "option", "maxDate", selectedDate );
		}
		});
	
	});
	
	// end of functions on report page		
});