<?php
// get number of tickets assigned to agent
function aaModelGetAgentTicketCount($status, $uid) {

	global $pdo_conn, $pdo_t;
		
	$sql_t_c = "SELECT * FROM ".$pdo_t['t_ticket']." WHERE Status = :status AND Owner = :uid";
	
	$q_t_c = $pdo_conn->prepare($sql_t_c);
	$q_t_c->execute(array('status' => $status, 'uid' => $uid));
	
	$t_count = $q_t_c->rowCount();
		
	return $t_count;
	
}

// get all tickets assigned to agent
function aaModelGetAgentTickets($uid, $uemail) {
	
	global $pdo_conn, $pdo_t;
	
	$date_format = get_settings('Date_Format');
	
	$sql_owned_tickets = "SELECT ID, Subject, Status, 
						DATE_FORMAT(Date_Added, '$date_format') AS DateAdd,
						DATE_FORMAT(Date_Updated, '$date_format') AS DateUp 
						FROM ".$pdo_t['t_ticket']." WHERE Owner = :uid OR User_Email = :uemail AND Status != 'Closed' ORDER BY Date_Updated DESC";

	$q_owned_tickets = $pdo_conn->prepare($sql_owned_tickets);
	$q_owned_tickets->execute(array('uid' => $uid, 'uemail' => $uemail));

	return $q_owned_tickets;
	
}

// get ticket rating by agent
function aaModelGetAgentRatings($uid) {

	global $pdo_conn, $pdo_t;
		
	$sql_owned_rating = "SELECT Owner,Feedback, COUNT(Feedback) AS rating 
						FROM ".$pdo_t['t_ticket']."
						WHERE Feedback IS NOT NULL AND Owner = :uid
						GROUP BY Feedback ORDER BY Feedback DESC";

	$q_owned_rating = $pdo_conn->prepare($sql_owned_rating);
	$q_owned_rating->execute(array('uid' => $uid));

	return $q_owned_rating;
	
}

// update the agent signature
function aaModelUpdateSignature ($signature, $uid) {

	global $pdo_conn, $pdo_t;	
	
	$signature = clean($signature, TRUE);
	
	$sql = "UPDATE ".$pdo_t['t_users']." SET Signature = :signature WHERE UID = :uid";
	
	$q = $pdo_conn->prepare($sql);
	
	if ($q->execute(array('signature' => $signature, 'uid' => $uid))) {
		
		$_SESSION['a']['aasign'] = $signature;
		header("Location: ".$_SERVER['REQUEST_URI']);
		
	} else {
	
		echo "Failed";
		
	}
	
}

// update preferred view and style
function aaModelUpdateUser ($view, $style, $uid) {
	
	global $pdo_conn, $pdo_t;	
	
	$sql_u = "UPDATE ".$pdo_t['t_users']." SET Preferred_View = :view, Layout_Style = :style
				WHERE UID = :uid";
				
	$q_u = $pdo_conn->prepare($sql_u);
	
	if ($q_u->execute(array('view' => $view, 'style' => $style, 'uid' => $uid))) {
		
		// update custom css style
		$_SESSION['a']['aaview'] = $view;
		$_SESSION['a']['aastyle'] = $style;
		
		header("Location: ".$_SERVER['REQUEST_URI']);

	}
	
}
?>