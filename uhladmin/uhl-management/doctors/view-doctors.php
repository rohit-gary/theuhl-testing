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
    <title>View All Doctors </title>
    <?php 
    include("../include/common-head.php");
    include("../include/get-db-connection.php");
    $dbh = new Dbh();
    $Masterconn = $dbh->_connectodb();
    $core = new Core();
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();
      $CMUsers=new CMUsers($conn);
     $AllCoordinator = $CMUsers->getAllPlanLead();




    $CenterID = -1;
    if(isset($_SESSION['CenterID'])){
        $CenterID = $_SESSION['CenterID'];
    }

   

     $access = false;
    if($UserType == "Client Admin")
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
                            <h1 class="page-title">All Doctors</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Plan</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                               

                        <div class="row pb-5 justify-content-end">
                             <?php if ($access) { ?>
                                <div class="col-md-4 text-end">
                                    <span onclick="AddDoctors()" class="btn btn-success">Add Doctors</span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_Doctors">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Doctor Profile </th>
                                                        <th class="wd-15p border-bottom-0">Doctor Info</th>
                                                        <th class="wd-15p border-bottom-0">Doctor Contact Details</th>
                                                        <th class="wd-15p border-bottom-0">Doctor Details</th>
                                                        <th class="wd-15p border-bottom-0">Action </th>

                                                        
                                                        
                                                        
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


            <!-- Plan modal start add modal  -->

            <div class="modal fade" id="add_Doctors">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="DoctorsHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="Doctors_form" onsubmit="return false;" enctype="multipart/form-data">
                                <div class="row">
                                    

                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Doctor Image (500px x 500px) <span class="text-danger">*<span></label>
                                        <input type="file" class="form-control" name="DoctorImage" id="DoctorImage">
                                        <span class="text-danger" id="DoctorImage_span"></span>
                                        <input type="hidden" name='DoctorImage_hidden' id="DoctorImage_hidden" style="display:none;"> 
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Doctor Name<span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="Name" id="Name"
                                            Placeholder="Enter Doctor Full Name">
                                    </div>

                                     <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Gender<span class="text-danger">*<span></label>
                                        <select name="DoctorGender" id="Gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>    
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Doctor Phone Number<span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="phoneNumber" id="phoneNumber"
                                            Placeholder="Enter Doctor Phone Number">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Doctor Email Id<span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            Placeholder="Enter Doctor Email ID">
                                    </div>


                                     <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Doctor Address<span class="text-danger"><span></label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            Placeholder="Enter Doctor Address">
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Medical Degree<span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="medicalDegrees" id="medicalDegrees"
                                            Placeholder="Enter Doctor Medical Degree">
                                    </div>


                                     <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Specialization <span class="text-danger"><span></label>
                                        <input type="text" class="form-control" name="specialization" id="specialization"
                                            Placeholder="Enter Doctor Specialization">
                                    </div>


                                     <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Medical License Number <span class="text-danger"><span></label>
                                        <input type="text" class="form-control" name="licenseNumber" id="licenseNumber"
                                            Placeholder="Enter Doctor Medical License Number">
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">License Expiry Date <span class="text-danger"><span></label>
                                        <input type="text" class="form-control" name="licenseExpiryDate" id="licenseExpiryDate"
                                            Placeholder="Enter Doctor License Expiry Date">
                                    </div>


                                    <div class="mb-3 col-md-6" id="cost-container">
                                        <label for="fee" id="cost-label" class="col-form-label">Doctor Fee<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="fee" id="fee" placeholder="Doctor Fee">
                                    </div>
                              
                                    
                                </div>

                                <input type="hidden" id="form_action" name="form_action" value="add" />
                                <input type="hidden" id="form_id" name="form_id" value="-1" />

                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addDoctorsBtn"
                                        onclick="AddUpdateDoctorsForm()"></button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
 

            <!-- Plan modal End End modal  -->

            <!-- Plan Cordinator modal start add modal  -->

            <div class="modal fade" id="add_Plan_coordinator">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="PlanCoordinatorHeading">Add & Update Plan Lead</h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="coordinator_Doctors_form" onsubmit="return false;">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="recipient-name" class="col-form-label">Plan Lead <span class="text-danger">*<span></label>
                                        <select class="form-control select2" name="PlanCoordinator" id="PlanCoordinator" style='width:100%;'>
                                            <option value="-1">Select Plan Lead</option>
                                            <?php
                                            foreach($AllCoordinator as $Coordinator_value)
                                            {
                                            ?>
                                            <option value="<?php echo  $Coordinator_value['ID']; ?>">
                                                <?php echo  $Coordinator_value['Name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                  <input type="hidden" name="coordinator_form_id" id="coordinator_form_id" value="-1">
                                    
                                </div>

                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addPlanCoordinatorBtn"
                                        onclick="AddUpdatePlanCoordinatorForm()">Add Lead</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Plan Cordinator modal End End modal  -->

            


        <?php
       include("../navigation/right-side-navigation.php");
        ?>

        </div>

        <?php
       include("../include/common-script.php");
        ?>
       <script src="../project-assets/js/doctor.js"></script>
        <script src="../project-assets/other-assets/date-picker/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_Plan").addClass("active");
            });
        </script>
 

<script>
    $(document).ready(function() {
        $('#licenseExpiryDate').datepicker({
            autoclose: true,        // Automatically close the picker after selecting a date
            todayHighlight: true,   // Highlight today’s date
            format: 'yyyy-mm-dd',   // Date format
            startDate: '0d',        // Disable past dates
        });
    });
</script>
</body>

</html>