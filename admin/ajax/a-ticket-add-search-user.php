<?php
session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';
$pdo_conn = pdo_conn();
$s_sql = "WHERE ";
// set variable for get id
if ($_POST["p_name"] != "") {
	$s_sql .= "(Fname LIKE '%".$_POST["p_name"]."%') AND ";
} 

if ($_POST["p_uname"] != "") {
	$s_sql .= "(Email LIKE '%".$_POST["p_uname"]."%') AND ";
}

$s_sql = rtrim($s_sql, ' AND');

$sql_s_u = "SELECT UID, Fname, Email,
			CASE Role
			WHEN '3' THEN '".$lang['set-user-role-admin']."'
			WHEN '2' THEN '".$lang['set-user-role-super']."'
			WHEN '1' THEN '".$lang['set-user-role-agent']."'
			WHEN '0' THEN '".$lang['set-user-role-user']."'
			END AS NamedRole
			FROM ".$pdo_t['t_users']." $s_sql";
$q = $pdo_conn->prepare($sql_s_u);
$q->execute();

$users_no = $q->rowCount();
$users = $q->fetchAll();

if ($users_no > 0) {
	
	echo '<table>
			<thead>
			<tr>
			<td>Name</td>
			<td>Username / Email</td>
			<td>Role</td>
			<td>&nbsp;</td>
			</tr>
			</thead>';
	
	foreach($users as $user) {
		
	echo '<tr>
			<td>'.$user['Fname'].'</td>
			<td>'.$user['Email'].'</td>
			<td>'.$user['NamedRole'].'</td>
			<td style="text-align:right"><button s-uid-val="'.$user['UID'].'" s-fname-val="'.$user['Fname'].'" s-email-val="'.$user['Email'].'" class="btn s-select-user" type="submit" name="s-select-user"><i class="fa fa-check"></i></button></td>
			</tr>';
	
	}
	
	echo '</table>';
	
} else {
	
	echo 'No results found';
	
}


?>