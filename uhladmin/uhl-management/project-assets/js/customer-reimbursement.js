function AddReimbursement(policyID) {
    $.ajax({
        url: 'action/check-kyc-documents-status.php',
        type: 'GET',
        data: {
            policyID: policyID
        },
        success: function (response) {
            var responseData = JSON.parse(response);

            if (responseData.error === false) {
                $('#reimbursement_form')[0].reset();
                $("#form_action").val("Add");
                $("#add_remibursement").modal("show");
                $("#addUpdateReimbursementBtn").html("Add");
                $("#CustomerRemibursementModalHeading").html("Add Reimbursement");


                const currentDate = new Date();
                const formattedDate = currentDate.toISOString().split('T')[0];
                $("#hospital_name").val(formattedDate);
                $("#checkup_date").val(formattedDate);

                $('#employee_dateform').datepicker({
                    format: 'yyyy-mm-dd',
                });

                $('#checkup_date').datepicker({
                    format: 'yyyy-mm-dd',
                });
            } else {
                alertify.error("Please upload all documents for KYC before proceeding with reimbursement.");
            }
        },
        error: function () {
            alertify.error("An error occurred while checking the document status.");
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

function getDocumentsArray() {
    const filesArray = [];
    const fileInputs = document.querySelectorAll("input[name='checkup_documents[]']");
    fileInputs.forEach(input => {
        if (input.files.length > 0) {
            filesArray.push(input.files[0]);
        }
    });
    return filesArray;
}


function AddUpdateReimbursement() {
    var policy_number = $("#policy_number").val();
    if (policy_number == "") {
        alertify.error("Please Enter Your Policy Number.");
        return false;
    }

    var hospital_name = $("#hospital_name").val();
    if (hospital_name == "") {
        alertify.error("Please Enter Hospital/Medical Name.");
        return false;
    }

    var checkup_date = $("#checkup_date").val();
    if (checkup_date == "") {
        alertify.error("Please Enter Checkup Date.");
        return false;
    }

    var checkup_cost = $("#checkup_cost").val();
    if (checkup_cost == "") {
        alertify.error("Please Enter Checkup Cost.");
        return false;
    }

    const fileInputs = document.querySelectorAll("input[name='checkup_documents[]']");
    let fileSelected = false;
    const maxFileSize = 10 * 1024 * 1024;
    const allowedTypes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'image/jpeg',
        'image/png',
        'image/jpg'
    ];

    for (let input of fileInputs) {
        if (input.files.length > 0) {
            fileSelected = true;
            for (let file of input.files) {
                if (file.size > maxFileSize) {
                    alertify.error("Each document must be less than 10 MB. Please check your files and try again.");
                    return false;
                }
                if (!allowedTypes.includes(file.type)) {
                    alertify.error("Only PDF or DOC files are allowed. Please upload valid documents.");
                    return false;
                }
            }
        }
    }

    if (!fileSelected) {
        alertify.error("Please upload at least one Checkup Document.");
        return false;
    }

    $("#addUpdateReimbursementBtn").html("Please Wait..");

    let formData = new FormData(document.getElementById("reimbursement_form"));

    $.ajax({
        url: "action/add-update-reimbursement.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            var response = JSON.parse(data);
            if (response.error == false) {
                alertify.success(response.message);
                setTimeout(function () {
                    location.reload();
                }, 1500);
                $("#addUpdateReimbursementBtn").html("Add");
                $('#reimbursement_form')[0].reset();
            } else {
                alertify.error(response.message);
                $("#addUpdateReimbursementBtn").html("Add");
            }
        },
        error: function (xhr, status, error) {
            alertify.error("An error occurred while submitting the form. Please try again.");
            $("#addUpdateReimbursementBtn").html("Add");
        }
    });
    return false;
}

function DeleteReimbursement(id) {
    alertify.confirm("Delete Reimbursement",
        "Are you sure you want to delete this reimbursement record?",
        function () {
            $.ajax({
                url: "action/delete-reimbursement.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function (response) {
                    try {
                        var result = JSON.parse(response);
                        if (result.error === false) {
                            alertify.success(result.message);
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            alertify.error(result.message || "Error deleting reimbursement record");
                        }
                    } catch (e) {
                        alertify.error("Error processing server response");
                    }
                },
                error: function () {
                    alertify.error("Error connecting to server");
                }
            });
        },
        function () {
            alertify.error("Delete cancelled");
        }
    );
}



// Show rejection comment box
function showRejectComment() {
    document.getElementById('rejectCommentBox').style.display = 'block';
}

// Update reimbursement status
function updateStatus(newStatus) {
    const comment = newStatus === 'Rejected' ? document.getElementById('rejectComment').value : '';

    if (newStatus === 'Rejected' && !comment.trim()) {
        alertify.error("Please provide a rejection reason");
        return;
    }

    alertify.confirm("Update Status",
        "Are you sure you want to " + newStatus.toLowerCase() + " this reimbursement?",
        function () {
            $.ajax({
                url: 'action/update-reimbursement-status.php',
                type: 'POST',
                data: {
                    ReimbursementID: $('#reimbursementId').val(),
                    Status: newStatus,
                    Comment: comment
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        window.location.reload();
                    } else {
                        alertify.error("Error updating status: " + (response.message || "Unknown error"));
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error details:", {
                        status: status,
                        error: error,
                        response: xhr.responseText
                    });
                    alertify.error("Error updating status");
                }
            });
        },
        function () {
            alertify.error("Status update cancelled");
        }
    );
}
