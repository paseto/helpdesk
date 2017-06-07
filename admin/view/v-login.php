<?php
ob_start();
// prefix with dot to allow subdomains
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

<link rel="shortcut icon" href="../public/images/favicon/favicon.ico" />
<link rel="apple-touch-icon" sizes="57x57" href="../public/images/favicon/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="114x114" href="../public/images/favicon/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="72x72" href="../public/images/favicon/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="144x144" href="../public/images/favicon/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="60x60" href="../public/images/favicon/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="120x120" href="../public/images/favicon/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="76x76" href="../public/images/favicon/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="152x152" href="../public/images/favicon/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="../public/images/favicon/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="../public/images/favicon/favicon-160x160.png" sizes="160x160" />
<link rel="icon" type="image/png" href="../public/images/favicon/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="../public/images/favicon/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="../public/images/favicon/favicon-32x32.png" sizes="32x32" />
<meta name="msapplication-TileColor" content="#659900" />
<meta name="msapplication-TileImage" content="../public/images/favicon/mstile-144x144.png" />
<meta name="msapplication-config" content="../public/images/favicon/browserconfig.xml" />

<link href="../public/css/aa-admin-index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="outer">
    <div class="middle">
        <div id="aa-form-div">
        <div class="inner-padding">
        	
            <h1><?php echo get_settings('Company_Name'); ?></h1>
            <form id="form1" name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

                <span class="error"><?php read_session('aaerror-login'); ?></span>

                <label><?php echo $lang['index-username']; ?></label>
                <input  autocomplete="on" name="user" type="text" autofocus="autofocus" placeholder="<?php echo $lang['index-username']; ?>" />

                <label><?php echo $lang['index-password']; ?></label>
                <input  autocomplete="off" name="pass" type="password" placeholder="<?php echo $lang['index-password']; ?>"/>

                <label><?php echo $lang['index-langauge']; ?></label>
				<?php
            		select_langauge();
            	?>	

                <input name="aali" type="submit" value="<?php echo $lang['index-login']; ?>" /> <a href="?p=pwreset"><?php echo $lang['index-forgotpwd']; ?></a> 
        
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