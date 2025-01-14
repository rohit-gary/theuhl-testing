<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");
if(!empty($_SESSION['cart']))
    {
        $data['CreatedTime'] = date('H:i:s');
        $data['CreatedDate']= date('Y-m-d');
       
        $cartItems = $_SESSION['cart'];
        foreach ($cartItems as $item)
        {
            $productId = $item['id'];
            $productName = $item['name'];
            $productPrice = $item['price'];

        // $query = "INSERT INTO orders (user_id, product_id, product_name, product_price) VALUES ('$userId', '$productId', '$productName', '$productPrice')";
        // if (!mysqli_query($conn, $query)) {
        //     die("Database Insertion Failed: " . mysqli_error($conn));
        // }
         print_r($item);
       
    }
     die();
    // Clear the cart after saving
        unset($_SESSION['cart']);
        $PolicyCustomer = new PolicyCustomer($conn);
        $master = new PolicyCustomer($master_conn);
        $data = $_POST;
        $data['CreatedTime'] = date('H:i:s');
        $data['CreatedDate']= date('Y-m-d');
        $form_action = $_POST['form_action'];
        $data['CreatedBy'] = "client-Itself";
        $encryptedPolicyID ='';
        if($form_action == "add")
        { 
            $duplicateResponce= $PolicyCustomer->checkDuplicatePolicyCustomer($data);
            if(!$duplicateResponce)
            {

                $data['name']=$_POST['poc_name'];
                $data['phone_number']=$_POST['poc_contact_number'];
                $data['OrgID']=1;
                $data['password']=$_POST['dob'];
                $masterResponce=$master->InsertMasterPolicyUser($data);
                $data['UserID']=$masterResponce['last_insert_id'];
                $response = $PolicyCustomer->InsertPolicyCustomerForm($data);
                $PolicyCustomer->InsertUserRole($masterResponce['last_insert_id']);      
                if($response['error'] == false)

                {   $PolicyID=$response['last_insert_id'];
                    $encryptedPolicyID = base64_encode($PolicyID); 
                    $response['message'] = " Policy Customer Saved !";
                    $response['last_insert_id']= $encryptedPolicyID;
                }
                else
                {
                    $response['error'] = true;
                    $response['message'] = "Some Technical Error ! Please Try Again.";
                }
            }else{
                $response['error'] = true;
                $response['message'] = " There is already a Health Plan Issued with this number or Email.";
            }
        }
        
    }
    else
    {
        $response['error'] = true;
        $response['message'] = "Some Technical Error ! Please Try Again.";
    }
    echo json_encode($response);
?>
