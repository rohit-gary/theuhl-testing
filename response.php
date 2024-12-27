<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('uhladmin/uhl-management/include/autoloader.inc.php');
include("uhladmin/uhl-management/include/db-connection.php");

$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();

include("includes/links.php");
include("includes/meta.php");
include("gateway-config.php");
$policy = new PolicyCustomer($conn);
$response = [];
$postdata = $_POST;
$msg = '';
$status = '';


if (isset($postdata['key'])) {
    $key                = $postdata['key'];
    $txnid              = $postdata['txnid'];
    $amount             = $postdata['amount'];
    $productInfo        = $postdata['productinfo'];
    $firstname          = $postdata['firstname'];
    $email              = $postdata['email'];
    $udf5               = $postdata['udf5']; 
    $policyNumber       = $postdata['udf1'];  
    $status             = $postdata['status'];
    $resphash           = $postdata['hash'];
    
    $keyString          = $key . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' . $firstname . '|' . $email . '|'.$postdata['udf1'].'||||' . $udf5 . '|||||';
    $keyArray           = explode("|", $keyString);
    $reverseKeyArray    = array_reverse($keyArray);
    $reverseKeyString   = implode("|", $reverseKeyArray);
    $CalcHashString     = strtolower(hash('sha512', $salt . '|' . $status . '|' . $reverseKeyString)); 

    $additionalCharges  = "";
    
    if (isset($postdata["additionalCharges"])) {
        $additionalCharges = $postdata["additionalCharges"];
        $CalcHashString    = strtolower(hash('sha512', $additionalCharges . '|' . $salt . '|' . $status . '|' . $reverseKeyString));
    }
    
    if ($status == 'success' && $resphash == $CalcHashString) {
        $msg = "Transaction Successful, Hash Verified.";
        $response['error'] = false;
        $response['message'] = $msg;

        if (verifyPayment($key, $salt, $txnid, $status)) {
            $msg = "Transaction Successful, Hash Verified. Payment Verified.";
            $response['message'] = $msg;
        } else {
            $msg = "Transaction Successful, Hash Verified. Payment Verification failed.";
            $response['message'] = $msg;
        }
    } else {
        $msg = "Payment failed for Hash not verified.";
        $response['error'] = true;
        $response['message'] = $msg;
    } 
}
else exit(0);



function verifyPayment($key,$salt,$txnid,$status)
{
    $command = "verify_payment"; //mandatory parameter
    
    $hash_str = $key  . '|' . $command . '|' . $txnid . '|' . $salt ;
    $hash = strtolower(hash('sha512', $hash_str)); //generate hash for verify payment request

    $r = array('key' => $key , 'hash' =>$hash , 'var1' => $txnid, 'command' => $command);
        
    $qs= http_build_query($r);
    // for production
    // $wsUrl = "https://info.payu.in/merchant/postservice.php?form=2";
   
    //for test
    $wsUrl = "https://test.payu.in/merchant/postservice.php?form=2";
    
    try 
    {       
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $wsUrl);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSLVERSION, 6); //TLS 1.2 mandatory
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        $o = curl_exec($c);
        if (curl_errno($c)) {
            $sad = curl_error($c);
            throw new Exception($sad);
        }
        curl_close($c);
        $response = json_decode($o,true);
        
        if(isset($response['status']))
        {
            // response is in Json format. Use the transaction_detailspart for status
            $response = $response['transaction_details'];
            $response = $response[$txnid];
            
            if($response['status'] == $status) //payment response status and verify status matched
                return true;
            else
                return false;
        }
        else {
            return false;
        }
    }
    catch (Exception $e){
        return false;   
    }
}
// echo json_encode($response);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status - United Health Lumina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .success {
            color: #28a745;
            font-weight: bold;
        }
        .error {
            color: #dc3545;
            font-weight: bold;
        }
        .errmsg {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="form-container">
                    <h1 class="text-center">Payment Status</h1>
                    <hr>
                    <div class="text-center">
                        <?php
                        if ($status == 'success' && $resphash == $CalcHashString && $txnid != '') {
                            $subject = 'Thank You, Your payment has been successful.';
                             $data['razorpayPaymentId']=$txnid;
                                $data['razorpayOrderId']=$txnid;
                                $data['amount']=$amount;
                                $data['name']=$firstname;
                                $data['phone']=$postdata['phone'];
                                $data['policyID']='-1';
                                $data['policyNumber']=$policyNumber;
                               $response= $policy->insertPolicyPaymentData($data);

                            echo '<h2 class="success">' . $subject . '</h2><hr>';
                              echo "<script>
                                    setTimeout(function(){
                                        window.location.href = 'all-plans';
                                    }, 5000); // 5000 milliseconds = 5 seconds
                                  </script>";
                        } else {
                            echo "<p><div class='errmsg'>Invalid Transaction. Please Try Again</div></p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>