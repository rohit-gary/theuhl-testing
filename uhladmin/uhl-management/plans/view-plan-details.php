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

     $plan=new Plans($conn);
    

   if (isset($_GET['PlanID'])) {
    
    $encodedID = $_GET['PlanID'];
    $ID = base64_decode($encodedID);

   
    $all_plan_details = $plan->GetPlanDetailsbyID($ID);
    $plan_lead_Details=$CMUsers-> GetUserDetailsByID($all_plan_details[0]['PlanCoordinator']);

   



    
    // print_r($all_plan_details);
    // die();
}
    
    ?>

    <style type="text/css">
  .profile-cover__action{ 
  background-position: center; 
  width: 100%;
  }
   
</style>

</head>

<body class="app sidebar-mini ltr light-mode">

    

    <!-- PAGE -->
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
                            <h1 class="page-title"></h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Plan</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 OPEN -->
                        <div class="row" id="user-profile">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="wideget-user mb-2">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="row">
                                                        <div class="panel profile-cover">
                                                            <div class="profile-cover__action bg-img" 
                                                                 style="background-image: url('../project-assets/plan/<?php echo $all_plan_details[0]['PlanImage']; ?>');">
                                                                
                                                            </div>
                                                            <div class="profile-cover__img">
                                                                
                                                            </div>
                                                            <div class="btn-profile">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-3">
                                        <!-- <div class="card">
                                            <div class="card-body">
                                                <div class="main-profile-contact-list">
                                                    <div class="me-5">
                                                        <div class="media mb-4 d-flex">
                                                            <div class="media-icon bg-secondary bradius me-3 mt-1">
                                                                <i class="fe fe-edit fs-20 text-white"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Posts</span>
                                                                <div class="fw-semibold fs-25">
                                                                    328
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="me-5 mt-5 mt-md-0">
                                                        <div class="media mb-4 d-flex">
                                                            <div class="media-icon bg-danger bradius text-white me-3 mt-1">
                                                                <span class="mt-3">
                                                                    <i class="fe fe-users fs-20"></i>
                                                                </span>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Followers</span>
                                                                <div class="fw-semibold fs-25">
                                                                    937k
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="me-0 mt-5 mt-md-0">
                                                        <div class="media">
                                                            <div class="media-icon bg-primary text-white bradius me-3 mt-1">
                                                                <span class="mt-3">
                                                                    <i class="fe fe-cast fs-20"></i>
                                                                </span>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Following</span>
                                                                <div class="fw-semibold fs-25">
                                                                    2,876
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Plan Basic Details</div>
                                            </div>
                                      <div class="card-body">
                                                <div>
                                                    <h5><b><?php echo !empty($all_plan_details[0]['PlanName']) ? $all_plan_details[0]['PlanName'] : 'Coming Soon'; ?></b><i class="fe fe-edit-3 text-primary mx-2"></i></h5>
                                                </div>
                                                <hr>
                                                <!-- Plan Name -->
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-star fs-20"></i></span> <!-- Replace with an appropriate icon -->
                                                    </div>
                                                    <div>
                                                        <strong>Plan Name:</strong> 
                                                        <?php echo !empty($all_plan_details[0]['PlanName']) ? $all_plan_details[0]['PlanName'] : 'Coming Soon'; ?>
                                                    </div>
                                                </div>
                                                <!-- Plan Duration -->
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-calendar fs-20"></i></span> <!-- Replace with an appropriate icon -->
                                                    </div>
                                                    <div>
                                                        <strong>Plan Duration:</strong> 
                                                        <?php echo !empty($all_plan_details[0]['PlanDuration']) ? $all_plan_details[0]['PlanDuration'] : 'Coming Soon'; ?>
                                                        <?php echo !empty($all_plan_details[0]['PlanDurationFormat']) ? ' ' . $all_plan_details[0]['PlanDurationFormat'] : ''; ?>
                                                    </div>
                                                </div>
                                                <!-- Number of Family Members -->
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-users fs-20"></i></span> <!-- Replace with an appropriate icon -->
                                                    </div>
                                                    <div>
                                                        <strong>Family Members Covered:</strong> 
                                                        <?php echo !empty($all_plan_details[0]['PlanFamilyMember']) ? $all_plan_details[0]['PlanFamilyMember'] : 'Coming Soon'; ?>
                                                    </div>
                                                </div>
                                                <!-- Plan Cost -->
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-dollar-sign fs-20"></i></span> <!-- Replace with an appropriate icon -->
                                                    </div>
                                                    <div>
                                                        <strong>Plan Cost:</strong> 
                                                        <?php echo !empty($all_plan_details[0]['PlanCost']) ? $all_plan_details[0]['PlanCost'] : 'Coming Soon'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                       <!--  <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Skills</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="tags">
                                                    <a href="javascript:void(0)" class="tag">Laravel</a>
                                                    <a href="javascript:void(0)" class="tag">Angular</a>
                                                    <a href="javascript:void(0)" class="tag">HTML</a>
                                                    <a href="javascript:void(0)" class="tag">Vuejs</a>
                                                    <a href="javascript:void(0)" class="tag">Codiegniter</a>
                                                    <a href="javascript:void(0)" class="tag">JavaScript</a>
                                                    <a href="javascript:void(0)" class="tag">Bootstrap</a>
                                                    <a href="javascript:void(0)" class="tag">PHP</a>
                                                </div>
                                            </div>
                                        </div> -->

                                             <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Plan Lead</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    
                                                    <div class="media overflow-visible mt-sm-5">
                                                        <span class="avatar cover-image avatar-md brround bg-pink me-3"><?php  $name = $plan_lead_Details['Name'];$initials = strtoupper(substr($name, 0, 1) . substr($name, strpos($name, ' ') + 1, 1));
                                                             echo  $initials?>
                                                                 
                                                             </span>
                                                        <div class="media-body valign-middle mt-2">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark"><?php 
                                                        if (!empty($plan_lead_Details['Name'])) {
                                                            echo $plan_lead_Details['Name'];
                                                        } else {
                                                            echo "Coming Soon";
                                                        }
                                                    ?></a>
                                                            <p class="text-muted mb-0"><?php 
                                                        if (!empty($plan_lead_Details['PhoneNumber'])) {
                                                            echo $plan_lead_Details['PhoneNumber'];
                                                        } else {
                                                            echo "Coming Soon";
                                                        }
                                                    ?></p>
                                                        </div>
                                                        <!-- <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                            <button class="btn btn-sm btn-secondary" type="button">Follow</button>
                                                        </div> -->
                                                    </div>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-xl-9">
                                         <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                
                                                <div class="mt-4">
                                                    <h4 class="fw-semibold mt-3">Plan Coverage Comments</h4>
                                                        <p class="mb-0"><?php 
                                                        if (!empty($all_plan_details[0]['CoverageComments'])) {
                                                            echo $all_plan_details[0]['CoverageComments'];
                                                        } else {
                                                            echo "Coming Soon";
                                                        }
                                                    ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer user-pro-2">
                                                <div class="media mt-0">
                                                    <div class="media-user me-2">
                                                        
                                                    </div>
                                                    <div class="media-body">
                                                       
                                                    </div>
                                                    <div class="ms-auto">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                
                                                <div class="mt-4">
                                                    <h4 class="fw-semibold mt-3">Plan Important Point</h4>
                                                    <p class="mb-0"><?php 
                                                            if (!empty($all_plan_details[0]['PlanImportantPoint'])) {
                                                                echo $all_plan_details[0]['PlanImportantPoint'];
                                                            } else {
                                                                echo "Coming Soon";
                                                            }
                                                        ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer user-pro-2">
                                                <div class="media mt-0">
                                                    <div class="media-user me-2">
                                                        
                                                    </div>
                                                    <div class="media-body">
                                                       
                                                    </div>
                                                    <div class="ms-auto">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="media mt-0">
                                                       
                                                       
                                                    </div>
                                                   
                                                </div>
                                                <div class="mt-4">
                                                    
                                                    <h4 class="fw-semibold mt-3">Plan HighLights</h4>
                                                    <p class="mb-0"><?php 
                                                            if (!empty($all_plan_details[0]['PlanHighlights'])) {
                                                                echo $all_plan_details[0]['PlanHighlights'];
                                                            } else {
                                                                echo "Coming Soon";
                                                            }
                                                        ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer user-pro-2">
                                                <div class="media mt-0">
                                                    <div class="media-user me-2">
                                                        
                                                    </div>
                                                    <div class="media-body">
                                                       
                                                    </div>
                                                    <div class="ms-auto">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                
                                                <div class="mt-4">
                                                   
                                                    <h4 class="fw-semibold mt-3">Plan Description</h4>
                                                    <p class="mb-0"><?php echo $all_plan_details[0]['PlanDescription']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer user-pro-2">
                                                <div class="media mt-0">
                                                    <div class="media-user me-2">
                                                        
                                                    </div>
                                                    <div class="media-body">
                                                       
                                                    </div>
                                                    <div class="ms-auto">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                   
                                       
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- COL-END -->
                        </div>
                        <!-- ROW-1 CLOSED -->

                    </div>
                    <!-- CONTAINER CLOSED -->

                </div>
            </div>
            <!--app-content closed-->
        </div>

        

    

</div>
    
 <?php
       include("../navigation/right-side-navigation.php");
        ?>

</div>

<?php
       include("../include/common-script.php");
        ?>
</body>