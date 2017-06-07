<?php
// abbreviate date and time string to time ago
function time_elapsed_string($datetime, $full = false) {
	
	global $lang;
	
	// get date and time of select timezone
	$now = timezone_time();
	// set date and time of object with timezone
    $now = new DateTime($now, new DateTimeZone(get_settings("Timezone")));
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => $lang['dash-activity-year'],
        'm' => $lang['dash-activity-month'],
        'w' => $lang['dash-activity-week'],
        'd' => $lang['dash-activity-day'],
        'h' => $lang['dash-activity-hour'],
        'i' => $lang['dash-activity-minute'],
        's' => $lang['dash-activity-second'],
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' '.$lang['dash-activity-ago'] : $lang['dash-activity-now'];
}

// count number of tickets for each status
function aa_dashboard_count_totals($status, $daterange = "today") {
	
	global $pdo_conn, $pdo_t;
	list($filter_date_from, $filter_date_to) = aaDateRange($daterange);
			
	$sql_t_c = "SELECT * FROM ".$pdo_t['t_ticket']." WHERE Status = :status AND (Date_Added BETWEEN :date_from AND :date_to)";
	$q_t_c = $pdo_conn->prepare($sql_t_c);
	$q_t_c->execute(array('status' => $status, 'date_from' => $filter_date_from, 'date_to' => $filter_date_to ));
		
	$ticket_status_total = $q_t_c->rowCount();
	
	return $ticket_status_total;
	
}

// count the number of tickets where the reply sla is expiring
function aaModelSLARExpiring ($groupid = NULL) {
	
	global $pdo_conn, $pdo_t;
	
	if ($groupid == NULL) {
	
		$sql = "SELECT * FROM ".$pdo_t['t_ticket']."
				WHERE SLA_Reply BETWEEN NOW( ) AND NOW( ) + INTERVAL 24 HOUR 
				AND Date_Replied IS NULL 
				AND SLA_Reply_Alert IS NULL";
		
		$q = $pdo_conn->prepare($sql);
		$q->execute();
	
	} else {
	
		$sql = "SELECT * FROM ".$pdo_t['t_ticket']."
				WHERE SLA_Reply BETWEEN NOW( ) AND NOW( ) + INTERVAL 24 HOUR 
				AND Date_Replied IS NULL 
				AND SLA_Reply_Alert IS NULL
				AND Cat_ID = :gid";
		
		$q = $pdo_conn->prepare($sql);
		$q->execute(array("gid" => $groupid));
	
	}
		
	$q_total = $q->rowCount();

	return $q_total;
	
}

// count the number of tickets where the fix SLA is expriring
function aaModelSLAFExpiring ($groupid = NULL) {
	
	global $pdo_conn, $pdo_t;
	
	if ($groupid == NULL) {
	
		$sql = "SELECT * FROM ".$pdo_t['t_ticket']."
				WHERE SLA_Fix BETWEEN NOW( ) AND NOW( ) + INTERVAL 24 HOUR 
				AND Date_Closed IS NULL 
				AND SLA_Fix_Alert IS NULL";
		
		$q = $pdo_conn->prepare($sql);
		$q->execute();
	
	} else {
	
		$sql = "SELECT * FROM ".$pdo_t['t_ticket']."
				WHERE SLA_Fix BETWEEN NOW( ) AND NOW( ) + INTERVAL 24 HOUR 
				AND Date_Closed IS NULL 
				AND SLA_Fix_Alert IS NULL
				AND Cat_ID = :gid";
		
		$q = $pdo_conn->prepare($sql);
		$q->execute(array("gid" => $groupid));
	
	}
		
	$q_total = $q->rowCount();

	return $q_total;
	
}


function aa_count_tickets_by_status($group, $status, $daterange) {
	
	global $pdo_conn, $pdo_t;
	
	list($filter_date_from, $filter_date_to) = aaDateRange($daterange);
	
	$sql_c_t = "SELECT * FROM  ".$pdo_t['t_ticket']." WHERE Cat_ID = :group AND Status = :status AND (Date_Added BETWEEN :date_from AND :date_to)";;
	
	$q_c_t = $pdo_conn->prepare($sql_c_t);
	$q_c_t->execute(array('group' => $group, 'status' => $status, 'date_from' => $filter_date_from, 'date_to' => $filter_date_to));
		
	return $group_status_total = $q_c_t->rowCount();

}


?>