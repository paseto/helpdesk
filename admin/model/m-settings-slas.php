<?php

// get slas by group and priority
function aaModelGetSLAs($gid, $pid) {

	global $pdo_conn, $pdo_t;
	
	$sql = 'SELECT * FROM '.$pdo_t['t_slas'].' WHERE GID = :gid AND PID = :pid';
	 
	$q = $pdo_conn->prepare($sql);
	$q->execute(array(":gid" => $gid, ":pid" => $pid));
	
	return $q;	

}

// submit sla data by group and priority
function aaModelInsertSLA($sla_gid, $sla_pid, $slard, $slarh, $slafd, $slafh, $sla_r_e_group, $sla_f_e_group, $sla_e_email) {
	
	global $pdo_conn, $pdo_t, $lang;

	$sla_e_email = clean($sla_e_email, TRUE);
	
	if (form_validate ("EMAIL", $sla_e_email)) {
		
		echo "<div class=\"error-msg\"><div class=\"pad10\">".$lang['generic-error-invalid-em']."</div></div>";

	} else {
		
		// delete previous sla set by group and priority	
		$delete_sla = "DELETE FROM ".$pdo_t['t_slas']." WHERE GID = :gid AND PID = :pid";
		$q = $pdo_conn->prepare($delete_sla);
		$q->execute(array(":gid" => $sla_gid, ":pid" => $sla_pid));
	
		// insert new sla
		$insert_sla = "INSERT INTO ".$pdo_t['t_slas']." (GID, PID, SLA_Reply_Days, SLA_Reply_Hours, SLA_Fix_Days, SLA_Fix_Hours, Reply_Escalation_Group, Fix_Escalation_Group, Escalation_Email)
		VALUES (:gid, :pid, :slard, :slarh, :slafd, :slafh, :sla_r_e_group, :sla_f_e_group, :sla_e_email)";
		
		$q = $pdo_conn->prepare($insert_sla);
		
		if ($q->execute(array("gid" => $sla_gid, "pid" => $sla_pid, "slard" => $slard, "slarh" => $slarh, "slafd" => $slafd, "slafh" => $slafh, "sla_r_e_group" => $sla_r_e_group, "sla_f_e_group" => $sla_f_e_group, "sla_e_email" => $sla_e_email))) {
	
			echo "<div class=\"success-msg\"><div class=\"pad10\">SLA Saved!</div></div>";
		
		}
	}
}

?>
