<?php 
@session_start();
$response = array();
$response['member_exists'] = false;
if(isset($_SESSION['family_member']))
{
	$response['member_exists'] = true;
	$response['family_members'] = $_SESSION['family_member'];
}
echo json_encode($response);
?>