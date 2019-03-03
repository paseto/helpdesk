<?php
$email = $_GET["email"];
$uid = $_GET["uid"];

$user = aaModelGetAgent($email);
$user = $user->fetch();

$user_tickets = aaModelGetAgentTickets($uid, $email);
$user_owned_tickets = $user_tickets->fetchAll();
$count_owned_tickets = $user_tickets->rowCount();

$user_rating = aaModelGetAgentRatings($uid);
$user_rated_tickets = $user_rating->fetchAll();
$count_rating = $user_rating->rowCount();

if(isset($_POST["chgsign"])) {
			
	aaModelUpdateSignature ($_POST["signature"], $uid);

}

if(isset($_POST["update"])) {
	
	aaModelUpdateUser ($_POST['user-view'], $_POST['user-style'], $uid);

}

$disabled = ($s_uid != $user["UID"]) ? "disabled=\"disabled\"" : ""; // disable password reset
$signature = ($user['Signature'] == "") ? "N/A" : $user['Signature']; // n/a for signature if null
?>		
<div id="layout-body">

	<div id="layout-body-left-width">&nbsp;</div>
    <div id="layout-body-left" class="layout-padding">

            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            
            <p><strong><?php echo $lang['profile-email']; ?></strong></p>
			<p><?php echo $user['Email']; ?></p>
			
			<p><strong><?php echo $lang['profile-teleno']; ?></strong></p>
			<p><?php echo $user['TeleNo']; ?></p>
           
            <p><strong><?php echo $lang['profile-role']; ?></strong></p>
			<p><?php echo $user['TextRole']; ?></p>

            
            <strong><?php echo $lang['index-password']; ?></strong> 
			<p>******** <a href="#" class="open_popup" popup="chgpw"><?php if ($s_uid == $user["UID"] || ($s_urole == 3)) { echo $lang['generic-change']; } ?></a></p>            

            <strong><?php echo $lang['profile-date-add']; ?></strong>
			<p><?php echo $user['DateAdd']; ?></p>
            
            <strong><?php echo $lang['profile-last-log']; ?></strong>
			<p><?php echo $user['Lldate']; ?></p>
            
            <?php
			// if not a user show more options
			if ($user['Role'] != 0) {
			?>
			<strong><?php echo $lang['set-user-db-us']; ?></strong>
            <p><?php echo nl2br($signature); ?> <a href="#" class="open_popup" popup="chgsign"><?php echo $lang['profile-edit']; ?></a></p>  

            <strong><?php echo $lang['profile-ticket-layout']; ?></strong>
            <p>
            <select name="user-view">
            <?php
			$layout_options = array($lang['tickets-viewby-opt2'], $lang['tickets-viewby-opt1']);
			
			foreach ($layout_options as $v_opt) {
				if ($user['Preferred_View'] == $v_opt) {
					echo "<option value=".$v_opt." selected=\"selected\">".$v_opt."</option>";
				} else {
					echo "<option value=".$v_opt.">".$v_opt."</option>";
				}
			}
			
			?>
            </select>
            </p>
            
            <strong><?php echo $lang['profile-style']; ?></strong>
            <p>
            <select name="user-style">
			<?php
			$dir = '../public/css/custom/';
			$files1 = preg_grep('/^([^.])/', scandir($dir));
		
			foreach ($files1 as $file) {
				$file = substr($file, 0, strrpos($file, "."));
				
				if ($user['Layout_Style'] == $file) {
				echo '<option value="'.$file.'" selected="selected">'.ucfirst($file).'</option>';
				} else {
				echo '<option value="'.$file.'">'.ucfirst($file).'</option>';
				}
				
			}

			?>
            </select>            
            </p>
            <p><input class="btn" name="update" id="update" type="submit" value="Update" />
            <?php
			}
			?>

            </form>
            
    </div>
    
