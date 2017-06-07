<?php
// delete canned replied
if (isset($_POST["can_delete"])) {

	aaModelDeleteCanned ($_POST["e_can_id"]);
	
}
?>
<div id="layout-body" class="layout-padding form">
    
	<?php include 'v-settings-menu.php'; ?>    
    
    <h2><?php echo $lang['set-canned-title']; ?></h2>
    <?php echo $lang['set-canned-title-desc']; ?>
    <hr />
	<?php
    if (isset($_POST["can_save"])) {
        
        aaModelSaveCanned ($_POST["can_id"], $_POST["can_title"], $_POST["can_text"]);
    
    
    }
    ?>	
    <form name="canform" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <input style="display:none; visibility:hidden" type="text" id="can_id" name="can_id" />
    
    <div class="form-field">
    <input type="text" id="can_title" name="can_title" placeholder="<?php echo $lang['set-canned-db-ct']; ?>" />
	</div>
    
    <textarea rows="10" id="can_text" name="can_text"><?php if (isset($can_text)) { echo $_POST["can_text"]; } ?></textarea>
    
    <p><input class="btn" type="submit" name="can_save" value="<?php echo $lang['generic-save']; ?>"></p>
    </form>
    
    <br />
          
    <?php		
    $canned = aaModelGetCanned();
    $array_of_canned = $canned->fetchAll();
    $no_of_canned = $canned->rowCount();
    
    if ($no_of_canned > 0) {
    ?>

    <h3><?php echo $lang["set-canned-db-ec"]; ?></h3>
    <table>
	<thead>
    <tr>
    <td>Canned Message</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($array_of_canned as $can) {
    ?>
    <tr>
    <form method="post">    
    <input style="display:none; visibility:hidden" type="text" id="e_can_id" name="e_can_id" value="<?php echo $can["CANID"]; ?>" />    
    <td width="100%">
    <?php
    echo decode_entities($can["Can_Title"]);
    ?>
    </td>
    
    <td><button class="btn can_edit" canid="<?php echo $can["CANID"]; ?>" cantitle="<?php echo $can["Can_Title"]; ?>" canmsg="<?php echo $can["Can_Message"]; ?>" type="submit" name="can_edit" title="<?php echo $lang['generic-edit']; ?>"><i class="fa fa-pencil-square-o"></i></button></td>
    <td><button class="btn" type="submit" id="can_delete" name="can_delete" title="<?php echo $lang['generic-delete']; ?>"><i class="fa fa-trash-o"></i></button></td>
    </form>    
    </tr>
    <?php
    }
    ?>
    </tbody>    
    </table>
    <?php
    }
    ?>
        
</div>