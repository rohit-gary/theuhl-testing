             
            <form id="test_form" onsubmit="return false;">
                <input type="hidden" id="form_action_test" name="form_action" value="Add" />
                <input type="hidden" id="form_id_test" name="form_id" value="-1" />
                <input type="hidden" id="user_id" value="<?php echo $Customerid; ?>" />

                <div class="mb-3">
                    <input type="text" id="searchTest" class="form-control" placeholder="Search Test..." onkeyup="searchTests()">
                </div>

                <div class="row" id="testContainer">
                        <?php
                        // Add this at the top of the file where you fetch your data
                        $items_per_page = 20;
                        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                        $total_items = count($All_Tests);
                        $total_pages = ceil($total_items / $items_per_page);

                        // Calculate the offset for the current page
                        $offset = ($current_page - 1) * $items_per_page;

                        // Slice the array to get only the items for the current page
                        $current_tests = array_slice($All_Tests, $offset, $items_per_page);
                        ?>

                    <?php foreach ($current_tests as $test) { 
                        $isSelected = in_array($test['ID'], $selectedTests) ? 'checked' : ''; 
                    ?>
                        <div class="col-md-4 mb-3 test-item" data-name="<?php echo strtolower(htmlspecialchars($test['TestName'])); ?>">
                            <div class="card shadow-sm test-card" id="test-card-<?php echo $test['ID']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($test['TestName']); ?></h5>
                                    <p><strong>Test Code:</strong> <?php echo htmlspecialchars($test['TestCode']); ?></p>
                                    <p><strong>Fee:</strong> ₹<?php echo htmlspecialchars($test['TestFee']); ?></p>

                                    <button class="btn btn-warning d-none" onclick="event.stopPropagation(); openTestDetailsModal(<?php echo htmlspecialchars(json_encode($test), ENT_QUOTES, 'UTF-8'); ?>)">
                                        <i class="ti-info-alt"></i>
                                    </button>


                                    <div class="col-6 d-flex justify-content-between align-items-center">

                                                <div class="cart-btn_1 flex-grow-1">
                                                    <button class="cart-btn btn btn-primary" data-product-id="<?php echo $test['ID'] ?>"
                                                        data-product-name="<?php echo $test['TestName'] ?>"
                                                        data-product-price="<?php echo $test['TestFee'] ?>">
                                                        Add to cart
                                                    </button>
                                                </div>
                                                
                                                <div class="cart-remove-btn_1">
                                                    <button class="remove-btn btn btn-danger ms-2"
                                                        style="display: none;"
                                                        data-product-id="<?php echo $test['ID'] ?>"
                                                        onclick="removeFromCart_2(<?php echo $test['ID'] ?>)">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </button>
                                                </div>
                                    </div>


                                    <input type="checkbox" class="form-check-input" name="selected_test[]" value="<?php echo htmlspecialchars($test['ID']); ?>" id="test-<?php echo $test['ID']; ?>" style="display: none;" <?php echo $isSelected; ?>>
                                    <div class="check-mark" id="check-mark-<?php echo $test['ID']; ?>" style="display: <?php echo $isSelected ? 'block' : 'none'; ?>;">
                                        <i class="fa fa-check-circle text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>



                 <div class="row mt-4">
                        <div class="col-12">
                            <nav aria-label="Test pagination">
                                <ul class="pagination justify-content-center">
                                    <?php if ($current_page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $current_page - 1 ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php
                                    // Show limited page numbers with ellipsis
                                    $start_page = max(1, $current_page - 2);
                                    $end_page = min($total_pages, $current_page + 2);

                                    if ($start_page > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                        if ($start_page > 2) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                    }

                                    for ($i = $start_page; $i <= $end_page; $i++):
                                        ?>
                                        <li class="page-item <?php echo $i === $current_page ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a>
                                        </li>
                                    <?php endfor;

                                    if ($end_page < $total_pages) {
                                        if ($end_page < $total_pages - 1) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                                    }
                                    ?>

                                    <?php if ($current_page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $current_page + 1 ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>

                <button type="button" class="btn btn-primary" onclick="goToPreviousStep()">Previous</button>
                <button type="button" class="btn btn-primary" id="gotothirdstep" onclick="goToNextStep()">Next</button>
          </form>


<!-- Test Details Modal -->
<div class="modal fade" id="testDetailsModal" tabindex="-1" aria-labelledby="testDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testDetailsModalLabel">Test Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <h5 class="text-primary fs-4" id="modalTestName"></h5>
                <hr>
                <p><strong>Category:</strong> <span id="modalTestCategory"></span></p>
                <p><strong>Test Code:</strong> <span id="modalTestCode"></span></p>
                <p><strong>Fee:</strong> ₹<span id="modalTestFee"></span></p>
                <p><strong>Report Time:</strong> <span id="modalReportTime"></span> hours</p>
                <p><strong>Parameters:</strong> <span id="modalParameters"></span></p>
                <p><strong>Identifies:</strong> <span id="modalIdentifies"></span></p>
            </div>
        </div>
    </div>
</div>
<?php include('cart-list.php'); ?>