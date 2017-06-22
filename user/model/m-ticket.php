<?php
// get ticket details by ticket id and email
function aaModelGetTicketDetailsForUser($ticketid, $email) {

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
					WHERE t.ID = :ticketid AND t.User_Email = :email" ;
								
	$q = $pdo_conn->prepare($ticket_details);
	
	$q->execute(array('ticketid' => $ticketid, 'email' => $email));
	
	$fetchticketdetail = $q->fetch();
	$nooftickets = $q->rowCount();

	if ($nooftickets == 0) {
		echo "INVALID!";
		exit;
	} else {
		return $fetchticketdetail;
	}
}

// get ticket update details by ID
function aaModelGetTicketUpdatesUser ($ticketid) {

	global $pdo_conn, $pdo_t, $date_format;

	$ticket_updates = "SELECT *,DATE_FORMAT(ups.Updated_At, '$date_format') AS Up_At 
					FROM ".$pdo_t['t_ticket_updates']." AS ups 
					LEFT JOIN ".$pdo_t['t_users']." AS tu ON tu.UID = ups.Update_By 
					WHERE ups.Ticket_ID = :ticketid AND (ups.Update_Emailed = :private) ORDER BY ups.Updated_At ASC";

	$q = $pdo_conn->prepare($ticket_updates);
	$q->execute(array('ticketid' => $ticketid, 'private' => 1));
	
	return $q;
	
}
// submit update to ticket from user
function aaModelSubmitTicketUpdate ($tid, $user, $reply, $files) {

	global $pdo_conn, $pdo_t, $lang;
	
	// clean reply data
	$reply = clean($reply, FALSE);
	// apply no formatting to email message for plain text to be held
	$email_format_reply = $reply;
	
	$form_error = array();

	// check name
	if (form_validate ("TEXT", $reply) === TRUE) {
			
		$form_error['REPLY'] = set_session ('aaerror-userreply', '<div class="error-msg">'.$lang["generic-error"].'</div>');
			
	} 
	
	// if no errors
	if (empty($form_error)) {
	
		if (!(empty($files["name"][0]))) { // if array 0 empty due to no file upload
	
			$dir = get_settings("File_Path");
			$folder = ltrim($tid, 0);
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
					
					if (!file_exists($dir.$folder)) {
						mkdir($dir.$folder);
					}
					for ($key = 0; $key <= $no_of_files - 1; $key++) {
							
						$uniqid = uniqid();
							
						$files['name'][$key] = str_replace(" ", "_", $files['name'][$key]); // remove spaces from filename
							
						$db_files .= $uniqid.'___'.basename($files['name'][$key]).";";
						$uploadfile = $dir . $folder ."/" . $uniqid . '___' . basename($files['name'][$key]);	
						aaFileUpload ($files['tmp_name'][$key], $uploadfile);

					}
				}	
							
			} else {
				
				$file_error['file'] = set_session ('aaerror-file', '<div class="error-msg">'."ERROR Uploading file. Upload directory is either non existant, unwritabble or not a directory.".'</div>');
			
			}
			
		}
	
	}
	
	if (empty($form_error) && (empty($file_error))) {

	$now = timezone_time();
	$db_files = (isset($db_files)) ? $db_files : ""; // if file uploaded then use db str else blank for sql insert
	
	$add_ticket_update = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Notes, Update_Files, Update_Emailed) 
							VALUES (:ticketid, :userid, :now, :type, :reply, :aa_files, :public)";
	$q = $pdo_conn->prepare($add_ticket_update);
	$q->execute(array('ticketid' => $tid, 
						'userid' => $user,
						'now' => $now,
						'type' => 'Update',
						'reply' => $reply,
						'aa_files' => $db_files,
						'public' => 1));
	
	// set update ticket
	$sql_t_u = "UPDATE ".$pdo_t['t_ticket']." SET Status = :status, Date_Updated = :dateup WHERE ID = :tid";
	$q_t_u = $pdo_conn->prepare($sql_t_u);
	$q_t_u->execute(array('status' => 'Awaiting Reply', 
						'dateup' => $now,
						'tid' => $tid));
						
	aaSendEmailUpdateTicketNotification($tid);
				
	header('Location: '.$_SERVER['REQUEST_URI']);
				
	}	

}
?>