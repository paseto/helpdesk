<?php
$loguid = $_SESSION['a']['aauid'];

// chat id
$cid = $_GET["cid"];

// date format
$date_format = get_settings('Date_Format');

$sql_chat = "SELECT DATE_FORMAT(Date_Added, '$date_format') AS DateAddFull, DATE_FORMAT(Date_Added, '%H:%i:%s') AS DateAdd, ID, User, Status, Subject, Message, IP_Address, Page_Referer, Browser, Owner 
			FROM ".$pdo_t['t_ticket']." WHERE ID = '$cid'";
$q_chat = $pdo_conn->prepare($sql_chat);
$q_chat->execute();
$chat = $q_chat->fetch();

?>
<style>
html,body{
	overflow:hidden;
}
</style>

<div id="tid" tid="<?php echo $cid; ?>" uid="<?php echo $loguid; ?>"></div>
	
    <div id="layout-body-left-width">&nbsp;</div>
    <div id="layout-body-left" class="layout-padding">

        <h2><?php echo $lang['ticket-details-title']; ?></h2>
		<strong><?php echo $lang['aachat-name']; ?></strong>
        <p><?php echo $chat["User"]; ?></p>
        <p><strong><?php echo $lang['aachat-subject']; ?></strong></p>
        <p><?php echo $chat["Subject"]; ?></p>
        <p><strong><?php echo $lang['aachat-dt']; ?></strong></p>
        <p><?php echo $chat["DateAddFull"]; ?></p>
        <p><strong><?php echo $lang['aachat-ip']; ?></strong></p>
        <p><?php echo $chat["IP_Address"]; ?></p>
        <p><strong><?php echo $lang['aachat-refer']; ?></strong></p>
        <p><?php echo $chat["Page_Referer"]; ?></p>
        <p><strong><?php echo $lang['aachat-browser']; ?></strong></p>
        <p><?php echo $chat["Browser"]; ?></p>

    </div>

<div id="body-chat">
    <div id="table_header">
        <div id="table_generic">
        	<?php
			// if not accepted
			if ($chat['Owner'] == NULL) {
            
				echo '<a href="#" id="aachat-accept" title="'.$lang['tickets-status-accept'].'"><i class="fa fa-thumbs-up"></i></a>';
			
			}
			
			if ($chat['Owner'] != NULL && $chat["Owner"] == $loguid && $chat["Status"] != "Closed") {
				
            	echo '<a href="#" id="aachat-done" title="Chat Completed"><i class="fa fa-check"></i></a>';
				
			}
			
			?>
        </div>
	</div>
	<div id="table_header_fixed_height">&nbsp;</div>    
    
        <div id="aa-chat-message" class="layout-padding">
    	<div class="ticket-message layout-padding">

            <span style="float:left"><b><?php echo $chat["User"]; ?></b></span>
            <span style="float:right"><?php echo $chat["DateAdd"]; ?></span>
            <p style="clear:both">
            <?php echo $chat["Message"]; ?>
			</p>

		</div>
        </div>
        
        <div id="aa-chat-form">
        <div class="form layout-padding">
    	<div class="error-msg" id="aa_collision"><?php echo $lang['ticket-status-collide']; ?></div>
    	<?php
        // if ticket status is set to close then don't show the update form.
        if ($chat["Status"] == "Closed") {
            
            echo "<div id=\"aa_ticket_error\" class=\"error-msg\"><div class=\"pad10\">".$lang['aachat-status-closed']."</div></div>";
            $show_form = false;
       
        } else if ($chat["Owner"] == NULL) {
            
            echo "<div id=\"aa_ticket_error\" class=\"error-msg\"><div class=\"pad10\">".$lang['aachat-status-unassigned']." <i class=\"fa fa-thumbs-up\"></i></div></div>";
            $show_form = false;
        
        // ticket not owned by logged in agent
        } else if ($chat["Owner"] != $loguid) {
            
            echo "<div id=\"aa_ticket_error\" class=\"error-msg\"><div class=\"pad10\">".$lang['aachat-status-notowner']."</div></div>";
            $show_form = false;
            
        // ticket is owned by logged in agent
        } else {
            
            $show_form = true;
    
        }
		?>
		<?php      
        if ($show_form) {
        ?>

        <form action="" method="post">
        <p><textarea id="chat_reply" class="notinymce" name="chat_reply" cols="" rows="3"></textarea></p>
        </form>
     
        <?php
		} // end show form
		?>
        </div>
        </div>
        
</div>
<div id="layout-body-right" class="livechat">
	<div id="aa_chats"></div>
</div>