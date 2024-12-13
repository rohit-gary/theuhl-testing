function AddVisitingDoctor() 
{
  $('#visiting_doctor_form')[0].reset();
  $("#form_action").val("Add");
  $("#add_visiting_doctor_modal").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#UserModalHeading").html("Add Visiting Doctor");
}

function UpdateDoctor(DoctorID) {

  $.post("ajax/get-visiting-doctor-details.php",
  {
    DoctorID: DoctorID
  },
  function (data, status) 
  {
      var response = JSON.parse(data);
      $("#t_visiting_doctor_name").val(response.DoctorName);
      $("#t_visiting_doctor_email").val(response.Email);
      $("#t_visiting_doctor_phone_number").val(response.PhoneNumber);
  });
  $("#form_action").val("Update");
  $("#form_id").val(DoctorID);
  $("#add_visiting_doctor_modal").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#UserModalHeading").html("Update Visiting Doctor Details");
}

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


function AddUpdateVisitingDoctor()
{
  var form_action = $("#form_action").val();
  var t_visiting_doctor_name = $("#t_visiting_doctor_name").val();
  if(t_visiting_doctor_name == ""){
      Alert("Please Enter Name.");
      return false;
  }

  var t_visiting_doctor_email = $("#t_visiting_doctor_email").val();
  if(t_visiting_doctor_email != "")
  {
      if(isValidEmail(t_visiting_doctor_email) == false)
      {
        Alert("Please Enter Valid Email.");
        return false;
      }
  }
 
  var t_visiting_doctor_phone_number = $("#t_visiting_doctor_phone_number").val();
  if(t_visiting_doctor_phone_number == ""){
      Alert("Please Enter User Phone Number.");
      return false;
  }
  if(validaphone(t_visiting_doctor_phone_number) == false){
      Alert("Please Enter Valid Phone Number.");
      return false;
  }
  
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-update-visiting-doctor.php",
      type: "POST",
      data: $("#visiting_doctor_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              setInterval(function() {
                  location.reload();
              }, 1500);
              $("#addUpdateBtn").html("Submit");
              $('#visiting_doctor_form')[0].reset();
          }
          else
          {
            $("#addUpdateBtn").html("Add");
          }
      },
  });
  return false;
  
}

function DeleteVisitingDoctor(DoctorID) {
  alertify.confirm(
    "DWD",
    "Do you really want to delete Doctor Entry?",
    function () {
      $.post(
        "action/delete-visiting-doctor.php",
        {
          DoctorID: DoctorID
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

