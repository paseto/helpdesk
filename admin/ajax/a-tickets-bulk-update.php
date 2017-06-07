<?php


if( $_POST["tid"] ) {

session_start();

require_once "../../lib/db.php";
require_once "../../lib/global.php";
include '../../public/language/'.$_SESSION['aalang'].'.php';

$pdo_conn = pdo_conn();

// get timezone time to use for inserting and updating records
$now = timezone_time();
$date_format = get_settings('Date_Format');
$ckid = $_POST["tid"];
$field = $_POST["field"];
$val = $_POST["changeto"];
$uid = $_SESSION['a']['aauid'];
$fname = $_SESSION['a']['aaname'];

	
	// foreach ticket that has been ticked
	foreach ($ckid as $ticket_id) {
		
		$sql_ticket = "SELECT Owner,
		Date_Added,
		CASE WHEN SLA_Reply IS NOT NULL 
		   THEN DATE_FORMAT(SLA_Reply, '$date_format')
		   ELSE '".$lang["generic-na"]."'
		END AS SLAR,
		CASE WHEN SLA_Fix IS NOT NULL 
		   THEN DATE_FORMAT(SLA_Fix, '$date_format')
		   ELSE '".$lang["generic-na"]."'
		END AS SLAF,
		Cat_ID,
		Level_ID,
		Status 
		FROM ".$pdo_t['t_ticket']." WHERE ID = :tid";		 
		$q_ticket = $pdo_conn->prepare($sql_ticket);
		$q_ticket->execute(array(':tid' => $ticket_id));		
		$ticket = $q_ticket->fetch();
		
		$sql_o_group = "SELECT Cat_ID, Category FROM ".$pdo_t['t_groups']." WHERE Cat_ID = :gid";		 
		$q_o_group = $pdo_conn->prepare($sql_o_group);
		$q_o_group->execute(array(':gid' => $ticket['Cat_ID']));
		$o_group = $q_o_group->fetch();
		
		$sql_o_user = "SELECT UID, Fname, Lname FROM ".$pdo_t['t_users']." WHERE UID = :uid";		 
		$q_o_user = $pdo_conn->prepare($sql_o_user);
		$q_o_user->execute(array(':uid' => $ticket['Owner']));
		$o_user = $q_o_user->fetch();
		
		$sql_o_priority = "SELECT Level_ID, Level FROM ".$pdo_t['t_priorities']." WHERE Level_ID = :pid";		 
		$q_o_priority = $pdo_conn->prepare($sql_o_priority);
		$q_o_priority->execute(array(':pid' => $ticket['Level_ID']));
		$o_priority = $q_o_priority->fetch();
	
		if ($field == "Cat_ID") {
		// if category different select new and create string
			if ($o_group["Cat_ID"] != $val) {

				$sql_n_group = "SELECT Cat_ID, Category FROM ".$pdo_t['t_groups']." WHERE Cat_ID = :gid";		 
				$q_n_group = $pdo_conn->prepare($sql_n_group);
				$q_n_group->execute(array(':gid' => $val));		
				$n_group = $q_n_group->fetch();
			
				$sql_update = $lang['ticket-status-chg-group']." ".$o_group["Category"]." ".$lang['ticket-status-chg-to']." ".$n_group["Category"];
			
				// get new sla for change in category
				list ($slar, $slaf) = aaModelGetTicketSLA($ticket["Date_Added"], $val, $o_priority["Level_ID"]); // get SLA reply and fix by group and priority
			
				// set change variable to true
				$change = TRUE;
				
			}
		}
		
		// if user different select new and create string
		if ($field == "Owner") {
			if ($o_user["UID"] != $val) {
				
				$sql_n_user = "SELECT UID, Fname FROM ".$pdo_t['t_users']." WHERE UID = :uid";		 
				$q_n_user = $pdo_conn->prepare($sql_n_user);
				$q_n_user->execute(array(':uid' => $val));		
				$n_user = $q_n_user->fetch();				
				
				$sql_update = $lang['ticket-status-chg-owner']." ".$o_user["Fname"]." ".$lang['ticket-status-chg-to']." ".$n_user["Fname"];

				list ($slar, $slaf) = aaModelGetTicketSLA($ticket["Date_Added"], $o_group["Cat_ID"],  $o_priority["Level_ID"]); // get SLA reply and fix by group and priority

				// set change variable to true
				$change = TRUE;
				
			}
		}
		
		// if priority different select new and create string	
		if ($field == "Level_ID") {
			if ($o_level["Level_ID"] != $val) {

				$sql_n_priority = "SELECT Level_ID, Level FROM ".$pdo_t['t_priorities']." WHERE Level_ID = :pid";		 
				$q_n_priority = $pdo_conn->prepare($sql_n_priority);
				$q_n_priority->execute(array(':pid' => $val));		
				$n_priority = $q_n_priority->fetch();				
				
				$sql_update = $lang['ticket-status-chg-priority']." ".$o_priority["Level"]." ".$lang['ticket-status-chg-to']." ".$n_priority["Level"];
				
				// get new sla for change in priority
				list ($slar, $slaf) = aaModelGetTicketSLA($ticket["Date_Added"], $o_group["Cat_ID"], $val); // get SLA reply and fix by group and priority
				
				// set change variable to true
				$change = TRUE;
			}
		}
		
		// if status different select new and create string
		if ($field == "Status") {
			
			if ($ticket["Status"] != $val) {
				
				$sql_update = $lang['ticket-status-chg-status']." ".$ticket["Status"]." ".$lang['ticket-status-chg-to']." ".$val;
				
				list ($slar, $slaf) = aaModelGetTicketSLA($ticket["Date_Added"], $o_group["Cat_ID"],  $o_priority["Level_ID"]); // get SLA reply and fix by group and priority

				// set change variable to true
				$change = TRUE;
				
			}
		
		}
		
		if ($change == TRUE) {
			
				// if delete then delete ticket and ticket updates
				if ($val == "Delete") {
					
					// create path for each tickbox to delete files
					$file_path = get_settings("File_Path");
					$file_folder = ltrim($ticket_id, '0');
					$files_to_delete = "../".$file_path.$file_folder."/";
					// delete ticket
					$sql_d_ticket = "DELETE FROM ".$pdo_t['t_ticket']." WHERE ID = :tid";		 
					$q_d_ticket = $pdo_conn->prepare($sql_d_ticket);
					$q_d_ticket->execute(array(':tid' => $ticket_id));		
					// delete any ticket updates
					$sql_d_tu = "DELETE FROM ".$pdo_t['t_ticket_updates']." WHERE Ticket_ID = :tid";		 
					$q_d_tu = $pdo_conn->prepare($sql_d_tu);
					$q_d_tu->execute(array(':tid' => $ticket_id));							
					//  delete folder and files associated with ticket
					aaFileDelete($files_to_delete);
					
				} else if ($val == "Closed") {
					
					$sql_close = "UPDATE ".$pdo_t['t_ticket']." SET Status = :status, Date_Updated = :updatedt, Date_Closed = :closedt WHERE ID = :tid";		 
					$q_close = $pdo_conn->prepare($sql_close);
					$q_close->execute(array(':status' => $val, ':updatedt' => $now, ':closedt' => $now, ':tid' => $ticket_id));		
					$n_close = $q_close->fetch();				
										
					$sql_i_ticket = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
									VALUES (:tid, :uid, :now, :type, :duration, :tu, :public)"; 
					$q_i_ticket = $pdo_conn->prepare($sql_i_ticket);
					$q_i_ticket->execute(array(':tid' => $ticket_id, ':uid' => $uid, ':now' => $now, ':type' => 'Change', ':duration' => '1', ':tu' => $sql_update, ':public' => 1));		
					
				} else if ($val == "Accept") {
					
					// only accept if ticket is unassigned
					if ($ticket["Owner"] == NULL) {
						
						$accept_str = $lang['ticket-status-acceptby']." ".$fname;

						$sql_u_ticket = "UPDATE ".$pdo_t['t_ticket']." SET Owner = :uid, Date_Updated = :now WHERE ID = :tid"; 
						$q_u_ticket = $pdo_conn->prepare($sql_u_ticket);
						$q_u_ticket->execute(array(':uid' => $uid, ':now' => $now, ':tid' => $ticket_id));		

	
						$sql_i_ticket = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
										VALUES (:tid, :uid, :now, :type, :duration, :tu, :public)"; 
						$q_i_ticket = $pdo_conn->prepare($sql_i_ticket);
						$q_i_ticket->execute(array(':tid' => $ticket_id, ':uid' => $uid, ':now' => $now, ':type' => 'Change', ':duration' => '1', ':tu' => $sql_update, ':public' => 1));
						
					}
					
				} else {
					
					$nslar = aaPHPDateFormat($slar); // set php date formats for new slas
					$nslaf = aaPHPDateFormat($slaf); // set php date formats for new slas
					
					// UPDATE PARENT TICKET WITH STATUS AND INSERT NOTE FOR CHILD
					$sql_u_ticket = "UPDATE ".$pdo_t['t_ticket']." SET $field = :val, Date_Updated = :now, SLA_Reply = :slar, SLA_Fix = :slaf WHERE ID = :tid"; 
					$q_u_ticket = $pdo_conn->prepare($sql_u_ticket);
					$q_u_ticket->execute(array(':val' => $val, ':now' => $now, 'slar' => $slar, 'slaf' => $slaf, ':tid' => $ticket_id));		
					

					$sql_i_ticket = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
									VALUES (:tid, :uid, :now, :type, :duration, :tu, :public)"; 
					$q_i_ticket = $pdo_conn->prepare($sql_i_ticket);
					$q_i_ticket->execute(array(':tid' => $ticket_id, ':uid' => $uid, ':now' => $now, ':type' => 'Change', ':duration' => '1', ':tu' => $sql_update, ':public' => 1));		

					if(isset($slar)) {
						
						// insert update to say SLA reply has been changed
						$sql_tu_slar = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
						VALUES (:tid, :changeby, :now, :u_type, :u_time, :u_text, :u_public)";
						$q_tu_slar = $pdo_conn->prepare($sql_tu_slar);
						$q_tu_slar->execute(array('tid' => $ticket_id, 'changeby' => $uid, 'now' => $now, 'u_type' => "Change", 'u_time' => "1", 'u_text' => $lang['ticket-status-chg-slar']." ".$ticket["SLAR"]." ".$lang['ticket-status-chg-to']." ".$nslar, 'u_public' => 1));
						
						// insert update to say SLA fix has been changed
						$sql_tu_slaf = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
						VALUES (:tid, :changeby, :now, :u_type, :u_time, :u_text, :u_public)";
						$q_tu_slaf = $pdo_conn->prepare($sql_tu_slaf);
						$q_tu_slaf->execute(array('tid' => $ticket_id, 'changeby' => $uid, 'now' => $now, 'u_type' => "Change", 'u_time' => "1", 'u_text' => $lang['ticket-status-chg-slaf']." ".$ticket["SLAF"]." ".$lang['ticket-status-chg-to']." ".$nslaf, 'u_public' => 1));
						
					}
											
				}
		
		// end if true change		
		}
		
	// end foreach loop	
	}

// end if post	
}

?>
