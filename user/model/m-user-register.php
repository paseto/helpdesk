<?php
// validation user registeration data
function aaModelValidateUserForm($fname, $email, $tele, $pwd, $cpwd) {

	global $pdo_conn, $pdo_t, $lang;

	$fname = clean($fname, TRUE);
	$email = clean($email, TRUE);
	$tele = clean($tele, TRUE);
	$tele = str_replace(" ", "", $tele);
	$pwd = clean($pwd, TRUE);
	$cpwd = clean($cpwd, TRUE);

	$now = timezone_time();	
	
	if (!($fname && $email && $pwd && $cpwd)) {
		echo '<div class="error-msg">'.$lang['generic-error-required-fields'].'</div>';
	} else if ($tele != "" && (!is_numeric($tele))) {
		echo '<div class="error-msg">'.$lang['generic-error-invalid-tn'].'</div>';
	} else if (strlen($pwd) < 6) {
		echo '<div class="error-msg">'.$lang['generic-error-pw-length'].'</div>';
	} else if (form_validate ("EMAIL", $email)) {
		echo '<div class="error-msg">'.$lang['generic-error-invalid-em'].'</div>';
	} else if ($pwd != $cpwd) {
		echo '<div class="error-msg">'.$lang['generic-error-pw-match'].'</div>';
	} else if(aaModelCheckUserUnique($email) >= 1) {
		echo '<div class="error-msg">'.$lang['generic-error-em-conflict'].'</div>';
	} else {
		
		$pwd = hash("sha256", $pwd);
			
		$insert_user = "INSERT INTO ".$pdo_t['t_users']." (Pwd, Fname, Email, cnpj, Role, Date_Created) 
		VALUES (:pwd, :fname, :email, :teleno, :role, :dt_created)";
		
		$q = $pdo_conn->prepare($insert_user);
		
		if ($q->execute(array('pwd' => $pwd, 'fname' => $fname, 'email' => $email, 'teleno' => $tele, 'role' => 0, 'dt_created' => $now))) {
			
			$uid = $pdo_conn->lastInsertId();
			aaModelSetUserSession("u", $uid, $fname, $email, "NULL", "NULL", "NULL", "NULL");
			
			//print_r($_SESSION);
			header("Location: index.php?p=dashboard");
		
		} else {
		echo $q->errorCode();
		}
	}
	
}
?>