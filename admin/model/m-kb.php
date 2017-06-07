<?php
// get KB articles
function aaModelGetKBArticles ($kb_gid) {
	
	global $pdo_conn, $pdo_t;
	
	$sql_kb_g = "SELECT * FROM ".$pdo_t['t_kb']." WHERE KB_Group = :kb_gid";
	$q = $pdo_conn->prepare($sql_kb_g);
	$q->execute(array('kb_gid' => $kb_gid));
	
	return $q;

}

// delete a KB article
function aaModelDeleteKBArticle ($kb_aid) {
	
	global $pdo_conn, $pdo_t;	
	
	$sql = "DELETE FROM ".$pdo_t['t_kb']." WHERE KBID = :kb_aid";
	
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('kb_aid' => $kb_aid));
	
	header('Location: '.$_SERVER['REQUEST_URI']);

}
?>