<div id="layout-body-middle" class="layout-padding">

        <h2><?php echo $user["Fname"]; ?></h2>
        <hr />
            <?php
			// if not a user show more options
			if ($user['Role'] != 0) {
			?>
			
            <?php
			if ($count_rating > 0) {
			?>
            <h3><?php echo $lang['profile-cust-sat']; ?></h3>
            <p>
            <ul id="feedback-summary">
            <?php
			// while loop to get the number of feedback ratings by date added			
			foreach ($user_rated_tickets as $ticket_rating) {
				$ratingtotal += $ticket_rating["rating"];
			}
			
			foreach ($user_rated_tickets as $ticket_rating) {
			
			$rating_percentage = round($ticket_rating["rating"] / $ratingtotal * 100, 2);			
			
			switch ($ticket_rating["Feedback"]) {
				case 0:
				$rating_name = "Negative";
				break;
				case 1:
				$rating_name = "Neutrel";
				break;
				case 2:
				$rating_name = "Positive";
				break;
				}
				
			?>
            <li id="<?php echo $rating_name; ?>" style="width:<?php echo $rating_percentage; ?>%"><?php echo $rating_name; ?> <span class="dashboard-number"><?php echo $rating_percentage; ?>%</span></li>
            <?php
			}
			?>
            </ul>
            </p>          
            <?php
			// close if count is greater than 0
			}
			?>
            
            
            <h3><?php echo $lang['profile-tickets-own']; ?></h3>
            
            <div id="summary">
                <ul>
                <li class="open"><a class="summary_block open-color" status="Open" href="#">Open <?php echo aaModelGetAgentTicketCount('Open', $uid); ?></a></li>
                <li class="awaitingreply"><a class="summary_block pending-color" status="Pending" href="#">Awaiting Reply <?php echo aaModelGetAgentTicketCount('Awaiting Reply', $uid); ?></a></li>           
                <li class="pending"><a class="summary_block pending-color" status="Pending" href="#">Pending <?php echo aaModelGetAgentTicketCount('Pending', $uid); ?></a></li>
                <li class="paused"><a class="summary_block paused-color" status="Paused" href="#">Paused <?php echo aaModelGetAgentTicketCount('Paused', $uid); ?></a></li>
                <li class="closed"><a class="summary_block closed-color" status="Closed" href="#">Closed <?php echo aaModelGetAgentTicketCount('Closed', $uid); ?></a></li>
                </ul>
            </div>
			<?php
			// end if not a user
			}
			?>
            <?php
			if ($count_owned_tickets > 0) {
			?>

            <table>
            <colgroup>
            <col />
            <col />
            <col />
            <col />
            </colgroup>
            <thead>
            <tr>
            <td><?php echo $lang['tickets-subject']; ?></td>
            <td><?php echo $lang['tickets-status']; ?></td>
            <td><?php echo $lang['tickets-dateup']; ?></td>
            </tr>
            </thead>
            <tbody>

            <?php
			foreach ($user_owned_tickets as $ticket_owned) {
			//while ($ticket_owned = mysqli_fetch_array($sel_owned_tickets)) {
			
			echo "<tr>
			<td data-title=\"".$lang['tickets-subject']."\"><a href=\"p.php?p=ticket&tid=".$ticket_owned["ID"]."\">".decode_entities($ticket_owned["Subject"])."</a></td>
			<td data-title=\"".$lang['tickets-status']."\">".$ticket_owned["Status"]."</td>
			<td data-title=\"".$lang['tickets-dateup']."\">".$ticket_owned["DateUp"]."</td>
			</tr>";
				
			}
			?>
            </tbody>
            </table>
            <p>&nbsp;</p>
            <?php
			// close if count is greater than 0
			}
			?>
</div>
</div>


<div class="overlay"></div>
<div class="popup layout-padding form" id="chgpw">
    <h3><?php echo $lang['profile-chg-pwd']; ?></h3>

    <form method="post" id="profile_pw_change">
    <input style="display:none;" name="user_id" id="user_id" value="<?php echo $user["UID"]; ?>" />
    <?php echo $lang['profile-chg-pwd-desc']; ?>
    <hr />
    <div id="pwd_result"></div>
    <div class="form-field">
    <label><?php echo $lang['profile-chg-pwd-new']; ?></label>
    <input autocomplete="off" name="newpwd" id="newpwd" type="password" placeholder="<?php echo $lang['profile-chg-pwd-new']; ?>" autofocus />
    </div>
    
    <div class="form-field">    
    <label><?php echo $lang['profile-chg-pwd-confirm']; ?></label>
    <input autocomplete="off" name="confirmpwd" id="confirmpwd" type="password" placeholder="<?php echo $lang['profile-chg-pwd-confirm']; ?>" />     
    </div>
    
    <p><input class="btn" id="chgpwd" name="chgpwd" type="submit" value="<?php echo $lang['search-button-reset']; ?>"></p>
    </form>      
</div>

<div class="popup layout-padding" id="chgsign">
	<h3><?php echo $lang['profile-chg-sign']; ?></h3>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <textarea <?php echo $disabled; ?> id="signature" name="signature" cols="" rows="5"><?php echo nl2br($s_usign); ?></textarea>
    <p><input class="btn" <?php echo $disabled; ?> id="chgsign" name="chgsign" type="submit" value="<?php echo $lang['generic-save']." ".$lang['set-user-db-us']; ?>" /></p>
    </form>
</div>
    