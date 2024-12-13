function AddReimbursement(policyID) {
    // Perform AJAX call to check if all documents are valid
    $.ajax({
        url: 'action/check-kyc-documents-status.php', // PHP file that checks document status
        type: 'GET',
        data: {
            policyID: policyID // Pass the PolicyID as part of the data
        },
        success: function(response) {
            // Parse the response if it's a JSON string
            var responseData = JSON.parse(response);  // Corrected to use 'response' instead of 'data'
            
            if (responseData.error === false) {
                // If documents are valid, open the modal and set the form values
                $('#reimbursement_form')[0].reset();
                $("#form_action").val("Add");
                $("#add_remibursement").modal("show");
                $("#addUpdateReimbursementBtn").html("Add");
                $("#CustomerRemibursementModalHeading").html("Add Reimbursement");

                // Set the date input fields to the current date
                const currentDate = new Date();
                const formattedDate = currentDate.toISOString().split('T')[0];
                $("#hospital_name").val(formattedDate);
                $("#checkup_date").val(formattedDate);
                
                // Initialize date pickers (if necessary)
                $('#employee_dateform').datepicker({
                    format: 'yyyy-mm-dd',
                });

                $('#checkup_date').datepicker({
                    format: 'yyyy-mm-dd',
                });
            } else {
                // If documents are missing, show the alert and do not open the modal
                Alert("Please upload all documents for KYC before proceeding with reimbursement.");
            }
        },
        error: function() {
            // Handle error if AJAX request fails
            Alert("An error occurred while checking the document status.");
        }
    });
}


let documentCounter = 1;

function addFileInput() {
    const container = document.getElementById('checkup_documents_container');
    
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2');

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.classList.add('form-control');
    fileInput.name = 'checkup_documents[]';
    fileInput.id = `checkup_documents_${documentCounter}`;

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-outline-danger');
    removeButton.textContent = '-';
    removeButton.onclick = function () {
        container.removeChild(inputGroup);
    };

    inputGroup.appendChild(fileInput);
    inputGroup.appendChild(removeButton);
    container.appendChild(inputGroup);

    documentCounter++;
}

// To retrieve files when submitting, gather all files from `checkup_documents[]` inputs
function getDocumentsArray() {
    const filesArray = [];
    const fileInputs = document.querySelectorAll("input[name='checkup_documents[]']");
    fileInputs.forEach(input => {
        if (input.files.length > 0) {
            filesArray.push(input.files[0]);  // Store each file object
        }
    });
    return filesArray;
}


function AddUpdateReimbursement() {
    // Input validation
    var policy_number = $("#policy_number").val();
    if (policy_number == "") {
        Alert("Please Enter Your Policy Number.");
        return false;
    }

    var hospital_name = $("#hospital_name").val();
    if (hospital_name == "") {
        Alert("Please Enter Hospital/Medical Name.");
        return false;
    }

    var checkup_date = $("#checkup_date").val();
    if (checkup_date == "") {
        Alert("Please Enter Checkup Date.");
        return false;
    }

    var checkup_cost = $("#checkup_cost").val();
    if (checkup_cost == "") {
        Alert("Please Enter Checkup Cost.");
        return false;
    }

    // Check if at least one document is uploaded, validate each file size and type
    const fileInputs = document.querySelectorAll("input[name='checkup_documents[]']");
    let fileSelected = false;
    const maxFileSize = 10 * 1024 * 1024; // 10 MB in bytes
    const allowedTypes = [
        'application/pdf', 
        'application/msword', 
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'image/jpeg',  // JPEG images
        'image/png',   // PNG images
        'image/jpg'    // JPG images
    ]; // PDF, DOC, DOCX

    for (let input of fileInputs) {
        if (input.files.length > 0) {
            fileSelected = true;
            for (let file of input.files) {
                // Check file size
                if (file.size > maxFileSize) {
                    Alert("Each document must be less than 10 MB. Please check your files and try again.");
                    return false;
                }
                // Check file type
                if (!allowedTypes.includes(file.type)) {
                    Alert("Only PDF or DOC files are allowed. Please upload valid documents.");
                    return false;
                }
            }
        }
    }

    if (!fileSelected) {
        Alert("Please upload at least one Checkup Document.");
        return false;
    }

    // Update button text to indicate loading
    $("#addUpdateReimbursementBtn").html("Please Wait..");

    // Create a new FormData object to handle file uploads
    let formData = new FormData(document.getElementById("reimbursement_form"));

    // Make AJAX request with FormData
    $.ajax({
        url: "action/add-update-reimbursement.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from converting data
        contentType: false,  // Set content type to false to let browser set it automatically
        success: function(data) {
            var response = JSON.parse(data);
            Alert(response.message);
            if (response.error == false) { 
                setTimeout(function() {
                    location.reload();
                }, 1500);
                $("#addUpdateReimbursementBtn").html("Add");
                $('#reimbursement_form')[0].reset();
            } else {
                $("#addUpdateReimbursementBtn").html("Add");
            }
        },
        error: function(xhr, status, error) {
            Alert("An error occurred while submitting the form. Please try again.");
            $("#addUpdateReimbursementBtn").html("Add");
        }
    });
    return false;
}
