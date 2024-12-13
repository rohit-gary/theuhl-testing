<?php
	require_once('../include/autoloader.inc.php');
	$filename = 'mslv-data.csv';
	$file = fopen($filename, 'r');
	$data = array();
	$dbh = new Dbh();
	$conn = $dbh->_connectodb();
	$utility = new Utility($conn);
	$i=0;
	while (($row = fgetcsv($file)) !== false) 
	{
		$i++;
		if($i<=4)
   		{
   			continue;
   		}
   		$utility->insertStudentAdmissionData($row);
   		echo "<br>";
   	}

?>	