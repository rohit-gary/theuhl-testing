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
    <title>View All Users </title>
    
    <?php
    include("../include/common-head.php");
    $user = new CMusers($conn);
    $all_user_details = $user->getAllActiveUsers();
    $all_user_roles = $user->getAllUserRoles();
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
                            <h1 class="page-title">All Users</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Users</li>
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
                                    <a href="#" onclick="AddUser()" class="btn btn-success">Add User</a>
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
                                                        <th class="wd-15p border-bottom-0">Name</th>
                                                        <th class="wd-15p border-bottom-0">Phone</th>
                                                        <th class="wd-15p border-bottom-0">Email</th>
                                                        <th class="wd-15p border-bottom-0">Role</th>
                                                        <?php
                                                        if($AdminAccess)
                                                        {
                                                        ?>
                                                            <th class="wd-15p border-bottom-0">Reset Password</th>
                                                            <th class="wd-25p border-bottom-0">Action</th>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $i=1;
                                                    foreach($all_user_details as $user)
                                                    {
                                                    $UserEmail = $user['Email'];
                                                    $id  = $user['ID'];
                                                    $UserID = $user['UserID'];
                                                    $Role = $all_user_roles[$UserID]['Role'];
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $user['Name']; ?></td>
                                                            <td><?php echo $user['PhoneNumber']; ?></td>
                                                            <td><?php echo $user['Email']; ?></td>
                                                            <td><?php echo $Role; ?></td>
                                                            <?php
                                                            if($AdminAccess)
                                                            {
                                                            ?>
                                                                <td class="text-left">
                                                                    <a onclick="ResetPassword('<?php echo $UserEmail;?>');"><span class="badge bg-danger badge-sm  me-1 mb-1 mt-1 cursor-pointer fe fe-settings fs-14" >&nbsp;Reset</span></a>    
                                                                </td>
                                                                <td>
                                                                        <div class="g-2">
                                                                            <!--a href="#" onclick="UpdateStudentFee()"
                                                                                    class="btn text-primary btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="Update"><span
                                                                                        class="fe fe-edit fs-14"></span>
                                                                             </a-->
                                                                            <a class="btn text-danger btn-sm"
                                                                                    data-bs-toggle="tooltip" onclick="DeleteUser(<?php echo $UserID;?>)" 
                                                                                    data-bs-original-title="Delete"><span
                                                                                        class="fe fe-trash-2 fs-14"></span>
                                                                            </a> 
                                                                            <a class="btn text-danger btn-sm"
                                                                                    data-bs-toggle="tooltip" onclick="UpdateUser(<?php echo $UserID;?>)" 
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

            <div class="modal fade" id="add_user" tabindex="1">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="UserModalHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="user_form" onsubmit="return false;">

                                <input type="hidden" id="form_action" name="form_action" value="" />
                                <input type="hidden" id="form_id" name="form_id" value="" />

                                <div class="row">
                                    <div class="form-group col-md-6">
                                       <label for="recipient-name" class="col-form-label">Name<span class="text-danger">*<span></label>
                                       <input type="text" class="form-control" name="user_name" id="user_name"
                                            Placeholder="Enter Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">User Email (Will be used for login )<span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="user_username" id="user_username"
                                            Placeholder="Enter Username">
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

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Email</label>
                                        <input type="text" class="form-control" name="user_email" id="user_email"
                                            Placeholder="Enter Email">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Phone Number<span class="text-danger">*<span></label>
                                        <input type="text" maxlength="10" class="form-control" onkeyup="validISNumber()" name="user_phone_number" id="user_phone_number" placeholder="Enter Phone Number">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Aadhar</label>
                                        <input type="text" class="form-control" name="user_aadhar" id="user_aadhar"
                                            Placeholder="Enter Aadhar">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">PAN</label>
                                        <input type="text" maxlength="10" class="form-control" name="user_pan" id="user_pan" placeholder="Enter PAN">
                                    </div>

                                    
                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">User Type<span class="text-danger">*<span></label>
                                        <select class="form-select" name="user_type" id="user_type">
                                          <option value="">Select User Type</option>
                                          <option value="Admin">Admin</option>
                                          <option value="Customer Support">Customer Support</option>
                                          <option value="Relationship Manager">Relationship Manager</option>
                                          <option value="Doctors">Doctors</option>
                                          <option value="Sales Man">Sales Man</option>
                                          <option value="Accountant">Accountant</option>
                                          <!-- <option value="ChannelPartner">Channel Partner</option> -->
                                        </select>  
                                    </div>  
                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Address</label>
                                        <textarea class="form-control" placeholder="Please Enter Employee Address" rows="2" name="ta_address" id="ta_address"></textarea>
                                    </div>
                                </div>

                                
                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addUpdateBtn"
                                        onclick="AddUpdateUser()"></button>
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

        <script src="../project-assets/js/user.js"></script>
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