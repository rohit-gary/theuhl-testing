<?php
require_once('common_api_header.php');
require_once('../include/autoloader.inc.php');
$data_raw = file_get_contents('php://input');
$data = json_decode($data_raw,true);
require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';
$logs = new Logs();
$logs->SetCurrentMailLogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$core = new Core();
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();                      // Set mailer to use SMTP
$mail->Host = 'mail.digitalworkdesk.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contact@digitalworkdesk.com';                  // SMTP info@cyphertextsolutions.com username
$mail->Password = 'Contact@123!';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->setFrom('contact@digitalworkdesk.com', "Service Report");
$mail->isHTML(true);


if($data['action'] == "General Service Report")
{
	$SiteName = "N.A";
    if(isset($data['SiteName'])){
		$SiteName = $data['SiteName'];
	}
	
	$POCEmail = "";
	if(isset($data['POCEmail'])){
		$POCEmail = $data['POCEmail'];
	}

	$ClientRepresentativeEmails = "";
	if(isset($data['ClientRepresentativeEmails']))
	{
		$ClientRepresentativeEmails = $data['ClientRepresentativeEmails'];
	}
	$ZoneEmail = "";
	if(isset($data['ZoneEmail']))
	{
		$ZoneEmail = $data['ZoneEmail'];
	}

    $POCName = "N.A";
    if(isset($data['POCName'])){
		$POCName = $data['POCName'];
	}

    $ReportID = "N.A";
    if(isset($data['ReportID'])){
		$ReportID = $data['ReportID'];
	}

    $File_Path = $data['FilePath'];
    $Main_File_Path = "../service-reports/service-report-pdf/$File_Path";
	$HelpdeskComplaintNumber = "RPM";
	if(isset($data['Helpdesk_ComplaintNumber']))
	{
		$HelpdeskComplaintNumber = $data['Helpdesk_ComplaintNumber'];
	}

	$mail->Subject  = "[".$HelpdeskComplaintNumber."]RPM Service Report Generated for $SiteName";
	$body_middle = "
	<p style='margin-top:0px;'>Dear $POCName,</p>

	<p>Field service report has been generated. Please find attached the service report.</p>
	<br>
	<h4 style='margin:0px;'>Regards,</h4>
	<h4 style='margin:0px;'>Team RPM Enterprises</h4>
	";
	$mail->Body = $body_middle;
	if(strpos($ClientRepresentativeEmails, ',') !== false) 
	{
	 	$cr_emails_array = explode(",", $ClientRepresentativeEmails); 
	 	foreach($cr_emails_array as $cr_email)
	 	{
	 		$mail->addAddress($cr_email);
	 	}
	} 
	else 
	{
	    $mail->addAddress($ClientRepresentativeEmails);
	}
	if(strpos($ZoneEmail, ',') !== false) 
	{
	 	$zone_emails_array = explode(",", $ZoneEmail); 
	 	foreach($zone_emails_array as $zone_email)
	 	{
	 		$mail->addAddress($zone_email);
	 	}
	} 
	else 
	{
	    $mail->addAddress($ZoneEmail);
	}
	if($POCEmail != "")
	{
		$mail->addAddress($POCEmail);
	}
	$mail->addBCC("prateek@garyglobalsolutions.com");
    $mail->addAttachment($Main_File_Path, $File_Path); 
}



if(!$mail->send())
{
	// echo "error";
}
else
{
	// echo "Mail Sent";
}
?>