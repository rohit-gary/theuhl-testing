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



	public function DeleteReimbursement($data)
	{
		$ReimbursementID = $data['ID'];
		// Delete course
		$where = " where ID = $ReimbursementID";
		$response = $this->delete_identity_filter($this->conn, "Reimbursement", $where);
		return $response;
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



}





?>