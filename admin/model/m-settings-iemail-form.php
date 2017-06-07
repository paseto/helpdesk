<?php
function form_checkbox($var) {
	
	if ($var == '1') {
		
		echo 'checked="checked"';
	
	}
	
}

// save incoming email
function aaModelSaveIEmail($imail_email, $imail_host, $imail_port, $imail_prot, $imail_ssl, $imail_cert, $imail_tls, $imail_folder, $imail_user, $imail_pass, $imail_group, $imail_priority, $imail_id) {	

	global $pdo_conn, $pdo_t, $lang;
	
	$imail_ssl = (isset($imail_ssl)) ? 1 : 0;
	$imail_tls = (isset($imail_tls)) ? 1 : 0;
	
	if ($imail_email == "") {
		
		$error['imail_email'] = set_session ('imail_email', $lang["generic-error"]);

	} else if (!filter_var($imail_email, FILTER_VALIDATE_EMAIL)) {
			
		$error['imail_email'] = set_session ('imail_email', $lang['generic-error-invalid-em']);

	}
	
	if ($imail_host == "") {
		
		$error['imail_host'] = set_session ('imail_host', $lang["generic-error"]);
	}
	
	if ($imail_port == "") {
		
		$error['imail_port'] = set_session ('imail_port', $lang["generic-error"]);

	} else if (!is_numeric($imail_port)) {
		
		$error['imail_port'] = set_session ('imail_port', $lang['generic-error-number-req']);

	}
	
	if ($imail_folder == "") {
		
		$error['imail_folder'] = set_session ('imail_folder', $lang['generic-error']);

	}
	
	if ($imail_user == "") {
		
		$error['imail_user'] = set_session ('imail_user', $lang['generic-error']);

	}
	
	if ($imail_pass == "") {
		
		$error['imail_pass'] = set_session ('imail_pass', $lang['generic-error']);

	}
	
	
	if (empty($error)) {
		
		if ($imail_id == "") {
			
			// insert priority name plus order ID of last id plus 1
			$sql = "INSERT INTO ".$pdo_t['t_iemail']." (Email_Addr, Email_Host, Port_No, Protocol, Email_SSL, Val_Cert, Email_TLS, Email_Folder, Email_User, Email_Pass, Email_Group, Priority) VALUES (:imail_email,
			:imail_host,
			:imail_port,
			:imail_prot,
			:imail_ssl,
			:imail_cert,
			:imail_tls,
			:imail_folder,
			:imail_user,
			:imail_pass,
			:imail_group,
			:imail_priority)";
			
			$q = $pdo_conn->prepare($sql);
		
			if($q->execute(array(
			'imail_email' => $imail_email, 
			'imail_host' => $imail_host, 
			'imail_port' => $imail_port, 
			'imail_prot' => $imail_prot, 
			'imail_ssl' => $imail_ssl, 
			'imail_cert' => $imail_cert, 
			'imail_tls' => $imail_tls, 
			'imail_folder' => $imail_folder, 
			'imail_user' => $imail_user, 
			'imail_pass' => $imail_pass, 
			'imail_group' => $imail_group, 
			'imail_priority' => $imail_priority))) {
			
			header('Location: p.php?p=settings-iemail');
			
			}			
					
		} else {
			
			$sql = "UPDATE ".$pdo_t['t_iemail']." SET Email_Addr = :imail_email,
			Email_Host = :imail_host,
			Port_No = :imail_port,
			Protocol = :imail_prot,
			Email_SSL = :imail_ssl,
			Val_Cert = :imail_cert,
			Email_TLS = :imail_tls,
			Email_Folder = :imail_folder,
			Email_User = :imail_user,
			Email_Pass = :imail_pass,
			Email_Group = :imail_group,
			Priority = :imail_priority
			WHERE IMAILID = :imail_id";

			$q = $pdo_conn->prepare($sql);
		
			if($q->execute(array(
			'imail_email' => $imail_email, 
			'imail_host' => $imail_host, 
			'imail_port' => $imail_port, 
			'imail_prot' => $imail_prot, 
			'imail_ssl' => $imail_ssl, 
			'imail_cert' => $imail_cert, 
			'imail_tls' => $imail_tls, 
			'imail_folder' => $imail_folder, 
			'imail_user' => $imail_user, 
			'imail_pass' => $imail_pass, 
			'imail_group' => $imail_group, 
			'imail_priority' => $imail_priority,
			'imail_id' => $imail_id))) {
			
			header('Location: p.php?p=settings-iemail');
			
			}			


		}
	
	}

}

?>