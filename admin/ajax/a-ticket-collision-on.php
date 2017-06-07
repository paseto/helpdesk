<?php
// include core library functions
require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();

$date_format = get_settings('Date_Format');

// set variable for get id
$tid = $_POST["p_tid"];
$uid = $_POST["p_uid"];

$now = timezone_time();

$sel_collision = "SELECT Fname,Collision,DATE_FORMAT(Collision_Time, '$date_format') AS Collision_DT FROM ".$pdo_t['t_ticket']." AS t LEFT JOIN ".$pdo_t['t_users']." AS u ON t.Collision = u.UID WHERE ID = :tid";
 
$q = $pdo_conn->prepare($sel_collision);
$q->execute(array(':tid' => $tid));
$collision = $q->fetch();

if ($collision['Collision'] == 0) {

	$set_collision = "UPDATE ".$pdo_t['t_ticket']." SET Collision = :uid, Collision_Time = :now WHERE ID = :tid";
	 
	$q = $pdo_conn->prepare($set_collision);
	$q->execute(array(':uid' => $uid, ':now' => $now, ':tid' => $tid));

} else {
	echo $tid.' '.$uid;
	echo $collision["Collision_DT"]." - ".$collision["Fname"]." ";

}
?>