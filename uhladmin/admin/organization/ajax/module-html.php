<?php
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();
$Modules = new Modules($conn);
$All_Modules = $Modules->getAllModules();
$counter = $_POST['counter'];
?>
<div class="row" id="module_row_<?php echo $counter;?>">
    <div class="mb-3 col-md-3 col-12">
        <label for="recipient-name" class="col-form-label">Module</label>
        <select class="form-control select2 form-select" name="new_module[]">
        <option value="-1">Choose Modules</option>    
        <?php
        $i = 1;
        foreach($All_Modules as $Modules_value)
        {
        ?>
            <option value="<?php echo $Modules_value['ID']?>" ><?php echo  $Modules_value['ModulesName']?></option>
        <?php
        $i++;
        }
        ?> 
        </select>
    </div>
    <div class="mb-3 col-md-2 col-12">
        <label for="recipient-name" class="col-form-label">Type <span class="text-danger">*<span></label>
        <select class="form-control select2 form-select" name="new_subscription_type[]">
            <option value="-1">Choose Subscription Type</option>
            <option value="Free Trial">Free Trial</option>   
            <option value="Regular">Regular</option> 
        </select>
    </div>
    <div class="mb-3 col-md-3 col-12">
        <label for="recipient-name" class="col-form-label">Start Date <span class="text-danger">*<span></label>
        <input type="text" class="form-control sub_startdate" name="new_sub_startdate[]" Placeholder="Enter Start Date" />
    </div>

    <div class="mb-3 col-md-3 col-12">
        <label for="recipient-name" class="col-form-label">End Date <span class="text-danger">*<span></label>
        <input type="text" class="form-control sub_enddate" name="new_sub_enddate[]" Placeholder="Enter End Date" />
    </div>
    <div class="col-1 mt-4">
        <a onclick="DeleteNewModule(<?php echo $counter;?>)" class="btn btn-danger mt-4 text-white">
          <i class="fe fe-minus"></i>
        </a>
    </div>
 <!--    <div class="mb-4 col-md-4 col-4">
        <label for="recipient-name" class="col-form-label">Database Name (Global)</label>
        <input type="text" class="form-control" name="db_name_global[]" id="db_name_global">
    </div>
    <div class="mb-4 col-md-4 col-4">
        <label for="recipient-name" class="col-form-label">Database User (Global)</label>
        <input type="text" class="form-control" name="db_user_global[]" id="db_user_global">
    </div>
    <div class="mb-4 col-md-4 col-4">
        <label for="recipient-name" class="col-form-label">Database Password (Global)</label>
        <input type="text" class="form-control" name="db_password_global[]" id="db_password_global">
    </div>
    <div class="mb-4 col-md-4 col-4">
        <label for="recipient-name" class="col-form-label">Database Name (Local)</label>
        <input type="text" class="form-control" name="db_name_local[]" id="db_name_local">
    </div>
    <div class="mb-4 col-md-4 col-4">
        <label for="recipient-name" class="col-form-label">Database User (Local)</label>
        <input type="text" class="form-control" name="db_user_local[]" id="db_user_local">
    </div>
    <div class="mb-4 col-md-4 col-4">
        <label for="recipient-name" class="col-form-label">Database Password (Local)</label>
        <input type="text" class="form-control" name="db_password_local[]" id="db_password_local">
    </div> -->
</div>