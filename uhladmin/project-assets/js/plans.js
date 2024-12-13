 $(document).ready(function() {
    // Button click event
    $("#buyPlanBtn").on("click", function() {
        var planId = $(this).data('plan-id'); // Get the Plan ID from data attribute

        // Set the plan ID in the hidden input of the form
        $("#planId").val(planId);

        // Show the modal
        $("#buyPlanModal").modal('show');
    });

    // Handle the form submission (optional)
    $("#submitBuyPlan").on("click", function() {
        // You can add your form validation and submission logic here
        var formData = $("#buyPlanForm").serialize(); // Serialize form data
        
        // Example of sending data via AJAX (if needed)
        $.ajax({
            url: "submit-plan.php",  // Your form submission URL
            type: "POST",
            data: formData,
            success: function(response) {
                // Handle success response
                alert("Plan purchased successfully!");
                $("#buyPlanModal").modal('hide'); // Hide modal after success
            },
            error: function(error) {
                // Handle error
                alert("Error submitting the form.");
            }
        });
    });
});