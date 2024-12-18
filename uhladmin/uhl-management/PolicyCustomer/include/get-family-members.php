<?php
session_start();

// Check if family member session data exists
$FamilyMemberDetails = isset($_SESSION['family_member']) ? $_SESSION['family_member'] : [];

header('Content-Type: application/json');
echo json_encode($FamilyMemberDetails);
?>