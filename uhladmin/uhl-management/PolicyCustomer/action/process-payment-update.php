<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$core = new Core();
$core->setTimeZone();
$PolicyDetails_obj = new PolicyCustomer($conn);

$response = ['error' => true, 'message' => "Some Technical Error! Please Try Again."]; // Default response

if (isset($_POST['policy_id'])) {
    $data = $_POST;    
    // Initialize the Transaction object
    $Transaction_obj = new Transaction($conn);
    $policyNumber=$data['policy_id'];
    $PolicyDetails = $PolicyDetails_obj->getPolicyCustomerDetailsByPolicyNumber($policyNumber);
    $response = $Transaction_obj->insertPaymentsDetails($data); 

    // var_dump($response);
    // die();
    if ($response['error'] == false) {
        $response['message'] = "Payment Details Saved!";
        $response['error'] = false;

   if ($PolicyDetails) {
                        
                       $customer = $PolicyDetails;
                       $postdata = 
                       [
                        'email' => $customer['Email'],
                        'name' => $customer['UserName'],
                        'policyNumber' => $customer['PolicyNumber'],
                        'amount' => $data['amount'],
                        'phonenumber'=>$data['phone'],
                        'paymentStatus' => $data['status']
                      ];
                            
                            // Call the sendEmail function to send the email
                           //    $responsemail=$policy->sendEmail($postdata);

                      $conf_new = new Configuration();
                      $conf_new->SetGenerateReportURL();
                      $core = new Core();
                      $data_api["PolicyNumber"] = $customer['PolicyNumber'] ;
                      $core->sendCurlRequest($postdata,$conf_new->generate_report_url);
                      $response['message'] = "Policy Doc pdf has Generated";
             }else {
                echo "Customer details not found for the policy.";
            }
    } else {
        $response['message'] = isset($response['message']) ? $response['message'] : "Some error occurred while saving the payment details.";
    }
}

// Output the response as JSON
echo json_encode($response);
?>
