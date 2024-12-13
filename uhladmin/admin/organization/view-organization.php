<?php @session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>View All Organizations - DWD Portal</title>
    <?php
    @session_start(); 
    include("../include/common-head.php");
    require_once('../include/autoloader.inc.php');
    $dbh = new Dbh();
    $conn = $dbh->_connectodb();
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();
    $Modules = new Modules($conn);
    $All_Modules = $Modules->getAllModules();
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
    <style type="text/css">
        .datepicker 
        {
            z-index:10000 !important;
        }
    </style>
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
                            <h1 class="page-title">All Organizations</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Organizations</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <!-- <div class="row pb-5 justify-content-end">
                            <div class="col-md-4 text-end">
                                <a href="./add-partner-account-manager" class="btn btn-success">Add PAM</a>
                            </div>
                        </div> -->
                            <div class="row pb-5 justify-content-end">
                            <div class="col-md-4 text-end">
                                <span onclick="AddOrganization()" class="btn btn-success">Add Organization</span>
                            </div>
                        </div>
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="organization_table" class="table table-bordered text-nowrap key-buttons border-bottom">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Organization Name</th>
                                                        <th class="wd-15p border-bottom-0">Address</th>
                                                        <th class="wd-15p border-bottom-0">POC / Email / Phone Number</th>
                                                        <th class="wd-15p border-bottom-0">View Modules</th>
                                                        <th class="wd-15p border-bottom-0">GST Number</th>
                                                        <th class="wd-15p border-bottom-0">Onboarding Date</th>
                                                        <th class="wd-15p border-bottom-0">Action</th>
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
        </div>
    </div>

            <!--app-content close-->
            <div class="modal fade" id="add_organization">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="OrganizationHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="organization_form" onsubmit="return false;">
                                <div class="row">
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="recipient-name" class="col-form-label">Organization Name <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="organizationname" id="organizationname"
                                            Placeholder="Enter Organization Name">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="recipient-name" class="col-form-label">Address <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            Placeholder="Enter Address">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="recipient-name" class="col-form-label">POC <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="poc" id="poc"
                                            Placeholder="Enter POC">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="recipient-name" class="col-form-label">Email <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            Placeholder="Enter Email">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="recipient-name" class="col-form-label">Phone Number <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="phonenumber" id="phonenumber"
                                            Placeholder="Enter Phone Number">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12" id="tb_org_password">
                                        <label for="recipient-name" class="col-form-label">Password <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="password" id="password"
                                            Placeholder="Enter Password">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12" id="tb_org_confirm_password">
                                        <label for="recipient-name" class="col-form-label">Confirm Password <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="confirmpassword" id="confirmpassword"
                                            Placeholder="Enter Confirm Password">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="recipient-name" class="col-form-label">GST No.</label>
                                        <input type="text" class="form-control" name="gstno" id="gstno"
                                            Placeholder="Enter GST No">
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="recipient-name" class="col-form-label">Logo</label>
                                        <input type="file" class="form-control" name="logo" id="logo">
                                    </div>
                                    

                                <input type="hidden" id="form_action" name="form_action" value="add" />
                                <input type="hidden" id="form_id" name="form_id" value="-1" />

                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addOrganizationBtn"
                                        onclick="AddUpdateOrganizationForm()"> Add </button>
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

        <script src="../project-assets/js/organization.js"></script>
        <script src="../project-assets/js/commonjs.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
        
         <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_organization").addClass("active");
            });
        </script>
    </body>

</html>

<!-- Modals -->
<div class="modal fade" id="organization_modules_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title">View Org Modules
                    <a onclick="AddModule()"><i class="fe fe-plus"></i></a></h3>

                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="org_modules_modal_body_div">
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="organization_module_database_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title">Set Module Database</h3><a class="btn btn-sm btn-primary mt-1" style="margin-left:1em" onclick="SyncUsers()">Sync Users</a>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="org_modules_modal_body_div">
                <form id="module_database_form" onsubmit="return false;">
                    <input type="hidden" id="set_database_modal_mapping_id" name="set_database_modal_mapping_id" />
                    <div class="row">
                        <div class="mb-3 col-md-4 col-4">
                            <label for="recipient-name" class="col-form-label">Database Name (Global)</label>
                            <input type="text" class="form-control" name="db_name_global" id="db_name_global">
                        </div>
                        <div class="mb-3 col-md-4 col-4">
                            <label for="recipient-name" class="col-form-label">Database User (Global)</label>
                            <input type="text" class="form-control" name="db_user_global" id="db_user_global">
                        </div>
                        <div class="mb-3 col-md-4 col-4">
                            <label for="recipient-name" class="col-form-label">Database Password (Global)</label>
                            <input type="text" class="form-control" name="db_password_global" id="db_password_global">
                        </div>
                        <div class="mb-3 col-md-4 col-4">
                            <label for="recipient-name" class="col-form-label">Database Name (Local)</label>
                            <input type="text" class="form-control" name="db_name_local" id="db_name_local">
                        </div>
                        <div class="mb-3 col-md-4 col-4">
                            <label for="recipient-name" class="col-form-label">Database User (Local)</label>
                            <input type="text" class="form-control" name="db_user_local" id="db_user_local">
                        </div>
                        <div class="mb-3 col-md-4 col-4">
                            <label for="recipient-name" class="col-form-label">Database Password (Local)</label>
                            <input type="text" class="form-control" name="db_password_local" id="db_password_local">
                        </div>
                    </div>
                     <div class="mt-5 text-center">
                        <button class="btn btn-success text-white" id="setModuleDatabaseBtn"
                            onclick="SetModuleDatabase()"> Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>