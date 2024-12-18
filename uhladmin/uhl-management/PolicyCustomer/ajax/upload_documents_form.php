<?php 
@session_start();
$FamilyMemberDetails= isset($_SESSION['family_member']) ? $_SESSION['family_member'] : '';
$PolicyNumber=isset($_SESSION['PolicyNumber']) ? $_SESSION['PolicyNumber'] : '';
?>

 <form id="policyDocumentss_form" onsubmit="return false;" enctype="multipart/form-data">
<input type="hidden" id="form_action" name="form_action" value="" />
<input type="hidden" id="form_id" name="form_id" value="" />
<div class="row">  
     <div class="mb-4">
        <input type="hidden" class="form-control" id="policy_ID" name="policy_ID">
    </div>
      <input type="hidden" id="PolicyNumberDoc" name="policy_number" value="<?php echo $PolicyNumber ?>">
    <div class="mb-4">
        <label for="familyMemberSelect" class="form-label fw-bold d-flex align-items-center">
            Select Family Member 
            <span id="refreshBadge" class="badge bg-primary ms-2" style="cursor: pointer; display: none;" title="Click to refresh family members">
                Refresh
            </span>
        </label>
        <select class="form-select" id="familyMemberSelect" name="familyMemberSelect">
            <option value="">Select a family member</option>
            <?php foreach ($FamilyMemberDetails as $family_member) { ?>
                <option value="<?=$family_member['ID'];?>"><?=$family_member['Name'];?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="documentType" class="form-label fw-bold">Select Document Type</label>
        <select class="form-select" id="documentType" name="documentType">
            <option value="">Select a document type</option>
            <option value="ID_Proof">ID Proof</option>
            <option value="Address_Proof">Address Proof</option>
            <option value="Income_Proof">Income Proof</option>
            <option value="Other">Other</option>
        </select>
    </div>
                                                    

 <div class="mb-4">

<div id="documents_container">
    <div class="input-group mb-2">
        <input type="file" class="form-control" id="documentss_0" name="policy_documentss[]">
        <button type="button" class="btn btn-outline-primary" onclick="addFileInput()">+</button>
    </div>
</div>
</div>
</div>

<div class="mt-5 text-center">
    <button type="button" class="btn btn-primary" onclick="goToPreviousStep()">Previous</button>
<button class="btn btn-success text-white" id="UplodeDocumentssBtn" onclick="AddUploade()">Upload Document</button>

</div>
</form>



