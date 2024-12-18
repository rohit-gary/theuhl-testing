<?php
session_start();
header('Content-Type: application/json');
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$policyForm = isset($_SESSION['policy_form']) ? $_SESSION['policy_form'] : [];

$response = [];

if (!empty($policyForm['plans'])) {
    $Plans_obj = new Plans($conn);

    // Loop through each plan ID and fetch only the ID and PlanName
    foreach ($policyForm['plans'] as $planid) {
        
        $planInfo = $Plans_obj->GetAllPlanDetailsbyID($planid);

        if ($planInfo) {
            // Append the 'ID' and 'PlanName' for each plan to the response array
            $response[] = [
                'ID' => $planInfo[0]['ID'], 
                'PlanName' => $planInfo[0]['PlanName']
            ];
        }
    }
}

// Debugging: Print response before encoding to JSON
// print_r($response);

// Output the response as JSON
echo json_encode($response);
?>

