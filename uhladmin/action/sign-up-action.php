<?php
@session_start();
include '../controllers/common_controllers.php';

setTimeZone();
$conn = _connectodb();
$businessemail= cleantext($_POST['businessemail']);
$campaign= cleantext($_POST['campaign']);
$CreatedDate = date('Y-m-d');
$CreatedTime = date('H:i:s');


$sql = "INSERT INTO `sign_up`(Email,SignUpPage,NextPage,Campaign,CreatedDate,CreatedTime) values('$businessemail','Yes','Yes','$campaign','$CreatedDate','$CreatedTime')";
$result = _InsertTableRecords($conn,$sql);
$response['sign_up_id'] = $result['last_insert_id'];



if($result == true)
    {
        $response['message'] = "Thank you. We'll be in contact with you shortly.";
        $response['error'] = false;
    }
else
{
	$response['message'] = "Technical Problem. Please try again";
	$response['error'] = true;
}



echo json_encode($response);

?>