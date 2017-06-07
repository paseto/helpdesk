<?php
// list all timezones available
function aaModelAllTimezones() {
	return $timezone_identifiers = DateTimeZone::listIdentifiers();
}


// update general settings
function aaModelSaveSettingsGeneral($companyname, $default_lang, $timezone, $dateformat, $redirectto) {

	global $pdo_conn, $pdo_t, $lang;

	$companyname = clean($companyname,TRUE);
	
	// if any fields are let blank then error variable is set to tru
	if (!($companyname && $timezone && $dateformat)) {
	
		echo "<div class=\"error-msg\">".$lang['generic-error-inv-format']."</div>";
	
	} else {
		
		// update database with new values
		$update_general = "UPDATE ".$pdo_t['t_settings']." SET Company_Name=:companyname, Langauge=:default_lang, Timezone=:timezone, Date_Format=:dateformat, Redirect_Page=:redirectto LIMIT 1";
		$q = $pdo_conn->prepare($update_general);

		if ($q->execute(array(":companyname" => $companyname, ":default_lang" => $default_lang, ":timezone" => $timezone, ":dateformat" => $dateformat, ":redirectto" => $redirectto))) {
	
			echo '<div class="success-msg">'.$lang['generic-settings-saved'].'</div>';
		
		}
		
						 
	}

}
?>
