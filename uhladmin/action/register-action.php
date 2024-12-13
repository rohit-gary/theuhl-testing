<?php
@session_start();
include '../controllers/common_controllers.php';

function sendMailRequest($postdata)
{
	$postdata = json_encode($postdata);
	$resource = "https://digitalworkdesk.com/send-email-api.php";
	$ch = curl_init($resource);
	curl_setopt($ch, CURLOPT_URL, $resource);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_setopt($ch, CURLOPT_USERAGENT, 'api');
	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT_MS, 0);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch,  CURLOPT_RETURNTRANSFER, false);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	curl_exec($ch);
	curl_close($ch);
}

setTimeZone();
$conn = _connectodb();
$name= cleantext($_POST['name']);
$phonenumber= cleantext($_POST['phonenumber']);
$companyname= cleantext($_POST['companyname']);
$campaign= cleantext($_POST['campaign']);
$sign_up_id = cleantext($_POST['sign_up_id']);
$CreatedDate = date('Y-m-d');
$CreatedTime = date('H:i:s');

$producttype_arr = $_POST['producttype'];
if(is_array($producttype_arr))
{
    $ProductType = implode(",",$producttype_arr);
}
else
{
    $ProductType = $producttype_arr;
}

$sql = "Name='$name',PhoneNumber='$phonenumber',CompanyName='$companyname',Register='Yes',Campaign='$campaign',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',ProductType='$ProductType' WHERE ID='$sign_up_id'";
$result = _UpdateTableRecords($conn,'sign_up',$sql);

$where = " Where ID = $sign_up_id";
$user_details = _getTableDetails($conn,"sign_up", $where);

$mail_data['action'] = "Test";
$mail_data['Name'] = $name;
$mail_data['Email'] = $user_details['Email'];
$mail_data['PhoneNumber'] = $phonenumber;
$mail_data['CompanyName'] = $companyname;
$mail_data['Campaign'] = $campaign;
$mail_data['Product_Type'] = $ProductType;
$mail_data['Sign_Up_Id'] = $sign_up_id;

sendMailRequest($mail_data);


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