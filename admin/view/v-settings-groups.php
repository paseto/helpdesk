<?php
// Set default category for drop down boxes
if (isset($_POST["group-default"])) {
		
	aaModelSetDefaultGroup($_POST["cid"]);

}

if (isset($_POST['group-del'])) {
	
	aaModelDeleteGroup($_POST["cid"]);

}

if (isset($_POST['group_edit'])) {

	aaModelSetGroupOwner($_POST['cid'], $_POST['set_group_assign']);
	
}
?>
<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>    
    
    <h2><?php echo $lang["set-groups-title"]; ?></h2>

    <?php echo $lang["set-groups-desc"]; ?>
    <hr />

    <h3><?php echo $lang["set-groups-add"]; ?></h3>

    <?php
    // add new group
    if (isset($_POST["group_save"])) {
        
        aaModelInsertGroup($_POST["newgroup"]);
        
    }
    ?>
    
    <form name="addgroup" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="form-field">
    <input type="text" name="newgroup" id="newgroup" value="" placeholder="<?php echo $lang['set-groups-enter']; ?>" />
    <input class="btn" type="submit" name="group_save" id="group_save" value="<?php echo $lang["generic-save"]; ?>" />    
    <span class="error"><?php if (isset($cat_error)) { echo $cat_error; } ?></span>
    </div>
    </form>
    
    <br />
    
    <h3><?php echo $lang["set-groups-exist"]; ?></h3>
    <table>
    <thead>
    <tr>
    <td>Group</td>
    <td>Ticket Assignment</td>
    <td></td>            
    <td></td>
    <td></td>
    </tr>
    </thead>
    <tbody>
    <?php
    // get groups            
    $groups = aaModelGetGroups();
    $array_of_groups = $groups->fetchAll();
    $no_of_groups = $groups->rowCount();
    
    foreach($array_of_groups as $group) {

    $tpg = aaModelGetTicketsPerGroup($group["Cat_ID"]);
    $tpg = $tpg->fetch();		
    ?>
    <tr>
    <form name="group" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">    
    <input name="cid" id="cid" value="<?php echo $group["Cat_ID"]; ?>" hidden style="display:none; ">
    <?php
    // if only one group left don't show delete option

    if ($group["Def"] > 0) {
    $green = "style=\"color:#090\"";
    } else {
    $green = "";
    }
    
    if ($tpg['tcount'] > 0) {
    $disabled = 'disabled';
    $disabled_title = $lang['generic-delete-warn'];
    } else {
    $disabled = '';
    $disabled_title = $lang["generic-delete"];
    }

    echo "<td width=\"100%\"><span $green>".decode_entities($group['Category'])." <strong title=\"Tickets per group\">[".$tpg['tcount']."]</strong></span></td>"; 
    
    $agents = aaModelGetAgents();
    $array_of_agents = $agents->fetchAll();

    echo "<td><select name=\"set_group_assign\" id=\"set_group_assign\">";
    echo "<option value=\"NULL\">".$lang["generic-unassigned"]."</option>";	
    echo "<option value=\"Owner\" disabled>".$lang['tickets-owner']."</option>";
    
    foreach ($array_of_agents as $agent) {
            
        if($group['Ticket_Assignment'] == $agent["UID"]) {
            
            echo "<option value=".$agent["UID"]." selected=\"selected\"> - ".$agent["Fname"]."</option>";
    
        } else {
            
            echo "<option value=".$agent["UID"]."> - ".$agent["Fname"]."</option>";
            
        }			
        
    }
    echo "</select></td>";		
    ?>
    <td><input class="btn" type="submit" name="group_edit" id="group_edit" value="<?php echo $lang["generic-save"]; ?>" /></td>                            
    <?php
    if ($no_of_groups > 1) {
    ?>
    <td><button class="btn" type="submit" name="group-del" <?php echo $disabled; ?> title="<?php echo $disabled_title; ?>"><i class="fa fa-trash-o"></i></button></td>
    <?php
    }
    ?>
    <td><button class="btn" type="submit" name="group-default"><i class="fa fa-check" title="<?php echo $lang["generic-mark"]; ?>"></i></button></td>                        
    </form>
    </tr>
    <?php				
    
    }
    
    ?>
    </tbody>    
    </table>
</div>