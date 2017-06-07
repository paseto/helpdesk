<?php
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";

$pdo_conn = pdo_conn();
$now = timezone_time();
$loguid = $_SESSION['a']['aauid'];

$aachat_status = $_POST["p_status"];

// go online or offlien for chat
$sql_chat_online = "UPDATE ".$pdo_t['t_users']." SET Chat_Status = $aachat_status, Chat_Time = '$now' WHERE UID = '$loguid'";
$q_chat_online = $pdo_conn->prepare($sql_chat_online);
$q_chat_online->execute();
?>