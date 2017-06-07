$(document).ready(function() {

	var tid = $('#tid').attr('tid');
	var uid = $('#tid').attr('uid');
	// turn collision detection on
	$.ajax({  
		url: "ajax/a-ticket-collision-on.php",
		data: {p_tid: tid, p_uid: uid},
		type: 'POST',  
		cache: false,
		async:false, 
		success: function(data) {		

			if (data != "") { // if error because another person already looking
				
				// disable editable content
				$(".editable").attr("contenteditable", "false");
				// disable all functionality with ticket page
				$("#form_background, #aa_ticket_error,  .collision_disable, .click_editable, .click_delete, #accept, #merge, #delete").hide();
				// display block error
				$("#aa_collision").css("display","block");
				// prepend langauge file with data from call
				$("#aa_collision").prepend(data);
								
			}
								
		},
	});
	// turn collision detection off
	window.onunload = function () {		
		$.ajax({  
			url: "ajax/a-ticket-collision-off.php",
			data: {p_tid: tid, p_uid: uid},
			type: 'POST',  
			async:false //async false fixed safari issue					
		});
	}
	
	// functions on ticket page
	// on clicking accept ticket	
	$("#accept").click(function() {
	
		var tid = $('#tid').attr('tid');
		var uid = $('#tid').attr('uid');
			
		$.ajax({  
			url: "ajax/a-ticket-accept.php",
			data: {p_tid: tid, p_uid: uid},
			type: 'POST',  
			cache: false,  
			success: function(data) {		
				
				location.reload();
									
			},
		
		});
			
	});	
	
	// on clicking on trash can
	$("#delete").click(function() {
		
		if (confirm('Are you sure you want to delete this ticket?')) {
			var tid = $('#tid').attr('tid');
			var filefolder = $('#tid').attr('filefolder');
			
				$.ajax({  
					url: "ajax/a-ticket-delete.php",
					data: {p_tid: tid, p_filefolder: filefolder},
					type: 'post',  
					cache: false,  
					success: function(data) {
						window.location.href = 'p.php?p=tickets';
					},
					error:function(){
						alert ( "Failed to delete ticket" );
					}
				
				});
		
		}

	});
	
	// clear eidtable content local storage each time the ticket page loads.
	localStorage.removeItem("aa_editbefore");
	// on clicking the pencil to edit
	$(".click_editable").click(function() {

		var closet = $(this).nextAll(".editable:first");
		// allow editable content to be ediatable. E.g. allow clcik of links
		closet.attr("contenteditable","true");		
		closet.focus();
		return false;
		
	});
			
	
	//  on editting ticket
	$(".editable").focus(function() {
		var editbefore = $(this).html();
		localStorage.setItem('aa_editbefore', editbefore);	
	});


	// on exiting editting ticket
	$(".editable").focusout(function() {

		var tid = $(this).attr("tid");
		var type = $(this).attr("type");

		var editbefore = localStorage.getItem('aa_editbefore');
		var editafter = $(this).html();

		if (editbefore != null) {

			if (editbefore !== editafter) {
				
				var saveeidt = confirm("Save changes?");
				
				if(saveeidt == false){
					
					$(this).html(editbefore); // revert text back to before
					
				} else {
					
					$.ajax({  
						url: "ajax/a-ticket-edit.php",
						data: {p_tid: tid, p_type: type, p_edit: editafter},
						type: 'POST',  
						cache: false,
						error: function(data) {		
							alert("Failed to save edit");
						},
					
					});
					
				}
			
			}
		
		}
		
		// set content editable to be false
		$(this).attr("contenteditable","false");	
				
	});	
	

	// on deleting a single post
	$(".click_delete").click(function() {
									  
		if (confirm('Are you sure you want to delete this ticket update?')) {
			var tuid = $(this).attr("tid");
	
			$.ajax({  
				url: "ajax/a-ticket-update-delete.php",
				data: {p_tuid: tuid},
				type: 'POST',  
				cache: false,
				success: function(data) {		
					$("#"+tuid).fadeOut();
				},
			
			});
			return false;
		}

	});
	
	// placeholder for canned replies dropdown
	$("#can_reply").select2({
		placeholder: "Select canned reply"
	});

	// paste canned message into reply box
	$( "#can_reply" ).change(function() {
	
		var canmsg = $(this).val();
		
		var $body = $(tinymce.activeEditor.getBody());
		
		$body.append($('<span>' + canmsg + '</span>'));

	});
	
	// show / hide forward toggle
	$("#aa_forward_to").hide();
	$("#aa_forward_toggle").click(function () {
		$("#aa_forward_to").toggle();
		return false;
	});
	
	$('#m_popup').click(function() {
		$('.popup, .overlay').fadeToggle();
	});
	
	// on ticket search
	$("#merge_search").click(function(event){
		var merge_input = $("#merge_input").val();
		var tid = $('#tid').attr('tid');
		tid = tid*1; // strip leading zeros off by * by 1.

		if (tid == merge_input) {
			
			$("#merge_results").html( "<div id=inner_merge_results>Ticket cannot be joined to itself</div>" );
			
		} else {
			
			$.ajax({
				url: "ajax/a-merge-results.php",
				type: "post",
				data: { from_tid : tid, merge_data : merge_input },
				cache: false,
				success: function(mergedata){
					$("#merge_results").html( mergedata );
					
					// complete merge once ticket is found
					$("#complete_merge").click(function() {

						var merge_from_tid = $("#merge_from_tid").val();
						var merge_tid = $("#merge_tid").val();
						var merge_from_user = $("#merge_from_user").val();
						var merge_from_message = $("#merge_from_message").val();
						var merge_from_dateadd = $("#merge_from_dateadd").val();
						var merge_from_files = $("#merge_from_files").val();
						
						//alert ( merge_from_tid + ' ' + merge_tid + ' ' + merge_from_user + ' ' + merge_from_subject + ' ' + merge_from_dateadd + ' ' + merge_from_files );
						$.ajax({
							url: "ajax/a-merge-complete.php",
							type: "post",
							data: { mergefromtid : merge_from_tid, 
									mergetid : merge_tid, 
									mergefromuser : merge_from_user, 
									mergefrommessage : merge_from_message, 
									mergefromdateadded : merge_from_dateadd,
									mergefromfiles : merge_from_files },
							cache: false,
							success: function(completedata){
								window.location.href = 'p.php?p=ticket&tid=' + merge_tid;
								},
							error:function(){
								alert ( "Failed to complete merge" );
							}
						});

						return false;
						
					});					
					
				},
				error:function(){
					$("#merge_results").html( "Search failed" );
				}
			});
			
		}
		// prevent popup from closing
		return false;

	});	
	// end ticket page functions	
	

});