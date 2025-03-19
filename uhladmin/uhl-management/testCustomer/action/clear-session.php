<?php
// Start session
session_start();

// Clear the specific session variables
unset($_SESSION['customer_form']);
unset($_SESSION['policy_form']);
unset($_SESSION['customer_id']);
unset($_SESSION['action']);
unset($_SESSION['policy_form_Id']);
unset($_SESSION['PolicyNumber']);
unset($_SESSION['policy_form_action']);
unset($_SESSION['family_member']);

// Return success response
echo 'success';
?>
