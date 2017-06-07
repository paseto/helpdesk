<?php
$kb_search = urlencode($_GET['kb_search']);
$date_format = get_settings('Date_Format');

$sql = "SELECT *,
		DATE_FORMAT(KB_Date_Added, '$date_format') AS KB_Date_Added 
		FROM ".$pdo_t['t_kb']." AS kb
		LEFT JOIN ".$pdo_t['t_kb_groups']." AS kbg ON kb.KB_Group = kbg.KBGROUPID
		WHERE KB_Hidden != 1 AND (KB_Title LIKE '%".$kb_search."%' OR KB_Article LIKE '%".$kb_search."%')";
									
$q = $pdo_conn->prepare($sql);
$q->execute();
$kbas = $q->fetchAll();	

$count_kba = $q->rowCount();						
?>   

<?php
include 'view/v-kbs-bar.php';
?>

<div class="margin-body">
		<h2><?php echo $lang['u-kb-kb']; ?></h2>
        
		<?php
		if ($count_kba > 0) {
		
			foreach($kbas as $kba) {


				$kb_rating_total = $kba['KB_Like'] + $kba['KB_Dislike'];
				$kb_like = $kba['KB_Like'];
				// remove html entities in mysql 
				$new = decode_entities(preg_replace("/(&lt;).*?(&gt;)/", "", highlight($kba['KB_Article'], $kb_search)));
						
				echo '<p>
					<i class="fa fa-file-o"></i> <a href="kba.php?kbid='.$kba['KBID'].'">'.highlight($kba['KB_Title'], $kb_search).'</a>
					</p>
					<p>'.substr($new,0,160).'</p>
				
				<p class="small">'.$lang['u-kba-views'].': <b>'.$kba['KB_Count'].'</b> '.$lang['u-kba-helpful'].' <b>'.$kb_like.'</b> '.$lang['u-kba-out'].' <b>'.$kb_rating_total.'</b> '.$lang['u-kba-dateadd'].': '.$kba['KB_Date_Added'].'</p>
				
					<p class="small">'.$lang['u-kba-group'].' : <a href="index.php?p=p.kbg&kbgid='.$kba['KBGROUPID'].'">'.$kba['KB_Group'].'</a></p>
					<hr>';
			}
		
		} else {
		
			echo '<p class="error">'.$lang['u-kb-search-na'].'</p>';
			
		}
		?>
    </div>          
    
