<?php

function aaModelSetUserAccess($u_access, $r_access) {

	global $pdo_conn, $pdo_t, $lang;
	
	$u_access = (isset($u_access)) ? 1 : 0;
	$r_access = (isset($r_access)) ? 1 : 0;
	
	$sql_u_u = "UPDATE ".$pdo_t['t_settings']." SET  
	Enable_Guest_Access = :u_access,
	Enable_User_Reg = :r_access  
	LIMIT 1";
	$q = $pdo_conn->prepare($sql_u_u);
	if ($q->execute(array("u_access" => $u_access, "r_access" => $r_access))) {
		header('Location:'.$_SERVER['REQUEST_URI']);
	}
	
}

// get user by role and last name
function aaModelGetUsersByRole() {

	global $pdo_conn, $pdo_t, $lang;
	
	$sql = "SELECT u.*, e.nome_fantasia, 
	CASE Role
	WHEN '3' THEN '".$lang['set-user-role-admin']."'
	WHEN '2' THEN '".$lang['set-user-role-super']."'
	WHEN '1' THEN '".$lang['set-user-role-agent']."'
	WHEN '0' THEN '".$lang['set-user-role-user']."'
	END AS NamedRole    
	FROM ".$pdo_t['t_users']." u LEFT JOIN empresas e ON e.cnpj=u.cnpj ORDER BY Role DESC, Fname";
	
	$q = $pdo_conn->prepare($sql);
	$q->execute();
	
	return $q;
	
}

// get admin agents for checking an admin exists
function aaModelGetAdminUsers() {

	global $pdo_conn, $pdo_t;
	
	$sql = "SELECT UID FROM ".$pdo_t['t_users']." WHERE Role = 3";
	
	$q = $pdo_conn->prepare($sql);
	$q->execute();
	
	$no = $q->rowCount();
	return $no;
	
}

// get number of tickets by agent ID
function aaModelGetTicketsByUser($uid, $role) {

	global $pdo_conn, $pdo_t;
	// if a user count by user_email field in ticket table else match by owner
	if ($role != 0) {
		$sql = "SELECT COUNT(Owner) AS tcount FROM ".$pdo_t['t_ticket']." WHERE Owner = :owner AND Status != :status";
	} else {
		$sql = "SELECT COUNT(User) AS tcount FROM ".$pdo_t['t_ticket']." WHERE User_Email = :owner AND Status != :status";
	}
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('owner' => $uid, 'status' => "Closed"));
	
	return $q;

}

function aaModelDisableUser($uid) {

	global $pdo_conn, $pdo_t;
	
	$sql_u_d = "UPDATE ".$pdo_t['t_users']." SET Disabled = CASE
				WHEN Disabled = 0 THEN 1
				WHEN Disabled = 1 THEN 0
				ELSE 0
				END
				WHERE UID = :uid";
		
	$q_u_d = $pdo_conn->prepare($sql_u_d);
	$q_u_d->execute(array('uid' => $uid));
		
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}

function aaModelDeleteUser($uid) {

	global $pdo_conn, $pdo_t;
	
	$sql_u_d = "DELETE FROM ".$pdo_t['t_users']." WHERE UID = :uid";
		
	$q_u_d = $pdo_conn->prepare($sql_u_d);
	$q_u_d->execute(array('uid' => $uid));
		
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}
?>
