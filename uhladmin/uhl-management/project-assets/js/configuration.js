


function AddService() {
  $('#service_form')[0].reset();
  $("#form_action").val("Add");
  $("#add_service_modal").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#UserModalHeading").html("Add Service");
}



function AddUpdateService() {
  var form_action = $("#form_action").val();
  var service_name = $("#service_name").val();
  if (service_name == "") {
    Alert("Please Enter Service Name");
    return false;
  }
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
    url: "action/add-update-service.php",
    type: "POST",
    data: $("#service_form").serialize(),
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);
      if (response.error == false) {
        $("#add_service_modal").modal("hide");
        $("#addUpdateBtn").html("Add");
        $('#service_form')[0].reset();
        setInterval(function () {
          location.reload();
        }, 1500);
      }
      else {
        $("#addUpdateBtn").html("Add");
      }
    },
  });
  return false;
}
function UpdateService(ServiceID) {
  $.post("ajax/get-service-details.php",
    {
      ServiceID: ServiceID
    },
    function (data, status) {
      var response = JSON.parse(data);
      $("#service_name").val(response.ServiceName);
    });
  $("#form_action").val("Update");
  $("#form_id").val(ServiceID);
  $("#add_service_modal").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#UserModalHeading").html("Update Service");
}


function AddZone() {
  $('#zone_form')[0].reset();
  $("#zone_form_action").val("Add");
  $("#add_zone_modal").modal("show");
  $("#addUpdateZoneBtn").html("Add");
  $("#ZoneModalHeading").html("Add Zone");
}
function AddUpdateZone() {
  var zone_form_action = $("#zone_form_action").val();
  var zone_name = $("#zone_name").val();
  if (zone_name == "") {
    Alert("Please Enter Zone Name");
    return false;
  }
  $("#addUpdateZoneBtn").html("Please Wait..");
  $.ajax({
    url: "action/add-update-zone.php",
    type: "POST",
    data: $("#zone_form").serialize(),
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);
      if (response.error == false) {
        $("#add_zone_modal").modal("hide");
        $("#addUpdateZoneBtn").html("Add");
        $('#zone_form')[0].reset();
        setInterval(function () {
          location.reload();
        }, 1500);
      }
      else {
        $("#addUpdateZoneBtn").html("Add");
      }
    },
  });
  return false;
}
function UpdateZone(ZoneID) {
  $.post("ajax/get-zone-details.php",
    {
      ZoneID: ZoneID
    },
    function (data, status) {
      var response = JSON.parse(data);
      $("#zone_name").val(response.ZoneName);
      $("#zone_email").val(response.ZoneEmail);
    });
  $("#zone_form_action").val("Update");
  $("#zone_form_id").val(ZoneID);
  $("#add_zone_modal").modal("show");
  $("#addUpdateZoneBtn").html("Update");
  $("#ZoneModalHeading").html("Update Zone");
}


function AddDoctorsCat(){
   $('#doctor_cat_form')[0].reset();
  $("#form_doctorcat_action").val("Add");
  $("#add_doctor_cat_modal").modal("show");
  $("#addUpdateCatBtn").html("Add");
  $("#DoctorCatModalHeading").html("Add Category");
}

function AddUpdateDoctorCat(){
  var category=$('#cat_name').val();

  if(category==''){
    Alert("Please Enter Doctor's Category");
  }


  var CatImage = $('#CatImage')[0].files[0];

  if(!CatImage || CatImage==''){
    Alert("Please uploade Doctor's Category Images");
  }


   $('#addUpdateCatBtn').html('Please Wait..');

   var formData = new FormData();
   formData.append('cat_name', category);
   formData.append('CatImage', CatImage);
   formData.append('form_action', $('#form_doctorcat_action').val());
   formData.append('form_doctorcat_id', $('#form_doctorcat_id').val());

   $.ajax({
    url:'action/add-update-doctors-category.php',
    type:"POST",
    data:formData,
    contentType: false,
    processData: false,
    success:function(data){
      var response=JSON.parse(data);
      Alert(response.message);

      setTimeout(function(){
      
      if(response.error==false){
        $('#doctor_cat_form')[0].reset();
        location.reload();
      }

      },4000);
      
    }
   })

}

function UpdateDocCat(ID){
  $("#form_doctorcat_action").val("Update");
  $("#form_doctorcat_id").val(ID);
  $("#add_doctor_cat_modal").modal("show");
  $("#addUpdateCatBtn").html("Update");
  $("#DoctorCatModalHeading").html("Update Service");
  
  $.post("ajax/get-doc-cat-details.php",
    {
      ID: ID
    },
    function (data, status) {
      var response = JSON.parse(data);
      $("#cat_name").val(response.CategoryName);

       if (response.CatImage) {
                $("#CatImage_hidden").val(response.CatImage);  
                $("#CatImage_span").html("Current Image: " + response.CatImage); 
            } else {
                $("#CatImage_span").html("");  // No image
            }
    });
  
}


function AddTestCat(){
  $('#test_cat_form')[0].reset();
  $("#form_action").val("Add");
  $("#add_test_category_modal").modal("show");
  $("#addUpdateTestBtn").html("Add");
  $("#TestCategoryModalHeading").html("Add Test Category");
  $('#ImportTestBtn').html('Import Excel File');
}


function AddUpdateTestCategory(){
   var form_action = $("#form_action_test_cat").val();
  var Test_category_name = $("#test_category_name").val();
  if (Test_category_name == "") {
    Alert("Please Enter Test_category Name");
    return false;
  }
  $("#addUpdateTestBtn").html("Please Wait..");
  $.ajax({
    url: "action/add-update-test_category.php",
    type: "POST",
    data: $("#test_cat_form").serialize(),
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);
      if (response.error == false) {
        $("#add_test_category_modal").modal("hide");
        $("#addUpdateTestBtn").html("Add");
        $('#test_cat_form')[0].reset();
        setInterval(function () {
          location.reload();
        }, 1500);
      }
      else {
        $("#addUpdateTestBtn").html("Add");
      }
    },
  });
  return false;
}

function UpdateTestCat(ID){
   $("#form_action_test_cat").val("Update");
  $("#form_test_cat_id").val(ID);
  $("#add_test_category_modal").modal("show");
  $("#addUpdateTestBtn").html("Update");
  $("#TestCategoryModalHeading").html("Update Test Category");
  
  $.post("ajax/get-test-cat-details.php",
    {
      ID: ID
    },
    function (data, status) {
      var response = JSON.parse(data);
    
      $("#test_category_name").val(response.TestCategoryName);
    });
}


 function DeleteTestCat(ID) {
    $.post("action/delete-test-cat-details.php",
      { ID: ID },
      function (data, status) {
        var response = JSON.parse(data);
        Alert(response.message);
        if (response.error === false) {
          location.reload();
        }
      });
  }


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

function ImportTestCategory(){
 let myForm = document.getElementById("test_cat_form");
 var formData = new FormData(myForm);
 $('#ImportTestBtn').html('Import..... Excel File ');
 $.ajax({
  url:'action/import-test-category.php',
  type:'POST',
  data:formData,
  cache: false,
  contentType: false,
  processData: false,
  success:function(data){
    Alert(data);
  }
 })
  

}

