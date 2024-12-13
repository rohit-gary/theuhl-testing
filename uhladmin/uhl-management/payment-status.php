<?php
@session_start();
require_once('../include/autoloader.inc.php');
    $dbh = new Dbh();
        $core = new Core();
        $conn = $dbh->_connectodb();
        $IMSSetting = new IMSSetting($conn);
        $Programs = new Programs($conn);

// For Production 

$gateway = (object) [
    'token' => 'GOODLIFEFACIONLINE',
    'secret_key' => 'a5cfe459-0fd3-4d96-b5a6-0454ab66ad43'
];

// for Developement

// $gateway = (object) [
//     'token' => 'SANDBOXTESTMID',
//     'secret_key' => '51778fc0-016b-48fe-b509-108277bfa5e2'
// ];



// Extract transaction ID from POST data
$orderId = $_POST['transactionId'];
// $orderId = "13032024120351800394-13";
// echo $orderId;


// Construct X-VERIFY header for status check
$encodeIn265 = hash('sha256', '/pg/v1/status/' . $gateway->token . '/' . $orderId . $gateway->secret_key) . '###1';

// Set headers for the status check request
$headers = [
    'Content-Type: application/json',
    'X-MERCHANT-ID: ' . $gateway->token,
    'X-VERIFY: ' . $encodeIn265,
    'Accept: application/json',
];

// Define PhonePe status check URL
// $phonePeStatusUrl = 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/'.$gateway->token.'/'.$orderId; // For Development
$phonePeStatusUrl = 'https://api.phonepe.com/apis/hermes/pg/v1/status/' . $gateway->token . '/' . $orderId; // For Production

// Initialize cURL for status check
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $phonePeStatusUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

// Decode the status check response
$api_response = json_decode($response);
// var_dump($api_response);
// echo "hello";


$parts  = explode("-",$api_response->data->merchantTransactionId);
$BookingID = $parts[1];
$TransactionID = $api_response->data->merchantTransactionId;
$TotalAmount = $api_response->data->amount/100;

$payment_success = false;
// echo $api_response->code;
// die();
if ($api_response->code == "PAYMENT_SUCCESS") {
    // Insert payment details into your database
    // echo "hello";

    $payment_success = true;
    $update_param = " TransactionID = '$TransactionID', PaymentStatus = 'Paid' where ID = '".$BookingID."'";
    // echo $update_param;
	$response = $core->_UpdateTableRecords($conn,'confirm_booking',$update_param);
    
    $booking_details = getOneBookingData($conn,$BookingID);

    $phonenumber = $booking_details['Phone'];
    $name = $booking_details['Name'];
    $Service = $booking_details['Service_name'];
    $SubService = $booking_details['SubService'];  
    $BookingDate = $booking_details['BookingDate'];
    $customer_address = $booking_details['Customer_address'];
    $location_landmark = $booking_details['Location_landmark'];
    $BookingNumber = $booking_details['BookingID'];
    $body_values = '["'.$name.'","'.$TransactionID.'","'.$BookingNumber.'","'.$Service.'","'.$SubService.'","'.$customer_address.$location_landmark.'","'.$phonenumber.'","'.$BookingDate.'"]';
    if($phonenumber != "")
    {
        $data['phonenumber'] = $phonenumber;
        $data['body_values'] = $body_values;
        $data['template'] = "glf_cus_bkg_pay_confirm_v1";
        _interakt_sendWhatsAppMessage_common($data);
    }
    /*$phonenumber = "+91".$phonenumber;
    $message = "Dear $name,\n\nWe are thrilled to inform you that your booking with GoodLifeFacilities has been successfully completed!\n\nThank you for choosing us for your $Service. We are committed to providing you with the best possible experience and look forward to serving you.\n\nIf you have any questions or need further assistance, please do not hesitate to contact us at 1800-120-1343.\n\nWe appreciate your trust in GoodLifeFacilities and are excited to assist you.\n\nRegards,\nGoodLifeFacilities";
    sendWhatsAppMessage($phonenumber,$message);*/
}else{
    $update_param = "  PaymentStatus = 'Failed' where ID = '".$UserId."'";
    // echo $update_param;
	$response = $core->_UpdateTableRecords($conn,'confirm_booking',$update_param);
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Payment Status - GoodLifeFacilities</title>
    <style>
    .logo {
        width: 100px;
        display: block;
    }

    .logo img {
        width: 100%;
    }

    header {
        background: #366dac;
        padding: 10px 0px;
    }

    .mail-seccess {
        text-align: center;
        background: #fff;
    }


    .mail-seccess .success-inner {
        display: inline-block;
    }

    .mail-seccess .success-inner h1 {
        font-size: 100px;
        text-shadow: 3px 5px 2px #3333;
        color: #006DFE;
        font-weight: 700;
    }

    .mail-seccess .success-inner h1 span {
        display: block;
        font-size: 25px;
        color: #333;
        font-weight: 600;
        text-shadow: none;
        margin-top: 20px;
    }

    .mail-seccess .success-inner p {
        padding: 20px 15px;
    }

    .mail-seccess .success-inner .btn {
        color: #fff;
    }

    @media only screen and (max-width:767px) {
        .logo {
            width: 100px;
            display: block;
            margin: auto;
        }
    }
    </style>
    <?php include("includes/links.php"); ?>
</head>

<body>

    <?php include('includes/newheader.php') ?>

    <?php if($payment_success){?>
    <section class="mail-seccess section">
        <div class="container p-0">
            <div class="row justify-content-center">
                <div class="col-lg-6  col-12">
                    <!-- Error Inner -->
                    <div class="success-inner">
                        <img width="150px" src="https://omcardrivers.in/portal/project-assets/images/check.png">
                        <h1><span>Your Payment has been Successfully Transfered!</span></h1>
                        <p>If Any Quiry Realated Your Booking Please Let us Know. You will soon receive the message on
                            your whatsapp.</p>
                    </div>
                    <!--/ End Error Inner -->
                </div>
            </div>
        </div>
    </section>
    <?php }else{ ?>
    <section class="mail-seccess section">
        <div class="container p-0">
            <div class="row justify-content-center">
                <div class="col-lg-6  col-12">
                    <!-- Error Inner -->
                    <div class="success-inner">
                        <img width="150px" src="https://omcardrivers.in/portal/project-assets/images/cross.png">
                        <h1><span>Your Payment has been Failed !</span></h1>
                        <p>Please Contact GoodLifeFacilities Help Line Number - 1800-120-1343.</p>
                    </div>
                    <!--/ End Error Inner -->
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php include("includes/footer.php"); ?>
    <?php include("includes/scripts.php"); ?>

</body>

</html>