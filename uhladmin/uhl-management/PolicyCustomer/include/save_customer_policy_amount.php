<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
include('../../controllers/common_controller.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if content-type is JSON
    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';

    // Initialize response
    $response = [
        'error' => true,
        'message' => '',
        'data' => []
    ];

    if (strpos($contentType, 'application/json') !== false) {
        // Decode JSON input
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['PolicyNumber']) && isset($data['Amount'])) {
            // Extract values from JSON data
            $PolicyNumber = $data['PolicyNumber'];
            $Amount = $data['Amount'];

            // Additional data for creation
            $data['CreatedTime'] = date('H:i:s');
            $data['CreatedDate'] = date('Y-m-d');
            $data['CreatedBy'] = $_SESSION['dwd_email'];

            // Prepare the policy data for insertion
            $policyData = [
                'PolicyNumber' => $PolicyNumber,
                'Amount' => $Amount,
                'CreatedDate' => $data['CreatedDate'],
                'CreatedTime' => $data['CreatedTime'],
                'CreatedBy' => $data['CreatedBy']
            ];

            // Assuming InsertPolicyAmountDetails handles the insertion


            $PolicyCustomer = new PolicyCustomer($conn);
            $response = $PolicyCustomer->InsertPolicyAmountDetails($policyData);
            $encodedPolicyNumber = base64_encode($PolicyNumber);
            $response['message'] = 'Policy amount details saved successfully.';
            $response['error'] = false;
            $response['PolicyNumber'] = $encodedPolicyNumber;

            if ($response['error'] == false) {
                $cus_details = $PolicyCustomer->getPolicyCustomerDetailsByPolicyNumber($PolicyNumber);
                $username = $cus_details['UserName'];
                $paymentlink = "https://unitedhealthlumina.com/pay-booking-amount-new?policyNumber=" . $encodedPolicyNumber;
                $wdata['PolicyNumber'] = $data['PolicyNumber'];
                $wdata['phonenumber'] = $cus_details['MobileNumber'];
                // $body_values = '["'.$UserName.'"]';
                $body_values = '["' . $username . '","' . $paymentlink . '"]';
                $wdata['body_values'] = $body_values;
                $wdata['template'] = "browse_paymentlinkon_whatsapp";
                _interakt_sendWhatsAppMessage_common($wdata);

            }

        } else {
            $response['error'] = true;
            $response['message'] = "PolicyNumber or Amount is missing in the JSON data.";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Expected JSON data, but received something else.";
    }

    // Respond with the result
    echo json_encode($response);
} else {
    echo json_encode([
        'error' => true,
        'message' => "Invalid request method. POST data is required."
    ]);
}
?>