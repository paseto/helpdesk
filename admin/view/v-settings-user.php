<?php
$agents = aaModelGetUsersByRole();
$agents = $agents->fetchAll();

$no_of_admins = aaModelGetAdminUsers();

if(isset($_POST["user_edit"])) {

	$uid = $_POST['uid'];
	header('Location: p.php?p=settings-user-edit&uid='.$uid.'');
	exit;

}

if(isset($_POST["user_disable"])) {
	
	aaModelDisableUser($_POST['uid']);

}

if(isset($_POST["user_delete"])) {
	
	aaModelDeleteUser($_POST['uid']);

}

$guest_access = (get_settings('Enable_Guest_Access') == 1) ? 'checked="checked"' : '';
$reg_access = (get_settings('Enable_User_Reg') == 1) ? 'checked="checked"' : '';

								
?>	
<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>    
    <h2><?php echo $lang['set-users-title']; ?></h2>    
	<?php echo $lang['set-users-title-desc']; ?></p>    
    <hr />
    <?php
	if (isset($_POST['users_save'])) {
	aaModelSetUserAccess(@$_POST['user-guest-toggle'], @$_POST['user-reg-toggle']);
	}
	?>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    
    <div class="form-field">
    <label for="user-guest-toggle"><?php echo $lang['set-users-guest-access']; ?></label>
    <input name="user-guest-toggle" type="checkbox" value="1" <?php echo $guest_access; ?> />
	</div>
    
    <div class="form-field">
    <label for="user-reg-toggle"><?php echo $lang['set-users-reg-access']; ?></label>              
    <input name="user-reg-toggle" type="checkbox" value="1" <?php echo $reg_access; ?> />          
    </div>
    
    <p><input class="btn" type="submit" name="users_save" value="<?php echo $lang['generic-save']; ?>"></p>
    </form>
    <hr />
	<a href="p.php?p=settings-user-add"><i class="fa fa-user-plus"></i> <?php echo $lang['set-users-add-agent']; ?></a>    
      <table class="table_header" width="100%">
        <colgroup>
          <col />
          <col />
          <col />
          <col />
        </colgroup>
        <thead>
        <tr>
        <td width="30%"><?php echo $lang['set-users-name']; ?></td>
        <td width="30%"><?php echo $lang['set-user-db-ea']; ?></td>
        <td width="25%"><?php echo $lang['set-user-db-role']; ?></td>
        <td width="15%">&nbsp;</td>   
        </tr>
        </thead>
        <tbody>
        <?php
		foreach($agents as $agent) {
			
		$disabled_tr = ($agent["Disabled"] == 1) ? 'style="background-color:#f2dede"' : '';
		$uid = ($agent["Role"] == 0) ? $agent["Email"] : $agent["UID"];
		
		// get tickets assigned by email or owner
		$tpa = aaModelGetTicketsByUser($uid, $agent["Role"]);
		$tpa = $tpa->fetch();
		
		?>     
        <tr <?php echo $disabled_tr; ?>> 
        <form name="gusers" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <input name="uid" id="uid" value="<?php echo $agent["UID"]; ?>" hidden style="display:none; ">
                  
        <td data-title="<?php echo $lang['set-user-db-fn']; ?>"><a href="p.php?p=user-profile&email=<?php echo $agent["Email"]; ?>&uid=<?php echo $agent["UID"]; ?>"><?php echo $agent["Fname"]; ?></a> <strong title="Tickets per user">[<?php echo $tpa["tcount"]; ?>]</strong></td>
        <td data-title="<?php echo $lang['set-user-db-ea']; ?>"><?php echo $agent["Email"]; ?></td>
        <td data-title="<?php echo $lang['set-user-db-role']; ?>"><?php echo $agent["NamedRole"]; ?></td>   
        <td data-title="&nbsp;">
        <?php
		if ($tpa['tcount'] > 0) {
			$disabled = 'disabled';
			$disabled_title = $lang['generic-delete-warn'];
		} else {
			$disabled = '';
			$disabled_title = $lang["generic-delete"];
		}
		?>        
		<button class="btn" type="submit" id="user_edit" name="user_edit" title="<?php echo $lang['generic-edit']; ?>"><i class="fa fa-pencil-square-o"></i></button>       
        <?php
		if ($agent["Disabled"] == 1) {
			echo '<button class="btn" type="submit" id="user_disable" name="user_disable"><i class="fa fa-unlock-alt"></i></button>';
		} else {
			echo '<button class="btn" type="submit" id="user_disable" name="user_disable"><i class="fa fa-lock"></i></button>';
		}
		?>
		<?php
		// if only one admin do not give option to delete
		if ($agent["Role"] == 3 && $no_of_admins > 1) {
		?>
        <button class="btn" type="submit" id="user_delete" name="user_delete" <?php echo $disabled; ?> title="<?php echo $disabled_title; ?>"><i class="fa fa-trash-o"></i></button>
		<?php
        } else if ($agent["Role"] != 3) {
		?>
        <button class="btn" type="submit" id="user_delete" name="user_delete" <?php echo $disabled; ?> title="<?php echo $disabled_title; ?>"><i class="fa fa-trash-o"></i></button>
        <?php
		}
		?>
		</td>
        </form>
        </tr>
        <?php
        }
        ?>
        </tbody>
        </table>
        
    </div>