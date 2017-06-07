<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>    
    <h2><?php echo $lang["set-tickets-title"]; ?></h2>
    <hr />
    
	<?php
    if (isset($_POST["Save_Tickets"])) {
        aaModelSaveSettingsTickets($_POST["set_ticket_view_dir"], 
                                    $_POST["set_ticket_reply_pos"], 
                                    @$_POST["set_ticket_priority"],
									@$_POST["set_ticket_sla"], 
                                    @$_POST["set_ticket_antispam"], 
                                    @$_POST["set_ticket_reopen"], 
                                    @$_POST["set_ticket_rating"], 
                                    @$_POST["set_ticket_time"], 
                                    @$_POST["fileattach_enable"], 
                                    @$_POST["fileattach_limit"], 
                                    @$_POST["fileattach_path"], 
                                    @$_POST["fileattach_size"], 
                                    @$_POST["fileattach_type"]);
                                
    }
    ?>
    
    <form name="set_tickets" id="set_tickets" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">        

    <div class="form-field">
    <label><?php echo $lang["set-tickets-db-tv"]; ?></label>
    <select name="set_ticket_view_dir">
    <?php
    
    $db_tv_opts = array("ASC" => $lang["set-tickets-db-tv-opt1"], "DESC" => $lang["set-tickets-db-tv-opt2"]);
    $db_tv = get_settings("Ticket_Dir");
    
    foreach($db_tv_opts as $tv_key => $tv_val) {
        if ($tv_key == $db_tv) {
            echo '<option value="'.$tv_key.'" selected="selected">'.$tv_val.'</option>';
        } else {
            echo '<option value="'.$tv_key.'">'.$tv_val.'</option>';
        }
    }
    
    ?>
    </select>
    </div>
    
    <div class="form-field">    
    <label><?php echo $lang["set-tickets-db-trp"]; ?></label>
    <select name="set_ticket_reply_pos">
    <?php
    
    $db_trp_opts = array("TOP" => $lang["set-tickets-db-trp-opt1"], "BOT" => $lang["set-tickets-db-trp-opt2"]);
    $db_trp = get_settings("Ticket_Reply_Position");
    
    foreach($db_trp_opts as $trp_key => $trp_val) {
        if ($trp_key == $db_trp) {
            echo '<option value="'.$trp_key.'" selected="selected">'.$trp_val.'</option>';
        } else {
            echo '<option value="'.$trp_key.'">'.$trp_val.'</option>';
        }
    }
    
    ?>
    </select>
    </div>
    
    <?php
    $db_sel_priority = get_settings("Ticket_Priority");
    
    if ($db_sel_priority == '1') {
        $checked_up = 'checked';
    }
    ?>
    <div class="form-field">
    <label for="set_ticket_priority"><?php echo $lang["set-tickets-db-up"]; ?></label>		
    <input name="set_ticket_priority" id="set_ticket_priority" type="checkbox" value="1" <?php echo @$checked_up; ?> />
	</div>
	
	<?php
    $db_sel_sla = get_settings("Ticket_SLA");
    
    if ($db_sel_sla == '1') {
        $checked_sl = 'checked';
    }
    ?>
    <div class="form-field">
    <label for="set_ticket_sla"><?php echo $lang["set-tickets-db-sla"]; ?></label>		
    <input name="set_ticket_sla" id="set_ticket_sla" type="checkbox" value="1" <?php echo @$checked_sl; ?> />
	</div>	
    
    <?php
    $db_antispam = get_settings("Ticket_Antispam");
    
    if ($db_antispam == '1') {
        $checked_as = 'checked';
    }
    ?>
    <div class="form-field">
    <label for="set_ticket_antispam"><?php echo $lang["set-tickets-db-as"]; ?></label>        
    <input name="set_ticket_antispam" id="set_ticket_antispam" type="checkbox" value="1" <?php echo @$checked_as; ?> />
	</div>            
    
	<?php
    $db_reopen = get_settings("Ticket_Reopen");		
    
    if ($db_reopen == '1') {
        $checked_rc = 'checked';
    }
    ?>

    <div class="form-field">
    <label for="set_ticket_reopen"><?php echo $lang["set-tickets-db-rc"]; ?></label>                            
    <input name="set_ticket_reopen" id="set_ticket_reopen" type="checkbox" value="1" <?php echo @$checked_rc; ?> />	
    </div>
    
    <?php
    $db_ticket_rating = get_settings("Ticket_Feedback");		
    
    if ($db_ticket_rating == '1') {
        $checked_tr = 'checked';
    }
    ?>

    <div class="form-field">
    <label for="set_ticket_rating"><?php echo $lang["set-tickets-db-tr"]; ?></label>
    <input name="set_ticket_rating" id="set_ticket_rating" type="checkbox" value="1" <?php echo @$checked_tr; ?> />	
    </div>

    <?php
    $db_ticket_time = get_settings("Ticket_Time");		
    $checked_tt = ($db_ticket_time == "1") ? "checked" : NULL;
    ?>

    <div class="form-field">
    <label for="set_ticket_time"><?php echo $lang["set-tickets-db-tt"]; ?></label>
    <input name="set_ticket_time" id="set_ticket_time" type="checkbox" value="1" <?php echo @$checked_tt; ?> />	
    </div>
    
    <div class="form-field">    
    <label for="input_enable"><?php echo $lang["set-tickets-db-fa"]; ?></label>
    <input name="fileattach_enable" type="checkbox" id="input_enable" value="1" <?php if (get_settings("File_Enabled") == 1) { echo "checked=\"checked\""; } ?>/>
	</div>

    <div class="form-field">
    <label class="<?php if (in_array("fa_limit", @$_SESSION["ticket_error"])) { echo "error"; } ?>"><?php echo $lang["set-tickets-db-fa-desc0"]; ?></label>
    <input class="dis-enl-input" name="fileattach_limit" type="text" value="<?php echo get_settings("File_Limit"); ?>" />
	</div>
    
    <div class="form-field">    
    <label class="<?php if (in_array("fa_path", @$_SESSION["ticket_error"])) { echo "error"; } ?>"><?php echo $lang["set-tickets-db-fa-desc1"]; ?></label>
    <input class="dis-enl-input" name="fileattach_path" type="text" value="<?php echo get_settings("File_Path"); ?>" />
    </div>
    
    <div class="form-field">    
    <label class="<?php if (in_array("fa_size", @$_SESSION["ticket_error"])) { echo "error"; } ?>"><?php echo $lang["set-tickets-db-fa-desc2"]; ?></label>
    <input class="dis-enl-input" name="fileattach_size" type="text" value="<?php echo get_settings("File_Size") / 1048576; ?>" />
	</div>

    <div class="form-field">
    <label class="<?php if (in_array("fa_type", @$_SESSION["ticket_error"])) { echo "error"; } ?>"><?php echo $lang["set-tickets-db-fa-desc3"]; ?></label>
    <input class="dis-enl-input" name="fileattach_type" type="text" value="<?php echo get_settings("File_Type"); ?>" />
	</div>

    <p><input class="btn" name="Save_Tickets" type="submit" value="<?php echo $lang["generic-save"]; ?>" /></p>
    </form>
    
</div>