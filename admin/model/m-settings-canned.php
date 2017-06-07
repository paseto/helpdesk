<?php
// save canned response
function aaModelSaveCanned ($can_id, $can_title, $can_text) {	

	global $pdo_conn, $pdo_t, $lang;

	// clean entered data using custom function
	$can_title = clean($can_title, TRUE);
	$can_text = clean($can_text, FALSE);

	// if field is blank
	if (!($can_title)) {

		echo "<div class=\"error-msg\">".$lang["generic-error"]."</div>";
		$error = true;
		
	// else insert into DB	
	}
	
	if (!($error)) {	
		
		if ($can_id == "") {
		
			// insert priority name plus order ID of last id plus 1
			$sql = "INSERT INTO ".$pdo_t['t_canned_msg']." (Can_Title, Can_Message) VALUES (:can_title, :can_text)"; 
			$q = $pdo_conn->prepare($sql);

			$q->execute(array(":can_title" => $can_title, ":can_text" => $can_text));
	
		} else {
		
			$sql = "UPDATE ".$pdo_t['t_canned_msg']." SET Can_Title=:can_title, Can_Message=:can_text WHERE CANID = :can_id";
			$q = $pdo_conn->prepare($sql);

			$q->execute(array(":can_title" => $can_title, ":can_text" => $can_text, ":can_id" => $can_id));

		}
			
		// refresh page and send to priorities section
		header('Location: '.$_SERVER['REQUEST_URI']);

	}	

}

// delete canned response
function aaModelDeleteCanned ($can_id) {

	global $pdo_conn, $pdo_t;
	
	// run sql to delete priority record
	$sql = "DELETE FROM ".$pdo_t['t_canned_msg']." WHERE CANID=:can_id";
	$q = $pdo_conn->prepare($sql);

	$q->execute(array(":can_id" => $can_id));
	
	// refresh page and send to priorities section
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}
?>