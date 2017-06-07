<?php
$agents = aaModelGetAgents();
$array_of_agents = $agents->fetchAll();
$no_of_agents = $agents->rowCount();

$groups = aaModelGetGroups();
$array_of_groups = $groups->fetchAll();
$no_of_groups = $groups->rowCount();

$priorities = aaModelGetPriorities();
$array_of_priorities = $priorities->fetchAll();
$no_of_priorities = $priorities->rowCount();

$agent_skills = aaModelGetAgentSkills($s_uid);

?>

<div id="layout-body">
  <div id="layout-body-left-width">&nbsp;</div>
  <div id="layout-body-left" class="layout-padding">
    <h2><?php echo $lang['tickets-filter']; ?></h2>


    <i id="filter-reset" class="fa fa-refresh" title="<?php echo $lang['tickets-refresh']; ?>"></i>

    <form id="auto-filter-form" class="auto-ticket-filter" method="post">

      <select hidden style="display:none"; name="filter_sortval" id="filter_sortval" >
        <option value="ID">ID</option>
        <option value="Subject">Subject</option>        
        <option value="Status">Status</option>
        <option value="Owner">Owner</option> 
        <option value="Priority">Priority</option>
        <option value="Category">Category</option>
        <option value="Date_Added" selected="selected">Date Added</option>
        <option value="Date_Updated">Date Updated</option>        
      </select>
      <select hidden style="display:none"; name="filter_sortdir" id="filter_sortdir">
        <option value="ASC">Ascending</option>
        <option value="DESC" selected="selected">Desending</option>
      </select>

      <label><?php echo $lang['tickets-viewby']; ?></label>
      <select name="ticket_view" id="ticket_view">
        <?php
        $ticket_view_opts = array($lang['tickets-viewby-opt1'], $lang['tickets-viewby-opt2']);
        foreach ($ticket_view_opts as $view) {

          if ($_SESSION['a']['aaview'] == $view) {

            echo "<option value=" . $view . " selected=\"selected\">" . $view . "</option>";
          } else {

            echo "<option value=" . $view . ">" . $view . "</option>";
          }
        }

        ?>
      </select>


      <label><?php echo $lang['tickets-agents']; ?></label>
      <?php
      foreach ($array_of_agents as $filter_agent) {

        // default on page load
        if (!isset($_SESSION["filter_agents"]) && ($filter_agent["UID"] == $_SESSION['a']['aauid'])) {
          echo "<p><input id=" . $filter_agent["UID"] . " class=\"auto-ticket-filter default\" name=\"user[]\" type=\"checkbox\" value=\"" . $filter_agent["UID"] . "\" checked=\"checked\"/> <label class=\"form-field-inline-label\" for=" . $filter_agent["UID"] . ">" . $filter_agent["Fname"] . "</label></p>";
        } else if (isset($_SESSION["filter_agents"]) && (in_array($filter_agent["UID"], $_SESSION["filter_agents"]))) {

          echo "<p><input id=" . $filter_agent["UID"] . " class=\"auto-ticket-filter\" name=\"user[]\" type=\"checkbox\" value=\"" . $filter_agent["UID"] . "\" checked=\"checked\"/> <label class=\"form-field-inline-label\" for=" . $filter_agent["UID"] . ">" . $filter_agent["Fname"] . "</label></p>";
        } else {

          echo "<p><input id=" . $filter_agent["UID"] . " class=\"auto-ticket-filter\" name=\"user[]\" type=\"checkbox\" value=\"" . $filter_agent["UID"] . "\"/> <label class=\"form-field-inline-label\" for=" . $filter_agent["UID"] . ">" . $filter_agent["Fname"] . "</label></p>";
        }
      }

      echo "<p><input id=\"aa-user-unassigned\" class=\"auto-ticket-filter\" name=\"user[]\" type=\"checkbox\" value=\"NULL\" checked=\"checked\"/> <label class=\"form-field-inline-label\" for=\"aa-user-unassigned\">Unassigned</label></p>";

      ?>

      <label><?php echo $lang['tickets-dateadd']; ?></label>
      <?php
      $dates = array("anytime" => $lang['tickets-dateadd-anytime'],
          "today" => $lang['tickets-dateadd-today'],
          "yesterday" => $lang['tickets-dateadd-yesterday'],
          "this_week" => $lang['tickets-dateadd-thisweek'],
          "last_week" => $lang['tickets-dateadd-lastweek'],
          "this_month" => $lang['tickets-dateadd-thismonth'],
          "last_month" => $lang['tickets-dateadd-lastmonth'],
      );

      ?>
      <select id="filter_date" class="auto-ticket-filter" name="filter_dateadded">
        <?php
        foreach ($dates as $key => $value) {

          if (!isset($_SESSION["filter_dateadded"]) && ($key == "anytime")) {

            echo "<option value=\"" . $key . "\" selected=\"selected\">" . $value . "</option>";
          } else if ($_SESSION["filter_dateadded"] == $key) {

            echo "<option value=\"" . $key . "\" selected=\"selected\">" . $value . "</option>";
          } else {

            echo "<option value=\"" . $key . "\">" . $value . "</option>";
          }
        }

        ?>
      </select>
      <label><?php echo $lang['tickets-group']; ?></label>
      <select id="filter_group" class="auto-ticket-filter" name="groups[]" multiple>
        <?php
        foreach ($array_of_groups as $filter_group) {
          if (!isset($_SESSION["filter_groups"]) && (in_array($filter_group["Cat_ID"], $agent_skills))) {

            echo "<option value=\"" . $filter_group["Cat_ID"] . "\" selected=\"selected\">" . decode_entities($filter_group["Category"]) . "</option>";
          } else if (in_array($filter_group["Cat_ID"], $_SESSION["filter_groups"])) {

            echo "<option value=\"" . $filter_group["Cat_ID"] . "\" selected=\"selected\">" . decode_entities($filter_group["Category"]) . "</option>";
          } else {

            echo "<option value=\"" . $filter_group["Cat_ID"] . "\">" . decode_entities($filter_group["Category"]) . "</option>";
          }
        }

        ?>
      </select><span class="text-xsmall"><?php echo $lang['tickets-group-desc']; ?></span></p>

      <label><?php echo $lang['tickets-status']; ?></label>
      <?php
      $statuses = array("Open" => $lang['tickets-status-open'], "Awaiting Reply" => $lang['tickets-status-ar'], "Pending" => $lang['tickets-status-pending'],
          "Paused" => $lang['tickets-status-paused'], "Closed" => $lang['tickets-status-closed']);

      ?>
      <select id="filter_status" class="auto-ticket-filter" name="status[]" multiple>
        <?php
        foreach ($statuses as $status_val => $status_key) {

          // if session doesn't exist yet
          if (!isset($_SESSION["filter_status"]) && ($status_val != "Closed")) {

            echo "<option value=\"" . $status_val . "\" selected=\"selected\">" . $status_key . "</option>";
          } else if (@in_array($status_val, $_SESSION["filter_status"])) {

            echo "<option value=\"" . $status_val . "\" selected=\"selected\">" . $status_key . "</option>";
          } else {

            // give closed as an option but not selected
            echo "<option value=\"" . $status_val . "\">" . $status_key . "</option>";
          }
        }

        ?>
      </select><span class="text-xsmall"><?php echo $lang['tickets-status-desc']; ?></span>

      <?php
      if ($no_of_priorities > 0) {

        ?>
        <label><?php echo $lang['tickets-priority']; ?></label>
        <?php
        foreach ($array_of_priorities as $filter_pri) {

          if (!isset($_SESSION["filter_priority"])) {

            echo "<p><input class=\"auto-ticket-filter\" name=\"priority[]\" type=\"checkbox\" value=\"" . $filter_pri["Level_ID"] . "\" checked=\"checked\"/> <label class=\"form-field-inline-label\">" . decode_entities($filter_pri["Level"]) . "</label></p>";
          } else if (in_array($filter_pri["Level_ID"], $_SESSION["filter_priority"])) {

            echo "<p><input class=\"auto-ticket-filter\" name=\"priority[]\" type=\"checkbox\" value=\"" . $filter_pri["Level_ID"] . "\" checked=\"checked\"/> <label class=\"form-field-inline-label\">" . decode_entities($filter_pri["Level"]) . "</label></p>";
          } else {

            echo "<p><input class=\"auto-ticket-filter\" name=\"priority[]\" type=\"checkbox\" value=\"" . $filter_pri["Level_ID"] . "\"/> <label class=\"form-field-inline-label\">" . decode_entities($filter_pri["Level"]) . "</label></p>";
          }
        }
      }

      ?>
      <?php
      $sla_due_dates = array("0" => "Anytime", "24" => "1 Day", "72" => "3 Days", "168" => "1 Week");

      ?>
      <label>SLA Reply Due</label>
      <select id="filter_slar_due" class="auto-ticket-filter" name="slar_due">
        <?php
        foreach ($sla_due_dates as $slar_due_val => $slar_due_key) {
          if ($slar_due_val == $_SESSION["filter_slar_due"]) {
            echo '<option value="' . $slar_due_val . '" selected="selected">' . $slar_due_key . '</option>';
          } else {
            echo '<option value="' . $slar_due_val . '">' . $slar_due_key . '</option>';
          }
        }

        ?>
      </select>

      <label>SLA Fix Due</label>
      <select id="filter_slaf_due" class="auto-ticket-filter" name="slaf_due">
        <?php
        foreach ($sla_due_dates as $slaf_due_val => $slaf_due_key) {
          if ($slaf_due_val == $_SESSION["filter_slaf_due"]) {
            echo '<option value="' . $slaf_due_val . '" selected="selected">' . $slaf_due_key . '</option>';
          } else {
            echo '<option value="' . $slaf_due_val . '">' . $slaf_due_key . '</option>';
          }
        }

        ?>
      </select>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>

  <div id="layout-body-middle">

    <div id="table_header">
      <?php
      //mysqli_data_seek($sel_agents, 0 );
      foreach ($array_of_agents as $dd_staff) {

        @$staff_str .= "\"" . $dd_staff["Fname"] . "\" : \"" . $dd_staff["UID"] . "\",";
      }

      //mysqli_data_seek($sel_groups, 0 );
      foreach ($array_of_groups as $dd_group) {

        @$cat_str .= "\"" . $dd_group["Category"] . "\" : \"" . $dd_group["Cat_ID"] . "\",";
      }

      //mysqli_data_seek($sel_pris, 0 );
      foreach ($array_of_priorities as $dd_priority) {

        @$pri_str .= "\"" . $dd_priority["Level"] . "\" : \"" . $dd_priority["Level_ID"] . "\",";
      }

      // Allow delete if agent role is admin or supervisor
      if ($_SESSION['a']['aaurole'] != "Agent") {
        $allow_delete = '"' . $lang['tickets-status-delete'] . '": "Delete"';
      }

      ?>
      <script>
        $(function () {
            var selectValues = {
                "Cat_ID": {
<?php echo rtrim($cat_str, ','); ?>
                },
                "Owner": {
<?php echo rtrim($staff_str, ','); ?>
                },
                "Level_ID": {
<?php echo rtrim($pri_str, ','); ?>
                },
                "Status": {
                    "<?php echo $lang['tickets-status-accept']; ?>": "Accept",
                    "<?php echo $lang['tickets-status-open']; ?>": "Open",
                    "<?php echo $lang['tickets-status-pending']; ?>": "Pending",
                    "<?php echo $lang['tickets-status-paused']; ?>": "Paused",
                    "<?php echo $lang['tickets-status-closed']; ?>": "Closed",
<?php echo @$allow_delete; ?>
                }
            };

            var $vendor = $('select.chg_field');
            var $model = $('select.chg_val');
            $vendor.change(function () {
                $model.empty().append(function () {
                    var output = '';
                    $.each(selectValues[$vendor.val()], function (key, value) {
                        output += '<option value=' + value + '>' + key + '</option>';
                    });
                    return output;
                });
            }).change();

        });
      </script>
      <div id="table_bg_color_space">&nbsp;</div>
      <div id="table_select_all">
        <input type="checkbox" name="select-all" id="select-all" />
      </div>
      <div id="table_change">
        <select name="chg_field" id="chg_field" class="chg_field">
          <?php if ($no_of_groups > 0) { ?>
            <option value="Cat_ID"><?php echo $lang['tickets-group']; ?></option>
            <?php
          }

          if ($no_of_agents > 0) {

            ?>
            <option value="Owner"><?php echo $lang['tickets-owner']; ?></option>
            <?php
          }
          if ($no_of_priorities > 0) {

            ?>
            <option value="Level_ID"><?php echo $lang['tickets-priority']; ?></option>
            <?php
          }

          ?>
          <option value="Status" selected="selected"><?php echo $lang['tickets-status']; ?></option>
        </select>

        <select name="chg_val" id="chg_val" class="chg_val">
          <option></option>
        </select>
        <input id="chg" name="chg" type="button" value="<?php echo $lang['generic-change']; ?>" />


      </div>        
      <div id="table_sort">            
        <form id="sort" method="post" action="">

          <?php
          $sortby_options = array("ID" => $lang['tickets-ID'], "Empresa" => "Empresa", "Subject" => $lang['tickets-subject'],
              "Status" => $lang['tickets-status'], "Owner" => $lang['tickets-owner'],
              "Priority" => $lang['tickets-priority'], "Category" => $lang['tickets-group'],
              "Date_Added" => $lang['tickets-dateadd'], "Date_Updated" => $lang['tickets-dateup']);

          ?>
          <?php echo $lang['tickets-sortby']; ?> <select id="sortval" name="sortval">
          <?php
          foreach ($sortby_options as $key => $value) {

            // if session exists and key in loop equals session value
            if (isset($_SESSION["filter_sortby"]) && ($key == $_SESSION["filter_sortby"])) {
              echo "<option value=\"" . $key . "\" selected=\"selected\">" . $value . "</option>";
              // if session doesn't exists and loop equals preffered sort by. for initial page load	
            } else if (!isset($_SESSION["filter_sortby"]) && ($key == "Date_Added")) {
              echo "<option value=\"" . $key . "\" selected=\"selected\">" . $value . "</option>";
            } else {
              echo "<option value=\"" . $key . "\">" . $value . "</option>";
            }
          }

          ?>
          </select>
          <?php
          $sortdir_options = array("ASC" => $lang['tickets-dir-asc'], "DESC" => $lang['tickets-dir-dsc']);

          ?>
          <select name="sortdir" id="sortdir">

            <?php
            foreach ($sortdir_options as $key => $value) {

              // if session exists and key in loop equals session value
              if (isset($_SESSION["filter_sortdir"]) && ($key == $_SESSION["filter_sortdir"])) {
                echo "<option value=\"" . $key . "\" selected=\"selected\">" . $value . "</option>";
                // if session doesn't exists and loop equals preffered sort by. for initial page load
              } else if (!isset($_SESSION["filter_sortdir"]) && ($key == "DESC")) {
                echo "<option value=\"" . $key . "\" selected=\"selected\">" . $value . "</option>";
              } else {
                echo "<option value=\"" . $key . "\">" . $value . "</option>";
              }
            }

            ?>
          </select>
          <?php
          $imail_manual_on = get_settings('Imail_Manual');
          if ($imail_manual_on == 1) {

            ?>
            <input id="getemails" name="getemails" type="button" value="<?php echo $lang['tickets-get-email']; ?>"  />
            <?php
          }

          ?>
        </form>
      </div>
    </div>
    <div id="table_header_fixed_height">&nbsp;</div>

    <div id="ticket_view_header">
      <div class="ticket nohover">
        <div class="ticket_color">&nbsp;</div>
        <div class="ticket_tick">&nbsp;</div>
        <div class="ticket-list">ID</div>
        <div class="ticket-list">Empresa</div>
        <div class="ticket-list-subject">Subject</div>        
        <div class="ticket-list hide-mobile">Status</div>
        <!--            <div class="ticket-list">Group</div>-->
        <div class="ticket-list hide-mobile">Priority</div>
        <div class="ticket-list">Updated</div>
      </div>            
    </div>
    <div id="tickets"></div>
  </div>            
</div>