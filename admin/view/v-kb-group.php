<?php
if (isset($_POST['group-del'])) {
	
aaModelDeleteKBGroup($_POST["kbgid"]);
	
}
?>
<div id="layout-body" class="layout-padding form">
            
    <h2><?php echo $lang['kb-db-ag-title']; ?></h2>
    <?php echo $lang['kb-db-ag-title-desc']; ?>
    <hr />
    <h3><?php echo $lang["set-groups-add"]; ?></h3>
    <?php
	// add new group
	if (isset($_POST["group_save"])) {
		
		aaModelSaveKBGroup($_POST["newgroup"]);
		
	}
	?>	
    <form name="addgroup" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <input type="text" name="newgroup" id="newgroup" value="" placeholder="Enter new group" autofocus="autofocus" />
    <span class="error"><?php if (isset($cat_error)) { echo $cat_error; } ?></span>
    <input class="btn" type="submit" name="group_save" id="group_save" value="<?php echo $lang["generic-save"]; ?>" />
    </form>
    <?php
	$kbgroups = aaModelGetKBGroups();
	$array_of_kbgroups = $kbgroups->fetchAll();
	$no_of_kbgroups = $kbgroups->rowCount();

    if ($no_of_kbgroups > 0) {
    ?>
    <h3><?php echo $lang["kb-db-eg"]; ?></h3>
    
    <table>
	<?php
	foreach($array_of_kbgroups as $kb_group) {
	$apg = aaModelGetArticlesByKBGroup($kb_group["KBGROUPID"]);
	$apg = $apg->fetch();
    ?>
    <form name="group" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <?php
    // if only one group left don't show delete option
    
    if ($apg['tcount'] > 0) {
    $disabled = 'disabled';
    $disabled_title = $lang['generic-delete-warn-article'];
    } else {
    $disabled = '';
    $disabled_title = $lang['generic-delete-warn-article'];
    }
    
    ?>
    <tr>
    <td width="100%">
    <?php

    echo decode_entities($kb_group["KB_Group"])." <strong title=\"Articles per group\">[".$apg['tcount']."]</strong>"; 
   
    ?>
    </td>
    <td>
    <input name="kbgid" id="kbgid" value="<?php echo $kb_group["KBGROUPID"]; ?>" hidden style="display:none; visibility:hidden; ">    
    <button class="btn" type="submit" name="group-del" <?php echo $disabled; ?> title="<?php echo $disabled_title; ?>"><i class="fa fa-trash-o"></i></button>
    </td>    
    </form>
    <?php				
    
    }
	?>
    </table>
    <?php
    }
    ?>
            
</div>