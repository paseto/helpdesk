<?php
// check user is logged in or referer is track page
if ($db_guest_access = 0) {
    if ($db_user_reg == 1) {
        if (!isset($_SESSION['u']['aauid']) || ($_SESSION['u']['aaurole'] != 0)) {
            header("Location: index.php?p=user-access&r=ticket-add");
        }
    }
}
// set variables from get variables
$tid = $_GET["tid"];
$email = $_GET["email"];
// set date format from settings
$date_format = get_settings('Date_Format');

// get initial ticket detail
$ticket = aaModelGetTicketDetailsForUser($tid, $email);

// get ticket updates
$ticket_updates = aaModelGetTicketUpdatesUser($tid);
$sel_ticket_updates = $ticket_updates->fetchAll();

// get custom fields
$sel_custom_fields = aaModelGetCustomFields();
$custom_fields = $sel_custom_fields->fetchAll();
$count_custom_fields = $sel_custom_fields->rowCount();

// if sql column is populated with files
if ($ticket["Files"] != "") {

    $files = rtrim($ticket["Files"], ";");
    $file_array = explode(";", $files);
    $file_count = count($file_array);

    // create path to delete folder and files with ending slash
    $file_path = get_settings("File_Path");
    $file_folder = ltrim($tid, '0');
    $files_to_delete = $file_path . $file_folder;
} else {
    $file_count = 0;
}

// submit reply
if (isset($_POST["user_submit"])) {

    aaModelSubmitTicketUpdate($tid, $ticket["User"], $_POST["user_update"], $_FILES["file"]);
}

