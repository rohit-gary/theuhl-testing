<?php @session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>View Configuration - DWD</title>
    <?php
        @session_start();
        include("../include/common-head.php");
        require_once('../include/autoloader.inc.php');
        include("../include/get-db-connection.php");
        $setting = new Clientsetting($conn);
        $Service = new Service($conn);
        $all_services = $Service->GetAllServices();
        $all_categories = $Service->GetAllDocCat();

      
    ?>
    <link rel="stylesheet" href="../project-assets/other-assets/date-picker/bootstrap-datepicker.css" />
    <style type="text/css">
    .settings-display {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .settings-display .card {
        width: 50%;
    }
    </style>

</head>



<body class="app sidebar-mini ltr light-mode">
    <div class="page">
        <div class="page-main">
            <?php
            include("../navigation/top-header.php");
            ?>

            <?php
            include("../navigation/side-navigation.php");
            ?>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- PAGE-HEADER -->
                        <div class="page-header row align-items-center justify-content-between">
                            <!-- <h1 class="page-title">DigitalWorkDesk Dashboard</h1> -->
                            <div class="col-md-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Configuration</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                           

                            <!-- <div class="col-md-6">
                                <div class="card ">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title">All Zones</h3>
                                        <a class="btn btn-info" onclick="AddZone()">Add</a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_student_detals">
                                                <tbody>
                                                    <?php
                                                        foreach($all_zones as $zone_value)
                                                        {
                                                        ?>
                                                    <tr>
                                                        <td class="wd-15p border-bottom-0">
                                                            <?= $zone_value['ZoneName']; ?></td>
                                                        <td class="wd-15p border-bottom-0">
                                                            <?= $zone_value['ZoneEmail']; ?></td>
                                                        <td class="wd-15p border-bottom-0">
                                                            <a class="btn text-danger btn-sm"
                                                                onclick="UpdateZone(<?=$zone_value['ID'];?>)">
                                                                <span class="fa fa-pencil-square-o fs-14"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                        ?>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title">Doctor Categories</h3>
                                        <a class="btn btn-info" onclick="AddDoctorsCat()">Add</a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_student_detals">
                                                <tbody>
                                                    <?php
                                                        foreach($all_categories as $cat_value)
                                                        {
                                                        ?>
                                                    <tr>
                                                        <td class="wd-15p border-bottom-0">
                                                            <?= $cat_value['CategoryName']; ?></td>

                                                            <td class="wd-15p border-bottom-0">
                                                                <?php if(!empty($cat_value['CatImage'])): ?>
                                                                    <img src="<?= $cat_value['CatImage']; ?>" alt="Category Image" width="50" height="50">
                                                                <?php else: ?>
                                                                    No Image Available
                                                                <?php endif; ?>
                                                            </td>

                                                        
                                                        <td class="wd-15p border-bottom-0">
                                                            <a class="btn text-danger btn-sm"
                                                                onclick="UpdateDocCat(<?=$cat_value['ID'];?>)">
                                                                <span class="fa fa-pencil-square-o fs-14"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                        ?>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="card ">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title">All Service</h3>
                                        <a class="btn btn-info" onclick="AddService()">Add</a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_student_detals">
                                                <tbody>
                                                    <?php
                                                        foreach($all_services as $service_value)
                                                        {
                                                        ?>
                                                    <tr>
                                                        <td class="wd-15p border-bottom-0">
                                                            <?= $service_value['ServiceName']; ?></td>
                                                        <td class="wd-15p border-bottom-0">
                                                            <a class="btn text-danger btn-sm"
                                                                onclick="UpdateService(<?=$service_value['ID'];?>)">
                                                                <span class="fa fa-pencil-square-o fs-14"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                        ?>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



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
        <script>
        $("#nav_configuration").addClass("active");
        </script>
        <script src="../project-assets/js/configuration.js"></script>
</body>

</html>

<!-- service modal start  -->

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
                            <label for="recipient-name" class="col-form-label">Service Name<span
                                    class="text-danger">*<span></label>
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

<!-- service modal end  -->



<!-- doctor cat modal start  -->

<div class="modal fade" id="add_doctor_cat_modal" tabindex="1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title" id="DoctorCatModalHeading"></h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="doctor_cat_form" onsubmit="return false;">

                    <input type="hidden" id="form_doctorcat_action" name="form_action" value="" />
                    <input type="hidden" id="form_doctorcat_id" name="form_doctorcat_id" value="" />

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="col-form-label">Category Name<span
                                    class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="cat_name" id="cat_name"
                                Placeholder="Enter Doctor's Category Name">
                        </div>
                    </div>


                 <div class="mb-3 col-md-12">
                        <label for="recipient-name" class="col-form-label">CatImage<span class="text-danger">*<span></label>
                        <input type="file" class="form-control" name="CatImage" id="CatImage">
                        <span class="text-danger" id="CatImage_span"></span>
                        <input type="hidden" name='CatImage_hidden' id="CatImage_hidden" style="display:none;"> 
                    </div>


                    <div class="mt-5 text-center">
                        <button class="btn btn-success text-white" id="addUpdateCatBtn"
                            onclick="AddUpdateDoctorCat()"></button>
                        <!-- <a href="#"  class="btn btn-success">Submit</a> -->
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<!-- doctors cat  modal end  -->