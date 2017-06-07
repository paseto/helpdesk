function aa_dashboard_summary() {

	///timer = setInterval(function(){
	var dashboard_date_range = $("#dashboard-group-summary-date").val();
	//alert(dashboard_date_range );			
		$.ajax({ 
			url: "ajax/a-dashboard-summary.php",
			type: "POST",
			data: { 'p_date_range' : dashboard_date_range },
			cache: false,	
			async: false,
			success: function(data){
				
				$("#dashboardsum").html(data);
				
				aa_dashboard_summary_filter()
				
			},
			error: function(err) {
				$("#dashboardsum").html(err);
			}
		});
	//}, 5000);
	
}

function aa_dashboard_summary_filter() {
$( ".summary_block" ).click(function() {

	var group = $(this).attr("group");
	var status = $(this).attr("status");
			
	//alert (status + ' - ' + group);
	
	$.ajax({
		url: "ajax/a-dashboard-push-filter.php",
		type: "post",
		data: { 'p_group' : group, 'p_status' : status },
		cache: false,
		async: false,
		success: function(data){
			//alert("Success" + data);
			window.location.href = 'p.php?p=tickets';
		},
		error:function(){
			alert("Failed to redirected to tickets page");
		}
	});

});
}

$(document).ready(function() {

	// Long polling for dashboard summary count
	$("#dashboardsum").load('ajax/a-dashboard-summary.php', function() {
		
		aa_dashboard_summary_filter();
	
	});
	
	aa_dashboard_summary();
	
	$("#dashboard-group-summary-date").change(function() {
		aa_dashboard_summary();	
	});

	// initially run show activity log
	$(".recent-activity").load('ajax/a-dashboard-activity.php?startIndex=0&offset=11&randval='+ Math.random());
	
	// refresh activity log
	var refreshId = setInterval(function() {
		$(".recent-activity").load('ajax/a-dashboard-activity.php?startIndex=0&offset=' + sIndex + '&randval='+ Math.random());
		}, 5000);
	
	$.ajaxSetup({ cache: false });
	
	// load more of the activity activity log
	var sIndex = 11, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
	
	$("#load-more").click(function() {
	  if (isPreviousEventComplete && isDataAvailable) {
	   
		isPreviousEventComplete = false;
		// load animated gif
		$("#load-more").html("<i class=\"fa fa-spinner fa-spin\">");
	
		$.ajax({
		  type: "GET",
		  url: 'ajax/a-dashboard-activity.php?startIndex=' + sIndex + '&offset=' + offSet + '',
		  success: function (result) {
			$(".recent-activity").append(result);
	
			sIndex = sIndex + offSet;
			isPreviousEventComplete = true;
	
			if (result == '') //When data is not available
				isDataAvailable = false;
	
			
			$("#load-more").html("Load More");
		  },
		  error: function (error) {
			  alert(error);
		  }
		});
	
	  }
	 
	});

});