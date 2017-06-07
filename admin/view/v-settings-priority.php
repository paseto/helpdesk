<?php
// resort prioritoes
if (@$_GET["do"]) {
	aaModelReorderPriority($_GET["do"], $_GET["id"], $_GET["oid"]);
}

// delete a priority
if(isset($_POST["priority_delete"])) {
	aaModelDeletePriority($_POST["lid"]); 

}

// Set default priority for drop down boxes
if (isset($_POST["priority_default"])) {
	aaModelSetDefaultPriority($_POST["lid"]); 
}
?>
<div id="layout-body" class="layout-padding form">
	    <?php include 'v-settings-menu.php'; ?>    
        <h2><?php echo $lang["set-priorities-title"]; ?></h2>
        <?php echo $lang["set-priorities-title-desc"]; ?>
        <hr />
        <h3><?php echo $lang["set-priorities-db-ap"]; ?></h3>
		<?php
        // add a new priority
        if (isset($_POST["priority_save"])) {
        
            aaModelInsertPriority($_POST["newlevel"]);
        
        }
        ?>
        <form name="priorities" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    	<div class="form-field">        
        <input name="newlevel" type="text" id="newlevel" placeholder="<?php echo $lang["set-priorities-db-ap-desc"]; ?>">
        <input class="btn" type="submit" name="priority_save" id="priority_save" value="<?php echo $lang["generic-save"]; ?>">
        </div>
        </form>
    	
        <br />
        
        <h3><?php echo $lang["set-priorities-db-cp"]; ?></h3>
        <table>
        <thead>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="100%"><?php echo $lang["set-priorities-title"]; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
		</tr>
        </thead>        
		<?php
		
		$priorities = aaModelGetPriorities();
		$array_of_priorities = $priorities->fetchAll();
		$no_of_priorities = $priorities->rowCount();
		
        $i=1;
        foreach ($array_of_priorities as $levels) {
			$tpp = aaModelGetTicketsPerPriority($levels["Level_ID"]);
			$tpp = $tpp->fetch();		
	
			// mark default field	
			if ($levels["Def"] > 0) {
			$green = "style=\"color:#090\"";
			} else {
			$green = "";
			}
	
			if ($tpp['tcount'] > 0) {
			$disabled = 'disabled';
			$disabled_title = $lang['generic-delete-warn'];
			} else {
			$disabled = '';
			$disabled_title = $lang["generic-delete"];
			}
        ?>
        <tr>
        <form name="pform" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
   		<input name="lid" id="lid" value="<?php echo $levels["Level_ID"]; ?>" hidden style="display:none; "> 
		<?php
		if ($i != 1) {
		?>
		<!-- print Up link -->
		<td><a href="p.php?p=settings-priority&do=up&oid=<?php echo $levels["OrderID"]; ?>&id=<?php echo $levels["Level_ID"]; ?>"><i class="fa fa-arrow-up"></i></a></td>
		<?php	
		} else {
		?>
		<td>&nbsp;</td>
		<?php
		}
		
		if ($i != $no_of_priorities) {
		?>
		<td><a href="p.php?p=settings-priority&do=down&oid=<?php echo $levels["OrderID"]; ?>&id=<?php echo $levels["Level_ID"]; ?>"><i class="fa fa-arrow-down"></i></a></td>
		<?php
		}else {
		?>
		<td>&nbsp;</td>
		<?php
		}
		?>
		<td><span <?php echo $green; ?>><?php echo decode_entities($levels["Level"]); ?> <strong title="Tickets per priority"> [<?php echo $tpp['tcount']; ?>]</strong></span></td>
		
		<?php
        // if only one group left don't show delete option
        if ($no_of_priorities > 1) {
        ?>
        <td><button class="btn" type="submit" name="priority_delete" <?php echo $disabled; ?> title="<?php echo $disabled_title; ?>"><i class="fa fa-trash-o"></i></button></td>
        <?php
		}
		?>
               
        <td><button class="btn" type="submit" name="priority_default"><i class="fa fa-check" title="Mark as default"></i></button></td>
        
		<?php
		$i++;
		?>
		</form>        
        </tr>
        <?php
		}
		?>
		</table>
</div>