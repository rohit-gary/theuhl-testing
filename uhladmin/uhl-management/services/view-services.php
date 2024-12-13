<?php
@session_start();
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
include("../include/get-db-connection.php");
$access = array("AdminAccess"=>1,"ViewAccess"=>1,"EditAccess"=>1,"DeleteAccess"=>1);
extract($access);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>View All Services </title>
    
    <?php
    include("../include/common-head.php");
    $service_obj = new Service($conn);
    ?>
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
                        <div class="page-header">
                            <h1 class="page-title">All Services</h1>
                           
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Services</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <?php
                        if($EditAccess)
                        {
                        ?>
                            <div class="row pb-5 justify-content-end">
                                <div class="col-md-4 text-end">
                                    <a href="#" onclick="AddService()" class="btn btn-success">Add Service</a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="view-services">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Service Name</th>
                                                        <th class="wd-15p border-bottom-0">Created Date</th>
                                                        <th class="wd-15p border-bottom-0">Created Time</th>
                                                        <th class="wd-15p border-bottom-0">Created By</th>
                                                        <?php
                                                        if($AdminAccess)
                                                        {
                                                        ?>
                                                            <!-- <th class="wd-15p border-bottom-0">Reset Password</th> -->
                                                            <th class="wd-25p border-bottom-0">Action</th>
                                                            <?php
                                                        }
                                                        ?>
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


            <!-- start add modal  -->

            <div class="modal fade" id="add_service_modal" tabindex="1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="UserModalHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="service_form" onsubmit="return false;">

                                <input type="hidden" id="form_action" name="form_action" value="" />
                                <input type="hidden" id="form_id" name="form_id" value="" />

                                <div class="row">
                                    <div class="form-group col-md-12">
                                       <label for="recipient-name" class="col-form-label">Service Name<span class="text-danger">*<span></label>
                                       <input type="text" class="form-control" name="service_name" id="service_name"
                                            Placeholder="Enter Service Name">
                                    </div>
                                </div>

                                
                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addUpdateBtn"
                                        onclick="AddUpdateService()"></button>
                                    <!-- <a href="#"  class="btn btn-success">Submit</a> -->
                                </div>


                            </form>
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
        <script src="../project-assets/js/commonjs.js"></script>
        <script src="../project-assets/js/service.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_company").addClass("active");
              var i = 1;
                $('#view-services').dataTable({
                     responsive: true,
                    'processing': true,
                    'serverSide': true,
                    'ordering': false,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajax/view-services-post.php'
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
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'ServiceName'
                        },
                        {
                            data: 'CreatedDate'
                        },
                        {
                            data: 'CreatedTime'
                        },
                        {
                            data: 'CreatedBy'
                        }
                        <?php 
                        if($AdminAccess)
                        {
                        ?>
                            ,
                            /*{
                                data: 'ResetPassword'
                            },*/
                            {
                                data: 'Action'
                            }
                        <?php
                        }
                        ?>
                    ]
                });
            });
        </script>
</body>

</html>