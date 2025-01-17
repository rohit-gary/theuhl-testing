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

	public function GetAllTestName()
	{
		$where = " where IsActive = 1";
		$services_list = $this->_getTableRecords($this->conn,'doc_test',$where);
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

	public function GetAllTestPackage()
	{
		$where = " where IsActive = 1";
		$services_list = $this->_getTableRecords($this->conn,'test_package',$where);
		return $services_list;
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
		$TestType = $data['test_code'];
		$TestFee = $data['test_fee'];
		

		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `doc_test`(`TestName`, `TestCategory`,`TestCode`,`TestFee`,`CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$TestName','$TestCategory','$TestType','$TestFee','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_details;	
	}
     

     public function InsertDocTestPackage($data)
	{
		$TestPackageName = $data['test_Package_name'];
		$TestPackageCategory = $data['test_Package_cat'];
		$PackageTestName = $data['package_test_name'];
		$TestPackageType = $data['test_Package_code'];
		$TestPackageFee = $data['test_Package_fee'];
		

		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `test_package`(`TestPackageName`, `TestPackageCategory`,`PackageTestName`,`TestPackageCode`,`TestPackageFee`,`CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$TestPackageName','$TestPackageCategory','$PackageTestName','$TestPackageType','$TestPackageFee','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_details;	
	}

	public function UpdateTestPackageDetails($data)
	{
		extract($data);
		$update_sql = "TestPackageName = '$test_Package_name' , TestPackageCategory= '$test_Package_cat' ,PackageTestName='$package_test_name', TestPackageCode= '$test_Package_code', TestPackageFee= '$test_Package_fee' where ID = $form_test_Package_id";
		$response = $this->_UpdateTableRecords($this->conn,'test_package',$update_sql);
		return $response;
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
		$update_sql = "TestName = '$test_name' , TestCategory= '$test_cat' , TestCode= '$test_code', TestFee= '$test_fee' where ID = $form_test_id";
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

	public function GetTestPackageDetails($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn,"test_package",$where);
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

	 public function DeleteTestPackage($data){
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn,"test_package",$where);
		return $service_details;

	}

	public function GetTestNameByCatID($ID){  
     $where="where TestCategory=$ID";
     $Test_name=$this->_getTableRecords($this->conn,"doc_test",$where);
     return $Test_name;
	}


	// --------------Cart Functionality now here---------------------------------------


	public function InsertTestCart($data)
	{
		$TestId = $data['productId'];
		$ProductName=$data['productName'];
	    $Price = $data['productPrice'];
	    $UserId = $data['user_id'];
	    $TempUserId = $data['temp_user_id'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `test_cart`(`UserID`,`TempUserID`,`ProductID`,`ProductName`,`ProductPrice`,`Quantity`,`CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$UserId','$TempUserId','$TestId','$ProductName','$Price','1','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_details;	
	}

	public function GetCartItemsByTempUserId($TempID){

	 $where="where TempUserID='$TempID'";
     $Test_cart_item=$this->_getTableRecords($this->conn,"test_cart",$where);
     return $Test_cart_item;

	}


	public function DeleteTestCartItem($where){
		$Test_cart_item = $this->_debug_delete_identity_filter($this->conn,"test_cart",$where);
		return $Test_cart_item;

	}


}



?>