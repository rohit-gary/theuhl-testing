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
    <title>View All Programs </title>
    <?php 
    include("../include/common-head.php");
    $dbh = new Dbh();
    $conn = $dbh->_connectodb();
    $core = new Core();
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();

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
                        <div class="page-header mb-3">
                            <h1 class="page-title">All Plans</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Plan</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                               

                        <div class="row pb-5 justify-content-end">
                             <?php if ($access) { ?>
                                <div class="col-md-4 text-end">
                                    <span onclick="AddFaqs()" class="btn btn-success">Add Faq's</span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom"
                                                id="all_programs">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-5p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">Question</th>
                                                        <th class="wd-25p border-bottom-0">Answer</th>
                                                                                                             
                                                         <th class="wd-5p border-bottom-0">Action</th>
                                                    </tr>
                                                </thead>
                                               
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


            <!-- program modal start add modal  -->

            <div class="modal fade" id="add_faqs">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title" id="FaqsHeading"></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="faqs_form" onsubmit="return false;">
                                <div class="row">
                                    

                                    <div class="mb-3 col-md-12">
                                        <label for="recipient-name" class="col-form-label">Question<span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="Question" id="Question"
                                            Placeholder="Enter Question">
                                    </div>
                                

                                     <div class="mb-3 col-md-12">
                                        <label for="recipient-name" class="col-form-label">Answer<span class="text-danger">*<span></label>
                                        <textarea type="text" class=" richText-initial" name="Answer" id="Answer"
                                            Placeholder="Enter Answer"></textarea>
                                    </div>

                                </div>

                                <input type="hidden" id="form_action" name="form_action" value="add" />
                                <input type="hidden" id="form_id" name="form_id" value="-1" />

                                <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addFaqsBtn"
                                        onclick="AddUpdateFaqsForm()"></button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- program modal End End modal  -->

            <!-- program Cordinator modal start add modal  -->

          


            <!-- program Cordinator modal End End modal  -->

            


        <?php
       include("../navigation/right-side-navigation.php");
        ?>

        </div>

        <?php
       include("../include/common-script.php");
        ?>

       <script src="../project-assets/js/faqs.js"></script>
        <!-- INTERNAL WYSIWYG Editor JS -->
        <!-- <script src="../theme-assets/plugins/wysiwyag/jquery.richtext.js"></script> -->
        <!-- <script src="../theme-assets/plugins/wysiwyag/wysiwyag.js"></script> -->
        <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

        <!-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> -->

        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_program").addClass("active");
            });
        </script>

     



<script>
    var editor = new RichTextEditor("#Answer");
    
 
</script>


</body>

</html>