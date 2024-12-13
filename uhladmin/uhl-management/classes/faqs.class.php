<?php

class Faqs extends Core{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

	public function  GetAllFaqs(){
        $where = " where IsActive = 1";
		$faqs_list = $this->_getTableRecords($this->conn,'faqs',$where);
		return $faqs_list;
	}

	public function InsertFaqsForm($data)
	{
		$Question = $data['Question'];
		$Answer = $data['Answer'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `faqs`(`Question`,`Answer`, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$Question','$Answer','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_details;
	}


   public function GetAllFaqsTable($table)
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


function _getTotalRows($conn, $table, $filter) {
    $sql = "SELECT * FROM $table $filter";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        return []; // Return an empty array if query fails
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row; // Append each row to the array
    }

    return $rows; // Return the array of rows
}



function GetFaqDetailsbyID($ID){
	 $where = " where ID = $ID";
		$faqs_list = $this->_getTableRecords($this->conn,'faqs',$where);
		return $faqs_list;
}
function UpdateFaqsForm($data){
	    extract($data);
		$update_sql = " Question = '$Question',Answer='$Answer' where ID = $form_id";
		$response = $this->_UpdateTableRecords($this->conn,'faqs',$update_sql);
		return $response;
}



function DeleteFaqs($data)
	{
		$FaqsID = $data['ID'];
		// Delete course
		$where = " where ID = $FaqsID";
		$response = $this->delete_identity_filter($this->conn,"faqs",$where);
		return $response;
	}



}


    


 ?>