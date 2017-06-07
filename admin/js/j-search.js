$(document).ready(function() {
	
	$( ".ticket" ).click(function() {
	
		var tid = this.id;			
		window.open( "p.php?p=ticket&tid=" + tid, "_self" );
	
	});
			
	// date picker
	$(function() {
		
		$( "#adv_s_dateadd_from" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#adv_s_dateadd_to" ).datepicker( "option", "minDate", selectedDate );
		}
		});
		
		$( "#adv_s_dateadd_to" ).datepicker({
		dateFormat: "yy-mm-dd",	
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#adv_s_dateadd_from" ).datepicker( "option", "maxDate", selectedDate );
		}
		});
		
		$( "#adv_s_dateup_from" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#adv_s_dateup_to" ).datepicker( "option", "minDate", selectedDate );
		}
		});
		
		$( "#adv_s_dateup_to" ).datepicker({
		dateFormat: "yy-mm-dd",	
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#adv_s_dateup_from" ).datepicker( "option", "maxDate", selectedDate );
		}
		});	
	
		$( "#adv_s_dateclosed_from" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#adv_s_dateclosed_to" ).datepicker( "option", "minDate", selectedDate );
		}
		});
		
		$( "#adv_s_dateclosed_to" ).datepicker({
		dateFormat: "yy-mm-dd",	
		changeMonth: true,
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
		$( "#adv_s_dateclosed_from" ).datepicker( "option", "maxDate", selectedDate );
		}
		});	
	
	});
	
	// value of each search criteria to be used in result string
	var search_vals = {};
	search_vals["ID"] = $("#adv_s_tid").val();
	search_vals["Subject"] = $("#adv_s_subject").val();
	search_vals["Message"] = $("#adv_s_msg").val();
	search_vals["Customer"] = $("#adv_s_cust").val();
	
	search_vals["Group"] = $("#adv_s_group option:selected").text();
	search_vals["Status"] = $("#adv_s_status option:selected").text();
	search_vals["Priority"] = $("#adv_s_priority option:selected").text();
	search_vals["Owner"] = $("#adv_s_owner option:selected").text();
	
	search_vals["Date Added From"] = $("#adv_s_dateadd_from").val();
	search_vals["Date Added To"] = $("#adv_s_dateadd_to").val();
	search_vals["Date Updated From"] = $("#adv_s_dateup_from").val();
	search_vals["Date Updated To"] = $("#adv_s_dateup_to").val();
	search_vals["Date Closed From"] = $("#adv_s_dateclosed_from").val();
	search_vals["Date Closed To"] = $("#adv_s_dateclosed_to").val();
	
	var blkstr = $.map(search_vals, function(val,index) {
		if (val) {                    
		 var str = "<b>" + index + "</b>" + ": " + val;
		}
		 return str;
		
	}).join(", "); 
	
	$("#search_criterea").html( blkstr);
	// end search page results

});				