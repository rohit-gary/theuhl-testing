function AddCompany() {
  $("#add_company").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#CompanyHeading").html("Add Company");
}

function UpdateAddmisionPaymen() {
  $("#add_company").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#CompanyHeading").html("Update Company");
}

$("#view-company").DataTable({
  autoFill: true,
});


// function isValidEmail(email) {
//   // Regular expression to check if the email is valid
//   var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
  
//   // Test the email against the regular expression
//   return emailRegex.test(email);
// }

function validISNumber(basic) {
        const input = event.target;
        let value = input.value;

        value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters

        input.value = value;
    }


function AddUpdateSubAdmin(){
  var admission_payment_amount = $("#admission_payment_amount").val();

  if(admission_payment_amount == ""){
      Alert("Please Enter Admission Payment Amount.");
      return false;
  }

  
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-admission-payment.php",
      type: "POST",
      data: $("#admission_payment_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert("Alert!", response.message);
          if (response.error == false) {
              setInterval(function() {
                  location.reload();
              }, 1500);
              $("#addUpdateBtn").html("Submit");
              $('#admission_payment_form')[0].reset();
          }
      },
  });
    return false;
  
}
