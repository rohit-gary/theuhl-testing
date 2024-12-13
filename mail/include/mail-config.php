<?php
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();                      // Set mailer to use SMTP
$mail->Host = 'smtp.zoho.in';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication

$mail->Username = 'contact@unitedhealthlumina.com';                  // SMTP username
$mail->Password = 'Contact@1234!';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->setFrom('contact@unitedhealthlumina.com', "United Health Lumina");
$mail->isHTML(true);
?>
