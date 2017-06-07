<div id="layout-body" class="layout-padding form">
    <?php include 'v-settings-menu.php'; ?>    
    <h2><?php echo $lang["set-oemail-title"]; ?></h2>
	<p><?php echo $lang["set-oemail-title-desc"]; ?></p>
    <p>[TICKET_NO] - <?php echo $lang["set-oemail-code-tn"]; ?></p>
    <p>[TICKET_DATE_ADDED] - <?php echo $lang["set-oemail-code-da"]; ?></p>
    <p>[TICKET_DATE_UPDATED] - <?php echo $lang["set-oemail-code-du"]; ?></p>
    <p>[TICKET_SUBJECT] - <?php echo $lang["set-oemail-code-ts"]; ?></p>
    <p>[TICKET_ENQUIRY] - <?php echo $lang["set-oemail-code-te"]; ?></p>
    <p>[TICKET_USER] - <?php echo $lang["set-oemail-code-u"]; ?></p>
    <p>[TICKET_UPDATE] - <?php echo $lang["set-oemail-code-tu"]; ?></p>
    <p>[TICKET_CATEGORY] - <?php echo $lang["set-oemail-code-tc"]; ?></p>
    <p>[TICKET_PRIORITY] - <?php echo $lang["set-oemail-code-tp"]; ?></p>
    <p>[TICKET_SLAR] - <?php echo $lang["set-oemail-code-slar"]; ?></p>
    <p>[TICKET_SLAF] - <?php echo $lang["set-oemail-code-slaf"]; ?></p>
	<hr />
    
	<?php
	if (isset($_POST["Save_OEmail"])) {
	aaModelGetTicketsPerPriority($_POST["oemail_enable"],
	$_POST["set_oemail_method"],
	$_POST["set_smtp_host"],
	$_POST["set_smtp_auth"],
	$_POST["set_smtp_user"],
	$_POST["set_smtp_pass"],
	$_POST["set_smtp_encr"],
	$_POST["set_smtp_port"],
	$_POST["set_dis_name"],
	$_POST["set_oemail"],
	$_POST["set_r_oemail"],
	$_POST["set_subject"],
	$_POST["area1"],
	$_POST["set_u_subject"],
	$_POST["area2"],
	$_POST["set_p_subject"],
	$_POST["area3"],
	$_POST["set_c_subject"],
	$_POST["area4"],
	$_POST["set_f_subject"],
	$_POST["area5"]);
	}
	
	?>	
    
    <form name="oemail" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    	
        <div class="form-field">
        <input name="oemail_enable" type="checkbox" class="enable" id="input_enable" <?php if (get_settings("Email_Enabled") == 1) { echo "checked=\"checked\""; } ?>/>
        <label><?php echo $lang["set-oemail-db-enable"]; ?></label>
        </div>

        <div class="form-field">
        <input name="set_oemail_method" id="input_phpmail" type="radio" value="PHPMAIL" <?php if (get_settings("Email_Method") == 'PHPMAIL') { echo "checked=\"checked\""; } ?> />
        <label><?php echo $lang['set-oemail-db-method-mail']; ?></label>
		</div>
        
        <div class="form-field">        
		<input name="set_oemail_method" id="input_smtp" type="radio" value="SMTP" <?php if (get_settings("Email_Method") == 'SMTP') { echo "checked=\"checked\""; } ?> />
        <label><?php echo $lang['set-oemail-db-method-smtp']; ?></label>
        </div>
        
        <div id="smtp_options">
        <hr />
        <div class="form-field">        
        <label><?php echo $lang['set-oemail-db-smtp-host']; ?> *</label>
        <input class="dis-enl-input" name="set_smtp_host" type="text" value="<?php echo cached_fields (@$_POST['set_smtp_host'], get_settings("Email_SMTP_Host")); ?>"/>
        <?php read_session("smtp_host"); ?>
        </div>
        
        <div class="form-field">        
        <label><?php echo $lang['set-oemail-db-smtp-auth']; ?></label>
        <?php
		$smtp_auth_one = (get_settings("Email_SMTP_Auth") == '1' ? 'selected="selected"' : '');
		$smtp_auth_zero = (get_settings("Email_SMTP_Auth") == '0' ? 'selected="selected"' : '');
		?>
        <select class="dis-enl-input" name="set_smtp_auth" type="text" />
        <option value="1" <?php echo $smtp_auth_one; ?>>TRUE</option>
        <option value="0" <?php echo $smtp_auth_zero; ?>>FALSE</option>
        </select>
        </div>

        <div class="form-field">
        <label><?php echo $lang['set-oemail-db-smtp-user']; ?></label>
        <input class="dis-enl-input" name="set_smtp_user" type="text" value="<?php echo cached_fields (@$_POST['set_smtp_user'], get_settings("Email_SMTP_User")); ?>"/>
        <?php read_session("smtp_user"); ?>
		</div>
        
        <div class="form-field">
        <label class=""><?php echo $lang['set-oemail-db-smtp-pass']; ?></label>
        <input class="dis-enl-input" name="set_smtp_pass" type="password" value="<?php echo cached_fields (@$_POST['set_smtp_pass'], get_settings("Email_SMTP_Pass")); ?>"/>
        <?php read_session("smtp_pass"); ?>
		</div>

        <div class="form-field">        
        <label><?php echo $lang['set-oemail-db-smtp-encr']; ?></label>
        <?php
		$smtp_encr_tls = (get_settings("Email_SMTP_Encr") == 'tls' ? 'selected="selected"' : '');
		$smtp_encr_ssl = (get_settings("Email_SMTP_Encr") == 'ssl' ? 'selected="selected"' : '');
		?>
        <select class="dis-enl-input" name="set_smtp_encr" type="text" />
        <option value="tls" <?php echo $smtp_encr_tls; ?>>TLS</option>
        <option value="ssl" <?php echo $smtp_encr_ssl; ?>>SSL</option>
        </select>
        </div>

        <div class="form-field">
        <label><?php echo $lang['set-oemail-db-smtp-port']; ?> *</label>
        <input class="dis-enl-input" name="set_smtp_port" type="text" value="<?php echo cached_fields (@$_POST['set_smtp_port'], get_settings("Email_SMTP_Port")); ?>"/>
		<?php read_session("smtp_port"); ?>
        </div>
        
        <hr />
        </div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-name"]; ?> *</label>
        <input class="dis-enl-input" name="set_dis_name" type="text" value="<?php echo cached_fields (@$_POST['set_dis_name'], get_settings("Email_Display")); ?>"/>
		<?php read_session("dis_name"); ?>
        </div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-email"]; ?> *</label>
        <input class="dis-enl-input" name="set_oemail" type="text" value="<?php echo cached_fields (@$_POST['set_oemail'], get_settings("Email_Addr")); ?>" />
		<?php read_session("oemail"); ?>
        </div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-remail"]; ?> *</label>
        <input class="dis-enl-input" name="set_r_oemail" type="text" value="<?php echo cached_fields (@$_POST['set_r_oemail'], get_settings("Email_Re_Addr")); ?>"/>
		<?php read_session("r_oemail"); ?>
        </div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tn-sub"]; ?> *</label>
        <input class="dis-enl-input" name="set_subject" type="text" value="<?php echo cached_fields (@$_POST['set_subject'], get_settings("Email_New_Subject")); ?>"/>
		<?php read_session("subject"); ?>      
		</div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tn-body"]; ?> *</label>
        <textarea class="dis-enl-input" name="area1" cols="77" rows="10" id="area1"><?php echo cached_fields (@$_POST['area1'], stripslashes(get_settings("Email_New_Body"))); ?></textarea>
		<?php read_session("newbody"); ?>      		
        </div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tu-sub"]; ?> *</label>
        <input class="dis-enl-input" name="set_u_subject" type="text" value="<?php echo cached_fields (@$_POST['set_u_subject'], get_settings("Email_Update_Subject")); ?>"/>
		<?php read_session("u_subject"); ?>              
		</div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tu-body"]; ?> *</label>
        <textarea class="dis-enl-input" name="area2" cols="77" rows="10" id="area2"><?php echo cached_fields (@$_POST['area2'], stripslashes(get_settings("Email_Update_Body"))); ?></textarea>
		<?php read_session("u_body"); ?>              
		</div>

        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tp-sub"]; ?> *</label>
        <input class="dis-enl-input" name="set_p_subject" type="text" value="<?php echo cached_fields (@$_POST['set_p_subject'], get_settings("Email_Paused_Subject")); ?>"/>
		<?php read_session("p_subject"); ?>                      
		</div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tp-body"]; ?> *</label>
        <textarea class="dis-enl-input" name="area3" cols="77" rows="10" id="area3"><?php echo cached_fields (@$_POST['area3'], stripslashes(get_settings("Email_Paused_Body"))); ?></textarea>
		<?php read_session("p_body"); ?>                              
        </div>

        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tc-sub"]; ?> *</label>
        <input class="dis-enl-input" name="set_c_subject" type="text" value="<?php echo cached_fields (@$_POST['set_c_subject'], get_settings("Email_Closed_Subject")); ?>"/>
		<?php read_session("c_subject"); ?>                              
		</div>
        
        <div class="form-field">                
        <label><?php echo $lang["set-oemail-db-tc-body"]; ?> *</label>
        <textarea class="dis-enl-input" name="area4" cols="77" rows="10" id="area4"><?php echo cached_fields (@$_POST['area4'], stripslashes(get_settings("Email_Closed_Body"))); ?></textarea>
		<?php read_session("c_body"); ?>                              
		</div>
        
        <div class="form-field">                
        <label><?php echo $lang["set-oemail-db-tf-sub"]; ?> *</label>
        <input class="dis-enl-input" name="set_f_subject" type="text" value="<?php echo cached_fields (@$_POST['set_f_subject'], get_settings("Email_Forward_Subject")); ?>"/>
		<?php read_session("f_subject"); ?>                                      
		</div>
        
        <div class="form-field">        
        <label><?php echo $lang["set-oemail-db-tf-body"]; ?> *</label>
        <textarea class="dis-enl-input" name="area5" cols="77" rows="10" id="area5"><?php echo cached_fields (@$_POST['area5'], stripslashes(get_settings("Email_Forward_Body"))); ?></textarea>
		<?php read_session("f_body"); ?>                                      
		</div>
        
        <p><input class="btn" name="Save_OEmail" type="submit" value="<?php echo $lang['generic-save']; ?>" /></p>

    </form>  

</div>