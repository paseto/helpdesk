<?php
// insert new user / agent
function aaModelInsertUser($fname, $email, $telno, $pwd, $role, $signature = NULL, $u_notify_tn, $u_notify_tu, $u_notify_pm, $skills = NULL) {

	global $pdo_conn, $pdo_t, $lang;

	$fname = clean($fname, TRUE);
	$email = clean($email, TRUE);
	$telno = clean($telno, TRUE);
	$pwd = clean($pwd , TRUE);
	$signature = clean($signature, TRUE);

	$u_notify_tn = (isset($u_notify_tn)) ? 1 : 0;
	$u_notify_tu = (isset($u_notify_tu)) ? 1 : 0;
	$u_notify_pm = (isset($u_notify_pm)) ? 1 : 0;
	
	$now = timezone_time();
	
	$form_error = array();

	// check if user exists
	$sql_u_c = "SELECT Email FROM ".$pdo_t['t_users']." WHERE Email = :email";
	$q_u_c = $pdo_conn->prepare($sql_u_c);
	$q_u_c->execute(array('email' => $email));
	
	$u_c = $q_u_c->rowCount();
	
	if (!($fname && $email && $pwd)) {
		
		echo '<div class="error-msg">'.$lang['generic-error-required-fields'].'</div>';
		$error = true;

	} else if ($u_c > 0) {
	
		echo '<div class="error-msg">'.$lang['generic-error-un-exists'].'</div>';
		$error = true;
		
	} else if (strlen($pwd) < 6) {
		
		echo '<div class="error-msg">'.$lang['generic-error-pw-length'].'</div>';
		$error = true;

	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		
		echo '<div class="error-msg">'.$lang['generic-error-invalid-em'].'</div>';;
		$error = true;
		
	}  else if ($telno != "") {
		
		if (!is_numeric($telno)) {
			echo '<div class="error-msg">'.$lang['generic-error-invalid-tn'].'</div>';
			$error = true;
		}
		
	}

	
	if (!@$error) {
		
		$pwd = hash("sha256", $pwd);
			
		$sql_u_i = "INSERT INTO ".$pdo_t['t_users']." (Fname, Email, TeleNo, Pwd, Role, Preferred_View, Layout_Style, Signature, Notify_TN, Notify_TU, Notify_PM, Date_Created) 
		VALUES (:fname, :email, :telno, :pwd, :role, :view, :layout, :signature, :u_notify_tn, :u_notify_tu, :u_notify_pm, :dt_created)"; 

		$q_u_i = $pdo_conn->prepare($sql_u_i);
		$q_u_i->execute(array('fname' => $fname, 
		'email' => $email,
		'telno' => $telno,
		'pwd' => $pwd,
		'role' => $role,
		'view' => 'List',
		'layout' => 'white',
		'signature' => $signature,
		'u_notify_tn' => $u_notify_tn,
		'u_notify_tu' => $u_notify_tu,
		'u_notify_pm' => $u_notify_pm,
		'dt_created' => $now));
		//print_r($q_u_i->errorInfo());
		$lastuid = $pdo_conn->lastInsertId();
			
			// if skills are selected
			if (isset($skills)) {
				foreach ($skills as $skill) {
								
					// reinsert all ticked records
					$sql_u_s_i = "INSERT INTO ".$pdo_t['t_users_skills']." (UID, CID) VALUES (:lastuid, :skill)";
					$q_u_s_i = $pdo_conn->prepare($sql_u_s_i);
					
					if(!$q_u_s_i->execute(array('lastuid' => $lastuid, 'skill' => $skill))) {
						print_r($q_u_s_i->errorInfo());
						exit;
					}
				
				}
			}
			
			header('Location: p.php?p=settings-user-add-success');	
	
			
	}
	
}

?>
