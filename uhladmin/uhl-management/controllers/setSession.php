<?php 
@session_start();

if(isset($_POST['CompanyID']))
{
	$_SESSION['CompanyID'] = $_POST['CompanyID'];
}
?>