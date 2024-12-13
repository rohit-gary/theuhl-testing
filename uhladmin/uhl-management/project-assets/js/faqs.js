$(document).ready(function () {
    var i = 1;
    $('#all_programs').dataTable({
         'responsive': true,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/view-all-faqs-post.php'
        },
        'columnDefs': [{
            "targets": [0],
            "className": "text-center"
        }],
        "order": [
            [1, 'asc']
        ],
        'columns': [{
            "data": "id",
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'Question'
        },
        {
            data: 'Answer'
        },
       
        {
            data: 'Action'
        }
        ]


    });
});

function isValidEmail(email) {
    // Regular expression to check if the email is valid
    var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;

    // Test the email against the regular expression
    return emailRegex.test(email);
}

function validaphone(phone) {
    var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    if (!regex.test(phone)) {
        return false;
    } else {
        return true;
    }
}


function validISNumber(basic) {
    const input = event.target;
    let value = input.value;

    value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
    input.value = value;
}



var editor;
function UpdateFaqs_modal(faq_id) {

    $("#addFaqsBtn").html("Update");
    $("#FaqsHeading").html("Update Faq Details");

    $.post("ajax/get_faqs_details.php", {
        ID: faq_id
    },
        function (data, status) {
            var response = JSON.parse(data);
            console.log(response.data);
            


                if (Array.isArray(response.data)) {
                    var faqData = response.data[0];  
                } else {
                    var faqData = response.data;
                }
            if (response.error == false) {
                $("#Question").val(faqData.Question);


                 if (!editor) {
                editor = new RichTextEditor("#Answer");
            }
                console.log('dsdss',editor);
                 editor.setHTMLCode(faqData.Answer);
                    $("#form_action").val("Update");
                    $("#form_id").val(faq_id);
            }
        });
    $("#add_faqs").modal("show");
}

function AddFaqs() {
    $("#faqs_form")[0].reset();
    $("#add_faqs").modal("show");
    $("#addFaqsBtn").html("Add");
    $("#FaqsHeading").html("Add Faqs");
    $("#form_id").val('-1');
  
    editor.setHTML(''); // Clear the editor content
}

function AddUpdateFaqsForm() {

    var Question = $("#Question").val();
    if (Question == "") {
        Alert("Please Enter  Question.");
        return false;
    }

    var Answer = $("#Answer").val();
    if (Answer == "") {
        Alert("Please Enter Answer.");
        return false;
    }
    
     
    let form_action = $("#form_action").val();
    let btntext = "";
    if (form_action == "add") {
        btntext = "Add";
    } else {
        btntext = "Update";
    }



    let myForm = document.getElementById("faqs_form");
    var formData = new FormData(myForm);
    console.log(formData);

    $("#addProgramsBtn").html("Please Wait..");
    $.ajax({
        url: "action/add-update-faqs.php",
        type: "POST",
        data: formData,
        success: function (data) {
            var response = JSON.parse(data);
            Alert(response.message);
            if (response.error == false) {
                $("#addFaqsBtn").html("Add");
                $('#faqs_form')[0].reset();
                $("#add_faqs").modal("hide");

                location.reload();
            }else{
                $("#addFaqsBtn").html(btntext);
            }
            $('#all_programs').DataTable().ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false,
    });
    return false;

}


function DeleteFaq(faq_id) {
    alertify.confirm(
        
        "Do you really want to delete Faqs?",
        function () {
            $.post(
                "action/delete-faq.php",
                {
                    ID: faq_id,
                },
                function (data, status) {
                    var response = JSON.parse(data);
                    Alert(response.message);
                    if (response.error == false) {
                        setInterval(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            );
        },
        function () {
            alertify.error("Deletion Cancelled");
        }
    );
}





