<?php
// get agents by role and last name
function aaModelGetAgentByID($uid) {

	global $pdo_conn, $pdo_t;

	$sql = "SELECT * FROM ".$pdo_t['t_users']." WHERE UID = :uid";
	
	$q = $pdo_conn->prepare($sql);
	$q->execute(array("uid" => $uid));
	
	return $q;

}

// get agent skills
function aaModelGetGroupByAgentID($uid, $gid) {

	global $pdo_conn, $pdo_t;

	$sql = "SELECT UID FROM ".$pdo_t['t_users_skills']." WHERE UID = :uid AND CID = :gid";

	$q = $pdo_conn->prepare($sql);
	$q->execute(array("uid" => $uid, "gid" => $gid));
	
	return $q;
		
}
?>