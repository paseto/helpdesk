<?php
// SLA cron management

require_once "../lib/db.php";
require_once "../lib/global.php";
$default_lang = get_settings('Langauge');
@include '../public/language/'.$default_lang.'.php';

$pdo_conn = pdo_conn();

$now = timezone_time();

// select tickets with sla reply within next 24 hours that have not been replied to
$expiring_r_slas = "SELECT * FROM ".$pdo_t['t_ticket']." AS t 
					LEFT JOIN ".$pdo_t['t_slas']." AS s ON t.t_GID_Origin = s.GID AND t.Level_ID = s.PID 
					WHERE t.SLA_Reply BETWEEN '$now' AND '$now' + INTERVAL 24 HOUR 
					AND t.Date_Replied IS NULL 
					AND t.SLA_Reply_Alert IS NULL";
$q_r_expiring = $pdo_conn->prepare($expiring_r_slas);
$q_r_expiring->execute();
	
$sla_reply_expiring = $q_r_expiring->fetchAll();

echo '<h1>SLA Replied Exiring</h1>';

foreach ($sla_reply_expiring as $sla_e_r) {

	echo $sla_e_r["ID"]." - ".$sla_e_r["Escalation_Email"]."<br>";

	// send alert for any ticket SLA Reply expiring in 24 hours
	aaSendEmail($sla_e_r["Escalation_Email"], $lang['cron-sla-slar-es-alert'].' - '.$sla_e_r["ID"], $lang['cron-sla-slar-eb-alert'].' '.$sla_e_r["SLA_Reply"]);
	
	// update ticket table field to indicate alert has been sent
	$update_r_expiring = "UPDATE ".$pdo_t['t_ticket']." SET SLA_Reply_Alert = 1 WHERE ID = ".$sla_e_r["ID"]."";
	$q_update_r_expiring = $pdo_conn->prepare($update_r_expiring);
	$q_update_r_expiring->execute();
	
	// insert ticket update to say alert was sent
	$insert_r_expiring = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
						VALUES ('".$sla_e_r["ID"]."', 'System', '$now', 'Change', 1, '".$lang['cron-sla-slar-alert']."', 1)";
	$q_insert_r_expiring = $pdo_conn->prepare($insert_r_expiring);
	$q_insert_r_expiring->execute();
	
}


// select any tickets where the SLA Reply has not been matched
$expired_r_slas = "SELECT t.*,s.*,gt.Category AS Ticket_Group, gr.Category FROM ".$pdo_t['t_ticket']." AS t 
					LEFT JOIN ".$pdo_t['t_slas']." AS s ON t.t_GID_Origin = s.GID AND t.Level_ID = s.PID
					LEFT JOIN ".$pdo_t['t_groups']." AS gt ON gt.Cat_ID = t.t_GID_Origin
					LEFT JOIN ".$pdo_t['t_groups']." AS gr ON gr.Cat_ID = s.Reply_Escalation_Group
					WHERE t.SLA_Reply < '$now'
					AND t.Date_Replied IS NULL
					AND t.SLA_Reply_Escalated IS NULL";
$q_r_expired = $pdo_conn->prepare($expired_r_slas);
$q_r_expired->execute();

$sla_reply_expired = $q_r_expired->fetchAll();

echo '<h1>SLA Replied Exired</h1>';

foreach ($sla_reply_expired as $sla_r_expired) {
	
	echo $sla_r_expired["ID"]." - ".$sla_r_expired["Cat_ID"]." - ".$sla_r_expired["Reply_Escalation_Group"]."<br>";

	// send alert for any ticket SLA Reply expiring in 24 hours
	aaSendEmail($sla_r_expired["Escalation_Email"], $lang['cron-sla-slar-es-expired'].' - '.$sla_r_expired["ID"], $lang['cron-sla-slar-eb-expired'].' '.$sla_r_expired["SLA_Reply"]);
	
	// move ticket to escalated group
	$update_r_expired = "UPDATE ".$pdo_t['t_ticket']." SET Cat_ID = ".$sla_r_expired["Reply_Escalation_Group"]." , SLA_Reply_Escalated = 1 WHERE ID = ".$sla_r_expired["ID"]."";
	$q_update_r_expired = $pdo_conn->prepare($update_r_expired);
	$q_update_r_expired->execute();
	$statement_r = $lang['cron-sla-slar-expired']." ".$sla_r_expired["Category"]." ".$lang["search-from"]." ".$sla_r_expired["Ticket_Group"];
			
	// insert ticket update to say SLA Reply has expired
	$insert_r_expired = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
						VALUES ('".$sla_r_expired["ID"]."', 'System', '$now', 'Change', 1, '$statement_r', 1)";
	$q_insert_r_expired = $pdo_conn->prepare($insert_r_expired);
	$q_insert_r_expired->execute();
	
}


