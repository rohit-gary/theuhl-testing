<section class="cart-aside bg-offcanvas">
    <div class="offcanvas offcanvas-end bg-offcanvas" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="z-index:100000">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Your Cart Item<i class="fa fa-shopping-cart"></i></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-offcanvas">
            <?php if (!empty($_SESSION['cart'])): ?>
                <div class="container-fluid my-3">
                    <div class="container" id="cart-list">
                        <?php
                        $totalPrice = 0;
                        $totalTests = count($_SESSION['cart']);
                        foreach ($_SESSION['cart'] as $index => $item):
                            if ($item['id'] && $item['name'] && $item['price']):
                                $totalPrice += $item['price'];
                        ?>
                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <!-- Item Details -->
                                        <div class="col-8">
                                            <h5 class="card-title mb-1"><strong><?php echo htmlspecialchars($item['name']); ?></strong></h5>
                                            <p class="card-text text-muted mb-0">Price: ₹<?php echo number_format($item['price'], 2); ?></p>
                                        </div>
                                        <!-- Remove Button -->
                                        <div class="col-4 text-end">
                                            <button class="btn btn-danger btn-sm remove-item" data-index="<?php echo $index; ?>" aria-label="Remove <?php echo htmlspecialchars($item['name']); ?> from cart">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
                <div class="offcanvas-footer bg-light pt-3 mt-4 rounded">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-2">    
                              <i class="fa fa-shopping-cart"></i>
                            </div>

                            <!-- Total Price and Total Tests -->
                            <div class="col-4">
                                <p class="mb-1 text-green" style="color: #009688"><b>₹ <?php echo number_format($totalPrice, 2); ?></b></p>
                                <p class="mb-0"><?php echo $totalTests; ?> Test</p>
                            </div>
                            <!-- Proceed Button -->
                            <div class="col-6">
                                <form action=" " method="POST" onsubmit="return false;">
                                    <button type="button" class="btn site-button appointment-btn btnhover13 btn-rounded px-4" onclick="saveTestItem()">
                                     Proceed
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center mt-5">
                    <div class="text-center my-5">
                    <div style="background-color: #f8f9fa; border-radius: 50%; width: 200px; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <img src="../project-assets/images/emptycart-gif.gif" alt="Empty Cart" class="img-fluid" style="border-radius: 50%; max-width: 100%; max-height: 100%;">
                    </div>
                    <h1 class="mt-4" style="color: #6c757d;">Oops, Cart is Empty Now</h1>
                </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
