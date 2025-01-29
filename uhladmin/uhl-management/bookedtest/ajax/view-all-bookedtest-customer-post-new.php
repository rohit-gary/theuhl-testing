<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();

require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$loggedin_email = $_SESSION['dwd_email'];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

## Read DataTable values
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length'];
$searchValue = $_POST['search']['value'];
$columnSortOrder = "DESC";

## Filter logic for access control
$filter = "WHERE 1=1"; // default where clause
## Search query
if ($searchValue != '') {
  $searchQuery = " AND (DI.FirstName LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                          OR DI.LastName LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%'
                          OR DI.Email LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%'
                          OR C.OrderID LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%')";
  $filter .= $searchQuery;
}

## Total records with filter
$sql_count = "SELECT COUNT(C.ID) AS row_count FROM checkout C 
              LEFT JOIN cart_items CI ON C.CartID = CI.cart_id 
              LEFT JOIN test_customer_delivery_info DI ON C.UserID = DI.UserID 
              $filter";
$result_Count = mysqli_query($conn, $sql_count);
if (!$result_Count) {
  die("Query failed: " . mysqli_error($conn));
}
$row_count_result = $result_Count->fetch_assoc();
$totalRecordwithFilter = $row_count_result['row_count'];

## Total records without filtering
$sql_total = "SELECT COUNT(ID) AS total_count FROM checkout";
$result_total = mysqli_query($conn, $sql_total);
if (!$result_total) {
  die("Query failed: " . mysqli_error($conn));
}
$totalResult = $result_total->fetch_assoc();
$totalRecords = $totalResult['total_count'];

## SQL to fetch records
$sql = "SELECT C.ID, C.OrderID, C.PaymentID, C.TotalAmount, C.PaymentMode, C.Status, C.CreatedDate, C.CreatedTime, 
       GROUP_CONCAT(CI.product_name SEPARATOR ', ') AS ProductNames,
       GROUP_CONCAT(CI.product_price SEPARATOR ', ') AS ProductPrices,
       GROUP_CONCAT(CI.quantity SEPARATOR ', ') AS Quantities,
       GROUP_CONCAT(CI.total_price SEPARATOR ', ') AS TotalPrices,
       DI.FirstName, DI.LastName, DI.Phone, DI.Email, DI.Address, DI.City, DI.State, DI.Postcode
FROM checkout C
LEFT JOIN cart_items CI ON C.CartID = CI.cart_id
LEFT JOIN test_customer_delivery_info DI ON C.UserID = DI.UserID
$filter
GROUP BY C.OrderID
ORDER BY C.ID $columnSortOrder
LIMIT $row, $rowperpage";

$result = mysqli_query($conn, $sql);
if (!$result) {
  die("SQL Error: " . mysqli_error($conn));
}



## Prepare data
$data = [];
while ($row = $result->fetch_assoc()) {
  $ID = $row['ID'];
  $details_html = "<a onclick='GetCustomerDetails(" . $ID . ")' style='cursor:pointer'><span class='badge bg-info'>View</span></a>";
  $action_html = "<a onclick='delete_customer(" . $ID . ")' style='cursor:pointer'><span class='badge bg-info' style='cursor:pointer'><i class='fa fa-trash'></i> Delete</span></a>";

  // Split concatenated product details
  $productNames = explode(',', $row['ProductNames']);
  $productPrices = explode(',', $row['ProductPrices']);
  $quantities = explode(',', $row['Quantities']);
  $totalPrices = explode(',', $row['TotalPrices']);

  // Combine products into a string for displaying in the row
  $productDetails = [];
  for ($i = 0; $i < count($productNames); $i++) {
    $productDetails[] = $productNames[$i] . ' (' . $quantities[$i] . ' x ' . $productPrices[$i] . ') = ' . $totalPrices[$i];
  }
  $productDetailsHtml = implode('<br>', $productDetails);  // Join all product details into a single string with line breaks

  $data[] = array(
    "ID" => $row['ID'],
    "OrderID" => $row['OrderID'],
    "PaymentID" => $row['PaymentID'],
    "TotalAmount" => $row['TotalAmount'],
    "PaymentMode" => $row['PaymentMode'],
    "Status" => $row['Status'],
    "CreatedDate" => $row['CreatedDate'],
    "CreatedTime" => $row['CreatedTime'],
    "FirstName" => $row['FirstName'],
    "LastName" => $row['LastName'],
    "Phone" => $row['Phone'],
    "Email" => $row['Email'],
    "Address" => $row['Address'] . ", " . $row['City'] . ", " . $row['State'] . " - " . $row['Postcode'],
    "ProductDetails" => $productDetailsHtml,  // Display all products for the OrderID in one row
    "Details" => $details_html,
    "Action" => $action_html
  );
}


## Prepare JSON response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

$json_response = json_encode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
  die('JSON encoding error: ' . json_last_error_msg());
}

echo $json_response;
?>