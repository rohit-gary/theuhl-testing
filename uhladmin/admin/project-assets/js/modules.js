    $(document).ready(function() {
        var i = 1;
        $('#modules_table').dataTable({
            'responsive': true,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajax/view_all_modules_post.php'
            },
            'columnDefs': [{
                "targets": [0],
                "className": "text-center"
            }],
            "order": [
                [1, 'asc']
            ],
            'columns': [{
                "data": "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'ModulesName'
                },
                {
                    data: 'Action'
                }
            ]
        });
    });

function AddModules(){
  $("#modules_form")[0].reset();
  $("#add_modules").modal("show");
  $("#addModulesBtn").html("Add");
  $("#ModulesHeading").html("Add Modules");
  $("#form_id").val('-1');
}


function UpdateModules_modal(modules_id){
    $("#addModulesBtn").html("Update");
    $("#ModulesHeading").html("Update Modules");

    $.post("action/get_modules_details.php", {
            ID: modules_id
        },
        function(data, status) {
            var response = JSON.parse(data);
            if(response.error == false)
            {
                var modulesname = response.data.ModulesName;
                $("#modulesname").val(modulesname);
                $("#form_action").val("Update");
                $("#form_id").val(modules_id);
            }
        });
    $("#add_modules").modal("show");
}

function AddUpdateModulesForm()
{
  var modulesname = $("#modulesname").val();
  if(modulesname == ""){
      Alert("Please enter Module Name");
      return false;
  }

  let myForm = document.getElementById("modules_form");
  var formData = new FormData(myForm);

  $("#addModulesBtn").html("Please Wait..");
  $.ajax({
      url: "action/modules-form-action.php",
      type: "POST",
      data: formData,
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
                $("#add_modules").modal("hide");
                $("#addModulesBtn").html("Add");
                $('#modules_form')[0].reset();
                $('#modules_table').DataTable().ajax.reload();
          }
      },
    cache: false,
    contentType: false,
    processData: false,
  });
    return false;
  
}


function DeleteModules(district_id) {
  alertify.confirm(
    "DWD",
    "Do you really want to delete Modules?",
    function () {
      $.post(
        "action/delete_modules.php",
        {
          ID: district_id,
        },
        function (data, status) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
            setInterval(function () {
              location.reload();
            }, 2000);
          }
        }
      );
    },
    function () {
      alertify.error("Deletion Cancelled");
    }
  );
}


function ExportModulesData() {
    $.ajax({
        url: "action/export-modules.php",
        type: "POST",
        
        success: function (data) {

          var xlsFilePath = './report.xls';

          var anchor = document.createElement("a");
          anchor.href = xlsFilePath;
          anchor.download = 'all-modules-data.xls';
          anchor.click();
        },
    });
    return false;
}