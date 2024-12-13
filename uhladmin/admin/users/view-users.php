<?php @session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>View All Users - DWD</title>
    
    <?php
    @session_start(); 
    include("../include/common-head.php");
    require_once('../include/autoloader.inc.php');
    $dbh = new Dbh();
    $conn = $dbh->_connectodb();
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();
    $user = new Users($conn);
    $all_user_details = $user->getAllActiveUsers();
    $Modules = new Modules($conn);
    $All_Modules = $Modules->getAllModules();
    $Organization = new Organization($conn);
    $All_Organization = $Organization->getAllOrganization();
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
                        <div class="row pb-5 justify-content-end">
                            <div class="col-md-4 text-end">
                                <a href="#" onclick="AddUser()" class="btn btn-success">Add User</a>
                            </div>
                        </div>
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
                                                        <th class="wd-15p border-bottom-0">User Type</th>
                                                        <th class="wd-25p border-bottom-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $i=1;
                                                    foreach($all_user_details as $user)
                                                    {

                                                    $id  = $user['ID'];
                                                    ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $user['Name']; ?></td>
                                                    <td><?php echo $user['Mobile']; ?></td>
                                                    <td><?php echo $user['Email']; ?></td>
                                                    <td><?php echo $user['UserType']; ?></td>
                                                    <td>
                                                            <div class="g-2">
                                                                <!--a href="#" onclick="UpdateStudentFee()"
                                                                        class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Update"><span
                                                                            class="fe fe-edit fs-14"></span>
                                                                 </a-->
                                                                <a class="btn text-danger btn-sm"
                                                                        data-bs-toggle="tooltip" onclick="DeleteUser(<?php echo $id;?>)" 
                                                                        data-bs-original-title="Delete"><span
                                                                            class="fe fe-trash-2 fs-14"></span>
                                                                </a> 
                                                            </div>
                                                    </td>
                                                    
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
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="UserModalHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="user_form" onsubmit="return false;">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="user_name" id="user_name"
                                        Placeholder="Enter Name">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Email (will be used as Username)</label>
                                    <input type="text" class="form-control" name="user_email" id="user_email"
                                        Placeholder="Enter Email">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Phone Number</label>
                                    <input type="text" maxlength="10" class="form-control" onkeyup="validISNumber()" name="user_phone_number" id="user_phone_number" placeholder="Enter Phone Number">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        Placeholder="Enter Password">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        Placeholder="Enter Confirm Password">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Modules <span class="text-danger">*<span></label>
                                    <select class="form-control select2 form-select" name="modules_id" id="modules_id">
                                    <option value="">Choose Modules</option>    
                                    <?php
                                    $i = 1;
                                    foreach($All_Modules as $Modules_value)
                                    {
                                        
                                    ?>
                                        <option value="<?php echo  $Modules_value['ID']?>" ><?php echo  $Modules_value['ModulesName']?></option>
                                    <?php
                                    $i++;
                                    }
                                    ?> 
                                    </select>   
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Organization <span class="text-danger">*<span></label>
                                    <select class="form-control select2 form-select" name="organization_id" id="organization_id">
                                    <option value="">Choose Organization</option>    
                                    <?php
                                    $i = 1;
                                    foreach($All_Organization as $Organization_value)
                                    {
                                        
                                    ?>
                                        <option value="<?php echo  $Organization_value['ID']?>" ><?php echo  $Organization_value['OrganizationName']?></option>
                                    <?php
                                    $i++;
                                    }
                                    ?> 
                                    </select>   
                                </div>


                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">User Type</label>
                                    <select class="form-select" name="user_type" id="user_type">
                                      <option value="Counsellor">Counsellor</option>
                                      <option value="Admission">Admission</option>
                                      <option value="ContentTeam">Content Team</option>
                                      <option value="Book Dispatch">Book Dispatch</option>
                                      <option value="Academic Head">Academic Head</option>
                                    </select>
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
            });
        </script>
</body>

</html>