<?php

require_once('../../include/autoloader.inc.php');
require '../../project-assets/PHPMailer-master/src/Exception.php';
require '../../project-assets/PHPMailer-master/src/PHPMailer.php';
require '../../project-assets/PHPMailer-master/src/SMTP.php';

$data_raw = file_get_contents('php://input');
$data = json_decode($data_raw, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $paymentLink = $_POST['paymentLink'];

    // Check if email and payment link are provided
    if (empty($email) || empty($paymentLink)) {
        echo json_encode(['errorp' => true, 'message' => 'Email or Payment Link missing']);
        exit;
    }

    try {
        require ('../../mail/mail-config.php'); 

        // Common Header
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
       $welcome_subject = "Welcome to United Health Lumina  Your Partner in Seamless Healthcare!";

                    $welcome_body = $header_top . "<table style='width:100%; padding:20px; font-family: Arial, sans-serif; background-color: #f9f9f9; border: 1px solid #e0e0e0; border-radius: 10px;'>
                        <tr><td style='padding: 20px; text-align:left; font-size:16px; color:#333;'>
                            <h1 style='text-align:center; color:#007bff; font-size:24px;'>Welcome to United Health Lumina</h1>
                            <h2 style='text-align:center; color:#555; font-size:18px;'>Your Partner in Seamless Healthcare</h2>
                            <hr style='border:0; height:1px; background:#e0e0e0; margin:20px 0;'>
                            <p>Dear Sir/Mam,</p>
                            <p style='font-size:16px; line-height:1.6; color:#555;'>
                                Thank you for choosing United Health Lumina as your trusted partner for your healthcare needs. We are excited to have you on board and are committed to delivering exceptional healthcare solutions tailored to meet your unique requirements.
                            </p>
                            <p style='font-size:16px; line-height:1.6; color:#555;'>
                                At United Health Lumina, we prioritize your health and well-being by offering innovative, reliable, and patient-centric services.
                            </p>
                            <p style='font-size:16px; line-height:1.6; color:#555;'>
                                Stay connected with us as we continue to innovate and enhance your experience. Should you have any questions or need assistance, please feel free to reach out to our support team at <a href='mailto:support@unitedhealthlumina.com' style='color:#007bff; text-decoration:none;'>support@unitedhealthlumina.com</a>.
                            </p>
                            <p style='font-size:16px; line-height:1.6; color:#555;'>
                                Once again, welcome to the United Health Lumina family. Together, we aim to make healthcare simple, accessible, and effective for you.
                            </p>
                            <hr style='border:0; height:1px; background:#e0e0e0; margin:20px 0;'>
                            <p style='font-size:16px; text-align:center; color:#333;'>
                                Warm regards,<br>
                                <strong>United Health Lumina Team</strong>
                            </p>
                        </td></tr>
                    </table>". $mail_footer;


        $mail->addAddress($email);
        $mail->Subject = $welcome_subject;
        $mail->Body = $welcome_body;

        if (!$mail->send()) {
            throw new Exception('Failed to send Welcome Email: ' . $mail->ErrorInfo);
        }

        // Reset mail settings for the next email
        $mail->clearAddresses();
        $mail->clearAttachments();

        // Payment Link Email
        $payment_subject = "Activate Your Health Plan Today!";

                $payment_body = $header_top ."<table style='width:100%; padding:20px; font-family: Arial, sans-serif; background-color: #f9f9f9; border: 1px solid #e0e0e0; border-radius: 10px;'>
                    <tr><td style='padding: 20px; text-align:left; font-size:16px; color:#333;'>
                        <h1 style='text-align:center; color:#007bff; font-size:24px;'>Activate Your Health Plan Today!</h1>
                        <h2 style='text-align:center; color:#555; font-size:18px;'>Start Your Journey Toward Better Health</h2>
                        <hr style='border:0; height:1px; background:#e0e0e0; margin:20px 0;'>
                        <p style='font-size:16px; line-height:1.6; color:#555;'>
                            We are excited to help you take the next step toward a healthier tomorrow! Your Health Plan is just a click away. With this plan, you’ll enjoy seamless access to outpatient care services designed to support your health and well-being.
                        </p>
                        <p style='font-size:16px; line-height:1.6; color:#555;'>
                            Getting started is easy! Simply click the button below to make your payment and activate your subscription:
                        </p>
                        <p style='text-align:center;'>
                            <a href='" . $paymentLink . "' style='display:inline-block; padding:15px 30px; background-color:#4CAF50; color:#fff; text-decoration:none; font-size:16px; border-radius:5px;'>Make Payment</a>
                        </p>
                        <p style='font-size:16px; line-height:1.6; color:#555;'>
                            Start your journey toward better health today. If you have any questions or need assistance, our support team is here to help — just reply to this email or contact us at <a href='mailto:support@unitedhealthlumina.com' style='color:#007bff; text-decoration:none;'>support@unitedhealthlumina.com</a>.
                        </p>
                        <p style='font-size:16px; line-height:1.6; color:#555;'>
                            Thank you for choosing United Health Lumina. We look forward to being a part of your health and wellness journey.
                        </p>
                        <hr style='border:0; height:1px; background:#e0e0e0; margin:20px 0;'>
                        <p style='font-size:16px; text-align:center; color:#333;'>
                            Warm regards,<br>
                            <strong>United Health Lumina Team</strong>
                        </p>
                    </td></tr>
                </table>" . $mail_footer;

        $mail->addAddress($email);
        $mail->Subject = $payment_subject;
        $mail->Body = $payment_body;

        if (!$mail->send()) {
            throw new Exception('Failed to send Payment Link Email: ' . $mail->ErrorInfo);
        }

        // If both emails are sent successfully
        echo json_encode(['errorp' => false, 'message' => 'Both emails sent successfully']);

    } catch (Exception $e) {
        echo json_encode(['errorp' => true, 'message' => 'Mailer Error: ' . $e->getMessage()]);
    }
}
?>
