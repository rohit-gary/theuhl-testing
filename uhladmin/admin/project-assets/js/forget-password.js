
function isValidEmail(email) {
  // Regular expression to check if the email is valid
  var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
  
  // Test the email against the regular expression
  return emailRegex.test(email);
}

function ForgetPassword()
{
    var email = $("#email").val();
    if (!isValidEmail(email)) {
      Alert("Please enter valid email address");
      return false;
    } 

    return true;

}
