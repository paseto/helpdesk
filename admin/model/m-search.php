<?php
// unset all search session variables but not the logon sessions
function aaModelSearchUnsetFilter() {
	unset($_SESSION["search_str"],$_SESSION["adv_s_tid"],$_SESSION["adv_s_subject"],
	$_SESSION["adv_s_msg"],$_SESSION["adv_s_cust"],$_SESSION["adv_s_group"],
	$_SESSION["adv_s_priority"],$_SESSION["adv_s_status"],$_SESSION["adv_s_owner"],
	$_SESSION["adv_s_dateadd_from"],$_SESSION["adv_s_dateadd_to"],
	$_SESSION["adv_s_dateup_from"],$_SESSION["adv_s_dateup_to"],
	$_SESSION["adv_s_dateclosed_from"],$_SESSION["adv_s_dateclosed_to"],
	$_SESSION["cond"],$_SESSION["params"],$_SESSION["qs_input"]);
}
// function to create mysql search string. used on pagination count and search statement
function aaModelSearchSQLStr() {
	// clear existing search before generating new search string
	aaModelSearchUnsetFilter();

	$_SESSION["adv_s_tid"] = $_POST["adv_s_tid"];
	$_SESSION["adv_s_subject"] = $_POST["adv_s_subject"];
	$_SESSION["adv_s_msg"] = $_POST["adv_s_msg"];
	$_SESSION["adv_s_cust"] = $_POST["adv_s_cust"];
	$_SESSION["adv_s_group"] = $_POST["adv_s_group"];
	$_SESSION["adv_s_priority"] = $_POST["adv_s_priority"];
	$_SESSION["adv_s_status"] = $_POST["adv_s_status"];
	$_SESSION["adv_s_owner"] = $_POST["adv_s_owner"];
	$_SESSION["adv_s_dateadd_from"] = $_POST["adv_s_dateadd_from"];
	$_SESSION["adv_s_dateadd_to"] = $_POST["adv_s_dateadd_to"];
	$_SESSION["adv_s_dateup_from"] = $_POST["adv_s_dateup_from"];
	$_SESSION["adv_s_dateup_to"] = $_POST["adv_s_dateup_to"];
	$_SESSION["adv_s_dateclosed_from"] = $_POST["adv_s_dateclosed_from"];
	$_SESSION["adv_s_dateclosed_to"] = $_POST["adv_s_dateclosed_to"];
	
	// Place all variables into an array
	$search = array("t.ID" => $_SESSION["adv_s_tid"], 
					"t.Subject" => $_SESSION["adv_s_subject"], 
					"t.Message" => $_SESSION["adv_s_msg"], 
					"t.User" => $_SESSION["adv_s_cust"], 
					"t.Cat_ID" => $_SESSION["adv_s_group"],
					"t.Level_ID" => $_SESSION["adv_s_priority"], 
					"t.Status" => $_SESSION["adv_s_status"],
					"t.Owner" => $_SESSION["adv_s_owner"],
					"t.Date_Added" => $_SESSION["adv_s_dateadd_from"],
					"t.Date_Updated" => $_SESSION["adv_s_dateup_from"],
					"t.Date_Closed" => $_SESSION["adv_s_dateclosed_from"]														
					);

		// Loop through variables to create mysql WHERE string
		foreach($search as $key => $result) {
			$result = trim($result);
			if ($result != "") {
				
				if ($key == "t.Owner") {
					
					// use IS NULL if ticket unassigned
					$cond[] = "(t.Owner LIKE  '%' ? '%' OR t.Owner IS NULL)";
					$params[] = $result;
				
				} else if ($key == "t.Date_Added") {
					
					$cond[] = "(t.Date_Added BETWEEN '".$_SESSION["adv_s_dateadd_from"]."' AND '".$_SESSION["adv_s_dateadd_to"]."')";
				
				} else if ($key == "t.Date_Updated") {
					
					$cond[] = "(t.Date_Updated BETWEEN '".$_SESSION["adv_s_dateup_from"]."' AND '".$_SESSION["adv_s_dateup_to"]."')";
					
				} else if ($key == "t.Date_Closed") {
					
					$cond[] = "(t.Date_Closed BETWEEN '".$_SESSION["adv_s_dateclosed_from"]."' AND '".$_SESSION["adv_s_dateclosed_to"]."')";
				
				} else {
					
					$cond[] = "(".$key." LIKE '%' ? '%')";
					$params[] = $result;
				
				}
															
			}
			
		}
		
	// return search string to be used in MYSQL statements		
	return array ($cond, $params);

}

