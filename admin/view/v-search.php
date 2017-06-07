<?php
// if advanced search reset button
if (isset($_POST["action_reset"])) {

	// clear existing search before generating new search string
	aaModelSearchUnsetFilter();

	header('Location: '.$_SERVER['REQUEST_URI']);

}

// if advanced search used
if (isset($_POST["action_search"])) {
		
	$search = aaModelSearchAdvanced();
	$searched_tickets = $search->fetchAll();
	$search_total = $search->rowCount();

	
// if quick search used
} else if (isset($_GET["search"])) {

	$search = aaModelSearchQuick($_GET["search"]);
	$searched_tickets = $search->fetchAll();
	$search_total = $search->rowCount();	
	
// if saved search
} else if (isset($_SESSION["cond"])) {

	$search = aaModelSearchSaved();
	$searched_tickets = $search->fetchAll();
	$search_total = $search->rowCount();
	
}
?>

<div id="layout-body">

	<div id="layout-body-left-width">&nbsp;</div>
    <div id="layout-body-left" class="form layout-padding">
    
    
    <h2><?php echo $lang['search-advanced']; ?></h2>
    

    <form name="search_advanced" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    
    <label><?php echo $lang['tickets-ID']; ?></label>
	<input id="adv_s_tid" name="adv_s_tid" type="text" value="<?php cached_fields (@$_SESSION["adv_s_tid"]); ?>" />
        
    <label><?php echo $lang['search-subject']; ?></label>
    <input id="adv_s_subject" name="adv_s_subject" type="text" value="<?php cached_fields (@$_SESSION["adv_s_subject"]); ?>" />
        
    <label><?php echo $lang['search-msg']; ?></label>
	<input id="adv_s_msg" name="adv_s_msg" type="text" value="<?php cached_fields (@$_SESSION["adv_s_msg"]); ?>" />
        
    <label><?php echo $lang['search-cust']; ?></label>
	<input id="adv_s_cust" name="adv_s_cust" type="text" value="<?php cached_fields (@$_SESSION["adv_s_cust"]); ?>" />
    
    <label><?php echo $lang['tickets-group']; ?></label>
    <select name="adv_s_group" id="adv_s_group">
    <option value="%"><?php echo $lang['search-any']; ?></option>		
    <?php
	$groups = aaModelGetGroups();
	$array_of_groups = $groups->fetchAll();
	foreach($array_of_groups as $cats) {
    		
		if ($_SESSION["adv_s_group"] == $cats["Cat_ID"]) {

			echo "<option value=\"".$cats["Cat_ID"]."\" selected=\"selected\">".decode_entities($cats["Category"])."</option>";
        
		} else {
			
			echo "<option value=\"".$cats["Cat_ID"]."\">".decode_entities($cats["Category"])."</option>";
        
		}
		
    }
    
    ?>
    </select>
    
    
    <label><?php echo $lang['tickets-status']; ?></label>
    <?php
    
    $status_options = array("Open" => $lang['tickets-status-open'], "Pending" => $lang['tickets-status-pending'],
					 "Paused" => $lang['tickets-status-paused'], "Closed" => $lang['tickets-status-closed']);
    
    ?>
    
    <select name="adv_s_status" id="adv_s_status">
    <option value="%"><?php echo $lang['search-any']; ?></option>
    <?php
    
    foreach ($status_options as $opt_val => $opt_key) {
		
		if ($_SESSION["adv_s_status"] == $opt_val) {
        
        echo "<option value=\"".$opt_val."\" selected=\"selected\">".$opt_key."</option>";
        
		} else {
		
        echo "<option value=\"".$opt_val."\">".$opt_key."</option>";
			
		}
		
    }
    ?>
    </select>
    
    <label><?php echo $lang['tickets-priority']; ?></label>
    <select name="adv_s_priority" id="adv_s_priority">
    <option value="%"><?php echo $lang['search-any']; ?></option>		
    <?php
	$priorities = aaModelGetPriorities();
	$array_of_priorities = $priorities->fetchAll();
	
	foreach($array_of_priorities as $levels) {  

		if ($_SESSION["adv_s_priority"] == $levels["Level_ID"]) {

            echo "<option value=\"".$levels["Level_ID"]."\" selected=\"selected\">".decode_entities($levels["Level"])."</option>";
		
		} else {
			
            echo "<option value=\"".$levels["Level_ID"]."\">".decode_entities($levels["Level"])."</option>";
           
		}
    }
    
    ?>
    </select>
    
    <label><?php echo $lang['tickets-owner']; ?></label>
    <select name="adv_s_owner" id="adv_s_owner">
    <option value="%"><?php echo $lang['search-any']; ?></option>
    <?php
	$agents = aaModelGetAgents();
	$array_of_agents = $agents->fetchAll();
    
	foreach($array_of_agents as $user) {
		
		if($_SESSION["adv_s_owner"] == $user["UID"]) {

        	echo "<option value=\"".$user["UID"]."\" selected=\"selected\">".$user["Fname"]." ".$user["Lname"]."</option>";

		} else {
            
        	echo "<option value=\"".$user["UID"]."\">".$user["Fname"]." ".$user["Lname"]."</option>";
            
		}
			
    }
    
    ?>
    </select>

    <label><?php echo $lang['search-dateaddfrom']; ?></label>
	<input id="adv_s_dateadd_from" autocomplete="off" name="adv_s_dateadd_from" type="text" value="<?php cached_fields (@$_SESSION["adv_s_dateadd_from"]); ?>" />

    <label><?php echo $lang['search-dateaddto']; ?></label>
    <input id="adv_s_dateadd_to" autocomplete="off" name="adv_s_dateadd_to" type="text" value="<?php cached_fields (@$_SESSION["adv_s_dateadd_to"]); ?>" />

    <label><?php echo $lang['search-dateupfrom']; ?></label>
	<input id="adv_s_dateup_from" autocomplete="off" name="adv_s_dateup_from" type="text" value="<?php cached_fields (@$_SESSION["adv_s_dateup_from"]); ?>" />

    <label><?php echo $lang['search-dateupto']; ?></label>
	<input id="adv_s_dateup_to" autocomplete="off" name="adv_s_dateup_to" type="text" value="<?php cached_fields (@$_SESSION["adv_s_dateup_to"]); ?>" />

    <label><?php echo $lang['search-dateclosefrom']; ?></label>
	<input id="adv_s_dateclosed_from" autocomplete="off" name="adv_s_dateclosed_from" type="text" value="<?php cached_fields (@$_SESSION["adv_s_dateclosed_from"]); ?>" />
    
    <label><?php echo $lang['search-datecloseto']; ?></label>
	<input id="adv_s_dateclosed_to" autocomplete="off" name="adv_s_dateclosed_to" type="text" value="<?php cached_fields (@$_SESSION["adv_s_dateclosed_to"]); ?>" />
    
    <p><input class="btn" name="action_search" type="submit" value="<?php echo $lang['search-button-submit']; ?>" /></p>
    <p><input class="btn" name="action_reset" type="submit" value="<?php echo $lang['search-button-reset']; ?>" /></p>
	<p>&nbsp;</p>
    </form>
    
  </div>

