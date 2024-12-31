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

  console.log(test_cat);
  // Input validation
  if (test_name.trim() === "") {
    Alert("Please Enter Test Name");
    return false;
  }

 if (!test_cat || test_cat.length === 0) {
    Alert("Please Select at Least One Test Category");
    return false;
}

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
    url: "action/add-update-doc-test.php",
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


function DeleteTest(ID){
    $.post("action/delete-test-details.php",
      { ID: ID },
      function (data, status) {
        var response = JSON.parse(data);
        Alert(response.message);
        if (response.error === false) {
          location.reload();
        }
      });
}



function UpdateTest(ID){
   $("#form_action_test").val("Update");
  $("#form_test_id").val(ID);
  $("#add_test_modal").modal("show");
  $("#addUpdateTBtn").html("Update");
  $("#TestModalHeading").html("Update Test");
  
  $.post("ajax/get-test-details.php",
    {
      ID: ID
    },
    function (data, status) {
      var response = JSON.parse(data);
    
      $("#test_name").val(response.TestName);

      $("#test_cat").val(response.TestCategory);

      $("#test_type").val(response.TestType);

      $("#test_fee").val(response.TestFee);
    });
}



function AddTestPackage(){
   $('#test_Package_form')[0].reset();
  $("#form_action_test_Package").val("Add");
  $("#add_test_Package_modal").modal("show");
  $("#addUpdatePackageBtn").html("Add");
  $("#TestPackageModalHeading").html("Add Test");
}