// quick search lookup
function aaModelSearchQuick($quick_search_val) {

	global $pdo_conn, $pdo_t, $date_format, $lang;

	// clear existing search before generating new search string
	aaModelSearchUnsetFilter();
	
	$_SESSION["qs_input"] = $quick_search_val;

	$sql = "SELECT
				t.ID, 
				t.Subject,
				t.User,
				t.Status,
				t.Type,
				DATE_FORMAT(t.Date_Added, '$date_format') AS DateAdd,
				DATE_FORMAT(t.Date_Updated, '$date_format') AS DateUp,
				DATE_FORMAT(t.SLA_Reply, '$date_format') AS DateSlaR,
				DATE_FORMAT(t.SLA_Fix, '$date_format') AS DateSlaF,
				CASE WHEN t.SLA_Reply IS NOT NULL 
					   THEN DATE_FORMAT(t.SLA_Reply, '$date_format')
					   ELSE '".$lang["generic-na"]."'
				END AS SLAR,
				CASE WHEN t.SLA_Fix IS NOT NULL 
					   THEN DATE_FORMAT(t.SLA_Fix, '$date_format')
					   ELSE '".$lang["generic-na"]."'
				END AS SLAF,
				(CASE WHEN t.Date_Closed IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Closed, '$date_format') END) AS DateClosed,
				(CASE WHEN t.Date_Replied IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Replied, '$date_format') END) AS DateReplied,
				t.Date_Replied,
				t.SLA_Reply,
				t.Date_Closed,
				t.SLA_Fix,			
				t.Cat_ID,
				CASE t.Cat_ID WHEN c.Cat_ID THEN c.Category ELSE NULL END Category,
				t.Level_ID,
				CASE t.Level_ID WHEN p.Level_ID THEN p.Level ELSE NULL END Priority,
				t.Owner,
				(CASE WHEN t.Owner IS NULL THEN 'Unassigned' ELSE u.Fname END) AS Owned								
				FROM ".$pdo_t['t_ticket']." AS t
				LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID 
				LEFT JOIN ".$pdo_t['t_priorities']." AS p ON t.Level_ID = p.Level_ID 
				LEFT JOIN ".$pdo_t['t_users']." AS u ON t.Owner = u.UID
				WHERE (t.ID LIKE '%' :qsval '%')
				OR (t.Subject LIKE '%' :qsval '%')
				OR (t.User LIKE '%' :qsval '%')		
				OR (t.Status LIKE '%' :qsval '%')
				OR (c.Category LIKE '%' :qsval '%')
				OR (p.Level LIKE '%' :qsval '%')								
				OR (u.Fname LIKE '%' :qsval '%')				
				ORDER BY t.Date_Added DESC";
										
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('qsval' => $quick_search_val));
	
	return $q;

}

