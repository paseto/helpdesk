<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
// include core library functions
session_start();
require_once "../lib/db.php";
require_once "../lib/global.php";
$pdo_conn = pdo_conn();
		
$s_uid = $_SESSION['a']['aauid'];

// reset any ticket/chat collisions to zero - fail safe
$sql_c = "UPDATE ".$pdo_t['t_ticket']." SET Collision = :coll WHERE Collision = :uid";
$q_c = $pdo_conn->prepare($sql_c);
$q_c->execute(array("coll" => 0, "uid" => $s_uid));

// logout of live chat
$sql_chat = "UPDATE ".$pdo_t['t_users']." SET Chat_Status = :cs WHERE UID = :uid";
$q_chat = $pdo_conn->prepare($sql_chat);
$q_chat->execute(array("cs" => 0, "uid" => $s_uid));

// clear session vars for agent and tickets page
unset($_SESSION['a'],
$_SESSION["filter_agents"],
$_SESSION["filter_groups"],
$_SESSION["filter_status"],
$_SESSION["filter_priority"],
$_SESSION["filter_sortby"],
$_SESSION["filter_sortdir"],
$_SESSION["filter_dateadded"],
$_SESSION["filter_slar_due"],
$_SESSION["filter_slaf_due"]);

header('Location: index.php');
?>
</body>
</html>
<?php
ob_end_flush();
?>