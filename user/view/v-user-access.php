<?php
// if already logged in skip option for sign in or guest access
if (isset($_SESSION['u']['aauid']) && ($_SESSION['u']['aaurole'] == 0)) {
		header ("Location: index.php?p=dashboard");
}
?>
<div class="margin-body form">
<h2><?php echo $lang['u-access-title']; ?></h2>
<hr />
<?php
if ($db_user_reg == 1) {

// Submit Button
if (isset($_POST["SignIn"])) {

	if (aaGetUser($_POST['signin_email'], $_POST['signin_pwd'], "u")) {
		header("Location: index.php?p=dashboard");
	} else {
		?>
		<div class="error-msg"><?php read_session('aaerror-login'); ?></div>
        <?php
	}
}

?>
	<div class="kbeven">
    <h3><?php echo $lang['u-signin']; ?></h3>	

    
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <label for="user"><?php echo $lang['ticket-add-email']; ?></label>
    <p><input class="signinform" name="signin_email" type="text" id="signin_email" value="<?php cached_fields (@$_POST['signin_email']); ?>" autofocus="autofocus" placeholder="<?php echo $lang['ticket-add-email']; ?>"></p>
    
    <label for="user"><?php echo $lang['ticket-add-pwd']; ?></label>
    <p><input class="signinform" name="signin_pwd" type="password" id="signin_pwd" value="<?php cached_fields (@$_POST['signin_pwd']); ?>" placeholder="<?php echo $lang['ticket-add-pwd']; ?>"></p>
    
    <p><input class="btn" name="SignIn" type="submit" id="SignIn" value="<?php echo $lang['u-signin']; ?>" /></p>
	</form>
    
	<p><a href="index.php?p=user-forgotpwd"><?php echo $lang['index-forgotpwd']; ?></a></p>
	
    <p><a href="index.php?p=user-register"><?php echo $lang['u-register-user']; ?></a></p>
    </div>
<?php
}

if ($db_guest_access == 1) {

?>
    
	<div class="kbeven">
	<h3><?php echo $lang['u-guest']; ?></h3>  
    <p><?php echo $lang['u-guest-desc']; ?></p> 
    <a href="index.php?p=<?php echo $_GET["r"]; ?>&guest=1"><?php echo $lang['u-guest-link']; ?></a>
    </div>
<?php
}
?>

</div>