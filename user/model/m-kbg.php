<?php
// get KB articles in group
function aaModelGetKBbyGroup ($kbgid) {
	
	global $pdo_conn, $pdo_t;

	$date_format = get_settings('Date_Format');
	
	$kbbygroup = "SELECT *, DATE_FORMAT(KB_Date_Added, '$date_format') AS KB_Date_Added 
					FROM ".$pdo_t['t_kb']." AS kb
					LEFT JOIN ".$pdo_t['t_kb_groups']." AS kbg ON kb.KB_Group = kbg.KBGROUPID
					WHERE kb.KB_Hidden != 1 AND kb.KB_Group = $kbgid ORDER BY KB_Sticky DESC, KB_Position ASC";
					
	
	$q = $pdo_conn->prepare($kbbygroup);
	$q->execute();

	return $q;

}
?>