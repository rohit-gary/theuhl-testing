<?php
$servername = "";$dbusername = "";$password = "";$dbname = "";
$_URL = "";
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    $servername = "localhost";$dbusername = "root";$password = "";$dbname = "dwd_web";
	$_URL = "http://localhost/Projects/dwd";
}
else
{
	$servername = "localhost";$dbusername = "tqunkwmy_dwd_web";$password = "dwd_web@321!@";$dbname = "tqunkwmy_dwd_web";
	$_URL = "https://digitalworkdesk.com";
}
error_reporting(E_ALL);
function _connectodb()
{
	global $dbname;
	global $servername;
	global $dbusername;
	global $password;
	$connect = new mysqli($servername,$dbusername,$password,$dbname);
	if($connect->connect_error)
	{
		print_r("Connection Error: " . $connect->connect_error);
		return false;
	}
	else
	{
		return $connect;
	}
}
function SessionCheck()
{
	@session_start();
	if(isset($_SESSION['pb_username']))
	{
		return $_SESSION['UserType'];
	}
	else
	{
		return "Error";
	}
}
function setTimeZone()
{
	date_default_timezone_set('America/New_York');
}
function _InsertTableRecords($conn, $sql)
{
	$response = array();
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$response['message'] = "Data Inserted";
		$response['error'] = false;
		$lastId = mysqli_insert_id($conn);
		$response['last_insert_id'] = $lastId;
	} else {
		$response['sql'] = $sql;
		$response['error'] = true;
		$error = mysqli_error($conn);
		$response['message'] = $error;
		echo $sql;
		echo $error;
	}
	return $response;
}
function _UpdateTableRecords($conn, $table_name, $query_parameter)
{
	$response = array();
   	$sql = "UPDATE $table_name SET $query_parameter";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$response['message'] = "Data Updated";
		$response['error'] = false;
	} else {
		$response['sql'] = $sql;
		$response['error'] = true;
		$error = mysqli_error($conn);
		$response['message'] = $error;
		echo $sql;
		echo $error;
	}
	return $response;
}
function delete_identity_filter($conn, $table, $query)
{
	$sql = "Delete from $table $query";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return true;
	}
	return false;
}
function _getTableRecords($conn, $table_name, $where)
{
	$response = array();
	$sql = "Select * from $table_name $where";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($response, $row);
			}
		}
	} else {
		//echo $sql;
	}
	return $response;
}
function _getTableDetails($conn,$table_name, $where)
{
	$sql = "Select * from $table_name $where";
	$result=mysqli_query($conn,$sql);
	if($result)
		$row = $result->fetch_assoc();
	else
	{
		$error = mysqli_error($conn);
		echo $sql;
		echo $error;
	}
	return $row;
}
function _getTableRecordsassoc($conn, $table_name, $where)
{
	$response = array();
	$sql = "Select * from $table_name $where";
	$result = mysqli_query($conn, $sql);
	if ($result)
	{
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc() ;
			return $row;
		}
	}
	else
	{
		//echo $sql;
	}
	//return $row;
}
function check_unique_identity_filter($conn, $table, $filter)
{
	 $sql = "Select * from $table $filter";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if ($result->num_rows > 0) {
			return false;
		}
	}
	return true;
}
function _getTotalRows($conn, $table, $filter)
{
	if ($filter == "") {
		$sql = "Select COUNT(*) as no_count from $table";
	} else {
		$sql = "Select COUNT(*) as no_count from $table $filter";
	}
	//echo $sql;
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row['no_count'];
	} else {
		return 0;
	}
}
function _getMaxIdentityValue($conn, $table, $column)
{
	$sql = "Select COALESCE(MAX($column),0) as max_value from $table";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row['max_value'];
	} else {
		return 0;
	}
}
function _getMaxIdentityValue_filter($conn, $table, $column, $where_query)
{
	$sql = "Select COALESCE(MAX($column),0) as max_value from $table $where_query";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row['max_value'];
	} else {
		return 0;
	}
}
function InsertUser($conn,$campaign,$user_email,$uri)
{
	setTimeZone(); 
	$CreatedDate = date("Y-m-d");
	$CreateTime = date("H:i:s");
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$referrer = "";
	if(isset($_SERVER['HTTP_REFERER'])) 
	{
    	$referrer = $_SERVER['HTTP_REFERER'];   
	}
	$sql = "INSERT INTO users_tracking(Campaign,IP,Referrer,MainPage,UserEmail,URI,CreatedDate,CreatedTime) VALUES('$campaign','$ip_address','$referrer','Yes','$user_email','$uri','$CreatedDate','$CreateTime')";
	$ID = _InsertTableRecords($conn, $sql)['last_insert_id'];
	return $ID;
}
function InsertUserfromTrialPage($conn,$campaign,$user_email,$uri)
{
	setTimeZone(); 
	$CreatedDate = date("Y-m-d");
	$CreateTime = date("H:i:s");
	$referrer = "";
	if(isset($_SERVER['HTTP_REFERER'])) 
	{
    	$referrer = $_SERVER['HTTP_REFERER'];   
	}
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$sql = "INSERT INTO users_tracking(Campaign,IP,Referrer,TrialPage,UserEmail,URI,CreatedDate,CreatedTime) VALUES('$campaign','$ip_address','$referrer','Yes','$user_email','$uri','$CreatedDate','$CreateTime')";
	$ID = _InsertTableRecords($conn, $sql)['last_insert_id'];
	return $ID;
}
function InsertUserfromNextStepPage($conn,$campaign,$email,$name)
{
	setTimeZone(); 
	$CreatedDate = date("Y-m-d");
	$CreateTime = date("H:i:s");
	$referrer = "";
	if(isset($_SERVER['HTTP_REFERER'])) 
	{
    	$referrer = $_SERVER['HTTP_REFERER'];   
	}
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$sql = "INSERT INTO users_tracking(Campaign,IP,Referrer,TrialPage,NextStepPage,Name,Email,CreatedDate,CreatedTime) VALUES('$campaign','$ip_address','$referrer','Yes','Yes','$name','$email','$CreatedDate','$CreateTime')";
	$ID = _InsertTableRecords($conn, $sql)['last_insert_id'];
	return $ID;
}
function InsertUserfromRegistrationPage($conn,$campaign,$user_email,$uri)
{
	setTimeZone(); 
	$CreatedDate = date("Y-m-d");
	$CreateTime = date("H:i:s");
	$referrer = "";
	if(isset($_SERVER['HTTP_REFERER'])) 
	{
    	$referrer = $_SERVER['HTTP_REFERER'];   
	}
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$sql = "INSERT INTO users_tracking(Campaign,IP,Referrer,TrialPage,Register,UserEmail,URI,CreatedDate,CreatedTime) VALUES('$campaign','$ip_address','$referrer','Yes','Yes','$user_email','$uri','$CreatedDate','$CreateTime')";
	$ID = _InsertTableRecords($conn, $sql)['last_insert_id'];
	return $ID;
}

