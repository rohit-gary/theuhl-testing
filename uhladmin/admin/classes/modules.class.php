<?php 
class Modules extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

	function InsertModulesForm($data)
	{
		$modulesname = $data['modulesname'];
		$CreatedDate = date('Y-m-d');
		$CreatedBy = $data['CreatedBy'];
		$CreatedTime = date('H:i:s');


		 $sql = "INSERT INTO modules(ModulesName,CreatedDate,CreatedTime,CreatedBy) VALUES ('$modulesname','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_modules_details = $this->_InsertTableRecords($this->conn,$sql);

        if($response_insert_modules_details['error'] == false){
        	$response_insert_modules_details['message'] = "Module Added !";
		    $response_insert_modules_details['error'] = false;
		}else{
			$response_insert_modules_details['message'] = "Some Technical Error !";
			$response_insert_modules_details['error'] = true;
		}
		
		
		return $response_insert_modules_details;
		

	}

	function UpdateModulesForm($data)
	{
		$modulesname = $data['modulesname'];
		$modules_update_id = $data['form_id'];
		$CreatedDate = date('Y-m-d');
        $CreatedTime = date('H:i:s');
        $CreatedBy = $data['CreatedBy'];
	

		 $sql_mu = "ModulesName='$modulesname',CreatedDate='$CreatedDate' WHERE ID='$modules_update_id'";
		 $table_name ='modules';
		$response_update_details  = $this->_UpdateTableRecords($this->conn,$table_name,$sql_mu);

		

		if($response_update_details['error'] == false){
        	$response_update_details['message'] = "Module Updated !";
		    $response_update_details['error'] = false;
		}else{
			$response_update_details['message'] = "Some Technical Error !";
		    $response_update_details['error'] = false;
		}
		
		return $response_update_details;
		

	}
	public function getAllModules()
	{
		$where = " where IsActive = 1 ORDER BY ID DESC";
        $module_details = $this->_getTableRecords($this->conn, "modules", $where);
        return $module_details;
	}

	public function getTotalModules($table)
	{
		$sql = "Select COUNT(*) as total_enquiries from $table where IsActive = 1";
		$result=mysqli_query($this->conn,$sql);
		if($result->num_rows>0)	
		{
			$row = $result->fetch_assoc();
			return $row['total_enquiries'];
		}
		else
		{
			return 0;
		}
	}

	public function GetModulesDetailsByID($ID)
	{
		$where = " where ID = $ID";
        $Student_details = $this->_getTableDetails($this->conn, "modules", $where);
        return $Student_details;
	}

	function DeleteModules($data)
	{
		$ModulesID = $data['ID'];
		// Delete company
		$where = " where ID = $ModulesID";
		$response = $this->delete_identity_filter($this->conn,"modules",$where);
		return $response;
	}
	function GetOrgModules($OrgID)
	{
		$where = " where OrgID = $OrgID ORDER BY ID DESC";
        $org_modules = $this->_getTableRecords($this->conn, "org_module_mapping", $where);
        return $org_modules;
	}
}