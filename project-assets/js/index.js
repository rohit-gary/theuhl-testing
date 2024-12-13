function validaphone(phone) {
    var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    return regex.test(phone);
}

function Submitenquiry(event) {
    event.preventDefault();

    var name = document.getElementById('needformName').value;
    if (name == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter Your Name',
        });
        return false;
    }

    var mobileNumber = document.getElementById('needformMobile').value;
    if (mobileNumber == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter Your Mobile Number',
        });
        return false;
    }

    if (!validaphone(mobileNumber)) {
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Phone Number',
            text: 'Please Enter a Valid Phone Number',
        });
        return false;
    }

    var plan = document.getElementById('planSelect').value;
    if (plan == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Select Any Plan',
        });
        return false;
    }

    let myForm = document.getElementById("tte-review-form");
    var formData = new FormData(myForm);

    $.ajax({
        url: 'mail/send-mail-enquiry.php',
        type: 'POST',
        data: formData,
        processData: false,  
        contentType: false,
        success: function (data) {
            var response = JSON.parse(data);
            Swal.fire({
                icon: response.error ? 'error' : 'success',
                title: response.error ? 'Error' : 'Success',
                text: response.message,
            });
            
           
            if (response.error == false) {
                setTimeout(function(){
                location.reload();
            },2000);
            }
        },
    });

    return false;
}

document.getElementById("tte-review-form").addEventListener("submit", Submitenquiry);


function Submitenquiry_2(event) {
    event.preventDefault();

    var name = document.getElementById('needformName_second').value;
    if (name == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter Your Name',
        });
        return false;
    }

    var mobileNumber = document.getElementById('needformMobile_second').value;
    if (mobileNumber == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter Your Mobile Number',
        });
        return false;
    }

    if (!validaphone(mobileNumber)) {
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Phone Number',
            text: 'Please Enter a Valid Phone Number',
        });
        return false;
    }

    var plan = document.getElementById('planSelect_second').value;
    if (plan == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Select Any Plan',
        });
        return false;
    }

    let myForm = document.getElementById("tte-review-form_second");
    var formData = new FormData(myForm);

    $.ajax({
        url: 'mail/send-mail-enquiry.php',
        type: 'POST',
        data: formData,
        processData: false,  
        contentType: false,
        success: function (data) {
            var response = JSON.parse(data);
            Swal.fire({
                icon: response.error ? 'error' : 'success',
                title: response.error ? 'Error' : 'Success',
                text: response.message,
            });
            
           
            if (response.error == false) {
                setTimeout(function(){
                location.reload();
            },2000);
            }
        },
    });

    return false;
}

document.getElementById("tte-review-form").addEventListener("submit", Submitenquiry_2);



  function scrollToSection() {
    window.location.href = 'all-plans.php';  // Redirects to all-plans.php
  }