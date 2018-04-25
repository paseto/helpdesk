<div id="layout-body" class="layout-padding form">
  <?php include "v-settings-menu.php"; ?>  

    <h2><?php echo $lang['set-user-edit-title']; ?></h2>
 	<hr />
    <?php
	if (isset($_POST["save_user"])) {
		aaModelEditAgent ($_POST["uid"],
						$_POST["fname"],
						$_POST["email"],
						preg_replace("/[^0-9]/", "",$_POST["cnpj"]),
						$_POST["telno"],
						$_POST["user-add-role"],
						$_POST["signature"],
						@$_POST['notify_tn'],
						@$_POST['notify_tu'],
						@$_POST['notify_pm'],
						@$_POST["inskill"]);
	}	

	if (isset($_POST["resetpwd"])) {
		aaModelResetPassword ($_POST['uid'], $_POST['pwd'], $_POST["email"]);
	}
	
	$uid = $_GET["uid"];

	$user = aaModelGetAgentByID($uid);
	$user = $user->fetch();
	$groups = aaModelGetGroups();
	$groups = $groups->fetchAll();
	?>       
    <form id="user" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <input name="uid" type="hidden" value="<?php echo $user["UID"] ?>" />

    <div class="form-field">        
    <label for="fname"><?php echo $lang['set-user-db-fn']; ?></label>
    <input name="fname" type="text" value="<?php if (isset($_POST["fname"])) { echo $_POST["fname"]; } else {  echo $user["Fname"]; } ?>"/>
    <?php echo @$form_error['u_fname']; ?>
    </div>
    
    <div class="form-field">                
    <label for="email"><?php echo $lang['set-user-db-ea']; ?></label>
    <input readonly="readonly" name="email" type="text" value="<?php if (isset($_POST["email"])) { echo $_POST["email"]; } else {  echo $user["Email"]; } ?>"/>
    <?php echo @$form_error['u_email']; ?>
    </div>

    <div class="form-field">                
    <label for="telno"><?php echo $lang['set-user-db-tn']; ?></label>
    <input name="telno" type="text" value="<?php if (isset($_POST["telno"])) { echo $_POST["telno"]; } else {  echo $user["TeleNo"]; } ?>"/>
    <?php echo @$form_error['u_telno']; ?>
    </div>

<!--    <div class="form-field">                
    <label for="cnpj">CNPJ</label>
    <input name="cnpj" type="text" value="<?php if (isset($_POST["cnpj"])) { echo $_POST["cnpj"]; } else {  echo $user["cnpj"]; } ?>"/>
    <?php echo @$form_error['u_cnpj']; ?>
    </div>-->
    
    <div class="form-field">        
      <label for="role">Empresa</label>
      <select id="cnpj" name="cnpj">
        <option value=""> -- Selecione -- </option>
        <?php
        // roles for user drop down
        $empresas = aaModelGetEmpresas();
        $array_of_empresas = $empresas->fetchAll();


        foreach ($array_of_empresas as $empresa) {

            if ($user['cnpj'] == $empresa["cnpj"]) {

                echo "<option value=" . $empresa["cnpj"] . " selected=\"selected\">" . $empresa["nome_fantasia"] . "</option>";
            } else {

                echo "<option value=" . $empresa["cnpj"] . " >" . $empresa["nome_fantasia"] . "</option>";
            }
        }

        ?>
      </select>
      <?php echo @$form_error['u_cnpj']; ?>
    </div>   
    
    <div class="form-field">            
    <label for="role"><?php echo $lang['set-user-db-role']; ?></label>
    <select id="user-add-role" name="user-add-role">
    <?php
	$role_options = array(3 => $lang['set-user-role-admin'], 2 => $lang['set-user-role-super'], 1 => $lang['set-user-role-agent'], 0 => $lang['set-user-role-user']);
	
    foreach ($role_options as $opt_val => $opt_key) {
    
        if ($user["Role"] == $opt_val) {
            echo "<option value=\"".$opt_val."\" selected=\"selected\">".$opt_key."</option>";
        } else {
            echo "<option value=\"".$opt_val."\">".$opt_key."</option>";
        }
    
    }
    ?>
    </select>
	</div>

    <div class="form-field">        
    <label for="signature"><?php echo $lang['set-user-db-us']; ?></label>
    <textarea name="signature" id="signature" class="notinymce" rows="5"><?php if (isset($_POST["signature"])) { echo $_POST["signature"]; } else {  echo $user["Signature"]; } ?></textarea>
    </div>

    <div class="form-field">            
    <label for="pwd"><?php echo $lang['set-user-edit-pwres']; ?> *</label>
    <input name="pwd" type="password" /> 
    <?php echo @$form_reset_msg; ?>
    <input class="btn" type="submit" name="resetpwd" value="<?php echo $lang['set-user-edit-pwres']; ?>" />
	</div>
    
    <div id="user-options">
    <h3><?php echo $lang['set-user-notif']; ?></h3>
    <hr />

    <div class="form-field">        
    <label for="notify_tu"><?php echo $lang['set-user-db-not-tn']; ?></label> 
    <?php
    if ($user["Notify_TN"] == 1) {
		$checked_ntn = 'checked';
	}
	?>
	<input name="notify_tn" id="notify_tn" type="checkbox" value="1" <?php echo @$checked_ntn; ?> />
	</div>

    <div class="form-field">        
    <label for="notify_tu"><?php echo $lang['set-user-db-tu']; ?></label>  
    <?php
    if ($user["Notify_TU"] == 1) {
        $checked_ntu = 'checked';
    }
    ?>
	<input name="notify_tu" id="notify_tu" type="checkbox" value="1" <?php echo @$checked_ntu; ?> />
    </div>
    
    <div class="form-field">        
    <label for="notify_pm"><?php echo $lang['set-user-db-pm']; ?></label>   
    <?php
    if ($user["Notify_PM"] == 1) {
		$checked_npm = 'checked';
    }
    ?>
	<input name="notify_pm" id="notify_pm" type="checkbox" value="1" <?php echo @$checked_npm; ?> />
    </div>
                              
    <h3><?php echo $lang['set-user-skill']; ?></h3>
    <hr />

    <?php
    // get categories
    foreach($groups as $group) {
        
        $user_skill = aaModelGetGroupByAgentID($uid, $group["Cat_ID"]);
        $user_skill = $user_skill->fetch();
        
		echo "<div class=\"form-field\">";
		echo "<label>".decode_entities($group["Category"])."</label>";                    
		
		// if user already skilled then check
		if ($user_skill["UID"] == $uid) {
		echo "<input name=\"inskill[]\" type=\"checkbox\" value=\"".$group["Cat_ID"]."\" checked=\"checked\" />";
		} else {
		echo "<input name=\"inskill[]\" type=\"checkbox\" value=\"".$group["Cat_ID"]."\" />";
		}
		echo "</div>";

    }
    ?>
    </div>
    
    <p><input class="btn" name="save_user" type="submit" value="<?php echo $lang['generic-save']; ?>" /></p>
    </form>

</div>