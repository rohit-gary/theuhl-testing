<?php 
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$CompanyID = $_POST['CompanyID'];
$company = new Company($conn);
$company_sites_array = $company->GetCompanySitesList($CompanyID);
?>
<!-- <label for="recipient-name" class="col-form-label" style="width:100%;">Select Company Site<span class="text-danger">*<span></label>
<select class="form-control select2-show-search form-select" id="ser_company_sites"  name="CompanySiteID" data-placeholder="Choose one" style="width:100%;">
    <option label="Select Company Site"></option> -->
        <?php 
        foreach ($company_sites_array as $company_site) 
        {
        ?>
            <option value="<?php echo $company_site['ID']; ?>"><?php echo $company_site['SiteName']; ?></option>
        <?php
        }
        ?>
<!-- </select> -->