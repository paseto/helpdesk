<?php
// update kb settings
function aaModelSaveKBSettings($kb_on, $kb_author, $kb_count, $kb_rating, $kb_share, $kb_showx) {

	global $pdo_conn, $pdo_t;
	
	$kb_on = (isset($kb_on)) ? 1 : 0;
	$kb_author = (isset($kb_author)) ? 1 : 0;
	$kb_count = (isset($kb_count)) ? 1 : 0;
	$kb_rating = (isset($kb_rating)) ? 1 : 0;
	$kb_share = (isset($kb_share)) ? 1 : 0;
		
	$sql = "UPDATE ".$pdo_t['t_settings']." SET KB_Enable=:kb_on, KB_Author_Allow=:kb_author, KB_Count=:kb_count, KB_Rating=:kb_rating, KB_Share=:kb_share, KB_Showx=:kb_showx LIMIT 1";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('kb_on' => $kb_on, 'kb_author' => $kb_author, 'kb_count' => $kb_count, 'kb_rating' => $kb_rating, 'kb_share' => $kb_share, 'kb_showx' => $kb_showx));
	
	// refresh page and redirect to kb settings
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}
?>
