<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$counter = $_POST['counter'];
?>
<div class="row" id="service_image_row_<?php echo $counter;?>">

    <div class="mb-3 col-md-7 col-12">
        <label for="recipient-name" class="col-form-label">Service Image</label>
        <input type="file" class="form-control sub_startdate" name="ServiceImages[]"/>
    </div>
    <div class="col-1 mt-4">
        <a onclick="DeleteServiceImage(<?php echo $counter;?>)" class="btn btn-danger mt-4 text-white">
          <i class="fe fe-minus"></i>
        </a>
    </div>
 
</div>
