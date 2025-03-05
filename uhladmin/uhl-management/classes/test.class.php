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
		$services_list = $this->_getTableRecords($this->conn, 'test_category', $where);
		return $services_list;
	}

	public function GetAllTestName()
	{
		$where = " where IsActive = 1";
		$services_list = $this->_getTableRecords($this->conn, 'doc_test', $where);
		return $services_list;
	}

	public function GetAllTestNameFilter($filter_limit)
	{
		$where = " where IsActive = 1 ORDER BY ID DESC $filter_limit";
		$services_list = $this->_getTableRecords($this->conn, 'doc_test', $where);
		return $services_list;
	}

	public function GetTestBySearch($query,$start_counter = 0, $no_of_records = 10) {
	  $sql = "SELECT * FROM doc_test WHERE LOWER(TestName) LIKE ? ORDER BY ID DESC LIMIT ?, ?";
		$stmt = $this->conn->prepare($sql);
		$searchTerm = "%$query%";
		$stmt->bind_param("sii", $searchTerm, $start_counter, $no_of_records);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
}

	public function GetTestCats($data)
	{
		$ServiceID = $data['ServiceID'];
		// Delete company
		$where = " where ID = $ServiceID";
		$service_details = $this->_getTableDetails($this->conn, "test_category", $where);
		return $service_details;
	}

	public function GetAllTestPackage()
	{
		$where = " where IsActive = 1";
		$services_list = $this->_getTableRecords($this->conn, 'test_package', $where);
		return $services_list;
	}

	public function setTestCatsArraybyID()
	{
		$sites_array = array();
		$services_list = $this->GetAllServices();
		foreach ($services_list as $service) {
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
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}

	public function InsertDocTest($data)
	{
		$TestName = $data['test_name'];
		$TestCategory = $data['test_cat'];
		$TestType = $data['test_code'];
		$TestFee = $data['test_fee'];
		$ReportTime = $data['report_time'];
		$Parameters = $data['parameters'];
		$Requisites = $data['requisites'];
		$Measures = $data['measures'];
		$Identifies = $data['identifies'];
		$HomeMinutes = $data['home_minutes'];
		$GoogleRating = $data['google_rating'];
		$HappyCustomer = $data['happy_customer'];
		$HeadingOne = $data['heading_one'];
		$HeadingTwo = $data['heading_two'];
		$HeadingThree = $data['heading_three'];
		$HeadingFour = $data['heading_four'];
		$DescriptionOne = $data['description_one'];
		$DescriptionTwo = $data['description_two'];
		$DescriptionThree = $data['description_three'];
		$DescriptionFour = $data['description_four'];

		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `doc_test`(`TestName`, `TestCategory`,`TestCode`,`TestFee`,`ReportTime`,`Parameters`,`Requisites`,`Measures`,`Identifies`,`HomeMinutes`,`HappyCustomer`,`GoogleRating`,`HeadingOne`,`HeadingTwo`,`HeadingThree`,`HeadingFour`,`DescriptionOne`,`DescriptionTwo`,`DescriptionThree`,`DescriptionFour`,`CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$TestName','$TestCategory','$TestType','$TestFee','$ReportTime','$Parameters','$Requisites','$Measures','$Identifies','$HomeMinutes','$HappyCustomer','$GoogleRating','$HeadingOne','$HeadingTwo','$HeadingThree','$HeadingFour','$DescriptionOne','$DescriptionTwo','$DescriptionThree','$DescriptionFour','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
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
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}

	public function UpdateTestPackageDetails($data)
	{
		extract($data);
		$update_sql = "TestPackageName = '$test_Package_name' , TestPackageCategory= '$test_Package_cat' ,PackageTestName='$package_test_name', TestPackageCode= '$test_Package_code', TestPackageFee= '$test_Package_fee' where ID = $form_test_Package_id";
		$response = $this->_UpdateTableRecords($this->conn, 'test_package', $update_sql);
		return $response;
	}


	public function UpdateTestCatsDetails($data)
	{
		extract($data);
		$update_sql = " TestCategoryName = '$test_category_name' where ID = $form_test_cat_id";
		$response = $this->_UpdateTableRecords($this->conn, 'test_category', $update_sql);
		return $response;
	}

	public function UpdateTestDetails($data)
	{
		extract($data);
		$update_sql = "TestName = '$test_name' , TestCategory= '$test_cat' , TestCode= '$test_code', TestFee= '$test_fee' where ID = $form_test_id";
		$response = $this->_UpdateTableRecords($this->conn, 'doc_test', $update_sql);
		return $response;
	}

	public function GetTestCatDetails($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn, "test_category", $where);
		return $service_details;
	}


	public function GetTestDetails($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn, "doc_test", $where);
		return $service_details;
	}

	public function GetTestDetailsByID($ID)
	{
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn, "doc_test", $where);
		return $service_details;
	}

	public function GetTestPackageDetails($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn, "test_package", $where);
		return $service_details;
	}

	public function DeleteTestCat($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn, "test_category", $where);
		return $service_details;


	}

	public function DeleteTest($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn, "doc_test", $where);
		return $service_details;

	}

	public function DeleteTestPackage($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn, "test_package", $where);
		return $service_details;

	}

	public function GetTestNameByCatID($ID)
	{
		$where = "where TestCategory=$ID";
		$Test_name = $this->_getTableRecords($this->conn, "doc_test", $where);
		return $Test_name;
	}


	// --------------Cart Functionality now here---------------------------------------


	public function InsertTestCart($data)
	{
		$TestId = $data['productId'];
		$ProductName = $data['productName'];
		$Price = $data['productPrice'];
		$UserId = $data['user_id'];
		$TempUserId = $data['temp_user_id'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `test_cart`(`UserID`,`TempUserID`,`ProductID`,`ProductName`,`ProductPrice`,`Quantity`,`CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$UserId','$TempUserId','$TestId','$ProductName','$Price','1','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}

	public function GetCartItemsByTempUserId($TempID)
	{

		$where = "where TempUserID='$TempID'";
		$Test_cart_item = $this->_getTableRecords($this->conn, "test_cart", $where);
		return $Test_cart_item;

	}


	public function DeleteTestCartItem($where)
	{
		$Test_cart_item = $this->_debug_delete_identity_filter($this->conn, "test_cart", $where);
		return $Test_cart_item;

	}

	public function GetAllProductByCartID($CartID)
	{
		$where = "where cart_id=$CartID";
		$Test_cart_item = $this->_getTableRecords($this->conn, "cart_items", $where);
		return $Test_cart_item;
	}


	public function InsertTestCustomerDeliveryInfo($data)
	{
		$UserID = $data['user_id'];
		$FirstName = $data['first_name'];
		$LastName = $data['last_name'];
		$Phone = $data['phone'];
		$Address = $data['address'];
		$Apartment = $data['apartment'];
		$City = $data['city'];
		$State = $data['state'];
		$Postcode = $data['postcode'];
		$Email = $data['email'];
		$Notes = $data['notes'];
		$OrderID = $data['OrderID'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$sql = "INSERT INTO `test_customer_delivery_info`(`UserID`,`FirstName`,`LastName`,`Phone`,`Address`,`Apartment`,`City`,`State`,`Postcode`,`Email`,`Notes`,`OrderID`,`CreatedDate`,`CreatedTime`) VALUES ('$UserID','$FirstName','$LastName','$Phone','$Address','$Apartment','$City','$State','$Postcode','$Email','$Notes','$OrderID','$CreatedDate','$CreatedTime')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}

	public function IndertOrderDetails($data)
	{
		$OrderID = $data['OrderID'];
		$CustomerInfoID = $data['CustomerInfoID'];
		$CartID = $data['cart_id'];
		$TotalAmount = $data['amount'];
		$UserID = $data['user_id'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$PaymentID = $data['PaymentID'];
		$Status = $data['Status'];
		$sql = "INSERT INTO `checkout`(`UserID`,`OrderID`,`CustomerInfoID`,`CartID`,`TotalAmount`,`CreatedDate`,`CreatedTime`,`PaymentID`,`Status`) VALUES ('$UserID','$OrderID','$CustomerInfoID','$CartID','$TotalAmount','$CreatedDate','$CreatedTime','$PaymentID','$Status')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}

	public function UpdateTestPaymentData($data)
	{
		extract($data);
		$update_sql = "PaymentID = '$razorpayPaymentId' , Status = 'Paid' where CartID = $cartID";
		$response = $this->_UpdateTableRecords($this->conn, 'checkout', $update_sql);
		return $response;
	}

	public function updatecartuserID($data)
	{
		extract($data);
		$update_sql = "user_id = '$UserID' where ID = $CartID";
		$response = $this->_UpdateTableRecords($this->conn, 'carts', $update_sql);
		return $response;
	}

	public function GetAllOrdersByUserID($UserID)
	{
		$sql = 'SELECT * from cart_items ci LEFT JOIN checkout ch on ch.CartID = ci.cart_id where ch.UserID = ' . $UserID;
		$orders = $this->_getRecords($this->conn, $sql);
		return $orders;
	}

	
	public function InsertTestReportFile($data)
	{
		$OrderID = $data['order_ID'];
		$BookingID = $data['booking_ID'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$FileName = $data['documents'];
		$sql = "INSERT INTO `order_report` (`OrderID`, `BookingID`, `FileName`, `CreatedDate`, `CreatedTime`) 
            VALUES ('$OrderID', $BookingID, '$FileName', '$CreatedDate', '$CreatedTime')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}

	public function DeleteTestReportFile($data)
	{
		$ID = $data['id'];
		$where = " where ID = $ID";
		$service_details = $this->delete_identity_filter($this->conn, "order_report", $where);
		return $service_details;
	}


}



?>