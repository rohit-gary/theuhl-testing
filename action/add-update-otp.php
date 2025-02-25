<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");
require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/controllers/common_controller.php");
	if(isset($_POST['MobileNumber']))
	{
		$length = 4;
    $otp = '';
			for ($i = 0; $i < $length; $i++) {  
					$otp .= rand(0, 9);
			}

		$CMUsers_obj = new CMUsers($master_conn);
		$OTP= $otp;
		$MobileNumber=$_POST['MobileNumber'];        
        $response=$CMUsers_obj->UpdateUserOTP($OTP, $MobileNumber);	
        $wdata['phonenumber'] = $MobileNumber;
        $body_values = '["' . $OTP . '"]';
        $wdata['body_values'] = $body_values;
        // $wdata['template'] = "browse_userotp_whatsapp";
				$wdata['otp']=$OTP;
				$smsdata=array(
                		"variables_values" =>$OTP,
				    	"route" => "otp",
				    	"numbers" => $MobileNumber,
						);
    

        if($response['error']==false){
        	$response['error'] = false;
        	$response['message']='OTP Generated Successfully and Send to Your Registered Mobile Number';
        	sendMobileOTPWhatsapp($wdata);
        	sendSmsOtp($smsdata);
        }
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>