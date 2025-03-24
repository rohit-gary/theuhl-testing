<?php

class Plans extends Core{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

public function cleantext($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

	public function GetAllPlan() {
		$where = " WHERE IsActive = 1 ORDER BY ID ASC";

   
    $Plan_list = $this->_getTableRecords($this->conn, 'plans', $where);

    
    $base_url = 'https://unitedhealthlumina.com/uhladmin/uhl-management/project-assets/plan/';
		

   
    foreach ($Plan_list as &$plan) {
        if (!empty($plan['PlanImage'])) {
            $plan['PlanImage'] = $base_url . $plan['PlanImage']; 
        }
    }

    return $Plan_list;
}




	public function InsertPlanForm($data)
	{
		$PlanName = $data['Name'];
		$PlanDuration = $data['Duration'];

		$PlanDurationFormat = $data['DurationFormat'];
		$PlanFamilyMember = $data['family_member']; 
		$PlanMinimumFamilyMember = $data['min_family_member'];
		$CoverageComments = $data['coverage_comments'];
		$PlanCost = $data['PlanCost'];
		$PlanImportantPoint = $data['plan_point'];

		$MinimumAge = $data['minimum_age'];
		$MaximumAge = $data['maximum_age'];
		$ValidArea = $data['valid_area'];
		$Payments = $data['payments'];
                                                                                                                                                                                                                                                                                    




		$PlanHighlights = $data['plan_highlights'];
		$PlanDescription = $data['plan_Description'];

		$CreatedTime = $data['CreatedTime'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedBy = 'admin@uhl.com';
		$IsDisplay=$data['isDisplay'];

       $PlanImage='';
       $random_numbers = rand(1000, 10000);
       if(isset($_FILES['PlanImage']['name']) && isset($_FILES['PlanImage']['name'])!=''){
       	 $extn_pan = explode('.', $_FILES["PlanImage"]["name"]);
	        $PlanImage   = $random_numbers."_item.".$extn_pan[1];
	        $path = "../../project-assets/plan/".$PlanImage;
	        move_uploaded_file($_FILES["PlanImage"]["tmp_name"], $path);
       }

		$sql = "INSERT INTO `plans`(`PlanName`,`PlanImage`,`PlanDuration`,`PlanDurationFormat`,`PlanFamilyMember`,`PlanMinimumFamilyMember`,`CoverageComments`,`PlanCost`,`PlanImportantPoint`,`MinimumAge`,`MaximumAge`,`ValidArea`,`Payments`,`PlanHighlights`,`PlanDescription`,`CreatedDate`, `CreatedTime`, `CreatedBy`,`IsDisplay`) VALUES ('$PlanName','$PlanImage','$PlanDuration','$PlanDurationFormat','$PlanFamilyMember','$PlanMinimumFamilyMember','$CoverageComments','$PlanCost','$PlanImportantPoint','$MinimumAge','$MaximumAge','$ValidArea','$Payments','$PlanHighlights','$PlanDescription','$CreatedDate','$CreatedTime','$CreatedBy','$IsDisplay')";
		    $response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
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



public function GetAllPlanDetailsbyID($ID){
	     $sql = "SELECT * FROM plans where ID= $ID";
		$Plan_list = $this->_getRecords($this->conn,$sql);
		return $Plan_list;
}


public function GetPlanDetailsbyID($ID){
	 $where = " where ID = $ID";
		$Plan_list = $this->_getTableRecords($this->conn,'plans',$where);
		return $Plan_list;
}

public function ApigetPlanDetailsbyID($ID){
	$where = "WHERE ID = $ID";
	$Plan_list = $this->_getTableRecords($this->conn, 'plans', $where);

	$base_url = 'https://unitedhealthlumina.com/uhladmin/uhl-management/project-assets/plan/';
	
	if (!empty($Plan_list) && isset($Plan_list[0]['PlanImage'])) {
			
			if (!empty($Plan_list[0]['PlanImage'])) {
					$Plan_list[0]['PlanImage'] = $base_url . $Plan_list[0]['PlanImage'];
			}
	}
	
	return $Plan_list[0];  
}


public function GetFamilyMembersByPlanIDAndPolicyNumber($planID, $policyNumber)
{
    $where = "WHERE PlanID = '$planID' AND PolicyNumber = '$policyNumber'";
    $family_members = $this->_getTableRecords($this->conn, 'policy_member_details', $where);
    return $family_members;
}

// public function UpdatePlanForm($data){
// 	    extract($data);
// 		$update_sql = " Question = '$Question',Answer='$Answer' where ID = $form_id";
// 		$response = $this->_UpdateTableRecords($this->conn,'Plan',$update_sql);
// 		return $response;
// }


public function UpdatePlanForm($data)
	{	
		// $center_id = $data['center_id'];
		
		$PlanName = $data['Name'];
		$PlanDuration = $data['Duration'];

		$PlanDurationFormat = $data['DurationFormat'];
		$PlanFamilyMember = $data['family_member'];
		$PlanMinimumFamilyMember = $data['min_family_member'];
		$CoverageComments = $data['coverage_comments'];
		$PlanCost = $data['PlanCost'];
		$PlanImportantPoint = $data['plan_point'];


		$MinimumAge = $data['minimum_age'];
		$MaximumAge = $data['maximum_age'];
		$ValidArea = $data['valid_area'];
		$Payments = $data['payments'];


		$PlanHighlights = $data['plan_highlights'];
		$PlanDescription = $data['plan_Description'];

		$CreatedTime = $data['CreatedTime'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedBy = 'admin@uhl.com';
		$IsDisplay=$data['isDisplay'];

		$Plan_id = $data['form_id'];




	    $old_programs_details_data = $this->GetPlanDetailsbyID($Plan_id);

	  $old_programs_details = $old_programs_details_data[0];


		 $PlanImage=$old_programs_details['PlanImage'];
       $random_numbers = rand(1000, 10000);
      if (isset($_FILES['PlanImage']['name']) && $_FILES['PlanImage']['name'] != '') {
    $extn_pan = explode('.', $_FILES["PlanImage"]["name"]);
    
    // Ensure the file has an extension
    if (count($extn_pan) > 1) {
        $extension = end($extn_pan);
        $PlanImage = $PlanName . $random_numbers . "_item." . $extension;
        $path = "../../project-assets/plan/" . $PlanImage;
        move_uploaded_file($_FILES["PlanImage"]["tmp_name"], $path);
    } else {
        // Handle case where there's no extension
        $response['message'] = "File does not have a valid extension.";
        $response['error'] = true;
        return $response;
    }
}

	    if($PlanName == $old_programs_details['PlanName']  && $PlanDuration == $old_programs_details['PlanDuration'] && $PlanHighlights == $old_programs_details['PlanHighlights'] && $PlanDescription == $old_programs_details['PlanDescription'] && $PlanImage == $old_programs_details['PlanImage'] && $PlanDurationFormat == $old_programs_details['PlanDurationFormat']&& $PlanCost == $old_programs_details['PlanCost'] && $PlanFamilyMember == $old_programs_details['PlanFamilyMember']&& $CoverageComments == $old_programs_details['CoverageComments']&& $PlanImportantPoint == $old_programs_details['PlanImportantPoint'] && $PlanMinimumFamilyMember == $old_programs_details['min_family_member'] && $MinimumAge == $old_programs_details['minimum_age'] && $MaximumAge == $old_programs_details['maximum_age'] && $ValidArea == $old_programs_details['valid_area'] && $Payments == $old_programs_details['payments']&& $IsDisplay == $old_programs_details['isDisplay'])
	    {
	    	$response['message'] = "No changes to update";
	    	$response['error'] = true;
	    }
	    else
	    {
	    	$update_param = "PlanName = '$PlanName',
	    	     PlanImage='$PlanImage', 
                 PlanDuration = '$PlanDuration', 
                 PlanDurationFormat = '$PlanDurationFormat', 
                 PlanFamilyMember = '$PlanFamilyMember',
                 PlanMinimumFamilyMember= '$PlanMinimumFamilyMember', 
                 CoverageComments = '$CoverageComments', 
                 PlanCost = '$PlanCost', 
                 PlanImportantPoint = '$PlanImportantPoint',
                 
                 MinimumAge = '$MinimumAge',
                 MaximumAge = '$MaximumAge',
                 ValidArea = '$ValidArea',
                 Payments = '$Payments',

                 PlanHighlights = '$PlanHighlights', 
                 PlanDescription = '$PlanDescription',
                 CreatedDate = '$CreatedDate',
                 CreatedTime = '$CreatedTime', 
                 CreatedBy = '$CreatedBy',
                 IsDisplay='$IsDisplay'
                 WHERE ID = $Plan_id";	


             $response = $this->_UpdateTableRecords($this->conn,'plans', $update_param);
			 $response['message'] = "Programs Details Updated !";
			 $response['error'] = false;
			 return $response;
	    }

			
	    return $response;
	}




public function DeletePlan($data)
	{
		$PlanID = $data['ID'];
		$where = " where ID = $PlanID";
		$response = $this->delete_identity_filter($this->conn,"plans",$where);
		return $response;
	}

public function UpdatePlanCoordinator($data){
	extract($data);
	$update_sql = " PlanCoordinator = $PlanCoordinator where ID = $coordinator_form_id";
		$response = $this->_UpdateTableRecords($this->conn,'plans',$update_sql);
		return $response;
}

public function GetAllPlanExclusitions(){
	$where='Where IsActive=1';
	$Plan_Exclustion = $this->_getTableRecords($this->conn, 'plan_exclusions', $where);
    
    return $Plan_Exclustion;

}


}





    


 ?>