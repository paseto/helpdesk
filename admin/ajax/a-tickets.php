<?php
@session_start();

// include core library functions
require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();


$var = $_POST;

$_SESSION["filter_agents"] = $var["user"];
$_SESSION["filter_groups"] = @$var["groups"];
$_SESSION["filter_status"] = @$var["status"];
$_SESSION["filter_priority"] = @$var["priority"];
$_SESSION["filter_sortby"] = $var["filter_sortval"];
$_SESSION["filter_sortdir"] = $var["filter_sortdir"];
$_SESSION["filter_dateadded"] = $var["filter_dateadded"];
$_SESSION["filter_slar_due"] = @$var["slar_due"];
$_SESSION["filter_slaf_due"] = @$var["slaf_due"];

$_SESSION['a']['aaview'] = $var['ticket_view'];

@$dt = $var["dt"];
$lastdt = date("Y-m-d H:i:s", strtotime($dt.'-15 seconds'));

//print_r($var);

if (isset($dt)) {
	// less than the current time but greater than the previous time
	$sql_updates_only = " AND (t.Date_Added > '".$lastdt."')";
	
} else {
	
	$sql_updates_only = "";
	
}

// get date range from global function
list($filter_date_from, $filter_date_to) = aaDateRange($_SESSION["filter_dateadded"]);

/*
print_r($var);

echo "<p></p>";

print_r($_SESSION["filter_status"]);

echo "<p></p>";


echo "<p></p>";
*/

$s_uid = @$_SESSION['a']['aauid'];

function combine_array ($sqlfield, $arrayname) {

	if(is_array($arrayname)) {
			
		foreach($arrayname as $value) {
			
			// escape value string
			$value = $value;
			
			if ($value == "NULL") {
				@$str .= "$sqlfield IS NULL OR ";	
			} else if (isset($value)) {
				@$str .= "$sqlfield = '$value' OR ";	
			} 
		}
		
	}
	
	// show priorities with default of 0
	if ($sqlfield == "t.Level_ID") {
		$str .= "t.Level_ID = '0'";
		}
					
	@$str = rtrim($str, " OR ");
	$complete_str = "(".$str.")";
	return $complete_str;
	
}

$sql_agents = combine_array("t.Owner", $_SESSION["filter_agents"]);
$sql_groups = combine_array("t.Cat_ID", $_SESSION["filter_groups"]);
$sql_status = combine_array("t.Status", $_SESSION["filter_status"]);
$sql_slar_due = ($_SESSION["filter_slar_due"] == 0) ? "" : " AND SLA_Reply BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL ".$_SESSION["filter_slar_due"]." HOUR) ";
$sql_slaf_due = ($_SESSION["filter_slaf_due"] == 0) ? "" : " AND SLA_Fix BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL ".$_SESSION["filter_slaf_due"]." HOUR) ";

if ($_SESSION["filter_dateadded"] != "anytime") {
	$sql_dateadd = " AND (t.Date_Added BETWEEN '$filter_date_from' AND '$filter_date_to')".$sql_updates_only;
} else {
	$sql_dateadd = $sql_updates_only;
}

if (isset($_SESSION["filter_priority"])) {
$sql_priority = combine_array("t.Level_ID", $_SESSION["filter_priority"]);
}

// statement for filter
$wheresql = rtrim("WHERE ".$sql_agents." AND ".$sql_groups." AND ".$sql_status." AND ".@$sql_priority.$sql_dateadd.$sql_slar_due.$sql_slaf_due." AND t.Type != 'Chat' ORDER BY ".$_SESSION["filter_sortby"]." ".$_SESSION["filter_sortdir"], " AND ");


// starting live code
// include @ to avoid errors once log in session has expired
@include '../../public/language/'.$_SESSION['aalang'].'.php';
// set $db as variable for mysql functions
//$db = db_connect();
$date_format = get_settings('Date_Format');

