<?php
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
require_once "../model/m-dashboard.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';

$pdo_conn = pdo_conn();

$sql_u_t = "SELECT * FROM ".$pdo_t['t_ticket']." WHERE Owner IS NULL";
$q_u_t = $pdo_conn->prepare($sql_u_t);
$q_u_t->execute();
$unassigned_ticket_count = $q_u_t->rowCount();

// sql for summary by grup
$sql_g_t = "SELECT Cat_ID, Category FROM ".$pdo_t['t_groups']." ORDER BY Category ASC";
$q_g_t = $pdo_conn->prepare($sql_g_t);
$q_g_t->execute();
$sel_tickets_by_group = $q_g_t->fetchAll();

// total up ticket statuses
$ticket_total = aa_dashboard_count_totals("Open") + 
				aa_dashboard_count_totals("Pending") + 
				aa_dashboard_count_totals("Paused") +
				aa_dashboard_count_totals("Closed");

$dashboard_date_range = @$_POST["p_date_range"];

?>
<h2>Summary</h2>
<hr>

<div id="summary">
    <ul>
    <li class="open"><a class="summary_block" status="Open" href="#"><?php echo @$lang['tickets-status-open']; ?> <?php echo aa_dashboard_count_totals("Open", $dashboard_date_range); ?></a></li>
    <li class="awaitingreply"><a class="summary_block" status="Awaiting Reply" href="#"><?php echo @$lang['tickets-status-ar']; ?>  <?php echo aa_dashboard_count_totals("Awaiting Reply", $dashboard_date_range); ?></a></li>           
    <li class="pending"><a class="summary_block" status="Pending" href="#"><?php echo @$lang['tickets-status-pending']; ?> <?php echo aa_dashboard_count_totals("Pending", $dashboard_date_range); ?></a></li>
    <li class="paused"><a class="summary_block" status="Paused" href="#"><?php echo @$lang['tickets-status-paused']; ?> <?php echo aa_dashboard_count_totals("Paused", $dashboard_date_range); ?></a></li>
    <li class="slarexpiry"><a class="summary_block" status="Paused" href="#">Reply SLA Expiring <?php echo aaModelSLARExpiring(); ?></a></li>
    <li class="slafexpiry"><a class="summary_block" status="Paused" href="#">Fix SLA Expiring <?php echo aaModelSLAFExpiring(); ?></a></li> 
    <li class="closed"><a class="summary_block" status="Closed" href="#"><?php echo @$lang['tickets-status-closed']; ?> <?php echo aa_dashboard_count_totals("Closed", $dashboard_date_range); ?></a></li>
    <li class="unassigned"><a class="summary_block" status="Unassigned" href="#"><?php echo @$lang["generic-unassigned"]; ?> <?php echo $unassigned_ticket_count; ?></a></li>
    <li class="total"><a><?php echo @$lang['rep-total']; ?> <?php echo $ticket_total; ?></a></li>
    </ul>
</div>

<h2><i class="fa fa-bar-chart"></i> <?php echo @$lang['dash-group-sum']; ?></h2>
<hr />

        		
<table>
<thead>
<tr>
<th>&nbsp;</th>
<th><?php echo @$lang['tickets-status-open']; ?></th>
<th><?php echo @$lang['tickets-status-ar']; ?></th>
<th><?php echo @$lang['tickets-status-pending']; ?></th>            
<th><?php echo @$lang['tickets-status-paused']; ?></th>
<th><?php echo @$lang['ticket-details-slar']; ?></th>
<th><?php echo @$lang['ticket-details-slaf']; ?></th>
<th><?php echo @$lang['tickets-status-closed']; ?></th>
<th><?php echo @$lang["generic-unassigned"]; ?></th>
</tr>
</thead>
<tbody class="text-center">
<?php

foreach ($sel_tickets_by_group as $t_group) {

echo "<tr><td>".$t_group['Category']."</td>
<td data-title=\"".@$lang['tickets-status-open']."\"><a class=\"summary_block open-color\" group=\"".$t_group['Cat_ID']."\" status=\"Open\" href=\"#\">".aa_count_tickets_by_status($t_group['Cat_ID'], 'Open', $dashboard_date_range)."</a></td>
<td><a class=\"summary_block open-color\" group=\"".$t_group['Cat_ID']."\" status=\"Awaiting Reply\" href=\"#\">".aa_count_tickets_by_status($t_group['Cat_ID'], 'Awaiting Reply', $dashboard_date_range)."</td></td>
<td data-title=\"".@$lang['tickets-status-pending']."\"><a class=\"summary_block pending-color\" group=\"".$t_group['Cat_ID']."\" status=\"Pending\" href=\"#\">".aa_count_tickets_by_status($t_group['Cat_ID'], 'Pending', $dashboard_date_range)."</a></td>
<td data-title=\"".@$lang['tickets-status-paused']."\"><a class=\"summary_block paused-color\" group=\"".$t_group['Cat_ID']."\" status=\"Paused\" href=\"#\">".aa_count_tickets_by_status($t_group['Cat_ID'], 'Paused', $dashboard_date_range)."</a></td>
<td>".aaModelSLARExpiring($t_group['Cat_ID'])."</td>
<td>".aaModelSLAFExpiring($t_group['Cat_ID'])."</td>
<td data-title=\"".@$lang['tickets-status-closed']."\"><a class=\"summary_block closed-color\" group=\"".$t_group['Cat_ID']."\" status=\"Closed\" href=\"#\">".aa_count_tickets_by_status($t_group['Cat_ID'], 'Closed', $dashboard_date_range)."</a></td>
<td data-title=\"".@$lang["generic-unassigned"]."\"><a class=\"summary_block\" group=\"".$t_group['Cat_ID']."\" status=\"Unassigned\" href=\"#\">".aa_count_tickets_by_status($t_group['Cat_ID'], 'NULL', $dashboard_date_range)."</a></td>
</tr>";

}
?>
</tbody>
</table>
<p class="text-xsmall text-center"><?php echo @$lang['dash-group-click']; ?></p>
