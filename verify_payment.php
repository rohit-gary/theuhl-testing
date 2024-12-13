    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    require('../vendor/autoload.php');
    require_once('../uhl-management/include/autoloader.inc.php');
    include("../uhl-management/include/db-connection.php");

    $conf = new Conf();
    $dbh = new Dbh();
    $core = new Core();
    $masterconn = $dbh->_connectodb();
    $policy = new PolicyCustomer($conn);



    use Razorpay\Api\Api;


    $keyId = 'rzp_live_ByoIjLl32Tm8w1';
    $keySecret = 'QgIJaeh9XCDfQdJm2wAAC8z7';

    // $keyId = 'rzp_test_VHcUYxXlN9UYgv';
    // $keySecret = 'cBj7elTcBMqd3h3jIQXvvFE8';
    $api = new Api($keyId, $keySecret);

    // Decode the JSON payload from the request body
    $input = json_decode(file_get_contents('php://input'), true);


      $razorpayPaymentId = $input['razorpay_payment_id'];
        $razorpayOrderId = $input['razorpay_order_id'];
        $razorpaySignature = $input['razorpay_signature'];

        $amount = $input['amount'] ?? 0; 
        $name = $input['name'] ?? '';
        $phone = $input['phone'] ?? '';
        $policyID = $input['policyID'] ?? 0; 


            $data['razorpayPaymentId']=$razorpayPaymentId;
            $data['razorpayOrderId']=$razorpayOrderId;
            $data['razorpaySignature']= $razorpaySignature;
            $data['amount']=$amount;
            $data['name']=$name;
            $data['phone']=$phone;
            $data['policyID']=$policyID;

    try {
        $attributes = [
            'razorpay_order_id' => $razorpayOrderId,
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_signature' => $razorpaySignature
        ];

        $api->utility->verifyPaymentSignature($attributes);

        $response= $policy->insertPolicyPaymentData($data);

        if ($response && isset($response['last_insert_id'])) {
            $lastInsertedId = $response['last_insert_id'];
                     
            $paymentData= $policy->PolicyPaymetsDetailsByPaymentsId($lastInsertedId );
    
            
             if ($paymentData) {
               $PolicyDetails= $policy->getPolicyCustomerDetailsByPolicyID($paymentData[0]['policyID'] );
              
                if ($PolicyDetails) {
                            $customer = $PolicyDetails[0]; // Assuming the first result is the correct customer
                            
                           $postdata = [
                                'email' => $customer['Email'],
                                'name' => $customer['Name'],
                                'PlanID'=>$customer['PlanID'],
                                'policyNumber' => $customer['PolicyNumber'],
                                'amount' => $paymentData[0]['amount'],
                                'policyID'=>$customer['ID'],
                                'phonenumber'=>$customer['ContactNumber'],
                                'paymentStatus' => $paymentData[0]['status']
                            ];
                            
                            // Call the sendEmail function to send the email
                        //    $responsemail=$policy->sendEmail($postdata);

                           $conf_new = new Configuration();
                          $conf_new->SetGenerateReportURL();
                           $core = new Core();
                           $data_api["ID"] = $customer['ID'];
                           $core->sendCurlRequest($postdata,$conf_new->generate_report_url);
                           $response['message'] = "Policy Doc pdf has been sent to email";
                        } else {
                            echo "Customer details not found for the policy.";
                        }
               
            }else {
        echo "Payment details not found.";
    }
    
    
    
        }

        
        echo json_encode(['status' => 'success', 'message' => 'Payment verified successfully!']);
    } catch(\Razorpay\Api\Errors\SignatureVerificationError $e) {
        
        echo json_encode(['status' => 'failed', 'message' => 'Payment verification failed!']);
    }
    ?>
