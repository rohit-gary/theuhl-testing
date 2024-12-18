<?php
session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$policyForm = isset($_SESSION['policy_form']) ? $_SESSION['policy_form'] : [];
$options = '';

if (!empty($policyForm['plans'])) {
    $Plans_obj = new Plans($conn);

    // Loop through each plan ID and fetch only the ID and PlanName
    foreach ($policyForm['plans'] as $planid) {
        $planInfo = $Plans_obj->GetAllPlanDetailsbyID($planid);
        
        if ($planInfo) {
            $planID = $planInfo[0]['ID'];
            $planName = $planInfo[0]['PlanName'];
            $options .= "<option value='$planID'>$planName</option>";
        }
    }
}

echo $options; // Return options for the select element
?>
