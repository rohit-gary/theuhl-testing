<?php
@session_start();
require_once('../include/autoloader.inc.php');
$conf = new Conf();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <title>View All Policy</title>

  <?php
  include("../include/common-head.php");
  $dbh = new Dbh();
  $conn = $dbh->_connectodb();
  $authentication = new Authentication($conn);
  $UserType = $authentication->SessionCheck();

  $CenterID = -1;
  if (isset($_SESSION['CenterID'])) {
    $CenterID = $_SESSION['CenterID'];
  }

  $access = false;
  if ($UserType == "Client Admin" || $UserType == "Channel Partner") {
    $access = true;
  }
  ?>
</head>

<body class="app sidebar-mini ltr light-mode">
  <div class="page">
    <div class="page-main">
      <?php
      include("../navigation/top-header.php");
      include("../navigation/side-navigation.php");
      ?>

      <div class="main-content app-content mt-0">
        <div class="side-app">
          <div class="main-container container-fluid">
            <div class="page-header mb-3">
              <h1 class="page-title">All Health Plans Customer</h1>
              <div>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View Policy</li>
                </ol>
              </div>
            </div>

            <div class="row row-sm">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div id="myGrid" style="height: 500px; width: 100%;" class="ag-theme-alpine"></div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <?php
      include("../navigation/right-side-navigation.php");
      ?>
    </div>

    <?php
    include("../include/common-script.php");
    ?>


    <!-- AG Grid Library -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/ag-grid-enterprise/dist/ag-grid-enterprise.min.js"></script> -->
    <script>
      const themes = {
        quartz: agGrid.themeQuartz,
        balham: agGrid.themeBalham,
        alpine: agGrid.themeAlpine,
      };
      const theme = agGrid.themeBalham;
      const myTheme = agGrid.themeBalham.withParams({
        /* bright green, 10% opacity */
        selectedRowBackgroundColor: "rgba(0, 255, 0, 0.1)",
      });
      const gridOptions = {
        columnDefs: [
          { field: 'OrderID', headerName: 'Order ID' },
          { field: 'FirstName', headerName: 'First Name' },
          { field: 'LastName', headerName: 'Last Name' },
          { field: 'Email', headerName: 'Email', width: 180 },
          { field: 'TotalAmount', headerName: 'Total Amount' },
          { field: 'PaymentMode', headerName: 'Payment Mode' },
          { field: 'Status', headerName: 'Status' },
          { field: 'CreatedDate', headerName: 'Created Date' },
          { field: 'ProductDetails', headerName: 'Product Details' },
          { field: 'Details', headerName: 'Details' },
          { field: 'Action', headerName: 'Action' }
        ],
        rowData: [], // Initially empty, will be populated via AJAX
        suppressDragLeaveHidesColumns: true,
        pagination: true,
        paginationPageSize: 20,
        theme: myTheme,
        rowSelection: { mode: "multiRow" },
        defaultColDef: {
          editable: true,
          filter: true,
        },
        suppressExcelExport: true,
        popupParent: document.body,
        // sideBar: true,



        onFirstDataRendered: (params) => {
          params.api.forEachNode((node) => {
            if (node.rowIndex === 2 || node.rowIndex === 3 || node.rowIndex === 4) {
              node.setSelected(true);
            }
          });
        },
        onGridReady: (params) => {

          fetchData(params);
        }
      };

      const gridDiv = document.querySelector('#myGrid');
      // Use this for AG Grid v30+
      agGrid.createGrid(gridDiv, gridOptions);

      function fetchData(gridParams) {
        console.log("Fetching data..."); // Debugging
        console.log("GridParams API:", gridParams.api); // Debugging
        fetch('ajax/ag-post.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            draw: 1,
            start: 0,
            length: 10,
            search: { value: '' }
          })
        })
          .then(response => response.json())
          .then(data => {
            console.log("Data received:", data); // Debugging
            if (gridParams.api) {
              gridParams.api.setGridOption('rowData', data.aaData);
              gridParams.api.sizeColumnsToFit();
            } else {
              console.error("Grid API is not available.");
            }
          })
          .catch(error => console.error('Error fetching data:', error));
      }
    </script>
</body>

</html>