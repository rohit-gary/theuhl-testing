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
    <!-- TITLE -->
    <title>View All Policy </title>
    <?php
    include("../include/common-head.php");
    $dbh = new Dbh();
    $conn = $dbh->_connectodb();
    $core = new Core();
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


    $access_2 = false;
    if ($UserType == "Client Admin") {
        $access_2 = true;
    }


    ?>
    <link rel="stylesheet" href="../theme-assets/plugins/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="../theme-assets/plugins/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='../theme-assets/plugins/richtexteditor/plugins/all_plugins.js'></script>
</head>

<body class="app sidebar-mini ltr light-mode">
    <div class="page">
        <div class="page-main">
            <?php
            include("../navigation/top-header.php");
            include("../navigation/side-navigation.php");
            ?>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header mb-3">

                         

                            <?php if ($access_2 == true) { ?>
                                <button class="btn btn-primary export-button" onclick="ExportPolicyCustomer()"
                                    id="export_data">Export Data</button>
                            <?php } ?>

                            <h1 class="page-title">All Health Plans Customer</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Policy </li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_policy_customer">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-5p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Name</th>
                                                        <th class="wd-15p border-bottom-0">Phone Number</th>
                                                        <th class="wd-15p border-bottom-0">Policy Number</th>
                                                        <!-- <th class="wd-25p border-bottom-0">Address</th> -->
                                                        <th class="wd-25p border-bottom-0">Document Status</th>
                                                        <th class="wd-15p border-bottom-0">Transaction Status</th>
                                                        <th class="wd-15p border-bottom-0">Details</th>
                                                        <th class="wd-10p border-bottom-0">Action</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->








            <?php
            include("../navigation/right-side-navigation.php");
            ?>

        </div>

        <?php
        include("../include/common-script.php");
        ?>

        <script src="../project-assets/js/customer-policy.js"></script>
        <script src="../project-assets/js/all-customers.js"></script>


        <script type="text/javascript">

            $(document).ready(function () {
                console.log('Hello policy customer');
                var i = 1;
                $('#all_policy_customer').dataTable({
                    'responsive': true,
                    'processing': true,
                    'serverSide': true,
                    'ordering': false,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajax/view-all-policy-customer-post-new.php'
                    },
                    'columnDefs': [{
                        "targets": [0],
                        "className": "text-center"
                    }],
                    "order": [
                        [1, 'asc']
                    ],
                    'columns': [{
                        "data": "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'Name'
                    },
                    {
                        data: 'ContactNumber'
                    },

                    {
                        data: 'PolicyNumber'
                    },
                    {
                        data: 'Document Status',
                        render: function (data, type, row) {
                            // Determine status class and text based on status
                            let statusClass = '';
                            let statusText = data.toLowerCase();
                            if (statusText === 'complete') {
                                statusClass = 'bg-warning text-white'; // Green for success
                            } else if (statusText === 'pending') {
                                statusClass = 'bg-warning text-dark'; // Yellow for pending
                            } else if (statusText === 'failed') {
                                statusClass = 'bg-danger text-white'; // Red for failed
                            } else {
                                statusClass = 'bg-danger text-white'; // Gray for unknown
                            }

                            // Return the status as a badge
                            return `<span class="badge ${statusClass}" style="padding: 8px; font-size: 12px; text-transform: capitalize;">
                                ${statusText}
                            </span>`;
                        }
                    },

                    {
                        data: 'Transection Status',
                        render: function (data, type, row) {
                            // Determine status class and text based on status
                            let statusClass = '';
                            let statusText = data.toLowerCase();

                            if (statusText === 'success') {
                                statusClass = 'bg-success text-white'; // Green for success
                            } else if (statusText === 'pending') {
                                statusClass = 'bg-warning text-dark'; // Yellow for pending
                            } else if (statusText === 'failed') {
                                statusClass = 'bg-danger text-white'; // Red for failed
                            } else {
                                statusClass = 'bg-secondary text-white'; // Gray for unknown
                            }

                            // Return the status as a badge
                            return `<span class="badge ${statusClass}" style="padding: 8px; font-size: 12px; text-transform: capitalize;">
                                ${statusText}
                            </span>`;
                        }
                    },

                    {
                        data: 'Details'
                    },
                    {
                        data: 'Action'
                    },

                    ]


                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#nav_program").addClass("active");
            });
        </script>

</body>

</html>