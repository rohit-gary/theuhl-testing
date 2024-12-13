$('#partner_account_manager').select2();
$('#view-contact').DataTable({
    autoFill: true
});

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
function IsvalidNumber(basic) {
    const input = event.target;
    let value = input.value;

    value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters

    input.value = value;
}

function ExportScholarshipEnquiryData() {
    $.ajax({
        url: "action/export-scholarship-enquiry.php",
        type: "POST",
        data: $("#export_fillter_form").serialize(),
        success: function (data) {

          var xlsFilePath = './report.xls';

          var anchor = document.createElement("a");
          anchor.href = xlsFilePath;
          anchor.download = 'all-scholarship-enquiry-data.xls';
          anchor.click();
        },
    });
    return false;
}


function ExportBookletEnquiryData() {
    $.ajax({
        url: "action/export-booklet-enquiry.php",
        type: "POST",
        data: $("#export_fillter_form").serialize(),
        success: function (data) {

          var xlsFilePath = './report.xls';

          var anchor = document.createElement("a");
          anchor.href = xlsFilePath;
          anchor.download = 'all-booklet-enquiry-data.xls';
          anchor.click();
        },
    });
    return false;
}

function ExportMSLVEnquiryData() {
    $.ajax({
        url: "action/export-mslv-enquiry.php",
        type: "POST",
        data: $("#export_fillter_form").serialize(),
        success: function (data) {

          var xlsFilePath = './report.xls';

          var anchor = document.createElement("a");
          anchor.href = xlsFilePath;
          anchor.download = 'all-mslv-enquiry-data.xls';
          anchor.click();
        },
    });
    return false;
}

function ExportMentorshipEnquiryData() {
    $.ajax({
        url: "action/export-mentorship-enquiry.php",
        type: "POST",
        data: $("#export_fillter_form").serialize(),
        success: function (data) {

          var xlsFilePath = './report.xls';

          var anchor = document.createElement("a");
          anchor.href = xlsFilePath;
          anchor.download = 'all-mentorship-enquiry-data.xls';
          anchor.click();
        },
    });
    return false;
}

function OpenLead_modal(){
     $("#assigned_modal").addClass("show");
     // $("#assigned_modal").modal("show");
     // const offcanvasElementList = document.getElementById('assigned_modal')
     // const offcanvasList = [...offcanvasElementList].map(offcanvasEl => new bootstrap.Offcanvas(offcanvasEl))
}

function CloseLead_modal(){
     $("#assigned_modal").removeClass("show");
     // $("#assigned_modal").modal("hide");
     // $(".modal-backdrop").removeClass("show");
}