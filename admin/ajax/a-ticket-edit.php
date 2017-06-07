<?php
require_once "../../lib/db.php";
require_once "../../lib/global.php";
$pdo_conn = pdo_conn();

// set variable for get id
echo $tid = $_POST["p_tid"];
echo $type = $_POST["p_type"];
echo $p_edit = $_POST["p_edit"];

switch($type) {
	case "ts":
		$sql_t_s_u = "UPDATE ".$pdo_t['t_ticket']." SET Subject = :subject WHERE ID = :tid";
		$q = $pdo_conn->prepare($sql_t_s_u);
		$q->execute(array('subject' => $p_edit, 'tid' => $tid));
	break;
	case "tb":
		$sql_t_m_u = "UPDATE ".$pdo_t['t_ticket']." SET Message = :message WHERE ID = :tid";
		$q = $pdo_conn->prepare($sql_t_m_u);
		$q->execute(array('message' => $p_edit, 'tid' => $tid));
	break;
	case "tu":
		$sql_tu_m_u = "UPDATE ".$pdo_t['t_ticket_updates']." SET Notes = :notes WHERE ID = :tid";
		$q = $pdo_conn->prepare($sql_tu_m_u);
		$q->execute(array('notes' => $p_edit, 'tid' => $tid));	
	break;
}
?>