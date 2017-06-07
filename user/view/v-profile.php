<?php
	if ($db_user_reg  == 1) {
		if (!isset($_SESSION['u']['aauid']) || ($_SESSION['u']['aaurole'] != 0)) {
			header ("Location: index.php?p=user-access");
		}
	}
?>
<div class="margin-body form">
<h2><?php echo $lang['u-profile']; ?></h2>
<hr />
<?php
$email = $_SESSION['u']['aaemail'];

$user = aaModelGetAgent($email);
$user = $user->fetch();

if (isset($_POST["uchg_submit"])) {
	
	aaModelEditAgent ($user['UID'], $_POST['ureg_fname'], $user['Email'], $_POST['ureg_tele'], $user['Role']);
	
}
?>
<form name"ureg" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
<div class="form-field">
<label for="ureg_fane"><?php echo $lang['u-register-name']; ?> *</label>
<input name="ureg_fname" type="text" autocomplete="off" value="<?php cached_fields (@$_POST['ureg_fname'], $user['Fname']); ?>" />
</div>

<div class="form-field">
<label for="ureg_email"><?php echo $lang['u-register-email']; ?></label>
<input name="ureg_email" readonly type="text" autocomplete="off" value="<?php cached_fields (@$_POST['ureg_email'], $user['Email']); ?>" />
</div>

<div class="form-field">
<label for="ureg_tele"><?php echo $lang['u-register-tele']; ?></label>
<input name="ureg_tele" type="text" autocomplete="off" value="<?php cached_fields (@$_POST['ureg_tele'],  $user['TeleNo']); ?>" />
</div>

<div class="form-field">
<label><?php echo $lang['index-password']; ?></label>
******** <a href="#" class="open_popup" popup="chgpw"><?php echo $lang['generic-change']; ?></a>
</div>

<p><input name="uchg_submit" class="btn" type="submit" value="<?php echo $lang['generic-change']; ?>" /></p>
</form>

</div>

<div class="overlay"></div>
<div class="popup layout-padding form" id="chgpw">
    <h3><?php echo $lang['profile-chg-pwd']; ?></h3>

    <form method="post" id="profile_pw_change">
    <input style="display:none;" name="user_id" id="user_id" value="<?php echo $user["UID"]; ?>" />
    <?php echo $lang['profile-chg-pwd-desc']; ?>
    <hr />
    <div id="pwd_result"></div>
    <div class="form-field">
    <label><?php echo $lang['profile-chg-pwd-new']; ?></label>
    <input autocomplete="off" name="newpwd" id="newpwd" type="password" placeholder="<?php echo $lang['profile-chg-pwd-new']; ?>" autofocus />
    </div>
    
    <div class="form-field">    
    <label><?php echo $lang['profile-chg-pwd-confirm']; ?></label>
    <input autocomplete="off" name="confirmpwd" id="confirmpwd" type="password" placeholder="<?php echo $lang['profile-chg-pwd-confirm']; ?>" />     
    </div>
    
    <p><input class="btn" id="chgpwd" name="chgpwd" type="submit" value="<?php echo $lang['generic-change']; ?>"></p>
    </form>      
</div>