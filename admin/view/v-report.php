<?php
// unset csv content to prevent data adding on each time
unset($_SESSION["csv_header"], $_SESSION["csv_body"]);

if (isset($_POST["action_report"])) {
	
	// set variables foreach post to use in page
	$report_type = $_POST["report_type"];
	$report_groupby = $_POST["report_groupby"];
	$report_set_period = $_POST["report_set_period"];
	$report_graphic = @$_POST["rep_graphic"];
	$report_period_from = $_POST["rep_period_from"];
	$report_period_to = $_POST["rep_period_to"];

	// get date range from global function
	list($report_date_from, $report_date_to) = aaDateRange($report_set_period);	

	// run report
	$report = aaModelRunReport($_POST["report_type"], $_POST["report_groupby"], $_POST["report_set_period"], @$_POST["rep_graphic"], $report_date_from, $report_date_to);
	
	$reportdata = $report->fetchAll();
			
	// get number of records
	$report_results = $report->rowCount();	

}
?>

<div id="layout-body">
	<div id="layout-body-left-width">&nbsp;</div>
    <div id="layout-body-left" class="form layout-padding">
    
    <h2><?php echo $lang['rep-filter']; ?></h2>

        <form name="reporting" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <label><?php echo $lang['rep-report']; ?></label>
        <select name="report_type" id="report_type">
        <?php
        $reports = array("ticket_summary" => $lang['rep-dd-ts'], 
                        "group_load" => $lang['rep-dd-gl'],
                        "customer_satisfaction" => $lang['rep-dd-cs'],
						"source_type" => $lang['rep-dd-st'],
						"time_spent" => $lang['rep-dd-tt']);
       
        foreach($reports as $key => $value) {
        
            if($report_type == $key) {
            
                echo "<option value=\"".$key."\" selected=\"selected\">".$value."</option>";
            
            } else {
                
                echo "<option value=\"".$key."\">".$value."</option>";
            
            }
            
        }
        ?>
        </select>
        
        <div id="report_groupby_div">
        <label><?php echo $lang['report-groupby']; ?></label>
        <select name="report_groupby" id="report_groupby">
        <?php
        $groupby = array("Agent" => $lang['report-groupby-agent'],
						 "Date" => $lang['report-groupby-date'],
                         "Group" => $lang['report-groupby-group'],
						 "User" => $lang['report-groupby-user']);
       
        foreach($groupby as $key => $value) {
        
            if($report_groupby == $key) {
            
                echo "<option value=\"".$key."\" selected=\"selected\">".$value."</option>";
            
            } else {
                
                echo "<option value=\"".$key."\">".$value."</option>";
            
            }
            
        }
        ?>
        </select>
        </div>
        
        <label><?php echo $lang['rep-period']; ?></label>
        <select name="report_set_period" id="report_set_period">
        <?php
    	$reports = array("today" => $lang['tickets-dateadd-today'], 
						"yesterday" => $lang['tickets-dateadd-yesterday'],
						"this_week" => $lang['tickets-dateadd-thisweek'],		
						"last_week" => $lang['tickets-dateadd-lastweek'],
						"this_month" => $lang['tickets-dateadd-thismonth'],		
						"last_month" => $lang['tickets-dateadd-lastmonth'],
						"custom" => $lang['rep-date-dd-cust']);
			                        
        foreach($reports as $key => $value) {
        
            if($report_set_period == $key) {
            
                echo "<option value=\"".$key."\" selected=\"selected\">".$value."</option>";
            
            } else {
                
                echo "<option value=\"".$key."\">".$value."</option>";
            
            }
            
        }
        ?>
        </select>
        
        <div id="report_custom_dates">
        <?php
        if (isset($report_error)) {
        ?>
        <span class="error"><?php echo $report_error; ?></span>
        <?php
        }
        ?>
        <label><?php echo $lang['rep-period-from']; ?></label>
        <input id="rep_period_from" name="rep_period_from" type="text" value="<?php if (isset($_POST["rep_period_from"])) { echo $_POST["rep_period_from"]; } ?>" />
        
        <label><?php echo $lang['rep-period-to']; ?></label>
        <input id="rep_period_to" name="rep_period_to" type="text" value="<?php if (isset($_POST["rep_period_to"])) { echo $_POST["rep_period_to"]; } ?>" />
        </div>
        
        <label><?php echo $lang['rep-graphic']; ?></label>
        <input name="rep_graphic" type="checkbox" id="rep_graphic" <?php if (isset($report_graphic)) { echo "checked=\"checked\""; } ?> />
        
        <p><input class="btn" name="action_report" type="submit" value="<?php echo $lang['rep-report']; ?>" /></p>
        <p><input class="btn" name="action_reset" type="submit" value="<?php echo $lang['rep-reset']; ?>" /></p>
        
        </form>
        
        
        <?php
        // Edit report type to create title and graph
        $report_title = ucwords(str_replace("_"," ",$report_type));
        
        // Strip string to get first word for title
        $report_key = strstr($report_title," ",true);
        
        switch ($report_type) {
            case "ticket_summary";
                $report_tr_head = "<tr>
                <td width=\"25%\" >".$report_groupby."</td>
                <td width=\"12.5%\" >".$lang['rep-total']."</td>
                <td width=\"12.5%\" >".$lang['tickets-status-open']."</td>
				<td width=\"12.5%\" >".$lang['tickets-status-ar']."</td>
                <td width=\"12.5%\" >".$lang['tickets-status-pending']."</td>
                <td width=\"12.5%\" >".$lang['tickets-status-paused']."</td>
                <td width=\"12.5%\" >".$lang['tickets-status-closed']."</td>
                </tr>";
                $_SESSION["csv_header"] = $report_key.",".$lang['rep-total'].",".$lang['tickets-status-open'].",".$lang['tickets-status-pending'].",".$lang['tickets-status-paused'].",".$lang['tickets-status-closed']."\n";
                break;
                
            case "group_load":
			case "source_type":
                $report_tr_head = "<tr>
                <td width=\"50%\" >".$report_key."</td>
                <td width=\"50%\" >".$lang['rep-total']."</td>
                </tr>";
                $_SESSION["csv_header"] = $report_key.",".$lang['rep-total']."\n";	
                break;
							
			case "time_spent":	
			
				switch($report_groupby) {
					case "User":
						$report_tr_head = "<tr>
						<td>User</td>
						<td>Ticket ID</td>
						<td>Subject</td>
						<td>Agent</td>						
						<td>Duration</td>
						</tr>";
						$_SESSION["csv_header"] = "User,Ticket ID,Subject,Agent,Duration\n";												
						break;
					default:
						$report_tr_head = "<tr>
						<td width=\"50%\" >".$report_groupby."</td>
						<td width=\"50%\" >".$lang['rep-total']."</td>
						</tr>";
						$_SESSION["csv_header"] = $report_key.",".$lang['rep-total']."\n";				
				}

                break;
                
            case "customer_satisfaction":
                $report_tr_head = "<tr>
                <td width=\"50%\" >".$lang['rep-feedback']."</td>
                <td width=\"50%\" >".$lang['rep-total']."</td>
                </tr>";		
                $_SESSION["csv_header"] = $lang['rep-feedback'].",".$lang['rep-total']."\n";	
                break;			
                
            }
            
        ?>
       
