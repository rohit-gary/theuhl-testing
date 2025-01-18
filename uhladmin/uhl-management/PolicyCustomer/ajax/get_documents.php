<?php

@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$PolicyCustomer = new PolicyCustomer($conn);
$core = new Core();
$response = array();

$response = [
    'success' => false,
    'message' => '',
    'documents' => []
];

var_dump($_SESSION);
die();
if (true){
    
    try {
      

        $documents=$PolicyCustomer->GetDocumentsBy();
        $query = "
            SELECT `ID`, `PolicyID`, `MemberID`, `DocName`, `PolicyNumber`, `Documents`, `CreatedBy`, `CreatedDate`, `CreatedTime`, `IsActive` 
            FROM `policy_customer_documents` 
            WHERE `MemberID` = ? AND `IsActive` = 1
        ";
        $stmt = $db->prepare($query);
        $stmt->execute([$familyMemberID]);
        $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($documents) {
            // Save the documents in the session
            if (!isset($_SESSION['family_member_documents'])) {
                $_SESSION['family_member_documents'] = [];
            }
            $_SESSION['family_member_documents'][$familyMemberID] = $documents;

            $response['success'] = true;
            $response['message'] = 'Documents fetched and saved in session successfully.';
            $response['documents'] = $documents;
        } else {
            $response['message'] = 'No documents found for the specified family member.';
        }
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Family member ID not provided.';
}

echo json_encode($response);

// Database connection function
function getDbConnection() {
    $host = 'localhost';
    $dbname = 'your_database_name';
    $username = 'your_username';
    $password = 'your_password';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }
}
?>
