<?php
// update livechat settings
function aaModelSaveSettingsLiveChat($lc_on, $lc_it) {

	global $pdo_conn, $pdo_t, $lang;
		
	$lc_on = (isset($lc_on)) ? 1 : 0;
	
	// enable or disable live chat in db
	$sql_set_lc = "UPDATE ".$pdo_t['t_settings']." SET LiveChat_Enable=:lc_on, LiveChat_Idle_Time=:lc_it LIMIT 1";
	$q_set_lc = $pdo_conn->prepare($sql_set_lc);
	$q_set_lc->execute(array(":lc_on" => $lc_on, ":lc_it" => $lc_it)); 

	// log out any users if live chat enabled or disabled
	$sql_user_logout = "UPDATE ".$pdo_t['t_users']." SET Chat_Status = '0'";
	$q_user_logout = $pdo_conn->prepare($sql_user_logout);
	
	if($q_user_logout->execute()) {
			echo '<div class="success-msg">'.$lang['generic-settings-saved'].'</div>';
	}
}

?>
