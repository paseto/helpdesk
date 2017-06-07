<?php
$group = $_POST["p_group"];
$status = $_POST["p_status"];

session_start();
require_once "../../lib/db.php";
require_once "../../lib/global.php";
require_once "../model/m-dashboard.php";
@include '../../public/language/'.$_SESSION['aalang'].'.php';
$pdo_conn = pdo_conn();

// set filter to today
//$_SESSION["filter_dateadded"] = "today";

// set filter group as array
$_SESSION["filter_groups"] = array();
// set filter status as array
$_SESSION["filter_status"] = array();

// if uassigned block set all status

if ($status == "Unassigned") {
	
	// push null agents
	$_SESSION["filter_agents"] = array("NULL");
	// push group
	if (isset($group)) {
	
		array_push($_SESSION["filter_groups"], $group);
	
	} else {
		// include all agents to ensure agents not skilled in groups can see all tickets
		$sql = "SELECT Cat_ID FROM ".$pdo_t['t_groups'];
		$q = $pdo_conn->prepare($sql);
		$q->execute();
		$groups = $q->fetchAll();
		
		foreach($groups as $group) {
			$_SESSION["filter_groups"][] = $group['Cat_ID'];
		}

	}
	// push status
	array_push($_SESSION["filter_status"], "Open", "Pending", "Paused", "Closed");

// else only set block status
} else {
	
	// include all agents to ensure agents not skilled in groups can see all tickets
	$sql = "SELECT UID, Role FROM ".$pdo_t['t_users']." WHERE Role != 0";
	$q = $pdo_conn->prepare($sql);
	$q->execute();
	$agents = $q->fetchAll();
	
	foreach($agents as $agent) {
		$_SESSION["filter_agents"][] = $agent['UID'];
	}
	
	// push group
	if (isset($group)) {
	
		array_push($_SESSION["filter_groups"], $group);
	
	} else {

		$sql = "SELECT Cat_ID FROM ".$pdo_t['t_groups'];
		$q = $pdo_conn->prepare($sql);
		$q->execute();
		$groups = $q->fetchAll();

		// include all agents to ensure agents not skilled in groups can see all tickets
		foreach($groups as $group) {
		$_SESSION["filter_groups"][] = $group['Cat_ID'];
		}

	}
	
	// push statuses
	array_push($_SESSION["filter_status"], $status);

}
?>