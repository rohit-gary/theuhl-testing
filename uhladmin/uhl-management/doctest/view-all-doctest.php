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
    // $Test_obj = new Test();
    // $all_testcat=$Test_obj->GetAllTestCats();

    $CenterID = -1;
    if(isset($_SESSION['CenterID'])){
        $CenterID = $_SESSION['CenterID'];
    }


     $access = false;
    if($UserType == "Client Admin" || $UserType == "Channel Partner")
    {
        $access = true;
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
                data: 'Name' // Name of the customer
            },
            {
                data: 'ContactNumber' // Phone number of the customer
            },
            {
                data: 'Email' // Email of the customer
            },
            {
                data: 'Address' // Address of the customer
            }
        ]
    });
});

        </script>

        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_program").addClass("active");
            });
        </script>

</body>

</html>



<!-- Test  modal start  -->

<div class="modal fade" id="add_test_modal" tabindex="1">
    <div class="modal-dialog" role="document">
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
                        <div class="form-group col-md-12">
                            <label for="test_name" class="col-form-label">Test Name<span
                                    class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="test_name" id="test_name"
                                Placeholder="Enter Test Name">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="test_cat" class="col-form-label">Test Category<span
                                    class="text-danger">*<span></label>
                                 <select class="form-control" id="test_cat" name="test_cat">
                                    <option value=" " selected>Select Test Category</option>
                                    <?php
                                    foreach ($all_testcat as $test_value) {
                                        echo '<option value="' . htmlspecialchars($test_value['id']) . '">' . htmlspecialchars($test_value['TestCategoryName']) . '</option>';
                                    }
                                    ?>
                                </select>

                        </div>

                        <div class="form-group col-md-12">
                            <label for="test_type" class="col-form-label">Test Type<span
                                    class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="test_type" id="test_type"
                                Placeholder="Enter Test Type">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="test_fee" class="col-form-label">Test Fee<span
                                    class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="test_fee" id="test_fee"
                                Placeholder="Enter Test Fee">
                        </div>
                    </div>


                    <div class="mt-5 text-center">
                        <button class="btn btn-success text-white" id="addUpdateTBtn"
                            onclick="AddUpdateTest()"></button>
                        <!-- <a href="#"  class="btn btn-success">Submit</a> -->
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<!-- Test  modal start  -->