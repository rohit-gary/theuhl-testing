function AddUser() 
{
  $('#user_form')[0].reset();
  $('#user_username').prop('readonly', false);
  $("#modal_password_field").show();
  $("#modal_confirm_password_field").show();
  $("#form_action").val("Add");
  $("#add_user").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#UserModalHeading").html("Add User");
}

function UpdateUser(UserID) {

  $("#modal_password_field").hide();
  $("#modal_confirm_password_field").hide();
  $.post("ajax/get-user-details.php",
  {
    UserID: UserID
  },
  function (data, status) 
  {
      var response = JSON.parse(data);
      $("#user_name").val(response.Name);
      $("#user_username").val(response.UserName);
      $("#user_email").val(response.Email);
      $('#user_username').prop('readonly', true);
      $("#user_phone_number").val(response.PhoneNumber);
      $("#user_aadhar").val(response.Aadhar);
      $("#user_pan").val(response.PAN);
      $("#user_pan").val(response.PAN);
      $("#user_type").val(response.Role);
      $("#ta_address").val(response.Address);
  });
  $("#form_action").val("Update");
  $("#form_id").val(UserID);
  $("#add_user").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#UserModalHeading").html("Update User");
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


function AddUpdateUser()
{
  var form_action = $("#form_action").val();
  var user_name = $("#user_name").val();
  if(user_name == ""){
      Alert("Please Enter Name");
      return false;
  }

  var user_username = $("#user_username").val();
  if(user_username == ""){
      Alert("Please Enter Username");
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

  if(form_action != "Update")
  {
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
  }

  var user_type = $("#user_type").val();
  if(user_type == ""){
      Alert("Please Select User Type");
      return false;
  }
  
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-update-user.php",
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
    "DWD",
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

function ResetPassword(userEmail)
{
  $("#rp_user_email").val(userEmail);
  $("#reset_password_modal").modal("show");
}
function ResetPasswordAction()
{
  var password = $("#r_password").val();
  if(password == ""){
      ProductAlert("Please Enter User Password");
      return false;
  }

  var confirm_password = $("#r_confirm_password").val();
  if(confirm_password == ""){
      ProductAlert("Please Enter Confirm Password");
      return false;
  }
  if(password !== confirm_password)
  {
      ProductAlert("Password and Confirm Password doesn't match");
      return false;
  }
  $("#resetpasswordBtn").html("Please Wait..");
  $.ajax({
      url: "action/reset_password.php",
      type: "POST",
      data: $("#reset_password_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              $("#resetpasswordBtn").html("Submit");
              $('#reset_password_form')[0].reset();
              $("#reset_password_modal").modal("hide");
          }
          else
          {
            $("#resetpasswordBtn").html("Add");
          }
      },
  });
  return false;
}