<?php
session_start();

// include core library functions
require_once "../../lib/db.php";
require_once "../../lib/global.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';

$pdo_conn = pdo_conn();

// new password generated
$uid = $_POST["user"];
$new_pass = $_POST["new_pwd"];
// store new password as sha256
$hashpass = hash('sha256', $new_pass);
	
// check username exists
$u_sql = "SELECT UID,Pwd,Fname,Email FROM ".$pdo_t['t_users']." WHERE UID = :uid";
$q_sql = $pdo_conn->prepare($u_sql);
$q_sql->execute(array('uid' => $uid));

$user = $q_sql->fetch();
$u_on = $q_sql->rowCount();
	
// if username and password match set admin username and password
if ($u_on >= 1) {

	// update user record with new password
	$sql = "UPDATE ".$pdo_t['t_users']." SET Pwd = :hashpwd WHERE UID = :uid LIMIT 1";			
	$q = $pdo_conn->prepare($sql);
	$q = $q->execute(array('hashpwd' => $hashpass, 'uid' => $uid));

		
	// subject for password reset		
	$subject = $lang['profile-chg-pwd-succes-mail-sub'];
	// message to user
	$message = "".$user["Fname"]."\r\r".$lang['profile-chg-pwd-succes-mail-body']." ".$new_pass.".\r\rKind Regards\r\r".get_settings("Company_Name")."";
	
	// send email confirmation
	aaSendEmail($user["Email"], $subject, $message);
	echo $reset_succ = '<div class="success-msg">'.$lang['pwreset-email-succ'] .'</div>';
	
} else {

	echo $reset_fail = '<div class="error-msg">'.$lang['pwreset-unknown-u'].'</div>';

}	
?>