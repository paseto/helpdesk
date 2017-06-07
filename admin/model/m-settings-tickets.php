<?php
// update ticket settings
function aaModelSaveSettingsTickets($ticket_view_dir, $ticket_reply_pos, $ticket_priority, $ticket_sla, $tickdt_antispam, $ticket_reopen, $ticket_rating, $ticket_time, 
									$fa_enable, $fa_limit, $fa_path, $fa_size, $fa_type) {

	global $pdo_conn, $pdo_t, $lang;
	
	$ticket_priority = (isset($ticket_priority)) ? 1 : 0;
	$ticket_sla = (isset($ticket_sla)) ? 1 : 0;
	$tickdt_antispam = (isset($tickdt_antispam)) ? 1 : 0;
	$ticket_reopen = (isset($ticket_reopen)) ? 1 : 0;
	$ticket_rating = (isset($ticket_rating)) ? 1 : 0;
	$ticket_time = (isset($ticket_time)) ? 1 : 0;
	
	$fa_enable = (isset($fa_enable)) ? 1 : 0; // if tick box for file attachements on or off is ticked
	$fa_size = $fa_size * 1048576;
	
	$_SESSION["ticket_error"] = array();
	if ($fa_enable == 1) {
	
		$fields = array("fa_limit" => $fa_limit, "fa_path" => $fa_path, "fa_size" => $fa_size, "fa_type" => $fa_type);

		foreach ($fields as $k => $value) {
			
			if ($value == "") {
			
				array_push($_SESSION["ticket_error"], $k);
				//print_r(array_values($ticket_error));
			
			} elseif ($k == "fa_size" || $k == "fa_limit") {
				
				if (!(is_numeric($value))) {
			
				array_push($_SESSION["ticket_error"], $k);
				//print_r(array_values($ticket_error));
				
				}
	
			}
			
		}
			
	}
			
	// if no errors then update database with new values
	if (empty($ticket_error)) {

		$update_ticket = "UPDATE ".$pdo_t['t_settings']." SET  
		Ticket_Dir = :ticket_dir,
		Ticket_Reply_Position = :ticket_pos,
		Ticket_Priority = :ticket_pri,
		Ticket_SLA = :ticket_sla,
		Ticket_Antispam = :ticket_antispam, 
		Ticket_Reopen = :ticket_reopen, 
		Ticket_Feedback = :ticket_rating,
		Ticket_Time = :ticket_time,
		File_Enabled = :fa_enable, 	
		File_Limit = :fa_limit,
		File_Path = :fa_path, 
		File_Size = :fa_size,
		File_Type = :fa_type  
		LIMIT 1";
		$q = $pdo_conn->prepare($update_ticket);

		if ($q->execute(array("ticket_dir" => $ticket_view_dir, 
							"ticket_pos" => $ticket_reply_pos, 
							"ticket_pri" => $ticket_priority,
							"ticket_sla" => $ticket_sla,
							"ticket_antispam" => $tickdt_antispam, 
							"ticket_reopen" => $ticket_reopen,
							"ticket_rating" => $ticket_rating, 
							"ticket_time" => $ticket_time, 
							"fa_enable" => $fa_enable,
							"fa_limit" => $fa_limit,
							"fa_path" => $fa_path,
							"fa_size" => $fa_size,
							"fa_type" => $fa_type))) {
	
			echo '<div class="success-msg">'.$lang['generic-settings-saved'].'</div>';
		
		}
		
	}
	
}

?>
