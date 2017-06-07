<?php

// get tickets per group
function aaModelGetTicketsPerGroup($gid) {

	global $pdo_conn, $pdo_t;
	
	$sql = "SELECT COUNT(*) AS tcount FROM ".$pdo_t['t_ticket']." WHERE Cat_ID = :gid AND Status != 'Closed'";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array(":gid" => $gid));
	
	return $q;
	
}

// insert new group
function aaModelInsertGroup($groupname) {
	
	global $pdo_conn, $pdo_t, $lang;	
	
	// clean entered data using custom function
	$groupname = clean($groupname, TRUE);
	
	// if field is blank
	if ($groupname == "") {
	
		echo "<div class=\"error-msg\">".$lang["generic-error"]."</div>";
		
	// else insert into DB	
	} else {	
			
		$sql = "INSERT INTO ".$pdo_t['t_groups']." (Category) VALUES (:groupname)";
		$q = $pdo_conn->prepare($sql);
		$q->execute(array(":groupname" => $groupname));
		
		// refresh page and send to categories section
		header('Location: '.$_SERVER['REQUEST_URI']);
	
	}
	
}

// set default group
function aaModelSetDefaultGroup($gid) {

	global $pdo_conn, $pdo_t;	

	// set default to 1 on selected category
	$set_default = "UPDATE ".$pdo_t['t_groups']." SET Def =  '1' WHERE  `Cat_ID` = :gid";
	
	$q_set = $pdo_conn->prepare($set_default);
	$q_set->execute(array(":gid" => $gid));

	// set default to 0 on all other categories
	$unset_default = "UPDATE ".$pdo_t['t_groups']." SET Def =  '0' WHERE  `Cat_ID` != :gid";

	$q_unset = $pdo_conn->prepare($unset_default);
	$q_unset->execute(array(":gid" => $gid));

	// refresh page and send to categories section
	header('Location: '.$_SERVER['REQUEST_URI']);

}

// delete group
function aaModelDeleteGroup($gid) {

	global $pdo_conn, $pdo_t;	

	$sql = "DELETE FROM ".$pdo_t['t_groups']." WHERE Cat_ID = :gid";
		
	$q = $pdo_conn->prepare($sql);
	$q->execute(array(":gid" => $gid));
		
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}

// set automatic owner assignment for group
function aaModelSetGroupOwner($gid, $owner) {

	global $pdo_conn, $pdo_t;	
	
	// set owner to NULL for db if NULL selected
	$owner = ($owner == "NULL") ? NULL : $owner;

	$sql = "UPDATE ".$pdo_t['t_groups']." SET Ticket_Assignment = :owner WHERE `Cat_ID` = :gid";
		
	$q = $pdo_conn->prepare($sql);
	$q->execute(array(":owner" => $owner, ":gid" => $gid));
	
}
?>
