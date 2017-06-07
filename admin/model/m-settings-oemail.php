<?php
// submit outbound email changes
function aaModelGetTicketsPerPriority($email_enable,
		$email_method,
		$smtp_host,
		$smtp_auth,
		$smtp_user,
		$smtp_pass,
		$smtp_encr,
		$smtp_port,
		$dis_name,
		$oemail,
		$r_oemail,
		$subject,
		$newbody,
		$u_subject,
		$u_body,
		$p_subject,
		$p_body,
		$c_subject,
		$c_body,
		$f_subject,
		$f_body) {

	global $pdo_conn, $pdo_t,$lang;
	
	$email_enable = (isset($email_enable)) ? 1 : 0;
	
	// if ticked then add values to array
	if ($email_enable == 1) {
	
		$fields = array("dis_name" => $dis_name, "oemail" => $oemail, "r_oemail" => $r_oemail, "subject" => $subject, "newbody" => $newbody, "u_subject" => $u_subject, "u_body" => $u_body, "p_subject" => $p_subject, "p_body" => $p_body, "c_subject" => $c_subject, "c_body" => $c_body, "f_subject" => $f_subject, "f_body" => $f_body);
		
		//add smtp values if smtp server enabled
		if ($email_method == 'SMTP') {
				
			$fields["smtp_host"] = $smtp_host;
			
			// if authenticate is on check user and password aren't blank
			if ($smtp_auth == 1) {
			
				$fields["smtp_user"] = $smtp_user;
				$fields["smtp_pass"] = $smtp_pass;
			
			}
			
		}
		
		
		// for each value in array loop through and check if blank
		foreach ($fields as $k => $value) {
			
			// check fields aren blank
			if ($value == "") {
				
				$ticket_error = set_session ($k, '! REQUIRED');
				$error = true;
				//array_push($ticket_error, $k);
				//print_r(array_values($ticket_error));
			
			}
			
			// check email fields are valid email address
			if ($k == "oemail" || $k == "r_oemail") {
			
				if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				
					$ticket_error = set_session ($k, '! INVALID EMAIL');
					$error = true;			
					//print_r(array_values($ticket_error));
				
				}
				
			}	
				
		} // end foreach loop
		
	
		if (@$error) {
		
			echo '<div class="error-msg">'.$lang['generic-error-required-fields'].' <a href="'.$_SERVER['REQUEST_URI'].'">'.$lang['generic-error-cancel'].'</a></div>';
	
		} else {
	
			// update outbound email settings
			$sql_e_e = "UPDATE ".$pdo_t['t_settings']." SET 
							Email_Enabled=:email_enable, 
							Email_Method=:email_method,
							Email_SMTP_Host=:smtp_host,
							Email_SMTP_Auth=:smtp_auth,
							Email_SMTP_User=:smtp_user,
							Email_SMTP_Pass=:smtp_pass,
							Email_SMTP_Encr=:smtp_encr,
							Email_SMTP_Port=:smtp_port,																
							Email_Display=:dis_name, 
							Email_Addr=:oemail, 
							Email_Re_Addr=:r_oemail, 
							Email_New_Subject=:subject,
							Email_New_Body=:newbody,
							Email_Update_Subject=:u_subject,
							Email_Update_Body=:u_body,
							Email_Paused_Subject=:p_subject,
							Email_Paused_Body=:p_body,								
							Email_Closed_Subject=:c_subject,
							Email_Closed_Body=:c_body, 
							Email_Forward_Subject=:f_subject,
							Email_Forward_Body=:f_body LIMIT 1";
			
			$q_e_e = $pdo_conn->prepare($sql_e_e);
			
			if ($q_e_e->execute(array('email_enable' => $email_enable,
								'email_method' => $email_method, 
								'smtp_host' => $smtp_host,
								'smtp_auth' => $smtp_auth,
								'smtp_user' => $smtp_user,
								'smtp_pass' => $smtp_pass,
								'smtp_encr' => $smtp_encr,
								'smtp_port' => $smtp_port, 
								'dis_name' => $dis_name, 
								'oemail' => $oemail,
								'r_oemail' => $r_oemail, 
								'subject' => $subject, 
								'newbody' => $newbody,
								'u_subject' => $u_subject,
								'u_body' =>$u_body, 
								'p_subject' => $p_subject,
								'p_body' => $p_body, 
								'c_subject' => $c_subject, 
								'c_body' => $c_body,
								'f_subject' => $f_subject,
								'f_body' => $f_body))) {
									
 			echo '<div class="success-msg">'.$lang['generic-settings-saved'].'</div>';
		
			}
						
		}
		
	} else {
	
		// disable outbound email in db settings
		$sql_d_e = "UPDATE ".$pdo_t['t_settings']." SET Email_Enabled=:email_enable LIMIT 1";
		$q_d_e = $pdo_conn->prepare($sql_d_e);
		if ($q_d_e->execute(array('email_enable' => $email_enable))) {
		
			header('Location: '.$_SERVER['REQUEST_URI']); 
			
		}
	
	}

}
?>