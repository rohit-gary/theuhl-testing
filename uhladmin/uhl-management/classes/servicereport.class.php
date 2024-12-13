<?php 
class Servicereport extends Core
{
	private $conn;
	private $log_obj;
	public function __construct($conn,$log_obj)
	{
		$this->conn = $conn;
		$this->log_obj = $log_obj;
		$this->setTimeZone();
	}
	public function InitiateServiceReport($data)
	{
		extract($data);
		$CreatedDate = date("Y-m-d");
		$CreatedTime = date("H:i:s");
		$CreatedBy = $data['username'];
		$sql = "INSERT INTO service_reports(CompanyID,CompanySiteID,ServiceID,ChannelPartner,Status,CreatedDate,CreatedTime,CreatedBy) VALUES ($CompanyID,$CompanySiteID,$ServiceID,'$ChannelPartner','Initiated','$CreatedDate','$CreatedTime','$CreatedBy')";
		$this->log_obj->WriteLog($sql,__FILE__,__LINE__);
		$response_insert_report = $this->_InsertTableRecords($this->conn,$sql);
		if($response_insert_report['error'] == true)
		{
			$this->log_obj->WriteLog($response_insert_report['message'],__FILE__,__LINE__);
		}
		return $response_insert_report;
	}

	public function PostGeneralServiceReportDetails($data)
	{
		extract($data);
		$where = " where ReportID = $ReportID";
		$number_of_rows = $this->_getTotalRows($this->conn,'general_service_report',$where);
		$CreatedDate = $UpdatedDate = date("Y-m-d");
		$CreatedTime = $UpdatedTime = date("H:i:s");
		$CreatedBy = $UpdatedBy = $data['username'];
		$technician_user_name = $data['username'];
		if(isset($data['source']))
		{
			$technician_user_name = $data['Technician'];
		}
		if($number_of_rows > 0)
		{
			// Update
			$sql_update_general_service_report = " ReportedBy = '$ReportedBy',AttendedDate='$AttendedDate',RegisteredDate='$RegisteredDate',CompletedDate='$CompletedDate',NatureOfCall = '$NatureOfCall',ProblemReportedByClient='$ProblemReportedByClient',JLLObservation = '$JLLObservation',ActionTaken='$ActionTaken',Technician='$technician_user_name',UpdatedDate='$UpdatedDate',UpdatedTime='$UpdatedTime',UpdatedBy='$username' where ReportID = $ReportID";
			$this->log_obj->WriteLog($sql_update_general_service_report,__FILE__,__LINE__);
			$response = $this->_UpdateTableRecords($this->conn,'general_service_report',$sql_update_general_service_report);
		}
		else
		{
			// Insert
			$Remarks = "";
			$sql_insert_general_service_report = " INSERT INTO `general_service_report`(`ReportID`, `CompanyID`, `CompanySiteID`, `ReportedBy`, `HelpdeskComplaintNumber`, `AttendedDate`, `CompletedDate`,`RegisteredDate`, `NatureOfCall`, `ProblemReportedByClient`, `JLLObservation`, `ActionTaken`,Remarks,`Technician`,`CreatedDate`, `CreatedTime`, `CreatedBy`,`UpdatedDate`, `UpdatedTime`, `UpdatedBy`) VALUES ($ReportID,$CompanyID,$CompanySiteID,'$ReportedBy','$HelpdeskComplaintNumber','$AttendedDate','$CompletedDate','$RegisteredDate','$NatureOfCall','$ProblemReportedByClient','$JLLObservation','$ActionTaken','$Remarks','$technician_user_name','$CreatedDate','$CreatedTime','$CreatedBy','$UpdatedDate','$UpdatedTime','$UpdatedBy')";
			$this->log_obj->WriteLog($sql_insert_general_service_report,__FILE__,__LINE__);
			$response = $this->_InsertTableRecords($this->conn,$sql_insert_general_service_report);
		}

		$sql_update_report_complaint_number = " HelpdeskComplaintNumber = '$HelpdeskComplaintNumber' where ID = $ReportID";
		$this->log_obj->WriteLog($sql_update_report_complaint_number,__FILE__,__LINE__);
		$this->_UpdateTableRecords($this->conn,'service_reports',$sql_update_report_complaint_number);

		if($response['error'] == false)
		{
			$response['message'] = "Report Updated";
		}
		else
		{
			$this->log_obj->WriteLog($response['message'],__FILE__,__LINE__);
		}

		if($action != ""){
			if($action == "Draft")
			{
				$sql_update_report_status = " Status = 'Draft' where ID = $ReportID";
				$this->log_obj->WriteLog($sql_update_report_status,__FILE__,__LINE__);
			}
			else if($action == "submit")
			{
				$sql_update_report_status = " Status = 'Completed' where ID = $ReportID";
				$this->log_obj->WriteLog($sql_update_report_status,__FILE__,__LINE__);
			}else
			{
				
			}
			$response_update_status = $this->_UpdateTableRecords($this->conn,'service_reports',$sql_update_report_status);
			if($response_update_status['error'] == true)
			{
				$this->log_obj->WriteLog($response_update_status['message'],__FILE__,__LINE__);
			}
		}
		
		return $response;
	}

