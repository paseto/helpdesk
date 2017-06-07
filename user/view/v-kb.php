<?php
$db_kb_enable = get_settings('KB_Enable');

if ($db_kb_enable == 1) {
	
$db_kb_showx = get_settings('KB_Showx');	

// group count
$count=1;

$kbgroups = aaModelGetKBGroups();
$array_of_kbgroups = $kbgroups->fetchAll();
$no_of_kbgroups = $kbgroups->rowCount();

if ($no_of_kbgroups == 0) {
	echo '<div class="margin-body">';
	echo $lang['u-kb-nakb'];
	echo '</div>';
} else {
?>        
<?php
include 'v-kbs-bar.php';
?>

<div class="margin-body">
	<div class="kb_cont">
	<h2><?php echo $lang['u-kb-kb']; ?></h2>
	
		<?php

	
		foreach ($array_of_kbgroups as $kb_group) {
			
			if ($count != '1') {
				echo '<br></div>';
			}
			// width of kb group if odd or even number of kb groups
			if ($no_of_kbgroups == $count) {
				if ($count % 2 == 0) {
				$kbw = "kbeven";			
				} else {
				$kbw = "kbodd";
				}
			} else {
				$kbw = "kbeven";			
			}
			$count++;
			
			$sel_article_per_group = aaModelGetKBArticles ($kb_group["KBGROUPID"]);
			$array_of_kbarticles = $sel_article_per_group->fetchAll();
			$count_articles_per_group = $sel_article_per_group->rowCount();
			
			echo '<div class="kb '.$kbw.'"><i class="fa fa-folder-o"></i> <a style="color:inherit" href="index.php?p=kbg&kbgid='.$kb_group['KBGROUPID'].'">'.decode_entities($kb_group['KB_Group']).' ('.$count_articles_per_group.')</a><hr>';
			
			// article count
			$acount=1;
			
			foreach($array_of_kbarticles as $apg) {
				
				// use drawing pin if sticky or document icon if not
				$sticky = ($apg['KB_Sticky'] == 1) ? '<i class="fa fa-thumb-tack" aria-hidden="true"></i>' : '<i class="fa fa-file-o"></i>';

				
			?>
			<form method="post">
			<input style="display:none; visibility:hidden" type="text" id="kbid" name="kbid" value="<?php echo $apg['KBID']; ?>" />    
			
			<?php 
			if ($acount <= $db_kb_showx) {       
			echo '<p>'.$sticky.' <a href="kba.php?kbid='.$apg['KBID'].'">'.decode_entities($apg['KB_Title']).'</a>
				</p>';
				$acount++;
			} else {
				echo '<p><i class="fa fa-plus"></i> <a href="index.php?p=kbg&kbgid='.$kb_group['KBGROUPID'].'">'.$lang['u-kb-more'].'</a></p>';
				break;
			}
			?>
			</form>
			<?php
			}
			?>
		
		<?php
		}
		?>
	</div>   
</div>

<br />
<div id="kb-new-top-clear">
    <div class="kb-new-top">
    <h3><?php echo $lang['u-kb-top-articles']; ?></h3>
    <?php
	$kbtop = aaModelGetKBAToprticles ($db_kb_showx);
	$array_of_kbtop = $kbtop->fetchAll();

    foreach ($array_of_kbtop as $kbc) {
        echo '<p>
            <i class="fa fa-file-o"></i> <a href="kba.php?kbid='.$kbc['KBID'].'">'.decode_entities($kbc['KB_Title']).'</a>
            </p>';
    
    }
    ?>
    </div>
    <div class="kb-new-top">
    <h3><?php echo $lang['u-kb-late-articles']; ?></h3>
    <?php
	
	$kbnew = aaModelGetKBNewestArticles ($db_kb_showx);
	$array_of_kbnew = $kbnew->fetchAll();

    foreach($array_of_kbnew as $kbd) {
        echo '<p>
            <i class="fa fa-file-o"></i> <a href="kba.php?kbid='.$kbd['KBID'].'">'.decode_entities($kbd['KB_Title']).'</a>
            </p>';
    
    }
    ?>
    </div>   
</div>
</div> <!--end last kb div -->
  
<?php
}
} else {
	
	// redirect to ticket add if kb is not enabled
	header('Location: index.php?p=ticket-add');
	
}
?>