<?php 
function pdo_conn () {
	
	global $pdo; // get pdo connection details
	try {
		$pdo_conn = new PDO("mysql:host=".$pdo['host'].";dbname=".$pdo['db']."", $pdo['user'], $pdo['pass']);
		//echo "Connected to ".$pdo['db']." at ".$pdo['host']." successfully.";
	} catch (PDOException $pe) {
		die("Could not connect to the database ".$pdo['db']." :" . $pe->getMessage());
	}
	return $pdo_conn;
}

// get each setting in db table
function get_settings ($s_t_field) {
	
	$pdo_conn = pdo_conn ();
	global $pdo_t;
	
	$sql = 'SELECT '.$s_t_field.' FROM '.$pdo_t['t_settings'];
	$q = $pdo_conn->prepare($sql);
	$q->execute();
	$setting = $q->fetch();
	
	return $setting["".$s_t_field.""];
	
}

// validate login
function aaGetUser($aau, $aap, $aauaccess) {
	
	global $pdo_conn, $pdo_t, $lang;
	
	$aau = clean($aau);
	$aap = clean(hash('sha256', $aap));
	
	if ($aauaccess == "u") {
		$sql = 'SELECT UID,Pwd,Fname,Email,Signature,Role,Preferred_View,Layout_Style, Disabled, razao_social FROM '.$pdo_t['t_users'].' t1 INNER JOIN empresas t2 ON t1.cnpj=t2.cnpj WHERE Email = :email AND Pwd = :pwd AND Role = 0';
	} else if ($aauaccess == "a") {
		$sql = 'SELECT UID,Pwd,Fname,Email,Signature,Role,Preferred_View,Layout_Style, Disabled FROM '.$pdo_t['t_users'].' WHERE Email = :email AND Pwd = :pwd AND Role BETWEEN 1 AND 3';
	}
	
	$q = $pdo_conn->prepare($sql);
	$q->execute(array(':email' => $aau, ':pwd' => $aap));
	$user = $q->fetch();
	$isauth = $q->rowCount();

	if ($user['Disabled'] == 1) {
		
		$form_error['aagetuser'] = set_session ('aaerror-login', $lang['u-access-disabled']);
		return false;
		
	} else if ($isauth >= 1) {

		aaModelSetUserSession($aauaccess, 
								$user['UID'], 
								$user['Fname'], 
								$user['Email'], 
								$user['Signature'],
								$user['Role'],
								$user['razao_social'],
								$user['Preferred_View'],
								$user['Layout_Style']);

		return true;

	} else {

		$form_error['aagetuser'] = set_session ('aaerror-login', $lang['u-access-error']);
		return false;

	}
}

// function for updating date and creating session on register and sign in page
function aaModelSetUserSession($aaaccess, $uid, $fname, $email, $signature, $role, $emp, $view, $style) {

	global $pdo_conn, $pdo_t;

	$sessionid = session_id();
	$now = timezone_time();

	$stmt = 'UPDATE '.$pdo_t['t_users'].' SET Session_ID = :sessionid, 
												Last_Logon = :dt 
												WHERE UID = :uid';
	$q = $pdo_conn->prepare($stmt);
	$q->execute(array(':sessionid' => $sessionid, ':dt' => $now, ':uid' => $uid));
	
	// start logged in session
	$_SESSION[$aaaccess]['aauid'] = $uid;
	$_SESSION[$aaaccess]['aaname'] = $fname;
	$_SESSION[$aaaccess]['aaemail'] = $email;
	$_SESSION[$aaaccess]['aasign'] = $signature;
	$_SESSION[$aaaccess]['aaurole'] = $role;
	$_SESSION[$aaaccess]['empresa'] = $emp;
	$_SESSION[$aaaccess]['aaview'] = $view;
	$_SESSION[$aaaccess]['aastyle'] = $style;	

}

// get agent details
function aaModelGetAgent($email) {

	global $pdo_conn, $pdo_t, $lang;
	$date_format = get_settings('Date_Format');
	
	$sql_agents = "SELECT *,
					DATE_FORMAT(Date_Created, '$date_format') AS DateAdd,
					CASE Role 
					WHEN 3 THEN '".$lang['set-user-role-admin']."'
					WHEN 2 THEN '".$lang['set-user-role-super']."'
					WHEN 1 THEN '".$lang['set-user-role-agent']."'
					WHEN 0 THEN '".$lang['set-user-role-user']."'
					END AS TextRole,
					DATE_FORMAT(Last_Logon, '$date_format') AS Lldate FROM ".$pdo_t['t_users']." WHERE Email = :email";
	 
	$agents = $pdo_conn->prepare($sql_agents);
	$agents->execute(array('email' => $email));
	
	return $agents;
	
}

