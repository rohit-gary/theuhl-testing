<?php 

class Core
{
	public function getURL()
	{
		if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) 
		{
			$_URL = "http://localhost/Projects/partnership-portal/";
			return $_URL;
		}
	}
	public function setTimeZone()
	{
		date_default_timezone_set('Asia/Kolkata');
	}

	public function _InsertTableRecords($conn, $sql)
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

	function _InsertPreparedData($conn,$tableName, $columns, $values) 
	{
		$response = array();
		$response['error'] = false;
		$response['message'] = "Data inserted successfully";
		// Prepare a statement with placeholders for column names and values
		$sql = "INSERT INTO $tableName (".implode(", ", $columns).") VALUES (".rtrim(str_repeat("?, ", count($columns)), ", ").")";
		$stmt = $conn->prepare($sql);

		// Bind parameters
		$types = str_repeat("s", count($values));
		$stmt->bind_param($types, ...$values);
		if (!$stmt->bind_param($types, ...$values)) {
			$response['error'] = true;
		    $response['message'] = "Failed to bind parameters: " . $stmt->error;
		    $stmt->close();
		    return $response;
	  	}

		  // Execute statement
		if (!$stmt->execute()) {
			$response['error'] = true;
			$response['message'] = "Failed to execute statement: " . $stmt->error;
			$stmt->close();
			return $response;
		}

		// Close statement and database connection
		$stmt->close();
		return $response;
	}

	public function _UpdateTableRecords($conn, $table_name, $query_parameter)
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

	public function delete_identity_filter($conn, $table, $query)
	{
		$sql = "Delete from $table $query";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			return true;
		}
		return false;
	}
	public function _debug_delete_identity_filter($conn, $table, $query)
	{
		$sql = "Delete from $table $query";
		echo $sql;
		$result = mysqli_query($conn, $sql);
		if ($result) 
		{
			return true;
		}
		else
		{
			echo "MySQLi Error: " . mysqli_error($conn);
		}
		return false;
	}

	public function _getTableRecords($conn, $table_name, $where)
	{
		$response = array();
		$sql = "Select * from $table_name $where";
		//echo $sql;
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
	public function _debug_getTableRecords($conn, $table_name, $where)
	{
		$response = array();
		$sql = "Select * from $table_name $where";
		echo $sql;
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

	public function _getRecords($conn,$sql)
	{
		$response = array();
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


	public function _getTableDetails($conn,$table_name, $where)
	{
		$row = array();
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
	public function _debug_getTableDetails($conn,$table_name, $where)
	{
		$row = array();
		$sql = "Select * from $table_name $where";
		echo $sql;
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
	public function _getTableRecordsassoc($conn, $table_name, $where)
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
	public function check_unique_identity_filter($conn, $table, $filter)
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
	public function _getTotalRows($conn, $table, $filter)
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

	public function _getMaxIdentityValue($conn, $table, $column)
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
	public function _getMaxIdentityValue_filter($conn, $table, $column, $where_query)
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

	public function getEmployeeDetailsfromID($conn,$EmployeeID)
	{
		$where = " where ID = $EmployeeID";
		return _getTableDetails($conn,'employees',$where);
	}

	public function generateArraywithKey($data_array)
	{
		$array_temp = array();
		foreach($data_array as $data)
		{
			$ID = $data['ID'];
			$array_temp[$ID] = $data;
		}
		return $array_temp;
	}
	public function sendMailRequest($postdata,$url)
	{
		//$url = $this->getURL();
		$postdata = json_encode($postdata);
		$resource = $url;
		$ch = curl_init($resource);
		curl_setopt($ch, CURLOPT_URL, $resource);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_USERAGENT, 'api');
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_exec($ch);
		curl_close($ch);
		
	}
	public function sendCurlRequest($postdata,$url)
	{
		//$url = $this->getURL();
		$postdata = json_encode($postdata);
		$resource = $url;
		$ch = curl_init($resource);
		curl_setopt($ch, CURLOPT_URL, $resource);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_USERAGENT, 'api');
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_exec($ch);
		curl_close($ch);
	}

	public function formatIndianNumber($number) {
	    $decimal = (string)($number - floor($number));
	            $money = floor($number);
	            $length = strlen($money);
	            $delimiter = '';
	            $money = strrev($money);
	 
	            for($i=0;$i<$length;$i++){
	                if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
	                    $delimiter .=',';
	                }
	                $delimiter .=$money[$i];
	            }
	 
	            $result = strrev($delimiter);
	            $decimal = preg_replace("/0\./i", ".", $decimal);
	            $decimal = substr($decimal, 0, 3);
	 
	            if( $decimal != '0'){
	                $result = $result.$decimal;
	            }
	 
	            return $result;
	}
	public function handleBlankValues($arr) {
	    foreach ($arr as $key => $value) {
	        if (empty($value)) {
	            $arr[$key] = 'Not Set';
	        }
	    }
	    return $arr;
	}

	public function numberToWords($number) {
		
		function convertLessThanThousand($num) {
			$units = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
			$teens = ['', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
			$tens = ['', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
			if ($num == 0) {
				return '';
			} elseif ($num < 10) {
				return $units[$num];
			} elseif ($num < 20) {
				return $teens[$num - 10];
			} elseif ($num < 100) {
				return $tens[(int)($num / 10)] . ' ' . convertLessThanThousand($num % 10);
			} else {
				return $units[(int)($num / 100)] . ' hundred ' . convertLessThanThousand($num % 100);
			}
		}
	
		function convertUpToCrore($num) {
			if ($num < 1000) {
				return convertLessThanThousand($num);
			} elseif ($num < 100000) {
				return convertLessThanThousand((int)($num / 1000)) . ' thousand ' . convertLessThanThousand($num % 1000);
			} elseif ($num < 10000000) {
				return convertLessThanThousand((int)($num / 100000)) . ' lakh ' . convertUpToCrore($num % 100000);
			} else {
				return convertLessThanThousand((int)($num / 10000000)) . ' crore ' . convertUpToCrore($num % 10000000);
			}
		}
	
		if ($number == 0) {
			return 'zero';
		} else {
			return convertUpToCrore($number);
		}
	}

	function redirect($url)
	{
	    if (!headers_sent())
	    {    
	        header('Location: '.$url);
	        exit;
	        }
	    else
	        {  
	        echo '<script type="text/javascript">';
	        echo 'window.location.href="'.$url.'";';
	        echo '</script>';
	        echo '<noscript>';
	        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
	        echo '</noscript>'; exit;
	    }
	}

	public function cleantext($str)
	{
		$str = addslashes($str);
		$str = trim($str);
		return $str;
	}
	public function clean_datatable_text($str)
	{
	    // Define a regular expression pattern to match non-alphanumeric characters
	    $pattern = '/[^a-zA-Z0-9& ]/';
	    // Use the preg_replace function to remove illegal characters
	    $cleanString = preg_replace($pattern, '', $str);
	    return $cleanString;
	}


	public function _InsertTableRecords_prepare($conn, $tableName, $data)
	{
		$response = array();
		 // Build the columns and placeholders strings dynamically
	    $columns = implode(", ", array_keys($data));
	    $placeholders = implode(", ", array_fill(0, count($data), '?'));

	    // Prepare the SQL statement
	    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
	    $stmt = $conn->prepare($sql);

	    if ($stmt === false) {
	        die("Error preparing statement: " . $conn->error);
	    }

	    // Bind the parameters dynamically
	    $types = str_repeat('s', count($data)); // Assuming all parameters are strings; adjust as needed
	    $stmt->bind_param($types, ...array_values($data));

	    // Execute the statement
	    if (!$stmt->execute()) 
	    {
	    	$response['error'] = true;
	    	$response['message'] = $stmt->error;
	    }
	    else
	    {
	    	$response['error'] = false;
	    	$response['message'] = "Data Inserted";
	    	$response['last_insert_id'] = $conn->insert_id;
	    }

	    $stmt->close();
	    return $response;
	}

	public function _UpdateTableRecords_prepare($conn, $tableName, $data, $where)
	{
	    $response = array();

	    // Build the columns and placeholders strings dynamically for SET clause
	    $setParts = [];
	    foreach ($data as $column => $value) {
	        $setParts[] = "$column = ?";
	    }
	    $setClause = implode(", ", $setParts);

	    // Build the WHERE clause dynamically
	    $whereParts = [];
	    foreach ($where as $column => $value) {
	        $whereParts[] = "$column = ?";
	    }
	    $whereClause = implode(" AND ", $whereParts);

	    // Prepare the SQL statement
	    $sql = "UPDATE $tableName SET $setClause WHERE $whereClause";
	    $stmt = $conn->prepare($sql);

	    if ($stmt === false) {
	        die("Error preparing statement: " . $conn->error);
	    }

	    // Bind the parameters dynamically
	    $types = str_repeat('s', count($data) + count($where)); // Assuming all parameters are strings; adjust as needed
	    $params = array_merge(array_values($data), array_values($where));
	    $stmt->bind_param($types, ...$params);

	    // Execute the statement
	    if (!$stmt->execute()) 
	    {
	        $response['error'] = true;
	        $response['message'] = $stmt->error;
	    }
	    else
	    {
	        $response['error'] = false;
	        $response['message'] = "Data Updated";
	        $response['affected_rows'] = $stmt->affected_rows;
	    }

	    $stmt->close();
	    return $response;
	}


	public function _getSQLDetails($conn, $sql)
	{
		$response = array();
		$result = mysqli_query($conn, $sql);
		if ($result) {
			if ($result->num_rows > 0) {
				$response = $row = $result->fetch_assoc();
			}
		} else {
			//echo $sql;
		}
		return $response;
	}
}