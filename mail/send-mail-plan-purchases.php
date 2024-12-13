<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhl-management/include/autoloader.inc.php');
include("../../uhl-management/include/db-connection.php");
$plans = new Plans($conn);
include '../../controllers/common_controllers.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['name'], $data['email'], $data['policyNumber'], $data['amount'], $data['paymentStatus'], $data['PlanID'])) {
    $name = cleantext($data['name']);
    $email = cleantext($data['email']);
    $policyNumber = cleantext($data['policyNumber']);
    $amount = cleantext($data['amount']);
    $paymentStatus = cleantext($data['paymentStatus']);
    $PlanID = $data['PlanID'];
} else {
    echo 'Required POST data is missing.';
    exit;
}

// Check if payment is successful
if ($paymentStatus && $paymentStatus == 'Success') {
    // Include the mail configuration
    require ('include/mail-config.php'); 

    $planDetails = $plans->GetPlanDetailsbyID($PlanID); 
    $planName = $planDetails[0]['PlanName'];
    $planHighlights = $planDetails[0]['PlanHighlights'];

    // Header and footer for the emails
    $header_top = "<table style='width:100%; background-color:#f7f7f7; padding:20px;'><tr><td style='text-align:center;'>
                    <img src='https://unitedhealthlumina.com/uhl/project-assets/images/uhlnewlogo.png' alt='United Health Lumina' style='max-width:150px;'>
                </td></tr></table>";

    $mail_footer = "<table style='width:100%; background-color:#f7f7f7; padding:20px;'>
                    <tr><td style='text-align:center; font-size:12px; color:#888;'>This email is automatically generated. For support, contact us at <a href='mailto:support@unitedhealthlumina.com'>support@unitedhealthlumina.com</a>.</td></tr>
                </table>";

    // Set up the subject and body content of the first (confirmation) email
    $mail->Subject  = 'Confirmation of Your Health Plan Purchase and Payment';

    // Body for confirmation email
    $body_middle = "
    <h4 style='font-family: Arial, sans-serif; color:#333;'>Dear $name,</h4>
    <p style='font-family: Arial, sans-serif; color:#555;'>Thank you for choosing the <strong>$planName</strong> with <strong>United Health Lumina</strong>! We are pleased to confirm that your purchase and payment have been successfully processed.</p>
    
    <h4 style='font-family: Arial, sans-serif; color:#333;'>Here are the details of your purchase:</h4>
    <table style='width:100%; border:1px solid #ddd; border-collapse: collapse;'>
        <tr style='background-color:#f4f4f4;'>
            <th style='text-align:left; padding:8px;'>Health Plan</th>
            <td style='padding:8px;'>$planName</td>
        </tr>
        <tr style='background-color:#f4f4f4;'>
            <th style='text-align:left; padding:8px;'>Policy Number</th>
            <td style='padding:8px;'>$policyNumber</td>
        </tr>
        <tr style='background-color:#f4f4f4;'>
            <th style='text-align:left; padding:8px;'>Payment Amount</th>
            <td style='padding:8px;'>₹ $amount</td>
        </tr>
    </table>

    <h4 style='font-family: Arial, sans-serif; color:#333;'>Plan Benefits:</h4>
    <div style='font-family: Arial, sans-serif; color:#555;'>$planHighlights</div>

    <br>
    <p style='font-family: Arial, sans-serif; color:#555;'>If you have any questions or need assistance, please feel free to contact us.</p>

    <h4 style='font-family: Arial, sans-serif; color:#333;'>Best Regards,</h4>
    <h4 style='font-family: Arial, sans-serif; color:#333;'>United Health Lumina</h4>
    <img src='https://unitedhealthlumina.com/uhl/project-assets/images/uhlnewlogo.png' alt='unitedhealthlumina' style='max-width:150px;'>
    ";

    // Set the email body content for the confirmation email
    $mail->Body = $header_top . $body_middle . $mail_footer;
    $mail->addAddress($email);  // Send to the customer

    // Add admin notifications as BCC
    $mail->addBCC('support@unitedhealthlumina.com');

    // Attach file (only in the first email)
    $File_Path = $data['FilePath'];
    $Main_File_Path = "../../uhl-management/service-reports/service-report-pdf/$File_Path";
    $mail->addAttachment($Main_File_Path, $File_Path);
    
    if (!$mail->send()) {
        $enrollment_response['error'] = true;
        $enrollment_response['message'] = "There is some technical error right now. Our technical team is working on it to get the services back. Thank you for your patience.";
    } else {
        $enrollment_response['error'] = false;
        $enrollment_response['message'] = "Thank you for your purchase! We will connect with you as soon as possible.";
    }

    // Send the second (structured) email without an attachment
    $mail->clearAddresses(); // Clear previous recipient
    $mail->Subject = 'Your Health Plan Notification'; // Set the subject of the second email

    // Set the body content for the structured notification email
    $existing_body = "
    <table style='width:100%; background-color:#f7f7f7; padding:30px; font-family: Arial, sans-serif;'>
        <tr>
            <td style='text-align:center;'>
                <img src='https://unitedhealthlumina.com/uhl/project-assets/images/uhlnewlogo.png' alt='United Health Lumina' style='max-width:150px;'>
            </td>
        </tr>
        <tr>
            <td style='padding:20px; text-align:center;'>
                <h2 style='color:#333;'>Welcome to United Health Lumina!</h2>
                <p style='color:#555;'>Your Health Plan purchase has been successfully processed. Here are your plan details:</p>
            </td>
        </tr>
        <tr style='background-color:#f4f4f4;'>
            <td style='padding:15px;'>
                <h4 style='color:#333;'>Plan Summary:</h4>
                <table style='width:100%; border:1px solid #ddd; border-collapse: collapse;'>
                    <tr>
                        <th style='text-align:left; padding:8px;'>Health Plan</th>
                        <td style='padding:8px;'>$planName</td>
                    </tr>
                    <tr>
                        <th style='text-align:left; padding:8px;'>Policy Number</th>
                        <td style='padding:8px;'>$policyNumber</td>
                    </tr>
                    <tr>
                        <th style='text-align:left; padding:8px;'>Payment Amount</th>
                        <td style='padding:8px;'>₹ $amount</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style='padding:20px; text-align:center;'>
                <p style='color:#555;'>You will receive further updates about your health plan soon. If you have any questions or need support, feel free to contact us anytime.</p>
                <h4 style='color:#333;'>Best Regards,</h4>
                <h4 style='color:#333;'>United Health Lumina Team</h4>
            </td>
        </tr>
        <tr style='background-color:#f7f7f7;'>
            <td style='text-align:center; font-size:12px; color:#888; padding:20px;'>
                This email is automatically generated. For support, contact us at <a href='mailto:support@unitedhealthlumina.com'>support@unitedhealthlumina.com</a>.
            </td>
        </tr>
    </table>";

    $mail->Body = $existing_body;
    $mail->addAddress($email);  // Send to the customer

    if (!$mail->send()) {
        $enrollment_response['error'] = true;
        $enrollment_response['message'] = "There is some technical error with the second email. Our technical team is working on it.";
    }

} else {
    $enrollment_response['error'] = true;
    $enrollment_response['message'] = "Payment was not successful. Please check your payment status.";
}

echo json_encode($enrollment_response);
?>
