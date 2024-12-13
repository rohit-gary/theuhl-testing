<?php @session_start();
require_once "../include/autoloader.inc.php";
include "../include/common-head.php";
include "../include/get-db-connection.php";

$PolicyCustomer = new PolicyCustomer($conn);
$conf = new Conf();

$userType = $_SESSION["dwd_UserType"] ?? "";
$userID = $_SESSION["dwd_UserID"] ?? "";
// print_r($_SESSION);
// die();
$userEmail = $_SESSION["dwd_email"] ?? "";

// print_r($_SESSION);
// die();

$dbh = new Dbh();
$Masterconn = $dbh->_connectodb();
$core = new Core();
$authentication = new Authentication($conn);
$userType = $authentication->SessionCheck();

// print_r($_SESSION);
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
    include "../include/common-head.php";
    require_once "../include/autoloader.inc.php";
    include "../include/get-db-connection.php";
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
            <?php include "../navigation/top-header.php"; ?>
            <?php include "../navigation/side-navigation.php"; ?>

            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        <div class="page-header">
                            
                        </div>

                        <!-- Dynamic Dashboard based on User Type -->
                        <div class="row">
                            <?php if ($userType === "Policy Customer"):

                                $policyCustomer_obj = new PolicyCustomer($conn);

                                $UserPolicy = $policyCustomer_obj->PolicyDetailsByUserID(
                                    $userID
                                );
                                $encrypt = new Encryption();
                                $UserPolicyID = $UserPolicy[0]["ID"];
                                $Policy_ID = $encrypt->encrypt_message(
                                    $UserPolicyID
                                );
                                  
                                  // print_r($UserPolicy);
                                  // die();

                                ?>
                                <!-- Policy Customer view -->
                               <div class="row d-flex">
                          <!-- First Card -->
                                <div class="col-md-7 d-flex">
                                    <div class="card-box p-4 w-100" style="background-color: #ffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        <div class="row">
                                            <!-- Content on the left side -->
                                            <div class="col-md-7">
                                                <h1 style="font-family: 'Poppins', sans-serif; font-size: 28px; color: #333;">Hi,<?php echo $UserPolicy[0]["Name"]  ?></h1>
                                                <h5 style="color: #555;">What do you want Today?</h5>
                                                <div class="row my-4">
                                                    <div class="col-md-6 mb-3">
                                                        <a href="../reimbursement/view-all-reimbursement" class="d-flex align-items-center text-decoration-none">
                                                            <i class="fe fe-plus" style="font-size: 20px; color: #4CAF50; margin-right: 10px;"></i>
                                                            <p class="mb-0 text-muted">Raise Reimbursement</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <a href="https://unitedhealthlumina.com/uhl/contact-us" class="d-flex align-items-center text-decoration-none">
                                                            <i class="fe fe-phone-call" style="font-size: 20px; color: #007BFF; margin-right: 10px;"></i>
                                                            <p class="mb-0 text-muted">Contact Us</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <a href="https://unitedhealthlumina.com/uhl/all-plans" class="d-flex align-items-center text-decoration-none">
                                                            <i class="fe fe-calendar" style="font-size: 20px; color: #FF9800; margin-right: 10px;"></i>
                                                            <p class="mb-0 text-muted">Check More Plans</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <a href="https://unitedhealthlumina.com/uhl/contact-us" class="d-flex align-items-center text-decoration-none">
                                                            <i class="fe fe-map-pin" style="font-size: 20px; color: #9C27B0; margin-right: 10px;"></i>
                                                            <p class="mb-0 text-muted">Find Our Office</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 d-flex align-items-center justify-content-center">
                                                <img src="../project-assets/images/yoga-2.jpg" alt="UnitedHealth-Yoga" class="img-fluid" style="border-radius: 8px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Card -->
                                <div class="col-md-5 d-flex my-2">
                                    <div class="card-box w-100" style="background-color: #ffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        <p>Updates</p>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <a href="../reimbursement/view-all-reimbursement" class="d-flex align-items-center text-decoration-none">
                                                    <i class="fe fe-plus" style="font-size: 20px; color: #4CAF50; margin-right: 10px;"></i>
                                                    <h5 class="mb-0 text-muted">Raise New Reimbursement</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <a href="#" class="d-flex align-items-center text-decoration-none">
                                                    <i class="fe fe-search" style="font-size: 20px; color: #FF9800; margin-right: 10px;"></i>
                                                    <h5 class="mb-0 text-muted">Track Reimbursement</h5>
                                                </a>
                                            </div>
                                           
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <a href="#" class="d-flex align-items-center text-decoration-none" onclick="downloadPolicy()">
                                                <i class="fe fe-download" style="font-size: 20px; color: #4CAF50; margin-right: 10px;"></i>
                                                <h5 class="mb-0 text-muted">Download Policy Doc</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            endif; ?>
                        </div>

                            <div class="row my-7">
                            <?php if ($userType === "Policy Customer"): 
                                $plans_obj = new Plans($conn);
                                $AllPlans = $plans_obj->GetAllPlan(); ?>

                                <!-- Check if plans are available -->
                                <?php if (!empty($AllPlans)): ?>
                                    <!-- Policy Customer view -->
                                    <div id="plansCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php 
                                            // Split the plans into groups of 3
                                            $planChunks = array_chunk($AllPlans, 3); // This will create arrays of 3 plans each
                                            foreach ($planChunks as $index => $plansChunk): ?>
                                                <!-- Each carousel item (group of 3 plans) -->
                                                <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                                                    <div class="row d-flex justify-content-center">
                                                        <?php foreach ($plansChunk as $plan): ?>
                                                            <div class="col-md-4 mb-3">
                                                                <!-- Card with image and details -->
                                                                <div class="card-box p-4 w-100" style="background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); cursor: pointer;">
                                                                    <div class="row">
                                                                        <!-- Image Section (Left side of the card) -->
                                                                        <div class="col-md-5">
                                                                            <img src="<?php echo $plan['PlanImage']; ?>" alt="Plan Image" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                                                                        </div>
                                                                        <!-- Details Section (Right side of the card) -->
                                                                        <div class="col-md-7">
                                                                            <h5 style="color: #333;"><?php echo htmlspecialchars($plan['PlanName']); ?></h5>
                                                                            <p class="mb-1 text-muted"><strong>Cost:</strong> ₹<?php echo number_format($plan['PlanCost'], 2); ?></p>                                                    
                                                                            <a href="https://unitedhealthlumina.com/uhl/all-plans" class="btn btn-primary mt-2">View Details</a>
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <!-- Carousel Controls -->
                                       <!--  <button class="carousel-control-prev" type="button" data-bs-target="#plansCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#plansCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button> -->
                                    </div>
                                <?php else: ?>
                                    <p>No plans available.</p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="row"> 
                           <img src="../project-assets/images/policydshimg-3.png">
                        </div>


                    </div>
                </div>
            </div>
            <?php include "../navigation/right-side-navigation.php"; ?>
        </div>
        <?php include "../include/common-script.php"; ?>
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
