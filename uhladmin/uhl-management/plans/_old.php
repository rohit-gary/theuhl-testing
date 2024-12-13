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
                                                            <div class="profile-cover__action bg-img"></div>
                                                            <div class="profile-cover__img">
                                                                <div class="profile-img-1">
                                                                    <img src="../assets/images/users/21.jpg" alt="img">
                                                                </div>
                                                                <div class="profile-img-content text-dark text-start">
                                                                    <div class="text-dark">
                                                                        <h3 class="h3 mb-2">Percy Kewshun</h3>
                                                                        <h5 class="text-muted">Web Developer</h5>
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
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">About</div>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <h5>Biography<i class="fe fe-edit-3 text-primary mx-2"></i></h5>
                                                    <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.
                                                        <a href="javascript:void(0)">Read more</a>
                                                    </p>
                                                </div>
                                                <hr>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-briefcase fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>San Francisco, CA </strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-map-pin fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>Francisco, USA</strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-phone fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>+125 254 3562 </strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-mail fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>georgeme@abc.com </strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
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
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Work & Education</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="main-profile-contact-list">
                                                    <div class="me-5">
                                                        <div class="media mb-4 d-flex">
                                                            <div class="media-icon bg-primary  mb-3 mb-sm-0 me-3 mt-1">
                                                                <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                                    <path fill="#fff" d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3M18.82 9L12 12.72L5.18 9L12 5.28L18.82 9M17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" />
                                                                </svg>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="font-weight-semibold mb-1">Web Designer at <a href="javascript:void(0)" class="btn-link">Spruko</a></h6>
                                                                <span>2018 - present</span>
                                                                <p>Past Work: Spruko, Inc.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="me-5 mt-5 mt-md-0">
                                                        <div class="media mb-4 d-flex">
                                                            <div class="media-icon bg-success text-white mb-3 mb-sm-0 me-3 mt-1">
                                                                <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                                    <path fill="currentColor" d="M20,6C20.58,6 21.05,6.2 21.42,6.59C21.8,7 22,7.45 22,8V19C22,19.55 21.8,20 21.42,20.41C21.05,20.8 20.58,21 20,21H4C3.42,21 2.95,20.8 2.58,20.41C2.2,20 2,19.55 2,19V8C2,7.45 2.2,7 2.58,6.59C2.95,6.2 3.42,6 4,6H8V4C8,3.42 8.2,2.95 8.58,2.58C8.95,2.2 9.42,2 10,2H14C14.58,2 15.05,2.2 15.42,2.58C15.8,2.95 16,3.42 16,4V6H20M4,8V19H20V8H4M14,6V4H10V6H14M12,9A2.25,2.25 0 0,1 14.25,11.25C14.25,12.5 13.24,13.5 12,13.5A2.25,2.25 0 0,1 9.75,11.25C9.75,10 10.76,9 12,9M16.5,18H7.5V16.88C7.5,15.63 9.5,14.63 12,14.63C14.5,14.63 16.5,15.63 16.5,16.88V18Z" />
                                                                </svg>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="font-weight-semibold mb-1">Studied at <a href="javascript:void(0)" class="btn-link">University</a></h6>
                                                                <span>2004-2008</span>
                                                                <p>Graduation: Bachelor of Science in Computer Science</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="profile-edit">
                                                    <textarea class="form-control" placeholder="What's in your mind right now" rows="7"></textarea>
                                                    <div class="profile-share border-top-0">
                                                        <div class="mt-2">
                                                            <a href="javascript:void(0)" class="me-2" title="Audio" data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i class="fe fe-mic"></i></span></a>
                                                            <a href="javascript:void(0)" class="me-2" title="Video" data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i class="fe fe-video"></i></span></a>
                                                            <a href="javascript:void(0)" class="me-2" title="Image" data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i class="fe fe-image"></i></span></a>
                                                        </div>
                                                        <button class="btn btn-sm btn-success ms-auto"><i class="fa fa-share ms-1"></i> Share</button>
                                                    </div>
                                                </form>
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
                                                            <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                            <small class="text-muted">just now</small>
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                                <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                                <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
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
                                            <div class="card-footer user-pro-2">
                                                <div class="media mt-0">
                                                    <div class="media-user me-2">
                                                        <div class="avatar-list avatar-list-stacked">
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                                            <span class="avatar brround text-primary">+28</span>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="d-flex mt-1">
                                                            <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                            <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                            <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                                        </div>
                                                    </div>
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
                                                            <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                            <small class="text-muted">Sep 26 2019, 10:14am</small>
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                                <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                                <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="d-flex">
                                                        <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/22.jpg" alt="img" class="br-5"></a>
                                                        <a href="gallery.html" class="w-30 m-2"><img src="../assets/images//media/24.jpg" alt="img" class="br-5"></a>
                                                    </div>
                                                    <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer user-pro-2">
                                                <div class="media mt-0">
                                                    <div class="media-user me-2">
                                                        <div class="avatar-list avatar-list-stacked">
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                                            <span class="avatar brround text-primary">+28</span>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="d-flex mt-1">
                                                            <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                            <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                            <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                                        </div>
                                                    </div>
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
                                                            <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                            <small class="text-muted">Sep 24 2019, 09:14am</small>
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="dropdown show">
                                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                                <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                                <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="d-flex">
                                                        <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/26.jpg" alt="img" class="br-5"></a>
                                                        <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/23.jpg" alt="img" class="br-5"></a>
                                                        <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/21.jpg" alt="img" class="br-5"></a>
                                                    </div>
                                                    <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer user-pro-2">
                                                <div class="media mt-0">
                                                    <div class="media-user me-2">
                                                        <div class="avatar-list avatar-list-stacked">
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                            <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                                            <span class="avatar brround text-primary">+28</span>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="d-flex mt-1">
                                                            <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                            <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                            <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Followers</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    <div class="media overflow-visible">
                                                        <img class="avatar brround avatar-md me-3" src="../assets/images/users/18.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle mt-2">
                                                            <a href="javascript:void(0)" class=" fw-semibold text-dark">John Paige</a>
                                                            <p class="text-muted mb-0">johan@gmail.com</p>
                                                        </div>
                                                        <div class="media-body valign-middle text-end overflow-visible mt-2">
                                                            <button class="btn btn-sm btn-primary" type="button">Follow</button>
                                                        </div>
                                                    </div>
                                                    <div class="media overflow-visible mt-sm-5">
                                                        <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                                        <div class="media-body valign-middle mt-2">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">Lillian Quinn</a>
                                                            <p class="text-muted mb-0">lilliangore</p>
                                                        </div>
                                                        <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                            <button class="btn btn-sm btn-secondary" type="button">Follow</button>
                                                        </div>
                                                    </div>
                                                    <div class="media overflow-visible mt-sm-5">
                                                        <img class="avatar brround avatar-md me-3" src="../assets/images/users/2.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle mt-2">
                                                            <a href="javascript:void(0)" class="text-dark fw-semibold">Harry Fisher</a>
                                                            <p class="text-muted mb-0">harryuqt</p>
                                                        </div>
                                                        <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                            <button class="btn btn-sm btn-danger" type="button">Follow</button>
                                                        </div>
                                                    </div>
                                                    <div class="media overflow-visible mt-sm-5">
                                                        <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                                        <div class="media-body valign-middle mt-2">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                            <p class="text-muted mb-0">harris@gmail.com</p>
                                                        </div>
                                                        <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                            <button class="btn btn-sm btn-success" type="button">Follow</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Our Latest News</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    <div class="media media-xs overflow-visible">
                                                        <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/12.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">John Paige</a>
                                                            <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/2.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">Peter Hill</a>
                                                            <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/9.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                            <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/4.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">Harry Fisher</a>
                                                            <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Friends</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="user-pro-1">
                                                    <div class="media media-xs overflow-visible">
                                                        <img class="avatar brround avatar-md me-3" src="../assets/images/users/18.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle">
                                                            <a href="javascript:void(0)" class=" fw-semibold text-dark">John Paige</a>
                                                            <p class="text-muted mb-0">Web Designer</p>
                                                        </div>
                                                        <div class="">
                                                            <div class="social social-profile-buttons float-end">
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                                        <div class="media-body valign-middle mt-0">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">Lillian Quinn</a>
                                                            <p class="text-muted mb-0">Web Designer</p>
                                                        </div>
                                                        <div class="">
                                                            <div class="social social-profile-buttons float-end">
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        <img class="avatar brround avatar-md me-3" src="../assets/images/users/2.jpg" alt="avatar-img">
                                                        <div class="media-body valign-middle mt-0">
                                                            <a href="javascript:void(0)" class="text-dark fw-semibold">Harry Fisher</a>
                                                            <p class="text-muted mb-0">Web Designer</p>
                                                        </div>
                                                        <div class="">
                                                            <div class="social social-profile-buttons float-end">
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media media-xs overflow-visible mt-5">
                                                        <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                                        <div class="media-body valign-middle mt-0">
                                                            <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                            <p class="text-muted mb-0">Web Designer</p>
                                                        </div>
                                                        <div class="">
                                                            <div class="social social-profile-buttons float-end">
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                                <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                            </div>
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

        <!-- Sidebar-right -->
        <div class="sidebar sidebar-right sidebar-animate">
            <div class="panel panel-primary card mb-0 shadow-none border-0">
                <div class="tab-menu-heading border-0 d-flex p-3">
                    <div class="card-title mb-0"><i class="fe fe-bell me-2"></i><span
                            class=" pulse"></span>Notifications</div>
                    <div class="card-options ms-auto">
                        <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                            data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i
                                class="fe fe-x text-white"></i></a>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                    <div class="tabs-menu border-bottom">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#sidebar-side1" class="active" data-bs-toggle="tab"><i
                                        class="fe fe-settings me-1"></i>Feeds</a></li>
                            <li><a href="#sidebar-side2" data-bs-toggle="tab"><i class="fe fe-message-circle me-1"></i> Chat</a></li>
                            <li><a href="#sidebar-side3" data-bs-toggle="tab"><i class="fe fe-anchor me-1"></i>Timeline</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sidebar-side1">
                            <div class="p-3 fw-semibold ps-5">Feeds</div>
                            <div class="card-body pt-2">
                                <div class="browser-stats">
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle brround bg-primary-transparent"><i
                                                    class="fe fe-user text-primary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New user registered</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i
                                                    class="fe fe-shopping-cart text-secondary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New order delivered</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-bell text-danger"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">You have pending tasks</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i
                                                    class="fe fe-gitlab text-warning"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New version arrived</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i
                                                    class="fe fe-database text-pink"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Server #1 overloaded</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-info brround bg-info-transparent"><i
                                                    class="fe fe-check-circle text-info"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New project launched</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 fw-semibold ps-5">Settings</div>
                            <div class="card-body pt-2">
                                <div class="browser-stats">
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle brround bg-primary-transparent"><i
                                                    class="fe fe-settings text-primary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">General Settings</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i
                                                    class="fe fe-map-pin text-secondary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Map Settings</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-headphones text-danger"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Support Settings</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i
                                                    class="fe fe-credit-card text-warning"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Payment Settings</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span
                                                class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i
                                                    class="fe fe-bell text-pink"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Notification Settings</h6>
                                                <div>
                                                    <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="sidebar-side2">
                            <div class="list-group list-group-flush">
                                <div class="pt-3 fw-semibold ps-5">Today</div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/2.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Addie Minstra</div>
                                            <p class="mb-0 fs-12 text-muted"> Hey! there I' am available.... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/11.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Rose Bush</div>
                                            <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/10.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Claude Strophobia</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                            </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/13.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Eileen Dover</div>
                                            <p class="mb-0 fs-12 text-muted"> New product Launching... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/12.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Willie Findit</div>
                                            <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/15.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Manny Jah</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                            </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/4.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Cherry Blossom</div>
                                            <p class="mb-0 fs-12 text-muted"> Hey! there I' am available....</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="pt-3 fw-semibold ps-5">Yesterday</div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/7.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Simon Sais</div>
                                            <p class="mb-0 fs-12 text-muted">Schedule Realease...... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/9.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Laura Biding</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                            </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/2.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Addie Minstra</div>
                                            <p class="mb-0 fs-12 text-muted">Contact me for details....</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/9.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Ivan Notheridiya</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                            </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/14.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Dulcie Veeta</div>
                                            <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/11.jpg"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Florinda Carasco</div>
                                            <p class="mb-0 fs-12 text-muted">New product Launching...</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image"
                                            data-bs-image-src="../assets/images/users/4.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                                data-target="#chatmodel">Cherry Blossom</div>
                                            <p class="mb-0 fs-12 text-muted">cherryblossom@gmail.com</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="sidebar-side3">
                            <ul class="task-list timeline-task">
                                <li class="d-sm-flex mt-4">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Finished<span
                                                class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span></h6>
                                        <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                                class="fw-semibold"> Project Management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">New Comment<span
                                                class="text-muted fs-11 mx-2 fw-normal">05 July 2021</span></h6>
                                        <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                                class="fw-semibold"> AngularJS Template</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">New Comment<span
                                                class="text-muted fs-11 mx-2 fw-normal">25 June 2021</span></h6>
                                        <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                                class="fw-semibold"> AngularJS Template</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Overdue<span
                                                class="text-muted fs-11 mx-2 fw-normal">14 June 2021</span></h6>
                                        <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="javascript:void(0)"
                                                class="fw-semibold"> Integrated management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Overdue<span
                                                class="text-muted fs-11 mx-2 fw-normal">29 June 2021</span></h6>
                                        <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="javascript:void(0)"
                                                class="fw-semibold"> Integrated management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Finished<span
                                                class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span></h6>
                                        <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                                class="fw-semibold"> Project Management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="javascript:void(0)" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="javascript:void(0)" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->
        <div class="modal fade" id="country-selector">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content country-select-modal">
                    <div class="modal-header">
                        <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="row p-3">
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags-img/us_flag.jpg"
                                            class="me-3 language"></span>USA
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/italy_flag.jpg"
                                        class="me-3 language"></span>Italy
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/spain_flag.jpg"
                                        class="me-3 language"></span>Spain
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/india_flag.jpg"
                                        class="me-3 language"></span>India
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/french_flag.jpg"
                                        class="me-3 language"></span>French
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/russia_flag.jpg"
                                        class="me-3 language"></span>Russia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/germany_flag.jpg"
                                        class="me-3 language"></span>Germany
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="../assets/images/flags-img/argentina.jpg"
                                        class="me-3 language"></span>Argentina
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags-img/malaysia.jpg"
                                        class="me-3 language"></span>Malaysia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="../assets/images/flags-img/turkey.jpg"
                                        class="me-3 language"></span>Turkey
                                </a>
                            </li>
                        </ul>
                    </div>
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
</body>