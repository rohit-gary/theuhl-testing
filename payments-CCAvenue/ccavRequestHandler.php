<html>
<head>
<title> Custom Form Kit </title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	error_reporting(0);
	
	$merchant_data='3976065';	//3976065
	$working_key='42AB5D806A81AAFFB78DFED10C323011';//Shared by CCAVENUES  42AB5D806A81AAFFB78DFED10C323011
	$access_code='AVPX36LK15CG52XPGC';//Shared by CCAVENUES	AVPX36LK15CG52XPGC
	
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.urlencode($value).'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

