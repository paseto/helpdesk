<?php
// include core library functions
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';
$pdo_conn = pdo_conn();

// set variable for get id
$gid = $_POST["p_gid"];
$pid = $_POST["p_pid"];

$now = timezone_time();
$date_format = get_settings('Date_Format');

$mysql_dt = array('%D', '%b', '%y', '%H', '%i', '%s');
$php_dt = array('jS', 'M', 'y', 'H', 'i', 's');
$php_date_format = str_replace($mysql_dt, $php_dt, $date_format);


list ($slar, $slaf) = aaModelGetTicketSLA($now, $gid, $pid);

$oslar = new DateTime($slar);
$oslaf = new DateTime($slaf);

//echo $date->format('Y-m-d H:i:s');
if ($slar != NULL && $slaf != NULL) {
echo '<label>'.$lang['ticket-add-sla'].'</label>'.
	'<div class="notice">'.$lang['ticket-add-slar'].' <b>'.$oslar->format($php_date_format).'</b>'.
	'<p>'.$lang['ticket-add-slaf'].' <b>'.$oslaf->format($php_date_format).'</b></p></div>';
}
?>