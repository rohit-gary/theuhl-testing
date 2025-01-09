<?php
// Determine the protocol (HTTP or HTTPS)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

// Get the base URL dynamically
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/Projects/theuhl-testing';
?>

<header class="site-header mo-left header">
    <!-- <div class="top-bar">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="dlab-topbar-left">
                    <ul>
                        <li><a href="javascript:void(0);">About Us</a></li>
                        <li><a href="javascript:void(0);">Refund Policy</a></li>
                        <li><a href="javascript:void(0);">Help Desk</a></li>
                    </ul>
                </div>
                <div class="dlab-topbar-right">
                    <a href="javascript:void(0);" class="site-button radius-no">GET A QUOTE</a>						
                </div>
            </div>
        </div>
    </div> -->
    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container clearfix">
                <!-- website logo -->
                <div class="logo-header mostion">
                    <a href="<?php echo $base_url; ?>/index"><img src="<?php echo $base_url; ?>/project-assets/images/uhlnewlogo.png" alt="" ></a>
                </div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <a href="<?php echo $base_url; ?>/uhladmin/admin/authentication/login" id="login-btn" class="site-button appointment-btn btnhover13" target="_blank">Login Here</a>
                    </div>
                </div>
                <!-- Quik search -->
                <div class="dlab-quik-search">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                        <span id="quik-search-remove"><i class="ti-close"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <div class="logo-header d-md-block d-lg-none">
                        <a href="<?php echo $base_url; ?>/index"><img src="<?php echo $base_url; ?>/project-assets/images/uhlnewlogo.png" alt=""></a>
                    </div>
                    <ul class="nav navbar-nav align-items-center">
                        <li class=""><a href="<?php echo $base_url; ?>/index">Home</a></li>
                        <li><a href="<?php echo $base_url; ?>/about-us">About us <i class="fas fa-chevron-down"></i></a></li>
                        <li><a href="<?php echo $base_url; ?>/all-plans">Our Health Plans<i class="fas fa-chevron-down"></i></a></li>
                        <li><a href="<?php echo $base_url; ?>/blogs">Blog<i class="fas fa-chevron-down"></i></a></li>
                        <li><a href="<?php echo $base_url; ?>/faqs">FAQ'S<i class="fas fa-chevron-down"></i></a></li>
                        <li><a href="<?php echo $base_url; ?>/contact-us">Contact Us<i class="fas fa-chevron-down"></i></a></li>
                        <li class="">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#disclaimerModal">
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-exclamation-circle me-1"></i>Disclaimer
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>

<!-- Bootstrap 5 Modal for Disclaimer -->
<div class="modal fade mt-4" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#85b94e">
                <h5 class="modal-title" id="disclaimerModalLabel">Disclaimer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color:#fff"></button>
            </div>
            <div class="modal-body">
                <p>
                    Insurance products are obligations only of the Insurance company. They are not under any obligations of or guaranteed by united health lumina Private Limited ("unitedhealthlumina.com") or any of its affiliates or subsidiaries or any Governmental agency. unitedhealthlumina.com, any of their affiliates and group entities are not insurance companies, dealers, brokers, sub-dealers, sub-brokers, distributors, or agents. United Health Lumina does not sell, distribute, or solicit any type of insurance on any platform branded under "United Health Lumina Private Limited."
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
