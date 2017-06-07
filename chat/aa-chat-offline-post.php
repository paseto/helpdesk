<?php
// include db info
include '../config/functions.php';
$db = db_connect();

// define widget variables
$name = form_field_clean($_POST['w_name'], TRUE);
$email = form_field_clean($_POST['w_email'], TRUE);
$sub = form_field_clean($_POST['w_subject'], TRUE);
$msg = form_field_clean($_POST['w_msg'], TRUE);
$email_format_reply = $_POST['w_msg'];

$aa_ip = $_SERVER['REMOTE_ADDR'];
$aa_referer = $_SERVER['HTTP_REFERER'];
$ua=getBrowser();
$aa_browser = $ua['name']." ".$ua['version']." [".$ua['platform']."]";

// set group and priority
$sel_def_gp = mysqli_query($db, "SELECT * FROM $mysql_priorities AS p, $mysql_categories AS g WHERE g.Def = 1 AND p.Def = 1") or die(mysql_error("Problem selecting default group and priority"));

$gp = mysqli_fetch_array($sel_def_gp);

$group = $gp['Cat_ID'];
$priority = $gp['Level_ID'];

// set ticket assignment
$ticket_assignment = get_settings("Ticket_Assignment");
$assignment = ($ticket_assignment == NULL) ? 'NULL' : $ticket_assignment;

// current time for timezone set
$now = timezone_time();

// insert into ticket table
mysqli_query($db, "INSERT INTO $mysql_ticket (User, User_Email, Cat_ID, Level_ID, Type, Subject, Message, IP_Address, Page_Referer, Browser, Status, Owner, Date_Added, Date_Updated)
VALUES ('$name', '$email', '$group', '$priority', 'Widget', '$sub', '$msg', '$aa_ip', '$aa_referer', '$aa_browser', 'Open', $assignment, '$now', '$now')") or die(mysql_error("Problem inserting widget data"));  

// get id of record inserted
$lastid = mysqli_insert_id($db);

// email user with ticket details
send_email_update($lastid, "Open", $email, $email_format_reply);

// send notification of new ticket to selected users
send_email_notification_new_ticket('A new ticket ['.$lastid.'] has been submitted', $sub.'<p>---</p><p>'.decode_entities($email_format_reply).'</p>'); 	

// print message for successful widget post
echo 	'<p>Thank you '.$name.'</p>
		<p>Your support reference number is <b>'.$lastid.'</b></p>
		<p>We will reply to you as soon as possible.</p>
		<p>You can track and update your request <a href="../user/">here</a>';


?>