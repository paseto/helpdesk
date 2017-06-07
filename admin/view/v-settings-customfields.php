<div id="layout-body" class="layout-padding form">
    	<?php include 'v-settings-menu.php'; ?>

		<?php
		// delete custom field
		if (isset($_POST["custom_delete"])) {
			aaModelDeleteCustomField ($_POST["FID"], $_POST["Field_Name"]);		
		}
		?>
        
        <h2><?php echo $lang['set-custom-db-af']; ?></h2>
		<?php echo $lang['set-custom-title-desc']; ?>
		<hr />
		<?php
		// insert new custom field
		if (isset($_POST["custom_save"])) {
			aaModelInsertCustomField($_POST["custom_name"], @$_POST["custom_type"], @$_POST["custom_required"], @$_POST["custom_maxlen"], @$_POST["custom_options"]);
		}
		?>        
        <form name="customform" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <input style="display:none; visibility:hidden" type="text" id="can_id" name="can_id" />
        
        <div class="form-field">
        <label for="custom_name"><?php echo $lang['set-custom-db-fn']; ?> *</label>
        <input type="text" id="custom_name" name="custom_name" placeholder="<?php echo $lang['set-custom-db-fn']; ?>" value="<?php if (isset($custom_name)) { echo $custom_name; } ?>" />
		</div>
        <?php if (isset($name_error)) { echo $name_error; } ?>
        
        <div class="form-field">        
        <label for="custom_type"><?php echo $lang["set-custom-db-ft"]; ?></label>
        <?php
        $field_types = array("Text","Textbox","Select","Checkbox","Radio");
        ?>
        <select name="custom_type" id="custom_type">
        <?php
        foreach ($field_types as $type) {
            
            if ($custom_type == $type) {
        
                echo "<option value=\"".$type."\" selected=\"selected\">".$type."</option>";
        
            } else {
        
                echo "<option value=\"".$type."\">".$type."</option>";
        
            }
            
        }
        ?>
        </select>
        </div>
        
        <div class="form-field">        
        <input id="custom_required" name="custom_required" type="checkbox" value="1" />
        <label style="padding-top:0px" for="custom_required"><?php echo $lang['set-custom-db-fr']; ?></label>
        </div>


        <div id="custom_maxlen" class="form-field">
        <label for="custom_maxlen"><?php echo $lang['set-custom-db-fl']; ?></label>
        <input type="text" name="custom_maxlen" id="custom_maxlen_input" value="255" placeholder="Maximum length" value="<?php if (isset($custom_maxlen)) { echo $custom_maxlen; } ?>" />
        <p><span class="error"><?php if (isset($no_error)) { echo $lang['set-custom-db-fl-error']; } ?></span></p>
        </div>
        
        <div id="custom_options" class="form-field">
        <label for="custom_options"><?php echo $lang['set-custom-db-fo']; ?> <?php echo $lang['set-custom-db-fo-desc']; ?></label>
        <input type="text" name="custom_options" placeholder="<?php echo $lang['set-custom-db-fo']; ?>" value="<?php if (isset($custom_options)) { echo $custom_options; } ?>" />
        <p><span class="error"><?php if (isset($sel_error)) { echo $lang['generic-error']; } ?></span></p>
        </div>
        
        <input class="btn" type="submit" name="custom_save" value="<?php echo $lang['generic-save']; ?>">
        </form>
                
        <br />
        
  		<?php
		$customfields = aaModelGetCustomFields();
		$customfields_array = $customfields->fetchAll();
		$custom_total = $customfields->rowCount();
		
        if ($custom_total > 0) {
        ?>

        <h3><?php echo $lang['set-custom-db-ef']; ?></h3>
        <table>
        <colgroup>
        <col />
        <col />
        <col />
        <col />
        <col />
        <col />
        </colgroup>
        <thead>
        <tr>
        <td><?php echo ucwords($lang['set-custom-db-fn']); ?></td>
        <td><?php echo ucwords($lang['set-custom-db-ft']); ?></td>
        <td><?php echo ucwords($lang['set-custom-db-fr']); ?></td>
        <td><?php echo ucwords($lang['set-custom-db-fl']); ?></td>
        <td><?php echo ucwords($lang['set-custom-db-fo']); ?></td>
        <td>&nbsp;</td>
        </tr>
        </thead>
        <tbody>
        <?php
		foreach ($customfields_array as $cf) {

        if ($cf["Field_Required"] == 1) {
       		$required = $lang["generic-yes"];
        } else {
        	$required = $lang["generic-no"];
        }
        
        $fieldname = str_replace("_", " ", $cf["Field_Name"]);
        ?>
        <tr>        
        <form method="post">
        <input style="display:none; visibility:hidden" type="text" id="FID" name="FID" value="<?php echo $cf["FID"]; ?>" />   
        <input style="display:none; visibility:hidden" type="text" id="Field_Name" name="Field_Name" value="<?php echo $cf["Field_Name"]; ?>" />
        <input style="display:none; visibility:hidden" type="text" id="Delete_Text" name="Delete_Text" value="<?php echo $lang["set-custom-delete-con"]; ?>" />           
        <td data-title="<?php echo ucwords($lang["set-custom-db-fn"]); ?>"><?php echo decode_entities($fieldname); ?></td>
        <td data-title="<?php echo ucwords($lang["set-custom-db-ft"]); ?>"><?php echo $cf["Field_Type"];?></td>
        <td data-title="<?php echo ucwords($lang["set-custom-db-fr"]); ?>"><?php echo $required; ?></td>
        <td data-title="<?php echo ucwords($lang["set-custom-db-fl"]); ?>"><?php echo $cf["Field_MaxLen"];?></td>
        <td data-title="<?php echo ucwords($lang["set-custom-db-fo"]); ?>"><?php echo decode_entities($cf["Field_Options"]); ?>&nbsp;</td>   
        <td data-title="Delete"><button type="submit" class="btn delete_field" id="custom_delete" name="custom_delete" title="<?php echo $lang["generic-delete"]; ?>"><i class="fa fa-trash-o"></i></button></td>
        </form>
        </tr>
        <?php	
        }
        ?>
        </tbody>
        </table>
    	<?php
		}
		?>
    
    </div>