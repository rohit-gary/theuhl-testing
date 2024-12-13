<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

$response = ['error' => true, 'message' => "Some Technical Error! Please Try Again."]; // Default response

if (isset($_POST['policy_number'])) {
    $policycustomer_obj = new PolicyCustomer($conn);
    $Plan_obj = new Plans($conn);
    $PolicyID = -1;
    if (isset($_POST['policy_ID'])) {
        $PolicyID = $_POST['policy_ID'];
    }

    // Get the count of family members
    $PolicyMemberCount = $policycustomer_obj->countfamilyMember($PolicyID);

    // Get policy details by PolicyID
    $PolicyDetails = $policycustomer_obj->getPolicyCustomerDetailsByPolicyID($PolicyID);
    if (!empty($PolicyDetails)) {
        $policy = $PolicyDetails[0];
    }

    // Get Plan details by PlanID
    $PlanDetailss = $Plan_obj->GetPlanDetailsbyID($policy["PlanID"]);
    $PlanDetails = $PlanDetailss[0];

    // Max allowed family members for this plan
    $maxFamilyMembers = $PlanDetails["PlanFamilyMember"];

    // Check if PolicyMemberCount is greater than or equal to maxFamilyMembers
    if ($PolicyMemberCount >= $maxFamilyMembers) {
        // If the family member count has reached or exceeded the maximum, don't insert and show a message
        $response['error'] = false;
        $response['message'] = "You cannot add more family members. Maximum limit reached.";
    } else {
        // Proceed with inserting family members
        $data = $_POST;
        // Handle the form action (either insert or update)
        if ($data['form_action'] != "Update") {
            $data['CreatedDate'] = date("Y-m-d");
            $data['CreatedTime'] = date("H:i:s");
            $data['CreatedBy'] = $_SESSION['dwd_email'];

            // Call the InsertFamilyMembers method
            $response = $policycustomer_obj->InsertFamilyMembers($data);

            // If InsertFamilyMembers returns an array of results
            $errors = [];
            foreach ($response as $memberResponse) {
                if ($memberResponse['error']) {
                    $errors[] = $memberResponse['message']; // Collect error messages
                }
            }

            if (count($errors) === 0) {
                // All family members inserted successfully
                $response['error'] = false;
                $response['message'] = "All Family Members Inserted Successfully!";
            } else {
                // There were errors during insertions
                $response['message'] = implode(', ', $errors); // Combine error messages
            }
        } else {
            // Update Service Details (assuming the relevant function exists)
            $response = $service_obj->UpdateServiceDetails($data);
        }
    }
}

// Output the response as JSON
echo json_encode($response);
?>
