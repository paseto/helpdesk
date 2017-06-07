<?php
$iemail = aaModelGetIEmail();
$iemail_accounts = $iemail->fetchAll();
$iemail_total = $iemail->rowCount();

// test account
if(isset($_POST['imail_test'])) {

	// test account connection and set variable to read
	$imail_test_result[$_POST['IMID']] = aaModelEmailConnect ($_POST['IMID']);
	
}

if(isset($_POST['imail_edit'])) {
	
	// redirect to editting form
	header ('Location: p.php?p=settings-iemail-form&imail_edit&imail_id='.$_POST['IMID']);
	exit;
	
}

if(isset($_POST['imail_delete'])) {

	// delete email account	
	aaModelDeleteIEmailAccount($_POST['IMID']);
	
}

if(isset($_POST['imail_disable'])) {
	
	// disable email account
	aaModelDisableIEmailAccount($_POST['IMID']);

}

// set manaul email retrieval
if(isset($_POST['imail_manual_on'])) {
	
	// set manual email retrieval
	aaModelSetManualImail ($_POST['imail_man_get']);
	
}

?>
<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>
    
    <h2><?php echo $lang["set-iemail-title"]; ?></h2>
    
    <span style="float:right"><a href="p.php?p=settings-iemail-form"><i class="fa fa-plus-square-o"></i> <?php echo $lang['set-iemail-add-acc']; ?></a></span></p>
    <p><?php echo $lang["set-iemail-title-desc"]; ?></p>
	<hr />
    <?php
	if ($iemail_total > 0) {

	$imail_manual_db = get_settings('Imail_Manual');
	$imail_checked = ($imail_manual_db == 1) ? 'checked="checked"' : '';
	
	?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="form-field">
	<label for="imail_man_get"><?php echo $lang['set-iemail-manual']; ?></label>    
    <input name="imail_man_get" type="checkbox" value="1" <?php echo $imail_checked; ?> />
    </div>
    <p class="text-xsmall"><?php echo $lang['set-iemail-manual-warn']; ?></p>
    <p><input class="btn" name="imail_manual_on" type="submit" value="<?php echo $lang['generic-save']; ?>" /></p>
    </form>

    <h3><?php echo $lang['set-iemail-exist-title']; ?></h3>
        
        <table width="100%">
        <colgroup>
        <col />
        <col />
        <col />
        <col />
        </colgroup>
        <thead>
        <tr>
        <td><?php echo $lang["set-iemail-db-ea"]; ?></td>
        <td><?php echo $lang["set-iemail-db-tg"]; ?></td>
        <td><?php echo $lang["set-iemail-db-tp"]; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>  
		<td>&nbsp;</td>              
        </tr>
        </thead>
        <tbody>
        <?php
		foreach($iemail_accounts as $imail) {
		?>
        <a name="<?php echo $imail['IMAILID']; ?>"></a>        
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI'].'#'.$imail['IMAILID']; ?>">
        <input style="display:none; visibility:hidden" type="text" id="IMSTATUS" name="IMSTATUS" value="<?php echo $imail["Disabled"]; ?>" />           
        <input style="display:none; visibility:hidden" type="text" id="IMID" name="IMID" value="<?php echo $imail["IMAILID"]; ?>" />   
        <tr class="nohover">
        <td data-title="<?php echo $lang["set-iemail-db-ea"]; ?>"><?php echo $imail['Email_Addr']; ?></td>
        <td data-title="<?php echo $lang["set-iemail-db-tg"]; ?>"><?php echo decode_entities($imail['Category']);?></td>
        <td data-title="<?php echo $lang["set-iemail-db-tp"]; ?>"><?php echo decode_entities($imail['Level']); ?></td>
        <td date-title="Test">
        <button type="submit" id="imail_test" name="imail_test" title="<?php echo $lang['set-iemail-exist-test']; ?>"><i class="fa fa-flask"></i></button>
        </td>
        <td class="nohover" data-title="Status">
        <?php
		if ($imail['Disabled'] == 0) {
		?>
        <button type="submit" id="imail_disable" name="imail_disable" title="<?php echo $lang["generic-disable"]; ?>"><i class="fa fa-lock"></i></button>
        <?php
		} else {
		?>
        <button type="submit" id="imail_disable" name="imail_disable" title="<?php echo $lang["generic-enable"]; ?>"><i class="fa fa-unlock-alt"></i></button>
        <?php
		}
		?>
        </td>        
        <td data-title="Edit"><button type="submit" id="imail_edit" name="imail_edit" title="<?php echo $lang["generic-edit"]; ?>"><i class="fa fa-pencil-square-o"></i></button></td>
        <td data-title="Delete"><button type="submit" id="imail_delete" name="imail_delete" title="<?php echo $lang["generic-delete"]; ?>"><i class="fa fa-trash-o"></i></button></td>
		<?php
		// show test results for account test
		if (@$imail_test_result[$imail['IMAILID']] == 'success') {
			
			echo '<tr class="nohover"><td data-title="Status" colspan="7">
				  <span class="success">'.$lang['set-iemail-exist-act'].'</span>
				  </td></tr>';	
					
		} else if  (@$imail_test_result[$imail['IMAILID']] == 'failed') {
			
			echo '<tr class="nohover"><td data-title="Status" colspan="7">
				  <span class="error">'.$lang['set-iemail-exist-dec'].'</span>
				  </td></tr>';
		}
		?>
        <tr class="nohover">
        <td data-title="Status" colspan="7">
        <?php
		if ($imail['Disabled'] == 1) {
			echo '<span class="error">'.$lang['set-iemail-exist-dis'].'</span>';
		} else {
			echo '<span class="success">'.$lang['set-iemail-exist-en'].'</span>';
		}
		?>
        </td></tr>
        <tr class="nohover"><td data-title="Details" colspan="7" class="detail">
        <?php echo $lang["set-iemail-db-ho"]; ?>: <?php echo $imail['Email_Host']; ?><br />
        <?php echo $lang["set-iemail-db-pn"]; ?>: <?php echo $imail['Port_No']; ?><br />
        <?php echo $lang["set-iemail-db-pr"]; ?>: <?php echo $imail['Protocol']; ?><br />
        <?php echo $lang["set-iemail-db-ssl"]; ?>: <?php checkbox_icon($imail['Email_SSL']); ?><br />
        <?php echo $lang["set-iemail-db-vc"]; ?>: <?php if($imail['Val_Cert'] == "") { echo "N/A"; } else { echo $imail['Val_Cert']; } ?><br />
        <?php echo $lang["set-iemail-db-tls"]; ?>: <?php checkbox_icon($imail['Email_TLS']); ?><br />
        <?php echo $lang["set-iemail-db-af"]; ?>: <?php echo $imail['Email_Folder']; ?><br />        
        <?php echo $lang["set-iemail-db-au"]; ?>: <?php echo $imail['Email_User']; ?><br />
        </td></tr>
        </tr>
        </form>
        <?php	
        }
        ?>
        </tbody>
        </table>
    
	<?php
	} else {
	?>
    <p class="error"><?php echo $lang['set-iemail-db-na']; ?></p>
    <?php
	}
	?>
    
</div>