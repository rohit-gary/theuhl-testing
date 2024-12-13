<?php
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();
$Modules = new Modules($conn);
$All_Modules = $Modules->getAllModules();
$OrgID = $_POST['OrgID'];
$org_modules = $Modules->GetOrgModules($OrgID);
?>
<form id="organization_module_form" onsubmit="return false;">
    <?php
    if(sizeof($org_modules) > 0)
    {
        foreach($org_modules as $org_module)
        {
            $mapping_id = $org_module['ID'];
            $selected_free_trial = $selected_regular = "";
            if($org_module['SubscriptionType'] == "Free Trial")
                $selected_free_trial = "selected";
            if($org_module['SubscriptionType'] == "Regular")
                $selected_free_trial = "selected";

    ?>
            <div class="row">
                <div class="mb-3 col-md-2 col-12">
                    <label for="recipient-name" class="col-form-label">Module</label>
                    <select class="form-control select2 form-select" name="org_module_id_<?=$mapping_id;?>" id="org_module_id_<?=$mapping_id;?>" disabled>
                    <option value="">Choose Module</option>    
                    <?php
                    $i = 1;                
                    $selected = "";
                    foreach($All_Modules as $Modules_value)
                    {
                        $selected = "";
                        if($Modules_value['ID'] == $org_module['ModuleID'])
                        {
                            $selected = "selected";
                        }
                    ?>
                        <option value="<?php echo $Modules_value['ID']?>" <?= $selected; ?>><?php echo  $Modules_value['ModulesName']?></option>
                    <?php
                    $i++;
                    }
                    ?> 
                    </select>
                </div>
                <div class="mb-3 col-md-2 col-12">
                    <label for="recipient-name" class="col-form-label">Type <span class="text-danger">*<span></label>
                    <select class="form-control select2 form-select" name="org_module_subscription_type_<?=$mapping_id;?>" id="org_module_subscription_type_<?=$mapping_id;?>" disabled>
                        <option value="">Choose Subscription Type</option>
                        <option value="Free Trial" <?=$selected_free_trial;?>>Free Trial</option>   
                        <option value="Regular" <?=$selected_regular;?>>Regular</option> 
                    </select>
                </div>
                <div class="mb-3 col-md-3 col-12">
                    <label for="recipient-name" class="col-form-label">Subscription Start Date <span class="text-danger">*<span></label>
                    <input type="text" class="form-control sub_startdate" name="org_module_subscription_start_date_<?=$mapping_id;?>" id="org_module_subscription_start_date_<?=$mapping_id;?>" Placeholder="Enter Start Date" value="<?= $org_module['SubscriptionStartDate']; ?>" disabled/>
                </div>

                <div class="mb-3 col-md-3 col-12">
                    <label for="recipient-name" class="col-form-label">Subscription End Date <span class="text-danger">*<span></label>
                    <input type="text" class="form-control sub_enddate" name="org_module_subscription_end_date_<?=$mapping_id;?>" id="org_module_subscription_end_date_<?=$mapping_id;?>"  Placeholder="Enter End Date" value="<?= $org_module['SubscriptionEndDate']; ?>" disabled/>
                </div>
                <div class="col-1 mt-4" id="edit_button_div_<?=$mapping_id;?>">
                    <a onclick="EditModuleMapping(<?=$mapping_id;?>)" class="btn btn-danger mt-4 text-white">
                      <i class="fe fe-edit"></i>
                    </a>
                </div>
                <div class="col-1 mt-4" id="db_settings_button_div_<?=$mapping_id;?>">
                    <a onclick="SetOrgModuleDatabase(<?=$mapping_id;?>)" class="btn btn-primary mt-4 text-white">
                      <i class="fe fe-settings"></i>
                    </a>
                </div>

            </div>
    <?php
        }
        ?>
        <div class="row" id="add_module_html_div">
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="row" id="add_module_html_div">
            <h5> Kindly Map Modules to the Organization </h5>
        </div>
    <?php
    }
    ?>
    <div class="mt-5 text-center">
        <button class="btn btn-success text-white" id="addOrganizationModulesBtn"
            onclick="AddUpdateOrgModules()"> Save </button>
    </div>
    <input type="hidden" name="organization_id" value=<?php echo $OrgID; ?> />
    <input type="hidden" id="new_module_counter" value=1 />
</form>