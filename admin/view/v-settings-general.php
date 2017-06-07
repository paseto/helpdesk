<div id="layout-body" class="layout-padding form">

    <?php include 'v-settings-menu.php'; ?>
    <h2><?php echo $lang["set-general-title"]; ?></h2>
    <hr />
    <?php
    if (isset($_POST["Save_General"])) {
    aaModelSaveSettingsGeneral($_POST["set_com_name"], $_POST['lang'], $_POST["set_timezone"], $_POST["set_dateformat"], $_POST["set_redirect_to"]);
    }
    ?>
    <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">

    <div class="form-field">
    <label class="<?php if($general_error) { echo "error"; } ?>"><?php echo $lang["set-general-db-cn"]; ?></label>
    <input name="set_com_name" type="text" value="<?php echo get_settings("Company_Name"); ?>" />
    </div>
    
    <div class="form-field">
    <label><?php echo $lang["set-general-db-fl"]; ?></label>
    <?php
    select_langauge ();
    ?>
    </div>
    
    <div class="form-field">        
    <label><?php echo $lang["set-general-db-tz"]; ?></label>        
    <select name="set_timezone">
    <?php
    $dbtimezone = get_settings("Timezone");
    
        foreach (aaModelAllTimezones() as $timezone) {
            
            if ($dbtimezone == $timezone) {
    
                echo "<option value=\"".$dbtimezone."\" selected=\"selected\">".$dbtimezone."</option>";
    
            } else {
        
                echo "<option value=\"".$timezone."\">".$timezone."</option>";
    
            }
        }
    ?>
    </select>
    </div>
    
    <div class="form-field">        
    <label><?php echo $lang["set-general-db-df"]; ?></label>
    <select name="set_dateformat">

    <?php
    $dbdateformat = get_settings("Date_Format");  
    $date_formats = array(array("%D %b %y %H:%i:%s","Day Month Year Hour:Minute:Seconds"),array("%b %D %y %H:%i:%s","Month Day Year Hour:Minute:Second"),array("%y %b %D %H:%i:%s","Year Month Day Hour:Minute:Second"));
    
    foreach ($date_formats as $df_value) {
    
        if ($dbdateformat == $df_value[0]) {
            
            echo "<option value=\"".$df_value[0]."\" selected=\"selected\">".$df_value[1]."</option>";
        
        } else {
            
            echo "<option value=\"".$df_value[0]."\">".$df_value[1]."</option>";
        }
    
    }
    ?>
    </select>
    </div>
    
    <div class="form-field">
    <label><?php echo $lang["set-general-db-rp"]; ?></label>
    <select name="set_redirect_to">
        <?php
        $redirect_page = get_settings("Redirect_Page");
        $pages = array($lang['nav-dashboard'] => "p.php?p=dashboard", $lang['nav-tickets'] => "p.php?p=tickets");
    
        foreach ($pages as $pagekey => $pagevalue) {
                    
            if ($redirect_page == $pagevalue) {
            
                echo "<option value=".$pagevalue." selected=\"selected\">".$pagekey."</option>";
            
            } else {
                
                echo "<option value=".$pagevalue.">".$pagekey."</option>";
        
            }
        }
        ?>
    </select>
    </div>
    <p><input class="btn" name="Save_General" type="submit" value="<?php echo $lang['generic-save']; ?>" /></p>

    </form>

</div>