<?php

                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                 require_once('../include/autoloader.inc.php');
                include("../include/db-connection.php");
                // include '../../controllers/common_controllers.php';
                require '../project-assets/PHPMailer-master/src/Exception.php';
                require '../project-assets/PHPMailer-master/src/PHPMailer.php';
                require '../project-assets/PHPMailer-master/src/SMTP.php';
                 require ('./mail-config.php'); 
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);

                if (!isset($data['email']) || !isset($data['password'])) {
                    echo json_encode(['error' => true, 'message' => 'Required fields are missing.']);
                    exit;
                }


                if ($data['email']) {
                   
                    $email = $data['email'];
                } else {
                    echo 'Required POST data is missing.';
                    exit;
                }

                $password = $data['password'];
    

    

         // Include the mail configuration
       
        $header_top = "<table style='width:100%; background-color:#f7f7f7; padding:20px;'><tr><td style='text-align:center;'>
                        <img src='https://unitedhealthlumina.com/uhl/project-assets/images/uhlnewlogo.png' alt='United Health Lumina' style='max-width:150px;'>
                    </td></tr></table>";

        $mail_footer = "<table style='width:100%; background-color:#f7f7f7; padding:20px;'>
                        <tr><td style='text-align:center; font-size:12px; color:#888;'>This email is automatically generated. For support, contact us at <a href='mailto:support@unitedhealthlumina.com'>support@unitedhealthlumina.com</a>.</td></tr>
                    </table>";

        // Set up the subject and body content of the email
            $mail->Subject = 'Welcome to United Health Lumina as a Channel Partner!';

            $body_middle = "
                    <h4 style='font-family: Arial, sans-serif; color:#333;'>Dear,</h4>
                    <p style='font-family: Arial, sans-serif; color:#555;'>Welcome to <strong>United Health Lumina</strong>! We are thrilled to have you as a Channel Partner.</p>
                    <p style='font-family: Arial, sans-serif; color:#555;'>Here are your login credentials:</p>
                    <table style='width:100%; border:1px solid #ddd; border-collapse: collapse;'>
                        <tr>
                            <th style='text-align:left; padding:8px;'>Login Email</th>
                            <td style='padding:8px;'>$email</td>
                        </tr>
                        <tr>
                            <th style='text-align:left; padding:8px;'>Password</th>
                            <td style='padding:8px;'>$password</td>
                        </tr>
                    </table>
                    <p style='font-family: Arial, sans-serif; color:#555;'>You can log in to your partner portal at: <a href='https://yourportal.com/login'>https://unitedhealthlumina.com/admin/authentication/login</a></p>
                    <p style='font-family: Arial, sans-serif; color:#555;'>If you have any questions or need assistance, please feel free to contact us.</p>
                    <h4 style='font-family: Arial, sans-serif; color:#333;'>Best Regards,</h4>
                    <h4 style='font-family: Arial, sans-serif; color:#333;'>United Health Lumina</h4>
                    <img src='https://unitedhealthlumina.com/uhl/project-assets/images/uhlnewlogo.png' alt='United Health Lumina' style='max-width:150px;'>
                    ";

        // Set the email body content
        $mail->Body = $header_top . $body_middle . $mail_footer;
        $mail->addAddress($email);  // Send to the customer

        // Add admin notifications as BCC
        $mail->addBCC('support@unitedhealthlumina.com');
        // $mail->addBCC('support@yourcompany.com');

        if(!$mail->send()) {
            $enrollment_response['error'] = true;
            $enrollment_response['message'] = "There is some technical error right now. Our technical team is working on it to get the services back. Thank you for your patience.";
        } 
           
        

    



?>
