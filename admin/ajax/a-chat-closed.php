<?php
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';

$pdo_conn = pdo_conn();

// set date format from settings
$date_format = get_settings('Date_Format');

// get timezone time to use for inserting and updating records
$now = timezone_time();

// set variable for get id
$cid = $_POST["p_cid"];
$uid = $_POST["p_uid"];

$chat_str = $lang['aachat-chatting-ended']." ".$_SESSION['a']['aaname'];

// set new status and update time of original ticket
$sql_chat_status = "UPDATE ".$pdo_t['t_ticket']." SET Status = 'Closed', Date_Closed = :now WHERE ID = :cid";
$q_chat_status = $pdo_conn->prepare($sql_chat_status);
$q_chat_status->execute(array('now' => $now, 'cid' => $cid));

// insert update of ticket accept
$sql_chat_done = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) VALUES ('$cid', '$uid', '$now', 'Change', 1, '$chat_str', 1)";
$q_chat_done = $pdo_conn->prepare($sql_chat_done);
$q_chat_done->execute();
?>