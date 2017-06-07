<?php
// ADD IF STATEMENT TO CHECK IF GUEST ACCESS OR REG IS ALLOWED!!!!
// if guest access not allowed then check for user sign in
if (!isset($_GET["guest"])) {
	if ($db_user_reg  == 1) {
		if (!isset($_SESSION['u']['aauid']) || (@$_SESSION['u']['aaurole'] != 0)) {
			@header ("Location: index.php?p=user-access&r=ticket-add");
		}
	}
}

$choose_priority = get_settings("Ticket_Priority");
$show_sla = get_settings("Ticket_SLA");
$file_attachment = get_settings("File_Enabled");

// get groups
$groups = aaModelGetGroups();
$array_of_groups = $groups->fetchAll();
$no_of_groups = $groups->rowCount();

// get priorities
$priorities = aaModelGetPriorities();
$array_of_priorities = $priorities->fetchAll();
$no_of_priorities = $priorities->rowCount();


if (isset($_POST["Add"])) {	
	aaModelInsertRequest($_POST["user"], 
						$_POST["user_email"], 
						$_POST["category"], 
						$_POST["priority"], 
						$_POST["subject"],
						$_POST["notes"],
						@$_FILES["file"],
						@$_POST["custom"],
						@$_POST["code"]);	
	
}
?>
<div class="margin-body form" style="clear:both">
<h2><?php echo $lang['ticket-add-title']; ?></h2>
<hr />
	<?php echo read_session('aaerror-add-null'); ?>
	<?php echo read_session('aaerror-add-email'); ?>
	<?php echo read_session('aaerror-file'); ?>
	<?php echo read_session('aaerror-add-code'); ?>
    <form name="form1" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
    
	
    <?php
	if (isset($_SESSION['u']["aaname"]) && ($_SESSION['u']['aaurole'] == 0)) {
   		echo '<input name="user" type="text" id="user" value="'.$_SESSION['u']["aaname"].'" hidden>';
	} else {
		echo '<div class="form-field">';
		echo '<label for="user">'.$lang['ticket-add-name'].' *</label>';	
    	echo '<input name="user" type="text" id="user" value="'; cached_fields(@$_POST['user']);
		echo '" placeholder="'.$lang['ticket-add-name'].'">';
		echo '</div>';
	}
	?>

    <?php
	if (isset($_SESSION['u']["aaemail"]) && ($_SESSION['u']['aaurole'] == 0)) {
    	echo '<input name="user_email" type="email" id="user_email" value="'.$_SESSION['u']["aaemail"].'" hidden>';
	} else {
		echo '<div class="form-field">';
		echo '<label for="user_email">'.$lang['ticket-add-email'].' *</label>';
    	echo '<input name="user_email" type="email" id="user_email" value="'; cached_fields(@$_POST['user_email']);
		echo '" placeholder="'.$lang['ticket-add-email'].'">';
		echo '</div>';
	}
	?>
	
	<?php
	// if there's only one group then don't show select option
    if ($no_of_groups == 1) {
		$display_cat_opt = "style=\"display:none\"";
	}
    ?>
	<div class="form-field">  
    <div <?php echo @$display_cat_opt; ?>>
    <label for="category"><?php echo $lang['ticket-add-group']; ?></label>
    <select name="category" id="category">
    <?php
    foreach($array_of_groups as $cats) {
        
        if ($cats["Def"] == 1) {
        
            echo "<option value=\"".$cats["Cat_ID"]."\" selected=\"selected\">".decode_entities($cats["Category"])."</option>";
        
        } else {
      
            echo "<option value=\"".$cats["Cat_ID"]."\">".decode_entities($cats["Category"])."</option>";
        
        }
            
    }
    
    ?>
    </select>
	</div>
	</div>
    
	<?php
	// if there's only one group then don't show select option	
    if ($no_of_priorities == 1 || @$choose_priority == 0) {
		$display_priority_opt = "style=\"display:none\"";
	}
    ?>
	<div class="form-field" <?php echo @$display_priority_opt; ?>">  
    
    <label for="priority"><?php echo $lang['ticket-add-priority']; ?></label>
    <select name="priority" id="priority">
    <?php
	foreach($array_of_priorities as $levels) {
	  
        if ($levels["Def"] == 1) {
      
        echo "<option value=\"".$levels["Level_ID"]."\" selected=\"selected\">".decode_entities($levels["Level"])."</option>";
        
        } else {
            
        echo "<option value=\"".$levels["Level_ID"]."\">".decode_entities($levels["Level"])."</option>";
    
        }
        
    }
    
    ?>
    </select>

	</div>
	<?php 
	if ($show_sla == 1) {
		echo '<div id="sla" class="form-field"></div>';
    }

	// custom fields go here
	$customfields =	aaModelGetCustomFields();
	$array_of_customfields = $customfields->fetchAll();

	unset($_SESSION["custom_fields"]);
	foreach ($array_of_customfields as $cf) {
		
		$fieldname = ucfirst(str_replace("_", " ", $cf["Field_Name"]));
		$option = explode(",",trim($cf["Field_Options"]));
		
		switch ($cf["Field_Type"]) {
		
			case "Text":
			echo "<div class=\"form-field\"><label>".decode_entities($fieldname)."</label>";
			echo "<input name=\"custom[".$cf["Field_Name"]."]\" type=\"text\" maxlength=\"".$cf["Field_MaxLen"]."\" value=\"".@$custom_set_val[$cf["Field_Name"]]."\" placeholder=\"".$fieldname."\" /></div>";
			?>
			<span class="error"><?php echo @$form_error[$cf["Field_Name"]]; ?></span>
			<?php
			break;
			
			case "Textbox":
			echo "<div class=\"form-field\"><label>".decode_entities($fieldname)."</label>";
			echo "<textarea name=\"custom[".$cf["Field_Name"]."]\" maxlength=\"".$cf["Field_MaxLen"]."\" placeholder=\"".$fieldname."\">".@$custom_set_val[$cf["Field_Name"]]."</textarea></div>";
			?>
			<span class="error"><?php echo @$form_error[$cf["Field_Name"]]; ?></span>
			<?php
			break;
			
			case "Select":
				echo "<div class=\"form-field\">";
				echo "<label for=\"".@$custom_set_val[$cf["Field_Name"]]."\">".decode_entities($fieldname)."</label>";
				echo "<select name=\"custom[".$cf["Field_Name"]."]\">";
				foreach($option as $sel_opt) {
	
					// if already selected	
					if ($sel_opt == @$custom_set_val[$cf["Field_Name"]]) {
					
						echo "<option value=\"".$sel_opt."\" selected=\"selected\">".$sel_opt."</option>";
					
					} else {

						echo "<option value=\"".$sel_opt."\">".$sel_opt."</option>";
	
					}
				}
				echo "</select>";
				echo "</div>";
			break;
			
			case "Checkbox":
			echo "<label for=\"".@$custom_set_val[$cf["Field_Name"]]."\">".decode_entities($fieldname)."</label>";
			
				// default checkbox value to check if null
				echo "<input style=\"display:none\" hidden name=\"custom[".$cf["Field_Name"]."][]\" type=\"checkbox\" value=\"0\" checked />";
				foreach($option as $checkbox_opt) {
					
					if (isset($custom_set_val[$cf["Field_Name"]])) {
						// checek if value is in field array			
						if (in_array($checkbox_opt,$custom_set_val[$cf["Field_Name"]])) {
						
							$checked = "checked";
						
						} else {
						
							$checked = "";
						
						}
					
					}
					
					echo "<div class=\"form-field\"><label>".$checkbox_opt."</label><input name=\"custom[".$cf["Field_Name"]."][]\" type=\"checkbox\" value=\"".$checkbox_opt."\" ".@$checked."/> ".$checkbox_opt."</div>";
					
				}
				?>
				<span class="error"><?php echo @$form_error[$cf["Field_Name"]]; ?></span>
                <?php
			break;
			
			case "Radio":
				echo "<label for=\"".@$custom_set_val[$cf["Field_Name"]]."\">".decode_entities($fieldname)."</label>";
				foreach($option as $radio_opt) {
				
					if ($radio_opt == @$custom_set_val[$cf["Field_Name"]]) {
						
						echo "<div class=\"form-field\"><label>".$radio_opt."</label><input name=\"custom[".$cf["Field_Name"]."]\" type=\"radio\" value=\"".$radio_opt."\" checked /> ".$radio_opt."</div>";
					
					} else if (!(@$custom_set_val[$cf["Field_Name"]])) {
					
						echo "<div class=\"form-field\"><label>".$radio_opt."</label><input name=\"custom[".$cf["Field_Name"]."]\" type=\"radio\" value=\"".$radio_opt."\" checked /> ".$radio_opt."</div>";
						
					} else {
					
						echo "<div class=\"form-field\"><label>".$radio_opt."</label><input name=\"custom[".$cf["Field_Name"]."]\" type=\"radio\" value=\"".$radio_opt."\" /> ".$radio_opt."</div>";
					
					}
				}
				?>
				<span class="error"><?php echo @$form_error[$cf["Field_Name"]]; ?></span>
                <?php
			break;
			
			}
		
	}
	
	//print_r($custom_set_val);

	?>
    <div class="form-field">  
    <label for="subject"><?php echo $lang['ticket-add-subject']; ?> *</label>
    <input name="subject" type="text" id="subject" value="<?php cached_fields(@$_POST['subject']); ?>" placeholder="<?php echo $lang['ticket-add-subject']; ?>">
    </div>

    <div class="form-field">
    <label for="notes"><?php echo $lang['ticket-add-msg']; ?> *</label>
    <textarea name="notes" id="notes" placeholder="Message"><?php cached_fields(@$_POST['notes']); ?></textarea>
    </div>
    
    <?php
    if (@$file_attachment == 1) {
    ?>
    <div id="fileuploads" class="form-field">
	<input type="hidden" id="aafilelimit" value="<?php echo get_settings("File_Limit"); ?>" />
    <label for="file"><?php echo $lang['ticket-add-files-add']; ?></label>
    <input class="aafile"  name="file[]" type="file" multiple="multiple" />
    </div>
    <?php 
	echo @$form_error['FILE'];
	}
	?>
    
	<?php	
	$db_antispam = get_settings("Ticket_Antispam");
    if (@$db_antispam == 1) {
    ?>
	
	<div class="form-field">  
    <label for="secim"><?php echo $lang['ticket-add-sec-code']; ?> <strong><?php security_code (); ?></strong></label>
	<br>
    </div>
	
	<div class="form-field">  
    <label for="code"><?php echo $lang['ticket-add-sec-code-ent']; ?></label>
    <input name="code" type="text" id="code" value="<?php if (isset($code)) { echo $code; } ?>" placeholder="<?php echo $lang['ticket-add-sec-code-ent']; ?>">
	</div>
    <?php
    }
    ?>
        
    <p><input name="Add" type="submit" class="btn" id="Add" value="<?php echo $lang['ticket-add-submit']; ?>" /></p>
    
    </form> 
</div>