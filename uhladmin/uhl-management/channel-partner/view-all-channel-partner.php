<?php
@session_start();
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
include("../include/get-db-connection.php");
$access = array("AdminAccess"=>1,"ViewAccess"=>1,"EditAccess"=>1,"DeleteAccess"=>1);
extract($access);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- TITLE -->
    <title>View All Channel Partner</title>
    
    <?php
    include("../include/common-head.php");
    $ChannelPartner = new ChannelPartner($conn);
    $all_Partner_details = $ChannelPartner->GetAllChannelPartners();
    
    ?>
</head>

<body class="app sidebar-mini ltr light-mode">
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
                            <h1 class="page-title">All Channel Partner</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Channel Partner</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <?php
                        if($EditAccess)
                        {
                        ?>
                            <div class="row pb-5 justify-content-end">
                                <div class="col-md-4 text-end">
                                    <a href="#" onclick="AddChannelPartner()" class="btn btn-success">Add Channel Partner</a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="view-users">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Channel Partner</th>
                                                        <th class="wd-15p border-bottom-0">Phone</th>
                                                        <th class="wd-15p border-bottom-0">Email</th>
                                                        <!-- <th class="wd-15p border-bottom-0">Details</th> -->
                                                      
                                                        <?php
                                                        if($AdminAccess)
                                                        {
                                                        ?>
                                                            
                                                            <th class="wd-25p border-bottom-0">Action</th>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $i=1;
                                                    foreach($all_Partner_details as $partner)
                                                    {
                                                    $partnerEmail = $partner['Email'];
                                                    $ID  = $partner['ID'];
                                                    $Name  = $partner['Name'];
                                                    $Phone  = $partner['PhoneNumber'];
                                                    
                                                   
                                                    ?>
                                                        <tr>
                                                              <td><?php echo $i;?></td>
                                                            <td><?php echo $Name;?></td>
                                                            <td><?php echo $Phone;?></td>
                                                            <td><?php echo $partnerEmail;?></td>

                                                              
                                                            <!-- <td> <a onclick="ResetPassword('<?php echo $partnerEmail;?>');"><span class="badge bg-danger badge-sm  me-1 mb-1 mt-1 cursor-pointer fe fe-settings fs-14" >&nbsp;Detials</span></a></td> -->

                                                            
                                                            <?php
                                                            if($AdminAccess)
                                                            {
                                                            ?>
                                                               
                                                                <td>
                                                                        <div class="g-2">
                                                                            <!--a href="#" onclick="UpdateStudentFee()"
                                                                                    class="btn text-primary btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="Update"><span
                                                                                        class="fe fe-edit fs-14"></span>
                                                                             </a-->
                                                                            <a class="btn text-danger btn-sm"
                                                                                    data-bs-toggle="tooltip" onclick="DeleteChannelPartner(<?php echo $ID;?>)" 
                                                                                    data-bs-original-title="Delete"><span
                                                                                        class="fe fe-trash-2 fs-14"></span>
                                                                            </a> 
                                                                            <a class="btn text-danger btn-sm"
                                                                                    data-bs-toggle="tooltip" onclick="UpdateChannelPartner(<?php echo $ID;?>)" 
                                                                                    data-bs-original-title="Edit"><span
                                                                                        class="fe fe-edit-2 fs-14"></span>
                                                                            </a> 
                                                                        </div>
                                                                </td>
                                                            <?php
                                                            }
                                                            ?>
                                                        
                                                        </tr>
                                                <?php
                                                    $i++;
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->


            <!-- start add modal  -->

            <div class="modal fade" id="add_channelpartner" tabindex="1">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="channelPartnerModalHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="channelpartner_form" onsubmit="return false;">

                                <input type="hidden" id="form_action" name="form_action" value="" />
                                <input type="hidden" id="form_id" name="form_id" value="" />

                                <div class="row">
                                    <div class="form-group col-md-6">
                                       <label for="recipient-name" class="col-form-label">Channel Partner Name<span class="text-danger">*<span></label>
                                       <input type="text" class="form-control" name="name" id="name"
                                            Placeholder="Enter Name">
                                    </div>

                                    <div class="form-group col-md-6">
                                       <label for="recipient-name" class="col-form-label">Tax Identification Number (TIN)</label>
                                       <input type="text" class="form-control" name="tin" id="tin"
                                            Placeholder="Enter Tax Identification Number">
                                    </div>

                                     <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Registration Number<span class="text-danger">*<span></label>
                                        <input type="text" maxlength="10" class="form-control" name="registration_number" id="registration_number" placeholder="Enter registration_number">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">License Number</label>
                                        <input type="text" class="form-control" name="license_number" id="license_number"
                                            Placeholder="Enter License Number">
                                    </div>


                                    
                                        <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Email (Used for logging in)</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            Placeholder="Enter Email">
                                    </div>

                                     <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Phone Number<span class="text-danger">*<span></label>
                                        <input type="text" maxlength="10" class="form-control" onkeyup="validISNumber()" name="phone_number" id="phone_number" placeholder="Enter Phone Number">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Alternative Contact Information<span class="text-danger"><span></label>
                                        <input type="text" maxlength="10" class="form-control" name="alternative_contact" id="alternative_contact" placeholder="Enter  Secondary email/phone">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Office/Business Address</label>
                                        <textarea class="form-control" placeholder="Please Enter Office/Business Address" rows="2" name="address" id="address"></textarea>
                                    </div>


                                    <div class="form-group col-md-6" id="modal_password_field">
                                        <label for="recipient-name" class="col-form-label">Password<span class="text-danger">*<span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            Placeholder="Enter Password">
                                    </div>

                                     <div class="form-group col-md-6" id="modal_confirm_password_field">
                                        <label for="recipient-name" class="col-form-label">Confirm Password<span class="text-danger">*<span></label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            Placeholder="Enter Confirm Password">
                                    </div>    
                                </div>

                                
                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addUpdateBtn"
                                        onclick="AddUpdateChannelPartner()"></button>
                                    <!-- <a href="#"  class="btn btn-success">Submit</a> -->
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End End modal  -->

            <!-- Start Reset Password -->

            <div class="modal fade" id="reset_password_modal" tabindex="1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title">Reset Password</h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="reset_password_form" onsubmit="return false;">
                                <input type="hidden" name="rp_user_email" id="rp_user_email" value="-1">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Password</label>
                                    <input type="password" class="form-control" name="r_password" id="r_password"
                                        Placeholder="Enter Password">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Confirm Password</label>
                                    <input type="text" class="form-control" name="r_confirm_password" id="r_confirm_password"
                                        Placeholder="Enter Confirm Password">
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="resetpasswordBtn"
                                        onclick="ResetPasswordAction()">Save</button>
                                    <!-- <a href="#"  class="btn btn-success">Submit</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Reset Password -->


            <?php
       include("../navigation/right-side-navigation.php");
        ?>

        </div>

        <?php
       include("../include/common-script.php");
        ?>

        <script src="../project-assets/js/channelpartner.js"></script>
        <script src="../project-assets/js/commonjs.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_user").addClass("active");
              $("#view-users").DataTable({
                  autoFill: true,
                });
            });
        </script>
</body>

</html>