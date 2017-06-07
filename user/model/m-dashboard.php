<?php
// model for dashboard

// function get registered users tickets
function aaModelGetUserTickets($uid) {

	global $pdo_conn, $pdo_t;
	$date_format = get_settings('Date_Format');
	
	$sql = "SELECT t.ID, t.User_Email, t.Subject, t.Status,
	DATE_FORMAT(t.Date_Added, '$date_format') AS DateAdd,
	DATE_FORMAT(t.Date_Updated, '$date_format') AS DateUp
	FROM ".$pdo_t['t_users']." AS u 
	JOIN ".$pdo_t['t_ticket']." AS t 
	ON t.User_Email = u.Email 
	WHERE UID = :uid
	ORDER BY t.Date_Added DESC"; 
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('uid' => $uid));

	return $q;
	
}
?>