function validISNumber(basic) {
    const input = event.target;
    let value = input.value;

    value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters

    input.value = value;
}

function email_check(customer_email) {
    var regex =
        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(customer_email)) {
        return false;
    } else {
        return true;
    }
}

function validaphone(phone) {
    var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    if (!regex.test(phone)) {
        return false;
    } else {
        return true;
    }
}

function SubmitContactForm() {
    var name = document.getElementById("Name").value;
    if (name == "") {
        alertify.alert("Webo.Ai", "Please Enter Name");
        return false;
    }

    var email = document.getElementById("Email").value;
    if (email_check(email) == false) {
        alertify.alert("Webo.Ai", "Please Enter Valid Email");
        return false;
    }



    $("#contact_form_btn").html("Please Wait..");
    $.ajax({
        url: "action/contact-action.php",
        type: "POST",
        data: $("#contact_form").serialize(),
        success: function (data) {
            var response = JSON.parse(data);
            alertify.alert("Webo.Ai", response.message);
            if (response.error == false) {
                setInterval(function () {
                    location.reload();
                }, 3000);
            }
        },
    });
    return false;
}