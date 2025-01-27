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
        $response['Company'] = $this->_getTotalRows($this->conn, 'company', 'where IsActive = 1');
        $response['CompanySites'] = $this->_getTotalRows($this->conn, 'company_sites', 'where IsActive = 1');
        $response['Services'] = $this->_getTotalRows($this->conn, 'services', 'where IsActive = 1');
        $response['ServiceReports'] = $this->_getTotalRows($this->conn, 'service_reports', 'where IsActive = 1');
        return $response;
    }


    public function getTotalUsers()
    {
        return 100;
    }

    public function getTotalPolicies()
    {
        return 200;
    }


    public function getCoinsLeft()
    {
        return 300000;
    }

    public function getTotalPlans()
    {
        return 3;
    }



    // count total chanel Partner

    public function countChanelPartner()
    {

        $where = 'where IsActive=1';

        $totalChanel = $this->_getTotalRows($this->conn, 'channel_partner', $where);
        return $totalChanel;

    }

    // count total plan

    public function countPlan()
    {
        $where = 'where IsActive= 1';

        $totalPlan = $this->_getTotalRows($this->conn, 'plans', $where);
        return $totalPlan;
    }

    // count total Reimbursement


    public function countReimbursement()
    {
        $where = 'where IsActive= 1';

        $totalReimbursement = $this->_getTotalRows($this->conn, 'customer_reimbursement', $where);
        return $totalReimbursement;
    }



    // count total policy Customer 

    public function countPolicyCustomer()
    {

        $where = 'where IsActive= 1';

        $totalPolicyCustomer = $this->_getTotalRows($this->conn, 'customerpolicy', $where);
        return $totalPolicyCustomer;

    }



    // count total Doctors


    public function countDoctors()
    {


        $where = 'where IsActive= 1';

        $totalDoctors = $this->_getTotalRows($this->conn, 'doctors', $where);
        return $totalDoctors;

    }



    public function countPolicyCreatedBy($userEmail)
    {

        $where = "where IsActive= 1 And CreatedBy= '$userEmail'";

        $totalPolicyCustomer = $this->_getTotalRows($this->conn, 'customerpolicy', $where);
        return $totalPolicyCustomer;

    }

    public function countPolicyTodayCreatedBy($userEmail)
    {
        $where = "WHERE IsActive = 1 AND CreatedBy = '$userEmail' AND CreatedDate = CURDATE()";
        $totalPolicyCustomer = $this->_getTotalRows($this->conn, 'customerpolicy', $where);
        return $totalPolicyCustomer;
    }

    public function countPolicyTodayCreatedByAll()
    {
        $where = "WHERE IsActive = 1 AND CreatedDate = CURDATE()";
        $totalPolicyCustomer = $this->_getTotalRows($this->conn, 'customerpolicy', $where);
        return $totalPolicyCustomer;
    }

    public function uncompletedPolicyCustomer($userEmail)
    {
        $sql = "SELECT DISTINCT C.PolicyNumber FROM all_customer AC  LEFT JOIN customerpolicy C ON AC.ID= C.CustomerID LEFT JOIN payments P ON P.PolicyNumber= C.PolicyNumber LEFT JOIN policy_customer_documents PCD ON P.PolicyNumber=C.PolicyNumber WHERE PCD.PolicyNumber IS NULL AND (P.status IS NULL OR P.status != 'Success') AND AC.CreatedBy = '$userEmail'";
        $totalPolicyCustomer = $this->_getRecords($this->conn, $sql);
        return count($totalPolicyCustomer);
    }
    public function uncompletedPolicyCustomerAll()
    {
        $sql = "SELECT DISTINCT C.PolicyNumber FROM all_customer AC  LEFT JOIN customerpolicy C ON AC.ID= C.CustomerID LEFT JOIN payments P ON P.PolicyNumber= C.PolicyNumber LEFT JOIN policy_customer_documents PCD ON P.PolicyNumber=C.PolicyNumber WHERE PCD.PolicyNumber IS NULL AND (P.status IS NULL OR P.status != 'Success')";
        $totalPolicyCustomer = $this->_getRecords($this->conn, $sql);
        return count($totalPolicyCustomer);
    }

    public function submiteDocandPayment($userEmail)
    {
        $sql = "SELECT COUNT(DISTINCT C.PolicyNumber) AS TotalSuccessDocsAndPayments
                FROM all_customer AC
                LEFT JOIN customerpolicy C ON AC.ID = C.CustomerID
                LEFT JOIN payments P ON P.PolicyNumber = C.PolicyNumber
                LEFT JOIN policy_customer_documents PCD ON PCD.PolicyNumber = C.PolicyNumber
                WHERE PCD.PolicyNumber IS NOT NULL
                  AND P.status = 'Success'
                  AND AC.CreatedBy = '$userEmail'";

        // Assuming _getRecords returns the result directly.
        $result = $this->_getRecords($this->conn, $sql);

        // Extract the count from the query result if necessary
        return isset($result[0]['TotalSuccessDocsAndPayments']) ? $result[0]['TotalSuccessDocsAndPayments'] : 0;
    }
    public function submiteDocandPaymentAll()
    {
        $sql = "SELECT COUNT(DISTINCT C.PolicyNumber) AS TotalSuccessDocsAndPayments
                FROM all_customer AC
                LEFT JOIN customerpolicy C ON AC.ID = C.CustomerID
                LEFT JOIN payments P ON P.PolicyNumber = C.PolicyNumber
                LEFT JOIN policy_customer_documents PCD ON PCD.PolicyNumber = C.PolicyNumber
                WHERE PCD.PolicyNumber IS NOT NULL AND C.IsActive = 1
                  AND P.status = 'Success' ";
        // Assuming _getRecords returns the result directly.
        $result = $this->_getRecords($this->conn, $sql);

        // Extract the count from the query result if necessary
        return isset($result[0]['TotalSuccessDocsAndPayments']) ? $result[0]['TotalSuccessDocsAndPayments'] : 0;
    }



    public function countPolicyCreatedByMonthly($userEmail)
    {
        $where = "WHERE IsActive = 1 
              AND CreatedBy = '$userEmail' 
              AND MONTH(CreatedDate) = MONTH(CURDATE()) 
              AND YEAR(CreatedDate) = YEAR(CURDATE())";
        $totalPolicyCustomer = $this->_getTotalRows($this->conn, 'customerpolicy', $where);
        return $totalPolicyCustomer;
    }

    public function countPolicyCreatedByMonthlyAll()
    {
        $where = "WHERE IsActive = 1 
              AND MONTH(CreatedDate) = MONTH(CURDATE()) 
              AND YEAR(CreatedDate) = YEAR(CURDATE())";
        $totalPolicyCustomer = $this->_getTotalRows($this->conn, 'customerpolicy', $where);
        return $totalPolicyCustomer;
    }


    public function GetTotalRevenueByCreatedBy($para)
    {
        $sql = "SELECT SUM(t.amount) AS TotalRevenue
            FROM payments t
            LEFT JOIN customerpolicy cp
            ON t.PolicyNumber = cp.PolicyNumber
            WHERE CreatedBy = '$para'";
        $response = $this->_getRecords($this->conn, $sql);


        // Ensure you access the specific value
        if (!empty($response) && isset($response[0]['TotalRevenue'])) {
            // Format the revenue in Indian Rupee number format
            return number_format($response[0]['TotalRevenue'], 2, '.', ',');
        }

        // Return 0 if no data is found, formatted as Indian Rupee
        return number_format(0, 2, '.', ',');
    }


    public function GetTotalRevenueBy()
    {
        $sql = "SELECT SUM(t.amount) AS TotalRevenue
            FROM payments t
            LEFT JOIN customerpolicy cp
            ON t.PolicyNumber = cp.PolicyNumber
            WHERE 1";
        $response = $this->_getRecords($this->conn, $sql);


        // Ensure you access the specific value
        if (!empty($response) && isset($response[0]['TotalRevenue'])) {
            // Format the revenue in Indian Rupee number format
            return number_format($response[0]['TotalRevenue'], 2, '.', ',');
        }

        // Return 0 if no data is found, formatted as Indian Rupee
        return number_format(0, 2, '.', ',');
    }


    public function GetTotalRevenueByCreatedByToday($para)
    {
        // Get today's date in the format YYYY-MM-DD
        $today = date("Y-m-d");

        // SQL query to sum amounts for today
        $sql = "SELECT SUM(t.amount) AS TotalRevenue
            FROM payments t
            LEFT JOIN customerpolicy cp
            ON t.PolicyNumber = cp.PolicyNumber
            WHERE CreatedBy = '$para' 
            AND DATE(cp.CreatedDate) = '$today'"; // Filter by today's date
        $response = $this->_getRecords($this->conn, $sql);

        // Ensure you access the specific value
        if (!empty($response) && isset($response[0]['TotalRevenue'])) {
            return $response[0]['TotalRevenue'];
        }

        // Return 0 if no data is found
        return 0;
    }

    public function GetTotalRevenueToday()
    {
        // Get today's date in the format YYYY-MM-DD
        $today = date("Y-m-d");

        // SQL query to sum amounts for today
        $sql = "SELECT SUM(t.amount) AS TotalRevenue
            FROM payments t
            LEFT JOIN customerpolicy cp
            ON t.PolicyNumber = cp.PolicyNumber
            WHERE  DATE(cp.CreatedDate) = '$today'"; // Filter by today's date
        $response = $this->_getRecords($this->conn, $sql);

        // Ensure you access the specific value
        if (!empty($response) && isset($response[0]['TotalRevenue'])) {
            // Format the revenue in Indian Rupee number format
            return number_format($response[0]['TotalRevenue'], 2, '.', ',');
        }

        // Return 0 if no data is found, formatted as Indian Rupee
        return number_format(0, 2, '.', ',');
    }



    public function GetTotalRevenueByCreatedByMonthly($para)
    {
        // Get current year and month
        $currentYear = date("Y");
        $currentMonth = date("m");

        // SQL query to sum amounts for the current month
        $sql = "SELECT SUM(t.amount) AS TotalRevenue
            FROM payments t
            LEFT JOIN customerpolicy cp
            ON t.PolicyNumber = cp.PolicyNumber
            WHERE CreatedBy = '$para'
            AND YEAR(cp.CreatedDate) = '$currentYear'
            AND MONTH(cp.CreatedDate) = '$currentMonth'"; // Filter by the current month and year
        $response = $this->_getRecords($this->conn, $sql);

        // Ensure you access the specific value
        if (!empty($response) && isset($response[0]['TotalRevenue'])) {
            // Format the revenue in Indian Rupee number format
            return number_format($response[0]['TotalRevenue'], 2, '.', ',');
        }

        // Return 0 if no data is found, formatted as Indian Rupee
        return number_format(0, 2, '.', ',');
    }

    public function GetTotalRevenueByMonthly()
    {
        // Get current year and month
        $currentYear = date("Y");
        $currentMonth = date("m");

        // SQL query to sum amounts for the current month
        $sql = "SELECT SUM(t.amount) AS TotalRevenue
            FROM payments t
            LEFT JOIN customerpolicy cp
            ON t.PolicyNumber = cp.PolicyNumber
            WHERE YEAR(cp.CreatedDate) = '$currentYear'
            AND MONTH(cp.CreatedDate) = '$currentMonth'"; // Filter by the current month and year
        $response = $this->_getRecords($this->conn, $sql);

        // Ensure you access the specific value
        if (!empty($response) && isset($response[0]['TotalRevenue'])) {
            // Format the revenue in Indian Rupee number format
            return number_format($response[0]['TotalRevenue'], 2, '.', ',');
        }

        // Return 0 if no data is found, formatted as Indian Rupee
        return number_format(0, 2, '.', ',');
    }

}