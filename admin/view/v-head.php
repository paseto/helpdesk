<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<audio id="alertAudio">
<source src="../chat/dingdong.ogg" type="audio/ogg">
<source src="../chat/dingdong.mp3" type="audio/mpeg">
</audio>

<audio id="chatAudio">
<source src="../chat/ting.ogg" type="audio/ogg">
<source src="../chat/ting.mp3" type="audio/mpeg">
</audio>

<link href='../public/css/aa-admin.css' rel='stylesheet' type='text/css'>
<link href='../public/css/custom/<?php echo $_SESSION['a']['aastyle'].'.css'; ?>' rel='stylesheet' type='text/css'>
<!-- font awesome -->
<link href="../public/css/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet">
<!-- jquery -->
<script src="../public/js/jquery-2.1.3.min.js"></script>
<!-- jquery UI  -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<!-- select2 -->
<script src="../public/js/select2-master/select2.js"></script>
<link href="../public/js/select2-master/select2.css" rel="stylesheet" type="text/css">
<!-- tinymce -->
<script src="../public/js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src=".../public/js/tinymce/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>
<!-- Google graph API used for dashboard and reporting 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 -->
<!-- custom jquery functions -->
<script src="../public/js/aa-tinymce.js"></script>
<script src="../public/js/aa-global.js"></script>
<script src="../public/js/aa-admin.js"></script>
<?php
// inlcude javascript for each page
if (file_exists('js/j-'.$_GET['p'].'.js')) {	
	echo '<script src="js/j-'.$_GET['p'].'.js"></script>';
}
?>
<?php
// if live chat enabled then add js file
if ($aachat_on == 1) {
	echo '<script src="js/j-chat-boot.js"></script>';
}
?>
</head>
<body>
