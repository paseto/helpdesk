<?php
if (!isset($_GET['kbgid'])) {
	header('Location: index.php');
}

$kba = aaModelGetKBbyGroup($_GET["kbgid"]);
$array_of_kba = $kba->fetchAll();
include 'v-kbs-bar.php';
?>

<div class="margin-body">
 
    <h2><?php echo $lang['u-kb-kb']; ?></h2>
    
    <?php
    echo '<i class="fa fa-folder-o"></i> '.$array_of_kba[0]['KB_Group'];
    ?>
    <hr />
    <?php
	foreach($array_of_kba as $kba) {
        
        $kb_rating_total = $kba['KB_Like'] + $kba['KB_Dislike'];
        $kb_like = $kba['KB_Like'];
		// use drawing pin if sticky or document icon if not
		$sticky = ($kba['KB_Sticky'] == 1) ? '<i class="fa fa-thumb-tack" aria-hidden="true"></i>' : '<i class="fa fa-file-o"></i>';
        
        echo '<p>
            '.$sticky.' <a href="kba.php?kbid='.$kba['KBID'].'">'.$kba['KB_Title'].'</a>
            </p>
            <p class="small">'.$lang['u-kba-views'].': <b>'.$kba['KB_Count'].'</b> '.$lang['u-kba-helpful'].' <b>'.$kb_like.'</b> '.$lang['u-kba-out'].' <b>'.$kb_rating_total.'</b> '.$lang['u-kba-dateadd'].': '.$kba['KB_Date_Added'].'</p>';
    }
    ?>
</div>