// edit a user profile or agent in admin mode
function aaModelEditAgent ($uid, $fname, $email, $cnpj, $telno, $role, $signature = NULL, $u_notify_tn, $u_notify_tu, $u_notify_pm, $skills = NULL) {
	
	global $pdo_conn, $pdo_t, $lang;

	$fname = clean($fname, TRUE);
	$email = clean($email, TRUE);
	$telno = str_replace(" ", "", $telno); // remove any spaces in tele no
	$signature = clean($signature, TRUE);

	$u_notify_tn = (isset($u_notify_tn)) ? 1 : 0;
	$u_notify_tu = (isset($u_notify_tu)) ? 1 : 0;
	$u_notify_pm = (isset($u_notify_pm)) ? 1 : 0;	
	
	$form_error = array();
	// check fname
	if (!($fname && $email)) {
			
		echo '<div class="error-msg">'.$lang['generic-error-required-fields'].'</div>';
		$error = true;
		
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		
		echo '<div class="error-msg">'.$lang['generic-error-invalid-em'].'</div>';
		$error = true;
		
	} else if ($telno != "") {
		
		if (!is_numeric($telno)) {
			echo '<div class="error-msg">'.$lang['generic-error-invalid-tn'].'</div>';
			$error = true;
		}
		
	}
		
	if (!@$error) {
		
		// run sql to update user settings
		$sql_u_u = "UPDATE ".$pdo_t['t_users']." SET 
							Fname=:fname,
							Email=:email,
							cnpj=:cnpj,
							TeleNo=:telno,
							Role=:role,							
							Signature=:signature,
							Notify_TN=:u_notify_tn, 
							Notify_TU=:u_notify_tu, 
							Notify_PM=:u_notify_pm 
							WHERE UID = :uid";
		$q_u_u = $pdo_conn->prepare($sql_u_u);
		$q_u_u->execute(array('fname' => $fname, 
							'email' => $email,
							'cnpj' => $cnpj,
							'telno' => $telno,
							'role' => $role,
							'signature' => $signature,
							'u_notify_tn' => $u_notify_tn,
							'u_notify_tu' => $u_notify_tu,
							'u_notify_pm' => $u_notify_pm,
							'uid' => $uid));

			
		// delete all records associated to user id
		$sql_d_s = "DELETE FROM ".$pdo_t['t_users_skills']." WHERE UID = :uid";
		$q_d_s = $pdo_conn->prepare($sql_d_s);
		$q_d_s->execute(array('uid' => $uid)); 
		
		if (is_array($skills)) {
			foreach ($skills as $skill) {
				// reinsert all ticked records
				$sql_u_s_i = "INSERT INTO ".$pdo_t['t_users_skills']." (UID, CID) VALUES (:uid, :skill)";		
				$q_u_s_i = $pdo_conn->prepare($sql_u_s_i);
				if(!$q_u_s_i->execute(array('uid' => $uid, 'skill' => $skill))) {
				print_r($q_u_s_i->errorInfo());
				}
			}
		}
		

		echo '<div class="success-msg">'.$lang['generic-success-u-edit'].'</div>';
	
	}

}

// change password in settings admin mode
function aaModelResetPassword ($uid, $pwd, $emailto) {
	
	global $pdo_conn, $pdo_t, $lang;	

	$pwd_hash = hash('sha256', $pwd);
	$pwd_count = strlen($pwd);
	
	if ($pwd == "") {
	
		echo '<div class="error-msg">'.$lang['generic-error'].'</div>';
		
	} else if ($pwd_count < 6) {
	
		echo '<div class="error-msg">'.$lang['generic-error-pw-length'].'</div>';
	
	} else {
	
		// run sql to update user password
		$sql_u_p = "UPDATE ".$pdo_t['t_users']." SET Pwd = :pwd_hash WHERE UID = :uid";
		
		$q_u_p = $pdo_conn->prepare($sql_u_p);
		$q_u_p->execute(array("pwd_hash" => $pwd_hash, "uid" => $uid));

		// send email
		// subject for password reset		
		$subject = "Password Change!";
		// message to user
		$message = "Your new password is ".$pwd.".\n\nKind Regards\n\n".get_settings("Company_Name")."";		
		aaSendEmail($emailto, $subject, $message);
		
		echo '<div class="success-msg">'.$lang['set-user-edit-pwres-success'].'</div>';
	
	}
	
}

// forgotten password for user and admin
function aaForgottenPwd ($user) {
	
	global $pdo_conn, $pdo_t, $lang;
	
	$user = clean($user, TRUE);
		
	// check username exists
	$sql_u = "SELECT UID,Pwd,Fname,Email FROM ".$pdo_t['t_users']." WHERE Email = :user";
	$p_sql = $pdo_conn->prepare($sql_u);
	$p_sql->execute(array("user" => $user));
	$user_dets = $p_sql->fetch();
	
	$u_on = $p_sql->rowCount(); // number of results found

	// if username exists
	if ($u_on >= 1) {
	
		// store new password as sha256
		$newpass = aaPasswordGen();
		$hashpass = hash('sha256', $newpass);
		
		$sql_u_up = "UPDATE ".$pdo_t['t_users']." SET Pwd = :newpass WHERE Email = :user";			
		$p_u_up = $pdo_conn->prepare($sql_u_up);
		$p_u_up->execute(array("newpass" => $hashpass, "user" => $user));		
		
		// subject for password reset		
		$subject = "Password Reset!";
		// message to user
		$message = "<p>".$user_dets["Fname"]."</p><p>Your new password is <b>".$newpass."</b></p><p>Kind Regards</p>".get_settings("Company_Name")."";
		// send email
		aaSendEmail($user_dets["Email"], $subject, $message);
		
		echo $reset_succ = '<div class="success-msg">'.$lang['pwreset-email-succ'] .'</div>';
		
	} else {
		
		// if username and password incorrect then show error
		echo $reset_fail = '<div class="error-msg">'.$lang['pwreset-unknown-u'].'</div>';
				
	}

}

// forgotten password generator for users and admin
function aaPasswordGen() {

	// randomly generate code size
	$str_size = mt_rand(6,12);
	
	// characters to use in code
	$str = "abcdefghijklmnopqrstuvwxyz0123456789";
	
	// split characters into an array
	$str_array = str_split($str);
	
	// generate random keys from the character array up to the random code size
	$rand_keys = array_rand($str_array, $str_size);	

	// loop through character array and random keys until size is reached.
	for ($i = 1; $i <= $str_size; $i++) {
	
		$char = @$str_array[$rand_keys[$i]];
		
		@$code .= $char;
	
	}
	
	return $code;

}

// get groups
function aaModelGetGroups() {

	global $pdo_conn, $pdo_t;
	
	$sql = 'SELECT Cat_ID, Category, Def, Ticket_Assignment FROM '.$pdo_t['t_groups'].' WHERE Parent_ID IS NULL ORDER BY Category ASC';
	 
	$groups = $pdo_conn->prepare($sql);
	$groups->execute();
	
	return $groups;
	
}

// get priorities
function aaModelGetPriorities() {

	global $pdo_conn, $pdo_t;
	
	$sql = 'SELECT Level_ID, Level, Def, OrderID FROM '.$pdo_t['t_priorities'].' ORDER BY OrderID ASC';
	 
	$priorities = $pdo_conn->prepare($sql);
	$priorities->execute();
	
	return $priorities;
	
}

