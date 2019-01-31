<?php
function aaDeleteTicketFile($file, $tid, $files_in_db)
{

    global $pdo_conn, $pdo_t, $s_uid, $s_ufname;

    $now = timezone_time();
    $tid = ltrim($tid, "0");

    $files = rtrim($files_in_db, ";");
    $old_file_array = explode(";", $files);

    $file_path = get_settings("File_Path");

    // file path made up of setting, tid and filename
    $file_path_to_del = $file_path . $tid . "/" . $file;

    // remove values from array that are different to the existing
    $new_file_array = array_diff($old_file_array, array($file));

    // new string for ticket files
    $new_file_str = implode(";", $new_file_array);

    // delete file
    unlink($file_path_to_del);

    // update orginal ticket with new file names
    $sql_del = "UPDATE " . $pdo_t['t_ticket'] . " SET Files = :file_str WHERE ID = :tid";
    $q_del = $pdo_conn->prepare($sql_del);
    $q_del->execute(array('file_str' => $new_file_str, 'tid' => $tid));

    // insert update of change into database with now and text from above statements
    $sql_in_del = "INSERT INTO " . $pdo_t['t_ticket_updates'] . " (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed)
					VALUES (:tid, :uid, :now, 'Change', '1', :str, 0)";
    $q_in_del = $pdo_conn->prepare($sql_in_del);
    $q_in_del->execute(array('tid' => $tid, 'uid' => $s_uid, 'now' => $now, 'str' => $file . ' deleted '));

    header('Location: p.php?p=ticket&tid=' . $tid);

}

function aaDeleteTicketUpdateFile($file, $tid, $pid, $file_db_str)
{

    global $pdo_conn, $pdo_t, $s_uid, $s_ufname;

    $now = timezone_time();
    $tid = ltrim($tid, "0");
    $file_path = get_settings("File_Path");
    // file path made up of setting, tid and filename
    $file_path_to_del = $file_path . $tid . "/" . $file;

    // get array from get variable and trim last comma
    $old_tu_file_array = explode(";", rtrim($file_db_str, ";"));

    // remove subfile from array
    $new_tu_file_array = array_diff($old_tu_file_array, array($file));

    // rejoin array to update ticket update table
    echo $new_tu_file_str = implode(";", $new_tu_file_array);

    // delete file
    unlink($file_path_to_del);

    // update orginal ticket with new file names
    $sql_del = "UPDATE " . $pdo_t['t_ticket_updates'] . " SET Update_Files = :file_str WHERE ID = :pid";
    $q_del = $pdo_conn->prepare($sql_del);
    $q_del->execute(array('file_str' => $new_tu_file_str, 'pid' => $pid));

    // insert update of change into database with now and text from above statements
    $sql_in_del = "INSERT INTO " . $pdo_t['t_ticket_updates'] . " (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
					VALUES (:tid, :uid, :now, 'Change', '1', :str, 0)";
    $q_in_del = $pdo_conn->prepare($sql_in_del);
    $q_in_del->execute(array('tid' => $tid, 'uid' => $s_uid, 'now' => $now, 'str' => $file . ' deleted '));

    header('Location: p.php?p=ticket&tid=' . $tid . '&pid=' . $pid);

}

// navigate backwards and forwards through tickets
function aaModelGetPrevTicket($ticketid, $dir)
{

    global $pdo_conn, $pdo_t;

    if ($dir == "prev") {
        $sql = "SELECT * FROM " . $pdo_t['t_ticket'] . " WHERE ID < :ticketid AND Status != 'Closed' LIMIT 1";
    } else if ($dir == "next") {
        $sql = "SELECT * FROM " . $pdo_t['t_ticket'] . " WHERE ID > :ticketid AND Status != 'Closed' LIMIT 1";
    }
    $q = $pdo_conn->prepare($sql);
    $q->execute(array('ticketid' => $ticketid));

    return $q;

}

