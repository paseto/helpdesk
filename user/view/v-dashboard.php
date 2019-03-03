<?php
if ($db_user_reg  == 1) {
	if (!isset($_SESSION['u']['aauid']) || ($_SESSION['u']['aaurole'] != 0)) {
		header ("Location: index.php?p=user-access");
	}
}
?>
<div class="margin-body">
<h2><?php echo $lang['u-dashboard']; ?></h2>
<hr />
<?php

//echo $_SESSION['u']['aauid'];

$user_tickets = aaModelGetUserTickets($_SESSION['u']['aauid']);
$array_of_tickets = $user_tickets->fetchAll();
$no_tickets = $user_tickets->rowCount();

if ($no_tickets > 0) {
//print_r($array_of_tickets);
echo '<div class="div-table b">'.$lang['u-dashboard-sub'].'</div>'.
	'<div class="div-table b">'.$lang['u-dashboard-stat'].'</div>'.
	'<div class="div-table b">'.$lang['u-dashboard-da'].'</div>'.
	'<div class="div-table b">'.$lang['u-dashboard-du'].'</div>';
	
foreach ($array_of_tickets as $ticket) {
	echo '<div class="div-table-cont">';
	echo '<div class="div-table"><a href="index.php?p=ticket&email='.$ticket["User_Email"].'&tid='.$ticket["ID"].'">'.decode_entities($ticket["Subject"]).'</a></div>'.
	'<div class="div-table">'.$ticket["Status"].'</div>'.
	'<div class="div-table">'.$ticket["DateAdd"].'</div>'.
	'<div class="div-table">'.$ticket["DateUp"].'</div>';
	echo '</div>';
}
} else {
	echo '<p>'.$lang['u-dashboard-not'].'</p>';
}
?>
</div>