function AddTest(){
  $('#test_form')[0].reset();
  $("#form_action_test").val("Add");
  $("#add_test_modal").modal("show");
  $("#addUpdateTBtn").html("Add");
  $("#TestModalHeading").html("Add Test");
  }


function AddUpdateTest() {
  var form_action = $("#form_action_test").val();
  var test_name = $("#test_name").val();
  var test_cat = $("#test_cat").val();
  var test_type = $("#test_type").val();
  var test_fee = $("#test_fee").val();

  // Input validation
  if (test_name.trim() === "") {
    Alert("Please Enter Test Name");
    return false;
  }

  // if (test_cat.trim() == "" || test_cat.trim() == " ") {
  //   Alert("Please Select a Test Category");
  //   return false;
  // }

  if (test_type.trim() === "") {
    Alert("Please Enter Test Type");
    return false;
  }

  if (test_fee.trim() === "" || isNaN(test_fee)) {
    Alert("Please Enter a Valid Test Fee");
    return false;
  }

  // Indicate loading
  $("#addUpdateTBtn").html("Please Wait...").attr("disabled", true);

  // AJAX request
  $.ajax({
    url: "action/add-update-test_category.php",
    type: "POST",
    data: $("#test_form").serialize(),
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);

      if (response.error === false) {
        // Close modal and reset form
        $("#add_test_modal").modal("hide");
        $("#addUpdateTBtn").html("Add").attr("disabled", false);
        $("#test_form")[0].reset();

        // Reload page after a short delay
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        $("#addUpdateTBtn").html("Add").attr("disabled", false);
      }
    },
    error: function () {
      Alert("An error occurred while processing the request.");
      $("#addUpdateTBtn").html("Add").attr("disabled", false);
    },
  });

  return false; // Prevent form submission
}
