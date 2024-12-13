<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Required files
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");
require_once("../controllers/common_controller.php");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$secret_key = $conf->getJWTKey();
// Initialize necessary objects
$conf = new Configuration();
$logs = new Logs();
$logs->SetCurrentAPILogFile();

$response = []; // Initialize response array

// Retrieve and decode input data
$data = json_decode(file_get_contents('php://input'), true);
$logs->WriteLog("Request Data: " . json_encode($data), __FILE__, __LINE__);

if (isset($data['Token']) && isset($data['imageData'])) {
    $jwt = $data['Token'];

    try {
        $token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
        $user_id = $token_decoded->data->user_id;
        $username = $token_decoded->data->username;
        $CreatedBy = $data['CreatedBy'];
        $CreatedDate = date('Y-m-d');
        $CreatedTime = date('H:i:s');
        $imageData = base64_decode($data['imageData']);

        // Generate a unique filename for the image
        $filename = "tm_" . uniqid() . '.jpg';

        // Define the storage directory where the image will be saved
        $storageDirectory = '../reimbursement-media/';

        // Save the decoded image to the file
        if (file_put_contents($storageDirectory . $filename, $imageData) === false) {
            throw new Exception("Failed to save image.");
        }

        if(isset($data['TempImageID']))
        {
            if($data['TempImageID'] == "")
            {
                $TempImageID = GenerateTempImageID($conn) + 1;
            }
            else
            {
                $TempImageID = $data['TempImageID'];
            }
        }
        else
           {
                $TempImageID = GenerateTempImageID($conn) + 1;
                $response['TempImageID'] = $TempImageID;
           }

        // Insert the image record into the database
        $ticket_media_query = "
            INSERT INTO temp_capture_reimbursement (TempImageID, Image, CreatedBy, CreatedDate, CreatedTime)
            VALUES ('$TempImageID', '$filename', '$CreatedBy', '$CreatedDate', '$CreatedTime')
        ";

        if (_InsertTableRecords($conn, $ticket_media_query)) {
            $response['error'] = false;
            $response['message'] = "Image saved successfully";
            $response['TempImageID'] = $TempImageID;
        } else {
            throw new Exception("Failed to insert image record.");
        }
    } catch (Exception $e) {
        $logs->WriteLog("Error: " . $e->getMessage(), __FILE__, __LINE__);
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }
} else {
    $logs->WriteLog("Invalid Request: Missing Token or Image Data", __FILE__, __LINE__);
    $response['error'] = true;
    $response['message'] = "Missing required parameters or invalid request.";
}

// Return response as JSON
echo json_encode($response);
?>