</div>

<div id="layout-body-middle" class="layout-padding">

<?php
if (isset($_POST["action_report"])) {
?>
<h2><?php echo $lang['rep-report']; ?></h2>
<a name="reportresults"></a>
<h3><?php echo $report_title; ?> - <?php echo date("D jS M Y", strtotime($report_date_from))." - ".date("D jS M Y", strtotime($report_date_to)); ?></h3>
<?php

$_SESSION["csv_filename"] = $report_title."-".$report_date_from."-".$report_date_to;
if ($report_results == 0) {
	
	echo "<div class=\"error-msg\">".$lang['rep-no-data']."</div>";	
	
} else {
	
?>
<p><strong><a href="report-export.php?export_report_csv=yes"><i class="fa fa-download"></i> <?php echo $lang['rep-download']; ?></a></strong></p>
<table class="table_header" width="100%">
<colgroup>
<col />
<col />
<col />
<col />
<col />
<col />
</colgroup>

	<thead>
	<?php
	echo $report_tr_head;
	?>
	</thead>
<tbody>

<?php
// while loop to get the number of feedback ratings by date added
foreach($reportdata as $rating_total) { 

	$total += $rating_total["rating"];
	
}

foreach($reportdata as $report) {
// generate string for google charts report
switch ($report_type) {
	case "ticket_summary":
		if ($report_groupby == "Date") {
			$data_name = $report["DATE"];
		} else if ($report_groupby == "Group") {
			$data_name = $report["Category"];
		} else if ($report_groupby == "Agent") {
			$data_name = $report["Owned"];
		} else if ($report_groupby == "User") {
			$data_name = $report["Fname"];
		}
		// create string for graph data
		$graph_tickets_by_group2 .= "['".$data_name."' , ".$report["Total"].", ".$report["Open"].", ".$report["Pending"].", ".$report["Paused"].", ".$report["Closed"].",],";
		$report_tr_body = $report_summary;
		break;	
	case "group_load":
		$data_name = $report["Category"];
		// create string for graph data
		$graph_tickets_by_group2 .= "['".$data_name."' , ".$report["Total"]."],";
		$report_tr_body = $report_load;
		break;
	case "time_spent":
		if ($report_groupby == "Date") {
			$data_name = $report["DATE"];
		} else if ($report_groupby == "Group") {
			$data_name = $report["Category"];
		} else if ($report_groupby == "Agent") {
			$data_name = $report["Owned"];
		}  else if ($report_groupby == "User") {
			$data_name = $report["User"];
		}
		// create string for graph data
		$graph_tickets_by_group2 .= "['".$data_name."' , ".$report["Total"]."],";
		$report_tr_body = $report_load;
		break;
	case "customer_satisfaction":
					
		// rename rows based on value
		switch ($report["Feedback"]) {
			case 0:
			$data_name = $lang['ticket-rate-neg'];
			break;
			case 1:
			$data_name = $lang['ticket-rate-neu'];
			break;
			case 2:
			$data_name = $lang['ticket-rate-p'];
			break;
			}
		$graph_tickets_by_group2 .= "['".$data_name."' , ".$report["rating"]."],";								
		// break report type
		break;	
	case "source_type":
		$data_name = $report["Type"];
		// create string for graph data
		$graph_tickets_by_group2 .= "['".$data_name."' , ".$report["Total"]."],";
		$report_tr_body = $report_load;
		break;
				
	}

switch ($report_type) {
	case "ticket_summary";
		$report_tr_body = "<tr>
		<td data-title=\"".decode_entities($data_name)."\">".decode_entities($data_name)."</td>
		<td data-title=\"".$report["Total"]."\">".$report["Total"]."</td>
		<td data-title=\"".$report["Open"]."\">".$report["Open"]."</td>
		<td data-title=\"".$report["Waiting"]."\">".$report["Waiting"]."</td>
		<td data-title=\"".$report["Pending"]."\">".$report["Pending"]."</td>
		<td data-title=\"".$report["Paused"]."\">".$report["Paused"]."</td>
		<td data-title=\"".$report["Closed"]."\">".$report["Closed"]."</td>
		</tr>";
		$_SESSION["csv_body"] .= $data_name.",".$report["Total"].",".$report["Open"].",".$report["Pending"].",".$report["Paused"].",".$report["Closed"]."\n";
		break;
		
	case "group_load":
	case "source_type":
		$report_tr_body = "<tr>
		<td data-title=\"".$data_name."\">".$data_name."</td>
		<td data-title=\"".$report["Total"]."\">".$report["Total"]."</td>
		</tr>";
		$_SESSION["csv_body"] .= $data_name.",".$report["Total"]."\n";			
		break;

	case "time_spent":
	
		$hours = floor($report["Total"] / 60);
		$mins = sprintf("%02s", ($report["Total"] % 60));

		switch($report_groupby) {
			case "User":
			$report_user = ($report["uFNAME"] == $lang['report-data-guest']) ? $report["uFNAME"] : "<a href=\"p.php?p=user-profile&email=".$report["User_Email"]."&uid=".$report["UID"]."\">".$report["uFNAME"]."</a>";
			$report_tr_body = "<tr>
			<td data-title=\"".$report["uFNAME"]."\">".$report_user."</td>
			<td data-title=\"".$report["ID"]."\"><a href=\"p.php?p=ticket&tid=".$report["ID"]."\">".$report["ID"]."</a></td>
			<td data-title=\"".$report["Subject"]."\">".$report["Subject"]."</td>
			<td data-title=\"".$data_name."\">".$report["aFNAME"]."</td>			
			<td data-title=\"".$hours.":".$mins."\">".$hours.":".$mins."</td>
			</tr>";
			$_SESSION["csv_body"] .= $report["uFNAME"].",".$report["ID"].",".$report["Subject"].",".$report["aFNAME"].",".$hours.":".$mins."\n";					
			break;
			default:
			$report_tr_body = "<tr>
			<td data-title=\"".$data_name."\">".$data_name."</td>
			<td data-title=\"".$hours.":".$mins."\">".$hours.":".$mins."</td>
			</tr>";
			$_SESSION["csv_body"] .= $data_name.",".$hours.":".$mins."\n";				
		}
	
		break;
	
	case "customer_satisfaction":
		// round to 2 decimel places.
		$rating_percentage = round($report["rating"] / $total * 100, 2);
		$report_tr_body = "<tr>
		<td data-title=\"".$data_name."\">".$data_name."</td>
		<td data-title=\"Total\">".$rating_percentage."%</td>
		</tr>";
		$_SESSION["csv_body"] .= $data_name.",".$rating_percentage."%\n";			
		break;		
		
	}		
	
	// print tr row depending on report
	echo $report_tr_body;

// end while loop
}

// strip last comma off data
$graph_data = rtrim($graph_tickets_by_group2, ",");
?>
</tbody>
</table>
<br />
<script>
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawLineChart);
	function drawLineChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Ticket', 'Total', 'Open', 'Pending', 'Paused', 'Closed'],
			<?php echo $graph_data; ?>
	]);
	
	var options = {
			chartArea: {'width': '75%', 'height': '75%', },
			legend: { position: 'bottom' },
			hAxis: { gridlines: { color: "#EEE" }, baselineColor: '#EEE', textStyle: { color: '#666' } },		
			vAxis: { gridlines: { color: "#EEE" }, baselineColor: '#EEE', textStyle: { color: '#666' } }
	};
	
	var chart = new google.visualization.LineChart(document.getElementById('linechart_div'));
	chart.draw(data, options);
			
	}
	
	
	// chart for agent summary
	google.load("visualization", "1", {packages:["corechart"]});
	  google.setOnLoadCallback(drawChart);
	  function drawChart() {
		var data = google.visualization.arrayToDataTable([
		  ['Year', 'Total', 'Open', 'Pending', 'Paused', 'Closed' ],
			<?php echo $graph_data; ?>
			]);

		var options = {
		  chartArea: {'width': '75%', 'height': '75%'},
		  title: '<?php echo $report_title; ?>',
		  hAxis: {title: '<?php echo $report_key; ?>', titleTextStyle: {color: 'red'}},
		  vAxis: {format: '0'}
		};

		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, options);
		
		
	  }
	  
	  // pie chart
	  google.load("visualization", "1", {packages:["corechart"]});
	  google.setOnLoadCallback(drawPieChart);
	  function drawPieChart() {
		var data = google.visualization.arrayToDataTable([
		  ['Task', 'Hours per Day'],
			<?php echo $graph_data; ?>
		]);

		var options = {
		  title: '<?php echo $report_title; ?>'
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);
				  
	  }
	  
		  
</script>
<br />
<?php
if (isset($report_graphic)) {
?>
<?php
switch (true) {
	case ($report_type == "ticket_summary" && $report_groupby == "Date"): // if ticket summary and group by date
		echo "<div id=\"linechart_div\" style=\"width: 100%; height: 500px;\"></div>";
		break;
	case ($report_type == "ticket_summary" && $report_groupby != "Date"): // if ticket summary and group by agent or group
		echo "<div id=\"chart_div\" style=\"width: 100%; height: 500px;\"></div>";
		break;
	case "group_load":
	case "customer_satisfaction":
	case "source_type":
		echo "<div id=\"piechart\" style=\"width: 100%; height: 500px;\"></div>";
		break;
	case ($report_type == "time_spent" && $report_groupby == "Date"):
		echo "<div id=\"linechart_div\" style=\"width: 100%; height: 500px;\"></div>";
		break;
	case ($report_type == "time_spent" && $report_groupby != "Date"):
		echo "<div id=\"piechart\" style=\"width: 100%; height: 500px;\"></div>";
		break;		
	}
?>
<?php
// end if report checkbox ticked
}

// end if else for if results is greater than 0
}
 
// end if report run
echo "<div id='png'></div>";

}
?>
</div>
</div>
