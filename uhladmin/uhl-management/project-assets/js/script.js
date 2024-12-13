function Alert(message) {
  alertify.alert("United Health Lumina", message).set({ transition: "fade" });
}
function isValidEmail(email) {
    // Regular expression to check if the email is valid
    var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;

    // Test the email against the regular expression
    return emailRegex.test(email);
}

function validatePhoneNumber(phoneNumber) {
    const regex = /^\(?([0-9]{3})\)?[-]?([0-9]{3})[-]?([0-9]{4})$/;
    return regex.test(phoneNumber);
}
function IsvalidNumber(inputElement) {
    // Get the value from the input
      var inputValue = inputElement.value;

      // Remove non-numeric characters using a regular expression
      var numericValue = inputValue.replace(/[^0-9]/g, '');

      // Update the input value with only numeric characters
      inputElement.value = numericValue;
}

