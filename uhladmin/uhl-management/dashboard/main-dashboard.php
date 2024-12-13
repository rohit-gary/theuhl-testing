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

// print_r($_SESSION);
// die();

    $dbh = new Dbh();
    $Masterconn = $dbh->_connectodb();
    $core = new Core();
    $authentication = new Authentication($conn);
    $userType = $authentication->SessionCheck();

   


    // print_r($UserPolicy);
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
                            <?php if ($userType === 'System Admin' || $userType === 'Admin'): ?>
                                <!-- System Admin / Admin view -->
                                <div class="col-md-6">
                                    <div class="card-box">
                                        <h6>All Users</h6>
                                        <span class="icon">👥</span>
                                        <p class="text-number"><?php echo $dashboard->getTotalUsers(); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-box">
                                        <h6>All Policies</h6>
                                        <span class="icon">📄</span>
                                        <p class="text-number"><?php echo $dashboard->getTotalPolicies(); ?></p>
                                    </div>
                                </div>



                            <?php endif; ?>

                            <?php if ($userType === 'Policy Customer'): 


                                   $policyCustomer_obj=new PolicyCustomer($conn);

                                    $UserPolicy=$policyCustomer_obj->PolicyDetailsByUserID($userID);
                                    $encrypt = new Encryption();
                                    $UserPolicyID=$UserPolicy[0]['ID'];
                                    $Policy_ID = $encrypt->encrypt_message($UserPolicyID);

                                ?>
                                <!-- Policy Customer view -->
                                <div class="col-md-6">
                                    <div class="card-box">
                                        <h6>Remaining Coins</h6>
                                        <span class="icon">💰</span>
                                        <p class="text-number"><?php echo $dashboard->getCoinsLeft(); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-box">
                                        <h6>Download Policy Document</h6>
                                        <button class="btn btn-primary" onclick="downloadPolicy()">Download</button>
                                    </div>
                                </div>
                            <?php endif; ?>

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


                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card bg-primary img-card box-primary-shadow">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="text-white">
                                                <h2 class="mb-0 number-font"><?php echo $dashboard->countDoctors(); ?></h2>
                                                <p class="text-white mb-0">Total Doctors </p>
                                            </div>
                                            <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                        </div>
                        <!-- ROW CLOSED -->
                            <?php endif; ?>




                             <?php if ($userType === 'Channel Partner'): ?>
                                <!-- Client Admin / Channel Partner view -->
    


                                 <!-- ROW OPEN -->
                        <div class="row">
                            
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
                            
                            <!-- COL END -->
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


                           
                            <!-- COL END -->
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
