<?php
// arrange ticket layout - bottom to top or top to bottom
$update_dir = get_settings("Ticket_Dir");
$update_form_pos = get_settings("Ticket_Reply_Position");
$db_ticket_time = get_settings("Ticket_Time");

// placement of ticket updates and initial enquiry
if ($update_dir == "DESC") {
    echo '<script>
	$(document).ready(function() {
	$( "#message_one" ).insertAfter( $( "#message_updates" ) );
	$("#message_updates > div").each(function() {
		$(this).prependTo(this.parentNode);
	});	
	});
	</script>';

}

// placement of update form
if ($update_form_pos == "TOP") {
    echo '<script>
	$(document).ready(function() {
	$( "#form_background" ).insertAfter( $( "#table_header_fixed_height" ) );
	});
	</script>';

}

$ticketid = $_GET["tid"];

// select ticket where ID equals tid variable
$ticket = aaModelGetTicketDetails($ticketid);

// ticket_edittable by agent in ticket group
$allowed_to_edit = aaModelGetTicketEdittable($s_uid, $ticket["Cat_ID"]);

// get groups
$groups = aaModelGetGroups();
$array_of_groups = $groups->fetchAll();
$no_of_groups = $groups->rowCount();

// get agents
$agents = aaModelGetAgents();
$array_of_agents = $agents->fetchAll();

// get priorities
$priorities = aaModelGetPriorities();
$array_of_priorities = $priorities->fetchAll();
$no_of_priorities = $priorities->rowCount();

// get custom fields
$sel_custom_fields = aaModelGetCustomFields();
$custom_fields = $sel_custom_fields->fetchAll();
$count_custom_fields = $sel_custom_fields->rowCount();

// get ticket updates
$ticket_updates = aaModelGetTicketUpdates($ticketid);
$sel_ticket_updates = $ticket_updates->fetchAll();

// back and forward arrows
$prevticket = aaModelGetPrevTicket($ticketid, "prev");
$array_of_prevticket = $prevticket->fetch();
$no_of_prevticket = $prevticket->rowCount();

$nextticket = aaModelGetPrevTicket($ticketid, "next");
$array_of_nextticket = $nextticket->fetch();
$no_of_nextticket = $nextticket->rowCount();

// select canned replies from database
$sel_canned_replies = aaModelGetCannedReplies();
$canned_replies = $sel_canned_replies->fetchAll();


// FILE HANDLING AND DELETING
// create path to delete folder and files with ending slash
$file_path = get_settings("File_Path");
$file_folder = ltrim($ticketid, '0');
$files_to_delete = $file_path . $file_folder;

// if sql column is populated with files
if ($ticket["Files"] != "") {
    $files = rtrim($ticket["Files"], ";");
    $file_array = explode(";", $files);
    $file_count = count($file_array);
} else {
    $file_count = 0;
}

// hide delete and edit buttons from agent role
if ($s_urole == 1 || ($ticket["Status"] == "Closed")) {
    $restrict_agent = "restrict_agent";
}

// submit reply
if (isset($_POST["Form_Reply"])) {

    aaModelSubmitTicketUpdate($_GET['tid'], $s_uid, $_POST["aa_forward_to"], $_POST["reply"], $_FILES["file"], $_POST["aa_forward_history"], $_POST["aa_time_spent"], @$_POST["aa_private"], $_POST["action_reply"]);

}

// save any changes made down the left hand side of the page
if (isset($_POST["save"])) {
    aaModelSaveTicketChanges($ticketid, $s_uid, $_POST["chg_status"], $_POST["chg_cat"], $_POST["chg_owner"], $_POST["chg_priority"]);
}

// delete file from inital ticket request
if (isset($_GET["del"])) {

    aaDeleteTicketFile($_GET["del"], $_GET["tid"], $ticket["Files"]);

}

// delete file from any ticket update
if (isset($_GET["subdel"])) {

    aaDeleteTicketUpdateFile($_GET["subdel"], $_GET["tid"], $_GET["pid"], $_GET["tufilearray"]);

}
?>
<div id="tid" tid="<?php echo $ticketid; ?>" uid="<?php echo $s_uid; ?>"
     filefolder="<?php echo $files_to_delete; ?>"></div>