// get all custom fields
function aaModelGetCustomFields() {

	global $pdo_conn, $pdo_t;

	$sel_custom_fields = "SELECT * FROM ".$pdo_t['t_custom_fields']." ORDER BY FID";
	
	$customfields = $pdo_conn->prepare($sel_custom_fields);
	$customfields->execute();
	
	return $customfields;

}
// get agents
function aaModelGetAgents() {

	global $pdo_conn, $pdo_t;
	
	$select_agents = 'SELECT * FROM '.$pdo_t['t_users'].' WHERE Role BETWEEN 1 AND 3';
	 
	$agents = $pdo_conn->prepare($select_agents);
	$agents->execute();
	
	return $agents;
	
}

// get users
function aaModelGetUsers() {

	global $pdo_conn, $pdo_t;
	
	$sql_users = 'SELECT * FROM '.$pdo_t['t_users'].' WHERE Role = 0 ORDER BY Fname';
	 
	$q_users = $pdo_conn->prepare($sql_users);
	$q_users->execute();
	
	return $q_users;
	
}

// get empresas
function aaModelGetEmpresas() {

	global $pdo_conn, $pdo_t;
	
	$sql_users = 'SELECT * FROM '.$pdo_t['t_empresas'].' ORDER BY nome_fantasia';
	 
	$q_users = $pdo_conn->prepare($sql_users);
	$q_users->execute();
	
	return $q_users;
	
}

function aaModelGetAgentSkills($uid) {

	global $pdo_conn, $pdo_t;

	$sql = 'SELECT * FROM '.$pdo_t['t_users_skills'].' WHERE UID = :userid';
	
	$userskill = $pdo_conn->prepare($sql);
	$userskill->execute(array('userid' => $uid));
	
	$array_of_skills = array();
	// push each skill into array to compare array
	while ($agent_skill = $userskill->fetch(PDO::FETCH_ASSOC)) {
		array_push($array_of_skills, $agent_skill["CID"]);
	}
	
	return $array_of_skills;
}

function aaModelGetIEmailAccount($imailid) {

	global $pdo_conn, $pdo_t;

	$sql = "SELECT * FROM ".$pdo_t['t_iemail']." WHERE IMAILID = :imailid";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('imailid' => $imailid));
	
	return $q;

}

// Check username/email address is unique for new users - user regiser and agent add
function aaModelCheckUserUnique($userid) {

	global $pdo_conn, $pdo_t;

	$u_query = "SELECT Email FROM ".$pdo_t['t_users']." WHERE Email = :userid";

	$q = $pdo_conn->prepare($u_query);
	$q->execute(array('userid' => $userid));
	
	$rowcount = $q->rowCount();
	
	return $rowcount;
}

// get Canned replies
function aaModelGetCanned () {

	global $pdo_conn, $pdo_t;
	
	$sql = "SELECT * FROM ".$pdo_t['t_canned_msg'];
	$q = $pdo_conn->prepare($sql);
	$q->execute();
	
	return $q;
	
}

// get KB Groups
function aaModelGetKBGroups() {

	global $pdo_conn, $pdo_t;
	
    $sql = "SELECT * FROM ".$pdo_t['t_kb_groups']." ORDER BY KB_Group ASC";
	$q = $pdo_conn->prepare($sql);
	$q->execute();
	
	return $q;
	
}

// get ticket details by ID.
function aaModelGetTicketDetails($ticketid) {

	global $pdo_conn, $pdo_t, $date_format, $lang;
	
	// left join users for user detail, left join users with owner is for agent detail
	$ticket_details = "SELECT t.*,c.*,p.*,u.*, 
					DATE_FORMAT(t.Date_Added, '$date_format') AS DateAdd, 
					DATE_FORMAT(t.SLA_Reply, '$date_format') AS DateSlaR, 
					DATE_FORMAT(t.SLA_Fix, '$date_format') AS DateSlaF, 
					DATE_FORMAT(t.Date_Replied, '$date_format') AS DateRep, 
					DATE_FORMAT(t.Date_Updated, '$date_format') AS DateUp,
					CASE WHEN t.SLA_Reply IS NOT NULL 
					   THEN DATE_FORMAT(t.SLA_Reply, '$date_format')
					   ELSE '".$lang["generic-na"]."'
					END AS SLAR,
					CASE WHEN t.SLA_Fix IS NOT NULL 
					   THEN DATE_FORMAT(t.SLA_Fix, '$date_format')
					   ELSE '".$lang["generic-na"]."'
					END AS SLAF,
					(CASE WHEN t.Date_Closed IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Closed, '$date_format') END) AS DateClosed,
					(CASE WHEN t.Date_Replied IS NULL THEN 'N/A' ELSE DATE_FORMAT(t.Date_Replied, '$date_format') END) AS DateReplied,					
					(CASE WHEN t.Owner IS NULL THEN 'Unassigned' ELSE a.Fname END) AS Owned,
					(CASE t.Cat_ID WHEN c.Cat_ID THEN c.Category ELSE NULL END) AS Category,			
					(CASE t.Level_ID WHEN p.Level_ID THEN p.Level ELSE NULL END) AS Priority					
					FROM ".$pdo_t['t_ticket']." AS t 
					LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID=c.Cat_ID 
					LEFT JOIN ".$pdo_t['t_priorities']." AS p ON t.Level_ID=p.Level_ID
					LEFT JOIN ".$pdo_t['t_users']." AS u ON u.Email=t.User_Email
					LEFT JOIN ".$pdo_t['t_users']." AS a ON a.UID=t.Owner
					WHERE t.ID = :ticketid" ;
								
	$q = $pdo_conn->prepare($ticket_details);
	$q->execute(array('ticketid' => $ticketid));
	
	$fetchticketdetail = $q->fetch();
	
	return $fetchticketdetail;

}

// get ticket update details by ID
function aaModelGetTicketUpdates ($ticketid) {

	global $pdo_conn, $pdo_t, $date_format;

	$ticket_updates = "SELECT *,DATE_FORMAT(ups.Updated_At, '$date_format') AS Up_At 
					FROM ".$pdo_t['t_ticket_updates']." AS ups 
					LEFT JOIN ".$pdo_t['t_users']." AS tu ON tu.UID = ups.Update_By 
					WHERE ups.Ticket_ID = :ticketid ORDER BY ups.Updated_At ASC";

	$q = $pdo_conn->prepare($ticket_updates);
	$q->execute(array('ticketid' => $ticketid));
	
	return $q;
	
}

