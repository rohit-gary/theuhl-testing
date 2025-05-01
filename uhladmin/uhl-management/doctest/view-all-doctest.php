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

                            <a class="btn btn-info" onclick="AddTest()">Add Test</a>
                            <h1 class="page-title">All Tests</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Test </li>
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
                                                        <th class="wd-15p border-bottom-0">Test Name</th>
                                                        <th class="wd-15p border-bottom-0">Test Category</th>
                                                        <th class="wd-15p border-bottom-0">Test Code</th>
                                                        <th class="wd-25p border-bottom-0">Test Price</th>
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
        <div class="modal fade" id="add_test_modal" tabindex="1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h3 class="modal-title" id="TestModalHeading"></h3>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="test_form" onsubmit="return false;">
                            <input type="hidden" id="form_action_test" name="form_action_test" value="" />
                            <input type="hidden" id="form_test_id" name="form_test_id" value="" />

                            <div class="row">
                                <!-- Basic Info Row -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="test_name" class="col-form-label">Test Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="test_name" id="test_name"
                                            placeholder="Enter Test Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="test_cat" class="col-form-label">Test Category<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="test_cat" name="test_cat[]"
                                            multiple="multiple">
                                            <option value=" " disabled></option>
                                            <?php
                                            foreach ($all_testcat as $test_value) {
                                                echo '<option value="' . $test_value['ID'] . '">' . htmlspecialchars($test_value['TestCategoryName']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Test Details Row -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="test_code" class="col-form-label">Test Code<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="test_code" id="test_code"
                                            placeholder="Enter Test Code">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="test_fee" class="col-form-label">Test Fee<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="test_fee" id="test_fee"
                                            placeholder="Enter Test Fee">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="report_time" class="col-form-label">Report Time</label>
                                        <input type="text" class="form-control" name="report_time" id="report_time"
                                            placeholder="Enter Report Time">
                                    </div>
                                </div>

                                <!-- Test Parameters Row -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="parameters" class="col-form-label">Parameters</label>
                                        <input type="text" class="form-control" name="parameters" id="parameters"
                                            placeholder="Enter Parameters">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="requisites" class="col-form-label">Requisites</label>
                                        <input type="text" class="form-control" name="requisites" id="requisites"
                                            placeholder="Enter Requisites">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="measures" class="col-form-label">Measures</label>
                                        <input type="text" class="form-control" name="measures" id="measures"
                                            placeholder="Enter Measures">
                                    </div>
                                </div>

                                <!-- Additional Info Row -->
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="identifies" class="col-form-label">Identifies</label>
                                        <input type="text" class="form-control" name="identifies" id="identifies"
                                            placeholder="Enter Identifies">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="home_minutes" class="col-form-label">Home Minutes</label>
                                        <input type="text" class="form-control" name="home_minutes" id="home_minutes"
                                            placeholder="Enter Home Minutes">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="happy_customer" class="col-form-label">Happy Customer</label>
                                        <input type="text" class="form-control" name="happy_customer"
                                            id="happy_customer" placeholder="Enter Happy Customer">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="google_rating" class="col-form-label">Google Rating</label>
                                        <input type="text" class="form-control" name="google_rating" id="google_rating"
                                            placeholder="Enter Google Rating">
                                    </div>
                                </div>

                                <!-- Headings Row -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="heading_one" class="col-form-label">Heading One</label>
                                        <input type="text" class="form-control" name="heading_one" id="heading_one"
                                            placeholder="Enter Heading One">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="heading_two" class="col-form-label">Heading Two</label>
                                        <input type="text" class="form-control" name="heading_two" id="heading_two"
                                            placeholder="Enter Heading Two">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="heading_three" class="col-form-label">Heading Three</label>
                                        <input type="text" class="form-control" name="heading_three" id="heading_three"
                                            placeholder="Enter Heading Three">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="heading_four" class="col-form-label">Heading Four</label>
                                        <input type="text" class="form-control" name="heading_four" id="heading_four"
                                            placeholder="Enter Heading Four">
                                    </div>
                                </div>

                                <!-- Descriptions Row -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="description_one" class="col-form-label">Description One</label>
                                        <textarea class="form-control" name="description_one" id="description_one"
                                            placeholder="Enter Description One" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="description_two" class="col-form-label">Description Two</label>
                                        <textarea class="form-control" name="description_two" id="description_two"
                                            placeholder="Enter Description Two" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="description_three" class="col-form-label">Description Three</label>
                                        <textarea class="form-control" name="description_three" id="description_three"
                                            placeholder="Enter Description Three" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="description_four" class="col-form-label">Description Four</label>
                                        <textarea class="form-control" name="description_four" id="description_four"
                                            placeholder="Enter Description Four" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <button class="btn btn-success text-white" id="addUpdateTBtn"
                                    onclick="AddUpdateTest()"></button>
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
                        'url': 'ajax/view-all-doc-test-post.php'
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
                            data: 'TestName' // Name of the customer
                        },
                        {
                            data: 'TestCategory' // Phone number of the customer
                        },
                        {
                            data: 'TestType' // Email of the customer
                        },
                        {
                            data: 'TestFee' // Address of the customer
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
                $('#test_cat').select2({
                    placeholder: "Select Test Category Names",
                    allowClear: true,
                    height: '150px',
                    width: '100%',
                });
            });

        </script>
</body>

</html>