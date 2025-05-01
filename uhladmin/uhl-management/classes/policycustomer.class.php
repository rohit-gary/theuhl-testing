<?php
class PolicyCustomer extends Core
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->setTimeZone();
    }

    public function cleantext($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    public function GetAllPolicyCustomer()
    {
        $where = " where IsActive = 1";
        $list = $this->_getTableRecords($this->conn, 'policy_customer', $where);
        return $list;
    }

    public function checkDuplicatePolicyCustomer($data)
    {

        $phoneNumber = $data['poc_contact_number'];
        $email = $data['email'];


        $sql = "SELECT * FROM policy_customer 
            WHERE 	ContactNumber = '$phoneNumber' 
            OR Email = '$email'";


        $result = $this->_getRecords($this->conn, $sql);


        if (!empty($result)) {
            return true;
        }


        return false;
    }

    public function InsertMasterPolicyUser($data)
    {

        $data['CreatedTime'] = date('H:i:s');
        $data['CreatedDate'] = date('Y-m-d');
        $user_name = $data['name'];
        $user_username = $data['name'];
        $user_phone_number = $data['phone_number'];
        $email = $data['email'];
        $OrgID = $data['OrgID'];
        $password = md5($data['password']);
        $CreatedDate = $data['CreatedDate'];
        $CreatedTime = $data['CreatedTime'];
        $sql = "INSERT INTO users(UserName,Name,PhoneNumber,Email,Password,UserType,OrgID,CreatedDate,CreatedTime) VALUES ('$user_username','$user_name','$user_phone_number','$email','$password','Policy Customer',$OrgID,'$CreatedDate','$CreatedTime')";
        $response_insert_user = $this->_InsertTableRecords($this->conn, $sql);
        return $response_insert_user;

    }


    function InsertUserRole($UserID)
    {
        $data['CreatedTime'] = date('H:i:s');
        $data['CreatedDate'] = date('Y-m-d');
        $CreatedTime = $data['CreatedTime'];
        $CreatedDate = $data['CreatedDate'];

        $sql = "INSERT INTO user_roles(UserID,Role,CreatedDate,CreatedTime) VALUES ('$UserID','Policy Customer','$CreatedDate','$CreatedTime')";
        $response_insert_user = $this->_InsertTableRecords($this->conn, $sql);
        return $response_insert_user;
    }

    public function CheckDuplicateChannelPartner($data)
    {
        $user_username = $data['name'];
        $email_id = $data['email'];
        $response = array();
        $where = " where Email = '$email_id' OR Name = '$user_username' and IsActive = 1";
        if ($this->check_unique_identity_filter($this->conn, 'users', $where)) {
            $response['error'] = false;
            $response['message'] = "Unique User";
        } else {
            $response['error'] = true;
            $response['message'] = "A user is already registered with same Username or Email, please change the values and try again!";
        }
        return $response;
    }

    // 	public function InsertPolicyCustomerForm($data)
// 	{
// 		 $prefix = 'UHL';
// 		 $randomNumber = mt_rand(100000, 999999);

    // 		$PolicyNumber=$prefix . $randomNumber;
// 		$Name = $data['poc_name'];
// 		$PlanID = $data['plan'];
//         $PlanAmount=$data['plan_cost'];
// 		$PlanDurationFormat=$data['plan_duration_format'];
// 		$IssueDate = $data['CreatedDate'];


    //         // $DurationValue = (int)$_POST['plan_duration_value'];

    //         $DurationValue = 1;
//         $DurationValue = (int)$data['plan_duration'];


    //        if (!empty($IssueDate) && !empty($PlanDurationFormat) && $DurationValue > 0) {

    //         $issueDateTime = new DateTime($IssueDate);


    //         switch (strtolower($PlanDurationFormat)) {
//             case 'years':

    //                 $issueDateTime->modify("+{$DurationValue} years");

    //                 $issueDateTime->modify('-1 day');

    //                 $issueDateTime->setTime(23, 59, 59);
//                 break;
//             case 'months':

    //                 $issueDateTime->modify("+{$DurationValue} months");
//                 $issueDateTime->modify('-1 day'); 
//                 $issueDateTime->setTime(23, 59, 59); 
//                 break;
//             case 'weeks':

    //                 $issueDateTime->modify("+{$DurationValue} weeks");
//                 $issueDateTime->modify('-1 day'); 
//                 $issueDateTime->setTime(23, 59, 59); 
//                 break;
//             default:
//                 exit;
//         }


    //         $PolicyLastDate = $issueDateTime->format('Y-m-d H:i:s');



    //     } else {
//         echo "Please fill in all fields correctly.";
//     }


    //        $FamilyMemberCount=0;
// 		$ContactNumber = $data['poc_contact_number'];
// 		$Gender = $data['gender'];
// 		$DateOfBirth = $data['dob'];
// 		$Email = $data['email'];
// 		$Address = $this->conn->real_escape_string($data['address']);
// 		$State = $data['state'];
// 		$Pincode = $data['pincode'];
// 		$BuyingFor = $data['buying_for'];
// 		$FamilyMemberCount = $data['familyMemberCount'];
//          $CreatedTime = $data['CreatedTime'];
// 	     $CreatedDate=$data['CreatedDate'];
// 			 $UserID = isset($data['UserID']) ? $data['UserID'] : -1;

    // 	     $CreatedBy='admin';
// 	     if(isset($data['CreatedBy'])){
// 	     	$CreatedBy =$data['CreatedBy'];
// 	     }	

    // 		$sql = "INSERT INTO `policy_customer` (`UserID`,`PolicyNumber`,`PlanID`,`PlanAmount`,`Issue_Date`, `Policy_Last_Date`,`Name`, `ContactNumber`,`Gender`,`DateOfBirth`, `Email`,  `Address`, `State`,`Pincode`,`BuyingFor`,`FamilyMemberCount`,  `CreatedDate`, `CreatedTime`, `CreatedBy`) 
//           VALUES ('$UserID','$PolicyNumber', '$PlanID','$PlanAmount','$IssueDate','$PolicyLastDate','$Name','$ContactNumber', '$Gender', '$DateOfBirth','$Email','$Address','$State','$Pincode','$BuyingFor','$FamilyMemberCount', '$CreatedDate', '$CreatedTime', '$CreatedBy')";

    //   $response_insert_details = $this->_InsertTableRecords($this->conn, $sql);


    //  $last_insert_id=$response_insert_details['last_insert_id'];

    //      if($response_insert_details['error'] == false)
// 		{     
// 		   $PolicyCustomerID=$response_insert_details['last_insert_id'];
// 			if($FamilyMemberCount > 0) {
//             for ($i = 1; $i <= $FamilyMemberCount; $i++) {
//                 $memberName = $data["member_name_$i"];
//                 $memberDOB = $data["member_dob_$i"];
// 								$memberDOB = $data["member_dob_$i"];

    // 										// Check if the date of birth is not empty
// 										if (!empty($memberDOB)) {
// 												// Create a DateTime object for the member's date of birth
// 												$dob = new DateTime($memberDOB);

    // 												// Get the current date
// 												$currentDate = new DateTime();

    // 												// Calculate the age by finding the difference in years
// 												$ageInterval = $dob->diff($currentDate);
// 												$memberAge = $ageInterval->y; // 'y' gives the number of years (age)
// 										} else {
// 												// If the date of birth is empty or invalid, set age to -1 (or handle it accordingly)
// 												$memberAge = -1;
// 										}
//                 $memberGender = $data["member_gender_$i"];
//                 $memberRelationship = $data["member_relationship_$i"];
//                 $sql = "INSERT INTO `policy_member_details` (`PolicyCustomerID`,`PolicyNumber`, `Name`, `DateOfBirth`, `Age`, `Gender`, `Relationship`, `CreatedDate`, `CreatedTime`, `CreatedBy`)
//                     VALUES ('$PolicyCustomerID','$PolicyNumber', '$memberName', '$memberDOB', '$memberAge', '$memberGender', '$memberRelationship', '$CreatedDate', '$CreatedTime', '$CreatedBy')";

    //              $response_insert_user=$this->_InsertTableRecords($this->conn, $sql);
//             }
//             $response_insert_user['last_insert_id'] = $last_insert_id;
//             return $response_insert_user;
//         } else{

    //         	return $response_insert_details;
//         }

    // 		}
// 		else
// 		{
// 			return $response_insert_details;
// 		}


    // 	}


    public function InsertCustomerForm($data)
    {

        $Name = $data['poc_name'];
        $ContactNumber = $data['poc_contact_number'];
        $Gender = $data['gender'];
        $DateOfBirth = $data['dob'];
        $Email = $data['email'];
        $Address = $this->conn->real_escape_string($data['address']);
        $PAddress = $this->conn->real_escape_string($data['p_address']);
        $State = $data['state'];
        $Pincode = $data['pincode'];
        $CreatedTime = $data['CreatedTime'];
        $CreatedDate = $data['CreatedDate'];
        $UserID = isset($data['UserID']) ? $data['UserID'] : -1;
        $CreatedBy = isset($data['CreatedBy']) ? $data['CreatedBy'] : "UHL Admin";

        // Prepare main customer data
        $customerData = array(
            'UserID' => $UserID,
            'Name' => $Name,
            'ContactNumber' => $ContactNumber,
            'Gender' => $Gender,
            'DateOfBirth' => $DateOfBirth,
            'Email' => $Email,
            'Address' => $Address,
            'PermanentAddress' => $PAddress,
            'State' => $State,
            'Pincode' => $Pincode,
            'CreatedDate' => $CreatedDate,
            'CreatedTime' => $CreatedTime,
            'CreatedBy' => $CreatedBy

        );
        // Insert customer data
        $response_insert_details = $this->_InsertTableRecords_prepare($this->conn, 'all_customer', $customerData);
        return $response_insert_details;
    }


    public function UpdateCustomerForm($data)
    {

        extract($data);
        $ID = $data['form_id'];
        $Name = $data['poc_name'];
        $ContactNumber = $data['poc_contact_number'];
        $Gender = $data['gender'];
        $DateOfBirth = $data['dob'];
        $Email = $data['email'];
        $Address = $this->conn->real_escape_string($data['address']);
        $State = $data['state'];
        $Pincode = $data['pincode'];

        $update_param = "
                            'Name' => $Name,
                            'ContactNumber' => $ContactNumber,
                            'Gender' => $Gender,
                            'DateOfBirth' => $DateOfBirth,
                            'Email' => $Email,
                            'Address' => $Address,
                            'State' => $State,
                            'Pincode' => $Pincode,
                            WHERE ID = $ID";

        $response = $this->_UpdateTableRecords($this->conn, 'all_customer', $update_param);
        $response['message'] = "ChannelPartner Details Updated!";
        $response['error'] = false;
        return $response;


    }


    public function InsertPolicyForm($data)
    {
        // Prefix and random number for Policy Number
        $prefix = 'UHL';
        $randomNumber = mt_rand(100000, 999999);
        $PolicyNumber = $prefix . $randomNumber;

        // Retrieve data from input
        $CustomerID = $data['customer_id'];
        $PlanIDs = is_array($data['plans']) ? $data['plans'] : [$data['plans']]; // Multiple Plan IDs expected
        $PlanAmount = isset($data['plan_amount']) ? $data['plan_amount'] : 0; // Default amount if not provided
        $CreatedDate = date('Y-m-d'); // Current date
        $CreatedTime = date('H:i:s'); // Current time
        $CreatedBy = isset($data['CreatedBy']) ? $data['CreatedBy'] : 'System'; // Default to 'System'

        // Validate input data
        if (empty($CustomerID) || empty($PlanIDs) || !is_array($PlanIDs)) {
            return "Invalid input data. Please provide a valid customer ID and plans.";
        }

        // Loop through each Plan ID and insert a record
        foreach ($PlanIDs as $PlanID) {
            // Prepare data for insertion
            $customerData = array(
                'CustomerID' => $CustomerID,
                'PolicyNumber' => $PolicyNumber,
                'PlanID' => $PlanID,
                'CreatedDate' => $CreatedDate,
                'CreatedTime' => $CreatedTime,
                'CreatedBy' => $CreatedBy
            );

            // Insert record into the database
            $response_insert_details = $this->_InsertTableRecords_prepare($this->conn, 'customerpolicy', $customerData);

        }

        $response_insert_details['PolicyNumber'] = $PolicyNumber;

        return $response_insert_details;


    }

    public function InsertPolicyCustomerForm($data)
    {
        $prefix = 'UHL';
        $randomNumber = mt_rand(100000, 999999);

        $PolicyNumber = $prefix . $randomNumber;
        $Name = $data['poc_name'];
        $PlanID = $data['plan'];
        $PlanAmount = $data['plan_cost'];
        $PlanDurationFormat = $data['plan_duration_format'];
        $IssueDate = $data['CreatedDate'];

        $DurationValue = isset($data['plan_duration']) ? (int) $data['plan_duration'] : 0;

        if (!empty($IssueDate) && !empty($PlanDurationFormat) && $DurationValue > 0) {
            $issueDateTime = new DateTime($IssueDate);

            switch (strtolower($PlanDurationFormat)) {
                case 'years':
                    $issueDateTime->modify("+{$DurationValue} years");
                    break;
                case 'months':
                    $issueDateTime->modify("+{$DurationValue} months");
                    break;
                case 'weeks':
                    $issueDateTime->modify("+{$DurationValue} weeks");
                    break;
                default:
                    throw new Exception("Invalid duration format provided.");
            }

            // Adjust to the last day at 23:59:59
            $issueDateTime->modify('-1 day');
            $issueDateTime->setTime(23, 59, 59);

            $PolicyLastDate = $issueDateTime->format('Y-m-d H:i:s');
        } else {
            throw new Exception("Please fill in all fields correctly.");
        }

        $ContactNumber = $data['poc_contact_number'];
        $Gender = $data['gender'];
        $DateOfBirth = $data['dob'];
        $Email = $data['email'];
        $Address = $this->conn->real_escape_string($data['address']);
        $State = $data['state'];
        $Pincode = $data['pincode'];
        $BuyingFor = $data['buying_for'];
        $FamilyMemberCount = isset($data['familyMemberCount']) ? (int) $data['familyMemberCount'] : 0;
        $CreatedTime = $data['CreatedTime'];
        $CreatedDate = $data['CreatedDate'];
        $UserID = isset($data['UserID']) ? $data['UserID'] : -1;

        $CreatedBy = isset($data['CreatedBy']) ? $data['CreatedBy'] : 'admin';

        // Prepare main customer data
        $customerData = array(
            'UserID' => $UserID,
            'PolicyNumber' => $PolicyNumber,
            'PlanID' => $PlanID,
            'PlanAmount' => $PlanAmount,
            'Issue_Date' => $IssueDate,
            'Policy_Last_Date' => $PolicyLastDate,
            'Name' => $Name,
            'ContactNumber' => $ContactNumber,
            'Gender' => $Gender,
            'DateOfBirth' => $DateOfBirth,
            'Email' => $Email,
            'Address' => $Address,
            'State' => $State,
            'Pincode' => $Pincode,
            'BuyingFor' => $BuyingFor,
            'FamilyMemberCount' => $FamilyMemberCount,
            'CreatedDate' => $CreatedDate,
            'CreatedTime' => $CreatedTime,
            'CreatedBy' => $CreatedBy
        );

        // Insert customer data
        $response_insert_details = $this->_InsertTableRecords_prepare($this->conn, 'policy_customer', $customerData);
        $last_insert_id = $response_insert_details['last_insert_id'];

        if ($response_insert_details['error'] === false) {
            $PolicyCustomerID = $response_insert_details['last_insert_id'];

            if ($FamilyMemberCount > 0) {
                for ($i = 1; $i <= $FamilyMemberCount; $i++) {
                    $memberName = isset($data["member_name_$i"]) ? $data["member_name_$i"] : null;
                    $memberDOB = isset($data["member_dob_$i"]) ? $data["member_dob_$i"] : null;
                    $memberAge = isset($data["member_age_$i"]) ? $data["member_age_$i"] : -1;
                    $memberGender = isset($data["member_gender_$i"]) ? $data["member_gender_$i"] : null;
                    $memberRelationship = isset($data["member_relationship_$i"]) ? $data["member_relationship_$i"] : null;
                    $memberAge = null;
                    if (!empty($memberDOB)) {
                        $dobDateTime = new DateTime($memberDOB);
                        $currentDateTime = new DateTime(); // Current date and time
                        $ageInterval = $dobDateTime->diff($currentDateTime);
                        $memberAge = $ageInterval->y; // Age in years
                    }
                    // Validate each member's data
                    if ($memberName && $memberDOB && $memberGender && $memberRelationship) {
                        $sql = "INSERT INTO `policy_member_details` 
                        (`PolicyCustomerID`, `PolicyNumber`, `Name`, `DateOfBirth`, `Age`, `Gender`, `Relationship`, `CreatedDate`, `CreatedTime`, `CreatedBy`)
                        VALUES ('$PolicyCustomerID', '$PolicyNumber', '$memberName', '$memberDOB', '$memberAge', '$memberGender', '$memberRelationship', '$CreatedDate', '$CreatedTime', '$CreatedBy')";

                        $this->_InsertTableRecords($this->conn, $sql);
                    } else {
                        error_log("Incomplete data for member $i. Skipping entry.");
                    }
                }
            }

            return [
                'message' => 'Policy Customer and family details saved successfully!',
                'error' => false,
                'last_insert_id' => $last_insert_id
            ];
        } else {
            return $response_insert_details;
        }
    }




    function insertPolicyPaymentData($data)
    {
        extract($data);
        $status = 'Success';
        $sql = "INSERT INTO `payments` (`policyID`,`PolicyNumber`,`razorpay_payment_id`, `razorpay_order_id`, `amount`, `name`, `phone`, `status`)
                    VALUES ('$policyID','$policyNumber','$razorpayPaymentId', '$razorpayOrderId', '$amount', '$name', '$phone', '$status')";
        $response_insert_user = $this->_InsertTableRecords($this->conn, $sql);
        return $response_insert_user;
    }

    public function GetAllplansTable($table)
    {
        $sql = "Select COUNT(*) as total_enquiries from $table where IsActive = 1";
        $result = mysqli_query($this->conn, $sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_enquiries'];
        } else {
            return 0;
        }
    }


    public function _getTotalRecord($conn, $table, $filter)
    {
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



    public function GetChannelPartnerDetailsbyID($ID)
    {
        $where = " where ID = $ID";
        $List = $this->_getTableRecords($this->conn, 'channel_partner', $where);
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



        if (
            $Name == $old_ChannelPartners_details['Name'] &&
            $RegistrationNumber == $old_ChannelPartners_details['RegistrationNumber'] &&
            $PhoneNumber == $old_ChannelPartners_details['PhoneNumber'] &&
            $Email == $old_ChannelPartners_details['Email'] &&
            $Address == $old_ChannelPartners_details['Address'] &&
            $LicenseNumber == $old_ChannelPartners_details['LicenseNumber'] &&
            $AlternativeContact == $old_ChannelPartners_details['AlternativeContact'] &&
            $LicenseNumber == $old_ChannelPartners_details['LicenseNumber'] &&
            $ChannelPartnerTin == $old_ChannelPartners_details['Tin']

        ) {
            $response['message'] = "No changes to update";
            $response['error'] = true;
        } else {
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




    public function DeletePolicy($data)
    {
        $PolicyNumber = $data['PolicyNumber'];
        $update_param = "IsActive = 0
                 WHERE PolicyNumber =  '$PolicyNumber'";
        $response = $this->_UpdateTableRecords($this->conn, 'customerpolicy', $update_param);
        return $response;
    }



    public function getPolicyCustomerDetailsByPolicyID($ID)
    {
        $where = " where ID = $ID";
        $customer = $this->_getTableRecords($this->conn, 'policy_customer', $where);
        return $customer;

    }


    public function getPolicyCustomerDetailsByPolicyNumber($Number)
    {
        $sql = "SELECT 
    ac.UserID,
    MAX(ac.Name) AS UserName,              -- Aggregating to avoid ONLY_FULL_GROUP_BY issue
    MAX(ac.ContactNumber) AS MobileNumber, -- Aggregating to avoid ONLY_FULL_GROUP_BY issue
    MAX(ac.Email) AS Email,
    MAX(ac.DateOfBirth) AS DOB,
    MAX(ac.PermanentAddress) AS PermanentAddress,               -- Aggregating to avoid ONLY_FULL_GROUP_BY issue
    MAX(ac.Address) AS Address,
    MAX(ac.Pincode) AS Pincode,            -- Aggregating to avoid ONLY_FULL_GROUP_BY issue
    MAX(ac.State) AS sstate,                -- Aggregating to avoid ONLY_FULL_GROUP_BY issue
    MAX(ac.PinCode) AS PinCode,            -- Aggregating to avoid ONLY_FULL_GROUP_BY issue
    cp.PolicyNumber,
    MAX(cp.CreatedDate) AS CreatedDate,    -- Aggregating to avoid ONLY_FULL_GROUP_BY issue
    GROUP_CONCAT(DISTINCT p.PlanName) AS PlanNames, -- Aggregating plan names
    MAX(cpa.Amount) AS TotalAmount         -- Sum of all amounts
FROM 
    all_customer ac
INNER JOIN 
    customerpolicy cp ON ac.ID = cp.CustomerID
INNER JOIN 
    customerpolicyamount cpa ON cp.PolicyNumber = cpa.PolicyNumber
LEFT JOIN 
    plans p ON cp.PlanID = p.ID
WHERE 
    cp.PolicyNumber = '$Number'
GROUP BY 
    cp.PolicyNumber, ac.UserID
LIMIT 0, 25;";
        // Fetch details using _getSQLDetails method
        $customer = $this->_getSQLDetails($this->conn, $sql);
        return $customer;
    }




    public function _getTableAllDetails($conn, $table_name, $where)
    {
        $rows = array();
        $sql = "SELECT * FROM $table_name $where";
        $result = mysqli_query($conn, $sql);

        if ($result) {

            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {

            $error = mysqli_error($conn);
            echo $sql;
            echo $error;
        }

        return $rows;
    }

    public function getPolicyCustomerMemberDetailsByPolicyID($ID)
    {
        $where = " where PolicyCustomerID = $ID";
        $customer_members = $this->_getTableAllDetails($this->conn, "policy_member_details", $where);
        return $customer_members;
    }

    public function getPolicyCustomerMemberDetails($Number, $PlanID)
    {
        $where = " where PlanID = '$PlanID' AND PolicyNumber='$Number'";
        $customer_members = $this->_getTableAllDetails($this->conn, "policy_member_details", $where);
        return $customer_members;
    }


    public function getPolicyCustomerMemberDetailsByPolicyNumber($Number)
    {

        $where = " where PolicyNumber = '$Number'";
        $customer_members = $this->_getTableAllDetails($this->conn, "policy_member_details", $where);
        return $customer_members;
    }


    public function getAllPolicyIDByPolicyNumber($Number)
    {
        $where = " where PolicyNumber = '$Number'";
        $customer_members = $this->_getTableAllDetails($this->conn, "customerpolicy", $where);
        return $customer_members;
    }


    public function PostEnqiry($data)
    {
        extract($data);
        $status = 'Success';
        $sql = "INSERT INTO `enquiry_form` (`Name`,`Email`, `MobileNumber`, `Plan`)
									 VALUES ('$Name','$Email', '$MobileNumber', '$Plan')";
        $response_insert_user = $this->_InsertTableRecords($this->conn, $sql);
        return $response_insert_user;
    }

    public function PostEnqiryNew($data)
    {
        extract($data);
        $sql = "INSERT INTO `enquiry_form` (`Name`,`Email`, `MobileNumber`, `Message`)
                                     VALUES ('$Name','$Email', '$MobileNumber', '$Message')";
        $response_insert_user = $this->_InsertTableRecords($this->conn, $sql);
        return $response_insert_user;
    }


    public function GetUserCurrentPlan($data)
    {
        extract($data);
        $where = "WHERE UserID = '$ID'";
        $user_details = $this->_getTableRecords($this->conn, 'all_customer', $where);

        $CreatedDate = $UpdatedDate = date("Y-m-d");
        $CreatedTime = $UpdatedTime = date("H:i:s");
        $CreatedBy = $UpdatedBy = $data['username'];

        if (!empty($user_details)) {
            $customerId = $user_details[0]['ID'];
            $where = "WHERE CustomerID = '$customerId'";
            $user_policy_details = $this->_getTableRecords($this->conn, 'customerpolicy', $where);

            if (!empty($user_policy_details)) {
                $response = [
                    "CustomerID" => $user_policy_details[0]['CustomerID'],
                    "PolicyNumber" => $user_policy_details[0]['PolicyNumber'],
                    "CreatedDate" => $user_policy_details[0]['CreatedDate'],
                    "CreatedTime" => $user_policy_details[0]['CreatedTime'],
                    "CreatedBy" => $user_policy_details[0]['CreatedBy'],
                    "IsActive" => $user_policy_details[0]['IsActive'],
                ];
                return $response;
            }
        }

        return ["error" => true, "message" => "No records found"];
    }



    public function GetUserCurrentPlanNew($data)
    {
        extract($data);
        $where = "WHERE UserID = '$ID' OR ContactNumber = '$MobileNumber'";
        $user_details = $this->_getTableRecords($this->conn, 'all_customer', $where);

        if (empty($user_details)) {
            return ["error" => true, "message" => "No customer records found"];
        }

        $customerIDs = array_column($user_details, 'ID'); // Extract all Customer IDs
        $customerPolicies = [];

        foreach ($customerIDs as $customerId) {
            $where = "WHERE CustomerID = '$customerId'";
            $user_policy_details = $this->_getTableRecords($this->conn, 'customerpolicy', $where);

            if (!empty($user_policy_details)) {
                foreach ($user_policy_details as $policy) {
                    $policyKey = $policy['CustomerID'] . '-' . $policy['PolicyNumber']; // Unique Key
                    if (!isset($customerPolicies[$policyKey])) { // Avoid duplicates
                        $customerPolicies[$policyKey] = [
                            "CustomerID" => $policy['CustomerID'],
                            "PolicyNumber" => $policy['PolicyNumber'],
                            "CreatedDate" => $policy['CreatedDate'],
                            "CreatedTime" => $policy['CreatedTime'],
                            "CreatedBy" => $policy['CreatedBy'],
                            "IsActive" => $policy['IsActive'],
                        ];
                    }
                }
            }
        }

        if (!empty($customerPolicies)) {
            return [array_values($customerPolicies)]; // Convert associative array to indexed
        } else {
            return ["error" => true, "message" => "No policy records found"];
        }
    }







    public function PolicyDetailsByUserID($UserID)
    {
        $where = "where UserID = $UserID";
        $user_policy_details = $this->_getTableRecords($this->conn, 'all_customer', $where);

        return $user_policy_details;
    }

    public function PolicyDetailsByUsersID($UserID)
    {
        $where = "where CreatedBy = $UserID";
        $user_policy_details = $this->_getTableRecords($this->conn, 'all_customer', $where);

        return $user_policy_details;
    }


    public function PolicyPaymetsDetailsByPaymentsId($ID)
    {
        $where = "where ID = $ID";
        $user_payments_details = $this->_getTableRecords($this->conn, 'payments', $where);

        return $user_payments_details;
    }


    public function sendEmail($postdata)
    {
        // $url="https://unitedhealthlumina.com/uhl//mail/send-mail-plan-purchases.php";
        $url = "https://unitedhealthlumina.com//mail/send-mail-plan-purchases-new.php";
        $postdata = json_encode($postdata);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_USERAGENT, 'api');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

        $response = curl_exec($ch);


        curl_close($ch);



    }


    public function checkPaymentStatusByPolicyID($ID)
    {
        $where = "where PolicyNumber = '$ID'";
        $user_payments_details = $this->_getTableRecords($this->conn, 'payments', $where);

        return $user_payments_details;
    }

    public function checkPaymentStatusByPolicyNumber($Number)
    {
        $where = "where PolicyNumber = '$Number'";
        $user_payments_details = $this->_getTableRecords($this->conn, 'payments', $where);

        return $user_payments_details;
    }

    public function InsertPolicyDocuments($data)
    {
        $policyNumber = $data['policy_number'];
        $policyID = $data['policy_ID'];
        $documents = $data['documents'];
        $createdTime = $data['CreatedTime'];
        $createdDate = $data['CreatedDate'];
        $createdBy = $data['CreatedBy'];
        $MemberID = $data['familyMemberSelect'];
        $DocName = $data['documentType'];


        $sql = "INSERT INTO policy_customer_documents 
            (PolicyID,MemberID,DocName,PolicyNumber,Documents, CreatedDate, CreatedTime, CreatedBy) 
            VALUES 
            ('$policyID','$MemberID','$DocName','$policyNumber','$documents', '$createdDate', '$createdTime', '$createdBy')";

        $response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
        return $response_insert_details;
    }


    public function InsertFamilyMembers($data)
    {
        $policyNumber = $data['policy_number'];
        $policyID = $data['policy_ID'];
        $createdTime = $data['CreatedTime'];
        $createdDate = $data['CreatedDate'];
        $createdBy = $data['CreatedBy'];

        // Initialize an array to hold family members
        $family_members = [];

        // Extract family member data from the POST data
        foreach ($data as $key => $value) {
            // Check if the key matches the family member pattern (e.g., 'member_name_1')
            if (strpos($key, 'member_name_') === 0) {
                $index = str_replace('member_name_', '', $key);  // Extract the member index

                $family_members[$index]['name'] = $value;
                $family_members[$index]['dob'] = $data['member_dob_' . $index];
                $family_members[$index]['gender'] = $data['member_gender_' . $index];
                $family_members[$index]['relationship'] = $data['member_relationship_' . $index];

                // Handle file upload for each family member
                $fileInputName = 'member_document_' . $index;
                if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
                    $file = $_FILES[$fileInputName];
                    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $uniqueFileName = $policyNumber . '_' . uniqid() . '.' . $fileExtension;
                    $uploadDirectory = '../documents/';

                    if (!is_dir($uploadDirectory)) {
                        mkdir($uploadDirectory, 0777, true);
                    }

                    $targetFilePath = $uploadDirectory . $uniqueFileName;
                    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                        $family_members[$index]['document'] = $uniqueFileName;
                    }
                }
            }
        }

        // Loop through each family member data and insert it into the database
        $response_insert_details = [];
        foreach ($family_members as $member) {
            $name = $member['name'];
            $dob = $member['dob'];
            $gender = $member['gender'];
            $relationship = $member['relationship'];
            $document = isset($member['document']) ? json_encode([$member['document']]) : null; // Encode document as JSON

            // Calculate age if needed (assuming you want to store age)
            $dobDate = new DateTime($dob);
            $age = $dobDate->diff(new DateTime())->y;

            // Insert family member details into the database
            $sql = "INSERT INTO policy_member_details 
                (PolicyCustomerID, PolicyNumber, Name, DateOfBirth, Age, Gender, Relationship, Document, CreatedDate, CreatedTime, CreatedBy) 
                VALUES 
                ('$policyID', '$policyNumber', '$name', '$dob', '$age', '$gender', '$relationship', '$document', '$createdDate', '$createdTime', '$createdBy')";

            $response_insert_details[] = $this->_InsertTableRecords($this->conn, $sql);
        }

        return $response_insert_details;
    }


    public function getPolicyDocumentsDetailsByPolicyID($ID)
    {
        $where = " where PolicyID = $ID";
        $customer_members = $this->_getTableAllDetails($this->conn, "policy_customer_documents", $where);
        return $customer_members;
    }

    public function getPolicyDocumentsDetailsByPolicyNumber($Number)
    {
        $where = " where PolicyNumber = '$Number'";
        $customer_members = $this->_getTableAllDetails($this->conn, "policy_customer_documents", $where);
        return $customer_members;
    }



    public function countfamilyMember($ID)
    {
        $where = " where PolicyCustomerID = $ID";
        $customer_members = $this->_getTotalRows($this->conn, "policy_member_details", $where);
        return $customer_members;
    }


    public function InsertMembersDocuments($data)
    {
        // Extract data
        extract($data);
        $ID = $data['policy_member_id'];

        // Handle file upload
        if (isset($_FILES['member_documents']) && !empty($_FILES['member_documents']['name'][0])) {
            $documents = $_FILES['member_documents'];
            $uploadedDocuments = [];

            // Loop through uploaded files
            foreach ($documents['name'] as $key => $fileName) {
                // Check if the file was uploaded without errors
                if ($documents['error'][$key] == 0) {
                    // Validate file type and size
                    $fileTmpPath = $documents['tmp_name'][$key];
                    $fileSize = $documents['size'][$key];
                    $fileType = $documents['type'][$key];
                    $maxFileSize = 10 * 1024 * 1024; // 10 MB
                    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];

                    if ($fileSize > $maxFileSize) {
                        return ['error' => true, 'message' => 'File size exceeds the maximum limit of 10 MB'];
                    }

                    if (!in_array($fileType, $allowedTypes)) {
                        return ['error' => true, 'message' => 'Invalid file type. Only PDF, DOC, DOCX, JPG, or PNG files are allowed.'];
                    }

                    // Generate a unique filename and move the file to the target directory
                    $uploadDirectory = '../documents/';
                    $newFileName = uniqid() . '_' . basename($fileName);
                    $fileDestination = $uploadDirectory . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $fileDestination)) {
                        $uploadedDocuments[] = $newFileName;
                    } else {
                        return ['error' => true, 'message' => 'Error uploading file: ' . $fileName];
                    }
                } else {
                    return ['error' => true, 'message' => 'Error with file upload.'];
                }
            }

            // Convert the uploaded document names to a JSON format for storage
            $documentJson = json_encode($uploadedDocuments);

            // Prepare query parameters for the update
            $sql = "Document = '$documentJson' WHERE ID = $ID";
            $response = $this->_UpdateTableRecords($this->conn, 'policy_member_details', $sql);

            return $response;
        } else {
            return ['error' => true, 'message' => 'No documents were uploaded.'];
        }
    }

    public function sendWhatsAppMessage($phonenumber, $message)
    {
        $params = array(
            'token' => 'kjm0xksxbb9ya4s7',
            'to' => $phonenumber,
            'body' => $message
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/instance99975/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            // echo $response;
        }

    }

    function sendCurlRequest($postdata, $url)
    {
        $postdata = json_encode($postdata);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_USERAGENT, 'api');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Increased timeout for larger requests
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Ensure we get the response back
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function _InsertTableRecords_prepare($conn, $tableName, $data)
    {


        $response = array();
        // Build the columns and placeholders strings dynamically
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));

        // Prepare the SQL statement
        $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind the parameters dynamically
        $types = str_repeat('s', count($data)); // Assuming all parameters are strings; adjust as needed
        $stmt->bind_param($types, ...array_values($data));

        // Execute the statement
        if (!$stmt->execute()) {
            $response['error'] = true;
            $response['message'] = $stmt->error;
        } else {
            $response['error'] = false;
            $response['message'] = "Data Inserted";
            $response['last_insert_id'] = $conn->insert_id;
        }

        $stmt->close();
        return $response;
    }

    public function _getTablePlanId($conn, $table_name, $where)
    {
        $rows = array();
        $sql = "SELECT PlanID FROM $table_name $where";
        $result = mysqli_query($conn, $sql);

        if ($result) {

            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {

            $error = mysqli_error($conn);
            echo $sql;
            echo $error;
        }

        return $rows;
    }

    public function GetCustomerAllPlansIDByPolicyNumber($PolicyNumber)
    {
        $where = " where PolicyNumber ='$PolicyNumber'";
        $customer_members = $this->_getTablePlanId($this->conn, "customerpolicy", $where);
        return $customer_members;
    }


    public function InsertMemberForm($data)
    {

        extract($data);

        $response_insert_details = $this->_InsertTableRecords_prepare($this->conn, 'policy_member_details', $data);
        return $response_insert_details;
    }

    public function UpdateMemberForm($data, $where)
    {
        extract($data);
        $response_insert_details = $this->_UpdateTableRecords_prepare($this->conn, 'policy_member_details', $data, $where);
        return $response_insert_details;
    }


    public function InsertPolicyAmountDetails($data)
    {
        extract($data);

        $response_insert_details = $this->_InsertTableRecords_prepare($this->conn, 'customerpolicyamount', $data);
        return $response_insert_details;
    }



    public function getAllPolicyCustomerDetails()
    {
        $stmt = $this->conn->prepare("SELECT 
        ac.UserID,
        MAX(ac.Name) AS UserName,
        MAX(ac.ContactNumber) AS MobileNumber,
        MAX(ac.Email) AS Email,
        MAX(ac.Address) AS Address,
        MAX(ac.State) AS sstate,
        MAX(ac.PinCode) AS PinCode,
        cp.PolicyNumber,
        MAX(cp.CreatedDate) AS CreatedDate,
        p.PlanName AS PlanNames,
        MAX(cpa.Amount) AS TotalAmount,
        MAX(py.status) AS PaymentStatus  
    FROM 
        all_customer ac
    INNER JOIN 
        customerpolicy cp ON ac.ID = cp.CustomerID
    INNER JOIN 
        customerpolicyamount cpa ON cp.PolicyNumber = cpa.PolicyNumber
    LEFT JOIN 
        plans p ON cp.PlanID = p.ID
    LEFT JOIN 
        payments py ON py.PolicyNumber = cp.PolicyNumber
     WHERE 
        cp.IsActive = 1   
    GROUP BY 
        cp.PolicyNumber, ac.UserID
    ORDER BY 
        MAX(cp.CreatedDate) DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);

    }


    public function checkPolicyExistByUserId($UserID)
    {
        $where = " where CustomerID = $UserID";
        $customer_members = $this->_getTableRecords($this->conn, "customerpolicy", $where);
        return $customer_members;
    }


}




?>