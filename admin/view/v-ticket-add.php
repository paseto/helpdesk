<?php
$users = aaModelGetUsers();
$array_of_users = $users->fetchAll();
$no_of_users = $users->rowCount();

// get groups
$groups = aaModelGetGroups();
$array_of_groups = $groups->fetchAll();
$no_of_groups = $groups->rowCount();

// get agents
$agents = aaModelGetAgents();
$array_of_agents = $agents->fetchAll();

// get priorities
$priorities = aaModelGetPriorities();
$array_of_priorities = $priorities->fetchAll();
$no_of_priorities = $priorities->rowCount();
?>

<div id="layout-body" class="layout-padding form">
        <h2><?php echo $lang["ticket-add-title"]; ?></h2>
        <hr />
        <?php
    	if (isset($_POST["Add"])) {
		
        aaModelInsertRequest($_POST["ticket-add-fname"], 
						$_POST["ticket-add-email"], 
						$_POST["category"], 
						$_POST["priority"], 
						$_POST["subject"],
						$_POST["notes"],
						$_FILES["file"],
						@$_POST["custom"]);
		
		}
        ?>
		<?php echo read_session('aaerror-add-null'); ?>
		<?php echo read_session('aaerror-add-email'); ?>
		<?php echo read_session('aaerror-file'); ?>
        <form name="form1" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
        
        <p><a href="#" id="s_popup"><?php echo $lang['ticket-add-search-u']; ?></a> <?php echo $lang['ticket-add-guest']; ?></p>

        <div class="form-field">	
        <label for="ticket-add-fname"><?php echo $lang['ticket-add-name']; ?> *</label>
        <input id="ticket-add-fname" name="ticket-add-fname" type="text" value="<?php cached_fields(@$_POST["ticket-add-fname"]); ?>" placeholder="<?php echo $lang['ticket-add-name']; ?>">
		</div>
        
        <div class="form-field">             
        <label for="ticket-add-email"><?php echo $lang['ticket-add-email']; ?> *</label>
        <input id="ticket-add-email" name="ticket-add-email" type="email" value="<?php cached_fields(@$_POST["ticket-add-email"]); ?>" placeholder="<?php echo $lang['ticket-add-email']; ?>">
        </div>
           
        <?php
        // if there's only one group then don't show select option
        if ($no_of_groups == 1) {
            $display_cat_opt = "style=\"display:none\"";
        }
        ?>
        <div class="form-field" <?php echo @$display_cat_opt; ?>>
        <label for="category"><?php echo $lang['ticket-add-group']; ?> *</label>
        <select class="ticket-add-select" name="category" id="category" style="width:30%" >        
        <?php
        foreach ($array_of_groups as $group) {
            
            if ($group["Def"] == 1) {
            
                echo "<option value=\"".$group["Cat_ID"]."\" selected=\"selected\">".decode_entities($group["Category"])."</option>";
            
            } else {
          
                echo "<option value=\"".$group["Cat_ID"]."\">".decode_entities($group["Category"])."</option>";
            
            }
                
        }
        
        ?>
        </select>
        </div>
        
		<?php
        // if there's only one group then don't show select option	
        if ($no_of_priorities == 1) {
            $display_priority_opt = "style=\"display:none\"";
        }
        ?>       
        <div class="form-field" <?php echo @$display_priority_opt; ?>>        
        <label for="priority"><?php echo $lang['ticket-add-priority']; ?> *</label>
        <select class="ticket-add-select" name="priority" id="priority" style="width:30%" >
        <?php
		foreach ($array_of_priorities as $priority) {

            if ($priority["Def"] == 1) {
          
				echo "<option value=\"".$priority["Level_ID"]."\" selected=\"selected\">".decode_entities($priority["Level"])."</option>";
            
            } else {
                
				echo "<option value=\"".$priority["Level_ID"]."\">".decode_entities($priority["Level"])."</option>";
        
            }
            
        }
        
        ?>
        </select>
        </div>
        
        <div style="display:none" id="sla" class="form-field"></div>
        
        <?php
        // custom fields go here
		$customfields =	aaModelGetCustomFields();
		$array_of_customfields = $customfields->fetchAll();
        unset($_SESSION["custom_fields"]);

		foreach ($array_of_customfields as $cf) {
            
            $fieldname = ucfirst(str_replace("_", " ", $cf["Field_Name"]));
            $option = explode(",",$cf["Field_Options"]);
            switch ($cf["Field_Type"]) {
                case "Text":
                echo "<div class=\"form-field\"><label>".$fieldname."</label>";
                echo "<input name=\"custom[".$cf["Field_Name"]."]\" type=\"text\" maxlength=\"".$cf["Field_MaxLen"]."\" value=\"".@$_POST["custom"][$cf['Field_Name']]."\" placeholder=\"".$fieldname."\" /></div>";
                ?>
                <p class="error"><?php read_session('aaerror-custom['.$cf["Field_Name"].']'); ?></p>
                <?php
                break;
                
                case "Textbox":
                echo "<div class=\"form-field\"><label>".$fieldname."</label>";
                echo "<textarea name=\"custom[".$cf["Field_Name"]."]\" maxlength=\"".$cf["Field_MaxLen"]."\" placeholder=\"".$fieldname."\">".@$_POST["custom"][$cf['Field_Name']]."</textarea>";
                ?>
                <p class="error"><?php read_session('aaerror-custom['.$cf["Field_Name"].']'); ?></p>
                <?php
                break;
                
                case "Select":
					echo "<div class=\"form-field\">";
                    echo "<label>".$fieldname."</label>";
                    echo "<select name=\"custom[".$cf["Field_Name"]."]\">";
                    foreach($option as $sel_opt) {
        
                        // if already selected	
                        if ($sel_opt == $_POST["custom"][$cf['Field_Name']]) {
                        
                            echo "<option value=\"".$sel_opt."\" selected=\"selected\">".$sel_opt."</option>";
                        
                        } else {
    
                            echo "<option value=\"".$sel_opt."\">".$sel_opt."</option>";
        
                        }
                    }
                    echo "</select>";
					echo "</div>";
                break;
                
                case "Checkbox":
                echo "<p>".$fieldname."</p>";
                
                    // default checkbox value to check if null
                    echo "<p><input style=\"display:none\" hidden name=\"custom[".$cf["Field_Name"]."][]\" type=\"checkbox\" value=\"0\" checked />";
                    foreach($option as $checkbox_opt) {
                        
                        if (isset($_POST["custom"][$cf['Field_Name']])) {
                            // checek if value is in field array			
                            if (in_array($checkbox_opt,$_POST["custom"][$cf['Field_Name']])) {
                            
                                $checked = "checked";
                            
                            } else {
                            
                                $checked = "";
                            
                            }
                        
                        }
                        
                        echo "<div class=\"form-field\"><label>".$checkbox_opt."</label><input name=\"custom[".$cf["Field_Name"]."][]\" type=\"checkbox\" value=\"".$checkbox_opt."\" ".@$checked."/></div>";
                        
                    }
                    ?>
                    <p class="error"><?php read_session('aaerror-custom['.$cf["Field_Name"].']'); ?></p>
                    <?php
                break;
                
                case "Radio":
                    echo "<label>".$fieldname."</label>";
                    foreach($option as $radio_opt) {
                    
                        if ($radio_opt == $_POST["custom"][$cf['Field_Name']]) {
                            
                            echo "<div class=\"form-field\"><label>".$radio_opt."</label><input name=\"custom[".$cf["Field_Name"]."]\" type=\"radio\" value=\"".$radio_opt."\" checked /></div>";
                        
                        } else if (!($_POST["custom"][$cf['Field_Name']])) {
                        
                            echo "<div class=\"form-field\"><label>".$radio_opt."</label><input name=\"custom[".$cf["Field_Name"]."]\" type=\"radio\" value=\"".$radio_opt."\" checked /></div>";
                            
                        } else {
                        
                            echo "<div class=\"form-field\"><label>".$radio_opt."</label><input name=\"custom[".$cf["Field_Name"]."]\" type=\"radio\" value=\"".$radio_opt."\" /></div>";
                        
                        }
                    }
                    ?>
                    <p class="error"><?php read_session('aaerror-custom['.$cf["Field_Name"].']'); ?></p>
                    <?php
                break;
                
                }
            
        }
        
        //print_r($custom_set_val);
    
        ?>
        
        <div class="form-field">        
        <label for="subject"><?php echo $lang['ticket-add-subject']; ?> *</label>
        <input name="subject" type="text" id="subject" value="<?php cached_fields(@$_POST["subject"]); ?>" placeholder="Subject">
        </div>

        <div class="form-field">     
        <label><?php echo $lang['ticket-add-msg']; ?> *</label>           
        <textarea name="notes" id="notes" rows="10" placeholder="Message"><?php if (isset($_POST["notes"])) { echo $_POST["notes"]; } ?></textarea>
		</div>
        
		<?php
        $file_attachment = get_settings("File_Enabled");
        
        if ($file_attachment == 1) {
            
        ?>
        <div class="form-field">     
        <label for="file"><?php echo $lang['ticket-add-files-add']; ?></label>
        <input class="aafile" name="file[]" type="file" multiple="multiple" />
        </div>
        <?php
        }
        ?>
        
        <p><input class="btn" name="Add" type="submit" id="Add" value="<?php echo $lang["generic-save"]; ?>" /></p>
        
        </form> 
        
        <div class="overlay"></div>
        <div class="popup layout-padding">
        
            <h3>Search for registered user by:</h3>
        	<form id="s-form">    
            <div class="form-field">
            <label>Name</label>
            <input id="s_name" name="s_name" type="text" />
            </div>
            
            <div class="form-field">
            <label>Username / Email Address</label>
            <input id="s_uname" name="s_uname" type="text" />
            </div>

            <p><input class="btn" id="s-submit" name="s-submit" type="submit" value="<?php echo $lang['search-button-submit']; ?>" /></p>
            
            </form>
                                    
            <div id="s_results"></div>
       
        </div>
        
</div>      
