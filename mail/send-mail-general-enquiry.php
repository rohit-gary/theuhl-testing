<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../uhladmin/uhl-management/controllers/common_controllers.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $name= cleantext($_POST['name']);
    $contact_number= cleantext($_POST['contact_number']);
    $email= cleantext($_POST['email']);
    $you_are= cleantext($_POST['you_are']);
    $orginization_name= cleantext($_POST['orginization_name']);
    $message= cleantext($_POST['message']);

     require ('include/mail-config.php');

    $header_top = "";
    $mail_footer = "";



$mail->Subject  = 'Thank You For Your Enquiry';
$body_middle = "
<h4>Your Enquiry Details</h4>
<p>Name : $name</p>        
<p>Phone: $contact_number</p>  
<p>Plan: $orginization_name</p>          
<p>Message:$message</p>
<br>
<h4>Regards,</h4>
<h4>United Health Lumina</h4>
<img src='https://unitedhealthlumina.com/uhl/project-assets/images/uhlnewlogo.png'>";


$mail->Body = $header_top.$body_middle;
$mail->addAddress('rohitmaurya.gary@gmail.com');

$mail->addBCC('lifeapana@gmail.com');
        

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