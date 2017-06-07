<?php
session_start();
// include core library functions
require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();

$date_format = get_settings('Date_Format');

// set variable for get id
$tid = $_POST["p_tid"];
$uid = $_POST["p_uid"];

$now = timezone_time();

// select current logged in name from original ticket ID
$sel_user = "SELECT UID, Fname FROM ".$pdo_t['t_users']." WHERE UID = :uid";
$q = $pdo_conn->prepare($sel_user);
$q->execute(array(':uid' => $uid));
$c_user = $q->fetch();

// set new status and update time of original ticket
$set_owner = "UPDATE ".$pdo_t['t_ticket']." SET Owner = :uid, Date_Updated = :now WHERE ID = :tid";
$q = $pdo_conn->prepare($set_owner);
$q->execute(array(':uid' => $uid, ':now' => $now, ':tid' => $tid));


// insert update of ticket accept
$accept_str = "Aceito por ".$c_user["Fname"];

$add_update = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
				VALUES (:tid, :uid, :now, :status, :uptime, :note, :upemail)";
$q = $pdo_conn->prepare($add_update);
$q->execute(array(':tid' => $tid, ':uid' => $uid, ':now' => $now, ':status' => 'Change', ':uptime' => '1', ':note' => $accept_str, ':upemail' => '1'));
?>