// save any changes to ticket from left hand panel in ticket
function aaModelSaveTicketChanges($ticketid, $changeby, $new_status, $new_cat, $new_owner, $new_priority)
{

    global $pdo_conn, $pdo_t, $lang;
    // set change variable
    $change = FALSE;
    // get ticket details
    $ticket = aaModelGetTicketDetails($ticketid);
    $date_format = get_settings('Date_Format');
    $now = timezone_time();
    // if new status seleected doesn't equal existing status in database
    if ($new_status != $ticket["Status"]) {

        // text to be inserted into ticket update for change of status
        $sql_update .= $lang['ticket-status-chg-status'] . " " . $ticket["Status"] . " " . $lang['ticket-status-chg-to'] . " " . $new_status . "\n";
        // set change variable to true
        $change = TRUE;

    }

    // if new category selected doesn't equal existing category in database
    if ($new_cat != $ticket["Cat_ID"]) {

        // select old category name from original ticket ID
        $sql_cat = "SELECT Cat_ID, Category FROM " . $pdo_t['t_groups'] . " WHERE Cat_ID = :gid";
        $q_oldcat = $pdo_conn->prepare($sql_cat);
        $q_oldcat->execute(array('gid' => $ticket['Cat_ID']));
        $o_cat = $q_oldcat->fetch();

        // select old category name from original ticket ID
        $q_newcat = $pdo_conn->prepare($sql_cat);
        $q_newcat->execute(array('gid' => $new_cat));
        $n_cat = $q_newcat->fetch();

        // text to be inserted into ticket update for change of category
        $sql_update .= $lang['ticket-status-chg-group'] . " " . $o_cat["Category"] . " " . $lang['ticket-status-chg-to'] . " " . $n_cat["Category"] . "\n";

        // set change variable to true
        $change = TRUE;

    }

    // if new status seleected doesn't equal existing status in database
    if ($new_owner != $ticket["Owner"]) {

        // select old owner name from original ticket ID
        $sqL_owner = "SELECT UID, Fname FROM " . $pdo_t['t_users'] . " WHERE UID = :oid";
        $q_oldowner = $pdo_conn->prepare($sqL_owner);
        $q_oldowner->execute(array('oid' => $ticket['Owner']));
        $o_owner = $q_oldowner->fetch();

        // select new owner name from ID used in select
        $q_newowner = $pdo_conn->prepare($sqL_owner);
        $q_newowner->execute(array('oid' => $new_owner));
        $n_owner = $q_newowner->fetch();

        // text to be inserted into ticket update for change of status
        $sql_update .= $lang['ticket-status-chg-owner'] . " " . $o_owner["Fname"] . " " . $lang['ticket-status-chg-to'] . " " . $n_owner["Fname"] . "\n";
        // set change variable to true
        $change = TRUE;

    }
    // if new priority selected doesn't equal existing priority in database
    if ($new_priority != $ticket["Level_ID"]) {

        // select old priority name from original ticket ID
        $sql_pri = "SELECT Level_ID, Level FROM " . $pdo_t['t_priorities'] . " WHERE Level_ID = :lid";
        $q_oldpri = $pdo_conn->prepare($sql_pri);
        $q_oldpri->execute(array('lid' => $ticket['Level_ID']));
        $o_level = $q_oldpri->fetch();

        // select new priority name from ID used in select
        $q_newpri = $pdo_conn->prepare($sql_pri);
        $q_newpri->execute(array('lid' => $new_priority));
        $n_level = $q_newpri->fetch();

        // text to be inserted into ticket update for change of priority
        $sql_update .= $lang['ticket-status-chg-priority'] . " " . $o_level["Level"] . " " . $lang['ticket-status-chg-to'] . " " . $n_level["Level"] . "\n";

        // set change variable to true
        $change = TRUE;

    }


    // update original ticket with new status, category or priority and insert update
    if ($change == TRUE) {

        list ($slar, $slaf) = aaModelGetTicketSLA($ticket["Date_Added"], $new_cat, $new_priority); // get SLA reply and fix by group and priority
        // convert sql date format to php
        $mysql_dt = array('%D', '%b', '%y', '%H', '%i', '%s');
        $php_dt = array('jS', 'M', 'y', 'H', 'i', 's');
        $php_date_format = str_replace($mysql_dt, $php_dt, $date_format);
        $oslar = new DateTime($slar);
        $oslaf = new DateTime($slaf);

        // update orginal ticket with new status, category or priority
        $sql_t_u = "UPDATE " . $pdo_t['t_ticket'] . " SET Status = :new_status, Cat_ID = :new_cat, Owner = :new_owner, Level_ID = :new_priority, SLA_Reply = :slar, SLA_Fix = :slaf WHERE ID = :tid";
        $q_t_u = $pdo_conn->prepare($sql_t_u);
        $q_t_u->execute(array('new_status' => $new_status, 'new_cat' => $new_cat, 'new_owner' => $new_owner, 'new_priority' => $new_priority, 'slar' => $slar, 'slaf' => $slaf, 'tid' => $ticketid));

        if ($new_status == "Closed") {
            // set closed date for ticket
            $sql_t_c = "UPDATE " . $pdo_t['t_ticket'] . " SET Date_Closed = ':now' WHERE ID = :tid";
            $q_t_c = $pdo_conn->prepare($sql_t_c);
            $q_t_c->execute(array('now' => $now, 'tid' => $ticketid));
        }

        // insert update of change into database with now and text from above statements
        $sql_tu_i = "INSERT INTO " . $pdo_t['t_ticket_updates'] . " (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
		VALUES (:tid, :changeby, :now, :u_type, :u_time, :u_text, :u_public)";
        $q_tu_i = $pdo_conn->prepare($sql_tu_i);
        $q_tu_i->execute(array('tid' => $ticketid, 'changeby' => $changeby, 'now' => $now, 'u_type' => "Change", 'u_time' => "1", 'u_text' => $sql_update, 'u_public' => 1));

        // if new group or priority has an sla insert update
        if (isset($slar)) {
            // insert update to say SLA reply has been changed
            $sql_tu_slar = "INSERT INTO " . $pdo_t['t_ticket_updates'] . " (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
			VALUES (:tid, :changeby, :now, :u_type, :u_time, :u_text, :u_public)";
            $q_tu_slar = $pdo_conn->prepare($sql_tu_slar);
            $q_tu_slar->execute(array('tid' => $ticketid, 'changeby' => $changeby, 'now' => $now, 'u_type' => "Change", 'u_time' => "1", 'u_text' => $lang['ticket-status-chg-slar'] . " " . $ticket["SLAR"] . " " . $lang['ticket-status-chg-to'] . " " . $oslar->format($php_date_format), 'u_public' => 1));

            // insert update to say SLA fix has been changed
            $sql_tu_slaf = "INSERT INTO " . $pdo_t['t_ticket_updates'] . " (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Notes, Update_Emailed) 
			VALUES (:tid, :changeby, :now, :u_type, :u_time, :u_text, :u_public)";
            $q_tu_slaf = $pdo_conn->prepare($sql_tu_slaf);
            $q_tu_slaf->execute(array('tid' => $ticketid, 'changeby' => $changeby, 'now' => $now, 'u_type' => "Change", 'u_time' => "1", 'u_text' => $lang['ticket-status-chg-slaf'] . " " . $ticket["SLAF"] . " " . $lang['ticket-status-chg-to'] . " " . $oslaf->format($php_date_format), 'u_public' => 1));
        }
        // send email of change
        aaSendEmailTicketUpdate($ticket["ID"], $new_status, $ticket["User_Email"], $sql_update);

        // refresh ticket page
        header('Location:' . $_SERVER['REQUEST_URI']);

    }

}

