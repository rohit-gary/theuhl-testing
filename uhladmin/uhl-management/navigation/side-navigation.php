  <!--APP-SIDEBAR-->
  <?php
  $navigation = new Navigation();
  $navigation->setNavigation($_SESSION["roles"]);

  if (
      isset($_SESSION["dwd_UserType"]) &&
      $_SESSION["dwd_UserType"] === "Policy Customer"
  ) {
      include "../include/common-head.php";
      require_once "../include/autoloader.inc.php";
      include "../include/get-db-connection.php";
      $UserID = $_SESSION["dwd_UserID"];

      $PolicyDetails_obj = new PolicyCustomer($conn);
      $PolicyDetailss = $PolicyDetails_obj->PolicyDetailsByUserID($UserID);
      // print_r($PolicyDetailss);
      // die();
      $PolicyDetails = $PolicyDetailss[0];
      if (!empty($PolicyDetails) && isset($PolicyDetails["ID"])) {
          $encrypt = new Encryption();
          $Policy_ID = $encrypt->encrypt_message($PolicyDetails["ID"]);
      }
  }
  ?>
  <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="https://unitedhealthlumina.com/uhladmin/uhl-management/dashboard/main-dashboard">
                            <img src="../project-assets/images/logo-green.png" class="header-brand-img desktop-logo" alt="logo">
                            <!-- <img src="https://www.jll.co.in/content/dam/jll-com/technical-resources/favicon/favicon-32x32.png" class="header-brand-img toggle-logo"
                                alt="logo">
                            <img src="https://www.jll.co.in/content/dam/jll-com/technical-resources/favicon/favicon-32x32.png" class="header-brand-img light-logo" alt="logo"> -->
                            <img src="../project-assets/images/logo-green.png" class="header-brand-img light-logo1" alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu" style="overflow: auto; max-height: 100%;">
                        <div class="slide-left disabled " id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" /></svg></div>
                        <ul class="side-menu">
                            
                            <?php if ($navigation->_Nav_Dashboard) { ?>
                            <li class="sub-category">
                                <h3>Dashboard</h3>
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item has-link" id="dasboard" data-bs-toggle="slide" href="../dashboard/main-dashboard"><i
                                            class="side-menu__icon fe fe-home"></i><span
                                            class="side-menu__label">Dashboard</span></a>
                                </li>
                            <?php } ?>

                            <?php if ($navigation->_Nav_Dashboard_Customer) { ?>
                            <li class="sub-category">
                                <h3>Dashboard</h3>
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item has-link" id="dasboard" data-bs-toggle="slide" href="../dashboard/policy-customer-main-dashboard"><i
                                            class="side-menu__icon fe fe-home"></i><span
                                            class="side-menu__label">Dashboard</span></a>
                                </li>
                            <?php } ?>
              

                            </li>
                            
                        

                               

                                  <?php if ($navigation->_Nav_Plan) { ?>
                            <li class="sub-category">
                                <h3>Plan Management</h3>
                                 </li>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_servive_reports" data-bs-toggle="slide" href="../plans/view-all-plans"><i class="side-menu__icon fa fa-heartbeat"></i><span class="side-menu__label">Plan</span></a>
                                </li>   


                            <?php } ?>


                                 <!-- <li class="sub-category">
                                <h3>Transactions Management</h3> 
                            </li> -->
                           

                          

                           <?php if ($navigation->_Nav_Customer) { ?>
                            <li class="sub-category">
                                <h3>Customer Management</h3> 
                            </li>

                               

                               <li>
                                <a href="#" class="side-menu__item has-link clearSessionLink">
                                   <i class="fa fa-user-plus"></i> Add Policy Customer
                                </a>
                               </li>

                               <li>
                                 <a href="../PolicyCustomer/view-all-policy-customer-new" class="side-menu__item has-link">
                                 <i class="fa fa-list mr-2"></i><span class="side-menu__label">Policy Customer List</span> 
                                </a>
                               </li>
                                 
                                <!--  <li class="slide">
                                    <a class="side-menu__item" data-bs-toggle="collapse" href="#policyCusList">
                                        <i class="side-menu__icon fa fa-user-plus"></i>
                                        <span class="side-menu__label">Policy Customer</span>
                                        <i class="angle fa fa-angle-right"></i>
                                    </a>
                                    <div class="collapse" id="policyCusList">
                                        <div class="list-group">
                                                
                                            <a href="../PolicyCustomer/view-all-policy-customer-new" class="list-group-item list-group-item-action">
                                                <i class="fa fa-list mr-2"></i> Policy Customer List
                                            </a>

                                        </div>
                                </li> -->

                                <li>
                                   <a class="side-menu__item"  href="../PolicyCustomer/view-all-customer-new" class="list-group-item list-group-item-action">
                                        <i class="side-menu__icon fa fa-user"></i>
                                        <span class="side-menu__label">All Customer</span>
                                    </a>
                               </li>


                            <?php } ?>


                            <?php if ($navigation->_Nav_Neft) { ?>
                            <li class="sub-category">
                                <h3>Accountant</h3>
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item has-link" id="dasboard" data-bs-toggle="slide" href="../accountant/view-all-accountant"><i
                                            class="side-menu__icon fa fa-arrow-circle-right"></i><span
                                            class="side-menu__label">All Neft/Bank Transfer</span></a>


                                </li>

                                <li class="slide">
                                    <a class="side-menu__item has-link" id="dasboard" data-bs-toggle="slide" href="../accountant/view-all-company-neft-account"><i
                                            class="side-menu__icon fa fa-building"></i><span
                                            class="side-menu__label">Company Neft Account</span></a>    
                                </li>

                                <li class="slide">
                                    <a class="side-menu__item has-link" id="dasboard" data-bs-toggle="slide" href="../accountant/view-all-company-bank-account"><i
                                            class="side-menu__icon fa fa-bank"></i><span
                                            class="side-menu__label">Company Bank Account</span></a>    
                                </li>

                            <?php } ?>


                             <?php if ($navigation->_Nav_Account) { ?>
                            <li class="sub-category">
                                <h3>Transaction Management</h3>
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item has-link" id="dasboard" data-bs-toggle="slide" href="../transaction/view-all-transaction"><i
                                            class="side-menu__icon ion-cash"></i><span
                                            class="side-menu__label">All Transaction</span></a>
                                </li>
                            <?php } ?>

                             
                            <!-- <li class="sub-category">
                                <h3>Blog Management</h3> 
                            </li>

                            <li class="sub-category">
                                <h3>Offer Management</h3> 
                            </li> -->

                             

                            
                            <?php if ($navigation->_Nav_Company) { ?>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_company" data-bs-toggle="slide" href="../company/view-companies.php"><i class="side-menu__icon fa fa-building"></i><span class="side-menu__label">Companies</span></a>
                                </li>    
                            <?php } ?>
                            <?php if ($navigation->_Nav_Company_Sites) { ?>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_company_sites" data-bs-toggle="slide" href="../company/view-company-sites.php?nav=1"><i class="side-menu__icon zmdi zmdi-city-alt"></i><span class="side-menu__label">Company Sites</span></a>
                                </li>    
                            <?php } ?>
                            <?php if ($navigation->_Nav_Service_Reports) { ?>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_servive_reports" data-bs-toggle="slide" href="../service-reports/view-all-service-reports.php"><i class="side-menu__icon fa fa-address-card"></i><span class="side-menu__label">Service Reports</span></a>
                                </li>    
                            <?php } ?>
                            <?php
                            if ($navigation->_Nav_Services) { ?>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_services" data-bs-toggle="slide" href="../services/view-services.php"><i class="side-menu__icon fa fa-address-card"></i><span class="side-menu__label">All Services</span></a>
                                </li>   
                            <?php }
                            if ($navigation->_Nav_Users) { ?>
                             <li class="sub-category">
                                <h3>Settings</h3>
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_user" data-bs-toggle="slide" href="../users/view-users.php"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Users</span></a>
                                </li>    
                            <?php }

                            if ($navigation->_Nav_Channel_Partner) { ?>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_user" data-bs-toggle="slide" href="../channel-partner/view-all-channel-partner.php"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">Channel Partner</span></a>
                                </li>    
                            <?php }

                            if ($navigation->_Nav_Configuration) { ?>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_configuration" data-bs-toggle="slide" href="../configuration/view-configuration.php"><i class="side-menu__icon fa fa-gear"></i><span class="side-menu__label">Configuration</span></a>
                                </li>    
                            <?php }
                            ?>
                            
                               
                                 <?php if ($navigation->_Nav_Users) { ?>
                            <li class="sub-category">
                                <h3>Doctor Management</h3> </li>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_user" data-bs-toggle="slide" href="../doctors/view-doctors.php"><i class="side-menu__icon fa fa-stethoscope"></i><span class="side-menu__label">Doctors</span></a>
                                </li> 


                                 <!-- <li class="slide">
                                    <a class="side-menu__item" id="nav_user" data-bs-toggle="slide" href="../users/view-users.php"><i class="side-menu__icon fa fa-handshake-o"></i><span class="side-menu__label">Relationship Manager</span></a>
                                </li> 

                                <li class="slide">
                                    <a class="side-menu__item" id="nav_user" data-bs-toggle="slide" href="../users/view-users.php"><i class="side-menu__icon  fa fa-headphones"></i><span class="side-menu__label">Customer Support</span></a>
                                </li>     -->
                            <?php } ?>


                                   <?php if ($navigation->_Nav_DocTest) { ?>
                            <li class="sub-category">
                                <h3>Test Management</h3> </li>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_doctest" data-bs-toggle="slide" href="../doctest/view-all-doctest.php"><i class="side-menu__icon fa fa-flask"></i><span class="side-menu__label">All Test</span></a>
                                </li> 
                            <?php } ?>
                            

                               <?php if ($navigation->_Nav_faqs) { ?>
                             <li class="sub-category">
                                <h3>FAQs</h3> 
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_servive_reports" data-bs-toggle="slide" href="../faqs/view-all-faqs"><i class="side-menu__icon  fa fa-info-circle"></i><span class="side-menu__label">FAQ's</span></a>
                                </li>   


                            <?php } ?>

     

                             <?php if ($navigation->_Nav_Document) { ?>
                            <li class="sub-category">
                                <h3>Health Plan</h3> 
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_servive_reports" data-bs-toggle="slide" href="../PolicyCustomer/view-policy-details?PolicyID=<?php echo $Policy_ID; ?>"><i class="side-menu__icon fa fa-heartbeat"></i><span class="side-menu__label">My Health Plan </span></a>
                                </li> 


                            <?php } ?>



                             <?php if ($navigation->_Nav_Reimbursement) { ?>
                             <li class="sub-category">
                                <h3>Reimbursement Management</h3> 
                            </li>
                                <li class="slide">
                                    <a class="side-menu__item" id="nav_servive_reports" data-bs-toggle="slide" href="../reimbursement/view-all-reimbursement"><i class="side-menu__icon   fa fa-money"></i><span class="side-menu__label">Reimbursement</span></a>
                                </li>   


                            <?php } ?>





                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </div>
            </div>
            <!--/APP-SIDEBAR-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
    $(document).ready(function() {
    $('.clearSessionLink').on('click', function(e) 
    {
        // Check if the item exists in localStorage
        if (localStorage.getItem('currentStep') !== null) {
            // If it exists, remove it
            localStorage.removeItem('currentStep');
            console.log('currentStep removed');
        }
        e.preventDefault();
        $.ajax({
            url: '../controllers/clear-session.php',
            type: 'POST',
            success: function(response) {
                // After clearing the session, redirect the user
                window.location.href = '../PolicyCustomer/add-policy-customer-new';
            },
            error: function() {
                alert('Error clearing session.');
            }
        });
    });
});

</script>