	function PostGeneralServiceReportImages($data)
	{
		$ReportID = $data['ReportID'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];

		$upload_dir = '../media/service_image/';
		foreach ($_FILES['ServiceImages']['tmp_name'] as $key => $val) {
			$file_name = $_FILES['ServiceImages']['name'][$key];
			$file_tmp = $_FILES['ServiceImages']['tmp_name'][$key];
			$file_type = $_FILES['ServiceImages']['type'][$key];
			$file_size = $_FILES['ServiceImages']['size'][$key];
			if($file_size == 0)
			{
				continue;
			}
			$file_error = $_FILES['ServiceImages']['error'][$key];

			$extn = pathinfo($file_name, PATHINFO_EXTENSION);

			$unique_filename = $ReportID . 'ServiceImage_' . $key . '.' . $extn;

			$path = $upload_dir . $unique_filename;
			move_uploaded_file($file_tmp, $path);

			$sql = "INSERT INTO service_report_media(ReportID,Image,CreatedDate,CreatedTime,CreatedBy) VALUES ('$ReportID','$unique_filename','$CreatedDate','$CreatedTime','$CreatedBy')";
			$response_service_report_media = $this->_InsertTableRecords($this->conn,$sql);
			if($response_service_report_media['error'] == false)
			{
				
			}
			else
			{
				return $response_service_report_media;
			}

		}	
	}

	public function PostGeneralServiceReportClientDetails($data)
	{
		extract($data);
		$where = " where ReportID = $ReportID";
		$number_of_rows = $this->_getTotalRows($this->conn,'general_service_report',$where);
		$CreatedDate = $UpdatedDate = date("Y-m-d");
		$CreatedTime = $UpdatedTime = date("H:i:s");
		$CreatedBy = $UpdatedBy = $data['username'];
		if($number_of_rows > 0)
		{
			// Update
			$sql_update_general_service_client_details_report = " ClientRepresentative = '$ClientRepresentative',ClientRepresentativeContact='$ClientRepresentativeContact',Remarks='$Remarks',ClientRepresentativeEmails='$ClientRepresentativeEmails',ClientRepresentativeDesignation='$ClientRepresentativeDesignation',UpdatedDate='$UpdatedDate',UpdatedTime='$UpdatedTime',UpdatedBy='$username' where ReportID = $ReportID";
			$this->log_obj->WriteLog($sql_update_general_service_client_details_report,__FILE__,__LINE__);
			$response = $this->_UpdateTableRecords($this->conn,'general_service_report',$sql_update_general_service_client_details_report);
		}

		if($response['error'] == false)
		{
			$response['message'] = "Report Updated";
		}
		else
		{
			$this->log_obj->WriteLog($response['message'],__FILE__,__LINE__);
		}

		if($action != ""){
			if($action == "Draft")
			{
				$sql_update_report_status = " Status = 'Draft' where ID = $ReportID";
				$this->log_obj->WriteLog($sql_update_report_status,__FILE__,__LINE__);
			}
			else if($action == "submit")
			{
				$sql_update_report_status = " Status = 'Completed' where ID = $ReportID";
				$this->log_obj->WriteLog($sql_update_report_status,__FILE__,__LINE__);
			}
			else
			{
				
			}
			$response_update_status = $this->_UpdateTableRecords($this->conn,'service_reports',$sql_update_report_status);
			if($response_update_status['error'] == true)
			{
				$this->log_obj->WriteLog($response_update_status['message'],__FILE__,__LINE__);
			}
		}

		
		return $response;
	}

	function PostGeneralServiceClientSignature($data)
	{
		$ReportID = $data['ReportID'];

		$SignatureImage = "";

		 if (isset($_FILES['SignatureImage']['name'])  && $_FILES['SignatureImage']['name'] != '')
	    {
	        $extn_pan = explode('.',$_FILES["SignatureImage"]["name"]);
	        $SignatureImage   = $ReportID."Client_sign_.".$extn_pan[1];
	        $path = "../media/signature/".$SignatureImage;
	        move_uploaded_file($_FILES["SignatureImage"]["tmp_name"], $path);
	    }

		$response_client_signature = $this->UpdateSignature($SignatureImage,$ReportID);
		
		return $response_client_signature;

	}

