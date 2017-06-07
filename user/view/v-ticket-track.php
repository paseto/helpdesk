<?php
if (!isset($_GET["guest"])) {
	if ($db_user_reg  == 1) {
		if (!isset($_SESSION['u']['aauid']) || ($_SESSION['u']['aaurole'] != 0)) {
			@header ("Location: index.php?p=user-access&r=ticket-track");
		}
	}
}

// if tracking button clicked
if (isset($_POST["track_submit"])) {
	
	aaModelGuestTrack ($_POST["track_email"], $_POST["track_ticketno"]);
	
}
?>
<div class="margin-body form" style="clear:both">

    <h2><?php echo $lang['u-ticket-track-title']; ?></h2>
    <hr />
    
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="track">
   
    <?php  echo read_session('track-error'); ?>
    <div class="form-field">
    <label><?php echo $lang['u-ticket-track-t-em']; ?></label>
	<input name="track_email" type="text" placeholder="<?php echo $lang['u-ticket-track-t-em']; ?>" value="<?php cached_fields(@$_POST['track_email']) ?>"/>
    </div>
	
	<div class="form-field">
    <label><?php echo $lang['u-ticket-track-t-no']; ?></label>
    <input name="track_ticketno" type="text" placeholder="<?php echo $lang['u-ticket-track-t-no']; ?>" value="<?php cached_fields(@$_POST['track_ticketno'])?>"/>
    </div>
	
    <p><input class="btn" name="track_submit" type="submit" value="<?php echo $lang['u-ticket-track-submit']; ?>" /></p>
    
    </form>
        
</div>