<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Acorn Aid Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="mobile-web-app-capable" content="yes">

<link rel="shortcut icon" href="../img/favicon/favicon.ico" />
<link rel="apple-touch-icon" sizes="57x57" href="../img/favicon/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="114x114" href="../img/favicon/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="72x72" href="../img/favicon/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="144x144" href="../img/favicon/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="60x60" href="../img/favicon/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="120x120" href="../img/favicon/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="76x76" href="../img/favicon/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="152x152" href="../img/favicon/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="../img/favicon/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="../img/favicon/favicon-160x160.png" sizes="160x160" />
<link rel="icon" type="image/png" href="../img/favicon/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="../img/favicon/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="../img/favicon/favicon-32x32.png" sizes="32x32" />
<meta name="msapplication-TileColor" content="#659900" />
<meta name="msapplication-TileImage" content="../img/favicon/mstile-144x144.png" />
<meta name="msapplication-config" content="../img/favicon/browserconfig.xml" />

<link href="../public/css/aa-admin-index.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="outer">
    <div class="middle">
        <div id="aa-form-div">
        <div class="inner-padding">
        	
            <h1><?php echo get_settings('Company_Name'); ?></h1>
            <form id="form1" name="form1" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
			<p><?php echo $lang['pwreset-title']; ?></p>
				<?php

				if (isset($_POST["uforgotpwd_submit"])) {
					
					aaForgottenPwd ($_POST["uforgotpwd_email"]);

				}

				?>

            <label><?php echo $lang['u-register-email']; ?></label></td>
            <input autocomplete="off" name="uforgotpwd_email" type="text" autofocus="autofocus" value="<?php cached_fields (@$_POST['uforgotpwd_email']); ?>"/>

            <input name="uforgotpwd_submit" type="submit" value="<?php echo $lang['generic-save']; ?>" /> <a href="index.php"><?php echo $lang['index-login']; ?></a>
                      
            </form>
            
        </div>
        </div>
        
    </div>
</div>
</body>
</html>
<?php
ob_end_flush();
?>