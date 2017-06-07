<?php
ob_start();
session_start();

// include core library functions
require_once "../lib/db.php";
require_once "../lib/global.php";
require_once "model/m-kba.php";
$pdo_conn = pdo_conn();

// select language file from log in
if (!isset($_SESSION['aa-user-lang'])) {
	$langfile = get_settings("Langauge").'.php';
} else {
	$langfile = $_SESSION['aa-user-lang'].'.php';
}

// include selected langauge file
include '../public/language/'.$langfile;

$db_user_reg = get_settings("Enable_User_Reg");
$db_guest_access = get_settings("Enable_Guest_Access");


$q = aaModelGetKBArticle ($_GET['kbid']);
$kba = $q->fetch();
$kba_count = $q->rowCount();

$meta_title = get_settings('Company_Name').' - '.$kba['KB_Title'];
$meta_desc = decode_entities(preg_replace("/(&lt;).*?(&gt;)/", "", $kba['KB_Article']));
$meta_tags = decode_entities($kba['KB_Meta_Tags']);
$meta_url = urlencode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

// redirect if not real kb id
if ($kba_count < 1) {

	header('Location: index.php');
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" itemscope itemtype="http://schema.org/Article">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $meta_title; ?></title>
<link rel="canonical" href="<?php echo $meta_url; ?>" />
<meta name="description" content="<?php echo substr($meta_desc ,0,155); ?>">
<meta name="keywords" content="<?php echo $meta_tags; ?>">

<meta property="og:title" content="<?php echo $meta_title; ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo $meta_url; ?>"/>
<meta property="og:description" content="<?php echo substr($meta_desc ,0,200); ?>"/>

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="<?php echo $meta_url; ?>">
<meta name="twitter:title" content="<?php echo $meta_title; ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

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

<link href='../public/css/aa-user.css' rel='stylesheet' type='text/css'>
<!-- font awesome -->
<link href="../public/css/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet">
<!-- jquery -->
<script src="../public/js/jquery-2.1.3.min.js"></script>
<!-- jquery UI -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<!-- select2 -->
<script src="../public/js/select2-master/select2.js"></script>
<link href="../public/js/select2-master/select2.css" rel="stylesheet" type="text/css">
<!-- tinymce -->
<script src="../public/js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="../public/js/tinymce/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>
<!-- custom jquery functions -->
<script src="../public/js/aa-tinymce.js"></script>
<script src="../public/js/aa-global.js"></script>

</head>
<body>

<?php include "view/v-header.php"; ?>

<?php
// Action on like button
if (isset($_GET['like'])) {
	
	aaModelLikeKBArticle ($_GET["kbid"]);
	
}

// Action on dislike button
if (isset($_GET['dislike'])) {

	aaModelDislikeKBArticle ($_GET["kbid"]);
	
}
?>    
<?php
include 'view/v-kbs-bar.php';
?>
<div class="margin-body">
	<p class="small"><?php echo '<a href="index.php">'.$lang['u-kb-kb'].'</a> > 
								<a href="index.php?p=kbg&kbgid='.$kba['KBGROUPID'].'">'.decode_entities($kba['KB_Group']).'</a> > 
								'.decode_entities($kba['KB_Title']); ?></p>
    <h2 itemprop="name"><?php echo decode_entities($kba["KB_Title"]); ?></h2>
    <?php
	// show kb author if enabled
	$kb_author = get_settings('KB_Author_Allow');
	if ($kb_author == 1) {
		echo '<span class="small">'.$lang['u-kba-author'].': '.decode_entities($kba['Fname']).'</span> - ';
	}
	
	echo '<span class="small">'.$lang['u-kba-dateadd'].': '.$kba['KB_Date_Added'].'</span>';
	?>
	<hr />
    
        <?php
		echo '<span itemprop="description">'.html_entity_decode(stripslashes($kba['KB_Article'])).'</span>';
		?>
        <hr />
        	<div class="small">
            <?php
            // show kb count if enabled
            $kb_count = get_settings('KB_Count');
            if ($kb_count == 1) {
                
                echo '<p><b>'.$lang['u-kba-views'].'</b>: '.$kba['KB_Count'].'</p>';
                
                // if new visitor then add hit
				aaModelUpdateKBCount($_GET["kbid"]);
				                
            }
            ?>
            <?php
			// show kb rating if enabled
            $kb_rating = get_settings('KB_Rating');
            if ($kb_rating == 1) {
            ?>
            <p><b><?php echo $lang['u-kba-helpful']; ?> </b>
            <a class="u-kb-rate" href="<?php echo $_SERVER['REQUEST_URI'];?>&like=1"><i class="fa fa-thumbs-o-up"></i></a>
            <a class="u-kb-rate" href="<?php echo $_SERVER['REQUEST_URI'];?>&dislike=1"><i class="fa fa-thumbs-o-down"></i></a>
            </p>
            <?php
			$kb_rating_total = $kba['KB_Like'] + $kba['KB_Dislike'];
			$kb_like = $kba['KB_Like'];
			?>
            <p><?php echo $kb_like.' '.$lang['u-kba-out'].' '.$kb_rating_total.' '.$lang['u-kba-found']; ?></p>
            <?php
            }
			
            ?>
            </p>
            <?php
			// show kb share buttons if enabled
            $kb_share = get_settings('KB_Share');
            if ($kb_share == 1) {
			
			?>
			<a class="u-kb-share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $meta_url; ?>"><i id="fb" class="fa fa-facebook-official fa-3x" aria-hidden="true"></i></a>
			<a class="u-kb-share" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($meta_title); ?>&url=<?php echo $meta_url; ?>"><i id="twitter" class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
			<a class="u-kb-share" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $meta_url; ?>&title=<?php echo urlencode($meta_title); ?>"><i id="linkin" class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></a>
			<a class="u-kb-share" target="_blank" href="https://plus.google.com/share?url=<?php echo $meta_url; ?>"><i id="googleplus" class="fa fa-google-plus-square fa-3x" aria-hidden="true"></i></a>
			

			<?php
			}
			?>
            </div>
</div>
<?php

include "view/v-footer.php"; 

?>