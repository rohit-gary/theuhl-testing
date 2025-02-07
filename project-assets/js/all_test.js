 $(document).ready(function() 
 {
        const phrases = ["Book Your Test Now", "Book Your Test Now"];
        const dynamicText = $('.test-banner-content');
        let currentPhraseIndex = 0;
        let currentCharIndex = 0;
        let isDeleting = false;

        function typeEffect() 
        {
	            const currentPhrase = phrases[currentPhraseIndex];
	            if (isDeleting) {
	                // Erase text
	                dynamicText.text(currentPhrase.substring(0, currentCharIndex - 1));
	                currentCharIndex--;
	                if (currentCharIndex === 0) {
	                    isDeleting = false;
	                    currentPhraseIndex = (currentPhraseIndex + 1) % phrases.length;
	                }
	            } else {
	                // Type text
	                dynamicText.text(currentPhrase.substring(0, currentCharIndex + 1));
	                currentCharIndex++;
	                if (currentCharIndex === currentPhrase.length) {
	                    isDeleting = true;
	                }
	            }
	            // Adjust speed
	            const typingSpeed = isDeleting ? 150 : 350;
	            const pauseBeforeDelete = currentCharIndex === currentPhrase.length ? 2000 : 100;
	            setTimeout(typeEffect, isDeleting ? typingSpeed : pauseBeforeDelete);
	        }
	        // Initialize the typing effect
	        typeEffect();
    });




    $(document).ready(function ()
     {
	    // Update the cart when an item is added
	    $(".cart-btn").click(function () 
	      {
			var productId = $(this).data("product-id");
			var productName = $(this).data("product-name");
			var productPrice = $(this).data("product-price");

			$.ajax({
				url: "../action/cart.php",  // Your PHP script to handle the cart actions
				type: "POST",
				data: {
				action: "add",  // Action to add the item
				product_id: productId,
				product_name: productName,
				product_price: productPrice
			},
			success: function(response)
			{
				var cartData = JSON.parse(response);
				alert("Item added to cart!");
				$("#cart-count").text(cartData.cartCount);
				updateCartSidebar(cartData.cartItems);
			}
			});
              });

function updateCartSidebar() {
    var cartSidebar = $("#offcanvasRight .offcanvas-body");
    cartSidebar.empty(); // Clear current cart items

    $.ajax({
        url: "./ajax/get_cart_content.php", // Path to the PHP file
        type: "GET",
        success: function(response) {
            if (response) {
                cartSidebar.html(response); // Insert the cart content returned by the PHP file
            } else {
                cartSidebar.html("<h1>Oops, Cart is Empty Now</h1>");
            }

            // Attach event listeners to the remove buttons after loading the content
            $(".remove-item").on("click", function () {
                var itemIndex = $(this).data("index");
                // Send AJAX request to remove the item
                $.ajax({
                    url: "../action/remove_from_cart.php",
                    type: "POST",
                    data: { index: itemIndex },
                    success: function (response) {
                        try {
                            var updatedCart = JSON.parse(response);

                            if (updatedCart.success) {
                                // Update the cart count
                                $("#cart-count").text(updatedCart.count);

                                // Update the cart sidebar
                                updateCartSidebar();
                            } else {
                                alert("Failed to remove item from cart.");
                            }
                        } catch (e) {
                            console.error("Invalid JSON response", e);
                            alert("Error updating cart.");
                        }
                    },
                    error: function () {
                        alert("Error removing item from cart.");
                    }
                });
            });
        },
        error: function() {
            alert("Error fetching cart content.");
        }
    });
}




});


    // JavaScript to handle item removal
    document.addEventListener('DOMContentLoaded', function ()
     {
		 const cartList = document.getElementById('cart-list');
		 const cartCount = document.getElementById('cart-count');
	        cartList.addEventListener('click', function (e)
	         {
		     if (e.target.classList.contains('remove-item'))
		      {
			         const index = e.target.dataset.index;
			         // Send AJAX request to remove item
			         fetch('../action/remove_from_cart.php',
			             {
				             method: 'POST',
				             headers: 
				             {
				                 'Content-Type': 'application/json'
				              },
				             body: JSON.stringify({ index: index })
			             })
			         .then(response => response.json())
			         .then(data => {
			             if (data.success) {
			                 // Update cart display
			                 e.target.parentElement.remove();
			                 cartCount.textContent = data.count;

			                 // Show empty cart message if needed
			                 if (data.count == 0) {
			                     cartList.innerHTML = '<h1>Oops, Cart is Empty Now</h1>';
			                 }
			             } else {
			                 alert('Failed to remove item');
			             }
			         })
			         .catch(error => console.error('Error:', error));
		     }
	 });
    });

	
	 function saveTestItem()
	  {
	    
	    $.ajax({
	        url: 'action/add_update_test.php', 
	        method: 'POST', 
	        contentType: 'application/json', 
	        success: function (response) {
	            const parsedResponse = JSON.parse(response); 
	            alert('Response: ' + parsedResponse.message); 
	        },
	        error: function (xhr, status, error) {
	            console.error('AJAX Error:', status, error); 
	            alert('An error occurred: ' + error);
	        }
	    });
	}

