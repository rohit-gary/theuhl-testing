<?php 
class Test extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function GetAllTestCats()
	{
		$where = " where IsActive = 1";
		$services_list = $this->_getTableRecords($this->conn,'test_category',$where);
		return $services_list;
	}

	


	public function GetTestCats($data)
	{
		$ServiceID = $data['ServiceID'];
		// Delete company
		$where = " where ID = $ServiceID";
		$service_details = $this->_getTableDetails($this->conn,"test_category",$where);
		return $service_details;
	}

	
	public function setTestCatsArraybyID()
	{
		$sites_array = array();
		$services_list = $this->GetAllServices();
		foreach($services_list as $service)
		{
			extract($service);
			$sites_array[$ID]['ServiceName'] = $ServiceName;
		}
		return $sites_array;
	}
	public function InsertTestCat($data)
	{
		$test_category_name = $data['test_category_name'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `test_category`(`TestCategoryName`, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$test_category_name','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_details;	
	}


	
	public function UpdateTestCatsDetails($data)
	{
		extract($data);
		$update_sql = " TestCategoryName = '$test_category_name' where ID = $form_test_cat_id";
		$response = $this->_UpdateTableRecords($this->conn,'test_category',$update_sql);
		return $response;
	}


	public function GetTestCatDetails($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn,"test_category",$where);
		return $service_details;
	}

	public function DeleteTestCat($data){
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn,"test_category",$where);
		return $service_details;

	
	}



}

?>