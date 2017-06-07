<?php
require_once "../lib/db.php";
require_once "../lib/global.php";
require '../public/language/english.php';

$pdo_conn = pdo_conn();
$now = timezone_time();
$allowed_agent_idle_time = get_settings("LiveChat_Idle_Time");

// select logged on agents between now and set allowed idle time
$sql_chat = "SELECT COUNT(*) AS Agent_Status FROM ".$pdo_t['t_users']." WHERE Chat_Status = 1 AND Chat_Time BETWEEN ('$now' - INTERVAL $allowed_agent_idle_time MINUTE) AND '$now'";
$q_chat = $pdo_conn->prepare($sql_chat);
$q_chat->execute();

$chat = $q_chat->fetch();

// status for online or offline
$chat_status = ($chat["Agent_Status"] >= 1) ? "online" : "offline";
// text for chat
$chat_status_text = ($chat["Agent_Status"] >= 1) ? "<span id=\"online\">".$lang['u-aachat-online']."</span>" : "<span id=\"offline\">".$lang['u-aachat-offline']."</span><br />".$lang['u-aachat-offline-desc'];
?>
<div id="example-widget-container"><?php echo $lang['u-aachat-help']; ?></div>

<div id="aa-widget">
<div id="form">
    <div id="form-banner">
        <span class="footer" style="float:left;">Powered by <a href="http://www.acornaid.com" target="_blank">Acorn Aid</a></span>
        <span class="footer" style="float:right;"><a id="aa-widget-close" href="#">x</a></span>
    </div>
    <div class="form-inner">
        <?php echo $chat_status_text; ?><br /><br />
        <form id="aa-widget-form" action="aa-chat-add.php" method="post">
        <input id="widget-name" name="widget-name" type="text" placeholder="Name" autocomplete="off" />
        <input id="widget-email" name="widget-email" type="text" placeholder="Email Address" autocomplete="off" />
        <input id="widget-subject" name="widget-subject" type="text" placeholder="Subject" autocomplete="off" />
        <textarea id="widget-msg" name="widget-msg" cols="" rows="4" placeholder="Message" autocomplete="off"></textarea>
        <input id="aa-chat-status" name="aa-chat-status" type="hidden" value="<?php echo $chat_status; ?>" />        
        <p><input id="widget-send" name="widget-send" type="submit" value="<?php echo $lang['u-aachat-send']; ?>" /></p>
        </form>
    </div>
</div>
</div>