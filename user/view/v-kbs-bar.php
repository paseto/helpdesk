<div id="kb-search">
<?php
if (isset($_POST['KB_Submit']))  {

	if ($_POST['kb_search'] == "") {
		
		$kb_error = $lang["generic-error"];
		
	} else {
		
		header('Location:index.php?p=kbs&kb_search='.urlencode($_POST['kb_search']));
		
	}
	
}
?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input name="kb_search" type="text" placeholder="<?php echo $lang['u-kb-search'].' '.$lang['u-kb-kb']; ?>" value="<?php echo @$_GET['kb_search']; ?>" />&nbsp;
<input style="position: absolute; left: -9999px; width: 1px; height: 1px;" name="KB_Submit" type="submit" value="<?php echo $lang['u-kb-search']; ?>" />
</form>
</div>
