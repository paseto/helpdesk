<?php
// function for tick or cross
function checkbox_icon($var) {

	if ($var == 1) {
	
		echo '&#10003;';
		
	} else {
		
		echo 'x';
		
	}
}

// get incoming email details
function aaModelGetIEmail () {	

	global $pdo_conn, $pdo_t;

	$sql = "SELECT * FROM ".$pdo_t['t_iemail']." AS im 
			LEFT JOIN ".$pdo_t['t_groups']." AS c ON im.Email_Group = c.Cat_ID
			LEFT JOIN ".$pdo_t['t_priorities']." AS p ON im.Priority = p.Level_ID";
			
	$q = $pdo_conn->prepare($sql);

	$q->execute();
	
	return $q;	
}

// test incoming email connection
function aaModelEmailConnect ($imailid) {
	
	// select account details
	$imail_account = aaModelGetIEmailAccount($imailid);
	$imail_test = $imail_account->fetch();
		
	$host = $imail_test['Email_Host']; // host
	$port = $imail_test['Port_No']; // port
	$service = "/".$imail_test['Protocol']; // imap, imap2, imap2bis, imap4, imap4rev1, pop3, nntp
	
	$folder = $imail_test['Email_Folder']; // folder
	
	// ssl
	if($imail_test['Email_SSL'] == 1) {
		$ssl = "/ssl";
	} else {
		$ssl = "";
	}
	
	// tls, notls
	if($imail_test['Email_TLS'] == 1) {
		$tls = "/tls";
	} else {
		$tls = "/notls";
	}
	
	// /novalidate-cert, /validate-cert
	$cert = $imail_test['Val_Cert'];
	
	$server = "{".$host.":".$port.$service.$cert.$ssl.$tls."}".$folder;
	$login = $imail_test['Email_User'];
	$pwd = $imail_test['Email_Pass'];
			
	// open connection for each account
	@$connection[$imailid] = imap_open($server, $login, $pwd);
	
	return $imail_test_result[$imailid] = ($connection[$imailid]) ? 'success' : 'failed'; 

}

// disable incoming email account
function aaModelDisableIEmailAccount($imailid) {

	global $pdo_conn, $pdo_t;
	
	$sql = "UPDATE ".$pdo_t['t_iemail']." SET Disabled = CASE
				WHEN Disabled = 0 THEN 1
				WHEN Disabled = 1 THEN 0
				ELSE 0
				END
				WHERE IMAILID = :imailid";
	
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('imailid' => $imailid));
		
	header('Location: '.$_SERVER['REQUEST_URI']);
	exit;
	
}

// delete incoming email account
function aaModelDeleteIEmailAccount($imailid) {

	global $pdo_conn, $pdo_t;

	$sql = "DELETE FROM ".$pdo_t['t_iemail']." WHERE IMAILID = :imailid";
		
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('imailid' => $imailid));
		
	header('Location: '.$_SERVER['REQUEST_URI']);
	exit;

}

// allow manual retrival of incoming emails
function aaModelSetManualImail ($imail_toggle) {

	global $pdo_conn, $pdo_t;

	$imail_toggle = (isset($imail_toggle)) ? 1 : 0;
	
	$sql = "UPDATE ".$pdo_t['t_settings']." SET Imail_Manual = :imail_toggle LIMIT 1";
	
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('imail_toggle' => $imail_toggle));
	
	// redirect to general settings section
	header('Location: '.$_SERVER['REQUEST_URI']);
	exit;

}


?>