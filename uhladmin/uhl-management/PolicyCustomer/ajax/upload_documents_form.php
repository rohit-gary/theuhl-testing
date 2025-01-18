<?php 
@session_start();
$FamilyMemberDetails= isset($_SESSION['family_member']) ? $_SESSION['family_member'] : '';
$PolicyNumber=isset($_SESSION['PolicyNumber']) ? $_SESSION['PolicyNumber'] : '';
$UploadedDocuments = isset($_SESSION['family_member_documents']) ? $_SESSION['family_member_documents'] : [];
?>


<?php foreach ($FamilyMemberDetails as $index => $family_member) { ?> 
<form id="policyDocumentss_form_<?=$index?>" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" id="form_action" name="form_action" value="" />
    <input type="hidden" id="form_id" name="form_id" value="" />
    
    <div class="row">  
        <div class="mb-4">
            <input type="hidden" class="form-control" id="policy_ID" name="policy_ID">
        </div>
        <input type="hidden" id="PolicyNumberDoc" name="policy_number" value="<?php echo $PolicyNumber ?>">

        <div class="col-lg-3 col-sm-12 mb-4">
            <label for="familyMemberSelect" class="form-label fw-bold d-flex align-items-center">
                Family Member 
                <span id="refreshBadge" class="badge bg-primary ms-2" style="cursor: pointer; display: none;" title="Click to refresh family members">
                    Refresh
                </span>
            </label>
            <!-- Read-only field to show family member name -->
            <input type="text" class="form-control" id="familyMemberName_<?=$index?>" name="familyMemberName" value="<?=$family_member['Name'];?>" readonly>
            <!-- Hidden field to store the family member ID -->
            <input type="hidden" class="form-control" id="familyMemberSelect_<?=$index?>" name="familyMemberSelect" value="<?=$family_member['ID'];?>">
        </div>

        <div class="col-lg-3 col-sm-12 mb-4">
            <label for="documentType" class="form-label fw-bold">Select Document Type</label>
            <select class="form-select" id="documentType_<?=$index?>" name="documentType">
                <option value="">Select a document type</option>
                <option value="ID_Proof">ID Proof</option>
                <option value="Address_Proof">Address Proof</option>
                <option value="Income_Proof">Income Proof</option>
                <option value="Other">Other</option>
            </select>
        </div>                                                  

        <div class="col-lg-3 col-sm-12 mb-4">
            <div id="documents_container_<?=$index?>">
                <label for="document" class="form-label fw-bold">Upload Document</label>
                <div class="input-group mb-2">
                    <input type="file" class="form-control" id="documentss_<?=$index?>_0" name="policy_documentss[]">
                    <button type="button" class="btn btn-outline-primary" onclick="addFileInput(<?=$index?>)">+</button>
                </div>
            </div>
        </div>



        <div class="col-lg-3 col-sm-12 mb-4 text-center">
            <label for="document" class="form-label fw-bold">Upload Btn</label>
            <button class="btn btn-success text-white" id="UplodeDocumentssBtn_<?=$index?>" onclick="AddUploade(<?=$index?>)">Upload Document</button>

        </div>
    </div>
            <!-- Display uploaded documents (if any) -->
               <div class="col-lg-12 col-sm-12 mb-4">
    <label for="uploadedDocuments" class="form-label fw-bold">Uploaded Documents</label>
    <div id="uploadedDocumentsContainer_<?=$index?>">
        <?php 
        if (isset($UploadedDocuments[$family_member['ID']])) {
            $documents = $UploadedDocuments[$family_member['ID']];
            if (!empty($documents)) {
                echo '<div class="list-group">';
                foreach ($documents as $doc) {
                    echo '<div class="list-group-item d-flex justify-content-between align-items-center border-0 rounded-3 shadow-sm mb-3">';
                    echo '<div class="d-flex align-items-center">';
                    echo '<i class="fas fa-file-alt me-2 text-primary"></i>'; // File icon
                    echo '<span>' . ($doc) . '</span>';
                    echo '</div>';
                    echo '<div>';
                    // View and Delete buttons
                    echo '<button type="button" class="btn btn-outline-info btn-sm me-2" onclick="viewDocument(\'' . $doc . '\')">View</button>';
                    echo '<button type="button" class="btn btn-outline-danger btn-sm d-none" onclick="deleteDocument(\'' . $doc . '\')">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<p class="text-muted">No documents uploaded yet.</p>';
            }
        } else {
            echo '<p class="text-muted">No documents uploaded yet.</p>';
        }
        ?>
    </div>
</div>

</form>
<?php } ?>




<!-- ----------------------- -->
<button type="button" class="btn btn-primary" id="goToPreviousStepLastBtn"onclick="goToPreviousStep()">Previous</button>
<button class="btn btn-info text-black my-4" id="feezesendmail" onclick="feezesendmail('<?php echo $PolicyNumber; ?>')">Freeze AllStep & SendPolicyDoc</button>






<!-- ---------------Thanks You Page-------------- -->
<section id="last_step_thanks" style="display: none;">
    
   <div class="confetti"></div>
  <div class="thank-you-card">
    <h1>Thank You!</h1>
    <p>Your form has been Successfully Submitted. </p>
    <p>Go to Add Policy Customer Tab to Add More Customers</p>
  </div>
</section>

