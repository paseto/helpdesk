<?php
function aaModelGuestTrack ($email, $tid) {

	global $pdo_conn, $pdo_t, $lang;
	// run custom function to clean email and ticket number fields
	$email = clean($email, TRUE);
	$tid = clean($tid, TRUE);
	
	// IF EMAIL ENTERED IS REGISTERED USER REQUEST PASSWORD????

	// select ticket where email and ticket id match ticket in database
	$sql = "SELECT ID, User_Email FROM ".$pdo_t['t_ticket']." WHERE User_Email = :email AND ID = :tid";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array("email" => $email, "tid" => $tid));
	// count returned tickets for checking
	$valid_entry = $q->rowCount();

	// check for empty fields
	if ($email == "" || $tid == "") {
		
		$track_error[] = set_session ('track-error', '<div class="error-msg">'.$lang['u-ticket-track-error-req'].'</div>');
	
	// check for valid email
	} else if (form_validate ("EMAIL", $email) === TRUE) {
				
		$track_error[] = set_session ('track-error', '<div class="error-msg">'.$lang['u-ticket-track-error-inv-em'].'</div>');
	
	// check ticket no is numeric	
	} else if (form_validate ("NUMBER", $tid) === TRUE) {
				
		$track_error[] = set_session ('track-error', '<div class="error-msg">'.$lang['u-ticket-track-error-inv-no'].'</div>');
	
	// check if email and ticket number entered are valid from mysql check	
	} else if ($valid_entry == 0) {
		
		$track_error[] = set_session ('track-error', '<div class="error-msg">'.$lang['u-ticket-track-error-not-found'].'</div>');
		
	}
	
	// if no errors then show ticket details			
	if (empty($track_error)) {
		
		header("Location: index.php?p=ticket&email=".$email."&tid=".$tid."");

	}
}
?>