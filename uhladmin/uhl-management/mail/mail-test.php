<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
require_once('../include/autoloader.inc.php');
require '../project-assets/PHPMailer-master/src/Exception.php';
require '../project-assets/PHPMailer-master/src/PHPMailer.php';
require '../project-assets/PHPMailer-master/src/SMTP.php';
 require ('mail-config.php'); 
 $mail->SMTPDebug = 2;

$header_top = "<table style='width:100%; background-color:#f7f7f7; padding:20px;'>
                        <tr><td style='text-align:center;'>
                            <img src='https://unitedhealthlumina.com/uhl/project-assets/images/uhlnewlogo.png' alt='United Health Lumina' style='max-width:150px;'>
                        </td></tr>
                      </table>";

        // Payment Email Footer
 $mail_footer = "
         <table style='width:100%; background-color:#f7f7f7; padding:0; margin:0; border-spacing:0; border-collapse:collapse;'>
             <tr>
                 <td style='padding:0; margin:0;'>
                     <img src='https://unitedhealthlumina.com/uhl/project-assets/images/email.png' alt='United Health Lumina' style='width:100%; display:block; height:auto;'>
                 </td>
             </tr>
         </table>";

        // Welcome Email
$welcome_subject = "Welcome to United Health Lumina!";
$welcome_body = $header_top . "<table style='width:100%; padding:20px;'>
                            <tr><td style='text-align:center; font-size:18px; color:#333;'>
                                <b>Welcome to United Health Lumina!</b><br><br>
                                Thank you for choosing us for your healthcare needs.<br><br>
                                Stay connected with us for seamless healthcare solutions.
                            </td></tr>
                         </table>";

$mail->addAddress("pgfiry@gmail.com");
$mail->Subject = $welcome_subject;
$mail->Body = $welcome_body;

if (!$mail->send()) {
    echo 'Failed to send Welcome Email: ' . $mail->ErrorInfo;
}
else
{
	echo "Mail Sent";
}

// Reset mail settings for the next email
$mail->clearAddresses();
$mail->clearAttachments();

?>