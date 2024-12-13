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
    <title>View Service Reports </title>

    <link rel="stylesheet" href="../project-assets/other-assets/date-picker/bootstrap-datepicker.css" />

    <?php
    include("../include/common-head.php");
    $company = new Company($conn);
    $companies_list = $company->GetCompaniesList();
    $CompanyID = -1;
    if(isset($_SESSION['CompanyID']))
    {
        $CompanyID = $_SESSION['CompanyID'];
    }
    $companies_site_list = $company->GetCompanySitesList($CompanyID);

    $Service = new Service($conn);
    $All_services = $Service->GetAllServices();

    
    ?>

    <style>
    #service-image-container {
        display:flex;
        flex-wrap:wrap;
    }
    #service-image-container img {
        width: 100%;
    }

    .delete-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-wrapper {
        position: relative;
        margin: 10px;
        width: 150px;
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
                        <div class="page-header">
                            <h1 class="page-title">All Service Reports
                            </h1>

                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Service Reports</li>
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
                                <a href="#" onclick="AddServiceReport()" class="btn btn-success">Add Service Report</a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                        <form id="service_report_fillter">
                            <div class="row row-sm  justify-content-center bg-white p-4 mb-5">
                                <div class="col-2">
                                    <input type="date" class="form-control fc-datepicker" id="filter_start_date"
                                        name="filter_start_date" placeholder="Start Date">
                                </div>

                                <div class="col-2">
                                    <input type="date" class="form-control fc-datepicker" id="filter_end_date"
                                        name="filter_end_date" placeholder="End Date">
                                </div>

                                <div class="form-group mb-0 col-md-3 bg-white">


                                    <select onchange="GetFilletrCompanySiteDropdown(this.value)"
                                        class="form-control select2-show-search form-select" name="fillter_company_id"
                                        id="fillter_company_id" data-placeholder="Select Company" style="width:100%;">
                                        <option label="Choose one"></option>
                                        <?php 
                                                foreach ($companies_list as $company) 
                                                {
                                                ?>
                                        <option value="<?php echo $company['ID']; ?>">
                                            <?php echo $company['CompanyName']; ?></option>
                                        <?php
                                                }
                                                ?>
                                    </select>

                                </div>



                                <div class="form-group mb-0 col-md-3 bg-white">

                                    <select class="form-control select2-show-search form-select"
                                        name="fillter_company_site_id" id="fillter_company_site_id"
                                        data-placeholder="Select Company Site" style="width:100%;">

                                    </select>


                                </div>


                                <div class="form-group mb-0 col-md-2 bg-white">

                                    <select class="form-control select2-show-search form-select"
                                        data-placeholder="Choose one" style="width:100%;" id="fillter_service_value"
                                        name="fillter_service_value">
                                        <option label="Choose Services"></option>
                                        <?php 
                                            foreach ($All_services as $Service_value) 
                                            {
                                            ?>
                                        <option value="<?php echo $Service_value['ID']; ?>">
                                            <?php echo $Service_value['ServiceName']; ?></option>
                                        <?php
                                            }
                                            ?>
                                    </select>

                                </div>


                                <div class="col-3 mt-3 text-center d-flex">
                                    <span onclick="SearchFillterServiceReport()" class="btn btn-danger"
                                        style="margin-right:5px">Search</span>

                                </div>

                                <div class="col-2 mt-3 text-center d-flex pt-2">
                                    <label>Total Service Report(s) - &nbsp;&nbsp;</label>
                                    <span id="total_service_report"></span>
                                </div>




                            </div> <!-- row -->
                        </form>
                        <!-- Filters -->


                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="view-service-reports">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Company Site / Company </th>
                                                        <th class="wd-15p border-bottom-0">Service</th>
                                                        <th class="wd-15p border-bottom-0">Status</th>
                                                        <th class="wd-15p border-bottom-0">Created At</th>
                                                        <th class="wd-15p border-bottom-0">Created By</th>
                                                        <th class="wd-15p border-bottom-0">View PDF</th>
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

            <div class="modal fade" id="service_report_modal" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="ServiceModalHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="service_report_modal_form" onsubmit="return false;">

                                <input type="hidden" id="service_report_form_action" name="form_action" value="" />
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="recipient-name" class="col-form-label" style="width:100%;">Select
                                            Company<span class="text-danger">*<span></label>

                                        <select class="form-control select2-show-search form-select" id="ser_company"
                                            name="CompanyID" data-placeholder="Select Company" style="width:100%;"
                                            onchange="GetCompanySiteDropdown(this.value)">
                                            <option label="Choose one"></option>
                                            <?php 
                                                foreach ($companies_list as $company) 
                                                {
                                                ?>
                                            <option value="<?php echo $company['ID']; ?>">
                                                <?php echo $company['CompanyName']; ?></option>
                                            <?php
                                                }
                                                ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-3" id="ser_company_site_dropdown">
                                        <label for="recipient-name" class="col-form-label" style="width:100%;">Select
                                            Company Site<span class="text-danger">*<span></label>

                                        <select class="form-control select2-show-search form-select"
                                            id="ser_company_sites" name="CompanySiteID"
                                            data-placeholder="Select Company Site" style="width:100%;" disabled="true">
                                        </select>

                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="recipient-name" class="col-form-label" style="width:100%;">Select
                                            Service<span class="text-danger">*<span></label>

                                        <select class="form-control select2-show-search form-select" id="ser_services"
                                            name="ServiceID" data-placeholder="Choose one" style="width:100%;"
                                            onchange="GenerateServiceReportForms(this.value);" disabled="true">
                                            <option label="Choose one"></option>
                                            <?php 
                                            foreach ($All_services as $Service_value) 
                                            {
                                            ?>
                                            <option value="<?php echo $Service_value['ID']; ?>">
                                                <?php echo $Service_value['ServiceName']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="recipient-name" class="col-form-label" style="width:100%;">Channel
                                            Partner<span class="text-danger">*<span></label>

                                        <input type="text" class="form-control" value='RPM'
                                            placeholder="Enter Channel Partner" name='ChannelPartner'
                                            id='Channel_Partner'>

                                    </div>
                                </div>


                                <div class="col-xl-12 col-12 p-0" id="service_report_form_div">

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
        <script src="../project-assets/js/service-reports.js"></script>
        <!-- SELECT2 JS -->
        <script src="../theme-assets/plugins/select2/select2.full.min.js"></script>
        <script src="../theme-assets/js/select2.js"></script>

        <!-- DATEPICKER JS -->
        <script src="../project-assets/other-assets/date-picker/bootstrap-datepicker.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            $("#nav_company_sites").addClass("active");
            var i = 1;
            $('#view-service-reports').dataTable({
                responsive: true,
                'processing': true,
                'serverSide': true,
                'ordering': false,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'ajax/view-service-reports-post.php'
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
                        data: 'SiteNameCompanyName'
                    },
                    {
                        data: 'ServiceName'
                    },
                    {
                        data: 'Status'
                    },
                    {
                        data: 'CreatedAt'
                    },
                    {
                        data: 'Technician'
                    },
                    {
                        data: 'PDFGenearte'
                    }
                    <?php 
                        if($AdminAccess)
                        {
                        ?>,
                    {
                        data: 'Action'
                    }
                    <?php
                        }
                        ?>
                ]
            });
            GetServiceReportStats();
        });
        </script>
</body>

</html>