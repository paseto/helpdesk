function set_sidebar_heights() {
	// read window height and set navigation menus to equal heights
	var current_window_height = $( document ).outerHeight();
	var screen_height = $( window ).height();
	//$("#layout-body-left").height(screen_height - 60);
	$("#layout-body-right").css('min-height', current_window_height); // remove 100px for 50px on top header + 25px x 2 padding
	$(".navigation-menu").height(screen_height - 35); // remove 50px for top header
	// hide all navigation menus
	$(".navigation-menu, .navigation-box").hide();

}

// start document ready
$(document).ready(function() {		

	function viewport_control() {
		if ($("#layout-body-left").length == 0) {
			
			$(".navigation-mobile-links").hide();
		}		
	}

	// run on page load
	// show/hide mobile links
	viewport_control();
	
	// set height of sidebars for desktop and mobile
	set_sidebar_heights()
	 		 
	// show navigation menus if toggle link clicked
	$(".navigation-toggle").click(function() {
		var panel = $(this).attr("panel");
		var dir = $(this).attr("dir");
			
		// close all other panels
		$(".panel").not("#" + panel).hide();
		
		if (dir == 'up') {
			var thispos = $(this).position().left;
			var thiswidth = $(this).width();
			var posright = thispos + thiswidth;
			var panelwidth = $("#" + panel).outerWidth();	
			$("#" + panel).css({ left: (posright - panelwidth) + "px" } ).toggle("slide", {direction: dir }, 500);		
		} else {
			$("#" + panel).toggle("slide", {direction: dir }, 500);		
		}
		
		return false;
	});
	
	// on window resize rerun viewport control
    var width = $(window).width();
    $(window).resize(function(){
        if($(window).width() != width) {
            
			viewport_control();
            width = $(window).width();
        }
    });
	
		
	// enable and disable inputs on tick box  **COMMON ON SETTINGS TICKETS AND SETTINGS OEMAIL**
	$("#input_enable").click(function() {
		$(".dis-enl-input").prop("disabled", !$(".dis-enl-input").prop("disabled"));
    });
	
	if ($("#input_enable").is(':checked')) {
		$(".dis-enl-input").prop("disabled", false);
    } else {
		$(".dis-enl-input").prop("disabled", true);
	}
	// end of input enable/disable
	
	// user add page and edit page in admin **COMMON FUNCTION**
	function user_role_option() {
		if ($('#user-add-role').val() != 0) {
			$('#user-options').show();
		} else {
			$('input:checkbox').prop('checked', false);					
			$('#user-options').hide();
		}
	}
	user_role_option();
	$('#user-add-role').change(function() {
		user_role_option();
	});
	// end user add page in admin
	
	// tickets page
	// set select2 to select boxes in tickets and ticket
	$("#filter_date,#filter_status,#filter_group,#filter_slar_due,#filter_slaf_due,#chg_status,#chg_cat,#chg_priority,#chg_owner,#ticket_view, .ticket-add-select").select2({
			containerCssClass: "select2-border",	
	});	
	
	// submit quick search form
	$("#search_quick").submit(function(qs) {

		qs.preventDefault();
		
		var qs_input = $("#form-aa-search").val();
		
		if (!qs_input) {
			
			$("#form-aa-search").css({ "border": "1px solid #FF0000" });
			$("#form-aa-search").focus();
			
		} else {
			
			window.open( "p.php?p=search&search=" + qs_input, "_self" );
		
		}
		
	});
	// end search function

	
});
	
