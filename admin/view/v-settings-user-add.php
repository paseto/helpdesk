<div id="layout-body" class="layout-padding form">
  <?php include "v-settings-menu.php"; ?>  
  <h2><?php echo $lang["set-user-title"]; ?></h2>
  <hr />
  <?php
  if (isset($_POST["Reg"])) {

      aaModelInsertUser($_POST["fname"], $_POST["email"], $_POST["cnpj"], $_POST["telno"], $_POST["password"], $_POST["user-add-role"], $_POST["signature"], $_POST['notify_tn'], $_POST['notify_tu'], $_POST['notify_pm'], $_POST["inskill"]);
  }

  ?>
  <form name="form1" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <div class="form-field">        
      <label for="fname"><?php echo $lang['set-user-db-fn']; ?> *</label>
      <input name="fname" type="text" id="fname" autocomplete="off" value="<?php echo @$_POST["fname"]; ?>" />
    </div>

    <div class="form-field">        
      <label for="email"><?php echo $lang['set-user-db-ea']; ?> *</label>
      <input name="email" type="text"  id="email" autocomplete="off" value="<?php echo @$_POST["email"]; ?>"/>
    </div>

    <div class="form-field">        
      <label for="telno"><?php echo $lang['set-user-db-tn']; ?></label>
      <input name="telno" type="text"  id="telno" autocomplete="off" value="<?php echo @$_POST["telno"]; ?>"/>
    </div>		

    <div class="form-field">            
      <label for="password"><?php echo $lang['set-user-db-pw']; ?> *</label>
      <input name="password" type="password" id="password">
    </div>               

    <div class="form-field">        
      <label for="role">Empresa</label>
      <select id="cnpj" name="cnpj">
        <option value=""> -- Selecione -- </option>
        <?php
        // roles for user drop down
        $empresas = aaModelGetEmpresas();
        $array_of_empresas = $empresas->fetchAll();


        foreach ($array_of_empresas as $empresa) {

            if ($_POST['cnpj'] == $empresa["cnpj"]) {

                echo "<option value=" . $empresa["cnpj"] . " selected=\"selected\">" . $empresa["nome_fantasia"] . "</option>";
            } else {

                echo "<option value=" . $empresa["cnpj"] . " >" . $empresa["nome_fantasia"] . "</option>";
            }
        }

        ?>
      </select>
    </div>     

    <div class="form-field">        
      <label for="role"><?php echo $lang['set-user-db-role']; ?></label>
      <select id="user-add-role" name="user-add-role">
        <?php
// roles for user drop down
        $role_options = array(3 => $lang['set-user-role-admin'], 2 => $lang['set-user-role-super'], 1 => $lang['set-user-role-agent'], 0 => $lang['set-user-role-user']);

        foreach ($role_options as $opt_val => $opt_key) {

            if (isset($_POST["user-add-role"]) && $_POST["user-add-role"] == $opt_val) {
                echo "<option value=\"" . $opt_val . "\" selected=\"selected\">" . $opt_key . "</option>";
            } else {
                echo "<option value=\"" . $opt_val . "\">" . $opt_key . "</option>";
            }
        }

        ?>
      </select>
    </div>        

    <div id="user-options">

      <div class="form-field">        
        <label for="signature"><?php echo $lang['set-user-db-us']; ?></label>
        <textarea name="signature" id="signature" class="notinymce" rows="5"></textarea>
      </div>

      <h3><?php echo $lang['set-user-notif']; ?></h3>
      <hr />

      <div class="form-field">        
        <label for="notify_tu"><?php echo $lang['set-user-db-not-tn']; ?></label>             		
        <?php
        if (@$_POST['notify_tn'] == 1) {
            echo '<input name="notify_tn" type="checkbox" checked="checked" value="1" />';
        } else if (!isset($_POST['notify_tn'])) {
            echo '<input name="notify_tn" type="checkbox" checked="checked" value="1" />';
        } else {
            echo '<input name="notify_tn" type="checkbox" value="1" />';
        }

        ?>
      </div>


      <div class="form-field">        
        <label for="notify_tu"><?php echo $lang['set-user-db-tu']; ?></label>
        <?php
        if (@$_POST['notify_tu'] == 1) {
            echo '<input name="notify_tu" type="checkbox" checked="checked" value="1" />';
        } else if (!isset($_POST['notify_tu'])) {
            echo '<input name="notify_tu" type="checkbox" checked="checked" value="1" />';
        } else {
            echo '<input name="notify_tu" type="checkbox" value="1" />';
        }

        ?>
      </div>

      <div class="form-field">        
        <label for="notify_pm"><?php echo $lang['set-user-db-pm']; ?></label>     
        <?php
        if (@$_POST['notify_pm'] == 1) {
            echo '<input name="notify_pm" type="checkbox" checked="checked" value="1" />';
        } else if (!isset($_POST['notify_pm'])) {
            echo '<input name="notify_pm" type="checkbox" checked="checked" value="1" />';
        } else {
            echo '<input name="notify_pm" type="checkbox" value="1" />';
        }

        ?>
      </div>

      <h3><?php echo $lang['set-user-skill']; ?></h3>
      <hr />
      <?php echo $lang['set-user-skill-desc']; ?>

      <?php
// get categories
      $groups = aaModelGetGroups();
      $array_of_groups = $groups->fetchAll();
      foreach ($array_of_groups as $group) {

          echo "<div class=\"form-field\">";
          echo "<label>" . decode_entities($group["Category"]) . "</label>";
          echo "<input name=\"inskill[]\" type=\"checkbox\" value=\"" . $group["Cat_ID"] . "\" checked=\"checked\" />";
          echo "</div>";
      }

      ?>
    </div>

    <p><input class="btn" name="Reg" type="submit" id="Reg" value="<?php echo $lang['generic-save']; ?>" /></p>
  </form>

</div>