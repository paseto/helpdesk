<?php
// count number of KB articles per KB group. If greater than 1 then do allow to delete
function aaModelGetArticlesByKBGroup($kb_gid) {

	global $pdo_conn, $pdo_t;

    $sql = "SELECT COUNT(*) AS tcount FROM ".$pdo_t['t_kb']." WHERE KB_Group = :kb_gid";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('kb_gid' => $kb_gid));
	
	return $q;

}

// save new KB group
function aaModelSaveKBGroup ($kb_group) {

	global $pdo_conn, $pdo_t, $lang;
	
	// clean entered data using custom function
	$kb_group = clean($_POST["newgroup"], TRUE);
	
	// if field is blank
	if ($kb_group == "") {
	
		echo "<div class=\"error-msg\">".$lang["generic-error"]."</div>";
		
	// else insert into DB	
	} else {	
			
		$sql = "INSERT INTO ".$pdo_t['t_kb_groups']." (KB_Group) VALUES (:kb_group)";  
		$q = $pdo_conn->prepare($sql);
		$q->execute(array('kb_group' => $kb_group));
		
		// refresh page and send to categories section
		header('Location: '.$_SERVER['REQUEST_URI']);
	
	}

}

// delete KB group
function aaModelDeleteKBGroup($kb_gid) {

	global $pdo_conn, $pdo_t;

	$sql = "DELETE FROM ".$pdo_t['t_kb_groups']." WHERE KBGROUPID = :kb_gid";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('kb_gid' => $kb_gid));
	
	header('Location: '.$_SERVER['REQUEST_URI']);

}

?>
