<?php
// var_dump($_POST);   
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();
require_once('../include/autoloader.inc.php');
include("../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();
$policycustomer_obj = new PolicyCustomer($conn);
$Transaction_obj = new Transaction($conn);
if (isset($_GET['PolicyNumber'])) {
$policyNumber=$_GET['PolicyNumber'];
$PolicyDetails= $policycustomer_obj->getPolicyCustomerDetailsByPolicyNumber($policyNumber);
$Transaction= $Transaction_obj-> GetAllTransactionByPolicyNumber($policyNumber);

$response=[];

if ($Transaction) {
            $customer = $PolicyDetails; // Assuming the first result is the correct customer
            
           $postdata = [
                'email' => $customer['Email'],
                'name' => $customer['UserName'],
                'policyNumber' => $customer['PolicyNumber'],
                'amount' => $customer['TotalAmount'],
                'phonenumber'=>$customer['MobileNumber'],
                'paymentStatus' => $Transaction[0]['status']
            ];
    
          $conf_new = new Configuration();
          $conf_new->SetGenerateReportURL();
           $core = new Core();
           $data_api["PolicyNumber"] = $customer['PolicyNumber'] ;
           
           $core->sendCurlRequest($postdata,$conf_new->generate_report_url);
           $response['message'] = "Policy Doc pdf has been sent to email";
            $response['error'] = false;
        } else {
             $response['error'] = true;
             $response['message'] = "Transaction Details Not For This Policy Number";
        }

}
     echo json_encode($response);

?>
