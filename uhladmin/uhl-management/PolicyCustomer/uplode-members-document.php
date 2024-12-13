<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

$response = ['error' => true, 'message' => "Some Technical Error! Please Try Again."]; // Default response

if (isset($_POST['policy_member_id'])) {
    $policycustomer_obj = new PolicyCustomer($conn);
    
    $PolicyMemberId = -1;
    if (isset($_POST['policy_member_id'])) {
        $PolicyMemberId = $_POST['policy_member_id'];
    }

        $data = $_POST;

       
        // Handle the form action (either insert or update)
        if ($data['form_action'] != "Update") {
            $response = $policycustomer_obj->InsertMembersDocuments($data);
  
}
}

// Output the response as JSON
echo json_encode($response);
?>
