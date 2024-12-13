<?php

class Doctors extends Core{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

public function cleantext($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

	public function  GetAllDoctors(){
        $where = " where IsActive = 1 ORDER BY ID DESC";
		$Plan_list = $this->_getTableRecords($this->conn,'doctors',$where);
		return $Plan_list;
	}

	public function ApigetAllDoctor() {
    $where = "WHERE IsActive = 1 ORDER BY ID DESC";
    $Doctors_list = $this->_getTableRecords($this->conn, 'doctors', $where);

    $base_url = 'https://unitedhealthlumina.com/uhl-management/project-assets/doctor/';

    // Loop using index to modify the original array
    foreach ($Doctors_list as $key => $doctor) {
        if (!empty($doctor['DoctorImage'])) {
            $Doctors_list[$key]['DoctorImage'] = $base_url . $doctor['DoctorImage']; // Access by index
        }
    }

    return $Doctors_list;
}


public function ApigetAllDoctorById($ID) {
    // Query to fetch the doctor's details by ID
    $where = "WHERE ID = $ID";
    $doctor_details = $this->_getTableRecords($this->conn, 'doctors', $where);

    if (empty($doctor_details)) {
        return null; // Return null if no doctor is found
    }

    $doctor = $doctor_details[0]; // Since only one doctor is expected, use the first record
    $base_url = 'https://unitedhealthlumina.com/uhl-management/project-assets/doctor/';
    $image_base_url = 'https://unitedhealthlumina.com/uhl-management/project-assets/temp_images/';
    $image_base_url_Temp = 'https://unitedhealthlumina.com/uhl-management/doctors/media/';

    // Add the full URL for the DoctorImage if it exists
    if (!empty($doctor['DoctorImage'])) {
        $doctor['DoctorImage'] = $base_url . $doctor['DoctorImage'];
    }

    // Fetch images related to TempImageID from the temp_capture_image table
    $doctor['TempImages'] = [];
    if (!empty($doctor['TempImageID'])) {
        $temp_image_where = "WHERE TempImageID = " . $doctor['TempImageID'];
        $temp_images = $this->_getTableRecords($this->conn, 'temp_capture_image', $temp_image_where);

        // Prepare the images array with full URLs
        foreach ($temp_images as $temp_image) {
            if (!empty($temp_image['Image'])) {
                $doctor['TempImages'][] = $image_base_url_Temp . $temp_image['Image'];
            }
        }
    }

    return $doctor;
}



	public function InsertDoctorForm($data)
	{
		$Name = $data['Name'];
		$DoctorGender = $data['DoctorGender'];
		$phoneNumber = $data['phoneNumber'];
		$Email = $data['email'];
		$Address = $data['address'];
		$MedicalDegrees = $data['medicalDegrees'];
		$Specialization = $data['specialization'];
		$LicenseNumber = $data['licenseNumber'];
		$LicenseExpiryDate = $data['licenseExpiryDate'];
		$Fee = $data['fee'];
		

		$CreatedTime = $data['CreatedTime'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedBy = 'admin@uhl.com';

       $PlanImage='';
       $random_numbers = rand(1000, 10000);
       if(isset($_FILES['DoctorImage']['name']) && isset($_FILES['DoctorImage']['name'])!=''){
       	 $extn_pan = explode('.', $_FILES["DoctorImage"]["name"]);
	        $DoctorImage   = $random_numbers."_item.".$extn_pan[1];
	        $path = "../../project-assets/doctor/".$DoctorImage;
	        move_uploaded_file($_FILES["DoctorImage"]["tmp_name"], $path);
       }

		$sql = "INSERT INTO `doctors` (`DoctorName`, `DoctorImage`, `Gender`, `PhoneNumber`, `Email`, `Address`, `MedicalDegrees`, `Specialization`, `LicenseNumber`, `LicenseExpiryDate`, `Fee`, `CreatedDate`, `CreatedTime`, `CreatedBy`) 
        VALUES ('$Name', '$DoctorImage', '$DoctorGender', '$phoneNumber', '$Email', '$Address', '$MedicalDegrees', '$Specialization', '$LicenseNumber', '$LicenseExpiryDate', '$Fee', '$CreatedDate', '$CreatedTime', '$CreatedBy')";

$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
return $response_insert_details;
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



public function GetDoctorDetailsbyID($ID){
	 $where = " where ID = $ID";
		$Plan_list = $this->_getTableRecords($this->conn,'doctors',$where);
		return $Plan_list;
}


// public function UpdatePlanForm($data){
// 	    extract($data);
// 		$update_sql = " Question = '$Question',Answer='$Answer' where ID = $form_id";
// 		$response = $this->_UpdateTableRecords($this->conn,'Plan',$update_sql);
// 		return $response;
// }


public function UpdateDoctorForm($data)
	{	
		// $center_id = $data['center_id'];

		
		$Name = $data['Name'];
		$DoctorGender = $data['DoctorGender'];
		$phoneNumber = $data['phoneNumber'];
		$Email = $data['email'];
		$Address = $data['address'];
		$MedicalDegrees = $data['medicalDegrees'];
		$Specialization = $data['specialization'];
		$LicenseNumber = $data['licenseNumber'];
		$LicenseExpiryDate = $data['licenseExpiryDate'];
		$Fee = $data['fee'];

		$CreatedTime = $data['CreatedTime'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedBy = 'admin@uhl.com';

         $Doctor_Id = $data['form_id'];

		



	    $old_doctors_details_data = $this->GetDoctorDetailsbyID($Doctor_Id);

	  $old_doctors_details = $old_doctors_details_data[0];


	    $DoctorImage = $old_doctors_details['DoctorImage']; 
       $random_numbers = rand(1000, 10000);
      if (isset($_FILES['DoctorImage']['name']) && $_FILES['DoctorImage']['name'] != '') {
    $extn_pan = explode('.', $_FILES["DoctorImage"]["name"]);
    
   
    if (count($extn_pan) > 1) {
        $extension = end($extn_pan);
        $DoctorImage = $Name . $random_numbers . "_item." . $extension;
        $path = "../../project-assets/doctor/" . $DoctorImage;
        move_uploaded_file($_FILES["DoctorImage"]["tmp_name"], $path);
    } else {
        // Handle case where there's no extension
        $response['message'] = "File does not have a valid extension.";
        $response['error'] = true;
        return $response;
    }
}
			if($Name == $old_doctors_details['DoctorName'] && 
			   $DoctorGender == $old_doctors_details['Gender'] && 
			   $phoneNumber == $old_doctors_details['PhoneNumber'] && 
			   $Email == $old_doctors_details['Email'] && 
			   $Address == $old_doctors_details['Address'] && 
			   $MedicalDegrees == $old_doctors_details['MedicalDegrees'] && 
			   $Specialization == $old_doctors_details['Specialization'] && 
			   $LicenseNumber == $old_doctors_details['LicenseNumber'] && 
			   $LicenseExpiryDate == $old_doctors_details['LicenseExpiryDate'] && 
			   $Fee == $old_doctors_details['Fee'] && 
			   $DoctorImage == $old_doctors_details['DoctorImage'])
			{
			    $response['message'] = "No changes to update";
			    $response['error'] = true;
			}

	    else
	    {
	    	$update_param = "DoctorName = '$Name',
                 DoctorImage = '$DoctorImage', 
                 Gender = '$DoctorGender', 
                 PhoneNumber = '$phoneNumber', 
                 Email = '$Email', 
                 Address = '$Address', 
                 MedicalDegrees = '$MedicalDegrees', 
                 Specialization = '$Specialization', 
                 LicenseNumber = '$LicenseNumber', 
                 LicenseExpiryDate = '$LicenseExpiryDate', 
                 Fee = '$Fee', 
                 CreatedDate = '$CreatedDate',
                 CreatedTime = '$CreatedTime', 
                 CreatedBy = '$CreatedBy'
                 WHERE ID = $Doctor_Id";	

$response = $this->_UpdateTableRecords($this->conn, 'doctors', $update_param);
$response['message'] = "Doctor Details Updated!";
$response['error'] = false;
return $response;

	    }

			
	    return $response;
	}




public function DeleteDoctor($data)
	{
		$PlanID = $data['ID'];
		$where = " where ID = $PlanID";
		$response = $this->delete_identity_filter($this->conn,"doctors",$where);
		return $response;
	}

public function UpdatePlanCoordinator($data){
	extract($data);
	$update_sql = " PlanCoordinator = $PlanCoordinator where ID = $coordinator_form_id";
		$response = $this->_UpdateTableRecords($this->conn,'plans',$update_sql);
		return $response;
}


public function GetAllDocCatWise($data) {
	$cat_name = $data['CategoryName'];
	$where = "WHERE Specialization = '$cat_name'";  
	$doctor_details = $this->_getTableRecords($this->conn, "doctors", $where);
	
 
	$base_url = 'https://unitedhealthlumina.com/uhl-management/project-assets/doctor/';

	
	foreach ($doctor_details as &$doctor) {
			if (!empty($doctor['DoctorImage'])) {
					$doctor['DoctorImage'] = $base_url . $doctor['DoctorImage'];
			}
	}
	
	return $doctor_details;
}


public function PostDoctorAppointment($data){
	extract($data);
		$where = " where ID = $ID";
		$user_details = $this->_getTableRecords($this->conn,' policy_customer',$where);
		
		
		$CreatedDate = $UpdatedDate = date("Y-m-d");
		$CreatedTime = $UpdatedTime = date("H:i:s");
		$CreatedBy = $UpdatedBy = $data['username'];

		if(!empty($user_details)){



		      $Name=$user_details[0]['Name'];
		     $Address=$user_details[0]['Address'];
		     $ContactNumber=$user_details[0]['ContactNumber'];
	
			
			$insert_doctor_appointment = " INSERT INTO `doctor_appointment`(`Name`,`ContactNumber`, `Address`, `DoctorName`, `AppointmentDate`,`AppointmentTime`,`CreatedDate`, `CreatedTime`) VALUES ('$Name','$ContactNumber','$Address','$Doctor','$Date','$Time','$CreatedDate','$CreatedTime')";
			     $response = $this->_InsertTableRecords($this->conn,$insert_doctor_appointment);
               return $response;
		}

		
}


public function GetDoctorAppointment($data){
	extract($data);
$where = " where ID = $ID OR Email= '$username'";
$user_details = $this->_getTableRecords($this->conn,'policy_customer',$where);		

$CreatedDate = $UpdatedDate = date("Y-m-d");
$CreatedTime = $UpdatedTime = date("H:i:s");
$CreatedBy = $UpdatedBy = $data['username'];

if(!empty($user_details)){



		 $Name=$user_details[0]['Name'];
		 $ContactNumber=$user_details[0]['ContactNumber'];
				
			 $where = "where ContactNumber = '$ContactNumber' OR Name= '$Name'";
			 $user_appointment_details = $this->_getTableRecords($this->conn,'doctor_appointment',$where);
 
 
					return $user_appointment_details;
}

}

}


    


 ?>