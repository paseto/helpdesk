<?php
// include db info
require_once "../lib/db.php";
require_once "../lib/global.php";

$pdo_conn = pdo_conn();

$cid = $_POST['p_cid'];
$cureply = clean($_POST['p_cureply'], TRUE);
$cname = clean($_POST['p_cname'], TRUE);

// current time for timezone set
$now = timezone_time();

$sql_chat_post = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Notes, Update_Emailed) 
				VALUES (:cid, :name, :now, :type, :reply, :public)";
$q_chat_post = $pdo_conn->prepare($sql_chat_post);
$q_chat_post->execute(array('cid' => $cid, 'name' => $cname, 'now' => $now, 'type' => 'Update', 'reply' => $cureply, 'public' => 1));				
?>
<div class="msg-u">
<b>You</b>
<span class="chattime"></span>
<br />
<?php echo nl2br($_POST['p_cureply']); ?>
</div>
