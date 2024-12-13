<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);

// Include required files
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");

// Initialize configuration and utility objects
$conf = new Configuration();
$core = new Core();
$secret_key = $conf->getJWTKey();
$logs = new Logs();
$logs->SetCurrentAPILogFile();

// Read and log raw input data
$data_raw = file_get_contents('php://input');
$logs->WriteLog($data_raw, __FILE__, __LINE__);

// Decode JSON input into an associative array
$data = json_decode($data_raw, true);

// Initialize response
$response = ["error" => true, "message" => "An unknown error occurred."];

// Validate required fields individually using isset()
if (
    
    isset($data['HospitalName']) && !empty($data['HospitalName']) &&
    isset($data['DoctorName']) && !empty($data['DoctorName']) &&
    isset($data['Gender']) && !empty($data['Gender']) &&
    isset($data['PhoneNumber']) && !empty($data['PhoneNumber']) &&
    isset($data['Email']) && !empty($data['Email']) &&
    isset($data['Address']) && !empty($data['Address']) &&
    isset($data['MedicalDegrees']) && !empty($data['MedicalDegrees']) &&
    isset($data['Specialization']) && !empty($data['Specialization']) &&
    isset($data['Experience']) && !empty($data['Experience']) &&
    isset($data['Description']) && !empty($data['Description'])
) {
    // Add created time and date
    $data["CreatedTime"] = date("H:i:s");
    $data["CreatedDate"] = date("Y-m-d");

    $TempImageID='';
    if(isset($data['TempImageID']))
        {
          
            {
                $TempImageID = $data['TempImageID'];
            }
           
        }

    try {
        // Prepare row data for insertion
        $rowData = [
            "HospitalName"    => $data["HospitalName"],
            "DoctorName"      => $data["DoctorName"],
            "Gender"          => $data["Gender"],
            "PhoneNumber"     => $data["PhoneNumber"],
            "Email"           => $data["Email"],
            "Address"         => $data["Address"],
            "MedicalDegrees"  => $data["MedicalDegrees"],
            "Specialization"  => $data["Specialization"],
            "Experience"      => $data["Experience"],
            "Description"     => $data["Description"],
            "CreatedDate"     => $data["CreatedDate"],
            "CreatedTime"     => $data["CreatedTime"],
            "TempImageID"    =>  $TempImageID
        ];

        // Insert data into the database
        $result = $core->_InsertTableRecords_prepare($conn, "doctors", $rowData);

        // Respond with success
        $response['error'] = false;
        $response['data'] = $result;
        $response['message'] = "Record successfully inserted.";
    } catch (Exception $e) {
        // Log and respond with the error
        $logs->WriteLog($e->getMessage(), __FILE__, __LINE__);  
        $response['message'] = "An error occurred: " . $e->getMessage();
    }
} else {
   $response['error'] = true;
    $response['message'] = "Missing User Field";
}

// Log and return the response
$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
