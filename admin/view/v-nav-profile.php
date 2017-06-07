<div class="panel navigation-box" id="navigation-profile">
    <ul>
        <li><a href="p.php?p=user-profile&email=<?php echo $s_email; ?>&uid=<?php echo $s_uid; ?>"><i class="fa fa-user"></i> <?php echo $_SESSION['a']['aaname']; ?></a></li>
        <li><a href="p.php?p=user-profile&email=<?php echo $s_email; ?>&uid=<?php echo $s_uid; ?>"><i class="fa fa-user"></i> <?php echo $lang["nav-set-profile"]; ?></a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out"></i> <?php echo $lang["nav-set-logout"]; ?></a></li>
    </ul>
</div>