// is agent allowed to edit the ticket selected
function aaModelGetTicketEdittable($uid, $gid)
{

    global $pdo_conn, $pdo_t;

    $ticket_edittable = "SELECT * FROM " . $pdo_t['t_users_skills'] . " AS us WHERE UID = :userid AND CID = :groupid";

    $q = $pdo_conn->prepare($ticket_edittable);
    $q->execute(array('userid' => $uid, 'groupid' => $gid));

    return $q->rowCount();

}

// get canned replies for dropdown
function aaModelGetCannedReplies()
{

    global $pdo_conn, $pdo_t;

    $canned_replies = "SELECT * FROM " . $pdo_t['t_canned_msg'];

    $q = $pdo_conn->prepare($canned_replies);
    $q->execute();

    return $q;
}

// submit new ticket update
function aaModelSubmitTicketUpdate($tid, $uid, $forward_to, $reply, $files, $forward_history, $timespent, $public, $status)
{

    global $pdo_conn, $pdo_t, $lang;

    $forward_to = clean($forward_to, TRUE);
    $replycleaned = clean($reply, FALSE);
    $timespent = clean($timespent, TRUE);

    $timespent_hhmm = explode(":", $timespent); // break time spent into hours and minutes
    $email_format_reply = $reply;
    // if status is closed then set type
    if (!is_null($public)) {
        $public = 0;
        $type = "Note";
        $status = "Pending"; // force due to dropdown being disabled
    } else {

        if ($status == "Closed") {
            $type = "Close";
        } else {
            $type = "Update";
        }
        $public = 1;

    }


    if (form_validate("TEXT", $replycleaned) === TRUE) {

        $form_error['REPLY'] = set_session('reply_error', '<div class="error-msg">' . $lang["generic-error"] . '</div>');

    } else if (!empty($forward_to)) {

        if (form_validate("EMAIL", $forward_to) === TRUE) {
            $form_error['FORWARD'] = set_session('forward_error', '<div class="error-msg">' . $lang['generic-error-invalid-em'] . '</div>');
            //$form_error['FORWARD'] = ;
        }

    }

    // format time spent
    if (!is_numeric($timespent_hhmm[0])) { // check hour is numeric

        $form_error['TIMESPENT'] = set_session('time_error', '<div class="error-msg">' . $lang['generic-error-inv-format'] . '</div>');

    } else if (!is_numeric($timespent_hhmm[1])) { // check minutes is numeric

        $form_error['TIMESPENT'] = set_session('time_error', '<div class="error-msg">' . $lang['generic-error-inv-format'] . '</div>');

    } else if (strlen($timespent_hhmm[1]) > 2) { // no minutes over two digits

        $form_error['TIMESPENT'] = set_session('time_error', '<div class="error-msg">' . $lang['generic-error-inv-format'] . '</div>');

    } else if ($timespent_hhmm[1] > 59) { // no minutes over 59

        $form_error['TIMESPENT'] = set_session('time_error', '<div class="error-msg">' . $lang['generic-error-inv-format'] . '</div>');

    } else { // calculate time to entered

        $timetotal = ($timespent_hhmm[0] * 60) + ($timespent_hhmm[1]);

    }

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
                            $file_error['file'] = set_session('aaerror-file', '<div class="error-msg">' . $lang['generic-file-size-rule'] . ' ' . $allowed_file_size . '</div>');
                            $file_ok = false;
                        }

                    } else {
                        $file_error['file'] = set_session('aaerror-file', '<div class="error-msg">' . $lang['generic-file-type-rule'] . ' ' . $allowed_file_type . '</div>');
                        $file_ok = false;
                    }
                }

                if ($file_ok) {

                    if (!file_exists($dir . $folder)) {
                        mkdir($dir . $folder);
                    }
                    for ($key = 0; $key <= $no_of_files - 1; $key++) {

                        $uniqid = uniqid();

                        $files['name'][$key] = str_replace(" ", "_", $files['name'][$key]); // remove spaces from filename

                        $db_files .= $uniqid . '___' . basename($files['name'][$key]) . ";";
                        $uploadfile = $dir . $folder . "/" . $uniqid . '___' . basename($files['name'][$key]);
                        aaFileUpload($files['tmp_name'][$key], $uploadfile);

                    }
                }

            } else {

                $file_error['file'] = set_session('aaerror-file', '<div class="error-msg">' . "ERROR Uploading file. Upload directory is either non existant, unwritabble or not a directory." . '</div>');

            }

        }
    }

    // if no errors then add update
    if (empty($form_error) && (empty($file_error))) {

        $now = timezone_time();
        $db_files = (isset($db_files)) ? $db_files : ""; // if file uploaded then use db str else blank for sql insert

        $add_ticket_update = "INSERT INTO " . $pdo_t['t_ticket_updates'] . " (Ticket_ID, Update_By, Updated_At, Update_Type, Update_Time, Forward_To, Notes, Update_Files, Update_Emailed) 
								VALUES (:ticketid, :userid, :now, :type, :timetotal, :forward_to, :reply, :aa_files, :public)";

        $q = $pdo_conn->prepare($add_ticket_update);
        $q->execute(array('ticketid' => $tid,
                'userid' => $uid,
                'now' => $now,
                'type' => $type,
                'timetotal' => $timetotal,
                'forward_to' => $forward_to,
                'reply' => $replycleaned,
                'aa_files' => $db_files,
                'public' => $public));

        // if initial update is update or closed then set initial reply date
        $sql_datereplied = "SELECT User_Email, Date_Replied FROM " . $pdo_t['t_ticket'] . " WHERE ID = :tid";
        $q_datereplied = $pdo_conn->prepare($sql_datereplied);
        $q_datereplied->execute(array('tid' => $tid));

        $datereplied = $q_datereplied->fetch();

        $replydate = ($datereplied["Date_Replied"] == NULL && ($type == "Update" || $type == "Close")) ? "Date_Replied = '" . $now . "'," : "";

        if ($status == "Closed") {

            $sql_t_u = "UPDATE " . $pdo_t['t_ticket'] . " SET $replydate Status = :status, Date_Updated = :updatedt, Date_Closed = :closedt WHERE ID = :tid";
            $q_t_u = $pdo_conn->prepare($sql_t_u);
            $q_t_u->execute(array('status' => $status, 'updatedt' => $now, 'closedt' => $now, 'tid' => $tid));

        } else {

            $sql_t_u = "UPDATE " . $pdo_t['t_ticket'] . " SET $replydate Status = :status, Date_Updated = :updatedt WHERE ID = :tid";
            $q_t_u = $pdo_conn->prepare($sql_t_u);
            $q_t_u->execute(array('status' => $status, 'updatedt' => $now, 'tid' => $tid));

        }

        // if forward address entered the forward message
        if (isset($forward_to)) {
            aaSendEmailTicketUpdate($tid, "Forward", $forward_to, $email_format_reply . $forward_history);
        }
        // if make update public and email is ticked
        if ($public == 1) {
            // send email using custom function
            aaSendEmailTicketUpdate($tid, $status, $datereplied['User_Email'], $email_format_reply);
        } else {
            // else send notification of private message
            aaSendEmailPrivateTicketNotification($tid);
        }

        header('Location:' . $_SERVER['REQUEST_URI']);

    }

}

?>