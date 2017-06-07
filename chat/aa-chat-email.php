<?php

session_start();

// include db info
require_once "../lib/db.php";
require_once "../lib/global.php";

$pdo_conn = pdo_conn();
$date_format = get_settings('Date_Format');
$company = get_settings('Company_Name');

// set variable for get id
@$cid = $_POST["p_cid"];

// select initial chat
$sql_chat = "SELECT *, DATE_FORMAT(Date_Added, '$date_format') AS Date_Add FROM ".$pdo_t['t_ticket']." WHERE ID = :cid";
$q_chat = $pdo_conn->prepare($sql_chat);
$q_chat->execute(array('cid' => $cid));
$chat = $q_chat->fetch();

// select chat updates
$sql_chat_u = "SELECT *,DATE_FORMAT(ups.Updated_At, '$date_format') AS Up_At 
									FROM ".$pdo_t['t_ticket_updates']." AS ups 
									LEFT JOIN ".$pdo_t['t_users']." AS tu ON tu.UID = ups.Update_By 
									WHERE ups.Ticket_ID = :cid
									ORDER BY Up_At ASC";
$q_chat_u = $pdo_conn->prepare($sql_chat_u);
$q_chat_u->execute(array('cid' => $cid));
$chat_updates = $q_chat_u->fetchAll();

@$aachat_message .= '<p>
					<b>'.$chat["User"].'</b> '.$chat["Date_Add"].'
					<br>'.decode_entities($chat["Message"]).'</p>
					<hr />
					<p>'.$lang['u-aachat-advisor'].'</p>';

// print chat updates
// while ($chat_update = @mysqli_fetch_array($sel_chat_updates)) {
foreach($chat_updates as $chat_update) {

	// if guest the users name or agent name
	$name = ($chat_update["Fname"] == NULL) ? $chat_update["Update_By"] : $chat_update["Fname"];
	
	$aachat_message .= '<hr />
						<p><b>'.$name.'</b> '.$chat_update["Up_At"].'
						<br>'.decode_entities($chat_update["Notes"]).'</p>';
	
}

aaSendEmail($chat["User_Email"], $company." - Chat Email", $aachat_message);
?>