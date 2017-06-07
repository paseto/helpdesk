<?php
require_once "../../lib/db.php";
require_once "../../lib/global.php";

$pdo_conn = pdo_conn();
$now = timezone_time();

@$cid = $_POST["p_cid"]; // chat id
@$uid =  $_POST["p_uid"]; // agent id
@$creply = clean($_POST["p_cureply"], true); // chat reply

$sql_chat_post = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
				VALUES (:cid, :uid, :now, :type, :timespent, :reply, :public)"; 
$q_chat_post = $pdo_conn->prepare($sql_chat_post);
$q_chat_post->execute(array('cid' => $cid, 'uid' => $uid, 'now' => $now, 'type' => 'Update', 'timespent' => 1, 'reply' => $creply, 'public' => 1));

// update activity for agent
$sql_chat_time = "UPDATE ".$pdo_t['t_users']." SET Chat_Time = :now WHERE UID = :uid";
$q_chat_time = $pdo_conn->prepare($sql_chat_time);
$q_chat_time->execute(array('now' => $now, 'uid' => $uid));
?>
<div class="staff-msg">
    <div class="pad10">
    <span style="float:left"><b>You</b></span>
    <span style="float:right"><?php echo $now; ?></span>
    <p style="clear:both;"><?php echo decode_entities($_POST['p_cureply']); ?></p>
    </div>
</div>
