<?php
// security code for adding tickets
function security_code () {

	$no1 = rand(1,10);
	$no2 = rand(1,10);
	
	echo $no1." + ".$no2;
	$_SESSION["code"] = $no1+$no2;
	
}
?>