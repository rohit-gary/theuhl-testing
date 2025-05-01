<?php
@session_start();
require_once "../include/autoloader.inc.php";
include "../include/get-db-connection.php";
$conf = new Conf();
$loggedInUserID = $_SESSION["dwd_UserID"];

$policyCustomer = new PolicyCustomer($conn);
$policyNumbers = $policyCustomer->PolicyDetailsByUsersID($loggedInUserID);

$PolicyID = $policyNumbers[0]['ID'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>View All Reimbursement </title>
    <?php
    include "../include/common-head.php";
    $dbh = new Dbh();
    $conn = $dbh->_connectodb();
    $core = new Core();
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();

    $CenterID = -1;
    if (isset($_SESSION["CenterID"])) {
        $CenterID = $_SESSION["CenterID"];
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
            include "../navigation/top-header.php";
            include "../navigation/side-navigation.php";
            ?>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header mb-3">

                            <h1 class="page-title d-flex align-items-center">View All Reimbursement
                                <!-- <span data-bs-placement="bottom" data-bs-toggle='tooltip'
                                    data-bs-original-title='Add Leave'
                                    onclick="AddReimbursement(<?php echo $PolicyID; ?>)"
                                    class="fe fe-plus add_btn"></span> -->
                            </h1>

                            <!-- <h1 class="page-title">All Reimbursement</h1> -->
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Reimbursement </li>
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
                                                id="all_customer_reimbursement">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-5p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Policy Number</th>
                                                        <th class="wd-15p border-bottom-0">Medical/Hospital Name</th>
                                                        <th class="wd-15p border-bottom-0">Checkup Date/Time</th>
                                                        <th class="wd-15p border-bottom-0">Checkup Cost</th>
                                                        <th class="wd-25p border-bottom-0">Checkup Documents</th>
                                                        <th class="wd-25p border-bottom-0">Status</th>
                                                        <th class="wd-25p border-bottom-0">View Details</th>
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
            <?php include "../navigation/right-side-navigation.php"; ?>

        </div>

        <?php include "../include/common-script.php"; ?>

        <script src="../project-assets/js/customer-policy.js"></script>
        <script src="../project-assets/js/customer-reimbursement.js"></script>


        <script type="text/javascript">

            $(document).ready(function () {

                var i = 1;
                $('#all_customer_reimbursement').dataTable({
                    'responsive': true,
                    'processing': true,
                    'serverSide': true,
                    'ordering': false,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajax/customer-reimbursement-post.php'
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
                        data: 'PolicyNumber'
                    },
                    {
                        data: 'HospitalName'
                    },

                    {
                        data: 'CheckupDate'
                    },

                    {
                        data: 'CheckupCost'
                    },

                    {
                        data: 'Documents',
                        render: function (data, type, row) {
                            // Check if documents exist
                            if (data && Array.isArray(data)) {
                                let pdfLinks = '';
                                data.forEach(function (doc) {
                                    if (doc) {
                                        // Create a link to view the PDF file with PDF icon
                                        pdfLinks += `<a href="../reimbursement-media/${doc}" target="_blank" class="btn btn-link bg-danger" style="color: white; text-decoration: none;">View Assets <i class="fa fa-file"></i></a><br>`;
                                    }
                                });
                                // If no PDFs found, display a message
                                if (!pdfLinks) {
                                    return "No PDF's available";
                                }
                                return pdfLinks;
                            }
                            return 'No documents';
                        }
                    },

                    {
                        data: 'Status'
                    },
                    {
                        data: 'Details'
                    }

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




<!-- start add modal  -->

<div class="modal fade" id="add_remibursement" tabindex="1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title" id="CustomerRemibursementModalHeading"></h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- -----leave form model body-------- -->
            <div class="modal-body">
                <form id="reimbursement_form" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="hidden" id="form_action" name="form_action" value="" />
                    <input type="hidden" id="form_id" name="form_id" value="" />

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="policy_number" class="col-form-label">Your Policy Number</label>
                            <select class="form-control" id="policy_number" name="policy_number">
                                <option value="">Select Policy Number</option>
                                <?php // Loop through the policy numbers and display them as options
                                if (!empty($policyNumbers)) {
                                    foreach ($policyNumbers as $policy) {
                                        // Assuming the array contains a 'PolicyNumber' key
                                        echo "<option value='" .
                                            $policy["PolicyNumber"] .
                                            "'>" .
                                            $policy["PolicyNumber"] .
                                            "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No policies available</option>";
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="hospital_name" class="col-form-label">Hospital/Medical Name</label>
                            <input type="text" class="form-control " id="hospital_name" name="hospital_name">
                        </div>

                        <div class="mb-3 col-6">
                            <label for="checkup_date" class="col-form-label">Checkup Date</label>
                            <input type="date" class="form-control " id="checkup_date" name="checkup_date">
                        </div>

                        <div class="mb-3 col-6">
                            <label for="checkup_cost" class="col-form-label">Checkup Cost</label>
                            <input type="text" class="form-control " id="checkup_cost" name="checkup_cost">
                        </div>

                        <div class="mb-3 col-6">
                            <label for="checkup_documents" class="col-form-label">Checkup Documents</label>
                            <div id="checkup_documents_container">
                                <div class="input-group mb-2">
                                    <input type="file" class="form-control" id="checkup_documents_0"
                                        name="checkup_documents[]">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="addFileInput()">+</button>
                                </div>
                            </div>
                        </div>



                        <div class="mt-5 text-center">
                            <button class="btn btn-success text-white" id="addUpdateReimbursementBtn"
                                onclick="AddUpdateReimbursement()"></button>

                        </div>


                </form>
            </div>
        </div>
    </div>
</div>



</form>
</div>
</div>
</div>
</div>
<!-- End End modal  -->