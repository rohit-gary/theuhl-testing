<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");

include '../uhladmin/uhl-management/controllers/common_controller.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $core=new Core();
    $name= $core->cleantext($_POST['needformName']);
    $contact_number= $core->cleantext($_POST['needformMobile']);
    $plan= $core->cleantext($_POST['planSelect']);

    require('include/mail-config.php');

    $header_top = "";
    $mail_footer = "";

       $sql = "INSERT INTO `enquiry_form` (`Name`, `MobileNumber`, `Plan`)
                             VALUES ('$name', '$contact_number', '$plan')";

             $response_insert_user= $core->_InsertTableRecords($conn, $sql);

$mail->Subject  = 'Thank You For Your Enquiry';
$body_middle = "
<h4>Your Enquiry Details</h4>
<p>Name : $name</p>        
<p>Phone: $contact_number</p>  
<p>Plan:$plan</p>
<br>
<h4>Regards,</h4>
<h4>United Health Lumina</h4>
<img src='https://unitedhealthlumina.com/project-assets/images/uhlnewlogo.png' style=\"height:40px; width:auto;\">";

$mail->Body = $header_top.$body_middle;
$mail->addAddress('rohitmaurya.gary@gmail.com');
$mail->addAddress('support@unitedhealthlumina.com');
$mail->addBCC('pgfiry@gmail.com', 'United Health Lumina');
        

if(!$mail->send())
{

    $enrollment_response['error'] = true;
    $enrollment_response['message'] = "There is some technical error right now. Our technical team is working on it to get the services back. Thank you for your patience.";
    
    
}
else
{

    $enrollment_response['error'] = false;
    $enrollment_response['message'] = "Thank you for your Enquiry ! we will connect with you as soon as possible.";
}

}

echo json_encode($enrollment_response);
?>