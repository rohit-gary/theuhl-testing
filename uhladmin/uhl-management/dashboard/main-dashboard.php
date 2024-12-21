<?php @session_start();
require_once('../include/autoloader.inc.php');
include("../include/common-head.php");
include("../include/get-db-connection.php");

$PolicyCustomer = new PolicyCustomer($conn); 
$conf = new Conf();

$userType = $_SESSION['dwd_UserType'] ?? '';
$userID = $_SESSION['dwd_UserID'] ?? '';
// print_r($_SESSION);
// die();
$userEmail = $_SESSION['dwd_email'] ?? '';
$userRole = $_SESSION['roles'][0]['Role'] ?? '';


// die();

    $dbh = new Dbh();
    $Masterconn = $dbh->_connectodb();
    $core = new Core();
    $authentication = new Authentication($conn);
    $userType = $authentication->SessionCheck();

   


    // print_r($userType);
    // die();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Health Plan Dashboard">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <title>Dashboard - United Health Lumina</title>
    <?php
        include("../include/common-head.php");
        require_once('../include/autoloader.inc.php');
        include("../include/get-db-connection.php");
        $dashboard = new Clientdashboard($conn);
    ?>

    <style>
        .card-box { padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .dashboard-card { max-width: 800px; margin: 0 auto; text-align: center; background: #f5f5f5; padding: 20px; }
        .icon { font-size: 24px; color: #007bff; }
        .text-number { font-size: 32px; font-weight: bold; }
    </style>
</head>

<body class="app sidebar-mini ltr light-mode">
    <div class="page">
        <div class="page-main">
            <?php include("../navigation/top-header.php"); ?>
            <?php include("../navigation/side-navigation.php"); ?>

            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        <div class="page-header">
                            <!-- <h1 class="page-title">Dashboard - <?php echo htmlspecialchars($userType); ?></h1> -->
                        </div>

                        <!-- Dynamic Dashboard based on User Type -->
                        <div class="row">
                            <?php if ($userType === 'Client Admin'): ?>
                                <!-- Client Admin / Channel Partner view -->
                                 <!-- ROW OPEN -->
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-primary img-card box-primary-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countChanelPartner(); ?></h2>
                                                <p class="text-white mb-0">Total Chanel Partner </p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-secondary img-card box-secondary-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPlan(); ?></h2>
                                                <p class="text-white mb-0">Total Plans</p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card  bg-success img-card box-success-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countReimbursement(); ?></h2>
                                                <p class="text-white mb-0">Total Reimbursement</p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-info img-card box-info-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPolicyCustomer(); ?></h2>
                                                <p class="text-white mb-0">Total Policy Customer</p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                          


                            <!-------------------- total policy revenue--------- -->

                              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-primary img-card box-primary-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font"><?php echo $dashboard->GetTotalRevenueToday(); ?></h2>
                                                        <p class="text-white mb-0">Today Policy Revenue</p>
                                                    </div>
                                                    <div class="ms-auto">  <i class="fa fa-inr text-white fs-30 me-2 mt-2"></i>  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                          
                             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-warning img-card box-warning-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-dark">
                                                  <h2 class="mb-0 number-font"><?php echo $dashboard->GetTotalRevenueBy(); ?></h2>
                                                        <p class="text-dark mb-0">Total Revenue</p>
                                                    </div>
                                                    <div class="ms-auto">  <i class="fa fa-inr text-white fs-30 me-2 mt-2"></i>  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-danger img-card box-danger-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font"><?php echo  $dashboard->GetTotalRevenueByMonthly();?></h2>
                                                        <p class="text-white mb-0">Monthly Policy Revenue</p>
                                                    </div>
                                                    <div class="ms-auto"> <i class="fa fa-inr text-white fs-30 me-2 mt-2"></i>  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-info img-card box-info-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font"><?php echo $dashboard->countDoctors(); ?></h2>
                                                        <p class="text-white mb-0">Total Doctors</p>
                                                    </div>
                                                    <div class="ms-auto"> <i class="fa fa-user-md text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                              <!---------- today revenue----------  -->
                               <div class="row">
                                    <!-- Card 1: Primary -->
                                  
                                      <!-- -----------today policycustomer---------------- -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-info img-card box-info-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPolicyTodayCreatedBy($userEmail); ?></h2>
                                                <p class="text-white mb-0">Today Policy Customer</p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <!-- Card 2: Success -->
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-success img-card box-success-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPolicyCreatedByMonthly($userEmail); ?></h2>
                                                        <p class="text-white mb-0">Monthly Policy Customer</p>
                                                    </div>
                                                    <div class="ms-auto"> <i class="fa fa-check text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 3: Danger -->
                                   
                                    <!-- Card 4: Warning -->
                                    <!-- ----All Customer------- -->
                                    

                                    <!-- Card 5: Info -->
                                   
                            <!-- COL END -->
                        </div>
                        <!-- ROW CLOSED -->
                            <?php endif; ?>

                            <!-- ----------------dashboard for sales persons---------------- -->

                        <?php if ($userRole === 'Sales Man' || $userType === 'Channel Partner'): ?>
                        <!-- Client Admin / Channel Partner view -->
                         <!-- ROW OPEN -->
                        <div class="row">

                            <!--------total plans----------- -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-secondary img-card box-secondary-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPlan(); ?></h2>
                                                <p class="text-white mb-0">Total Plans</p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ---total policy customer--------------- -->
         
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-info img-card box-info-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPolicyCreatedBy($userEmail); ?></h2>
                                                <p class="text-white mb-0">Total Policy Customer</p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- -----------today policycustomer---------------- -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-info img-card box-info-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPolicyTodayCreatedBy($userEmail); ?></h2>
                                                <p class="text-white mb-0">Today Policy Customer</p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-------------------- total policy revenue--------- -->
                          
                             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-warning img-card box-warning-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-dark">
                                                  <h2 class="mb-0 number-font"><?php echo $dashboard->GetTotalRevenueByCreatedBy($userEmail); ?></h2>
                                                        <p class="text-dark mb-0">Total Revenue</p>
                                                    </div>
                                                    <div class="ms-auto">  <i class="fa fa-inr text-white fs-30 me-2 mt-2"></i>  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                              <!---------- today revenue----------  -->
                               <div class="row">
                                    <!-- Card 1: Primary -->
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-primary img-card box-primary-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font"><?php echo $dashboard->GetTotalRevenueByCreatedByToday($userEmail); ?></h2>
                                                        <p class="text-white mb-0">Today Policy Revenue</p>
                                                    </div>
                                                    <div class="ms-auto">  <i class="fa fa-inr text-white fs-30 me-2 mt-2"></i>  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 2: Success -->
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-success img-card box-success-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countPolicyCreatedByMonthly($userEmail); ?></h2>
                                                        <p class="text-white mb-0">Monthly Policy Customer</p>
                                                    </div>
                                                    <div class="ms-auto"> <i class="fa fa-check text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 3: Danger -->
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-danger img-card box-danger-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font"><?php echo  $dashboard->GetTotalRevenueByCreatedByMonthly($userEmail);; ?></h2>
                                                        <p class="text-white mb-0">Monthly Policy Revenue</p>
                                                    </div>
                                                    <div class="ms-auto"> <i class="fa fa-inr text-white fs-30 me-2 mt-2"></i>  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 4: Warning -->
                                    <!-- ----All Customer------- -->
                                    

                                    <!-- Card 5: Info -->
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-info img-card box-info-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font"><?php echo $dashboard->countDoctors(); ?></h2>
                                                        <p class="text-white mb-0">Total Doctors</p>
                                                    </div>
                                                    <div class="ms-auto"> <i class="fa fa-user-md text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 6: Secondary -->
                                   
                                </div>
                           
                        </div>
                        <!-- ROW CLOSED -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../navigation/right-side-navigation.php"); ?>
        </div>
        <?php include("../include/common-script.php"); ?>
        <script>
            const Id = "<?php echo $Policy_ID; ?>";
            function downloadPolicy() {
               alertify.confirm(
        "Do you really want to download the Policy Customer Doc?",
        function () {
            $.post(
                "../PolicyCustomer/include/create-policy-doc.php",
                {
                    Id: Id,
                },
                function (data, status) {
                  
                    alertify.success("Document is being prepared for download.");

                    
                    setTimeout(function () {
                        window.open('../PolicyCustomer/include/create-policy-doc.php?Id=' + Id, '_blank');
                    }, 1000); 
                }
            ).fail(function (xhr, status, error) {
                
                alertify.error("An error occurred while preparing the document.");
            });
        },
        function () {
            alertify.error("Cancelled");
        }
    );
            }
        </script>
    </div>
</body>
</html>
