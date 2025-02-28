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


// ------add cart item in the cart db--------------


document.addEventListener("DOMContentLoaded", function () {
   document.querySelectorAll('.cart-btn').forEach(button => {
       button.addEventListener('click', function () {
           const productId = this.getAttribute('data-product-id');
           const productName = this.getAttribute('data-product-name');
           const productPrice = this.getAttribute('data-product-price');
           fetch('./our-test/action/add-to-cart.php', {
               method: 'POST',
               headers: {
                   'Content-Type': 'application/x-www-form-urlencoded',
               },
               body: `product_id=${productId}&product_name=${productName}&product_price=${productPrice}&quantity=1`
           })
           .then(response => response.text())
           .then(data => {
               var response = JSON.parse(data);
               loadCart();
               updateCartCount();
           })
           .catch(error => console.error('Error:', error));
       });
   });
});


document.addEventListener('DOMContentLoaded', function () {
   loadCart();
});

function loadCart() 
{
   fetch('./our-test/ajax/get_cart_item.php')
       .then(response => response.json())
       .then(data => {
           const cartList = document.getElementById('cart-list');
           const offcanvasFooter = document.querySelector('.offcanvas-footer');
           const totalPriceElement = document.getElementById('total-price');
           const totalTestsElement = document.getElementById('total-tests');
            // Check if data is an array
            if (!Array.isArray(data)) {
               cartList.innerHTML = `
                   <div class="text-center my-5">
                       <div style="background-color: #f8f9fa; border-radius: 50%; width: 200px; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                           <img src="../project-assets/images/emptycart-gif.gif" alt="Empty Cart" class="img-fluid" style="border-radius: 50%; max-width: 100%; max-height: 100%;">
                       </div>
                       <h1 class="mt-4" style="color: #6c757d;">Oops, Cart is Empty Now</h1>
                   </div>
               `;
               offcanvasFooter.style.display = 'none'; // Hide footer if there's an error
               return;
           }

           if (data.length === 0) {
               cartList.innerHTML = `
                   <div class="text-center my-5">
                       <div style="background-color: #f8f9fa; border-radius: 50%; width: 200px; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                           <img src="../project-assets/images/emptycart-gif.gif" alt="Empty Cart" class="img-fluid" style="border-radius: 50%; max-width: 100%; max-height: 100%;">
                       </div>
                       <h1 class="mt-4" style="color: #6c757d;">Oops, Cart is Empty Now</h1>
                   </div>
               `;
               offcanvasFooter.style.display = 'none'; // Hide footer if cart is empty
           } else {
               cartList.innerHTML = '';
               let totalPrice = 0;
               let totalTests = 0;

               data.forEach(item => {
                   totalPrice += parseFloat(item.total_price);
                   totalTests += parseInt(item.quantity);

                   cartList.innerHTML += `
                       <div class="card shadow-sm mb-3">
                           <div class="card-body">
                               <div class="row align-items-center">
                                   <div class="col-8">
                                       <h5 class="card-title mb-1"><strong>${item.product_name}</strong></h5>
                                       <p class="card-text text-muted mb-0">Price: ₹${parseFloat(item.product_price).toFixed(2)}</p>
                                       <p class="card-text text-muted mb-0">Quantity: ${item.quantity}</p>
                                   </div>
                                   <div class="col-4 text-end">
                                       <button class="btn btn-danger btn-sm remove-item" onclick="removeFromCart(${item.id})" aria-label="Remove ${item.product_name} from cart">
                                           <i class="fa-solid fa-trash-can"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   `;
               });

               offcanvasFooter.style.display = 'block'; // Show footer if cart is not empty
               totalPriceElement.innerHTML = `₹ ${totalPrice.toFixed(2)}`;
               totalTestsElement.innerHTML = `${totalTests} Test${totalTests > 1 ? 's' : ''}`;
           }
       })
       .catch(error => console.error('Error loading cart:', error));
}

function removeFromCart(itemId)
{
   fetch('./our-test/action/remove_from_cart.php', {
       method: 'POST',
       headers: {
           'Content-Type': 'application/json'
       },
       body: JSON.stringify({ id: itemId })
   })
   .then(response => response.json())
   .then(result => {
       if (result.success) {
           loadCart();
           updateCartCount(); 
       } else {
           alert('Failed to remove item.');
       }
   })
   .catch(error => console.error('Error removing item:', error));
}

function updateCartCount()
{
  
   fetch('./our-test/ajax/get_cart_item_count.php')
       .then(response => response.json())
       .then(data => {
          
           document.getElementById("cart-count").textContent = data.cart_count;
       })
       .catch(error => console.error('Error fetching cart count:', error));
}

document.addEventListener('DOMContentLoaded', function () {
  updateCartCount();
});



function saveTestItem(sessionData) {
   $.ajax({
       url: './our-test/ajax/get_current_cart_ID.php',
       method: 'GET',
       success: function (data) {
           try {
               console.log(data);
               var response = data;  // Ensure valid JSON parsing
               var cart_id=response.cart_id;
               
               
               let isLoggedIn = false;
               if (sessionData.dwd_UserID) {
                   isLoggedIn = true;
               }

               if (!isLoggedIn) {
                   gotocreateaccount(sessionData);
               } else {
                   gotocheckout(cart_id, sessionData.dwd_UserID);
               }
           } catch (error) {
               console.error("Error parsing JSON:", error);
           }
       },
       error: function (xhr, status, error) {
           console.error("AJAX Error:", status, error);
       }
   });
}


function goToPayment() {
   // Redirect to the payment module
   window.location.href = '/payment';
}

function gotocreateaccount(sessionData) {
  
   window.location.href = `./our-test/create-account.php`;
}

function gotocheckout(cart_id_value, user_id) {
   let cart_id = cart_id_value;
   
   $.ajax({
       url: './our-test/ajax/update_cart_checkout.php',
       method: 'GET',
       data: { cart_id: cart_id },
       success: function(response) {
           var response = JSON.parse(response);
           if(response.error==false){
               loadCart();
               updateCartCount();
               window.location.href = `./our-test/checkout.php?cart_id=${cart_id}`;
           }else{
               alert(response.message);
           }
       }
   })
   
 }