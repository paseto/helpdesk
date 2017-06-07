<?php
	$body_left_icon = array(
	'<i class="fa fa-filter fa-lg"></i>' => 'tickets', 
	'<i class="fa fa-file-text-o fa-lg"></i>' => 'ticket', 
	'<i class="fa fa-search fa-lg"></i>' => 'search',
	'<i class="fa fa-file-o fa-lg"></i>' => 'user-profile',
	'<i class="fa fa-bar-chart-o"></i>' => 'report');
	if (in_array($_GET['p'], $body_left_icon)) {
	
		$body_left_icon_mobile = array_search($_GET['p'], $body_left_icon);
		
	}
?>
<body>

<div id="layout-cont">
	<div id="layout-header">
    <div id="layout-header-left"><span id="title"><a href="p.php?p=tickets"><?php echo get_settings('Company_Name'); ?></a></span></div>
    <div id="layout-header-middle">
    <form id="search_quick" method="post">
    <input type="text" id="form-aa-search" name="form-aa-search" placeholder="<?php echo $lang['header-search']; ?>" />
    <input style="display:none; visibility:hidden;" id="search_action" name="q_search" type="submit" value="Search" />
    </form>    
    </div>
    <div id="layout-header-right">
	<span id="aachat_notification"></span>
	<?php
	if ($aachat_on == 1) {
    echo '<a class="navigation-toggle navigation-chat" panel="navigation-chat" dir="up" href="#"><i class="fa fa-comments-o fa-lg"></i></a>&nbsp;';
	}
	?>
    <a class="navigation-toggle" panel="navigation-profile" dir="up" href="#"><i class="fa fa-user fa-lg"></i></a>&nbsp;
    <a class="navigation-toggle" panel="navigation-menu" dir="right" href="#"><i class="fa fa-bars fa-lg"></i></a>&nbsp;
    <a class="navigation-toggle navigation-mobile-links" panel="layout-body-left" dir="right" href="#"><?php echo @$body_left_icon_mobile; ?>
</a></div>
    </div>
	<div id="layout-header-height">&nbsp;</div>
