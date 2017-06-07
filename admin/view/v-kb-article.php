<?php
$kbgroups = aaModelGetKBGroups();
$array_of_kbgroups = $kbgroups->fetchAll();
$no_of_kbgroups = $kbgroups->rowCount();

if($no_of_kbgroups == 0) {
	header("Location: p.php?p=kb");
}

if (isset($_GET["kbid"])) {
	
	$kba = aaModelGetArticlesByID($_GET["kbid"])->fetch();;
	
	$kb_title = $kba['KB_Title'];
	$kb_groupid = $kba['KB_Group'];
	$kb_article = $kba['KB_Article'];
	$kb_db_sticky = ($kba['KB_Sticky'] == 1) ? 'checked' : '';
	$kb_db_position = $kba['KB_Position'];
	$kb_db_hidden = ($kba['KB_Hidden'] == 1) ? 'checked' : '';
	$kb_meta = $kba['KB_Meta_Tags'];

}
?>
<div id="layout-body" class="layout-padding form">

    <h2><?php echo $lang['set-kb-title']; ?></h2>
    <hr />
	<?php
	// add a new kb article
	if (isset($_POST["kb_save"])) {
		
		aaModelSaveArticle($_POST["kb_title"], 
		$s_uid,
		$_POST['kb_group'],
		$_POST["kb_article"],
		@$_POST["kb_sticky"],
		@$_POST["kb_position"],
		@$_POST["kb_hidden"],
		@$_POST["kb_meta"],
		@$_GET["kbid"]);

	}
	?>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

    <div class="form-field">    
    <label><?php echo $lang['kb-db-article-title']; ?> *</label>
    <input type="text" id="kb_title" name="kb_title" value="<?php if (isset($kb_title)) { echo $kb_title; } ?>" placeholder="<?php echo $lang['kb-db-article-title']; ?>" />
    <span class="error"><?php if (isset($error)) { echo $lang['generic-error']; } ?></span>
	</div>
    
    <div class="form-field">    
    <label><?php echo $lang['kb-db-article-group']; ?> *</label>
    <select name="kb_group" id="kb_group">
    <?php
	foreach($array_of_kbgroups as $kb_group) {
    
    if ($kb_group["KBGROUPID"] == $kb_groupid) {
        
        echo '<option value='.$kb_group["KBGROUPID"].' selected="selected">'.decode_entities($kb_group["KB_Group"]).'</option>';
        
    } else {
        
        echo '<option value='.$kb_group["KBGROUPID"].'>'.decode_entities($kb_group["KB_Group"]).'</option>';
    
    }
    }
    ?>
    </select>
    </div>

    <div class="form-field">    
    <label><?php echo $lang['kb-db-article-sticky']; ?></label>
	<input name="kb_sticky" id="kb_sticky" type="checkbox" value="1" <?php echo $kb_db_sticky; ?>/>
	</div>
	
	<?php
	$db_kbshowx = get_settings("KB_Showx"); 
	?>
    <div class="form-field">    
    <label><?php echo $lang['kb-db-article-position']; ?></label>
	<select name="kb_position">
	<?php
	for ($i=1; $i <= $db_kbshowx; $i++) {
		if ($kb_db_position == $i) {
			echo '<option value="'.$i.'" selected>'.$i.'</option>';
		} else {
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
	}
	?>
	</select>
	</div>

    <div class="form-field">    
    <label><?php echo $lang['kb-db-article-meta']; ?></label>
    <input type="text" id="kb_meta" name="kb_meta" value="<?php if (isset($kb_meta)) { echo $kb_meta; } ?>" placeholder="<?php echo $lang['kb-db-article-meta']; ?>" />
	</div>

    <div class="form-field">    
    <label><?php echo $lang['kb-db-article-hidden']; ?></label>
	<input name="kb_hidden" id="kb_hidden" type="checkbox" value="1" <?php echo $kb_db_hidden; ?> />	
	</div>	
	
	<br />
    <textarea rows="10" id="kb_article" name="kb_article"><?php if (isset($kb_article)) { echo stripslashes($kb_article); } ?></textarea>
	    
    <p><input class="btn" type="submit" name="kb_save" value="<?php echo $lang['generic-save']; ?>"></p>
    </form>
    
</div>