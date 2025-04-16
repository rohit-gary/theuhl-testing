function GetBookedCustomerDetails(id) {

	$.ajax({
		url: 'action/get_booked_test_details.php',
		method: "GET",
		data: { TestID: id },
		success: function (data) {
			var response = JSON.parse(data);
			if (response.error == false) {

			}
		}
	})

}

function processCustomer(id) {
	console.log('Processing customer ID:', id); // Debug log
	alertify.confirm(
		'Are you sure you want to mark this order as processed?',
		function () {
			$.ajax({
				url: 'action/process_customer.php',
				type: 'POST',
				data: { customer_id: id },
				dataType: 'json',
				success: function (response) {
					console.log('Response:', response); // Debug log
					if (response.success) {
						alertify.success(response.message);
						// Reload the DataTable
						$('#all_policy_customer').DataTable().ajax.reload(null, false);
					} else {
						alertify.error(response.message);
					}
				},
				error: function (xhr, status, error) {
					console.error('AJAX Error:', status, error);
					alertify.error('Error processing order: ' + error);
				}
			});
		},
		function () {
			alertify.error('Process cancelled');
		}
	);
}

function delete_customer(id) {
	alertify.confirm(
		'Are you sure you want to delete this customer?',
		function () {
			$.ajax({
				url: 'action/delete_customer.php',
				type: 'POST',
				data: { customer_id: id },
				dataType: 'json',
				success: function (response) {
					if (response.success) {
						alertify.success(response.message);
						// Reload the DataTable
						$('#all_policy_customer').DataTable().ajax.reload(null, false);
					} else {
						alertify.error(response.message);
					}
				},
				error: function (xhr, status, error) {
					console.error('AJAX Error:', status, error);
					alertify.error('Error deleting customer: ' + error);
				}
			});
		},
		function () {
			alertify.error('Deletion cancelled');
		}
	);
}