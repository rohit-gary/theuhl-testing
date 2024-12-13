<?php @session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>Dashboard - DWD</title>
    <?php
        @session_start();
        include("../include/common-head.php");
        require_once('../include/autoloader.inc.php');
        $dbh = new Dbh();
        $conn = $dbh->_connectodb();
        $authentication = new Authentication($conn);
        $UserType = $authentication->SessionCheck();
        $dashboard = new Dashboard($conn);
        if($UserType == "System Admin")
        {
            $stats_array = $dashboard->GetAdminDashboardStats();
        }
        $navigation = new Navigation();
        $navigation->setNavigation($_SESSION['dwd_UserType']);
    ?>

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
                        <div class="page-header">
                            <!-- <h1 class="page-title">DigitalWorkDesk Dashboard</h1> -->
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DigitalWorkDesk Dashboard</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <?php 
                        if($navigation->_Nav_Dashboard_Lead)
                        {
                        ?>

                        <!-- ROW-1 -->
                        <h2 class="page-title text-primary"> Dashboard</h2>
                        <div class="row mt-5">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Users</h6>
                                                        <h2 class="mb-0 number-font"><?php echo $stats_array['TotalUser']; ?></h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <canvas id="saleschart"
                                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--span class="text-muted fs-12"><span class="text-secondary"><i
                                                            class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>
                                                    Last week</span-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Modules</h6>
                                                        <h2 class="mb-0 number-font"><?php echo $stats_array['TotalModules']; ?></h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <canvas id="saleschart"
                                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--span class="text-muted fs-12"><span class="text-secondary"><i
                                                            class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>
                                                    Last week</span-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Organization</h6>
                                                        <h2 class="mb-0 number-font"><?php echo $stats_array['TotalOrganization']; ?></h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <canvas id="saleschart"
                                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--span class="text-muted fs-12"><span class="text-secondary"><i
                                                            class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>
                                                    Last week</span-->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->
                        

                        <?php
                        }
                        ?>


                        <!-- ROW-2 -->
                        <!--div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Sales Analytics</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex mx-auto text-center justify-content-center mb-4">
                                            <div class="d-flex text-center justify-content-center me-3"><span
                                                    class="dot-label bg-primary my-auto"></span>Total Admission</div>
                                            <div class="d-flex text-center justify-content-center"><span
                                                    class="dot-label bg-secondary my-auto"></span>Total Fees</div>
                                        </div>
                                        <div class="chartjs-wrapper-demo">
                                            <canvas id="transactions" class="chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> -->
                        <!-- ROW-2 END -->

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
        $("#dasboard").addClass("open");
        $("#dasboard").addClass("active");

        </script>
</body>

</html>