// select tickets with sla fix within next 24 hours that have not been replied to
$expiring_f_slas = "SELECT * FROM ".$pdo_t['t_ticket']." AS t
					LEFT JOIN ".$pdo_t['t_slas']." AS s ON t.t_GID_Origin = s.GID AND t.Level_ID = s.PID 
					WHERE `SLA_Fix` BETWEEN '$now' AND '$now' + INTERVAL 24 HOUR 
					AND Date_Closed IS NULL
					AND SLA_Fix_Alert IS NULL";
$q_f_expiring = $pdo_conn->prepare($expiring_f_slas);
$q_f_expiring->execute();
	
$sla_fix_expiring = $q_f_expiring->fetchAll();

echo '<h1>SLA Fix Exiring</h1>';

foreach ($sla_fix_expiring as $sla_e_f) {
	
	echo $sla_e_f["ID"]." - ".$sla_e_f["Escalation_Email"]."<br>";
	
	// send alert for any ticket SLA Reply expiring in 24 hours
	aaSendEmail($sla_e_f["Escalation_Email"], $lang['cron-sla-slaf-es-alert'].' - '.$sla_e_f["ID"], $lang['cron-sla-slaf-eb-alert'].' '.$sla_e_f["SLA_Fix"]);
	
	// update ticket table field to indicate alert has been sent
	$update_f_expiring = "UPDATE ".$pdo_t['t_ticket']." SET SLA_Fix_Alert = 1 WHERE ID = ".$sla_e_f["ID"]."";
	$q_update_f_expiring = $pdo_conn->prepare($update_f_expiring);
	$q_update_f_expiring->execute();
		
	// insert ticket update to say alert was sent
	$insert_f_expiring = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
						VALUES ('".$sla_e_f["ID"]."', 'System', '$now', 'Change', 1, '".$lang['cron-sla-slaf-alert']."', 1)";
	$q_insert_f_expiring = $pdo_conn->prepare($insert_f_expiring);
	$q_insert_f_expiring->execute();

}


// select any tickets where the SLA Fix has not been matched
$expired_f_slas = "SELECT t.*,s.*,gt.Category AS Ticket_Group,gf.Category FROM ".$pdo_t['t_ticket']." AS t
					LEFT JOIN ".$pdo_t['t_slas']." AS s ON t.t_GID_Origin = s.GID AND t.Level_ID = s.PID
					LEFT JOIN ".$pdo_t['t_groups']." AS gt ON gt.Cat_ID = t.t_GID_Origin
					LEFT JOIN ".$pdo_t['t_groups']." AS gf ON gf.Cat_ID = s.Fix_Escalation_Group
					WHERE `SLA_Fix` < '$now'
					AND t.Date_Closed IS NULL
					AND t.SLA_Fix_Escalated IS NULL";
$q_f_expired = $pdo_conn->prepare($expired_f_slas);
$q_f_expired->execute();

$sla_fix_expired = $q_f_expired->fetchAll();

echo '<h1>SLA Fix Exired</h1>';

foreach ($sla_fix_expired as $sla_f_expired) {
	
	echo $sla_f_expired["ID"]." - ".$sla_f_expired["Cat_ID"]." - ".$sla_f_expired["Fix_Escalation_Group"]."<br>";

	// send alert for any ticket SLA Reply expiring in 24 hours
	aaSendEmail($sla_f_expired["Escalation_Email"], $lang['cron-sla-slaf-es-expired'].' - '.$sla_f_expired["ID"], $lang['cron-sla-slaf-eb-expired'].' '.$sla_f_expired["SLA_Fix"]);	
	
	// move ticket to escalated group
	$update_f_expired = "UPDATE `ticket` SET Cat_ID = ".$sla_f_expired["Fix_Escalation_Group"]." , SLA_Fix_Escalated = 1 WHERE ID = ".$sla_f_expired["ID"]."";
	$q_update_r_expired = $pdo_conn->prepare($update_f_expired);
	$q_update_r_expired->execute();
	$statement = $lang["cron-sla-slaf-expired"]." ".$sla_f_expired["Category"]." ".$lang["search-from"]." ".$sla_f_expired["Ticket_Group"];
	// insert ticket update to say SLA Fix has expired
	$insert_f_expired = "INSERT INTO `ticket_updates` (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
						VALUES ('".$sla_f_expired["ID"]."', 'System', '$now', 'Change', 1, '$statement', 1)";
	$q_insert_f_expired = $pdo_conn->prepare($insert_f_expired);
	$q_insert_f_expired->execute();
	
}
?>