// Get SLA for ticket based on group and priority
function aaModelGetTicketSLA($dt, $gid, $pid) {
	
	global $pdo_conn, $pdo_t;	

	// get sla for group and priority
	$sql_sla = "SELECT SLA_Reply_Days, SLA_Reply_Hours, SLA_Fix_Days, SLA_Fix_Hours FROM ".$pdo_t['t_slas']." WHERE GID = :gid AND PID = :pid";
	$q_sla = $pdo_conn->prepare($sql_sla);
	$q_sla->execute(array('gid' => $gid, 'pid' => $pid));
	$sla = $q_sla->fetch();
	$sla_count = $q_sla->rowCount();
	
	// if sla set
	if ($sla_count > 0) {		
		// convert date to string
		$nowtostr = strtotime($dt);
		//echo $now.'<br>'.$sla['SLA_Reply_Days'].'<br>';
		// add days and hours to sla reply and sla fix
		$slar = date("Y-m-d H:i:s", strtotime("+".$sla['SLA_Reply_Days']." day +".$sla['SLA_Reply_Hours']." hour", $nowtostr));
		$slaf = date("Y-m-d H:i:s", strtotime("+".$sla['SLA_Fix_Days']." day +".$sla['SLA_Fix_Hours']." hour", $nowtostr));				
	} else {
		$slar = NULL;
		$slaf = NULL;
	}
	
	return array ($slar, $slaf);
	
}

// Get automatic ticket assignment by group
function aaModelGetTicketAssignment($gid) {
	
	global $pdo_conn, $pdo_t;	
	
	$ta_sql = "SELECT Ticket_Assignment FROM ".$pdo_t['t_groups']." WHERE Cat_ID = :gid";
	$ta_q = $pdo_conn->prepare($ta_sql);
	$ta_q->execute(array('gid' => $gid));
	$ta = $ta_q->fetch();
	
	return $assignment = ($ta['Ticket_Assignment'] == NULL) ? NULL : $ta['Ticket_Assignment'];

}

// file upload directory
function aaFileUpDir() {

	$file_upload = get_settings("File_Enabled");
	$dir = get_settings("File_Path");
	
	if ($file_upload == 1) {
		
		if (file_exists($dir)) {
			
			if (is_dir($dir)) {
				
				if (is_writable($dir)) {
		
					// folder exists, is directory and writable
					return true;
					
				} else {
					
					return false;				
				
				}
							
			} else {
			
				return false;
			
			}
			
		} else {
			
			return false;
		
		}
		
	} else {
		
		return false;
		
	}

}

// delete folder and files associated with ticket
function aaFileDelete($target) {

    if(is_dir($target)){
		
		$files = glob($target.'*.*', GLOB_MARK); //GLOB_MARK adds a slash to directories return
        
        foreach( $files as $file )
        {
            aaFileDelete ( $file );
        }

        rmdir( $target );
    
	} elseif(is_file($target)) {
		
		unlink( $target );  
    
	}
}

// check file types
function aaFileTypeCheck($filename) {

	$allowed_file_type = explode(",", get_settings("File_Type"));
	$path_parts = pathinfo($filename); // get extension from file

	if (in_array($path_parts['extension'], $allowed_file_type)) {
		return true;
	} else {
		return false;
	}
	
}

// check file size
function aaFileSizeCheck($filesize) {
	
	$allowed_file_size = get_settings("File_Size");
	
	if ($filesize > $allowed_file_size) {
		return false;
	} else {	
		return true;
	}
	
}

// upload file
function aaFileUpload ($filetmpname, $uploadfile) {
		
	// ATTEMPT TO UPLOAD FILE
	if (move_uploaded_file($filetmpname, $uploadfile)) {
		echo "File is valid, and was successfully uploaded.<br>";
	} else {
		echo "Possible file upload attack!\n";
	}
	
}

// get next automatic increment id
function aaNextTicketAutoInc() {
	
	global $pdo_conn, $pdo, $pdo_t;
	$sql_aid = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$pdo['db']."' AND TABLE_NAME = '".$pdo_t['t_ticket']."'";
	$q_aid = $pdo_conn->prepare($sql_aid);
	$q_aid->execute();
	$f_aid = $q_aid->fetch();
	return $f_aid["AUTO_INCREMENT"];
			
}

// get next aumatic increment id for ticket updates - for file uploads
function aaNextTicketUpdateAutoInc() {
	
	global $pdo_conn, $pdo, $pdo_t;
	$sql_aid = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$pdo['db']."' AND TABLE_NAME = '".$pdo_t['t_ticket_updates']."'";
	$q_aid = $pdo_conn->prepare($sql_aid);
	$q_aid->execute();
	$f_aid = $q_aid->fetch();
	return $f_aid["AUTO_INCREMENT"];
			
}


