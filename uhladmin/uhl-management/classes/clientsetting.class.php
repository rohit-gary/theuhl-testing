<?php 
class Clientsetting extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function getSettingDetails()
	{
		$where = " where ID = 1";
		$setting = $this->_getTableDetails($this->conn,'sequences',$where);
		return $setting;
	}
	public function UpdateCRNNumber($crn)
	{
		$update_crn = " CRN = $crn where ID = 1";
		$response = $this->_UpdateTableRecords($this->conn,'sequences',$update_crn);
		return $response;
	}
	public function UpdateBillNumber($bill_number)
	{
		$update_bill_number = " BillNumber = $bill_number where ID = 1";
		$response = $this->_UpdateTableRecords($this->conn,'sequences',$update_bill_number);
		return $response;
	}
	public function UpdatePaymentReceiptNumber($payment_receipt_number)
	{
		$update_payment_receipt_number = " PaymentReceiptNumber = $payment_receipt_number where ID = 1";
		$response = $this->_UpdateTableRecords($this->conn,'sequences',$update_payment_receipt_number);
		return $response;
	}
	public function getPaymentModes()
	{
		$where = " where IsActive = 1";
		$response = $this->_getTableRecords($this->conn,'payment_modes',$where);
		return $response;
	}
	public function getOPDCategories()
	{
		$where = " where IsActive = 1";
		$response = $this->_getTableRecords($this->conn,'opd_categories',$where);
		return $response;
	}
	public function getIPDCategories()
	{
		$where = " where IsActive = 1";
		$response = $this->_getTableRecords($this->conn,'ipd_categories',$where);
		return $response;
	}
	public function getIPDCategoryDetails($CategoryName)
	{
		$where = " where CategoryName = '$CategoryName'";
		$response = $this->_getTableDetails($this->conn,'ipd_categories',$where);
		return $response;
	}
	public function InsertOPDCategory($data)
	{
		extract($data);
		$sql = "INSERT INTO opd_categories(CategoryName,CreatedDate,CreatedTime,CreatedBy)VALUES('$opd_category','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response = $this->_InsertTableRecords($this->conn,$sql);
		return $response;
	}
	public function InsertPaymentMode($data)
	{
		extract($data);
		$sql = "INSERT INTO payment_modes(PaymentMode,CreatedDate,CreatedTime,CreatedBy)VALUES('$payment_mode','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response = $this->_InsertTableRecords($this->conn,$sql);
		return $response;
	}
	public function UpdateOPDCategory($data)
	{
		extract($data);
		$update_query = " CategoryName = '$opd_category' where ID = $opd_category_form_id";
		$response = $this->_UpdateTableRecords($this->conn,'opd_categories',$update_query);
		return $response;
	}
	public function UpdatePaymentMode($data)
	{
		extract($data);
		$update_query = " PaymentMode = '$payment_mode' where ID = $payment_mode_form_id";
		$response = $this->_UpdateTableRecords($this->conn,'payment_modes',$update_query);
		return $response;
	}
	public function InsertIPDCategory($data)
	{
		extract($data);
		$sql = "INSERT INTO ipd_categories(CategoryName,Price,CreatedDate,CreatedTime,CreatedBy)VALUES('$ipd_category','$ipd_category_price','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response = $this->_InsertTableRecords($this->conn,$sql);
		return $response;
	}
	public function UpdateIPDCategory($data)
	{
		extract($data);
		$update_query = " CategoryName = '$ipd_category',Price='$ipd_category_price' where ID = $ipd_category_form_id";
		$response = $this->_UpdateTableRecords($this->conn,'ipd_categories',$update_query);
		return $response;
	}


}