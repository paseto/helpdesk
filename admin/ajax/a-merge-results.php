<?php
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';
$pdo_conn = pdo_conn();
$fromtid = $_POST["from_tid"];
$mergedata = $_POST["merge_data"];

$date_format = get_settings('Date_Format');

// get data of ticket to be merged
$sql_from_ticket = "SELECT ID, User, Message, Status, Date_Added, Files FROM ".$pdo_t['t_ticket']." WHERE ID = :fromtid";
$q_from_ticket = $pdo_conn->prepare($sql_from_ticket);
$q_from_ticket->execute(array('fromtid' => $fromtid));
$merge_from_ticket = $q_from_ticket->fetch();

// get data of ticket to be merged to
$sql_to_tickets = "SELECT ID, Subject, Status, Date_Added FROM ".$pdo_t['t_ticket']." WHERE ID = :mergedata";
$q_to_tickets = $pdo_conn->prepare($sql_to_tickets);
$q_to_tickets->execute(array('mergedata' => $mergedata));
$merge_ticket = $q_to_tickets->fetch();

if ($merge_ticket["Status"] == "Closed") {
	
	echo "<div id=\"inner_merge_results\">".$lang['ticket-merge-closed']."</div>";
	
} else if (empty($merge_ticket)) {
	
	echo "<div id=\"inner_merge_results\">".$lang['ticket-merge-na']."</div>";

} else {
?>
<form method="post">
<div id="inner_merge_results">
<input name="merge_ticket" type="radio" value="1" checked />
<input style="display:none" id="merge_from_tid" value="<?php echo $merge_from_ticket["ID"]; ?>" />
<input style="display:none" id="merge_tid" value="<?php echo $merge_ticket["ID"]; ?>" />
<input style="display:none" id="merge_from_user" value="<?php echo $merge_from_ticket["User"]; ?>" />
<input style="display:none" id="merge_from_message" value="<?php echo $merge_from_ticket["Message"]; ?>" />
<input style="display:none" id="merge_from_dateadd" value="<?php echo $merge_from_ticket["Date_Added"]; ?>" />
<input style="display:none" id="merge_from_files" value="<?php echo $merge_from_ticket["Files"]; ?>" />

<?php 	echo $merge_ticket["ID"]." ".$merge_ticket["Subject"]." ".$merge_ticket["Date_Added"]; ?>
</div>
<p><input id="complete_merge" name="merge" type="submit" value="Merge" /></p>
</form>
<?php
}
?>