// Insert ticket for user and admin area
function aaModelInsertRequest($u, $ue, $group, $priority, $subject, $message, $files, $customfield = NULL, $code = NULL) {

	global $pdo_conn, $pdo_t, $lang;

	$db_antispam = get_settings("Ticket_Antispam");

	$form_error = array();

	$u = clean($u, TRUE);
	$u_email = clean($ue, TRUE);
	$cat = clean($group, TRUE);
	$level = clean($priority, TRUE);
	$subject = clean($subject, TRUE);
	$message = clean($message, FALSE);
	$email_format_reply = $_POST["notes"];
	@$code = $code;
	
	$aa_ip = $_SERVER['REMOTE_ADDR'];
	$aa_referer = $_SERVER['HTTP_REFERER'];
	$ua=getBrowser();
	$aa_browser = $ua['name']." ".$ua['version']." [".$ua['platform']."]";

	// check name
	if (form_validate ("TEXT", $u) === TRUE) {
			
		$form_error['name'] = set_session ('aaerror-add-null', '<div class="error-msg">'.$lang['generic-error-required-fields'].'</div>');
			
	} 
	
	// check email address
	if (form_validate ("EMAIL", $u_email) === TRUE) {
	
		$form_error['email'] = set_session ('aaerror-add-email', '<div class="error-msg">'.$lang['generic-error-invalid-em'].'</div>');

	} 
	
	// check subject
	if (form_validate ("TEXT", $subject) === TRUE)  {	
		
		$form_error['subject'] = set_session ('aaerror-add-null', '<div class="error-msg">'.$lang['generic-error-required-fields'].'</div>');

	}
	
	// check note
	if (form_validate ("TEXT", $message) === TRUE)  {	
		
		$form_error['note'] = set_session ('aaerror-add-null', '<div class="error-msg">'.$lang['generic-error-required-fields'].'</div>');

	}
	
	// if code in arguement
	if (!is_null($code)) {
		if ($db_antispam == 1) {	
			// if securirty code doesn't exist
			if ($code != $_SESSION["code"]) {
			
				$form_error['code'] = set_session ('aaerror-add-code', '<div class="error-msg">'.$lang['generic-error-invalid-code'].'</div>');
		
			}
		}
	}
	if (!is_null($customfield)) {
	
	foreach ($customfield as $custom=>$custom_opt) {
		$cf_sql = "SELECT * FROM ".$pdo_t['t_custom_fields']." WHERE Field_Name = :customfield";
		$cf_prep = $pdo_conn->prepare($cf_sql);
		$cf_prep->execute(array('customfield' => $custom));
		
		$cf = $cf_prep->fetch();
		
		if (is_array($custom_opt)) {
			// count to ensure checked options is greater than 1
			$count = count($custom_opt);
			if ($cf["Field_Required"] == 1 && $count == 1) {
				
				$form_error[$custom] = set_session ('aaerror-custom['.$custom.']', $lang["generic-error"]);
				
			} else {
				
				// add initial colon for option string
				$custom_sql_vals .= "'";
				
				foreach ($custom_opt as $custom_array_name => $custom_array_opt) {
				
					if ($custom_array_opt != "0") {
					
						// create sql string of array values
						$custom_sql_vals .= $custom_array_opt."#";
						// checkbox value for if errored
						$custom_set_val[$custom]["ck"] = $custom_array_opt;
					
					}
										
				}
				
				// trim last # off checkbox array
				$custom_sql_vals = trim($custom_sql_vals, "#");
				// add end colon for option string
				$custom_sql_vals = $custom_sql_vals."'";
			
			}
			
		} else {

			if ($cf["Field_Required"] == 1 && $custom_opt == "") {
			
				$form_error[$custom] = set_session ('aaerror-custom['.$custom.']', $lang["generic-error"]);
			
			} else {
				
				$custom_opt = clean($custom_opt, TRUE);
				// create sql string of values
				@$custom_sql_vals .= ",'".$custom_opt."',";
				
			}			
		
		}	
		

		@$custom_sql_fields .= ",".$custom;
		$custom_sql_vals = str_replace(",,",",",$custom_sql_vals);
		//echo $custom." ".$custom_opt."<br>";
	}
	$custom_sql_fields = rtrim($custom_sql_fields, ",");
	$custom_sql_vals = rtrim($custom_sql_vals, ",");
	}
	//print_r($customfield);
	//echo $custom_sql_fields."<br>".$custom_sql_vals;
	
	//print_r($files);
	// upload files
	if (empty($form_error)) {
		
		if (!(empty($files["name"][0]))) { // if array 0 empty due to no file upload
	
			$aid = aaNextTicketAutoInc(); // next ticket auto increment
			$dir = get_settings("File_Path");
			$no_of_files = count($files["name"]); // reduce by 1 to include 0
			$allowed_file_size = get_settings("File_Size");
			$allowed_file_type = get_settings("File_Type");

			if (aaFileUpDir()) {
				
				for ($key = 0; $key <= $no_of_files - 1; $key++) {
										
					if (aaFileTypeCheck($files['name'][$key])) {
						
						if (aaFileSizeCheck($files['size'][$key])) {
							$file_ok = true;
						} else {
							$file_error['file'] = set_session ('aaerror-file', '<div class="error-msg">'.$lang['generic-file-size-rule'].' '.$allowed_file_size.'</div>');
							$file_ok = false;
						}
						
					} else {
						$file_error['file'] = set_session ('aaerror-file', '<div class="error-msg">'.$lang['generic-file-type-rule'].' '.$allowed_file_type.'</div>');
						$file_ok = false;
					}
				}
					
				if ($file_ok) {
					if(@mkdir($dir.$aid)) {
						for ($key = 0; $key <= $no_of_files - 1; $key++) {
							
							$uniqid = uniqid();
							
							$files['name'][$key] = str_replace(" ", "_", $files['name'][$key]); // remove spaces from filename
							
							$db_files .= $uniqid.'___'.basename($files['name'][$key]).";";
							$uploadfile = $dir . $aid ."/" . $uniqid . '___' . basename($files['name'][$key]);	
							aaFileUpload ($files['tmp_name'][$key], $uploadfile);

						}
					}
				}	
							
			} else {
				
				$file_error['file'] = set_session ('aaerror-file', '<div class="error-msg">'."ERROR Uploading file. Upload directory is either non existant, unwritabble or not a directory.".'</div>');
			
			}
			
		}
	}
		
	// if no errors then add
	if (empty($form_error) && (empty($file_error))) {
		// set date format from settings

		$now = timezone_time();
		$db_files = (isset($db_files)) ? $db_files : ""; // if file uploaded then use db str else blank for sql insert
		list ($slar, $slaf) = aaModelGetTicketSLA(timezone_time(), $cat, $level); // get SLA reply and fix by group and priority
		
		// get ticket assignment for each group		
		$assignment = aaModelGetTicketAssignment($cat);
		
		$insert_request = "INSERT INTO ".$pdo_t['t_ticket']." (User, User_Email, Cat_ID, t_GID_Origin, Level_ID, Type, Subject, Message, Files, IP_Address, Page_Referer, Browser, Status, Owner, SLA_Reply, SLA_Fix, Date_Added, Date_Updated $custom_sql_fields)
		VALUES (:u, :u_email, :cat, :gid_o, :level, :type, :subject, :message, :files, :aa_ip, :aa_referer, :aa_browser, :status, :assignment, :slar, :slaf, :dateadd, :dateup $custom_sql_vals)";  

		$q = $pdo_conn->prepare($insert_request);
    	
		if ($q->execute(array('u' => $u,
							'u_email' => $u_email, 
							'cat' => $cat,
							'gid_o' => $cat,
							'level' => $level,
							'type' => "Web",
							'subject' => $subject,
							'message' => $message,
							'files' => $db_files,
							'aa_ip' => $aa_ip, 
							'aa_referer' => $aa_referer, 
							'aa_browser' => $aa_browser,
							'status' => "Open", 
							'assignment' => $assignment, 
							'slar' => $slar,
							'slaf' => $slaf,
							'dateadd' => $now, 
							'dateup' => $now))) {
								
				$lastId = $pdo_conn->lastInsertId();				
				
				// if ticket automatically assigned to agent then insert update
				if (!is_null($assignment)) {
					// insert update of change into database with now and text from above statements
					$sql_tu_i = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
					VALUES (:tid, :changeby, :now, :u_type, :u_time, :u_text, :u_public)";
					$q_tu_i = $pdo_conn->prepare($sql_tu_i);
					$q_tu_i->execute(array('tid' => $lastId, 'changeby' => 'System', 'now' => $now, 'u_type' => "Change", 'u_time' => "1", 'u_text' => $lang['ticket-add-autoassign'], 'u_public' => 1));
				}

			// email user with ticket details
			aaSendEmailTicketUpdate($lastId, "Open", $u_email, $email_format_reply);
			
			// send notification of new ticket to selected users
			aaSendEmailNewTicketNotification('Novo chamado ['.$lastId.'] recebido', $subject.'<p>---</p><p>'.decode_entities($email_format_reply).'</p>'); 						
			
			//echo "It's added";
			// redirect to success page
			$uri_parts = explode('?', $_SERVER['PHP_SELF'], 2);
			header('Location: '. $uri_parts[0].'?p=ticket-add-success&ue=' . urlencode($u_email) . '&tid=' . urlencode($lastId) . '');
			
		} else {
			
			echo "ERROR";
			print_r($pdo_conn->errorInfo());
			
		}
			
	}
	
}

