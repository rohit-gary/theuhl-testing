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
  var test_type = $("#test_code").val();
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

       var testPackageCategoryArray = response.TestCategory.split(",");
      $("#test_cat").val(testPackageCategoryArray).change();

      $("#test_code").val(response.TestCode);

      $("#test_fee").val(response.TestFee);
    });
}



function AddTestPackage()
{
  $('#test_Package_form')[0].reset();
  $("#form_action_test_Package").val("Add");
  $("#add_test_Package_modal").modal("show");
  $("#addUpdatePackageBtn").html("Add");
  $("#TestPackageModalHeading").html("Add Test Package");
}


function AddUpdateTestPackage()
{

  var form_action = $("#form_action_test_Package").val();
  var test_Package_name = $("#test_Package_name").val();
  var test_Package_cat = $("#test_Package_cat").val();
  var package_test_name = $("#package_test_name").val();
  var test_Package_type = $("#test_Package_code").val();
  var test_Package_fee = $("#test_Package_fee").val();

  
  if (test_Package_name.trim() === "") {
    Alert("Please Enter Test Package Name");
    return false;
  }

 


  if (!package_test_name || package_test_name.length === 0) 
    {
    Alert("Please Select at Least One Package Test Name");
    return false;
    }

  if (test_Package_type.trim() === "") {
    Alert("Please Enter Test Package Type");
    return false;
  }

  if (test_Package_fee.trim() === "" || isNaN(test_Package_fee)) {
    Alert("Please Enter a Valid Test Package Fee");
    return false;
  }

  // Indicate loading
  $("#addUpdateTBtn").html("Please Wait...").attr("disabled", true);

  // AJAX request
  $.ajax({
    url: "action/add-update-doc-test_package.php",
    type: "POST",
    data: $("#test_Package_form").serialize(),
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);

      if (response.error === false) {
        // Close modal and reset form
        $("#add_test_Package_modal").modal("hide");
        $("#addUpdatePackageBtn").html("Add").attr("disabled", false);
        $("#test_Package_form")[0].reset();

        // Reload page after a short delay
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        $("#addUpdatePackageBtn").html("Add").attr("disabled", false);
      }
    },
    error: function () {
      Alert("An error occurred while processing the request.");
      $("#addUpdatePackageBtn").html("Add").attr("disabled", false);
    },
  });

  return false; // Prevent form submission
}

function UpdateTestPackage(ID)
{ 
  $("#form_action_test_Package").val("Update");
  $("#form_test_Package_id").val(ID);
  $("#add_test_Package_modal").modal("show");
  $("#addUpdatePackageBtn").html("Update");
  $("#TestPackageModalHeading").html("Update Test Package");
  
  $.post("ajax/get-test-package_details.php",
    {
      ID: ID
    },
    function (data, status) {
      var response = JSON.parse(data);

      
      var testPackageCategoryArray = response.TestPackageCategory.split(",");
      var packageTestNameArray =    response.PackageTestName.split(",");
        
        // Set the values for multi-select fields
      $("#test_Package_cat").val(testPackageCategoryArray).change();
      $("#package_test_name").val(packageTestNameArray).change();
      $("#test_Package_name").val(response.TestPackageName);

      // $("#test_Package_cat").val(response.TestPackageCategory);

      // $("#package_test_name").val(response.PackageTestName);

      $("#test_Package_code").val(response.TestPackageCode);

      $("#test_Package_fee").val(response.TestPackageFee);
    });
}


function DeleteTestPackage(ID){
    $.post("action/delete-test-package-details.php",
      { ID: ID },
      function (data, status) {
        var response = JSON.parse(data);
        Alert(response.message);
        if (response.error== false) {
          location.reload();
        }
      });
}