<?php
// get tickets per priority
function aaModelGetTicketsPerPriority($pid) {

	global $pdo_conn, $pdo_t;

	$sql = "SELECT COUNT(*) AS tcount FROM ".$pdo_t['t_ticket']." WHERE Level_ID = :pid AND Status != 'Closed'";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array(":pid" => $pid));
	
	return $q;
	
}

// insert new priority
function aaModelInsertPriority($priority) {

	global $pdo_conn, $pdo_t, $lang;

	$priority = clean($priority,TRUE);

	// if field is blank
	if ($priority == "") {
	
		echo "<div class=\"error-msg\">".$lang["generic-error"]."</div>";
		
	// else insert into DB	
	} else {

		$sql = "SELECT OrderID FROM ".$pdo_t['t_priorities']." ORDER BY OrderID DESC LIMIT 1"; 
	
		$priorities = $pdo_conn->prepare($sql);
		$priorities->execute();
		
		$previous_priority = $priorities->fetch();
	
		
		// create next avaible id by increasing last id by 1
		$priority_orderid = $previous_priority["OrderID"]+1;

		$add_priority = "INSERT INTO ".$pdo_t['t_priorities']." (Level, OrderID) VALUES (:priority, :priority_orderid)"; 

		$q = $pdo_conn->prepare($add_priority);
		$q->execute(array(":priority" => $priority, ":priority_orderid" => $priority_orderid));

		// refresh page and send to priorities section
		header('Location: '.$_SERVER['REQUEST_URI']);
	
	}	

}

// set default priority
function aaModelSetDefaultPriority($lid) {

	global $pdo_conn, $pdo_t;	

	// set default to 1 on selected category
	$set_default = "UPDATE ".$pdo_t['t_priorities']." SET Def =  '1' WHERE  `Level_ID` = :lid";
	
	$q_set = $pdo_conn->prepare($set_default);
	$q_set->execute(array(":lid" => $lid));

	// set default to 0 on all other categories
	$unset_default = "UPDATE ".$pdo_t['t_priorities']." SET Def =  '0' WHERE  `Level_ID` != :lid";

	$q_unset = $pdo_conn->prepare($unset_default);
	$q_unset->execute(array(":lid" => $lid));

	// refresh page and send to categories section
	header('Location: '.$_SERVER['REQUEST_URI']);

}

// delete priority
function aaModelDeletePriority($pid) {

	global $pdo_conn, $pdo_t;	

	$sql = "DELETE FROM ".$pdo_t['t_priorities']." WHERE Level_ID = :pid";
		
	$q = $pdo_conn->prepare($sql);
	$q->execute(array(":pid" => $pid));
		
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}

// shuffle order of priority for dropdown boxes
function aaModelReorderPriority($action, $priority_id, $order_id) {

	global $pdo_conn, $pdo_t;	

	$moveup = $order_id - 1;
	$movedown = $order_id + 1;

	if ($action == "up") {
		
		$sql = "SELECT Level_ID FROM ".$pdo_t['t_priorities']." WHERE OrderID < :order_id ORDER BY OrderID DESC LIMIT 1";
		$priorities = $pdo_conn->prepare($sql);
		$priorities->execute(array("order_id" => $order_id));
		
		$previous_priority = $priorities->fetch();
		$previous_priority = $previous_priority["Level_ID"];

		$set_previous = "UPDATE ".$pdo_t['t_priorities']." SET OrderID = :order_id WHERE Level_ID = :previous_id LIMIT 1";
		$q1 = $pdo_conn->prepare($set_previous);
		$q1->execute(array("order_id" => $order_id, "previous_id" => $previous_priority));

		$set_current = "UPDATE ".$pdo_t['t_priorities']." SET OrderID = :order_id WHERE Level_ID = :level_id";
		$q2 = $pdo_conn->prepare($set_current);
		$q2->execute(array("order_id" => $moveup, "level_id" => $priority_id));

		header('Location: '.$_SERVER['PHP_SELF'].'?p=settings-priority');

	} else if ($action == "down") {
		
		$sql = "SELECT Level_ID FROM ".$pdo_t['t_priorities']." WHERE OrderID > :order_id ORDER BY OrderID ASC LIMIT 1";
		$priorities = $pdo_conn->prepare($sql);
		$priorities->execute(array("order_id" => $order_id));
		
		$next_priority = $priorities->fetch();
		$next_priority = $next_priority["Level_ID"];

		$set_previous = "UPDATE ".$pdo_t['t_priorities']." SET OrderID = :order_id WHERE Level_ID = :next_id LIMIT 1";
		$q1 = $pdo_conn->prepare($set_previous);
		$q1->execute(array("order_id" => $order_id, "next_id" => $next_priority));

		$set_current = "UPDATE ".$pdo_t['t_priorities']." SET OrderID = :order_id WHERE Level_ID = :level_id";
		$q2 = $pdo_conn->prepare($set_current);
		$q2->execute(array("order_id" => $movedown, "level_id" => $priority_id));

		header('Location: '.$_SERVER['PHP_SELF'].'?p=settings-priority');

	}
	
}

?>
