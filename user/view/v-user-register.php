<div class="margin-body form">
<h2><?php echo $lang['u-register-title']; ?></h2>
<hr />
<?php
if (isset($_POST["ureg_submit"])) {
	aaModelValidateUserForm($_POST['ureg_fname'], $_POST['ureg_email'], preg_replace("/[^0-9]/", "",$_POST['ureg_tele']), $_POST['ureg_pwd'], $_POST['ureg_cpwd']);
}
?>
<form name"ureg" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
<div class="form-field">
<label for="ureg_fane"><?php echo $lang['u-register-name']; ?> *</label>
<input name="ureg_fname" type="text" autocomplete="off" value="<?php cached_fields (@$_POST['ureg_fname']); ?>" />
</div>

<div class="form-field">
<label for="ureg_email"><?php echo $lang['u-register-email']; ?> *</label>
<input name="ureg_email" type="text" autocomplete="off" value="<?php cached_fields (@$_POST['ureg_email']); ?>" />
</div>

<div class="form-field">
<label for="ureg_tele">CNPJ da Empresa</label>
<input name="ureg_tele" type="text" autocomplete="on" value="<?php cached_fields (@$_POST['ureg_tele']); ?>" />
</div>

<div class="form-field">
<label for="ureg_pwd"><?php echo $lang['u-register-pwd']; ?> *</label>
<input name="ureg_pwd" type="password" autocomplete="off" value="<?php cached_fields (@$_POST['ureg_pwd']); ?>" />
</div>

<div class="form-field">
<label for="ureg_fane"><?php echo $lang['u-register-cpwd']; ?> *</label>
<input name="ureg_cpwd" type="password" autocomplete="off" value="<?php cached_fields (@$_POST['ureg_cpwd']); ?>" />
</div>

<p><input name="ureg_submit" class="btn" type="submit" value="<?php echo $lang['u-register-btn']; ?>" /></p>
</form>

</div>