<?php 
class Transaction extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function GetAllTransaction()
	{
		$where = " where 1";
		$transaction_list = $this->_getTableRecords($this->conn,'payments',$where);
		return $transaction_list;
	}


	
	public function GetAllTransactionByPolicyID($ID){
		$where = " where policyID=$ID";
		$transaction_list = $this->_getTableRecords($this->conn,'payments',$where);
		return $transaction_list;
	} 

    public function GetAllTransactionByPolicyNumber($Number){
        $where = " where PolicyNumber= '$Number'";
        $transaction_list = $this->_getTableRecords($this->conn,'payments',$where);
        return $transaction_list;
    } 


public function insertPaymentsDetails($data) {
    // Get POST data from the form submission
    $policy_id = $_POST['policy_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $amount = $_POST['amount'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $payment_mode = $_POST['payment_mode'];
    $account_number = isset($_POST['account_number']) ? $_POST['account_number'] : null;
    $ifsc_code = isset($_POST['ifsc_code']) ? $_POST['ifsc_code'] : null;

    // Validate required fields
    if (empty($razorpay_payment_id) || empty($razorpay_order_id) || empty($amount) || empty($name) || empty($phone) || empty($status) || empty($payment_mode)) {
        echo "All required fields must be filled.";
        return;
    }

    // Prepare the data to insert into the payments table
    $paymentData = array(
        'PolicyID' => $policy_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_order_id' => $razorpay_order_id,
        'Amount' => $amount,
        'Name' => $name,
        'Phone' => $phone,
        'Status' => $status,
        'PaymentMode' => $payment_mode
    );

    // Insert payment details
    $response_insert_payment = $this->_InsertTableRecords_prepare($this->conn, 'payments', $paymentData);

    // Check if the payment details were inserted successfully
    if ($response_insert_payment) {
        // Get the last inserted PaymentID using LAST_INSERT_ID()
        $payment_id = $response_insert_payment['last_insert_id'];

        // Check if payment mode is 'bank' or 'neft' to insert bank details
        if ($payment_mode == 'Bank' || $payment_mode == 'NEFT') {
            // Prepare the data to insert into the PaymentBankDetail table
            $bankDetails = array(
                 'PolicyID'=>   $policy_id,
                 'PaymentID' => $payment_id,
                'AccountNumber' => $account_number,
                'IFSCCode' => $ifsc_code,
                'CreatedDate' => date("Y-m-d"),
                'CreatedTime' => date("H:i:s"),
            );

            // Insert account details into PaymentBankDetail table
            $response_insert_bank_details = $this->_InsertTableRecords_prepare($this->conn, 'paymentbankdetail', $bankDetails);

            // Check if the bank details were inserted successfully
            if ($response_insert_bank_details) {
                // Both payment and bank details inserted successfully
                echo json_encode(['error' => false, 'message' => 'Payment and bank details inserted successfully!']);
            } else {
                // Error inserting bank details
                echo json_encode(['error' => true, 'message' => 'Error inserting bank details.']);
            }
        } else {
            // Payment mode is not bank or neft, skip bank details insertion
            echo json_encode(['error' => false, 'message' => 'Payment details inserted successfully!']);
        }
    } else {
        // Error inserting payment details
        echo json_encode(['error' => true, 'message' => 'Error inserting payment details.']);
    }
}


}

?>