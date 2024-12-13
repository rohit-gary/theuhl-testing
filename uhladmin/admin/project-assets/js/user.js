function AddUser() 
{
  $("#add_user").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#UserModalHeading").html("Add User");
}

function UpdateUser() {
  $("#add_user").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#UserModalHeading").html("Update User");
}

$("#view-users").DataTable({
  autoFill: true,
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


function AddUpdateUser(){
  var user_name = $("#user_name").val();

  if(user_name == ""){
      Alert("Please Enter User Name.");
      return false;
  }


  var user_email = $("#user_email").val();

  if(user_email == ""){
      Alert("Please Enter User Email.");
      return false;
  }

  if(isValidEmail(user_email) == false){
      Alert("Please Enter Valid Email.");
      return false;
  }

  var user_phone_number = $("#user_phone_number").val();

  if(user_phone_number == ""){
      Alert("Please Enter User Phone Number.");
      return false;
  }

  if(validaphone(user_phone_number) == false){
      Alert("Please Enter Valid Phone Number.");
      return false;
  }

  var password = $("#password").val();
  if(password == ""){
      Alert("Please Enter User Password");
      return false;
  }

  var confirm_password = $("#confirm_password").val();
  if(confirm_password == ""){
      Alert("Please Enter Confirm Password");
      return false;
  }

  if(password !== confirm_password)
  {
      Alert("Password and Confirm Password doesn't match");
      return false;
  }


  var modules_id = $("#modules_id").val();
  if(modules_id == ""){
      Alert("Please Select Module");
      return false;
  }

  var organization_id = $("#organization_id").val();
  if(organization_id == ""){
      Alert("Please Select Organization");
      return false;
  }

  var user_type = $("#user_type").val();
  if(user_type == ""){
      Alert("Please Enter User Type");
      return false;
  }

  
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-user.php",
      type: "POST",
      data: $("#user_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              setInterval(function() {
                  location.reload();
              }, 1500);
              $("#addUpdateBtn").html("Submit");
              $('#user_form')[0].reset();
          }
          else
          {
            $("#addUpdateBtn").html("Add");
          }
      },
  });
  return false;
  
}


function DeleteUser(User_id) {
  alertify.confirm(
    "LAMS",
    "Do you really want to delete User?",
    function () {
      $.post(
        "action/delete-user.php",
        {
          ID: User_id,
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