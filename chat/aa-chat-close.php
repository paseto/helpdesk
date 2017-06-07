<?php
// include db info
require_once "../lib/db.php";
require_once "../lib/global.php";

$pdo_conn = pdo_conn();

$cid = $_POST['p_cid'];
$cname = $_POST['p_name'];

$aachat_close = 'Chat closed by user';

// current time for timezone set
$now = timezone_time();

$sql_chat_close = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Notes, Update_Emailed) 
					VALUES (:cid, :cname, :cdateup, :ctype, :chgstr, :public)";  
$q_chat_close = $pdo_conn->prepare($sql_chat_close);
$q_chat_close->execute(array('cid' => $cid, 'cname' => $cname, 'cdateup' => $now, 'ctype' => 'Update', 'chgstr' => $aachat_close, 'public' => 1));		

$sql_chat_closed = "UPDATE ".$pdo_t['t_ticket']." SET Status = :astat, Date_Closed = :adateclosed WHERE ID = :cid";
$q_chat_closed = $pdo_conn->prepare($sql_chat_closed);
$q_chat_closed->execute(array('astat' => 'Closed', 'adateclosed' => $now, 'cid' => $cid));				

session_start();
unset($_SESSION["aachat-id"],
	$_SESSION["aachat-name"],
	$_SESSION["aachat-email"],
	$_SESSION["aachat-sub"],
	$_SESSION["aachat-msg"],
	$_SESSION["aachat-email_format_reply"]);

?>