<div id="layout-body" class="layout-padding form">
	<?php
	// Save SLA details
    if (isset($_POST["Save_SLAs"])) {

		aaModelInsertSLA($_POST["sla_gid"], 
		$_POST["sla_pid"],
		$_POST["slard"][$_POST["sla_gid"].$_POST["sla_pid"]],
		$_POST["slarh"][$_POST["sla_gid"].$_POST["sla_pid"]],
		$_POST["slafd"][$_POST["sla_gid"].$_POST["sla_pid"]],
		$_POST["slafh"][$_POST["sla_gid"].$_POST["sla_pid"]],
		$_POST["sla_r_e_group"],
		$_POST["sla_f_e_group"],
		$_POST["sla_e_email"]);

    }
    ?>
    	<?php include 'v-settings-menu.php'; ?>
        <h2><?php echo $lang["set-slas-title"]; ?></h2>
        <?php echo $lang["set-slas-title-desc"]; ?>
        <hr />
                
        <table class="table_header">
        <thead>
        <tr class="nohover">
        <td width="20%"><?php echo $lang["set-slas-gp"]; ?></td>
        <td width="12.5%"><?php echo $lang["set-slas-ttr"]; ?></td>
        <td width="15%"><?php echo $lang["set-slas-erg"]; ?></td>
        <td width="12.5%"><?php echo $lang["set-slas-ttf"]; ?></td>
        <td width="15%"><?php echo $lang["set-slas-efg"]; ?></td>
        <td width="20%"><?php echo $lang["set-slas-aea"]; ?></td>
        <td width="5%%">&nbsp;</td>
        </thead>
        </tr>
		<?php
		$groups = aaModelGetGroups();
		$groups = $groups->fetchAll();
		
		$priorities = aaModelGetPriorities();
		$priorities = $priorities->fetchAll();
		
		
		foreach ($groups as $group) {
		
			echo "<tr class=\"nohover\"><td class='border-color' colspan='6'><strong>".decode_entities($group['Category'])."</strong></td></tr>";
			
			foreach ($priorities as $priority) {

				$slas = aaModelGetSLAs($group["Cat_ID"], $priority["Level_ID"]);
				$slas = $slas->fetch();
								
				echo "<form action='".$_SERVER["REQUEST_URI"]."' method='post'>        
				<tr class=\"nohover\"><td >".decode_entities($priority["Level"])."</td>
				<input id='sla_gid' name='sla_gid' type='hidden' value='".$group["Cat_ID"]."'></input>
				<input id='sla_pid' name='sla_pid' type='hidden' value='".$priority["Level_ID"]."'></input>";
				?>
				<td>
                <select id='slard[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' name='slard[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' >
                <option value="">D</option>
                <?php
				for ($i= 0; $i <= 99; $i++) {
					if ($slas['SLA_Reply_Days'] == $i) {
						echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
					} else {
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
				}
				?>
                </select>
                <select id='slarh[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' name='slarh[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' >
                <option value="">H</option>
                <?php
				for ($i= 0; $i <= 23; $i++) {
					if ($slas['SLA_Reply_Hours'] == $i) {					
						echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
					} else {
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
				}
				?>
                </select>

				</td>
                <td>
				<?php
				
                echo "<select id='sla_r_e_group' name='sla_r_e_group'>";
				foreach ($groups as $egroup) {
					if ($egroup["Cat_ID"] == $slas["Reply_Escalation_Group"]) {
						echo '<option value="'.$egroup["Cat_ID"].'" selected="selected">'.$egroup["Category"].'</option>';
					} else {
						echo '<option value="'.$egroup["Cat_ID"].'">'.$egroup["Category"].'</option>';
					}
				}
				echo "</select>";
				?>
				</td>	

				<td>
                
                <select id='slafd[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' name='slafd[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' >
                <option value="">D</option>
                <?php
				for ($i= 0; $i <= 99; $i++) {
					if ($slas['SLA_Fix_Days'] == $i) {										
						echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
					} else {
						echo '<option value="'.$i.'">'.$i.'</option>';	
					}
				}
				?>
                </select>
                
                <select id='slafh[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' name='slafh[<?php echo $group["Cat_ID"].$priority["Level_ID"]; ?>]' >
                <option value="">H</option>
                <?php
				for ($i= 0; $i <= 23; $i++) {
					if ($slas['SLA_Fix_Hours'] == $i) {
						echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
					} else {
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
				}
				?>
                </select>
				</td>
				<td>
				<?php
				
                echo "<select id='sla_f_e_group' name='sla_f_e_group'>";
				foreach ($groups as $egroup) {
					if ($egroup["Cat_ID"] == $slas["Fix_Escalation_Group"]) {
						echo '<option value="'.$egroup["Cat_ID"].'" selected="selected">'.$egroup["Category"].'</option>';
					} else {
						echo '<option value="'.$egroup["Cat_ID"].'">'.$egroup["Category"].'</option>';
					}
				}
				echo "</select>";
				?>
				</td>	
				<td><input id='sla_e_email' name='sla_e_email' type='text' value="<?php echo $slas["Escalation_Email"]; ?>"></input></td>
        		<td><input class='btn' name='Save_SLAs' type='submit' value="<?php echo $lang['generic-save']; ?>" /></td> 				
				</tr></form>
				<?php
			}
		?>	
		<?php			
		}
		?>    
    	</table>
</div>