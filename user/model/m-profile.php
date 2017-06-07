<?php
// validation user registeration data
function aaModelValidateUserForm($fname, $email, $tele, $pwd, $cpwd) {

	global $pdo_conn, $pdo_t, $lang;

	$fname = clean($fname, TRUE);
	$email = clean($email, TRUE);
	$tele = clean($tele, TRUE);
	$pwd = clean($pwd, TRUE);
	$cpwd = clean($cpwd, TRUE);

	if (!($fname && $email && $pwd && $cpwd)) {
		echo "All fields are required";
	} else if ($tele != "" && (!is_numeric($tele))) {
		echo "Your telephone number must be numeric";
	} else if (strlen($pwd) < 6) {
		echo "Your password must be 6 or more characters long";
	} else if (form_validate ("EMAIL", $email)) {
		echo "Please enter a valid email address";
	} else if ($pwd != $cpwd) {
		echo "Your password and confirmed password must match";
	} else if(aaModelCheckUserUnique($email) >= 1) {
		echo "Your email address is already registered. Please try another or use Forgotten Password";
	} else {
		
		$pwd = hash("sha256", $pwd);
			
		$insert_user = "INSERT INTO ".$pdo_t['t_users']." (Pwd, Fname, Email, TeleNo, Role) 
		VALUES (:pwd, :fname, :email, :teleno, :role)";
		
		$q = $pdo_conn->prepare($insert_user);
		
		if ($q->execute(array('pwd' => $pwd, 'fname' => $fname, 'email' => $email, 'teleno' => $tele, 'role' => 0))) {
			
			$uid = $pdo_conn->lastInsertId();
			aaModelSetUserSession($uid, $fname, $email, "NULL", "NULL");
			//print_r($_SESSION);
			header("Location: index.php?p=dashboard");
		
		} else {
		echo $q->errorCode();
		}
	}
	
}
?>