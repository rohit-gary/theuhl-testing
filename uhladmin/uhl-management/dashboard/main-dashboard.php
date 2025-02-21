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
        .card-box {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            background: #f5f5f5;
            padding: 20px;
        }

        .icon {
            font-size: 24px;
            color: #007bff;
        }

        .text-number {
            font-size: 32px;
            font-weight: bold;
        }

        .flip-card {
        perspective: 1000px;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        transform-style: preserve-3d;
        transition: transform 0.6s;
    }

    .flipped .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front,
    .flip-card-back {
        position: absolute;

       
        backface-visibility: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .flip-card-front {
        background: #ffc107; /* Warning color */
    }

    .flip-card-back {
        background: #ffc107;
        transform: rotateY(180deg);
    }

    .eye-icon {
        font-size: 30px;
        color: black;
        cursor: pointer;
    }
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
                            <h1 class="page-title">Welcome-<?php echo htmlspecialchars($userEmail); ?></h1>
                        </div>

                        <!-- Dynamic Dashboard based on User Type -->
                        <div class="row">
                            <?php if ($userType === 'Client Admin'): ?>
                                <!-- Client Admin / Channel Partner view -->
                                <!-- ROW OPEN -->
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-secondary img-card box-secondary-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font"><?php echo $dashboard->countPlan(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">COMPLETE HEALTH PLAN WITH OPD COVER</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-success img-card box-success-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->countPolicyCreatedByMonthlyAll(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">APPLICATION GENERATED THIS MONTH</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-check text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-info img-card box-info-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->countPolicyTodayCreatedByAll(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">TODAY APPLICATION GENERATED</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 d-none">
                                        <div class="card bg-warning img-card box-warning-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-dark">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->GetTotalRevenueBy(); ?>
                                                        </h2>
                                                        <p class="text-dark mb-0">Total PREMIMUM COLLECTED WITH
                                                            SERVICE FEE & GST</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-inr text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                    <div class="flip-card" onclick="flipCard(this)">
                                        <div class="flip-card-inner">
                                            <!-- Default Side (Eye) -->
                                            <div class="card bg-warning img-card box-warning-shadow flip-card-front">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-eye eye-icon"></i>
                                                </div>
                                            </div>

                                            <!-- Flipped Side (Number) -->
                                            <div class="card bg-warning img-card box-warning-shadow flip-card-back">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="text-dark">
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->GetTotalRevenueBy(); ?>
                                                            </h2>
                                                            <p class="text-dark mb-0">Total PREMIUM COLLECTED WITH SERVICE FEE & GST</p>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <i class="fa fa-inr text-white fs-30 me-2 mt-2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function flipCard(card) {
                                        card.classList.toggle("flipped");
                                    }
                                </script>






                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-danger img-card box-danger-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->GetTotalRevenueByMonthly(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">MONTHLY PREMIMUM COLLECTED WITH SERVICE
                                                            FEE & GST</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-inr text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-primary img-card box-primary-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->GetTotalRevenueToday(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">TODAY PREMIMUM COLLECTED WITH
                                                            SERVICE FEE & GST</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-inr text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-info img-card box-info-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->uncompletedPolicyCustomerAll(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">CUSTOMER GENERATED-Onboarding Not
                                                            Completed</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-success img-card box-success-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->submiteDocandPaymentAll(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">PLAN SUBSCRIBERS COUNT


                                                        </p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-check text-white fs-30 me-2 mt-2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-primary img-card box-primary-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo 0 ?>
                                                        </h2>
                                                        <p class="text-white mb-0">
                                                            REFUND AND CANCELLED COUNT</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-inr text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-primary img-card box-primary-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->countChanelPartner(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">Total Chanel Partner </p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- COL END -->

                                    <!-- COL END -->
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card  bg-success img-card box-success-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->countReimbursement(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">Total Reimbursement</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card bg-info img-card box-info-shadow">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="text-white">
                                                        <h2 class="mb-0 number-font">
                                                            <?php echo $dashboard->countDoctors(); ?>
                                                        </h2>
                                                        <p class="text-white mb-0">Total Doctors</p>
                                                    </div>
                                                    <div class="ms-auto"> <i
                                                            class="fa fa-user-md text-white fs-30 me-2 mt-2"></i> </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->countPlan(); ?>
                                                            </h2>
                                                            <p class="text-white mb-0">COMPLETE HEALTH PLAN WITH OPD COVER
                                                            </p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
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
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->countPolicyCreatedByMonthly($userEmail); ?>
                                                            </h2>
                                                            <p class="text-white mb-0">APPLICATION GENERATED THIS MONTH
                                                            </p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-check text-white fs-30 me-2 mt-2"></i>
                                                        </div>
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
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->countPolicyTodayCreatedBy($userEmail); ?>
                                                            </h2>
                                                            <p class="text-white mb-0">TODAY APPLICATION GENERATED</p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i>
                                                        </div>
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
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->GetTotalRevenueByCreatedByMonthly($userEmail);
                                                                ; ?>
                                                            </h2>
                                                            <p class="text-white mb-0">PREMIMUM COLLECTED WITH SERVICE
                                                                FEE & GST</p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-inr text-white fs-30 me-2 mt-2"></i> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card 1: Primary -->
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                            <div class="card bg-primary img-card box-primary-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="text-white">
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->GetTotalRevenueByCreatedByToday($userEmail); ?>
                                                            </h2>
                                                            <p class="text-white mb-0">TODAY PREMIMUM COLLECTED WITH
                                                                SERVICE FEE & GST</p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-inr text-white fs-30 me-2 mt-2"></i> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                            <div class="card bg-info img-card box-info-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="text-white">
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->uncompletedPolicyCustomer($userEmail); ?>
                                                            </h2>
                                                            <p class="text-white mb-0">CUSTOMER GENERATED-Onboarding Not
                                                                Completed</p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                            <div class="card bg-primary img-card box-primary-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="text-white">
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->GetTotalRevenueByCreatedByToday($userEmail); ?>
                                                            </h2>
                                                            <p class="text-white mb-0">
                                                                REFUND AND CANCELLED COUNT</p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-inr text-white fs-30 me-2 mt-2"></i> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                            <div class="card bg-success img-card box-success-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="text-white">
                                                            <h2 class="mb-0 number-font">
                                                                <?php echo $dashboard->submiteDocandPayment($userEmail); ?>
                                                            </h2>
                                                            <p class="text-white mb-0">PLAN SUBSCRIBERS COUNT


                                                            </p>
                                                        </div>
                                                        <div class="ms-auto"> <i
                                                                class="fa fa-check text-white fs-30 me-2 mt-2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!---------- today revenue----------  -->
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