<div id="layout-body">

  <div id="table-wrapper">
    <div id="layout-body-left-width">&nbsp;</div>
    <div id="layout-body-left" class="layout-padding">
      <h2><?php echo $lang['ticket-details-title']; ?></h2>

      <form action="" method="post">
        <label><?php echo $lang['tickets-ID']; ?></label>
          <?php echo $ticket["ID"]; ?>

        <label><?php echo $lang['search-cust']; ?></label>
          <?php

          // if registered user show link to profile
          $user_registered = aaModelCheckUserUnique($ticket["User_Email"]);
          if ($user_registered == 1) {
              echo '<a href="p.php?p=user-profile&email=' . $ticket["User_Email"] . '&uid=' . $ticket['UID'] . '">' . ucwords(html_entity_decode(stripslashes($ticket["Fname"]))) . '</a>';
          } else {
              echo ucwords(html_entity_decode(stripslashes($ticket["User"]))) . ' (Guest)';
          }
          ?>

          <?php
          $ticket_reopen = get_settings("Ticket_Reopen");
          // if ticket closed and not allowed to reopen or not skilled in group or no owner yet
          if ($ticket["Status"] == "Closed" && ($ticket_reopen == 0) || ($allowed_to_edit == "0") || ($ticket["Owner"] == NULL)) {
              ?>
            <label><?php echo $lang['tickets-status']; ?></label>
              <?php echo $ticket["Status"]; ?>

            <label><?php echo $lang['tickets-group']; ?></label>
              <?php echo decode_entities($ticket["Category"]); ?>

            <label><?php echo $lang['tickets-owner']; ?></label>
              <?php echo decode_entities($ticket["Owned"]); ?>

            <label><?php echo $lang['tickets-priority']; ?></label>
              <?php echo decode_entities($ticket["Level"]); ?>
              <?php
          } else {
              ?>
            <label><?php echo $lang['tickets-status']; ?></label>
              <?php
              // available statues
              $status_options = array("Open" => $lang['tickets-status-open'], "Awaiting Reply" => $lang['tickets-status-ar'], "Pending" => $lang['tickets-status-pending'],
                      "Paused" => $lang['tickets-status-paused'], "Closed" => $lang['tickets-status-closed']);
              ?>

            <select id="chg_status" name="chg_status">
                <?php
                // print each available status within select box
                foreach ($status_options as $opt_val => $opt_key) {

                    if ($ticket["Status"] == $opt_val) {

                        echo "<option value=\"" . $opt_val . "\" selected=\"selected\">" . $opt_key . "</option>";

                    } else if ($ticket["Status"] != $opt) {
                        // do not allow "awaiting reply" as a selectable status to change to
                        if ($opt_val != "Awaiting Reply") {
                            echo "<option value=\"" . $opt_val . "\">" . $opt_key . "</option>";
                        }
                    }

                }
                ?>
            </select>
            <p><input class="btn collision_disable" name="save" type="submit"
                      value="<?php echo $lang['generic-change']; ?>"/></p>
              <?php
              // if no categories are configured in settings do not show change category box
              if ($no_of_groups > 0) {
                  ?>
                <label><?php echo $lang['tickets-group']; ?></label>
                <select id="chg_cat" name="chg_cat">
                    <?php

                    // loop through each available category and print within select box
                    foreach ($array_of_groups as $cats) {

                        if ($ticket["Cat_ID"] == $cats["Cat_ID"]) {

                            echo "<option value=\"" . $cats["Cat_ID"] . "\" selected=\"selected\">" . decode_entities($cats["Category"]) . "</option>";

                        } else if ($ticket["Cat_ID"] != $cats["Cat_ID"]) {

                            echo "<option value=\"" . $cats["Cat_ID"] . "\">" . decode_entities($cats["Category"]) . "</option>";

                        }

                    }

                    ?>
                </select>
                <p><input class="btn collision_disable" name="save" type="submit"
                          value="<?php echo $lang['generic-change']; ?>"/></p>
                  <?php
              }
              ?>
            <label><?php echo $lang['tickets-owner']; ?></label>
            <select id="chg_owner" name="chg_owner">
                <?php

                // loop through each available category and print within select box
                foreach ($array_of_agents as $owner) {

                    if ($owner["UID"] == $ticket["Owner"]) {

                        echo "<option value=\"" . $owner["UID"] . "\" selected=\"selected\">" . $owner["Fname"] . "</option>";

                    } else if ($owner["UID"] != $ticket["Owner"]) {

                        echo "<option value=\"" . $owner["UID"] . "\">" . $owner["Fname"] . "</option>";

                    }

                }

                ?>
            </select>
            <p><input class="btn collision_disable" name="save" type="submit"
                      value="<?php echo $lang['generic-change']; ?>"/></p>

              <?php
              // if no levels are configured in settings do not show change priority box
              if ($no_of_priorities > 0) {
                  ?>
                <label><?php echo $lang['tickets-priority']; ?></label>
                <select id="chg_priority" name="chg_priority">
                    <?php

                    foreach ($array_of_priorities as $levels) {

                        // select the value of the priority that has been assigned to the ticket
                        if ($ticket["Level_ID"] == $levels["Level_ID"]) {

                            echo "<option value=\"" . $levels["Level_ID"] . "\" selected=\"selected\">" . decode_entities($levels["Level"]) . "</option>";

                            // else print all the other values avaialble for priority
                        } else if ($ticket["Level_ID"] != $levels["Level_ID"]) {

                            echo "<option value=\"" . $levels["Level_ID"] . "\">" . decode_entities($levels["Level"]) . "</option>";

                        }

                    }
                    ?>
                </select>
                <p><input class="btn collision_disable" name="save" type="submit"
                          value="<?php echo $lang['generic-change']; ?>"/></p>

                  <?php
                  // end if no of levels is 0
              }
              // end editable priority, owner, group
          }
          ?>
        <label><?php echo $lang['tickets-dateadd']; ?></label>
          <?php echo $forward_dateadd = $ticket["DateAdd"]; ?>
        <label><?php echo $lang['ticket-details-slar']; ?></label>
          <?php
          echo $ticket["SLAR"];
          if ($ticket["SLAR"] != "N/A") {
              if (is_null($ticket["Date_Replied"])) { // if no reply yet, show time remaining
                  echo '<p class="text-xsmall error">' . time_difference($ticket["DateSlaR"]) . '</p>';
              } else if ($ticket["Date_Replied"] > $ticket["SLA_Reply"]) { // if replied after sla expected
                  echo '<p class="text-xsmall error">' . $lang['ticket-details-sla-fail'] . ' ' . $ticket["DateReplied"] . '</p>';
              } else { // if reply then success
                  echo '<p class="text-xsmall success">' . $lang['ticket-details-sla-suc'] . ' ' . $ticket["DateReplied"] . '</p>';
              }
          }
          ?>
        <label><?php echo $lang['ticket-details-slaf']; ?></label>
          <?php
          echo $ticket["SLAF"];
          if ($ticket["SLAF"] != "N/A") {
              if (is_null($ticket["Date_Closed"])) {
                  echo '<p class="text-xsmall error">' . time_difference($ticket["DateSlaF"]) . '</p>';
              } else if ($ticket["Date_Closed"] > $ticket["SLA_Fix"]) {
                  echo '<p class="text-xsmall error">' . $lang['ticket-details-sla-fail'] . ' ' . $ticket["DateClosed"] . '</p>';
              } else {
                  echo '<p class="text-xsmall success">' . $lang['ticket-details-sla-suc'] . ' ' . $ticket["DateClosed"] . '</p>';
              }
          }
          ?>
        <label><?php echo $lang['ticket-dateintrep']; ?></label>
          <?php echo $ticket["DateReplied"]; ?>
        <label><?php echo $lang['tickets-dateup']; ?></label>
          <?php echo $ticket["DateUp"]; ?>
        <label><?php echo $lang['ticket-dateclosed']; ?></label>
          <?php echo $ticket["DateClosed"]; ?>
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
      <?php
      // define if page 60 or 80
      $allow_feedback = get_settings("Ticket_Feedback");
      if ($ticket["Status"] == "Closed" && $allow_feedback == 1) {
          $body_page_width = 'layout-body-middle-65';
          $body_right_show = true;
      } else {
          $body_page_width = 'layout-body-middle';
          $body_right_show = false;
      }
      ?>
    <div id="<?php echo $body_page_width; ?>">

      <div id="table_header">
        <div id="table_generic">
            <?php
            // if skilled in group and ticket is unassigned
            if ($allowed_to_edit == 1 && ($ticket["Owner"] == NULL)) {
                ?>
              <a href="#" id="accept" title="<?php echo $lang['tickets-status-accept']; ?>"><i
                    class="fa fa-thumbs-up"></i></a>
                <?php
            }

            //echo $ticket["Status"]." ".$ticket_reopen." ".$allowed_to_edit." ".$ticket["Owner"];
            if ($ticket["Status"] != "Closed" && ($ticket["Owner"] != NULL || $ticket["Owner"] == $s_uid)) {

                echo '<a href="#" id="m_popup" title="Merge"><i class="fa fa-compress"></i></a>';


                echo '<a href="#" id="delete" class="' . @$restrict_agent . '" title="' . $lang["generic-delete"] . '"><i class="fa fa-trash-o"></i></a>';

            }
            ?>
        </div>
        <div id="table_go_back">
            <?php
            if (@$no_of_prevticket > 0) {
                $previd = $array_of_prevticket['ID'];
                echo '<a href="p.php?p=ticket&tid=' . $previd . '"><i class="fa fa-chevron-left"></i></a>';
            }

            if (@$no_of_nextticket > 0) {
                $nextid = $array_of_nextticket['ID'];
                echo '<a href="p.php?p=ticket&tid=' . $nextid . '"><i class="fa fa-chevron-right"></i></a>';
            }
            ?>
        </div>
      </div>
      <div id="table_header_fixed_height">&nbsp;</div>

      <div class="layout-padding">
        <div class="error-msg" id="aa_collision"><?php echo $lang['ticket-status-collide']; ?></div>
          <?php

          if ($ticket["Status"] == "Closed") { // if ticket status is set to close then don't show the update form.

              echo "<div id=\"aa_ticket_error\" class=\"error-msg\">" . $lang['ticket-status-closed'] . "</div>";
              $show_form = false;

          } else if ($allowed_to_edit == "0") { // if user not skilled in group

              echo "<div id=\"aa_ticket_error\" class=\"error-msg\">" . $lang['ticket-status-notskill'] . "</div>";
              $show_form = true;
              $noteonly = true;

          } else if ($ticket["Owner"] == NULL) { // if unassigned

              echo "<div id=\"aa_ticket_error\" class=\"error-msg\">" . $lang['ticket-status-unassigned'] . " <i class=\"fa fa-thumbs-up\"></i></div>";
              $show_form = false;

          } else if ($ticket["Owner"] != $s_uid) { // ticket not owned by logged in agent

              echo "<div id=\"aa_ticket_error\" class=\"error-msg\">" . $lang['ticket-status-notowner'] . "</div>";
              $show_form = true;
              $noteonly = true;

          } else { // ticket is owned by logged in agent

              $show_form = true;
              $noteonly = false;

          }
          ?>
        <span class="<?php echo @$restrict_agent; ?> click_editable"><a href="#"><i class="fa fa-pencil"></i></a></span>
        <h2 class="editable pagetitle" contenteditable="false" type="ts"
            tid="<?php echo $ticket["ID"]; ?>"><?php echo $forward_subject = (decode_entities($ticket["Subject"])); ?></h2>
        <div class="ticket-message user layout-padding" id="message_one">


          <span
              style="float:left;"><b><?php echo $forward_user = ucwords(html_entity_decode(stripslashes($ticket["User"]))); ?></b></span>
          <span style="float:right"><?php echo $ticket["DateAdd"]; ?></span>
          <br/>
          <span class="<?php echo @$restrict_agent; ?> click_editable"><a href="#"><i
                  class="fa fa-pencil"></i></a></span>
          <br/>
            <?php
            $preg_search = array('/&nbsp;/');
            // converted html entities
            $ticket['Message'] = decode_entities($ticket['Message']);

            // if widget message use nl2br otherwise convert html
            echo "<span class=\"editable\" contenteditable=\"false\" type=\"tb\" tid=\"" . $ticket["ID"] . "\">" . $message = $ticket['Type'] == 'Widget' ? nl2br($ticket['Message']) : preg_replace($preg_search, " ", $ticket['Message']) . "</span>";

            ?>

            <?php
            if ($count_custom_fields > 0 && ($ticket['Type'] == 'Web')) {
                ?>
              <br/>
              <fieldset>
                <legend><?php echo $lang['ticket-customfields']; ?></legend>
                  <?php
                  foreach ($custom_fields as $custom_field) {

                      // split values by #
                      $custom_value = str_replace("#", "<br>", $ticket[$custom_field["Field_Name"]]);

                      if ($custom_value == "") {

                          $custom_value = "N/A";

                      }

                      echo "<p><b>" . str_replace('_', ' ', $custom_field["Field_Name"]) . "</b></p><p>" . nl2br($custom_value) . "</p>";

                  }
                  ?>
              </fieldset>
              <br/>
                <?php
                // end count of custom fields
            }
            ?>

            <?php
            if ($file_count) {
                ?>
              <br/>
              <fieldset>
                <legend><?php echo $lang['ticket-fileuploads']; ?></legend>
                  <?php
                  foreach ($file_array as $file) {

                      echo "<p><a href=\"" . str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_path) . $file_folder . "/" . $file . "\" download=" . $file . ">" . $file . "</a> 
                <a href='p.php?p=ticket&tid=" . $ticket["ID"] . "&del=" . $file . "'><i class=\"fa fa-trash-o\"></i></a></p>";

                  }
                  ?>
              </fieldset>
              <br/>
                <?php
            }
            ?>

        </div>

        <div id="message_updates">
            <?php

            $indent_val = 10;
            $i = 1;

            foreach ($sel_ticket_updates as $ticket_update) {
                // if system update then hide edit and delete option
                $restrict_agent = ($s_urole == 1 || ($ticket_update["Update_By"] == "System" || ($ticket["Status"] == "Closed"))) ? "restrict_agent" : "";
                ?>
              <a name="<?php echo $ticket_update["ID"]; ?>"></a>
                <?php

                // if sql column is populated with files
                if ($ticket_update["Update_Files"] != "") {
                    $tu_files = rtrim($ticket_update["Update_Files"], ";");
                    $tu_file_array = explode(";", $tu_files);
                    $tu_file_count = count($tu_file_array);
                } else {
                    $tu_file_count = 0;
                }
                ?>

                <?php

                // css color profile for private messages
                if ($ticket_update["Update_Emailed"] == 0) {

                    $staff_block = "private";
                    $file_highlight_color = "light_yellow";

                } else {

                    // if numeric then staff message otherwise user message
                    if (is_numeric($ticket_update["Update_By"]) || ($ticket_update["Update_By"] == "System")) {
                        $staff_block = "staff";
                        $file_highlight_color = "light_blue";
                    } else {
                        $staff_block = "user";
                    }

                }

                // if update is a change
                if ($ticket_update["Update_Type"] == "Change" || ($ticket_update["Update_By"] == "System")) {
                    $chgname = (is_numeric($ticket_update["Update_By"])) ? $ticket_update["Fname"] : "System";
                    ?>

                  <div class="ticket-message staff layout-padding <?php echo $staff_block; ?>"
                       id="<?php echo $ticket_update["ID"]; ?>">
                      <?php echo decode_entities(stripslashes($ticket_update["Notes"])) . " by <b>" . $chgname . "</b>"; ?>
                      <?php echo $ticket_update["Up_At"]; ?>
                  </div>

                    <?php

                } else {

                    // if update not by admin print user name
                    if ($ticket_update["Fname"] == NULL) {
                        $name = $ticket_update["Update_By"];
                    } else {
                        $name = $ticket_update["Fname"];
                    }

                    // for forward history
                    $new_indent_val = $indent_val * $i;
                    // content of forward message
                    $indent = str_replace("<p>", "<p style=\"text-indent:" . $new_indent_val . "px\">", decode_entities($ticket_update["Notes"]));
                    @$forward_to_body .= "<p style=\"text-indent:" . $new_indent_val . "px\">" . $name . "<p style=\"text-indent:" . $new_indent_val . "px\">" . $ticket_update["Up_At"] . "</p><p>" . $indent . "</p><hr>";

                    $i++;

                    ?>

                  <div class="ticket-message layout-padding <?php echo $staff_block; ?>"
                       id="<?php echo $ticket_update["ID"]; ?>">
                    <span style="float:left"><b><?php echo $name; ?></b></span>
                    <span style="float:right"><?php echo $ticket_update["Up_At"]; ?></span>
                      <?php
                      $ticket_update["Notes"] = decode_entities($ticket_update["Notes"]);

                      // show duration for each update
                      $hours = intval($ticket_update["Update_Time"] / 60);
                      $mins = sprintf("%02s", $ticket_update["Update_Time"] % 60);

                      echo ($db_ticket_time == 1) ? '<br>' . $lang['ticket-duration'] . ': ' . $hours . ':' . $mins : '';

                      // if not empty show forward to address
                      if (!empty($ticket_update["Forward_To"])) {
                          echo "<br>" . $lang['ticket-forwarded-to'] . " " . $ticket_update["Forward_To"];
                      }

                      ?>
                    <br/>
                    <span class="<?php echo @$restrict_agent; ?> click_editable"><a href="#"><i
                            class="fa fa-pencil"></i></a></span>
                    <a class="<?php echo @$restrict_agent; ?> click_delete" tid="<?php echo $ticket_update["ID"]; ?>"
                       echo href="#"><i class="fa fa-times"></i></a>

                      <?php
                      echo "<br>
                              <span class=\"editable\" contenteditable=\"false\" type=\"tu\" tid=\"" . $ticket_update["ID"] . "\">" . html_entity_decode($ticket_update["Notes"]) . "</span>";
                      ?>

                      <?php
                      if ($tu_file_count) {
                          ?>
                        <br/>
                        <fieldset>
                          <legend><?php echo $lang['ticket-fileuploads']; ?></legend>
                            <?php
                            foreach ($tu_file_array as $tu_file) {

                                echo "<p><a href=\"" . str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_path) . $file_folder . "/" . $tu_file . "\" download=" . $tu_file . ">" . $tu_file . "</a> </i>
                    <a href='p.php?p=ticket&tid=" . $ticket["ID"] . "&pid=" . $ticket_update["ID"] . "&subdel=" . $tu_file . "&tufilearray=" . $ticket_update["Update_Files"] . "'>
                    <i class=\"fa fa-trash-o\"></i></a></p>";

                            }
                            ?>
                        </fieldset>
                        <br/>
                          <?php
                      }
                      ?>
                  </div>
                    <?php
                }

            }
            ?>
        </div>
      </div>    <!--- end div message_updates -->

        <?php
        if ($show_form) {
        // combine ticket request and all updates to make forward history
        $forward_history = "<hr>" . $forward_subject . "<br>" . $forward_user . "<br>" . $forward_dateadd . "<br>" . $ticket['Message'] . "<hr>" . @$forward_to_body;
        ?>
      <hr>
      <div class="form layout-padding" id="form_background">
          <?php
          // display any error messages
          echo read_session('forward_error');
          echo read_session('reply_error');
          echo read_session('aaerror-file');
          echo read_session('time_error');
          ?>
        <a name="form"></a>
        <form id="form_add_update" name="form_add_update" method="post"
              action="<?php echo $_SERVER['REQUEST_URI'] . "#form"; ?>" enctype="multipart/form-data">

            <?php
            if ($noteonly != true) {
                ?>
              <div>
                <a id="aa_forward_toggle" href="#"><?php echo $lang['ticket-forward']; ?> <i
                      class="fa fa-share"></i></a>
                <p><input style="min-width:100%" type="text" id="aa_forward_to" name="aa_forward_to"
                          placeholder="<?php echo $lang['ticket-forward-to']; ?>" value="<?php echo @$forward_to; ?>"/>
                </p>
                <textarea name="aa_forward_history"
                          style="display:none; visibility:hidden"><?php echo $forward_history; ?></textarea>
              </div>
                <?php
            }
            ?>

          <div>
            <p><select id="can_reply" name="can_reply">
                <option></option>
                    <?php
                    // select canned replies from database
                    $sel_canned_replies = aaModelGetCannedReplies();
                    $canned_replies = $sel_canned_replies->fetchAll();

                    foreach ($canned_replies as $can) {

                        echo "<option value=\"" . $can["Can_Message"] . "\">" . $can["Can_Title"] . "</option>";
                    }
                    ?>
              </select></p>
          </div>

          <textarea rows="10" id="reply" name="reply"
                    placeholder="Write update"><?php echo @$_POST["reply"] . nl2br($s_usign); ?></textarea>


          <div class="form-field">
            <label for="aa_private"><?php echo $lang['ticket-status-dd-note']; ?></label>
              <?php
              if ($noteonly == true) {
                  echo '<input name="aa_private_disabled" id="aa_private_disabled" type="checkbox" value="1" checked="checked" disabled="disabled"/>'; // visible
                  echo '<input name="aa_private" id="aa_private" type="checkbox" value="1" checked="checked" style="display:none;"/>'; // used for value in php
              } else {
                  echo '<input name="aa_private" id="aa_private" type="checkbox" value="0"/>';
              }
              ?>
          </div>

            <?php
            if ($noteonly != true) {
                ?>
              <div class="form-field">
                <label for="action_reply">Set Status</label>
                <select id="action_reply" name="action_reply">
                  <option value="Pending" selected="selected"><?php echo $lang['ticket-status-dd-update']; ?></option>
                  <option value="Paused"><?php echo $lang['ticket-status-dd-pause']; ?></option>
                  <option value="Closed"><?php echo $lang['ticket-status-dd-close']; ?></option>
                </select>
              </div>
                <?php
            }
            ?>

            <?php
            if ($db_ticket_time == 1) {
                echo '<div class="form-field">';
                echo '<label>' . $lang['ticket-time-spent'] . '</label>';
                echo '<input type="text" id="aa_time_spent" name="aa_time_spent" value="0:01"/>';
                echo '</div>';
            } else {
                // hide time spent field to default time to one second
                echo '<input type="hidden" id="aa_time_spent" name="aa_time_spent" value="0:01"/>';
            }
            ?>

            <?php
            $file_attachment = get_settings("File_Enabled");
            if ($file_attachment == 1) {
                ?>

              <div id="fileuploads" class="form-field">
                <label for="aafile">&nbsp;</label>
                <input class="aafile" name="file[]" type="file" multiple="multiple"/>
              </div>
                <?php
            }
            ?>
          <p>

            <div>
          <p><input class="btn" type="submit" id="Form_Reply" name="Form_Reply"
                    value="<?php echo $lang['generic-save']; ?>"/></p>
      </div>

      </form>
    </div>
  <?php
  // end if not closed.name="reply" name="action_reply" id="email_reply"
  }
  ?>

  </div>
    <?php
    if ($body_right_show) {
        ?>
      <div id="layout-body-right" class="layout-padding ticket-rating">
        <br>
        <h2><?php echo $lang['ticket-rating']; ?></h2>
          <?php
          if ($ticket["Feedback"] == NULL) {
              ?>
            <p><?php echo $lang['ticket-rating-waiting']; ?></p>
              <?php
          }
          ?>
        <ul>
            <?php
            // array for rating. number is sql value
            $ratings = array("2" => $lang['ticket-rate-p'], "1" => $lang['ticket-rate-neu'], "0" => $lang['ticket-rate-neg']);
            foreach ($ratings as $rating_key => $rating_value) {

                switch ($rating_key) {
                    case "2":
                        $aa_rating_style = "Positive";
                        break;
                    case "1":
                        $aa_rating_style = "Neutrel";
                        break;
                    case "0":
                        $aa_rating_style = "Negative";
                        break;
                }

                // if no rating submited
                if ($ticket["Feedback"] == NULL) {

                    echo "<li id=\"" . $aa_rating_style . "\" rval=\"" . $rating_key . "\">" . ucwords($rating_value) . "</li>";

                    // if feedback given and matches db
                } else if ($ticket["Feedback"] == $rating_key) {

                    echo "<li id=\"" . $aa_rating_style . "\" class=\"selected\" rval=\"" . $rating_key . "\">" . ucwords($rating_value) . "<i class=\"fa fa-check\"></i></li>";

                    // else must be unselected options
                } else {

                    echo "<li id=\"" . $aa_rating_style . "\" class=\"disabled-li\" rval=\"" . $rating_key . "\">" . ucwords($rating_value) . "</li>";

                }

            }

            ?>
        </ul>
      </div>
        <?php
    }
    ?>

  <div class="overlay"></div>

  <div class="popup layout-padding">
    <h3><?php echo $lang['ticket-merge']; ?></h3>

    <div class="popup_content">
      <div class="popup_ticket">
        <div class="ticket_summary">
            <?php echo "<p><strong>" . $ticket["Subject"] . "</strong></p><p>" . $ticket["User"] . "</p>"; ?>
        </div>
        <div class="ticket_numbers"><p class="detail"><i
                class="fa fa-calendar"></i> <?php echo $lang['search-added']; ?> <?php echo $ticket["DateAdd"] . "</p><p class=\"detail\">(#" . $ticket["ID"]; ?>
            )</p>
        </div>
      </div>
      <form method="post">
        <h4><?php echo $lang['ticket-merge-detail']; ?></h4>
        <input autocomplete="off" id="merge_input" name="search" type="text" placeholder="Search by ID"> <input
            style="font-size:0px; line-height:0px; height:0px; border:none; width:0px; margin:0px; background:none;"
            id="merge_search" name="merge_search" type="submit" value="Search">
      </form>

      <div id="merge_results"></div>
    </div>
  </div>
</div>
</div>