// function sendMailRequest($postdata)
// {
// 	$postdata = json_encode($postdata);
// 	$resource = "https://digitalworkdesk.com/send-email-api.php";
// 	$ch = curl_init($resource);
// 	curl_setopt($ch, CURLOPT_URL, $resource);
// 	curl_setopt($ch, CURLOPT_POST, TRUE);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
// 	curl_setopt($ch, CURLOPT_USERAGENT, 'api');
// 	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
// 	curl_setopt($ch, CURLOPT_TIMEOUT_MS, 0);
// 	curl_setopt($ch, CURLOPT_HEADER, 0);
// 	curl_setopt($ch,  CURLOPT_RETURNTRANSFER, false);
// 	curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
// 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
// 	curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
// 	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
// 	curl_exec($ch);
// 	curl_close($ch);
// }



function cleantext($str)
{
	$str = addslashes($str);
	$str = trim($str);
	return $str;
}

function containsSpecialCharacters($str) {
    // Define a regular expression pattern to match special characters
    $pattern = '/[!@#$%^&*()_+{}\[\]:;<>,.?~\\\'"\/\\`|=-]/';

    // Use the preg_match function to check if the string contains any special characters
    if (preg_match($pattern, $str)) {
        return true; // Special characters found
    } else {
        return false; // No special characters found
    }
}