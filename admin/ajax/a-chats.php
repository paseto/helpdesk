<?php

session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';

$pdo_conn = pdo_conn();
$now = timezone_time();
$allowed_agent_idle_time = get_settings("LiveChat_Idle_Time");
$loguid = $_SESSION['a']['aauid'];

$sql_new_chats = "SELECT * FROM ".$pdo_t['t_ticket']." WHERE Type = 'Chat' AND Owner IS NULL AND Status != 'Closed'";
$q_new_chats = $pdo_conn->prepare($sql_new_chats);
$q_new_chats->execute();
$f_new_chats = $q_new_chats->fetchAll();
$no_new_chats = $q_new_chats->rowCount();

$sql_my_chats = "SELECT * FROM ".$pdo_t['t_ticket']." WHERE Type = 'Chat' AND Owner = '$loguid' AND Status != 'Closed'";
$q_my_chats = $pdo_conn->prepare($sql_my_chats);
$q_my_chats->execute();
$f_my_chats = $q_my_chats->fetchAll();
$no_my_chats = $q_my_chats->rowCount();

$sql_other_chats = "SELECT * FROM ".$pdo_t['t_ticket']." WHERE Type = 'Chat' AND Owner != '$loguid' AND Status != 'Closed'";
$q_other_chats = $pdo_conn->prepare($sql_other_chats);
$q_other_chats->execute();
$f_other_chats = $q_other_chats->fetchAll();
$no_other_chats = $q_other_chats->rowCount();

// get status to determine if online or offline
$sql_chat_status = "SELECT Chat_Status FROM ".$pdo_t['t_users']." WHERE UID = '$loguid' AND Chat_Status = 1 AND Chat_Time BETWEEN ('$now' - INTERVAL $allowed_agent_idle_time MINUTE) AND '$now'";
$q_chat_status = $pdo_conn->prepare($sql_chat_status);
$q_chat_status->execute();
// 1 if online , 0 if offline
$aachat_status = $q_chat_status->rowCount();
?>
<input type="hidden" id="aachat-agent-status" name="aachat-agent-status" value="<?php echo $aachat_status; ?>" />    
<ul>
<?php
// online or offline button
if ($aachat_status >= 1) {
?>
<li class="online" id="aa-chat-status"><a href="#"><i class="fa fa-heart"></i> Online</a></li>
<li class="offline aa-chat-toggle" status="0"><a href="#"> Go Offline</a></li>

<!-- new chats -->
<li class="aa-chat-header"><strong><?php echo @$lang['set-aachat-newchat']; ?> [<?php echo $no_new_chats; ?>]</strong></li>
</ul>
<div id="aa-chat-new-values"> <!-- within div to detect any changes to new chat html -->
<ul>
<?php
foreach ($f_new_chats as $new_chats) {
//while ($new_chats = @mysqli_fetch_array($sel_new_chats)) {

	echo '<li class="aa-chat-conv"><i class="fa fa-comments"></i> '.$new_chats['User'].' - <a cid='.$new_chats['ID'].' href="p.php?p=chat&cid='.$new_chats['ID'].'">'.$new_chats['Subject'].'</a></li>';
	
}
?>
</ul>
</div>
<input type="hidden" id="aachat-new-status" name="aachat-new-status" value="<?php echo $no_new_chats; ?>" />    

<!-- my chats -->
<ul>
<li class="aa-chat-header"><strong><?php echo @$lang['set-aachat-mychat']; ?> [<?php echo $no_my_chats; ?>]</strong></li>
<?php
$no_my_pending = 0;
foreach($f_my_chats as $my_chats) {
//while ($my_chats = @mysqli_fetch_array($sel_my_chats)) {
	
	// get the last update by update by
	//$sel_my_chats_updates = mysqli_query($db, "SELECT DATE_FORMAT(Updated_At, '%H:%i:%s') AS DateUp, Update_By, Notes FROM $mysql_ticket_updates WHERE Ticket_ID = '".$my_chats["ID"]."' ORDER BY Updated_At DESC");
	//$my_chats_update = mysqli_fetch_array($sel_my_chats_updates);
	
	$sql_my_chats_updates = "SELECT DATE_FORMAT(Updated_At, '%H:%i:%s') AS DateUp, Update_By, Notes FROM ".$pdo_t['t_ticket_updates']." WHERE Ticket_ID = '".$my_chats["ID"]."' ORDER BY Updated_At DESC";
	$q_my_chats_updates = $pdo_conn->prepare($sql_my_chats_updates);
	$q_my_chats_updates->execute();
	$my_chats_update = $q_my_chats_updates->fetch();

	echo '<li class="aa-chat-conv"><i class="fa fa-comments"></i> '.$my_chats['User'].' - <a href="p.php?p=chat&cid='.$my_chats['ID'].'">'.$my_chats['Subject'].'</a>';
	
	// if update_by is not numeric then add pending message
	if(!is_numeric($my_chats_update["Update_By"])) {
		$no_my_pending = $no_my_pending+1;
		echo " - ".$lang['set-aachat-unread']." - ".$my_chats_update["DateUp"].'</span>';
	}
	
	echo '</li>';
	
}
?>
<input type="hidden" id="aachat-pending-status" name="aachat-pending-status" value="<?php echo $no_my_pending; ?>" /> <!-- value of pending chats -->   

<!-- other chats -->
<li class="aa-chat-header"><strong><?php echo @$lang['set-aachat-otherchat']; ?> [<?php echo $no_other_chats; ?>]</strong></li>
<?php
foreach($f_other_chats as $other_chats) {
//while ($other_chats = @mysqli_fetch_array($sel_other_chats)) {
	
	echo '<li class="aa-chat-conv"><i class="fa fa-comments"></i> '.$other_chats['User'].' - <a href="page.php?page=page.chat&cid='.$other_chats['ID'].'">'.$other_chats['Subject'].'</a></li>';

}
?>
<?php
} else {
// if agent idle status times out then set offline.	
$sql_chat_offline = "UPDATE ".$pdo_t['t_users']." SET Chat_Status = 0, Chat_Time = '$now' WHERE UID = '$loguid'";
$q_chat_offline = $pdo_conn->prepare($sql_chat_offline);
$q_chat_offline->execute();	
?>

<ul>
<li class="offline" id="aa-chat-status"><a href="#"><i class="fa fa-heart"></i> Offline</a></li>
<li class="online aa-chat-toggle" status="1"><a href="#">Go Online</a></li>
</ul>
<?php
}
?>


