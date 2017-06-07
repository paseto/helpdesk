<?php
require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();

// set variable for get id
$tid = $_POST["p_tid"];
$files_to_delete = "../".$_POST["p_filefolder"]."/"; // add relevant path and closing slash

aaFileDelete($files_to_delete);

// delete ticket and ticket updates from database	
$sql_t_d = "DELETE FROM ".$pdo_t['t_ticket']." WHERE ID = :tid";
$q_t_d = $pdo_conn->prepare($sql_t_d);
$q_t_d->execute(array('tid' => $tid));

$sql_tu_d = "DELETE FROM ".$pdo_t['t_ticket_updates']." WHERE Ticket_ID = :tid";
$q_tu_d = $pdo_conn->prepare($sql_tu_d);
$q_tu_d->execute(array('tid' => $tid));
?>