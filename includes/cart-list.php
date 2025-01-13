<section class="cart-aside">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="z-index:100000">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php if (!empty($_SESSION['cart'])): ?>
                <h1>Your Cart</h1>
                <ul id="cart-list">
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <?php if ($item['id'] && $item['name'] && $item['price']): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($item['name']); ?></strong> - 
                                Price: ₹<?php echo htmlspecialchars($item['price']); ?>
                                <button class="btn btn-danger btn-sm remove-item" data-index="<?php echo $index; ?>">Remove</button>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <h1>Oops, Cart is Empty Now</h1>
            <?php endif; ?>
        </div>
    </div>
</section>

