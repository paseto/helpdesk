<?php

// get groups
$groups = aaModelGetGroups();
$array_of_groups = $groups->fetchAll();
$no_of_groups = $groups->rowCount();

// get priorities
$priorities = aaModelGetPriorities();
$array_of_priorities = $priorities->fetchAll();
$no_of_priorities = $priorities->rowCount();

if (isset($_GET['imail_edit'])) {
	
	$imailid = $_GET['imail_id'];
	
	$imail_account = aaModelGetIEmailAccount($imailid);
	$imail_edit = $imail_account->fetch();

	$imail_imid = $imailid;
	$imail_email = $imail_edit['Email_Addr'];
	$imail_host = $imail_edit['Email_Host'];
	$imail_port = $imail_edit['Port_No'];
	$imail_prot = $imail_edit['Protocol'];
	$imail_ssl = $imail_edit['Email_SSL'];
	$imail_cert = $imail_edit['Val_Cert'];
	$imail_tls = $imail_edit['Email_TLS'];
	$imail_folder = $imail_edit['Email_Folder'];
	$imail_user = $imail_edit['Email_User'];
	$imail_pass = $imail_edit['Email_Pass'];
	$imail_group = $imail_edit['Email_Group'];
	$imail_priority = $imail_edit['Priority'];

}

if (isset($_POST['imail_save'])) {

aaModelSaveIEmail($_POST['imail_email'],
					$_POST['imail_host'],
					$_POST['imail_port'],
					$_POST['imail_prot'],
					$_POST['imail_ssl'],
					$_POST['imail_cert'],
					$_POST['imail_tls'],
					$_POST['imail_folder'],
					$_POST['imail_user'],
					$_POST['imail_pass'],
					$_POST['imail_group'],
					$_POST['imail_priority'],
					$_POST["IM_ID"]);	
}


?>
<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>
    	
    <a id="imailform"></a>    
    <h2><?php echo $lang['set-iemail-add-title']; ?></h2>
	<hr />
    
    <form name="imail" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <input style="display:none; visibility:hidden" type="text" id="IM_ID" name="IM_ID" value="<?php cached_fields (@$_POST["IM_ID"], @$imail_imid); ?>" />   
    
    <div class="form-field">  
	<label><?php echo $lang["set-iemail-db-ea"]; ?> *</label>
    <input type="text" name="imail_email" id="imail_email" value="<?php cached_fields (@$_POST["imail_email"], @$imail_email); ?>" />
    <p class="error"><?php echo read_session('imail_email'); ?></p>
    </div>

    <div class="form-field">  
	<label><?php echo $lang["set-iemail-db-ho"]; ?> *</label>
    <input type="text" name="imail_host" id="imail_host" value="<?php cached_fields (@$_POST["imail_host"], @$imail_host); ?>" />
    <p class="error"><?php echo read_session('imail_host'); ?></p>
	</div>
    
    <div class="form-field">     
   	<label><?php echo $lang["set-iemail-db-pn"]; ?> *</label>
    <input type="text" name="imail_port" id="imail_port" value="<?php cached_fields (@$_POST["imail_port"], @$imail_port); ?>" />
    <p class="error"><?php echo read_session('imail_port'); ?></p>
    </div>
    
    <div class="form-field">      
    <?php
	$protocol = array('imap', 'imap2', 'imap2bis', 'imap4', 'imap4rev1', 'pop', 'nntp');	
	?>    
    <label><?php echo $lang["set-iemail-db-pr"]; ?></label>
    <select name="imail_prot" id="imail_prot">
    <?php
	foreach ($protocol as $protocol_opt) {
		if($protocol_opt == $imail_prot) {
			echo '<option value="'.$protocol_opt.'" selected="selected">'.strtoupper($protocol_opt).'</option>';
		} else {
			echo '<option value="'.$protocol_opt.'">'.strtoupper($protocol_opt).'</option>';
		}
	}
	?>
	</select>
    </div>
    
    <div class="form-field">
	<label><?php echo $lang["set-iemail-db-ssl"]; ?></label>          
    <input name="imail_ssl" type="checkbox" value="1" <?php echo form_checkbox(@$imail_ssl); ?> />
    </div>
    
    <div class="form-field">
	<label><?php echo $lang["set-iemail-db-tls"]; ?></label>     
    <input name="imail_tls" type="checkbox" value="1" <?php echo form_checkbox(@$imail_tls); ?> />
    </div>

    <div class="form-field">    
    <?php
	$valcertarray = array('N/A' => "" , '/validate-cert' => '/validate-cert', '/novalidate-cert' => '/novalidate-cert');
	?>    
	<label><?php echo $lang["set-iemail-db-vc"]; ?></label>
    <select name="imail_cert" id="imail_cert">
    <?php
	foreach ($valcertarray as $valcertopt => $valcertkey) {
		if($valcertopt == $imail_cert) {
			echo '<option value="'.$valcertkey.'" selected="selected">'.$valcertopt.'</option>';
		} else {
			echo '<option value="'.$valcertkey.'">'.$valcertopt.'</option>';
		}
	}
	?>
	</select>
    </div>
    
    <div class="form-field">   
    <label><?php echo $lang["set-iemail-db-af"]; ?> *</label>
    <input type="text" name="imail_folder" id="imail_folder" value="<?php cached_fields (@$_POST["imail_folder"], @$imail_folder); ?>" />
    <p class="error"><?php echo read_session('imail_folder'); ?></p>    
	</div>
    
    <div class="form-field">        
    <label><?php echo $lang["set-iemail-db-au"]; ?> *</label>
    <input type="text" name="imail_user" id="imail_user" value="<?php cached_fields (@$_POST["imail_user"], @$imail_user); ?>" />
    <p class="error"><?php echo read_session('imail_user'); ?></p>        
    </div>
    
    <div class="form-field">   
    <label><?php echo $lang["set-iemail-db-ap"]; ?> *</label>
    <input type="password" name="imail_pass" id="imail_pass" value="<?php cached_fields (@$_POST["imail_pass"], @$imail_pass); ?>" />
    <p class="error"><?php echo read_session('imail_pass'); ?></p>        
    </div>
    
    <div class="form-field">    
    <label><?php echo $lang["set-iemail-db-tg"]; ?></label>
    <select name="imail_group" id="imail_group">
    <?php
	foreach ($array_of_groups as $group) {
		if ($group['Cat_ID'] == $imail_group) {
    		echo '<option value="'.$group['Cat_ID'].'" selected="selected">'.decode_entities($group['Category']).'</option>';
		} else {
    		echo '<option value="'.$group['Cat_ID'].'">'.decode_entities($group['Category']).'</option>';
		}
	}
	?>
	</select>	
    </div>
    
    <div class="form-field">   
    <label><?php echo $lang["set-iemail-db-tp"]; ?></label>	
    <select name="imail_priority" id="imail_priority">
    <?php
	foreach ($array_of_priorities as $priority) {
		if ($priority['Level_ID'] == $imail_priority) {
	    	echo '<option value="'.$priority['Level_ID'].'" selected="selected">'.decode_entities($priority['Level']).'</option>';
		} else {
	    	echo '<option value="'.$priority['Level_ID'].'">'.decode_entities($priority['Level']).'</option>';
		}
	}
	?>
    </select>
	</div>
    
    <p><input class="btn" type="submit" name="imail_save" id="imail_save" value="<?php echo $lang['generic-save']; ?>" /></p>

    </form>
    
</div>