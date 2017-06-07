<div class="panel navigation-menu" id="navigation-menu">
<ul>
<li><a href="p.php?p=dashboard"><i class="fa fa-tachometer"></i> <?php echo $lang["nav-dashboard"]; ?></a></li>
<li><a href="p.php?p=tickets"><i class="fa fa-ticket"></i> <?php echo $lang["nav-tickets"]; ?></a>
    <ul class="sub-menu">
    <li><a href="p.php?p=ticket-add"><i class="fa fa-plus"></i> <?php echo $lang["nav-add"]; ?></a></li>
    <li><a href="p.php?p=search"><i class="fa fa-search"></i> <?php echo $lang["nav-search"]; ?></a></li>
    <li><a href="p.php?p=tickets"><i class="fa fa-ticket"></i> <?php echo $lang["nav-view"]; ?></a></li>
    </ul>
</li>
<li><a href="p.php?p=kb"><i class="fa fa-book"></i> <?php echo $lang["nav-knowledge"]; ?></a>
    <ul class="sub-menu">    
    <li><a href="p.php?p=kb-article"><i class="fa fa-file-text-o"></i> <?php echo $lang["nav-knowledge-articles"]; ?></a></li>
    <li><a href="p.php?p=kb-group"><i class="fa fa-folder"></i> <?php echo $lang["nav-knowledge-groups"]; ?></a></li>
    </ul>
</li>
<?php
if ($_SESSION['a']['aaurole'] == 2 || $_SESSION['a']['aaurole'] == 3 ) {
?>
<li><a href="p.php?p=report"><i class="fa fa-bar-chart-o"></i> <?php echo $lang["nav-reports"]; ?></a></li>
<?php
}
?>
<?php
if ($_SESSION['a']['aaurole'] == 3) {
?>    
<li><a href="p.php?p=settings-general"><i class="fa fa-cog"></i> <?php echo $lang["nav-set"]; ?></a>
    <ul class="sub-menu">    
    <li><a href="p.php?p=settings-general"><i class="fa fa-info-circle"></i> <?php echo $lang["nav-set-general"]; ?></a></li>
    <li><a href="p.php?p=settings-tickets"><i class="fa fa-ticket"></i> <?php echo $lang["nav-set-tickets"]; ?></a></li>
    <li><a href="p.php?p=settings-livechat"><i class="fa fa-comments-o"></i> <?php echo $lang["nav-set-aachat"]; ?></a></li>
    <li><a href="p.php?p=settings-kb"><i class="fa fa-book"></i> <?php echo $lang["nav-set-knowledge"]; ?></a></li>
    <li><a href="p.php?p=settings-groups"><i class="fa fa-folder"></i> <?php echo $lang["nav-set-groups"]; ?></a></li>
    <li><a href="p.php?p=settings-priority"><i class="fa fa-flag"></i> <?php echo $lang["nav-set-priorities"]; ?></a></li>
    <li><a href="p.php?p=settings-slas"><i class="fa fa-exclamation-triangle"></i> <?php echo $lang["nav-set-slas"]; ?></a></li>    
    <li><a href="p.php?p=settings-customfields"><i class="fa fa-table"></i> <?php echo $lang["nav-set-custom"]; ?></a></li>
    <li><a href="p.php?p=settings-canned"><i class="fa fa-pencil-square-o"></i> <?php echo $lang["nav-set-can"]; ?></a></li>
    <li><a href="p.php?p=settings-iemail"><i class="fa fa-reply"></i> <?php echo $lang["nav-set-inemail"]; ?></a></li>
    <li><a href="p.php?p=settings-oemail"><i class="fa fa-share"></i> <?php echo $lang["nav-set-outemail"]; ?></a></li>   
    <li><a href="p.php?p=settings-user"><i class="fa fa-users"></i> <?php echo $lang["nav-set-users"]; ?></a></li>
    </ul>
</li>
<?php
}
?>
</ul>
</div>