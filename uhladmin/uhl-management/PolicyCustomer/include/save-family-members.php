<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

if (isset($_POST)) {
    $master = new PolicyCustomer($master_conn);
    $PolicyCustomer = new PolicyCustomer($conn);
    $data = $_POST;




    // Retrieve basic data
    $data['CreatedTime'] = date('H:i:s');
    $data['CreatedDate'] = date('Y-m-d');
    $data['CreatedBy'] = $_SESSION['dwd_email'];
    $PolicyCustomerID = '';
    $PolicyNumber = $data['policy_number_1'];// Adjust if you have this ID already generated.


    // Initialize response
    $response = [
        'error' => false,
        'message' => '',
        'data' => []
    ];

    // Check if family_member session is already an array, if not initialize it
    if (!isset($_SESSION['family_member']) || !is_array($_SESSION['family_member'])) {
        $_SESSION['family_member'] = [];
    }


    // Loop through members in POST data
    $index = 1;
    $OtherRelationship = " ";
    while (isset($data["member_name_$index"])) {
        $member = [
            'PolicyCustomerID' => $PolicyCustomerID,
            'PlanID' => $data["plan_Id_$index"],
            'PolicyNumber' => $data["policy_number_$index"],
            'Name' => $data["member_name_$index"],
            'DateOfBirth' => $data["member_dob_$index"],
            'Gender' => $data["member_gender_$index"],
            'Relationship' => $data["member_relationship_$index"],
            'CreatedDate' => $data['CreatedDate'],
            'CreatedTime' => $data['CreatedTime'],
            'CreatedBy' => $data['CreatedBy']
        ];

        // Add 'OtherRelationship' only if it exists
        if (isset($data["other_relationship_$index"])) {
            $member['OtherRelationship'] = $data["other_relationship_$index"];
        }

        // Calculate age from DateOfBirth
        $dob = new DateTime($member['DateOfBirth']);
        $now = new DateTime();
        $age = $now->diff($dob)->y;
        $member['Age'] = $age;
        $to_be_inserted = true;
        if (isset($data["PolicyMemberID_$index"])) {
            $PolicyMemberID = $data["PolicyMemberID_$index"];
            if ($PolicyMemberID != -1) {
                $to_be_inserted = false;
            }
        }
        if ($to_be_inserted) {

            $response = $PolicyCustomer->InsertMemberForm($member);
            $member['ID'] = $response['last_insert_id'];
        } else {

            $whereCondition = [
                'ID' => $PolicyMemberID
            ];
            $response = $PolicyCustomer->UpdateMemberForm($member, $whereCondition);
            $member['ID'] = $PolicyMemberID;
        }



        // $_SESSION['family_member'][] = $member;
        if (!isset($_SESSION['family_member'])) {
            $_SESSION['family_member'] = [];
        }
        $exists = false;

        foreach ($_SESSION['family_member'] as $existingMember) {
            // Compare by 'ID' or any other unique fields
            if ($existingMember['ID'] === $member['ID']) {
                $exists = true;
                break;
            }
        }

        // Add the member to the session if it does not already exist
        if (!$exists) {
            $_SESSION['family_member'][] = $member;

        }
        $response['PolicyNumber'] = $PolicyNumber;
        $index++;
    }

    echo json_encode($response);
} else {
    echo json_encode([
        'error' => true,
        'message' => "No POST data received."
    ]);
}

?>