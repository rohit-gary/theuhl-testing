<?php
@session_start();
if (isset($_SESSION) && is_array($_SESSION)) {
    $sessionDataJson = json_encode($_SESSION);
    // var_dump($sessionDataJson);
} else {
    $sessionDataJson = json_encode([]);
    // var_dump($sessionDataJson);


}

?>
<section class="cart-aside bg-offcanvas">
    <div class="offcanvas offcanvas-end bg-offcanvas" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel" style="z-index:100000">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Your Cart Item<i class="fa fa-shopping-cart"></i></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-offcanvas">
            <!-- Dynamically loaded cart items -->
            <div class="container-fluid my-3">
                <div class="container" id="cart-list"></div>
            </div>
            <!-- Footer for cart details -->
            <div class="offcanvas-footer bg-light pt-3 mt-4 rounded">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <!-- Total Price and Total Tests -->
                        <div class="col-4">
                            <p class="mb-1 text-green" style="color: #009688"><b id="total-price">₹ 0.00</b></p>
                            <p class="mb-0"><span id="total-tests">0</span> Test(s)</p>
                        </div>
                        <!-- Proceed Button -->
                        <div class="col-6">
                            <form action=" " method="POST" onsubmit="return false;">
                                <button type="button"
                                    class="btn site-button appointment-btn btnhover13 btn-rounded px-4"
                                    onclick='saveTestItem(<?php echo $sessionDataJson; ?>)'>
                                    CheckOut
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="submitLogin()">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- --------------checkOutModal---------------- -->