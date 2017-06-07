<?php
session_start();

// include db info
require_once "../lib/db.php";
require_once "../lib/global.php";
require '../public/language/english.php';

$pdo_conn = pdo_conn();
$now = timezone_time();

// define widget variables
$aachat_name = clean($_POST['widget-name'], TRUE);
$aachat_email = clean($_POST['widget-email'], TRUE);
$aachat_subject = clean($_POST['widget-subject'], TRUE);
$aachat_msg = clean($_POST['widget-msg'], TRUE);
$aachat_msg_email = $_POST['widget-msg'];

$aachat_ip = $_SERVER['REMOTE_ADDR'];
$aachat_referer = $_SERVER['HTTP_REFERER'];
$ua=getBrowser();
$aachat_browser = $ua['name']." ".$ua['version']." [".$ua['platform']."]";

// set group and priority
$sql_gp = "SELECT * FROM ".$pdo_t['t_priorities']." AS p, ".$pdo_t['t_groups']." AS g WHERE g.Def = 1 AND p.Def = 1";
$q_gp = $pdo_conn->prepare($sql_gp);
$q_gp->execute();
$gp = $q_gp->fetch();

$group = $gp['Cat_ID'];
$priority = $gp['Level_ID'];
//$assignment = aaModelGetTicketAssignment($group);

// insert into ticket table
$sql_insert_chat = "INSERT INTO ".$pdo_t['t_ticket']." (User, User_Email, Cat_ID, Level_ID, Type, Subject, Message, IP_Address, Page_Referer, Browser, Status, Owner, Date_Added, Date_Updated)
VALUES (:aname, :aemail, :agroup, :apri, :type, :asub, :amsg, :aip, :aref, :abrow, :astat, :astatus, :adateadd, :adateup)";  
$sql_insert_chat = $pdo_conn->prepare($sql_insert_chat);
$sql_insert_chat->execute(array(
				'aname' => $aachat_name,
				'aemail' => $aachat_email,
				'agroup' => $group,
				'apri' => $priority,
				'type' => 'Chat',
				'asub' => $aachat_subject,
				'amsg' => $aachat_msg,
				'aip' => $aachat_ip,
				'aref' => $aachat_referer,
				'abrow' => $aachat_browser,
				'astat' => 'Open',
				'astatus' => NULL,
				'adateadd' => $now,
				'adateup' => $now
				));

// get id of record inserted
$_SESSION["aachat-id"] = $pdo_conn->lastInsertId();	
$_SESSION["aachat-name"] = $aachat_name;
$_SESSION["aachat-email"] = $aachat_email;
$_SESSION["aachat-sub"] = $aachat_subject;
$_SESSION["aachat-msg"] = $aachat_msg;
$_SESSION["aachat-email_format_reply"] = $aachat_msg_email;

header("Location: aa-chat-active.php");

?>
