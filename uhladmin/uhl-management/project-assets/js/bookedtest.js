function GetBookedCustomerDetails(id){

	$.ajax({
		url:'action/get_booked_test_details.php',
		method:"GET",
		data:{TestID:id},
		success:function(data){
			var response=JSON.parse(data);
			if(response.error==false){
				
			}
		}
	})

}