	public function GetAllServiceReports($data)
	{
		$start_counter = $data['start_counter'];
		$no_of_records = $data['no_of_records'];
		$username = $data['username'];
		$sql = "Select a.*,b.Name from service_reports a JOIN user_details b ON a.CreatedBy = b.UserName and a.CreatedBy = '$username' ORDER BY a.ID DESC LIMIT $start_counter,$no_of_records";
		$this->log_obj->WriteLog($sql,__FILE__,__LINE__);
		$service_reports = array();
		//echo $sql;
		$result = mysqli_query($this->conn, $sql);
		if ($result) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					array_push($service_reports, $row);
				}
			}
		} else {
			$error = mysqli_error($this->conn);
			$this->log_obj->WriteLog($error,__FILE__,__LINE__);
		}
		return $service_reports;
	}

	public function GetServiceReportByID($data)
	{
		$ReportID = $data['ID'];
		$where = " where ReportID = $ReportID";
		$row_count = $this->_getTotalRows($this->conn,'general_service_report',$where);
		if($row_count > 0)
		{
			$sql = "SELECT gsr.*,technician_details.Name AS TechnicianName,technician_details.PhoneNumber as TechnicianPhoneNumber,created_by_details.Name AS ReportCreatedByName,sr.Status,sr.ChannelPartner,sr.ServiceID FROM general_service_report gsr JOIN service_reports sr ON gsr.ReportID = sr.ID JOIN user_details created_by_details ON gsr.CreatedBy = created_by_details.UserName JOIN user_details technician_details ON gsr.Technician = technician_details.UserName where gsr.ReportID = $ReportID";
			// $this->log_obj->WriteLog($sql,__FILE__,__LINE__);
			$result=mysqli_query($this->conn,$sql);
			if($result)
			{
				$row = $result->fetch_assoc();
				$service_images_array = array();
				$service_images_id_array = array();
				$ReportID = $row['ReportID'];
				$service_images_where = " where ReportID = $ReportID";
				$service_report_images_raw = $this->_getTableRecords($this->conn,'service_report_media',$service_images_where);
				foreach($service_report_images_raw as $service_report_image)
				{
					array_push($service_images_array,$service_report_image['Image']);
					array_push($service_images_id_array,$service_report_image['ID']);
				}
				$row['report_images'] = $service_images_array;
				$row['report_images_id'] = $service_images_id_array;
			}
			else
			{
				$error = mysqli_error($conn);
				$this->log_obj->WriteLog($error,__FILE__,__LINE__);
			}
		}
		else
		{
			$sql = "SELECT sr.*,created_by_details.Name AS ReportCreatedByName FROM service_reports sr JOIN user_details created_by_details ON sr.CreatedBy = created_by_details.UserName where sr.ID = $ReportID";
			$result=mysqli_query($this->conn,$sql);
			if($result)
			{
				$row = $result->fetch_assoc();
				$row['ReportID'] = $row['ID'];
			}
			else
			{
				$error = mysqli_error($this->conn);
				echo $error;
				$this->log_obj->WriteLog($error,__FILE__,__LINE__);
			}
		}
		
		
		return $row;

	}

	public function UpdateSignature($filename,$ReportID)
	{
		$sql = " ClientSignature = '$filename' where ReportID = $ReportID";
		$this->log_obj->WriteLog($sql,__FILE__,__LINE__);
		$response = $this->_UpdateTableRecords($this->conn,'general_service_report',$sql);
		return $response;
	}

	public function UpdateReportMedia($data)
	{
		$CreatedDate = date("Y-m-d");
		$CreatedTime =  date("H:i:s");
		$CreatedBy = $data['username'];
		$ReportID = $data['ReportID'];
		$filename = $data['filename'];
		$insert_sql = " INSERT INTO service_report_media(ReportID,Image,CreatedDate,CreatedTime,CreatedBy)VALUES($ReportID,'$filename','$CreatedDate','$CreatedTime','$CreatedBy')";
		$this->log_obj->WriteLog($insert_sql,__FILE__,__LINE__);
		$response = $this->_InsertTableRecords($this->conn,$insert_sql);
		return $response;
	}

	public function GetServiceReportMedia($ReportID)
	{
		$where = " where ID = $ReportID";
		$service_report_media_details = $this->_getTableDetails($this->conn,"service_report_media",$where);
		return $service_report_media_details;
	}

	public function DeleteServiceImage($data)
	{
		$ServiceImageID = $data['ID'];
		$where = " where ID = $ServiceImageID";
		$response = $this->delete_identity_filter($this->conn,"service_report_media",$where);
		return $response;
	}
	

}