<?php @session_start(); ?>
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
    require_once('../include/autoloader.inc.php');
    include("../include/get-db-connection.php");
    $Test_obj = new Test($conn);
    $all_testcat = $Test_obj->GetAllTestCats();
    $all_testName = $Test_obj->GetAllTestName();

    $CenterID = -1;
    if (isset($_SESSION['CenterID'])) {
        $CenterID = $_SESSION['CenterID'];
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

                            <a class="btn btn-info" onclick="AddTestPackage()">Add Test Package</a>
                            <h1 class="page-title">All Tests Package</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Test Package </li>
                                </ol>
                            </div>
                        </div>


                        <!-- Row -->

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_doctor_test">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-5p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Test Package Name</th>
                                                        <th class="wd-15p border-bottom-0">Test Package Category</th>
                                                        <th class="wd-15p border-bottom-0">Package Test Name</th>
                                                        <th class="wd-15p border-bottom-0">Test Package Code</th>
                                                        <th class="wd-25p border-bottom-0">Test Package Price</th>
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

        <!-- Test  modal start  -->
        <div class="modal fade" id="add_test_Package_modal" tabindex="1">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h3 class="modal-title" id="TestPackageModalHeading"></h3>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="test_Package_form" onsubmit="return false;">

                            <input type="hidden" id="form_action_test_Package" name="form_action_test_Package"
                                value="" />
                            <input type="hidden" id="form_test_Package_id" name="form_test_Package_id" value="" />

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="test_name" class="col-form-label">Test Package Name<span
                                            class="text-danger">*<span></label>
                                    <input type="text" class="form-control" name="test_Package_name"
                                        id="test_Package_name" Placeholder="Enter Test Name">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="test_Package_cat" class="col-form-label">Test Category<span
                                            class="text-danger">*<span></label>
                                    <select class="form-control" id="test_Package_cat" name="test_Package_cat[]"
                                        multiple="multiple">
                                        <option value=" " selected></option>
                                        <?php
                                        foreach ($all_testcat as $test_value) {
                                            echo '<option value="' . $test_value['ID'] . '">' . htmlspecialchars($test_value['TestCategoryName']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="package_test_name" class="col-form-label">Test Name<span
                                            class="text-danger">*<span></label>
                                    <select class="form-control" id="package_test_name" name="package_test_name[]"
                                        multiple="multiple">
                                        <option value=" " disabled></option>
                                        <?php
                                        foreach ($all_testName as $test_value) {
                                            echo '<option value="' . $test_value['ID'] . '">' . htmlspecialchars($test_value['TestName']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="test_type" class="col-form-label">Test Package Code<span
                                            class="text-danger">*<span></label>
                                    <input type="text" class="form-control" name="test_Package_code"
                                        id="test_Package_code" Placeholder="Enter Test Code">
                                </div>



                                <div class="form-group col-md-12">
                                    <label for="test_fee" class="col-form-label">Test Package Fee<span
                                            class="text-danger">*<span></label>
                                    <input type="text" class="form-control" name="test_Package_fee"
                                        id="test_Package_fee" Placeholder="Enter Test Fee">
                                </div>
                            </div>


                            <div class="mt-5 text-center">
                                <button class="btn btn-success text-white" id="addUpdatePackageBtn"
                                    onclick="AddUpdateTestPackage()"></button>
                                <!-- <a href="#"  class="btn btn-success">Submit</a> -->
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test  modal start  -->

        <?php
        include("../include/common-script.php");
        ?>
        <script src="../project-assets/js/doctest.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {
                console.log('Hello policy customer');
                $('#all_doctor_test').dataTable({
                    'responsive': true,
                    'processing': true,
                    'serverSide': true,
                    'ordering': false,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajax/view-all-doc-test-package-post.php'
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
                            data: 'TestPackageName' // Name of the customer
                        },
                        {
                            data: 'TestPackageCategory' // Phone number of the customer
                        },
                        {
                            data: 'PackageTestName' // Phone number of the customer
                        },
                        {
                            data: 'TestPackageType' // Email of the customer
                        },
                        {
                            data: 'TestPackageFee' // Address of the customer
                        },
                        {
                            data: 'Details'
                        },
                        {
                            data: 'Action'
                        }
                    ]
                });
            });


            $(document).ready(function () {
                $('#test_Package_cat').select2({
                    placeholder: "Select Test Category Names",
                    allowClear: true,
                    height: '150px',
                    width: '100%',
                });

            });


            $(document).ready(function () {
                $('#package_test_name').select2({
                    placeholder: "Select Test Names",
                    allowClear: true,
                    height: '150px',
                    width: '100%',
                });

            });
        </script>
</body>

</html>