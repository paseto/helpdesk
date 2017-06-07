<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>    
    <h2><?php echo $lang['set-aachat-title']; ?></h2>
    <p><?php echo $lang['set-aachat-title-desc']; ?></p>
    <hr />
	<?php
    // update ticket settings
    if (isset($_POST["Save_aachat"])) {
    
        aaModelSaveSettingsLiveChat(@$_POST["set_aachat_on"], $_POST["set_aachat_idletime"]);
            
    }
    ?>
    <form name="set_aachat" id="set_aachat" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">        
    
    <?php
    $db_lc_enable = get_settings("LiveChat_Enable");
    
    if ($db_lc_enable == '1') {
        $checked_en = 'checked';
    }
    ?>
    <div class="form-field">
    <input id="set_aachat_on" name="set_aachat_on" type="checkbox" value="1" <?php echo @$checked_en; ?> />
    <label for="set_aachat_on"><?php echo $lang['set-aachat-db-enlc']; ?></label>		
	</div>
    
    <div class="form-field">    
    <label for="set_aachat_idletime"><?php echo $lang['set-aachat-db-lcit']; ?> <i class="link-color help fa fa-question" title="<?php echo $lang["set-aachat-db-lcit-desc"]; ?>"></i></label>		
    <input id="set_aachat_idletime" name="set_aachat_idletime" type="text" value="<?php echo get_settings("LiveChat_Idle_Time"); ?>" />
	</div>

    <p><input class="btn" name="Save_aachat" type="submit" value="<?php echo $lang["generic-save"]; ?>" /></p>
    
    </form>
</div>