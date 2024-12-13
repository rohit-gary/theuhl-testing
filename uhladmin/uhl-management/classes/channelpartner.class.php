<?php
 class ChannelPartner extends Core {
private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

     public function cleantext($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

	public function  GetAllChannelPartners(){
        $where = " where IsActive = 1";
		$list = $this->_getTableRecords($this->conn,'channel_partner',$where);
		return $list;
	}

  public function InsertMasterUserChannelPartner($data)
	{
		$user_name = $data['name'];
		$user_username = $data['email'];
		$user_phone_number = $data['phone_number'];
		$email = $data['email'];
		$OrgID = $data['OrgID'];
		$password = md5($data['password']);
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$sql = "INSERT INTO users(UserName,Name,PhoneNumber,Email,Password,UserType,OrgID,CreatedDate,CreatedTime) VALUES ('$user_username','$user_name','$user_phone_number','$email','$password','Channel Partner',$OrgID,'$CreatedDate','$CreatedTime')";
		$response_insert_user = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_user;


	}

	public function CheckDuplicateChannelPartner($data)
	{
		$user_username = $data['name'];
		$email_id = $data['email'];
		$response = array();
		$where = " where Email = '$email_id' OR Name = '$user_username' and IsActive = 1";
		if($this->check_unique_identity_filter($this->conn,'users',$where))
		{
			$response['error'] = false;
			$response['message'] = "Unique User";
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "A user is already registered with same Username or Email, please change the values and try again!";
		}
		return $response;
	}

	public function InsertChannelPartnerForm($data)
	{
		$Name = $data['name'];
		$ChannelPartnerTin = $data['tin'];
		$UserID = $data['UserID'];
		$PhoneNumber = $data['phone_number'];
		$Email = $data['email'];
		$Address = $data['address'];
		$RegistrationNumber = $data['registration_number'];
		$LicenseNumber = $data['license_number'];
		$AlternativeContact = $data['alternative_contact'];
	        $CreatedTime = $data['CreatedTime'];
			$CreatedDate=$data['CreatedDate'];
			$CreatedBy =$data['CreatedBy'] ; 
		$sql = "INSERT INTO `channel_partner` (`Name`,  `Email`, `PhoneNumber`,`Tin`,`Address`, `RegistrationNumber`,  `LicenseNumber`, `AlternativeContact`,  `CreatedDate`, `CreatedTime`, `CreatedBy`) 
        VALUES ('$Name', '$Email','$PhoneNumber','$ChannelPartnerTin','$Address', '$RegistrationNumber', '$LicenseNumber','$AlternativeContact', '$CreatedDate', '$CreatedTime', '$CreatedBy')";

$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
  $response_insert_details;



     if($response_insert_details['error'] == false)
		{     
		   
			$sql = "INSERT INTO user_roles(UserID,Role,CreatedDate,CreatedTime) VALUES ('$UserID','Channel Partner','$CreatedDate','$CreatedTime')";
			$response_insert_user = $this->_InsertTableRecords($this->conn,$sql);
			return $response_insert_user;
		}
		else
		{
			return $response_insert_details;
		}


	}


   public function GetAllplansTable($table)
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


public function _getTotalRows($conn, $table, $filter) {
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



public function GetChannelPartnerDetailsbyID($ID){
	 $where = " where ID = $ID";
		$List = $this->_getTableRecords($this->conn,'channel_partner',$where);
		return $List;
}


// public function UpdatePlanForm($data){
// 	    extract($data);
// 		$update_sql = " Question = '$Question',Answer='$Answer' where ID = $form_id";
// 		$response = $this->_UpdateTableRecords($this->conn,'Plan',$update_sql);
// 		return $response;
// }


public function UpdateChannelPartnerForm($data)
	{	
		// $center_id = $data['center_id'];

		
		$Name = $data['name'];
		$ChannelPartnerTin = $data['tin'];
		$PhoneNumber = $data['phone_number'];
		$Email = $data['email'];
		$Address = $data['address'];
		$RegistrationNumber = $data['registration_number'];
		$LicenseNumber = $data['license_number'];
		$AlternativeContact = $data['alternative_contact'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedBy = 'admin@uhl.com';
         $ChannelPartner_Id = $data['form_id'];
	      $old_ChannelPartners_details_data = $this->GetChannelPartnerDetailsbyID($ChannelPartner_Id);
	     $old_ChannelPartners_details = $old_ChannelPartners_details_data[0];

  

			if($Name == $old_ChannelPartners_details['Name'] && 
			   $RegistrationNumber == $old_ChannelPartners_details['RegistrationNumber'] && 
			   $PhoneNumber == $old_ChannelPartners_details['PhoneNumber'] && 
			   $Email == $old_ChannelPartners_details['Email'] && 
			   $Address == $old_ChannelPartners_details['Address'] && 
			   $LicenseNumber == $old_ChannelPartners_details['LicenseNumber'] && 
			   $AlternativeContact == $old_ChannelPartners_details['AlternativeContact'] && 
			   $LicenseNumber == $old_ChannelPartners_details['LicenseNumber']&&
			   $ChannelPartnerTin == $old_ChannelPartners_details['Tin']
			   
			   )
			{
			    $response['message'] = "No changes to update";
			    $response['error'] = true;
			}

	    else
	    {
	    	$update_param = "Name = '$Name',
                 PhoneNumber = '$PhoneNumber', 
                 Email = '$Email', 
                 Address = '$Address', 
                 Tin = '$ChannelPartnerTin', 
                 RegistrationNumber = '$RegistrationNumber', 
                 LicenseNumber = '$LicenseNumber', 
                 
                 AlternativeContact = '$AlternativeContact', 
                 CreatedDate = '$CreatedDate',
                 CreatedTime = '$CreatedTime', 
                 CreatedBy = '$CreatedBy'
                 WHERE ID = $ChannelPartner_Id";	

$response = $this->_UpdateTableRecords($this->conn, 'channel_partner', $update_param);
$response['message'] = "ChannelPartner Details Updated!";
$response['error'] = false;
return $response;

	    }

			
	    return $response;
	}




public function DeleteChannelPartner($data)
	{
		$ID = $data['ID'];
		$where = " where ID = $ID";
		$response = $this->delete_identity_filter($this->conn,"channel_partner",$where);
		return $response;
	}



}



?>