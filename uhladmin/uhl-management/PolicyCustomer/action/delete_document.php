<?php
@session_start();

require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$response = array();
$response['error'] = true;

print_r($_SESSION);

// Check if the document name is passed
if (isset($_POST['document']) && !empty($_POST['document'])) {
    $document = $_POST['document'];
    $familyMemberID = $_SESSION['family_member']['ID']; // Get the current family member ID

    print_r($_SESSION);
    die();
    
    // Remove the document from the session
    if (isset($_SESSION['family_member_documents'][$familyMemberID])) {
        // Find and remove the document from the array
        $index = array_search($document, $_SESSION['family_member_documents'][$familyMemberID]);
        if ($index !== false) {
            unset($_SESSION['family_member_documents'][$familyMemberID][$index]);
        }
    }
    
    // Optionally, remove the file from the server as well
    if (file_exists($document)) {
        unlink($document);  // Delete the file from the server
    }

    echo 'Document deleted successfully';
} else {
    echo 'No document specified for deletion.';
}
?>
