<?php
// update general settings
function aaModelRunReport($report_type, $report_groupby, $report_set_period, $report_graphic, $report_period_from, $report_period_to) {

	global $pdo_conn, $pdo_t, $lang;
	list($report_date_from, $report_date_to) = aaDateRange($report_set_period);	
	// check if dates are entered for custom dates	
	if ($report_set_period == "custom") {
	
		if (!($report_period_from && $report_period_to)) {

			$report_error = $lang['generic-error-inv-date'];
			
		}
		
	}

	if (!isset($report_error)) {
	
		if ($report_type == "ticket_summary" && $report_groupby == "Date") { // ticket summary by date
			
			$report_sql = "SELECT 
							c.datefield  AS DATE,
							t.Date_Added,
							COUNT(t.Status) AS Total,
							IFNULL(SUM(t.Status =  'Open' ),0) AS Open,
							IFNULL(SUM(t.Status =  'Awaiting Reply'), 0) AS Waiting,
							IFNULL(SUM(t.Status =  'Pending'),0) AS Pending, 
							IFNULL(SUM(t.Status =  'Paused'),0) AS Paused, 
							IFNULL(SUM(t.Status =  'Closed'),0) AS Closed
							FROM ".$pdo_t['t_ticket']." AS t
							RIGHT JOIN calendar AS c ON (DATE(t.Date_Added) = c.datefield) 
							WHERE c.datefield
							BETWEEN '$report_date_from'
							AND '$report_date_to'
							GROUP BY DATE";
								
		} else if ($report_type == "ticket_summary" && $report_groupby == "Agent") { // ticket summary by agent
		
			$report_sql = "SELECT 
							t.Owner,
							COUNT(Status) AS Total,
							SUM(t.Status =  'Open' ) AS Open,
							SUM(t.Status =  'Awaiting Reply' ) AS Waiting,
							SUM(t.Status =  'Pending' ) AS Pending, 
							SUM(t.Status =  'Paused' ) AS Paused, 
							SUM(t.Status =  'Closed' ) AS Closed,
							u.UID,
							(CASE WHEN t.Owner IS NULL THEN 'Unassigned' ELSE u.Fname END) AS Owned
							FROM ".$pdo_t['t_ticket']." AS t
							LEFT JOIN ".$pdo_t['t_users']." AS u ON t.Owner = u.UID
							WHERE Date_Added
							BETWEEN '$report_date_from'
							AND '$report_date_to'
							GROUP BY u.UID";	
		
		} else if  ($report_type == "ticket_summary" && $report_groupby == "Group") { // ticket summary by group
		
			$report_sql = "SELECT 
							t.Cat_ID,
							COUNT(Status) AS Total,
							SUM(t.Status =  'Open' ) AS Open,
							SUM(t.Status =  'Awaiting Reply' ) AS Waiting,
							SUM(t.Status =  'Pending' ) AS Pending, 
							SUM(t.Status =  'Paused' ) AS Paused, 
							SUM(t.Status =  'Closed' ) AS Closed,
							c.Cat_ID,
							c.Category
							FROM ".$pdo_t['t_ticket']." AS t
							LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID
							WHERE Date_Added
							BETWEEN '$report_date_from'
							AND '$report_date_to'
							GROUP BY c.Cat_ID";
							
		} else if  ($report_type == "ticket_summary" && $report_groupby == "User") { // ticket summary by users
		
			$report_sql = "SELECT 
							t.Cat_ID,
							COUNT(Status) AS Total,
							SUM(t.Status =  'Open' ) AS Open,
							SUM(t.Status =  'Awaiting Reply' ) AS Waiting,							
							SUM(t.Status =  'Pending' ) AS Pending, 
							SUM(t.Status =  'Paused' ) AS Paused, 
							SUM(t.Status =  'Closed' ) AS Closed,
							(CASE WHEN u.Fname IS NULL THEN 'Guests' ELSE u.Fname END) AS Fname
							FROM ".$pdo_t['t_ticket']." AS t
							LEFT JOIN ".$pdo_t['t_users']." AS u ON t.User_Email = u.Email
							WHERE Date_Added
							BETWEEN '$report_date_from'
							AND '$report_date_to'
							GROUP BY u.Email";					
							
		} else if ($report_type == "group_load") {
		
			$report_sql = "SELECT
							t.Cat_ID, 
							COUNT( * ) AS Total,
							c.Cat_ID,
							c.Category
							FROM ".$pdo_t['t_ticket']." AS t
							LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID
							WHERE Date_Added
							BETWEEN '$report_date_from'
							AND '$report_date_to'				
							GROUP BY t.Cat_ID";							

		} else if ($report_type == "customer_satisfaction") {

			$report_sql = "SELECT Date_Added,Feedback, COUNT(Feedback) AS rating 
							FROM ".$pdo_t['t_ticket']." 
							WHERE Date_Added
							BETWEEN '$report_date_from'
							AND '$report_date_to' AND Feedback IS NOT NULL 
							GROUP BY Feedback";		
							
		} else if ($report_type == "source_type") {
		
			$report_sql = "SELECT Date_Added,Type, COUNT(Type) AS Total 
							FROM ".$pdo_t['t_ticket']." 
							WHERE Date_Added
							BETWEEN '$report_date_from'
							AND '$report_date_to'
							GROUP BY Type";		

		} else if ($report_type == "time_spent" && $report_groupby == "Date") {
		
			$report_sql = "SELECT 
							c.datefield AS DATE,
							t.Date_Added,
							SUM(tu.Update_Time) AS Total
							FROM ".$pdo_t['t_ticket']." AS t
							RIGHT JOIN calendar AS c ON (DATE(t.Date_Updated) = c.datefield) 
							LEFT JOIN ".$pdo_t['t_ticket_updates']." AS tu ON t.ID = tu.Ticket_ID
							WHERE c.datefield
							BETWEEN '$report_date_from'
							AND '$report_date_to'							
							GROUP BY DATE";
		
		} else if ($report_type == "time_spent" && $report_groupby == "Agent") {
		
			$report_sql = "SELECT 
							t.Owner,
							SUM(tu.Update_Time) AS Total,
							(CASE WHEN t.Owner IS NULL THEN 'Unassigned' ELSE u.Fname END) AS Owned
							FROM ".$pdo_t['t_ticket']." AS t
							LEFT JOIN ".$pdo_t['t_ticket_updates']." AS tu ON t.ID = tu.Ticket_ID
							LEFT JOIN ".$pdo_t['t_users']." AS u ON tu.Update_By = u.UID
							WHERE Date_Updated
							BETWEEN '$report_date_from'
							AND '$report_date_to'
							GROUP BY u.UID";
		
		} else if ($report_type == "time_spent" && $report_groupby == "Group") {
		
			$report_sql = "SELECT 
							c.Category,
							SUM(tu.Update_Time) AS Total
							FROM ".$pdo_t['t_ticket']." AS t
							LEFT JOIN ".$pdo_t['t_ticket_updates']." AS tu ON t.ID = tu.Ticket_ID
							LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID
							WHERE Date_Updated
							BETWEEN '$report_date_from'
							AND '$report_date_to'							
							GROUP BY c.Cat_ID";
		
		} else if ($report_type == "time_spent" && $report_groupby == "User") {
		
			$report_sql = "SELECT
							t.ID,
							t.User_Email,
							t.Subject,
							CASE WHEN u.Fname IS NOT NULL 
								THEN u.Fname
								ELSE '".$lang['report-data-guest']."'
							END AS uFNAME,
							u.Email,
							u.UID,
							a.Fname AS aFNAME,
							SUM(tu.Update_Time) AS Total
							FROM ".$pdo_t['t_ticket']." AS t
							LEFT JOIN ".$pdo_t['t_ticket_updates']." AS tu ON t.ID = tu.Ticket_ID
							JOIN ".$pdo_t['t_users']." AS a ON tu.Update_By = a.UID
							LEFT JOIN ".$pdo_t['t_users']." AS u ON t.User_Email = u.Email
							WHERE Date_Updated
							BETWEEN '$report_date_from'
							AND '$report_date_to'								
							GROUP BY t.ID
							ORDER BY uFNAME ASC";
			
		}
		
		$q = $pdo_conn->prepare($report_sql);
		$q->execute();
		
		return $q;
		
	}
}

?>