function aaPHPDateFormat($odt) {
	
	$date_format = get_settings('Date_Format'); // get preferred date format
	
	$mysql_dt = array('%D', '%b', '%y', '%H', '%i', '%s'); // mysql date format
	$php_dt = array('jS', 'M', 'y', 'H', 'i', 's'); // php date format
	$php_date_format = str_replace($mysql_dt, $php_dt, $date_format); // PHP date format
	$ndt = new DateTime($odt);
	$phpdt = $ndt->format($php_date_format); // set new format
	
	return $phpdt;
	
}

// set default time zone from settings general page
function timezone_time() {
		
	date_default_timezone_set(get_settings("Timezone"));
	
	return date("Y-m-d H:i:s");
	
}

function time_difference($dt) {
	
	global $lang;
	
	$now = timezone_time();
	
	$datetime1 = new DateTime($now);
	$datetime2 = new DateTime($dt);
	$interval = $datetime1->diff($datetime2);
	$diff = $interval->format('%r');
	if ($diff == "-") {
		return '<span class="text-xsmall error">'.$lang['ticket-details-sla-ex'].' '.$interval->format('%d days %h hours %i minutes').'</span>';
	} else {
		return '<span class="text-xsmall success">'.$lang['ticket-details-sla-rem'].' '.$interval->format('%d days %h hours %i minutes').'</span>';
	}
	
}

function aaDateRange($daterange) {

	switch ($daterange) {
		case "today":
			$filter_date_from = date("Y-m-d",strtotime("today"));
			$filter_date_to = date("Y-m-d",strtotime("tomorrow"));
			break;
		case "yesterday":
			$filter_date_from = date("Y-m-d",strtotime("yesterday"));
			$filter_date_to = date("Y-m-d",strtotime("today"));
			break;
		case "this_week":
			$filter_date_from = date("Y-m-d",strtotime("monday this week"));
			$filter_date_to = date("Y-m-d",strtotime("tomorrow"));
			break;
		case "last_week":
			$filter_date_from = date("Y-m-d",strtotime("monday last week"));
			$filter_date_to = date("Y-m-d",strtotime("monday this week"));
			break;
		case "this_month":
			$filter_date_from = date("Y-m-d",strtotime("first day of this month"));
			$filter_date_to = date("Y-m-d",strtotime("tomorrow"));
			break;
		case "last_month":
			$filter_date_from = date("Y-m-d 00:00:00",strtotime("first day of last month"));
			$filter_date_to = date("Y-m-d 23:59:59",strtotime("last day of last month"));
			break;	
		case "anytime":
		case "custom":
			$filter_date_from = @$_POST["rep_period_from"].' 00:00:00';
			$filter_date_to = @$_POST["rep_period_to"].' 23:59:59';
			break;			
	}
	
	return array(@$filter_date_from, @$filter_date_to);	
}

function decode_entities($input) {
	
	$input = html_entity_decode(stripslashes($input));
	
	return $input;
	
}

// select langauge file and generate select box	
function select_langauge() {
		
	$dir    = '../public/language';
	$directory = scandir($dir);
	$scanned_directory = array_diff($directory, array('..', '.','.DS_Store'));
	
	$default_lang = get_settings("Langauge");
			
	echo '<select name="lang" id="lang">';
	
	foreach ($scanned_directory as $lang_file) {
	
		$lang_file = str_replace('.php', '', $lang_file);
		
		if ($default_lang == $lang_file) {            
			echo '<option value='.$lang_file.' selected="selected">'.ucfirst($lang_file).'</option>';
		} else if (@$_SESSION['aa-user-lang'] == $lang_file) {
			echo '<option value='.$lang_file.' selected="selected">'.ucfirst($lang_file).'</option>';
		} else {
			echo '<option value='.$lang_file.'>'.ucfirst($lang_file).'</option>';
		}
	
	}
	
	echo '</select>';
        
}

