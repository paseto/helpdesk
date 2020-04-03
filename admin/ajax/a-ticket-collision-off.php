<?php
// include core library functions
require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();

// set variable for get id
$tid = $_POST["p_tid"];
$uid = $_POST["p_uid"];

//$unset_collision = "UPDATE ".$pdo_t['t_ticket']." SET Collision = '0' WHERE ID = :tid AND Collision = :uid";
$unset_collision = "UPDATE ".$pdo_t['t_ticket']." SET Collision = '0' WHERE Collision = :uid";

$q = $pdo_conn->prepare($unset_collision);
$q->execute(array(':uid' => $uid, ':tid' => $tid));
?>