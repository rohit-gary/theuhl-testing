<?php 
class Clientdashboard extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function getDashboardStats()
	{
		$response = array();
		$response['Company'] = $this->_getTotalRows($this->conn,'company','where IsActive = 1');
		$response['CompanySites'] = $this->_getTotalRows($this->conn,'company_sites','where IsActive = 1');
		$response['Services'] = $this->_getTotalRows($this->conn,'services','where IsActive = 1');
		$response['ServiceReports'] = $this->_getTotalRows($this->conn,'service_reports','where IsActive = 1');
		return $response;
	}


	public function getTotalUsers(){
		return 100;
	}
	
   public function getTotalPolicies(){
   	return 200;
   }


   public function getCoinsLeft(){
   	return 300000;
   }

   public function getTotalPlans(){
   	return 3;
   }



   // count total chanel Partner

  public function countChanelPartner(){

  	$where='where IsActive=1';

  	$totalChanel=$this->_getTotalRows($this->conn,'channel_partner',$where);
  	return $totalChanel;

  }

   // count total plan

 public function countPlan(){
  	$where='where IsActive= 1';

  	$totalPlan=$this->_getTotalRows($this->conn,'plans',$where);
  	return $totalPlan;
  }

   // count total Reimbursement


 public function countReimbursement(){
  	$where='where IsActive= 1';

  	$totalReimbursement=$this->_getTotalRows($this->conn,'customer_reimbursement',$where);
  	return $totalReimbursement;
  }



   // count total policy Customer 
  
  public function countPolicyCustomer(){

  	$where='where IsActive= 1';

  	$totalPolicyCustomer=$this->_getTotalRows($this->conn,'policy_customer',$where);
  	return $totalPolicyCustomer;

  }



   // count total Doctors


  public function countDoctors(){


    $where='where IsActive= 1';

  	$totalDoctors=$this->_getTotalRows($this->conn,'doctors',$where);
  	return $totalDoctors;

  }



  public function countPolicyCreatedBy($userEmail){

  	$where="where IsActive= 1 And CreatedBy= '$userEmail'";

  	$totalPolicyCustomer=$this->_getTotalRows($this->conn,'policy_customer',$where);
  	return $totalPolicyCustomer;

  }




}