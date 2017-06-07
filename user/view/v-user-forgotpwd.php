<div class="margin-body form">
<h2><?php echo $lang['index-forgotpwd']; ?></h2>
<hr />
<?php
if (isset($_POST["uforgotpwd_submit"])) {
	
	aaForgottenPwd ($_POST["uforgotpwd_email"]);
	
}
?>
<form name"uforgotpwd" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">

<div class="form-field">
<label for="uforgotpwd_email"><?php echo $lang['u-register-email']; ?></label>
<input name="uforgotpwd_email" type="text" autocomplete="off" value="<?php cached_fields (@$_POST['uforgotpwd_email']); ?>" />
</div>

<p><input name="uforgotpwd_submit" class="btn" type="submit" value="<?php echo $lang['generic-save']; ?>" /></p>
</form>

</div>