// save search infomaiton for revisit
function aaModelSearchSaved() {

	global $pdo_conn, $pdo_t, $date_format, $lang;
	
	$sql = "SELECT
				t.ID, 
				t.Subject,
				t.User,
				t.Status,
				t.Type,
				DATE_FORMAT(t.Date_Added, '$date_format') AS DateAdd,
				DATE_FORMAT(t.Date_Updated, '$date_format') AS DateUp,
				DATE_FORMAT(t.SLA_Reply, '$date_format') AS DateSlaR,
				DATE_FORMAT(t.SLA_Fix, '$date_format') AS DateSlaF,
				CASE WHEN t.SLA_Reply IS NOT NULL 
					   THEN DATE_FORMAT(t.SLA_Reply, '$date_format')
					   ELSE '".$lang["generic-na"]."'
				END AS SLAR,
				CASE WHEN t.SLA_Fix IS NOT NULL 
					   THEN DATE_FORMAT(t.SLA_Fix, '$date_format')
					   ELSE '".$lang["generic-na"]."'
				END AS SLAF,
				(CASE WHEN t.Date_Closed IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Closed, '$date_format') END) AS DateClosed,
				(CASE WHEN t.Date_Replied IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Replied, '$date_format') END) AS DateReplied,
				t.Date_Replied,
				t.SLA_Reply,
				t.Date_Closed,
				t.SLA_Fix,				
				t.Cat_ID,
				CASE t.Cat_ID WHEN c.Cat_ID THEN c.Category ELSE NULL END Category,
				t.Level_ID,
				CASE t.Level_ID WHEN p.Level_ID THEN p.Level ELSE NULL END Priority,
				t.Owner,
				(CASE WHEN t.Owner IS NULL THEN 'Unassigned' ELSE u.Fname END) AS Owned								
				FROM ".$pdo_t['t_ticket']." AS t
				LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID 
				LEFT JOIN ".$pdo_t['t_priorities']." AS p ON t.Level_ID = p.Level_ID 
				LEFT JOIN ".$pdo_t['t_users']." AS u ON t.Owner = u.UID
				WHERE " . implode(' AND ', $_SESSION["cond"]) ."
				ORDER BY t.Date_Added DESC";
				
	$q = $pdo_conn->prepare($sql);
	$q->execute($_SESSION["params"]);
	
	return $q;
	
}

function aaModelSearchAdvanced() {
	
	global $pdo_conn, $pdo_t, $date_format, $lang;
	
	list($cond, $params) = aaModelSearchSQLStr();
	
	// save input for display and search for dodging between pages
	$_SESSION["cond"] = $cond;
	$_SESSION["params"] = $params;

	$sql = "SELECT
			t.ID, 
			t.Subject,
			t.User,
			t.Status,
			t.Type,				
			DATE_FORMAT(t.Date_Added, '$date_format') AS DateAdd,
			DATE_FORMAT(t.Date_Updated, '$date_format') AS DateUp,
			DATE_FORMAT(t.SLA_Reply, '$date_format') AS DateSlaR,
			DATE_FORMAT(t.SLA_Fix, '$date_format') AS DateSlaF,
			CASE WHEN t.SLA_Reply IS NOT NULL 
				   THEN DATE_FORMAT(t.SLA_Reply, '$date_format')
				   ELSE '".$lang["generic-na"]."'
			END AS SLAR,
			CASE WHEN t.SLA_Fix IS NOT NULL 
				   THEN DATE_FORMAT(t.SLA_Fix, '$date_format')
				   ELSE '".$lang["generic-na"]."'
			END AS SLAF,
			(CASE WHEN t.Date_Closed IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Closed, '$date_format') END) AS DateClosed,
			(CASE WHEN t.Date_Replied IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Replied, '$date_format') END) AS DateReplied,
			t.Date_Replied,
			t.SLA_Reply,
			t.Date_Closed,
			t.SLA_Fix,			
			t.Cat_ID,
			CASE t.Cat_ID WHEN c.Cat_ID THEN c.Category ELSE NULL END Category,
			t.Level_ID,
			CASE t.Level_ID WHEN p.Level_ID THEN p.Level ELSE NULL END Priority,
			t.Owner,
			(CASE WHEN t.Owner IS NULL THEN 'Unassigned' ELSE u.Fname END) AS Owned								
			FROM ".$pdo_t['t_ticket']." AS t
			LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID 
			LEFT JOIN ".$pdo_t['t_priorities']." AS p ON t.Level_ID = p.Level_ID 
			LEFT JOIN ".$pdo_t['t_users']." AS u ON t.Owner = u.UID
			WHERE " . implode(' AND ', $cond) ."
			ORDER BY t.Date_Added DESC";
				
	$q = $pdo_conn->prepare($sql);
	$q->execute($params);
	
	return $q;

}
?>
