<?php
// insert new custom field
function aaModelInsertCustomField($custom_name, $custom_type, $custom_required, $custom_maxlen, $custom_options) {
	
	global $pdo_conn, $pdo_t, $lang;	
	// clean entered data using custom function
	$custom_name = clean($custom_name, TRUE);
	$custom_required = (isset($custom_required)) ? 1 : 0;
	$custom_maxlen = clean($custom_maxlen, TRUE);
	$custom_options = clean($custom_options, TRUE);
	
	// if field is blank
	if (!($custom_name)) {
	
		echo "<div class=\"error-msg\">".$lang["generic-error"]."</div>";
		$error = true;	
	
	}
	
	if (!is_numeric($custom_maxlen)) {
	
		echo "<div class=\"error-msg\">".$lang['set-custom-db-fl-error']."</div>";	
		$error = true;	

	}
	
	if ($custom_type == "Text") {

		if ($custom_maxlen <= 0 || $custom_maxlen > 255) {
		
			echo "<div class=\"error-msg\">".$lang['set-custom-db-fl-error']."</div>";	
			$error = true;	

		}
		
	}
	
	if ($custom_type == "Select" || $custom_type == "Radio" || $custom_type == "Checkbox") {
	
		if (!($custom_options)) {
		
			echo "<div class=\"error-msg\">".$lang["generic-error"]."</div>";
			$error = true;	
		}
			
	} 
	
	if (!@$error) {
		//echo 'got here with no errors';

		// replace any special characters with underscore
		$custom_name_denied = array(" ", "\\", "/", ",", "\"", "&quot;", "'", ".", ";", ":", "?");
		$custom_name = str_replace($custom_name_denied, "_", $custom_name);

		$sql_alter_table = "ALTER TABLE ".$pdo_t['t_ticket']." ADD $custom_name TEXT NOT NULL";				
		$q_alter_table = $pdo_conn->prepare($sql_alter_table);
		
		// if failed to alter mysql table
		if (!($q_alter_table->execute())) {
		
			echo "<div class=\"error-msg\"><div class=\"pad10\">".$lang["set-custom-db-fn-sql-error"]."</div></div>";
			
		} else {
			// insert priority name plus order ID of last id plus 1
			$sql = "INSERT INTO ".$pdo_t['t_custom_fields']." (Field_Name, Field_Type, Field_MaxLen, Field_Required, Field_Options)
					VALUES (:custom_name, :custom_type, :custom_maxlen, :custom_required, :custom_options)";
								
						
			$q = $pdo_conn->prepare($sql);
			if (!($q->execute(array(":custom_name" => $custom_name,
								":custom_type" => $custom_type,
								":custom_maxlen" => $custom_maxlen,
								":custom_required" => $custom_required,
								":custom_options" => $custom_options)))) {
									
				echo "<div class=\"error-msg\">".$lang["set-custom-db-fn-sql-error"]."</div>";
								
			} else {
		
				// refresh page and send to priorities section
				header('Location: '.$_SERVER['REQUEST_URI']);
				
			}

		}

	}	
	
}

// delete custom field
function aaModelDeleteCustomField ($custom_id, $custom_name) {

	global $pdo_conn, $pdo_t;
	
	// run sql to delete priority record
	$sql_delete_options = "DELETE FROM ".$pdo_t['t_custom_fields']." WHERE FID = :custom_id";
	
	$q = $pdo_conn->prepare($sql_delete_options);
	$q->execute(array(":custom_id" => $custom_id));
	
	// drop table column
	$sql_drop_custom = "ALTER TABLE ".$pdo_t['t_ticket']." DROP $custom_name";
	$q = $pdo_conn->prepare($sql_drop_custom);
	$q->execute();
	
	// refresh page and send to priorities section
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}
?>
