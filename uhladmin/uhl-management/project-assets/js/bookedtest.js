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
	if (confirm('Are you sure you want to mark this order as processed?')) {
		$.ajax({
			url: 'action/process_customer.php',
			type: 'POST',
			data: { customer_id: id },
			dataType: 'json',
			success: function (response) {
				console.log('Response:', response); // Debug log
				if (response.success) {
					alert(response.message);
					// Reload the DataTable
					$('#all_policy_customer').DataTable().ajax.reload(null, false);
				} else {
					alert(response.message);
				}
			},
			error: function (xhr, status, error) {
				console.error('AJAX Error:', status, error);
				alert('Error processing order: ' + error);
			}
		});
	}
}

function delete_customer(id) {
	if (confirm('Are you sure you want to delete this customer?')) {
		$.ajax({
			url: 'action/delete_customer.php',
			type: 'POST',
			data: { customer_id: id },
			dataType: 'json',
			success: function (response) {
				if (response.success) {
					alert(response.message);
					// Reload the DataTable
					$('#all_policy_customer').DataTable().ajax.reload(null, false);
				} else {
					alert(response.message);
				}
			},
			error: function (xhr, status, error) {
				console.error('AJAX Error:', status, error);
				alert('Error deleting customer: ' + error);
			}
		});
	}
}