<?php
// get KB article details
function aaModelGetArticlesByID($kb_aid) {

	global $pdo_conn, $pdo_t;
	
    $sql = "SELECT * FROM ".$pdo_t['t_kb']." WHERE KBID = :kb_aid";
	$q = $pdo_conn->prepare($sql);
	$q->execute(array('kb_aid' => $kb_aid));
	
	return $q;
	
}

// save KB article
function aaModelSaveArticle($kb_title, $kb_author, $kb_groupid, $kb_article, $kb_sticky, $kb_position, $kb_hidden, $kb_meta, $kb_edit = NULL) {

	global $pdo_conn, $pdo_t, $lang;
	// clean entered data using custom function
	$kb_title = clean($kb_title, TRUE);
	$kb_sticky = (isset($kb_sticky)) ? 1 : 0;
	$kb_hidden = (isset($kb_hidden)) ? 1 : 0;
	$kb_meta = clean($kb_meta, TRUE);
	
	// if field is blank
	if (!($kb_title)) {
	
		echo "<div class=\"error-msg\">".$lang['generic-error-required-fields']."</div>";
		
	// else insert into DB	
	} else {
			
		// encode now
		$kb_article = clean($_POST["kb_article"], FALSE);
		
		if (!isset($kb_edit)) {
			
			$dt = timezone_time();
			
			// insert priority name plus order ID of last id plus 1
			$sql = "INSERT INTO ".$pdo_t['t_kb']." (KB_Date_Added, KB_Title, KB_Author, KB_Group, KB_Article, KB_Sticky, KB_Position, KB_Hidden, KB_Meta_Tags) 
								VALUES (:dt, :kb_title, :kb_author, :kb_groupid, :kb_article, :kb_sticky, :kb_position, :kb_hidden, :kb_meta)";  
			$q = $pdo_conn->prepare($sql);
			$q->execute(array('dt' => $dt, 
			'kb_title' => $kb_title,
			'kb_author' => $kb_author,
			'kb_groupid' => $kb_groupid,
			'kb_article' => $kb_article,
			'kb_sticky' => $kb_sticky, 
			'kb_position' => $kb_position, 
			'kb_hidden' => $kb_hidden, 
			'kb_meta' => $kb_meta));
								
			
		} else {
		
			$sql = "UPDATE ".$pdo_t['t_kb']." SET KB_Title = :kb_title, 
			KB_Author = :kb_author, 
			KB_Group = :kb_groupid, 
			KB_Article = :kb_article,
			KB_Sticky = :kb_sticky, 
			KB_Position = :kb_position, 
			KB_Hidden = :kb_hidden, 
			KB_Meta_Tags = :kb_meta
			WHERE KBID = :kb_edit";
			$q = $pdo_conn->prepare($sql);
			$q->execute(array('kb_title' => $kb_title,
			'kb_author' => $kb_author,
			'kb_groupid' => $kb_groupid,
			'kb_article' => $kb_article,
			'kb_sticky' => $kb_sticky, 
			'kb_position' => $kb_position, 
			'kb_hidden' => $kb_hidden, 
			'kb_meta' => $kb_meta,			
			'kb_edit' => $kb_edit));								
	
		}			
			
		// refresh page and send to priorities section
		header('Location: p.php?p=kb');

	}	

}

?>
