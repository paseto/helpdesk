<?php
// include core library functions
require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();

// set variable for get id
$tuid = $_POST["p_tuid"];

$delete_ticket_update = "DELETE FROM ".$pdo_t['t_ticket_updates']." WHERE ID = :tuid";
 
$q = $pdo_conn->prepare($delete_ticket_update);
$q->execute(array(':tuid' => $tuid));
?>