// remove skilled join to show all tickets. prevent changes via the ticket it's self
$sel_tickets = "SELECT t.ID, 
				t.Subject,
				t.Type,
				t.User,
				t.Status,
				DATE_FORMAT(t.Date_Added, '$date_format') AS DateAdd,
				DATE_FORMAT(t.Date_Updated, '$date_format') AS DateUp,
				DATE_FORMAT(t.SLA_Reply, '$date_format') AS DateSlaR,
				DATE_FORMAT(t.SLA_Fix, '$date_format') AS DateSlaF,
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
				t.Date_Replied,
				t.SLA_Reply,
				t.Date_Closed,
				t.SLA_Fix,
				t.Cat_ID,
				CASE t.Cat_ID WHEN c.Cat_ID THEN c.Category ELSE NULL END Category,
				t.Level_ID,
				CASE t.Level_ID WHEN p.Level_ID THEN p.Level ELSE NULL END Priority,	
				t.Owner,
				CASE WHEN t.Owner IS NULL THEN 'Unassigned' ELSE u.Fname END AS Owned
				FROM ".$pdo_t['t_ticket']." AS t
				LEFT JOIN ".$pdo_t['t_groups']." AS c ON t.Cat_ID = c.Cat_ID
				LEFT JOIN ".$pdo_t['t_priorities']." AS p ON t.Level_ID = p.Level_ID
				LEFT JOIN ".$pdo_t['t_users']." AS u ON t.Owner = u.UID
				$wheresql";
									 
$tickets = $pdo_conn->prepare($sel_tickets);
$tickets->execute();

$fetchtickets = $tickets->fetchAll();
$agent_skills = aaModelGetAgentSkills($s_uid);
?>



	<?php
    foreach ($fetchtickets as $ticket) {
	
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

		<div class="ticket_tick">
        <?php 
		// if skilled in group allowed to manage many
		if (in_array($ticket["Cat_ID"], $agent_skills)) {
		?>	
        <input type="checkbox" class="checkbox" name="checked_ticket" id="<?php echo $ticket["ID"]; ?>" value="<?php echo $ticket["ID"]; ?>" />
        <?php
		} else {
		?>
        <input disabled="disabled" type="checkbox" class="checkbox" name="checked_ticket" id="<?php echo $ticket["ID"]; ?>" value="<?php echo $ticket["ID"]; ?>" />
		<?php
		}
		?>
        </div>
        
        <?php
		if ($var['ticket_view'] == 'List') {
		?>
        
			<div class="tl ticket-list">
			<a href="p.php?p=ticket&tid=<?php echo $ticket["ID"]; ?>"><?php echo $ticket["ID"]; ?></a>
			</div>
			<div class="tl ticket-list-subject">
			<a href="p.php?p=ticket&tid=<?php echo $ticket["ID"]; ?>"><?php echo html_entity_decode(stripslashes($ticket["Subject"])); ?></a>
			</div>
			<div class="tl ticket-list hide-mobile">
			<?php echo aa_select_ticket_status_lang($ticket["Status"]); ?>
			</div>
<!--			<div class="tl ticket-list">
			<?php echo decode_entities($ticket["Category"]); ?>
			</div>-->
			<div class="tl ticket-list hide-mobile">
			<?php echo decode_entities($ticket["Priority"]); ?>        
			</div>
			<div class="tl ticket-list">
			<?php echo $ticket["DateUp"]; ?>
			</div>
            
		<?php
		} else {
		?>

            <div class="ticket_summary">
            <?php echo "<p class=\"text-large\"><a href=\"p.php?p=ticket&tid=".$ticket["ID"]."\">".html_entity_decode(stripslashes($ticket["Subject"]))."</a></p>
            <p><i style=\"margin-left:0px\" class=\"fa fa-plus-square\"></i> ".aa_select_ticket_status_lang($ticket["Status"])."
            <i class=\"fa fa-folder\"></i> ".decode_entities($ticket["Category"])."
            <i class=\"fa fa-flag\"></i> ".decode_entities($ticket["Priority"])."
            <i class=\"fa fa-user\"></i> ".decode_entities($ticket["Owned"])."
            ".aa_select_ticket_type_lang($ticket['Type'])."</i>
			[#".$ticket["ID"]."]</p>"; ?>
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
        
        <?php
		}
		?>
        
        </div>
	<?php
	// end while loop
	}
	?>