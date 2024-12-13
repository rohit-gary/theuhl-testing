<?php
	require_once('../include/autoloader.inc.php');
	$filename = 'admission-2.csv';
	$file = fopen($filename, 'r');
	$data = array();
	$dbh = new Dbh();
	$conn = $dbh->_connectodb();
	$utility = new Utility($conn);
	while (($row = fgetcsv($file)) !== false) 
	{
   		$utility->insertAdmissionData($row);
   		echo "<br>";
   	}

?>	