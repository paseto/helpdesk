<?php
$db_kb_enable = get_settings('KB_Enable');
?>
<div class="margin-body">
    <div class="header">
    <h1><a id="title" href="index.php"><?php echo get_settings('Company_Name'); ?></a></h1>
    </div>
    <div id="langauge" class="header">
    		<?php
		//select_langauge();
		?>
    </div>
    <div id="nav" style="clear:both">
    <p>
    <?php
    if ($db_kb_enable == 1) {
    ?>
    <a href="index.php"><?php echo $lang['u-nav-kb']; ?></a>
    <?php
    }
    ?>

	<?php
	// 
	if (isset($_SESSION['u']['aauid']) && ($_SESSION['u']['aaurole'] == 0)) {
	?>
	<a href="index.php?p=ticket-add"><?php echo $lang['u-nav-s-request']; ?></a>
    <a href="index.php?p=dashboard"><?php echo $lang['u-nav-dashboard']; ?></a>
	<a href="index.php?p=profile"><?php echo $lang['u-nav-profile']; ?></a>
    <a href="logout.php"><?php echo $lang['u-nav-logout']; ?></a> (<?php echo $_SESSION['u']['aaname'].' - '.$_SESSION['u']['empresa']; ?>)    
    <?php
	} else {

		if ($db_user_reg == 1 || $db_guest_access == 1) {
		?>
		<a href="index.php?p=ticket-add"><?php echo $lang['u-nav-dashboard']; ?></a>
		<?php
		}
		
		if ($db_guest_access == 1) {
		?>
		<a href="index.php?p=ticket-track"><?php echo $lang['u-nav-t-request']; ?></a>
		<?php
		}

	}
	?>
    </p>
    </div>
</div>
