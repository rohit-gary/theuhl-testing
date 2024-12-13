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
    <title>View Company Sites </title>
    
    <?php
    include("../include/common-head.php");
    $company = new Company($conn);
    $companies_list = $company->GetCompaniesList();
    $Zone = new Zone($conn);
    $all_zones = $Zone->GetAllZones();
    $CompanyID = -1;
    if(isset($_SESSION['CompanyID']))
    {
        $CompanyID = $_SESSION['CompanyID'];
    }
    $param = "nav=-1";
    if(isset($_GET['nav']))
    {
        $CompanyID = -1;
        $param = "nav=1";
    }
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
                            <h1 class="page-title">All Company Sites
                            </h1>

                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Company Sites</li>
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
                                    <a href="#" onclick="AddCompanySite()" class="btn btn-success">Add Company Site</a>
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
                                            <table class="table table-bordered text-nowrap border-bottom" id="view-company-sites">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Site Name / Zone</th>
                                                        <th class="wd-15p border-bottom-0">Company</th>
                                                        <th class="wd-15p border-bottom-0">Site Address</th>
                                                        <th class="wd-15p border-bottom-0">POC Name</th>
                                                        <th class="wd-15p border-bottom-0">POC Email</th>
                                                        <th class="wd-15p border-bottom-0">POC Contact</th>
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

            <div class="modal fade" id="add_company_site_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="UserModalHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="company_site_form" onsubmit="return false;">

                                <input type="hidden" id="form_action" name="form_action" value="" />
                                <input type="hidden" id="form_id" name="form_id" value="" />

                                <div class="row">
                                    <div class="form-group col-md-12">
                                       <label for="recipient-name" class="col-form-label" style="width:100%;">Select Company<span class="text-danger">*<span></label>
                                      
                                        <select class="form-control select2-show-search form-select" id="s_company" name="s_company" data-placeholder="Choose one" style="width:100%;">
                                                <option label="Choose one"></option>
                                                <?php 
                                                foreach ($companies_list as $company) 
                                                {
                                                ?>
                                                    <option value="<?php echo $company['ID']; ?>"><?php echo $company['CompanyName']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                       
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="recipient-name" class="col-form-label" style="width:100%;">Zone<span class="text-danger">*<span></label>
                                      
                                        <select class="form-control select2-show-search form-select" id="s_zoneid" name="s_zoneid" data-placeholder="Choose one" style="width:100%;">
                                                <option label="Choose one"></option>
                                                <?php 
                                                foreach ($all_zones as $zone) 
                                                {
                                                ?>
                                                    <option value="<?php echo $zone['ID']; ?>"><?php echo $zone['ZoneName']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                       
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="recipient-name" class="col-form-label">Company Site Name<span class="text-danger">*<span></label>
                                       <input type="text" class="form-control" name="company_site_name" id="company_site_name"
                                            Placeholder="Enter Company Name">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="recipient-name" class="col-form-label">Company Address</label>
                                        <textarea class="form-control" placeholder="Please Enter Company Address" rows="2" name="ta_company_site_address" id="ta_company_site_address"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="recipient-name" class="col-form-label">POC Name</label>
                                       <input type="text" class="form-control" name="site_poc_name" id="site_poc_name" placeholder="Enter POC Name">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="recipient-name" class="col-form-label">POC Email</label>
                                        <input type="text" class="form-control" name="site_poc_email" id="site_poc_email" placeholder="Enter POC Email">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="recipient-name" class="col-form-label">POC Phone Number</label>
                                        <input type="text" maxlength="10" class="form-control" onkeyup="validISNumber()" name="site_poc_contact" id="site_poc_contact" placeholder="Enter Phone Number">
                                    </div>     
                                </div>

                                
                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addUpdateBtn"
                                        onclick="AddUpdateCompanySite()"></button>
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
        <script src="../project-assets/js/company.js"></script>
        <!-- SELECT2 JS -->
        <script src="../theme-assets/plugins/select2/select2.full.min.js"></script>
        <script src="../theme-assets/js/select2.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_company_sites").addClass("active");
              var i = 1;
                $('#view-company-sites').dataTable({
                     responsive: true,
                    'processing': true,
                    'serverSide': true,
                    'ordering': false,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajax/view-company-sites-post.php?<?php echo $param; ?>'
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
                            data: 'SiteName'
                        },
                        {
                            data: 'CompanyName'
                        },
                        {
                            data: 'SiteAddress'
                        },
                        {
                            data: 'SitePOCName'
                        },
                        {
                            data: 'SitePOCEmail'
                        },
                        {
                            data: 'SitePOCContact'
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