<?php
// update ticket settings
if (isset($_POST["Save_KB"])) {

aaModelSaveKBSettings($_POST["set_kb_on"],
						$_POST["set_kb_author"],
						$_POST["set_kb_count"],
						$_POST["set_kb_rating"],
						$_POST["set_kb_share"],
						$_POST["set_kb_showx"]);
		
}
?>
<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>    

    <h2><?php echo $lang['set-kb-title']; ?></h2>
    <p><?php echo $lang['set-kb-title-desc']; ?></p>
    <hr />
    
    <form name="set_kb" id="set_kb" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">        
    
    <?php
    $db_kb_enable = get_settings("KB_Enable");
    
    if ($db_kb_enable == '1') {
        $checked_en = 'checked';
    }
    ?>
    
    <div class="form-field">
    <input id="set_kb_on" name="set_kb_on" type="checkbox" value="1" <?php echo @$checked_en; ?> />
    <label for="set_kb_on"><?php echo $lang['set-kb-db-enkb']; ?></label>		
    </div>
    
	<?php
    // author
    $db_kb_author = get_settings("KB_Author_Allow");
    
    if ($db_kb_author == '1') {
        $checked_au = 'checked';
    }
    ?>
    <div class="form-field">
    <input id="set_kb_author" name="set_kb_author" type="checkbox" value="1" <?php echo @$checked_au; ?> />
    <label for="set_kb_author"><?php echo $lang['set-kb-db-aukb']; ?></label>        
	</div>

    <?php
    // count
    $db_kb_count = get_settings("KB_Count");
    
    if ($db_kb_count == '1') {
        $checked_co = 'checked';
    }
    ?>
    
    <div class="form-field">
    <input id="set_kb_count" name="set_kb_count" type="checkbox" value="1" <?php echo @$checked_co; ?> />
    <label for="set_kb_count"><?php echo $lang['set-kb-db-cokb']; ?></label>        
	</div>
            
    <?php
    $db_kb_rating = get_settings("KB_Rating");		
    
    if ($db_kb_rating == '1') {
        $checked_ra = 'checked';
    }
    ?>
    <div class="form-field">
    <input id="set_kb_rating" name="set_kb_rating" type="checkbox" value="1" <?php echo @$checked_ra; ?> />
    <label for="set_kb_rating"><?php echo $lang['set-kb-db-rakb']; ?></label>                            
	</div>

    <?php
    $db_kb_share = get_settings("KB_Share");		
    
    if ($db_kb_share == '1') {
        $checked_sh = 'checked';
    }
    ?>
    <div class="form-field">
    <input id="set_kb_share" name="set_kb_share" type="checkbox" value="1" <?php echo @$checked_sh; ?> />
    <label for="set_kb_share"><?php echo $lang['set-kb-db-shkb']; ?></label>                            
	</div>

    <?php
    $db_kb_showx = get_settings("KB_Showx");		
    ?>
    <div class="form-field">    
    <label><?php echo $lang['set-kb-db-apkb']; ?></label>
    <input type="text" name="set_kb_showx" id="set_kb_showx" value="<?php echo @$db_kb_showx; ?>" />
    </div>
    
    <p><input class="btn" name="Save_KB" type="submit" value="<?php echo $lang["generic-save"]; ?>" /></p>
    
    </form>
        
</div>