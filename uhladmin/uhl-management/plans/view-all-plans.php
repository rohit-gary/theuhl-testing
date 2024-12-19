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
    <title>View All Plans </title>
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
                            <h1 class="page-title">All Plans</h1>
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
                                    <span onclick="AddPlans()" class="btn btn-success">Add Plan</span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_Plans">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Plan Image</th>
                                                        <th class="wd-15p border-bottom-0">Plan Name</th>
                                                       
                                                          <th class="wd-15p border-bottom-0">Plan Details</th>

                                                            <th>Plan Lead</th>

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
            <!--app-content close-->


            <!-- Plan modal start add modal  -->

            <div class="modal fade" id="add_Plans">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="PlansHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="Plans_form" onsubmit="return false;" enctype="multipart/form-data">
                                <div class="row">
                                    

                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Plan Image (1200px x 600px) <span class="text-danger">*<span></label>
                                        <input type="file" class="form-control" name="PlanImage" id="PlanImage">
                                        <span class="text-danger" id="PlanImage_span"></span>
                                        <input type="hidden" name='PlanImage_hidden' id="PlanImage_hidden" style="display:none;"> 
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Plan Name<span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="Name" id="Name"
                                            Placeholder="Enter Plan Name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Plan Duration <span class="text-danger">*<span></label>
                                        <select name="Duration" id="Duration" class="form-control">
                                            <script>
                                                for (let i = 1; i <= 12; i++) {
                                                    document.write(`<option value="${i}">${i}</option>`);
                                                }
                                            </script>
                                        </select>    
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Duration Format<span class="text-danger">*<span></label>
                                        <select name="DurationFormat" id="DurationFormat" class="form-control">
                                            <option value="weeks">Weeks</option>
                                            <option value="months">Months</option>
                                            <option value="years">Years</option>
                                        </select>    
                                    </div>

                                       <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Number of Family Members Covered <span class="text-danger">*<span></label>
                                        <input type="number" class="form-control" name="family_member" id="family_member"
                                            Placeholder="Enter Number Of Family Members ">
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Minimum Number of Family Members Covered <span class="text-danger">*<span></label>
                                        <input type="number" class="form-control" name="min_family_member" id="min_family_member"
                                            Placeholder="Enter Minimum Number Of Family Members ">
                                    </div>
                                    
                                    <div class="mb-3 col-md-6">
                                        <label for="recipient-name" class="col-form-label">Coverage comments <span class="text-danger">*<span></label>
                                        <textarea type="text" class="form-control" name="coverage_comments" id="coverage_comments"
                                            Placeholder="Enter Plan Coverage comments"></textarea>
                                    </div>


                                  
                                    <div class="mb-3 col-md-6" id="cost-container">
                                        <label for="PlanCost" id="cost-label" class="col-form-label">Plan Cost<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="PlanCost" id="PlanCost" placeholder="Plan Cost">
                                    </div>

                                        
                                      
                                    <div class="mb-3 col-md-6" id="cost-container_1">
                                        <label for="PlanCost" id="cost-label" class="col-form-label">Important Points to Covered<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="plan_point" id="plan_point" placeholder="Plan Important Points to Covered">
                                    </div>



                                    <!-- ----------------------eligibility criteria & Scope Coverage-------------------- -->


                                       <!-- ---------------------entry age fileds---------------- -->

                                     <div class="mb-3 col-md-6" id="cost-container_2">
                                        <label for="minimum_age" id="cost-label" class="col-form-label">Minimum Entry Age<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="minimum_age" id="minimum_age" placeholder="Enter Minimum Entry Age">
                                    </div>


                                    <div class="mb-3 col-md-6" id="cost-container_3">
                                        <label for="maximum_age" id="cost-label" class="col-form-label">Maximum Entry Age<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="maximum_age" id="maximum_age" placeholder="Enter Maximum Entry Age">
                                    </div>


                                    <!-------------------------------valid area--------------------- -->
                                    <div class="mb-3 col-md-6" id="cost-container_4">
                                        <label for="valid_area" id="cost-label" class="col-form-label">Valid<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="valid_area" id="valid_area" placeholder="Enter valid Area">
                                    </div>
                               
                                      
                                      <!------------------------------Payments------------------- -->

                                        <div class="mb-3 col-md-6" id="cost-container">
                                        <label for="payments" id="cost-label" class="col-form-label">Payments<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="payments" id="payments" placeholder="Enter Payments">
                                    </div>

                                     <!-- --------Plan Display------------- -->

                                      <div class="mb-3 col-md-6">
                                        <label for="isDisplay" class="col-form-label">DisplayPlan<span class="text-danger"><span></label>
                                        <select name="isDisplay" id="isDisplay" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                            
                                        </select>    
                                    </div>


 
                                     <div class="mb-3 col-md-12">
                                        <label for="recipient-name" class="col-form-label">Plan Highlights <span class="text-danger">*<span></label>
                                        <textarea type="text" class="plan_highlights" name="plan_highlights" id="plan_highlights"
                                            Placeholder="Enter Plan Highlights"></textarea>
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="recipient-name" class="col-form-label">Plan Description <span class="text-danger">*<span></label>
                                        <textarea type="text" class="plan_highlights" name="plan_Description" id="plan_Description"
                                            Placeholder="Enter Plan Description"></textarea>
                                    </div>


                                   
                                     
                                    
                                </div>

                                <input type="hidden" id="form_action" name="form_action" value="add" />
                                <input type="hidden" id="form_id" name="form_id" value="-1" />

                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addPlansBtn"
                                        onclick="AddUpdatePlansForm()"></button>
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
                            <form id="coordinator_Plans_form" onsubmit="return false;">
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
       <script src="../project-assets/js/plan.js"></script>
        <!-- INTERNAL WYSIWYG Editor JS -->
        <script src="../theme-assets/plugins/wysiwyag/jquery.richtext.js"></script>
        <script src="../theme-assets/plugins/wysiwyag/wysiwyag.js"></script>
        <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

        <!-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> -->

        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_Plan").addClass("active");
            });
        </script>

     

<script>
    var PlanDescription = new RichTextEditor("#plan_Description");
    var PlanHighlights= new RichTextEditor("#plan_highlights");
 
</script>
</body>

</html>