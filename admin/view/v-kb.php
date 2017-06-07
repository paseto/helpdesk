<?php
if (isset($_POST['kb_edit'])) {

	$kbid = $_POST['kbid'];
	header('Location: p.php?p=kb-article&kbid='.$kbid);
	
}

// delete canned replied
if (isset($_POST["kb_delete"])) {
	
	// get hidden KBID
	aaModelDeleteKBArticle ($_POST['kbid']);
	
}

?>
<div id="layout-body" class="layout-padding form">

        <h2><?php echo $lang['kb-title']; ?></h2>
        <hr />
        <?php
		$db_kb_enable = get_settings("KB_Enable");

		$kbgroups = aaModelGetKBGroups();
		$array_of_kbgroups = $kbgroups->fetchAll();
		$no_of_kbgroups = $kbgroups->rowCount();

		if ($db_kb_enable != 1) {
			echo '<p class="error">'.$lang['kb-disabled'].'</p>';
		} else {
			echo '<p class="success">'.$lang['kb-enabled'].'</p>';	
		?> 
               
		<p>
        <?php
		if ($no_of_kbgroups > 0) {
			echo '<a href="p.php?p=kb-article">'.$lang['kb-db-aa-title'].'</a> | ';
		} else {
			echo '<p>A knowledge base group must be added before an article can be added</p>';
		}
		?>
		<a href="p.php?p=kb-group"><?php echo $lang['kb-db-ag-title']; ?></a>
        </p>
        
        <?php
		foreach ($array_of_kbgroups as $kb_group) {

			$kbarticles = aaModelGetKBArticles($kb_group["KBGROUPID"]);
			$array_of_kbarticles = $kbarticles->fetchAll();
			
			echo '<p><b>'.decode_entities($kb_group['KB_Group']).'</b></p>';
			
			foreach($array_of_kbarticles as $apg) {
			?>
			<form method="post">
			<input style="display:none; visibility:hidden" type="text" id="kbid" name="kbid" value="<?php echo $apg['KBID']; ?>" />    
			
			<?php   
			$kb_rating_total = $apg['KB_Like'] + $apg['KB_Dislike'];
			$kb_like = $apg['KB_Like'];
			    
			echo '<p>
				<button type="submit" name="kb_edit"><i class="fa fa-pencil-square-o"></i></button>
				<button type="submit" name="kb_delete"><i class="fa fa-trash-o"></i></button>
				<a href="../user/kba.php?kbid='.$apg['KBID'].'" target="_blank">'.decode_entities($apg['KB_Title']).'</a> -
				'.$lang['kb-db-article-sticky'].' <b>'.$apg['KB_Sticky'].'</b> - 
				'.$lang['kb-db-article-position'].' <b>'.$apg['KB_Position'].'</b> - 
				'.$lang['kb-db-article-hidden'].' <b>'.$apg['KB_Hidden'].'</b> -
				'.$lang['u-kba-views'].' <b>'.$apg['KB_Count'].'</b> - 
				'.$lang['u-kba-helpful'].' <b>'.$kb_like.'</b> '.$lang['u-kba-out'].' <b>'.$kb_rating_total.'</b>
				</p>';
			?>
            </form>
            <?php
			}
			?>
        
		<?php
		}

		} // end if kb enabled
		?>
</div>