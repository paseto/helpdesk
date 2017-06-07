<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Acorn Aid Installation</title>
<style>
html,body {
	margin: 10px;
    -webkit-font-smoothing: antialiased;
    text-shadow: 1px 1px 1px rgba(0,0,0,0.004);
	font-family:"Segoe UI Semilight", "Segoe UI","Segoe UI Web Regular","Segoe UI Symbol","Helvetica Neue","BBAlpha Sans","S60 Sans",Arial,sans-serif;
	font-size:13px;
	line-height: 1.8em;
}

a {
	color:#0066CC;
	text-decoration:none;
}

a:hover {
	text-decoration:underline;
}

.success {
	color:#009900;
}

.warning {
	color:#FF9900;
}

.error {
	color:#CC3300;
}


.large {
	font-size:large;
}
	
#title {
	margin:0 auto;
	font-size: x-large;
	font-weight: bold;
	width: 650px;
}

.desc {
	color:#090;
}
	
#outer {
	margin: 0 auto;
	background-color:#FFFFFF;
	width: 650px;
	border: 1px #DDD solid;
	-webkit-box-shadow: 2px 2px 2px 2px #EEE;
	box-shadow: 2px 2px 2px 2px #EEE;	
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;	
	padding:20px;
}

input[type='text'] {
	border: 1px solid #DDD;
	padding: 10px;
	width: 90%;
	border-radius:5px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
}
input[type='submit'], input[type='button']  {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6));
	background:-moz-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-webkit-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-o-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-ms-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:linear-gradient(to bottom, #ffffff 5%, #f6f6f6 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0);
	
	background-color:#ffffff;
	
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	
	border:1px solid #dcdcdc;
	
	display:inline-block;
	font-weight:bold;
	color:#666666;
	padding:10px;
	text-decoration:none;
	
	text-shadow:0px 1px 0px #ffffff;
	cursor:pointer;
}	
input[type='submit']:hover, input[type='button']:hover  {
 background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f6f6f6), color-stop(1, #ffffff));
        background:-moz-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
        background:-webkit-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
        background:-o-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
        background:-ms-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
        background:linear-gradient(to bottom, #f6f6f6 5%, #ffffff 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#ffffff',GradientType=0);
        
        background-color:#f6f6f6;
}

input[type='submit']:active, input[type='button']:active {
        position:relative;
        top:1px;
}
</style>
</head>
<body>
<div id="title">Acorn Aid Setup</div>
<br>
<div id="outer">
<?php
if (isset($_POST["Install"])) {
	
	$i_et_u = $_POST["i_aa_u"];
	$i_et_p = $_POST["i_aa_p"];
	$i_et_fn = $_POST["i_aa_fn"];
	
	$i_et_p_sha = hash('sha256', $i_et_p);
	
	$i_db = $_POST["i_db"];
	$i_host = $_POST["i_host"];
	$i_u = $_POST["i_username"];
	$i_p = $_POST["i_pw"];
	
	$i_ticket = "ticket";
	$i_ticket_update = "ticket_updates";
	$i_categories = "groups";
	$i_priorities = "priorities";
	$i_settings = "settings";
	$i_users = "users";
	$i_users_skill = "users_skill";
	$i_calendar = "calendar";
	$i_canned_replies = "canned_messages";
	$i_custom_fields = "custom_fields";
	$i_kb = "kb";
	$i_kb_groups = "kb_groups";
	$i_slas = "slas";
	$i_imail = "imail";	
	
	$settingsfile = "../lib/db.php";
	// file content for settings.php
	$file_content = "<?php \n".
					"// acorn aid key\n".
					"\$aakey = \"FREE\";\n".
					"\n".
					"// database settings\n".
					"\$pdo['host'] = \"".$i_host."\";\n".
					"\$pdo['user'] =  \"".$i_u."\";\n".
					"\$pdo['pass'] = \"".$i_p."\";\n".
					"\$pdo['db'] = \"".$i_db."\";\n".
					"\n".
					"// table settings\n".
					"\$pdo_t['t_ticket'] = \"".$i_ticket."\";\n".
					"\$pdo_t['t_ticket_updates'] = \"".$i_ticket_update."\";\n".
					"\$pdo_t['t_groups'] = \"".$i_categories."\";\n".
					"\$pdo_t['t_priorities'] = \"".$i_priorities."\";\n".
					"\$pdo_t['t_settings'] = \"".$i_settings."\";\n".
					"\$pdo_t['t_users'] = \"".$i_users."\";\n".
					"\$pdo_t['t_users_skills'] = \"".$i_users_skill."\";\n".
					"\$pdo_t['t_canned_msg'] = \"".$i_canned_replies."\";\n".
					"\$pdo_t['t_custom_fields'] = \"".$i_custom_fields."\";\n".
					"\$pdo_t['t_kb'] = \"".$i_kb."\";\n".
					"\$pdo_t['t_kb_groups'] = \"".$i_kb_groups."\";\n".
					"\$pdo_t['t_slas'] = \"".$i_slas."\";\n".
					"\$pdo_t['t_iemail'] = \"".$i_imail."\";\n".
					"?>";
	
	// begin installation
	echo "<p class=\"large\"><b>Creating Acorn Aid...</b></p><hr>";	
	
	// host - username - password - database
	$mysqli = new mysqli($i_host, $i_u, $i_p);

	// check connection
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		echo "<p><a href='index.php'>Go back to the installation</a></p>";
		exit();
		$mysql_create_error = TRUE;
	}

	// create database
	if ($mysqli->query("CREATE DATABASE IF NOT EXISTS ".$i_db." DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci") === TRUE) {
		printf("Database created successfully.\n");
		$mysqli->close();
	} else {
		echo "<p class='error'>Database not created! Try creating the database manually in phpmyadmin and re-running the installion.</p>".
				"<p><a href='index.php'>Go back to the installation</a></p>";
		exit();
		$mysql_create_error = TRUE;
	}

	// setup new connection with created database
	$mysqli_db = new mysqli($i_host, $i_u, $i_p, $i_db);
	// get file sql statements from file
	$sql = file_get_contents("aa_2_august_2016.sql");
	// run statements from file
	if ($mysqli_db->multi_query($sql)) {
		
		echo "<p class='success'>Database tables and data successfully added.</p>";
		$mysqli_db->close();
		sleep(1);
		// setup new connection to edit default admin user
		$mysqli_edit = new mysqli($i_host, $i_u, $i_p, $i_db);
		if($mysqli_edit->query("UPDATE `users` SET Email = '".$i_et_u."', Pwd = '".$i_et_p_sha."', Fname = '".$i_et_fn."' WHERE `users`.`UID` = 1") === TRUE) {
			
			echo "<p class='success'>Admin account successfully added.</p>";
			$mysqli_edit->close();			
			
		} else {
			
			echo "<p class='error'>Admin account failed to be added. Re-run installation file.</p>";
			echo "<p><a href='index.php'>Go back to the installation</a></p>";
			$mysql_create_error = TRUE;
			
		}
		
	} else {
		throw new Exception ($mysqli_db->error);
		$mysql_create_error = TRUE;
	}
	
	// if an mysql table error don't create settings file	
	if (!@$mysql_create_error) {
			
		// write settings file
		$filehandle = fopen($settingsfile, 'w+') or die ("Error writing settings file");
		fwrite($filehandle, $file_content);
		fclose($filehandle);

		echo "<p class=\"success\">Settings file <b>".$settingsfile."</b> written successfully</p><hr>".
				"<p class=\"success large\"><b>Installation Complete</b></p>".
				"<p><a class=\"large\" href=\"http://acornaid.com/support/user/p.kba.php?kbid=11\" target=\"_blank\">Read the getting started guide</a></p>".
				"<p><a class=\"large\" href=\"../admin/\">Log into Acorn Aid</a></p>".
				"<p><i>! Remember to delete the installation file from your server once you are satisified all configuration is correct</i></p>";
	
		die();
		
	} else {
	
		echo "<p class=\"error large\"><b>Settings file not create due to MYSQL setup not being completed</b></p>";
		echo "<p><a href='index.php'>Go back to the installation</a></p>";
		
	}
	
}
?>
<?php
function cache_values ($field) {

	if (isset($field)) {
	
		echo $field;
		
	}
	
}
?>
<form name="form1" method="post" action="">

    <span class="desc">Enter your preferred email address and password for the admin portal of Acorn Aid</span>
        
    <p>Admin email address</p>
    <input type="text" name="i_aa_u" value="<?php if (isset($i_et_u)) { echo $i_et_u; } else { echo "admin@yourdomain.com"; } ?>">
    
    <p>Admin password</p>
    <input type="text" name="i_aa_p" value="<?php if (isset($i_et_p)) { echo $i_et_p; } else { echo "password"; } ?>">

    <p>Full name</p>
    <input type="text" name="i_aa_fn" value="<?php if (isset($i_et_p)) { echo $i_et_p; } else { echo "Joe Bloggs"; } ?>">

    
    <p class="desc">Enter your hosts mysql settings for the database and tables to be automatically created</p>
    
    <p>Database name</p>
    <input type="text" name="i_db" value="<?php cache_values(@$i_db); ?>">
    
    <p>MySQL host</p>
    <input type="text" name="i_host" value="<?php cache_values(@$i_host); ?>">
    
    <p>MySQL username</p>
    <input type="text" name="i_username" value="<?php cache_values(@$i_u); ?>">
    
    <p>MySQL password</p>
    <input type="text" name="i_pw" value="<?php cache_values(@$i_p); ?>">
    
    <p><input name="Install" type="submit" id="Install" value="Install"></p>

</form>
</div>

</body>
</html>
