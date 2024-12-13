<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

if (isset($_POST['cat_name'])) {
   $service_obj = new Service($conn);
   $data = $_POST;

  
   if (isset($_FILES['CatImage']['name']) && $_FILES['CatImage']['error'] == 0) {
      $target_dir = "../images/";
      $image_name = time() . "_" . basename($_FILES['CatImage']['name']);
      $target_file = $target_dir . $image_name;

      
      if (move_uploaded_file($_FILES['CatImage']['tmp_name'], $target_file)) {
         $data['CatImage'] = $image_name;  
      } else {
         $response['error'] = true;
         $response['message'] = "Failed to upload image.";
         echo json_encode($response);
         exit;
      }
   }

   
   if ($data['form_action'] != "Update") {
      $data['CreatedDate'] = date("Y-m-d");
      $data['CreatedTime'] = date("H:i:s");
      $data['CreatedBy'] = $_SESSION['dwd_email'];
      $response = $service_obj->InsertDoctorCat($data);
      if ($response['error'] == false) {
         $response['message'] = "Doctor Category Record Created!";
      } else {
         $response['error'] = true;
         $response['message'] = "Some Technical Error ! Please Try Again.";
      }
   } else {
      $response = $service_obj->UpdateDoctorCatDetails($data);
   }
} else {
   $response['error'] = true;
   $response['message'] = "Some Technical Error ! Please Try Again.";
}

echo json_encode($response);

?>