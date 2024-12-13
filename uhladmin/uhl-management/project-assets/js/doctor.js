$(document).ready(function () {
    var i = 1;
    $('#all_Doctors').dataTable({
        'responsive': true,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/view-all-Doctors-post.php'
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
            data: 'DoctorImage'
        },
        {
            data: 'DoctorName'
        },
        {
            data: 'PhoneNumber'
        },
        {
            data: 'DoctorDetails'
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


function AddDoctors() {
    $("#Doctors_form")[0].reset();
    $("#add_Doctors").modal("show");
    $("#addDoctorsBtn").html("Add");
    $("#DoctorsHeading").html("Add Doctor");
    $("#form_id").val('-1');
    $("#DoctorImage_span").html('');
    
}

var DoctorDescription;
var DoctorHighlights;
function UpdateDoctor_modal(Doctors_id) {

    $("#addDoctorsBtn").html("Update");
    $("#DoctorsHeading").html("Update Doctor Details");

    $.post("ajax/get_Doctor_details.php", {
        ID: Doctors_id
    },
        function (data, status) {
            var response = JSON.parse(data);
           
             if (Array.isArray(response.data)) {
                    var DoctorData = response.data[0];  
                } else {
                    var DoctorData = response.data;
                }
                 console.log(DoctorData); 
            if (response.error == false) {
                $("#DoctorImage_hidden").val(DoctorData.DoctorImage);
                $("#DoctorImage_span").html(DoctorData.DoctorImage);
                $("#DoctorImage_span").css("display","block");

                $("#Name").val(DoctorData.DoctorName);
                $("#Gender").val(DoctorData.Gender);
                $("#email").val(DoctorData.Email);
                $("#phoneNumber").val(DoctorData.PhoneNumber);
                 $("#address").val(DoctorData.Address);
                 $("#medicalDegrees").val(DoctorData.MedicalDegrees);

                    $("#specialization").val(DoctorData.Specialization);
                    $("#licenseNumber").val(DoctorData.LicenseNumber);
                    $("#licenseExpiryDate").val(DoctorData.LicenseExpiryDate);    
                    $("#fee").val(DoctorData.Fee);

    

                $("#form_action").val("Update");
                $("#form_id").val(Doctors_id);
            }
        });
    $("#add_Doctors").modal("show");
}


function AddUpdateDoctorsForm() {

    var Name = $("#Name").val();
    if (Name == "") {
        Alert("Please Enter Doctors Name.");
        return false;
    }


    var Gender = $("#Gender").val();
    if (Gender == "") {
        Alert("Please Enter Doctors Gender.");
        return false;
    }

    var phoneNumber=$("#phoneNumber").val();
    if(phoneNumber==''){
        Alert("Please Enter Phone Number.");
        return false;
    }

    var email=$("#email").val();
    if(email==''){
        Alert("Please Enter Doctor Email.");
        return false;
    }

    var medicalDegrees=$("#medicalDegrees").val();
    if(medicalDegrees==''){
        Alert("Please Enter Doctor Medical Degrees.");
        return false;
    }
     

   let form_action = $("#form_action").val();
    let btntext = "";
    if (form_action == "add") {
        btntext = "Add";
    } else {
        btntext = "Update";
    }



    let myForm = document.getElementById("Doctors_form");
    var formData = new FormData(myForm);

    $("#addDoctorsBtn").html("Please Wait..");
    $.ajax({
        url: "action/add-update-Doctors.php",
        type: "POST",
        data: formData,
        success: function (data) {
            var response = JSON.parse(data);
            console.log(response.data);
            Alert(response.message);
            if (response.error == false) {
                $("#addDoctorsBtn").html("Add");
                $('#Doctors_form')[0].reset();
                $("#add_Doctors").modal("hide");
            }else{
                $("#addDoctorsBtn").html(btntext);
            }
            $('#all_Doctors').DataTable().ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false,
    });
    return false;

}


function DeleteDoctor(Doctors_id) {
   alertify.confirm(
        "Do you really want to delete Doctors?",
        function () {
            $.post(
                "action/delete-Doctor.php",
                {
                    ID: Doctors_id,
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


