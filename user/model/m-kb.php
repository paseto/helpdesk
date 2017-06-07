<?php
// get all kb articles
function aaModelGetKBArticles ($kbgroupid) {

	global $pdo_conn, $pdo_t;

	$sel_article_per_group = "SELECT * FROM ".$pdo_t['t_kb']." WHERE KB_Group = :kbgroupid AND KB_Hidden != 1 ORDER BY KB_Sticky DESC, KB_Position ASC";
	
	$q = $pdo_conn->prepare($sel_article_per_group);
	$q->execute(array(":kbgroupid" => $kbgroupid));

	return $q;
	
}

// get most viewed kb articles
function aaModelGetKBAToprticles ($kblimit) {

	global $pdo_conn, $pdo_t;
		
    $sel_article_by_count = "SELECT * FROM ".$pdo_t['t_kb']." ORDER BY KB_Count DESC LIMIT $kblimit";
	
	$q = $pdo_conn->prepare($sel_article_by_count);
	$q->execute();

	return $q;
	
}

// get newest kb articles
function aaModelGetKBNewestArticles ($kblimit) {

	global $pdo_conn, $pdo_t;
	
    $sel_article_by_date = "SELECT * FROM ".$pdo_t['t_kb']." ORDER BY KB_Date_Added DESC LIMIT $kblimit";

	$q = $pdo_conn->prepare($sel_article_by_date);
	$q->execute();

	return $q;

}
?>