<?php
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";

$pdo_conn = pdo_conn();
// set date format from settings
$date_format = get_settings('Date_Format');
// set variable for get id
@$cid = $_POST["p_cid"];
@$crid =  $_POST['p_crid'];

// get any new chat updates from user
$sql_chat_updates = "SELECT *,DATE_FORMAT(ups.Updated_At, '%H:%i:%s') AS Up_At 
					FROM ".$pdo_t['t_ticket']." AS t
					LEFT JOIN ".$pdo_t['t_ticket_updates']." AS ups ON t.ID = ups.Ticket_ID
					LEFT JOIN ".$pdo_t['t_users']." AS tu ON tu.UID = ups.Update_By 
					WHERE ups.Ticket_ID = :cid AND ups.ID > :crid
					ORDER BY Up_At ASC";
$q_chat_updates = $pdo_conn->prepare($sql_chat_updates);
$q_chat_updates->execute(array('cid' => $cid, 'crid' => $crid));					

$chat_updates = $q_chat_updates->fetchAll();	

foreach($chat_updates as $chat_update) {

	// if guest the users name or agent name
	$name = ($chat_update["Fname"] == NULL) ? $chat_update["Update_By"] : $chat_update["Fname"];

	$aachat_bgcolor = (is_numeric($chat_update["Update_By"])) ? "staff" : "user";				
	?>
	<div  class="ticket-message layout-padding <?php echo $aachat_bgcolor; ?>">
		<input type="hidden" class="aachat_status" value="<?php echo $chat_update["Status"]; ?>" />
		<input type="hidden" class="aachat_user" value="<?php echo $chat_update["Update_By"]; ?>" />
		<input type="hidden" class="last_crid" value="<?php echo $chat_update['ID']; ?>" />
		<span style="float:left"><b><?php echo $name; ?></b></span>
		<span style="float:right"><?php echo $chat_update["Up_At"]; ?></span>
		<p style="clear:both">
		<?php echo decode_entities($chat_update["Notes"]); ?>
		</p>
	</div>
	<?php
}
?>

	