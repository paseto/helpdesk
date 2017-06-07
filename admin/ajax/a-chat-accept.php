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
$tid = $_POST["p_tid"];
$uid = $_POST["p_uid"];

$accept_str = $lang['aachat-chatting-with']." ".$_SESSION['a']['aaname'];

$sql_chat_status = "UPDATE ".$pdo_t['t_ticket']." SET Owner = :uid, Date_Updated = :now WHERE ID = :tid";
$q_chat_status = $pdo_conn->prepare($sql_chat_status );
$q_chat_status->execute(array('uid' => $uid, 'now' => $now, 'tid' => $tid));

$sql_chat_accept = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
					VALUES (:tid, :uid, :now, :type, :timespent, :chgstr, :public)";
$q_chat_accept = $pdo_conn->prepare($sql_chat_accept );
$q_chat_accept->execute(array('tid' => $tid, 'uid' => $uid, 'now' => $now, 'type' => 'Change', 'timespent' => 1, 'chgstr' => $accept_str, 'public' => 1));
?>