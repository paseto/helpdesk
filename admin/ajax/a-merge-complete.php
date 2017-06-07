<?php

require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();

$merge_from_tid = $_POST["mergefromtid"];
$merge_tid = $_POST["mergetid"];
$merge_from_user = $_POST["mergefromuser"];
$merge_from_message = $_POST["mergefrommessage"];
$merge_from_dateadded = $_POST["mergefromdateadded"];
$merge_from_files = $_POST["mergefromfiles"];


$file_upload_dir = get_settings("File_Path");
$file_to_tid_folder = ltrim($merge_tid,"0");
$file_from_tid_folder = ltrim($merge_from_tid,"0");

// if tid to be merge with doesn't have an existing folder rename old folder to new
if (!is_dir($file_upload_dir.$file_to_tid_folder)) {
	
	rename($file_upload_dir.$file_from_tid_folder, $file_upload_dir.$file_to_tid_folder);

} else {
	
	$scanned_directory = array_diff(scandir($file_upload_dir.$file_from_tid_folder), array('..', '.'));
		
	foreach ($scanned_directory as $file) {
		
		copy($file_upload_dir.$file_from_tid_folder."/".$file, $file_upload_dir.$file_to_tid_folder."/".$file);
		
	}
	// delete old files and folder
	aaFileDelete($file_upload_dir.$file_from_tid_folder);

}


// convert master ticket to update for the ticket to be merged to
$sql_mergedata = "INSERT INTO ".$pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Files, Update_Emailed) 
VALUES (:merge_tid, :merge_from_user, :merge_from_dateadded, :status, :timespent, :merge_from_message, :merge_from_files, :public)"; 
$q_mergedata = $pdo_conn->prepare($sql_mergedata);
$q_mergedata->execute(array('merge_tid' => $merge_tid, 
							'merge_from_user' => $merge_from_user, 
							'merge_from_dateadded' => $merge_from_dateadded, 
							'status' => 'Update', 
							'timespent' => '1', 
							'merge_from_message' => $merge_from_message, 
							'merge_from_files' => $merge_from_files,
							'public' => 1));

// delete master ticket that is open after converted
$sql_del_ticket = "DELETE FROM ".$pdo_t['t_ticket']." WHERE ID = :merge_from_tid";
$q_del_ticket = $pdo_conn->prepare($sql_del_ticket);
$q_del_ticket->execute(array('merge_from_tid' => $merge_from_tid));

// change ticket updates for open ticket to merge to ticket
$sql_mergeupdates = "UPDATE ".$pdo_t['t_ticket_updates']." SET Ticket_ID = :merge_tid WHERE Ticket_ID = :merge_from_tid AND Update_Type = 'Update'";
$q_mergeupdates = $pdo_conn->prepare($sql_mergeupdates);
$q_mergeupdates->execute(array('merge_tid' => $merge_tid, 'merge_from_tid' => $merge_from_tid));

// delete any changes from updates e.g. accepts or group changes etc
$sql_del_ticketupdates = "DELETE FROM ".$pdo_t['t_ticket_updates']." WHERE Ticket_ID= :merge_from_tid";
$q_del_ticketupdates = $pdo_conn->prepare($sql_del_ticketupdates);
$q_del_ticketupdates->execute(array('merge_from_tid' => $merge_from_tid));

//echo $merge_from_tid." ".$merge_tid." ".$merge_from_user." ".$merge_from_message." ".$merge_from_dateadded;
?>