?>
<div class="margin-body" style="clear:both">

  <div id="table_header"></div>

  <p><a href="#" id="u-show-ticket-detail"><?php echo $lang['ticket-show-detail']; ?></a></p>

  <div id="body-left" class="u-ticket-detail">
    <div class="inner-padding">
      <h2><?php echo $lang['ticket-details-title']; ?></h2>
      <label><?php echo $lang['tickets-ID']; ?></label>
        <?php echo $ticket["ID"]; ?>
      <label><?php echo $lang['search-cust']; ?></label>
        <?php echo decode_entities($ticket["User"]); ?></p>
      <label><?php echo $lang['tickets-status']; ?></label>
        <?php echo aa_select_ticket_status_lang($ticket["Status"]); ?>
      <label><?php echo $lang['tickets-group']; ?></label>
        <?php echo decode_entities($ticket["Category"]); ?>
      <label><?php echo $lang['tickets-owner']; ?></label>
        <?php echo decode_entities($ticket["Owned"]); ?>
      <label><?php echo $lang['tickets-priority']; ?></label>
        <?php echo decode_entities($ticket["Priority"]); ?>
      <label><?php echo decode_entities($lang['tickets-dateadd']); ?></label>
        <?php echo $ticket["DateAdd"]; ?>
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
    </div>
  </div>
    <?php
    // define if page 60 or 80
    $allow_feedback = get_settings("Ticket_Feedback");
    if ($ticket["Status"] == "Closed" && $allow_feedback == 1) {
        $body_page_width = 'body-60';
        $body_right_show = true;
    } else {
        $body_page_width = 'body-80';
    }

    ?>
  <div id="body-middle" class="<?php echo $body_page_width; ?>">

    <div class="outer-padding">

      <h2><?php echo decode_entities($ticket["Subject"]); ?></h2>

      <div class="ticket-message user">
        <div class="inner-padding">

          <span style="float:left"><b><?php echo decode_entities($ticket["User"]); ?></b></span>
          <span style="float:right"><?php echo $ticket["DateAdd"]; ?></span>

          <br/>
          <hr/>

          <p>
              <?php
              // if widget message use nl2br otherwise convert html
              echo $message = $ticket['Type'] == 'Widget' ? nl2br($ticket['Message']) : html_entity_decode($ticket["Message"]);

              ?>
          </p>

            <?php
            if ($count_custom_fields > 0 && ($ticket['Type'] == 'Web')) {

                ?>
              <fieldset>
                <legend><?php echo $lang['ticket-customfields']; ?></legend>
                  <?php
                  foreach ($custom_fields as $custom_field) {

                      $custom_value = str_replace("#", "<br>", $ticket[$custom_field["Field_Name"]]);

                      if ($custom_value == "") {

                          $custom_value = "N/A";
                      }

                      echo "<p><b>" . str_replace('_', ' ', $custom_field["Field_Name"]) . "</b></p><p>" . nl2br($custom_value) . "</p>";
                  }

                  ?>
              </fieldset>
                <?php
                // end count of custom fields
            }

            ?>
            <?php
            if (@$file_count) {

                ?>
              <br>
              <fieldset>
                <legend><?php echo $lang['ticket-fileuploads']; ?></legend>
                  <?php
                  foreach ($file_array as $file) {

                      echo "<p><i class=\"fa fa-paperclip\"></i> <a href=\"" . str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_path) . $file_folder . "/" . $file . "\" download=" . $file . ">" . $file . "</a>";
                  }

                  ?>
              </fieldset>
              <br/>
                <?php
            }

            ?>
        </div>
      </div>

        <?php
        // loop through each ticket update and print
        foreach ($sel_ticket_updates as $ticket_update) {

            // if sql column is populated with files
            if ($ticket_update["Update_Files"] != "") {
                $tu_files = rtrim($ticket_update["Update_Files"], ";");
                $tu_file_array = explode(";", $tu_files);
                $tu_file_count = count($tu_file_array);
            } else {
                $tu_file_count = 0;
            }

            // if update not by admin print user name
            if ($ticket_update["Fname"] == NULL) {
                $name = decode_entities($ticket["User"]);
            } else {
                $name = $ticket_update["Fname"];
            }

            if (is_numeric($ticket_update["Update_By"]) || ($ticket_update["Update_By"] == "System")) {
                $boxstyle = "staff";
            } else {
                $boxstyle = "user";
            }

            ?>
          <div class="ticket-message <?php echo $boxstyle; ?>">
            <div class="inner-padding">
                <?php
                if ($ticket_update["Update_Type"] == "Change" || ($ticket_update["Update_By"] == "System")) {

                    echo html_entity_decode(stripslashes($ticket_update["Notes"])) . " by <b>" . $ticket_update["Fname"] . "</b>";

                    echo '<br>' . $ticket_update["Up_At"];
                } else {

                    ?>


                  <span style="float:left"><b><?php echo decode_entities($name); ?></b></span>
                  <span style="float:right"><?php echo $ticket_update["Up_At"]; ?></span>
                  <br/>
                  <hr/>
                  <p>

                      <?php
                      // if not empty show forward to address
                      if (!empty($ticket_update["Forward_To"])) {
                          echo $lang['ticket-forwarded-to-3rd-party'];
                      }

                      echo html_entity_decode(stripslashes($ticket_update["Notes"]));

                      ?>
                  </p>

                    <?php
                    if ($tu_file_count) {

                        ?>
                      <fieldset>
                        <legend><?php echo $lang['ticket-fileuploads']; ?></legend>
                          <?php
                          foreach ($tu_file_array as $tu_file) {

                              echo "<p><i class=\"fa fa-paperclip\"></i> <a href=\"" . str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_path) . $file_folder . "/" . $tu_file . "\" download=" . $tu_file . ">" . $tu_file . "</a> </i>";
                          }

                          ?>
                      </fieldset>
                        <?php
                    }

                    ?>

                    <?php
                }

                ?>
            </div>
          </div>
            <?php
            // end while loop
        }

        ?>

      <br/>
        <?php
        // if ticket is closed user can't updadte the ticket
        if ($ticket["Status"] != "Closed") {

            ?>

          <form class="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] . "#user_reply"; ?>"
                enctype="multipart/form-data">
            <hr>
              <?php
              echo read_session('aaerror-userreply');
              echo read_session('aaerror-file');

              ?>
            <a name="user_reply" id="user_reply"></a>
              <?php echo "<p><span class=\"error\">" . @$form_error["REPLY"] . "</span></p>"; ?>
            <textarea class="reply_textarea" name="user_update" id="user_update"
                      placeholder="Reply"><?php echo @$_POST["user_update"]; ?></textarea>
              <?php
              $file_attachment = get_settings("File_Enabled");

              if ($file_attachment == 1) {

                  ?>
                <div class="form-field" id="fileuploads">
                  <label><?php echo $lang['ticket-add-files-add']; ?></label>
                  <input type="hidden" id="aafilelimit" value="<?php echo get_settings("File_Limit"); ?>"/>
                  <input class="aafile" name="file[]" type="file" multiple="multiple"/>
                </div>
                  <?php
              }

              ?>
            <p><input class="btn" type="submit" name="user_submit" id="user_submit"
                      value="<?php echo $lang['ticket-status-dd-update']; ?>"/></p>
          </form>
            <?php
        }

        ?>
    </div>
  </div>
    <?php
    if ($ticket["Status"] == "Closed" && $allow_feedback == 1) {

        ?>
      <div id="body-right">
        <div class="inner-padding">
          <h2><?php echo $lang['ticket-rate']; ?></h2>
          <div id="ticket_values" ticket_id="<?php echo $ticket["ID"]; ?>"
               user_id="<?php echo $ticket["User"]; ?>"></div>
          <ul id="rating">
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

                      echo "<li id=\"" . $aa_rating_style . "\" rval=\"" . $rating_key . "\"><a href=\"#\">" . ucwords($rating_value) . "</a></li>";

                      // if feedback given and matches db
                  } else if ($ticket["Feedback"] == $rating_key) {

                      echo "<li id=\"" . $aa_rating_style . "\" class=\"selected\" rval=\"" . $rating_key . "\">" . ucwords($rating_value) . " <i class=\"fa fa-check\"></i></li>";

                      // else must be unselected options
                  } else {

                      echo "<li id=\"" . $aa_rating_style . "\" class=\"disabled-li\" rval=\"" . $rating_key . "\">" . ucwords($rating_value) . "</li>";
                  }
              }

              ?>
          </ul>
        </div>
      </div>

        <?php
    }

    ?>
</div>