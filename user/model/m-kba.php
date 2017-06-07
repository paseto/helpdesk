<?php
// get kb article
function aaModelGetKBArticle ($kbaid) {

	global $pdo_conn, $pdo_t;

	$date_format = get_settings('Date_Format');

	$sel_article = "SELECT *,DATE_FORMAT(KB_Date_Added, '$date_format') AS KB_Date_Added FROM ".$pdo_t['t_kb']." AS k
								LEFT JOIN ".$pdo_t['t_users']." AS u ON u.UID = k.KB_Author
								LEFT JOIN ".$pdo_t['t_kb_groups']." AS kg ON kg.KBGROUPID = k.KB_Group
								WHERE k.KBID = :kbaid";
								
	$q = $pdo_conn->prepare($sel_article);
	$q->execute(array(":kbaid" => $kbaid));

	return $q;

}

// dislike kb article
function aaModelUpdateKBCount ($kbaid) {
	
	global $pdo_conn, $pdo_t;
	
	$kba_u_ip = $_SERVER['REMOTE_ADDR'];
	
	$update_kba_count = "UPDATE ".$pdo_t['t_kb']." SET KB_Count=KB_Count + 1, 
						KB_Count_IP='$kba_u_ip' 
						WHERE KBID = :kbaid AND KB_Count_IP != '$kba_u_ip'";

	$q = $pdo_conn->prepare($update_kba_count);
	$q->execute(array(":kbaid" => $kbaid));
	
}

// like kb article
function aaModelLikeKBArticle ($kbaid) {
	
	global $pdo_conn, $pdo_t;
	
	$kba_u_ip = $_SERVER['REMOTE_ADDR'];
	
	$kb_like = "UPDATE ".$pdo_t['t_kb'] ." SET KB_Like=KB_Like + 1, 
				KB_Rating_IP='$kba_u_ip' 
				WHERE KBID = :kbaid AND KB_Rating_IP != '$kba_u_ip'";

	$q = $pdo_conn->prepare($kb_like);
	$q->execute(array(":kbaid" => $kbaid));

	header('Location: kba.php?kbid='.$kbaid);
}

// dislike kb article
function aaModelDislikeKBArticle ($kbaid) {
	
	global $pdo_conn, $pdo_t;
	
	$kba_u_ip = $_SERVER['REMOTE_ADDR'];
	
	$kb_dislike = "UPDATE ".$pdo_t['t_kb'] ." SET KB_Dislike=KB_Dislike + 1, 
					KB_Rating_IP='$kba_u_ip' 
					WHERE KBID = :kbaid AND KB_Rating_IP != '$kba_u_ip'";

	$q = $pdo_conn->prepare($kb_dislike);
	$q->execute(array(":kbaid" => $kbaid));

	header('Location: kba.php?kbid='.$kbaid);
}

?>