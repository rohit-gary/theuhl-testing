
<?php 
@session_start();
$FamilyMemberDetails= isset($_SESSION['family_member']) ? $_SESSION['family_member'] : '';
?>
<form id="upload-documents-form" method="post">
    <!-- Family Member Select -->
    <div class="mb-4">
        <label for="familyMemberSelect" class="form-label fw-bold d-flex align-items-center">
            Select Family Member 
            <span id="refreshBadge" class="badge bg-primary ms-2" style="cursor: pointer;" title="Click to refresh family members">
                Refresh
            </span>
        </label>
        <select class="form-select" id="familyMemberSelect" name="familyMemberSelect">
            <option value="">Select a family member</option>
            <!-- Family member options will be populated here -->
            <?php foreach ($FamilyMemberDetails as $family_member) 
            {
                ?>
                <option value="<?=$family_member['ID'];?>"><?=$family_member['Name'];?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <!-- Document Type Select -->
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

    <!-- File Upload Section -->
    <div class="mb-4">
        <label for="fileInput" class="form-label fw-bold">Select Documents</label>
        <input type="file" id="fileInput" name="policy_documents[]" multiple>
    </div>

    <!-- Uploaded File List -->
    <ul class="list-group mt-4" id="fileList"></ul>

    <!-- Buttons -->
    <div class="mt-4 d-flex justify-content-between">
        <button type="button" class="btn btn-primary" onclick="goToPreviousStep()">Previous</button>
        <button type="button" class="btn btn-success" id="uploadBtn">Upload Files</button>
        <button type="button" class="btn btn-primary" onclick="goToNextStep()">Next</button>
    </div>

    <input type="hidden" id="PolicyNumber" name="PolicyNumber" value="123312">
</form>

 <script src="../project-assets/js/customer-policy.js"></script>