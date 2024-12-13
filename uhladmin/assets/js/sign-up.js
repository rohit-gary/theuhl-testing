var Submit_input = document.getElementById("businessemail");
Submit_input.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("sign_up_btn").click();
    }
});

var Submit_btn = document.getElementById("sign_up_btn");
Submit_btn.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("sign_up_btn").click();
    }
});

function validateEmail(emailField) {
    var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (reg.test(emailField.value) == false) {
        return false;
    }

}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
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


function isValidURL(webAddress) {
    if (webAddress.indexOf(".") !== -1) { // Check if there is at least one dot
        const parts = webAddress.split(".");
        const lastPart = parts[parts.length - 1];
        if (lastPart.length >= 2) { // Check if the last part has at least 2 characters
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function NextStep() {

    var email = document.getElementById("businessemail").value;
    // if (isValidEmail(email)) {
    //     var parts = email.split('@');
    //     if (parts[1].toLowerCase() == 'gmail.com' || parts[1].toLowerCase() == 'yahoo.com' || parts[1].toLowerCase() ==
    //         'hotmail.com' || parts[1].toLowerCase() == 'yahoo.co.in' || parts[1].toLowerCase() == 'hotmail.co.uk' ||
    //         parts[1].toLowerCase() == 'aol.com' || parts[1].toLowerCase() == 'yahoo.in' || parts[1].toLowerCase() ==
    //         'yopmail.com') {
    //         alertify.alert("Alert!", "Please use business email only to register");
    //         return false;
    //     }
    // } else {
    //     alertify.alert("Alert!", "Please enter valid business email");
    //     return false;
    // }

    if (!isValidEmail(email)) {
        alertify.alert("Alert!", "Please enter valid email");
        return false;
    } 


    $.ajax({
        url: "action/sign-up-action.php",
        type: "POST",
        data: $("#sign_up_form").serialize(),
        success: function (data) {

            var response = JSON.parse(data);

            if (response.error == false) {
                $("#sign_up_id").val(response.sign_up_id);
                document.getElementById("company_details").style.display = "block";
                document.getElementById("signup_form").style.display = "none";
            } else {
                alertify.alert("Alert!", response.message);
            }

        }

    });
}

function Register() {
    var name = document.getElementById("name").value;
    if (name == "") {
        alertify.alert("Alert!", "Please Enter Your Full Name");
        return false;
    }

    var phonenumber = document.getElementById("phonenumber").value;
    if (phonenumber == "") {
        alertify.alert("Alert!", "Please Enter Phone Number");
        return false;
    } else {
        if (!validaphone(phonenumber)) {
            alertify.alert("Alert!", "Please Enter Valid Phone Number");
            return false;
        }
    }

    var companyname = document.getElementById("companyname").value;
    if (companyname == "") {
        alertify.alert("Alert!", "Please Enter Company Name");
        return false;
    }

    var product = document.getElementById("product").value;
    if (product == "") {
        alertify.alert("Alert!", "Please Select Product");
        return false;
    }

    $("#sign_up_btn").html("Please Wait...");
    $.ajax({
        url: "action/register-action.php",
        type: "POST",
        data: $("#company_details_form").serialize(),
        success: function (data) {

            var response = JSON.parse(data);
            $("#sign_up_btn").html("Register");
            if (response.error == false) {
                alertify.alert("Alert!", response.message);
                document.getElementById("company_details").style.display = "none";
                document.getElementById("signup_form").style.display = "block";
                setInterval(function () {
                    window.location.href = "http://digitalworkdesk.com/";
                }, 3000);
                
            } else {
                alertify.alert("Alert!", response.message);
                
            }

        }

    });
}