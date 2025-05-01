<?php

class Reimbursement extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

	public function GetAllReimbursement()
	{
		$where = " where IsActive = 1";
		$Reimbursement_list = $this->_getTableRecords($this->conn, 'customer_reimbursement', $where);
		return $Reimbursement_list;
	}

	public function InsertReimbursementForm($data)
	{
		$policyNumber = $data['policy_number'];
		$hospitalName = $data['hospital_name'];
		$checkupDate = $data['checkup_date'];
		$checkupCost = $data['checkup_cost'];
		$documents = $data['documents'];
		$createdTime = $data['CreatedTime'];
		$createdDate = $data['CreatedDate'];
		$createdBy = $data['CreatedBy'];

		$sql = "INSERT INTO customer_reimbursement 
            (PolicyNumber, HospitalName, CheckupDate, CheckupCost, Documents, CreatedDate, CreatedTime, CreatedBy) 
            VALUES 
            ('$policyNumber', '$hospitalName', '$checkupDate', '$checkupCost', '$documents', '$createdDate', '$createdTime', '$createdBy')";

		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}



	public function GetAllReimbursementTable($table)
	{
		$sql = "Select COUNT(*) as total_enquiries from $table where IsActive = 1";
		$result = mysqli_query($this->conn, $sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row['total_enquiries'];
		} else {
			return 0;
		}
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


	public function GetFaqDetailsbyID($ID)
	{
		$where = " where ID = $ID";
		$Reimbursement_list = $this->_getTableRecords($this->conn, 'Reimbursement', $where);
		return $Reimbursement_list;
	}


	public function GetAllReimbursementByReimbursementID($ID)
	{

		$where = " where ID = $ID";
		$Reimbursement_list = $this->_getTableRecords($this->conn, 'customer_reimbursement', $where);
		return $Reimbursement_list;
	}

	public function UpdateReimbursementForm($data)
	{
		extract($data);
		$update_sql = " Question = '$Question',Answer='$Answer' where ID = $form_id";
		$response = $this->_UpdateTableRecords($this->conn, 'Reimbursement', $update_sql);
		return $response;
	}



	public function DeleteReimbursement($conn, $table, $id)
	{
		try {
			// Update the record to set IsActive = 0 (soft delete)
			$sql = "UPDATE $table SET IsActive = 0 WHERE ID = ?";
			$stmt = mysqli_prepare($conn, $sql);

			if ($stmt === false) {
				throw new Exception("Failed to prepare statement: " . mysqli_error($conn));
			}

			mysqli_stmt_bind_param($stmt, "i", $id);

			if (!mysqli_stmt_execute($stmt)) {
				throw new Exception("Failed to execute statement: " . mysqli_stmt_error($stmt));
			}

			$affected_rows = mysqli_stmt_affected_rows($stmt);
			mysqli_stmt_close($stmt);

			return $affected_rows > 0;
		} catch (Exception $e) {
			error_log("Error in DeleteReimbursement: " . $e->getMessage());
			return false;
		}
	}

	public function GetReimbursementByID($conn, $table, $id)
	{
		try {
			// Validate inputs
			if (!$conn || !$table || !$id) {
				error_log("Invalid parameters in GetReimbursementByID: conn=" . ($conn ? "valid" : "null") . ", table=$table, id=$id");
				return false;
			}

			// Prepare the SQL statement
			$sql = "SELECT * FROM $table WHERE ID = ? AND IsActive = 1";
			$stmt = mysqli_prepare($conn, $sql);

			if ($stmt === false) {
				error_log("Failed to prepare statement in GetReimbursementByID: " . mysqli_error($conn));
				return false;
			}

			// Bind parameters
			if (!mysqli_stmt_bind_param($stmt, "i", $id)) {
				error_log("Failed to bind parameters in GetReimbursementByID: " . mysqli_stmt_error($stmt));
				mysqli_stmt_close($stmt);
				return false;
			}

			// Execute the statement
			if (!mysqli_stmt_execute($stmt)) {
				error_log("Failed to execute statement in GetReimbursementByID: " . mysqli_stmt_error($stmt));
				mysqli_stmt_close($stmt);
				return false;
			}

			// Get the result
			$result = mysqli_stmt_get_result($stmt);
			if ($result === false) {
				error_log("Failed to get result in GetReimbursementByID: " . mysqli_stmt_error($stmt));
				mysqli_stmt_close($stmt);
				return false;
			}

			// Fetch the record
			$record = mysqli_fetch_assoc($result);
			mysqli_stmt_close($stmt);

			if (!$record) {
				error_log("No record found in GetReimbursementByID for ID: $id");
				return false;
			}

			return $record;
		} catch (Exception $e) {
			error_log("Exception in GetReimbursementByID: " . $e->getMessage());
			return false;
		}
	}

	public function GetAllReimbursementByUser($conn, $tableName, $filter)
	{

		try {
			// Remove hardcoded table name since it's passed as parameter
			$query = "SELECT * FROM $tableName $filter";

			// Use direct query instead of prepared statement since filter already contains the conditions
			$result = mysqli_query($conn, $query);

			if ($result === false) {
				error_log("Query failed: " . mysqli_error($conn));
				return [];
			}

			$reimbursementRecords = [];
			while ($row = mysqli_fetch_assoc($result)) {
				$reimbursementRecords[] = $row;
			}

			return $reimbursementRecords;
		} catch (Exception $e) {
			error_log("Error in GetAllReimbursementByUser: " . $e->getMessage());
			return [];

		}

	}

	public function UpdateReimbursementStatus($conn, $ReimbursementID, $Status, $Comments = '')
	{
		// Data to update
		$data = [
			'Status' => $Status,
			'Comments' => $Comments
		];

		$where = [
			'ID' => $ReimbursementID
		];

		$result = $this->_UpdateTableRecords_prepare($conn, 'customer_reimbursement', $data, $where);

		return isset($result['error']) && $result['error'] === false;
	}


}





?>