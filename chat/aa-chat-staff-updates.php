
<?php
@$cid = $_POST['wtid'];
@$crid = $_POST['p_crid'];

// include db info
require_once "../lib/db.php";
require_once "../lib/global.php";

$pdo_conn = pdo_conn();

$sql_chat = "SELECT t.Status,u.Fname FROM ".$pdo_t['t_ticket']." AS t 
			LEFT JOIN ".$pdo_t['t_users']." AS u ON u.UID = t.Owner
			WHERE ID = :cid";
$q_chat = $pdo_conn->prepare($sql_chat);
$q_chat->execute(array('cid' => $cid));
// fetch initial chat
$chat = $q_chat->fetch();

$sql_chat_updates = "SELECT tu.*, DATE_FORMAT(tu.Updated_At, '%H %i') AS DateUp, u.*
					FROM ".$pdo_t['t_ticket_updates']." AS tu
					LEFT JOIN ".$pdo_t['t_users']." AS u ON u.UID=tu.Update_By
					WHERE tu.Ticket_ID = :cid AND tu.ID > :crid AND tu.Update_By REGEXP '[0-9]+' ORDER BY tu.Updated_At ASC";
$q_chat_updates = $pdo_conn->prepare($sql_chat_updates);
$q_chat_updates->execute(array('cid' => $cid, 'crid' => $crid));
// fetch chat updates
$no_chat_updates = $q_chat_updates->rowCount();
$chat_updates = $q_chat_updates->fetchAll();
//print_r($chat_updates);
if($no_chat_updates > 0) {
	echo '<div class="msg-a">';
	echo '<b>'.decode_entities($chat["Fname"]).'</b>';
	
	foreach ($chat_updates as $chat_update) {	

		if (@$chat_update['Notes'] != "") {
			echo '<input type="hidden" class="last_crid" value="'.$chat_update['ID'].'" />
				<input type="hidden" class="aa-chat-status" value="'.$chat["Status"].'" />';

			echo '<br>'.strip_tags(html_entity_decode($chat_update['Notes']));
			echo '<span class="chattime"></span>';
		}
		
	}

	echo '</div>';
	
}
?>

