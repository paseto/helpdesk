<?php
$id = str_pad($_GET['tid'], 7, '0', STR_PAD_LEFT);

$referringSite = $_SERVER['HTTP_REFERER']; 
// explore HTTP_REFERER by / to get page
$referrer_pieces = explode('/', $referringSite);
// get the last array element
$page = array_pop($referrer_pieces);
?>
<div class="margin-body form">
	<h2><?php echo $lang["ticket-add-title"]; ?></h2>
	<hr />
	<p><?php echo $lang['ticket-add-success-new']; ?> : <a href="index.php?p=ticket&email=<?php echo $_GET['ue']; ?>&tid=<?php echo $id; ?>"><strong><?php echo $id; ?></strong></a></p>
	<p><?php echo $lang['ticket-add-success-breif']; ?> : <strong><?php echo $_GET['ue']; ?></strong></p>	
</div>