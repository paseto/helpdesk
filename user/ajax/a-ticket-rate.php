<?php
// include core library functions
require_once "../../lib/db.php";
require_once "../../lib/global.php";
include '../../public/language/english.php';

$pdo_conn = pdo_conn();

$now = timezone_time();

$rating = $_POST["rating"];
$tid = $_POST["ticket_id"];
$uid = $_POST["ticket_user"];


// set feedback for ticket
$sql = "UPDATE ".$pdo_t['t_ticket']." SET Feedback = :rating WHERE ID = :tid";
$q = $pdo_conn->prepare($sql);
$q->execute(array('rating' => $rating, 'tid' => $tid));


switch($rating) {
	case 0:
	$rating_str = "Negative";
	break;
	case 1:
	$rating_str = "Neutrel";
	break;
	case 2:
	$rating_str = "Positive";
	break;
}

$sqli = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Notes, Update_Emailed)
		VALUES (:tid, :uid, :now, 'Rating', :str, 1)";
$qi = $pdo_conn->prepare($sqli);
$qi->execute(array('tid' => $tid, 'uid' => $uid, 'now' => $now, 'str' => $lang['ticket-rating-post'].$rating_str));
?>