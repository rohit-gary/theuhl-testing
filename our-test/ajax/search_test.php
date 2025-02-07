<?php
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");


$searchQuery = isset($_POST['query']) ? trim($_POST['query']) : '';

if (!empty($searchQuery)) {
    $searchQuery = strtolower($searchQuery);
    $sql = "SELECT * FROM doc_test WHERE LOWER(TestName) LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$searchQuery%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($test = $result->fetch_assoc()) {
            $testID = base64_encode($test['ID']);
            $baseprice = intval($test['TestFee']);
            $off = 0.16 * $baseprice;
            $totaloff = intval($baseprice + $off);
            ?>
          <div class="col-md-6 col-lg-3 col-sm-12">
            <div class="test-card card">
                <div class="card-body">
                    <div class="upper-col">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <div class="test-name">
                                    <p><?php echo $test['TestName'] ?></p>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="test-price-info">
                                    <p class="mb-0">
                                        <span class="text-decoration-line-through text-white-50">₹<?php echo $totaloff ?></span>
                                        <span class="text-white fw-bold">₹<?php echo $test['TestFee'] ?></span>
                                        <span class="dis-span">16% OFF</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-row row align-items-center">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-alt"></i>
                                <span>Reports within</span>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <span class="fw-bold">6 hours</span>
                        </div>
                    </div>

                    <div class="info-row row align-items-center">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-microscope"></i>
                                <span>Tests included</span>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <span class="fw-bold">1 test</span>
                        </div>
                    </div>

                    <div class="row g-2 mt-3">
                        <div class="col-6">
                            <a class="detais-btn btn btn-outline-warning" href="./test-details?ID=<?php echo $testID ?>">
                                View Details
                            </a>
                        </div>
                        <div class="col-6">
                            <button class="cart-btn btn btn-primary" data-product-id="<?php echo $test['ID'] ?>"
                                data-product-name="<?php echo $test['TestName'] ?>"
                                data-product-price="<?php echo $test['TestFee'] ?>">
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
    } else {
        echo "<p class='text-center'>No results found</p>";
    }
}
?>
