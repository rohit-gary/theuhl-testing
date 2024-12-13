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
    <title>Doctor Profile</title>
    <?php 
    include("../include/common-head.php");
    include("../include/get-db-connection.php");
    $dbh = new Dbh();
    $masterconn = $dbh->_connectodb();
    $core = new Core();
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();
      $CMUsers=new CMUsers($conn);
      $Doctor=new Doctors($conn);
    if (isset($_GET['DoctorID'])) {
    
    $encodedID = $_GET['DoctorID'];
    $ID = base64_decode($encodedID);

   
    $all_doctor_details = $Doctor->GetDoctorDetailsbyID($ID);
    // print_r($all_doctor_details);
    // die();
}

     $access = false;
    if($UserType == "Client Admin")
    {
        $access = true;
    }
  
    
    ?>


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
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                                                            <div class="profile-cover__action bg-img"style="background-image: url('../project-assets/doctor/test1232457_item.jpg')"></div>
                                                            <div class="profile-cover__img">
                                                                <div class="profile-img-1">
                                                                    <img src="../project-assets/doctor/<?php echo $all_doctor_details[0]['DoctorImage']; ?>" alt="img" style="height:8rem">
                                                                </div>
                                                                <div class="profile-img-content text-dark text-start">
                                                                    <div class="text-dark">
                                                                        <h3 class="h3 mb-2"><?php echo $all_doctor_details[0]['DoctorName']; ?></h3>
                                                                        <h5 class="text-muted"><?php echo $all_doctor_details[0]['Specialization']; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="btn-profile">
                                                                <button class="btn btn-primary mt-1 mb-1"> <i class="fa fa-rss"></i> <span>Follow</span></button>
                                                                <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Message</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="px-0 px-sm-4">
                                                            <div class="social social-profile-buttons mt-5 float-end">
                                                                <div class="mt-3">
                                                                    <a class="social-icon text-primary" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                    <a class="social-icon text-primary" href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                    <a class="social-icon text-primary" href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>
                                                                    <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa fa-rss"></i></a>
                                                                    <a class="social-icon text-primary" href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                                    <a class="social-icon text-primary" href="https://myaccount.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                </div>
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
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="main-profile-contact-list">
                                                    <div class="me-5">
                                                        <div class="media mb-4 d-flex">
                                                            <div class="media-icon bg-secondary bradius me-3 mt-1">
                                                                <i class="fe fe-edit fs-20 text-white"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Patient</span>
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
                                                                <span class="text-muted">Appointment</span>
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
                                                                <span class="text-muted">OPD</span>
                                                                <div class="fw-semibold fs-25">
                                                                    2,876
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">About</div>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <h5>Biography<i class="fe fe-edit-3 text-primary mx-2"></i></h5>
                                                    <p><b>Dr. <?php echo $all_doctor_details[0]['DoctorName']; ?> </b> is a highly skilled in <b><?php echo $all_doctor_details[0]['Specialization']; ?> </b>with extensive experience in <b><?php echo $all_doctor_details[0]['Specialization']; ?> </b>. Known for their compassionate care and dedication, they are committed to providing top-notch medical services and improving patient health.

                                                        <!-- <a href="javascript:void(0)">Read more</a> -->
                                                    </p>
                                                </div>
                                                <hr>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-briefcase fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo $all_doctor_details[0]['Address']; ?></strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-map-pin fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo $all_doctor_details[0]['Address']; ?></strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-phone fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo $all_doctor_details[0]['PhoneNumber']; ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-mail fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo $all_doctor_details[0]['Email']; ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Specialization</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="tags">
                                                    <a href="javascript:void(0)" class="tag">Endocrinologists</a>
                                                    <a href="javascript:void(0)" class="tag">Family Physicians</a>
                                                    <a href="javascript:void(0)" class="tag">Gastroenterologists</a>
                                                    <a href="javascript:void(0)" class="tag">Geriatric Medicine Specialists</a>
                                                    <a href="javascript:void(0)" class="tag">Hematologists</a>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <div class="col-xl-6">
                                        
                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="media mt-0">
                                                        <div class="media-user me-2">
                                                            <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h2 class="fw-semibold mt-1">Academic Qualification</h2>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Qualification</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="media mt-0">
                                                        <div class="media-user me-2">
                                                            <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h2 class="fw-semibold mt-1"> Awards</h2>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Qualification</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="media mt-0">
                                                        <div class="media-user me-2">
                                                            <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h2 class="fw-semibold mt-1">Experiences</h2>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Qualification</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        


                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="media mt-0">
                                                        <div class="media-user me-2">
                                                            <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h2 class="fw-semibold mt-1">Research Activity</h2>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Qualification</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="card border p-0 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="media mt-0">
                                                        <div class="media-user me-2">
                                                            <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h2 class="fw-semibold mt-1">others</h2>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Qualification</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Reviews</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    <div class="media overflow-visible">
                                                       
                                                        <div class="media-body valign-middle mt-2">
                                                           
                                                            <p class="text-muted mb-0">⭐⭐⭐⭐⭐</p>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Language Known</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    <div class="media media-xs overflow-visible">
                                                       
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">HINDI</a>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">ENGLISH</a>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">FRENCH</a>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark"></a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
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