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
  <link rel="stylesheet" href="../theme-assets/plugins/richtexteditor/rte_theme_default.css" />
  <script type="text/javascript" src="../theme-assets/plugins/richtexteditor/rte.js"></script>
  <script type="text/javascript" src='../theme-assets/plugins/richtexteditor/plugins/all_plugins.js'></script>
  <link rel="stylesheet" href="../theme-assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
  <script src="../theme-assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
  <script src="../theme-assets/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
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
                    <div class="table-responsive">
                      <table class="table table-bordered text-wrap" id="all_policy_customer">
                        <thead>
                          <tr>
                            <th class="wd-5p">#</th>
                            <th class="wd-15p">Order NO</th>
                            <th class="wd-15p">Name / Phone Number</th>
                            <th class="wd-15p">ProductDetails</th>
                            <th class="wd-15p">Total Amount</th>
                            <th class="wd-15p">Order Date</th>
                            <th class="wd-15p">Billing Address</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-15p">Processed</th>
                            <th class="wd-15p">Action</th>
                            <th class="wd-15p">Details</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data will be populated dynamically via AJAX -->
                        </tbody>
                      </table>
                    </div>
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
    <script src="../project-assets/js/bookedtest.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        console.log('Loading policy customer data');

        // Initialize DataTable
        $('#all_policy_customer').DataTable({
          'responsive': false,
          'processing': true,
          'serverSide': true,
          'ordering': false,
          'ajax': {
            'url': 'ajax/view-all-bookedtest-processed-post.php',
            'type': 'POST'
          },
          'columnDefs': [{
            "targets": [0],
            "className": "text-center"
          }],
          "order": [
            [1, 'asc']
          ],
          'columns': [
            {
              "data": "ID",
              render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1; // Serial number
              }
            },
            {
              data: 'OrderID'
            },
            {
              data: 'FirstName'
            },
            {
              data: 'ProductDetails'
            },
            {
              data: 'TotalAmount'
            },
            {
              data: 'CreatedDate'
            },
            {
              data: 'Address'
            },
            {
              data: 'Status'
            },
            {
              data: 'Processed'
            },
            {
              data: 'Action'
            },
            {
              data: 'Details'
            }
          ]
        });
      });
    </script>
  </div>
</body>

</html>