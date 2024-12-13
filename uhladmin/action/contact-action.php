<?php
@session_start();
include '../controllers/common_controllers.php';

setTimeZone();
$conn = _connectodb();
$name= cleantext($_POST['Name']);
$email = cleantext($_POST['Email']);
$message = cleantext($_POST['Message']);
$CreatedDate = date('Y-m-d');
$CreatedTime = date('H:i:s');


$sql = "INSERT INTO `contact_form`(Name,Email,Message,CreatedDate,CreatedTime) values('$name','$email','$message','$CreatedDate','$CreatedTime')";
$result = _InsertTableRecords($conn,$sql);



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