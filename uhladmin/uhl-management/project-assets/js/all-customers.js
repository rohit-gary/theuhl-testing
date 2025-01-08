function GetCustomerDetails(ID)
{
    
     $.post("ajax/get-customer-details.php",
    {
        ID: ID,
    },
    function (data, status) 
    {
        var response = JSON.parse(data);
        localStorage.setItem('currentStep', response.step);
        window.location.href = "add-policy-customer-new";
    }
    ).fail(function (xhr, status, error) {
        
        alertify.error("An error occurred while preparing the document.");
    });
}