<div id="layout-body-middle">
    <?php
	if (isset($_GET["search"]) || isset($_POST["action_search"]) || isset($_SESSION["cond"])) {
		
		if($search_total > 0) {
		?>
        <div id="table_header">
            <div id="table_bg_color_space">&nbsp;</div>
            <div id="table_select_all">&nbsp;</div>
        	<div id="table_generic">

		<?php
		echo "<b>".$search_total."</b> ".$lang['search-results']." <span id=\"search_criterea\"></span>";
	
		?>
		</div>
		</div>
         <div id="table_header_fixed_height">&nbsp;</div>
		<?php
		
			foreach($searched_tickets as $ticket) {
			//while ($ticket = @mysqli_fetch_array($searched_tickets)) {
			
			$user = decode_entities($ticket["User"]);
			$subject = decode_entities($ticket["Subject"]);
				
			switch ($ticket["Status"]) {
				case "Open":
					$row = "open";
					$td = "open";
					break;
				case "Awaiting Reply":
					$row = "awaitingreply";
					$td = "awaitingreply";
					break;			
				case "Pending":
					$row = "";		
					$td = "pending";		
					break;
				case "Paused":
					$row = "";		
					$td= "paused";
					break;
				case "Closed":
					$row = "";		
					$td = "closed";
					break;	
				default:
					$row = "";
					$td = "";
			} 

			?>
			
            <div class="ticket" id="<?php echo $ticket["ID"]; ?>">
                <div class="ticket_color <?php echo $td; ?>">&nbsp;</div>
                <div class="ticket_tick">&nbsp;</div>
				
				<div class="ticket_summary">
				<?php echo "<p class=\"text-large\">".highlight($subject, @$_SESSION["adv_s_subject"].';'.@$_SESSION["qs_input"])."</a></p>
				<p><i style=\"margin-left:0px\" class=\"fa fa-plus-square\"></i> ".decode_entities(highlight(aa_select_ticket_status_lang($ticket["Status"]), @$_SESSION["adv_s_status"].';'.@$_SESSION["qs_input"]))."
				<i class=\"fa fa-folder\"></i> ".decode_entities(highlight($ticket["Category"], @$_SESSION["adv_s_group"].';'.@$_SESSION["qs_input"]))."
				<i class=\"fa fa-flag\"></i> ".decode_entities(highlight($ticket["Priority"], @$_SESSION["adv_s_priority"].';'.@$_SESSION["qs_input"]))." 
				<i class=\"fa fa-user\"></i> ".decode_entities(highlight($ticket["Owned"], @$_SESSION["adv_s_owner"].';'.@$_SESSION["qs_input"]))."
				".aa_select_ticket_type_lang($ticket['Type'])."</i>
				[#".highlight($ticket["ID"], @$_SESSION["adv_s_tid"].';'.@$_SESSION["qs_input"])."]</p>"; ?>
				<div class="text-xsmall">
				<?php 
				echo '<i style="margin-left:0px" class="fa fa-calendar"></i> '.$lang['search-added'].' '.$ticket["DateAdd"].'
				<i class="fa fa-calendar"></i> '.$lang['search-updated'].' '.$ticket["DateUp"];
				
					if ($ticket["SLAR"] != $lang["generic-na"])  {
						
						if (is_null($ticket["Date_Replied"])) { // if no reply yet, show time remaining
							echo '<p><i style="margin-left:0px" class="fa fa-calendar"></i> '.$lang['ticket-details-slar'].' '.$ticket["SLAR"].' - <span class="text-xsmall error">'.time_difference($ticket["DateSlaR"]).'</span>';
						} else if ($ticket["Date_Replied"] > $ticket["SLA_Reply"]) { // if replied after sla expected
							echo '<p><i style="margin-left:0px" class="fa fa-calendar"></i> '.$lang['ticket-details-slar'].' '.$ticket["SLAR"].' - <span class="text-xsmall error">'.$lang['ticket-details-sla-fail'].' '.$ticket["DateReplied"].'</span>';
						} else { // if no reply and time exceeded
							echo '<p><i style="margin-left:0px" class="fa fa-calendar"></i> '.$lang['ticket-details-slar'].' '.$ticket["SLAR"].' - <span class="text-xsmall success">'.$lang['ticket-details-sla-suc'].' '.$ticket["DateReplied"].'</span>';
						}				
						
					} else {
						echo "<br>";
					}
					
					if ($ticket["SLAF"] != $lang["generic-na"]) {
						
						if (is_null($ticket["Date_Closed"])) {
							echo '<p><i style="margin-left:0px" class="fa fa-calendar"></i> '.$lang['ticket-details-slaf'].' '.$ticket["SLAF"].' - <span class="text-xsmall error">'.time_difference($ticket["DateSlaF"]).'</span>';
						} else if ($ticket["Date_Closed"] > $ticket["SLA_Fix"]) {
							echo '<p><i style="margin-left:0px" class="fa fa-calendar"></i> '.$lang['ticket-details-slaf'].' '.$ticket["SLAF"].' - <span class="text-xsmall error">'.$lang['ticket-details-sla-fail'].' '.$ticket["DateClosed"].'</span>';
						} else {
							echo '<p><i style="margin-left:0px" class="fa fa-calendar"></i> '.$lang['ticket-details-slaf'].' '.$ticket["SLAF"].' - <span class="text-xsmall success">'.$lang['ticket-details-sla-suc'].' '.$ticket["DateClosed"].'</span>';
						}
						
					} else {
						echo "<br>";
					}
							

				?>
				</div>
				</div>
			

            </div>
			<?php
			// end while loop
			}
		
		// end if total search is greater than 0	
		} else {
			?>
            <div id="table_header">
            <div id="table_bg_color_space">&nbsp;</div>
            <div id="table_select_all">&nbsp;</div>
        	<div id="table_generic">
			<?php echo $lang['search-no-results']; ?> <span id="search_criterea"></span>
			</div>
            </div>
    		<?php
		}

	}
	?>
</div>    
</div>