// use language for each status
function aa_select_ticket_status_lang($ticket_status) {
	
	global $lang;
	
	switch ($ticket_status) {
		case "Open":
			$aa_ticket_status_lang = $lang['tickets-status-open'];
			break;
		case "Awaiting Reply":
			$aa_ticket_status_lang = $lang['tickets-status-ar'];
			break;
		case "Pending":
			$aa_ticket_status_lang = $lang['tickets-status-pending'];
			break;
		case "Paused":
			$aa_ticket_status_lang = $lang['tickets-status-paused'];
			break;
		case "Closed":
			$aa_ticket_status_lang = $lang['tickets-status-closed'];
			break;	
	}
	return $aa_ticket_status_lang;
}


function aa_select_ticket_type_lang($ticket_type) {
	
	global $lang;
	
	switch ($ticket_type) {
		case 'Web':
			$aa_ticket_type_lang = '<i class="fa fa-globe"></i> '.$lang['ticket-type-form'];
			break;
		case 'Chat':
			$aa_ticket_type_lang = '<i class="fa fa-comments"></i> '.$lang['ticket-type-chat'];
			break;
		case 'Widget':
			$aa_ticket_type_lang = '<i class="fa fa-globe"></i> '.$lang['ticket-type-widget'];
			break;
		case 'Email':
			$aa_ticket_type_lang = '<i class="fa fa-envelope-o"></i> '.$lang['ticket-type-email'];
			break;
	}
	return $aa_ticket_type_lang;	
}

function clean ($v, $opt_clean = false) {
	$v = trim($v);
	$v = $opt_clean === TRUE ? strip_tags($v) : $v;
	$v = htmlentities($v, NULL, "UTF-8");
	return $v;
}

function strip_html_tags( $text ) {
    $text = preg_replace(
        array(
          // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
          // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((h[1-9])|(ins)|(isindex)|(p)|(pre))@iu', // removed (div) from june 2016
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ),
        $text );
    	
		$text = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $text);
		
		// do not allow divs as they affect the layout of the page.ticket.php
    	return strip_tags( $text, '<p></p><br><a></a><strong></strong><b></b><em></em><u></u><ul></ul><ol></ol><li></li>' );

}

// validate form field for text and numbers
function form_validate ($type, $field) {

	if ($type == 'TEXT') {
	
		if ($field == NULL) {
						
			return TRUE;

		}
		
	}
	
	if ($type == 'EMAIL') {
	
		if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
		
			return TRUE;
			
		}
		
	}
	
	if ($type == 'NUMBER') {
	
		if (!is_numeric($field)) {
		
			return true;
			
		}
		
	}
	
}

// validate time in slas and time spent for ticket
function time_validate ($val) {
	if (!preg_match("/^-?([0-7]?[0-9]{1,2}|8([0-2][0-9]|3[0-8]))(:[0-5][0-9]){1,2}$/D", $val)) {
		return false;
	} else {
		return true;
	}
}

// show post value or db value in form fields
function cached_fields ($v, $dbval = NULL) {
	
	if (isset($v)) {
		echo $v;
	} else if (!is_null($dbval)) {
		echo $dbval;
	} else {
		echo "";
	}
}

function set_session ($k, $v) {
	@$_SESSION[$k] = $v;
    setcookie($k, $v, (time() + (14 * 24 * 3600)), $_SERVER['SERVER_NAME']);
}

function read_session ($k) {
	if (isset($_SESSION[$k])) { 
	//	echo $_SESSION[$k]; 
	//	unset($_SESSION[$k]); 
	}else{
      $_SESSION[$k] = $_COOKIE[$k];
    }
}

// get admin styles to be selected
function aaGetCustomStyles() {
	
	$dir = '../public/css/custom/';
	$files1 = preg_grep('/^([^.])/', scandir($dir));

	echo '<select name="user-style">';
	foreach ($files1 as $file) {
		$file = substr($file, 0, strrpos($file, "."));
		
		echo '<option value="'.$file.'">'.ucfirst($file).'</option>';
		
	}
	echo '</select>';

}

function highlight($str, $keywords) {
	$keywords = implode('|',explode(';',preg_quote($keywords)));
	$str = preg_replace("/($keywords)/i","<mark>$0</mark>",$str);
	return $str;
}

// get browser name
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

// send email via PHP mail or SMTP settings
require 'phpmailer/PHPMailerAutoload.php';
function aaSendEmail($to, $subject, $message) {
	
	$email_on = get_settings("Email_Enabled");
	$email_method = get_settings("Email_Method");
	
	if ($email_on == 1) {
		echo "1";
		if ($email_method == 'PHPMAIL') {
		echo "php";
			$headers = 'From: '.get_settings("Email_Display").' <'.get_settings("Email_Addr").'>' . "\r\n" .
						'Reply-To: '.get_settings("Email_Re_Addr").'' . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$mail_sent = mail($to, $subject, $message, $headers);
			
			// if email fails
			if (!$mail_sent) {
				echo "<p>Failed to send the following email</p>".
					"<p>To: ".$to."</p>".
					"<p>Subject: ".$subject."</p>".
					"<p>Message: ".html_entity_decode($message)."</p>";
			}
		
		} else if ($email_method == 'SMTP') {
			
			$mail = new PHPMailer;
			
			//$mail->SMTPDebug = 3;                               // Enable verbose debug output
			
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = get_settings("Email_SMTP_Host");  // Specify main and backup SMTP servers
			$mail->SMTPAuth = get_settings("Email_SMTP_Auth");                                // Enable SMTP authentication
			$mail->Username = get_settings("Email_SMTP_User");                  // SMTP username
			$mail->Password = get_settings("Email_SMTP_Pass");                           // SMTP password
			$mail->SMTPSecure = get_settings("Email_SMTP_Encr");                           // Enable TLS encryption, `ssl` also accepted
			$mail->Port = get_settings("Email_SMTP_Port");                                   // TCP port to connect to
            $mail->CharSet = 'UTF-8';
			
			$mail->From = get_settings("Email_Addr");
			$mail->FromName = get_settings("Email_Display");
			$mail->addAddress($to);     // Add a recipient
			$mail->addReplyTo(get_settings("Email_Re_Addr"));
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
			
			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML
			
			$mail->Subject = $subject;
			$mail->Body    = $message;
            //$mail->SMTPDebug = 1;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			$mail->SMTPOptions = array (
                'ssl' => array (
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				//echo 'Message has been sent';
			}
			
		} // end email method
			
	} else {
		
			echo "<p>ERROR! Outbound email not turned on in Settings > Outbound Email</p>";
		
	}		

}

