function AddService() 
{
  $('#service_form')[0].reset();
  $("#form_action").val("Add");
  $("#add_service_modal").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#UserModalHeading").html("Add Service");
}
function AddUpdateService()
{
  var form_action = $("#form_action").val();
  var service_name = $("#service_name").val();
  if(service_name == ""){
      Alert("Please Enter Service Name");
      return false;
  }
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-update-service.php",
      type: "POST",
      data: $("#service_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              $('#view-services').DataTable().ajax.reload();
              $("#add_service_modal").modal("hide");
              $("#addUpdateBtn").html("Add");
              $('#service_form')[0].reset();
          }
          else
          {
            $("#addUpdateBtn").html("Add");
          }
      },
  });
  return false;
}
function UpdateService(ServiceID)
{
  $.post("ajax/get-service-details.php",
  {
    ServiceID: ServiceID
  },
  function (data, status) 
  {
      var response = JSON.parse(data);
      $("#service_name").val(response.ServiceName);
  });
  $("#form_action").val("Update");
  $("#form_id").val(ServiceID);
  $("#add_service_modal").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#UserModalHeading").html("Update Service");
}
