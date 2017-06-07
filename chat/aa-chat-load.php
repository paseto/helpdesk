<?php
session_start();

// include db info
require_once "../lib/db.php";
require_once "../lib/global.php";
require '../public/language/english.php';

$pdo_conn = pdo_conn();
$now = timezone_time();

// set date format from settings
$date_format = get_settings('Date_Format');
// set variable for get id
@$cid = $_GET["g_cid"];

// select initial chat
$sql_chat = "SELECT *, DATE_FORMAT(Date_Added, '$date_format') AS Date_Add FROM ".$pdo_t['t_ticket']." WHERE ID = '$cid'";
$q_chat = $pdo_conn->prepare($sql_chat);
$q_chat->execute();

$chat = $q_chat->fetch();

// select chat updates
$sql_chat_updates = "SELECT *,DATE_FORMAT(ups.Updated_At, '$date_format') AS Up_At 
			FROM ".$pdo_t['t_ticket_updates']." AS ups LEFT JOIN ".$pdo_t['t_users']." AS tu ON tu.UID = ups.Update_By 
			WHERE ups.Ticket_ID = '$cid'
			ORDER BY Up_At ASC";
$q_chat_updates = $pdo_conn->prepare($sql_chat_updates);
$q_chat_updates->execute();

$f_chat_updates = $q_chat_updates->fetchAll();



?>

<div class="msg-u">
    <span style="float:left"><b><?php echo $chat["User"]; ?></b></span>
    <span style="float:right"><?php echo $chat["Date_Add"]; ?></span>
    <p style="clear:both">
    <?php echo nl2br(decode_entities($chat["Message"])); ?>
    </p>
</div>

<br />

<div class="msg-a">
<?php echo $lang['u-aachat-advisor']; ?>
</div>


<?php
// print chat updates
foreach($f_chat_updates as $chat_update) {
//while ($chat_update = @mysqli_fetch_array($sel_chat_updates)) {

	// if guest the users name or agent name
	$name = ($chat_update["Fname"] == NULL) ? $chat_update["Update_By"] : $chat_update["Fname"]." ".$chat_update["Lname"];
	
	$aachat_bgcolor = (is_numeric($chat_update["Update_By"])) ? "msg-a" : "msg-u";				
	?>
	<br />
	<div class="<?php echo $aachat_bgcolor; ?>">
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

	