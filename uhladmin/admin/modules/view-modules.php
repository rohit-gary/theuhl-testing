<?php @session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>Modules - DWD Portal</title>
    <?php
    @session_start(); 
    include("../include/common-head.php");
    require_once('../include/autoloader.inc.php');
    $dbh = new Dbh();
    $conn = $dbh->_connectodb();
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();

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

                        <div class="page-header mb-3">
                            <h1 class="page-title">All Modules</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Modules</li>
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
                                <span onclick="AddModules()" class="btn btn-success">Add Modules</span>
                            </div>
                        </div>
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="modules_table" class="table table-bordered text-nowrap key-buttons border-bottom">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Modules Name</th>
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
            <div class="modal fade" id="add_modules">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="ModulesHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="modules_form" onsubmit="return false;">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="recipient-name" class="col-form-label">Modules Name <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="modulesname" id="modulesname"
                                            Placeholder="Enter Modules Name">
                                    </div>

                                <input type="hidden" id="form_action" name="form_action" value="add" />
                                <input type="hidden" id="form_id" name="form_id" value="-1" />

                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addModulesBtn"
                                        onclick="AddUpdateModulesForm()"> Add </button>
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

        <script src="../project-assets/js/modules.js"></script>
        <script src="../project-assets/js/commonjs.js"></script>
         
         <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_modules").addClass("active");
            });
        </script>
    </body>

</html>