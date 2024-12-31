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

	public function InsertDocTest($data)
	{
		$TestName = $data['test_name'];
		$TestCategory = $data['test_cat'];
		$TestType = $data['test_type'];
		$TestFee = $data['test_fee'];
		

		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `doc_test`(`TestName`, `TestCategory`,`TestType`,`TestFee`,`CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$TestName','$TestCategory','$TestType','$TestFee','$CreatedDate','$CreatedTime','$CreatedBy')";
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

	public function UpdateTestDetails($data)
	{
		extract($data);
		$update_sql = "TestName = '$test_name' , TestCategory= '$test_cat' , TestType= '$test_type', TestFee= '$test_fee' where ID = $form_test_id";
		$response = $this->_UpdateTableRecords($this->conn,'doc_test',$update_sql);
		return $response;
	}



	public function GetTestCatDetails($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn,"test_category",$where);
		return $service_details;
	}


	public function GetTestDetails($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn,"doc_test",$where);
		return $service_details;
	}

	public function DeleteTestCat($data){
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn,"test_category",$where);
		return $service_details;

	
	}

    public function DeleteTest($data){
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn,"doc_test",$where);
		return $service_details;

	}

}

?>