function aaSendEmailTicketUpdate($tid, $status, $to, $email_content) {

	global $pdo_conn, $pdo_t, $lang;

	$date_format = get_settings("Date_Format");
	$email_method = get_settings("Email_Method");

	if (get_settings("Email_Enabled") == 1) {
	
		switch ($status) {
			case "Open":
				$subject = get_settings("Email_New_Subject");
				$message = get_settings("Email_New_Body");
				break;
			case "Pending":
				$subject = get_settings("Email_Update_Subject");
				$message = get_settings("Email_Update_Body");
				break;
			case "Paused":
				$subject = get_settings("Email_Paused_Subject");
				$message = get_settings("Email_Paused_Body");
				break;
			case "Closed":
				$subject = get_settings("Email_Closed_Subject");
				$message = get_settings("Email_Closed_Body");
				break;
			case "Forward":
				$subject = get_settings("Email_Forward_Subject");
				$message = get_settings("Email_Forward_Body");
				break;
		}
		
		// place code and alternative into array
		$code = array("[TICKET_NO]", "[TICKET_DATE_ADDED]", "[TICKET_DATE_UPDATED]", "[TICKET_SUBJECT]", "[TICKET_ENQUIRY]", "[TICKET_USER]", "[TICKET_UPDATE]", "[TICKET_CATEGORY]", "[TICKET_PRIORITY]", "[TICKET_SLAR]", "[TICKET_SLAF]");
		
		// select ticket details to be inserted in place of codes
		$sql = "SELECT
				t.ID,
				DATE_FORMAT(t.Date_Added, '$date_format') AS DateAdd,
				DATE_FORMAT(t.Date_Updated, '$date_format') AS DateUp, 
				t.Subject,
				t.User,
				t.Message,
				t.Cat_ID,
				CASE t.Cat_ID WHEN c.Cat_ID THEN c.Category ELSE NULL END Category,
				t.Level_ID,
				CASE t.Level_ID WHEN p.Level_ID THEN p.Level ELSE NULL END Priority,
				DATE_FORMAT(t.SLA_Reply, '$date_format') AS SLAR,
				DATE_FORMAT(t.SLA_Fix, '$date_format') AS SLAF
				FROM ".$pdo_t['t_ticket']." AS t
				LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID 
				LEFT JOIN ".$pdo_t['t_priorities']." AS p ON t.Level_ID = p.Level_ID 
				WHERE ID = :tid";
		$q = $pdo_conn->prepare($sql);
		$q->execute(array('tid' => $tid));
		$email_ticket = $q->fetch();
		
		// info to replace codes in order
		$input = array($email_ticket["ID"], $email_ticket["DateAdd"], $email_ticket["DateUp"], html_entity_decode($email_ticket["Subject"]), html_entity_decode($email_ticket["Message"]), $email_ticket["User"], stripslashes($email_content), $email_ticket["Category"], $email_ticket["Priority"], $email_ticket["SLAR"], $email_ticket["SLAF"]);
		
		// replace codes within subject and message
		$subject = str_replace($code, $input, $subject);
		$message = str_replace($code, $input, $message);
		
		// send email with email function
		aaSendEmail($to, $subject, '<div style="display:none; visibility:hidden">---- reply above this line ---</div>'.$message);
				
	} // end if email enabled
	
}

// send email notification of new messages to agents
function aaSendEmailNewTicketNotification($new_ticket_subject, $new_ticket_message) {
	
	global $pdo_conn, $pdo_t, $lang;
	
	$sql = "SELECT Email FROM ".$pdo_t['t_users']." WHERE Notify_TN = 1";
	$q = $pdo_conn->prepare($sql);
	$q->execute();
	$agents = $q->fetchAll();
		
	foreach ($agents as $u) {
	
		aaSendEmail($u['Email'], $new_ticket_subject, $new_ticket_message);
		
	}	

}

// send email notification for updated tickets
function aaSendEmailUpdateTicketNotification($tid) {
	
	global $pdo_conn, $pdo_t, $lang;
	
	$sql = "SELECT Email, Notes
			FROM ".$pdo_t['t_users']." AS u
			LEFT JOIN ".$pdo_t['t_ticket']." AS t ON t.Owner = u.UID
			LEFT JOIN ".$pdo_t['t_ticket_updates']." AS tu ON t.ID = tu.Ticket_ID
			WHERE t.ID = :tid
			AND u.Notify_TU = 1
			ORDER BY tu.Updated_At DESC 
			LIMIT 1";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array("tid" => $tid));
	$u = $q->fetch();
	
	aaSendEmail($u['Email'], 'Ticket '.$tid.' has been updated', 'Support request '.$tid.' as has been updated by the customer. <p>'.decode_entities($u['Notes']).'</p>');
	
}

// send email notification for private note
function aaSendEmailPrivateTicketNotification($tid) {
	
	global $pdo_conn, $pdo_t, $lang;
	
	$sql = "SELECT Email, Owner, Update_By, Updated_At, Notes 
			FROM ".$pdo_t['t_users']." AS u 
			LEFT JOIN ".$pdo_t['t_ticket']." AS t ON t.Owner=u.UID
			LEFT JOIN ".$pdo_t['t_ticket_updates']." AS tu ON t.ID=tu.Ticket_ID
			WHERE t.ID= :tid AND u.Notify_PM = 1 
			ORDER BY tu.Updated_At DESC LIMIT 1";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array("tid" => $tid));
	$u = $q->fetch();
	
	// if update isn't by owner of ticket
	if ($u['Update_By'] != $u['Owner']) {
		aaSendEmail($u['Email'], 'Private message added to '.$tid, 'You have been left a private message on ticket '.$tid.'<p>'.decode_entities($u['Notes']).'</p>');
	}
	
}
?>