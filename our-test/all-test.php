<?php session_start();
include('include/logic.php');
?>

<head>
    <?php include("../includes/meta.php") ?>
    <?php include("../includes/links1.php") ?>
    <title>Our Most Popular Test</title>
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../project-assets/css/all_test.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style type="text/css">
    /* Button Click Effect */
    .cart-added-effect {
        animation: cart-bounce 0.4s ease-in-out;
    }

    @keyframes cart-bounce {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Smooth Transition */
    .cart-btn_1,
    .cart-btn {
        transition: all 0.3s ease-in-out;
    }

    /* Subtle Glow on Add */
    .cart-glow {
        animation: cart-glow-effect 0.5s ease-in-out;
    }

    @keyframes cart-glow-effect {
        0% {
            box-shadow: 0 0 5px rgba(0, 150, 0, 0.6);
        }

        50% {
            box-shadow: 0 0 15px rgba(0, 150, 0, 1);
        }

        100% {
            box-shadow: 0 0 5px rgba(0, 150, 0, 0.6);
        }
    }
    </style>
</head>


<body id="bg" style="z-index:10">
    <div class="page-wraper">
        <div id="loading-area"></div>
        <!-- header -->
        <?php include('../includes/header1.php'); ?>
        <div class="content-area bg-white main-area-testpage">
            <section class="test-banner">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <!-- Content Section -->
                        <div class="col-md-6 text-center text-md-start">
                            <h1 class="test-heading">
                                Our Health Test <br>
                                <span class="sub-heading">आपकी सेहत, हमारी प्राथमिकता</span>
                            </h1>
                            <p class="test-content">
                                विश्वसनीय जांच, सटीक परिणाम <br>
                                <span class="small-text">Reliable Testing, Accurate Results</span>
                            </p>
                        </div>

                        <!-- Image Section -->
                        <div class="col-md-6 text-center">
                            <img src="../project-assets/images/generic-old-2.png" alt="Health Test Banner"
                                class="img-fluid test-image">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Health Checks Section -->
            <section class="section-highlight mt-5">
                <div class="container section-content">
                    <div class="row align-items-center mb-5">
                        <div class="col-md-4">
                            <h2 class="title">Health Checks for Key <span class="text-primary">Organs</span></h2>
                            <p class="section-description">
                                Discover our extensive suite of diagnostic tests designed specifically for vital body
                                organs.
                                These specialized tests provide comprehensive insights for optimal health maintenance.
                            </p>
                        </div>

                        <div class="col-md-8">
                            <div class="row g-4">
                                <!-- Organ Cards -->
                                <?php
                                $organs = [
                                    ['name' => 'Heart', 'icon' => 'heart.png'],
                                    ['name' => 'Kidney', 'icon' => 'kidney.png'],
                                    ['name' => 'Liver', 'icon' => 'liver.png'],
                                    ['name' => 'Bone', 'icon' => 'fracture.png'],
                                    ['name' => 'Vitamin', 'icon' => 'supplement.png'],
                                    ['name' => 'Hormones', 'icon' => 'hormones.png'],
                                    ['name' => 'Gut Health', 'icon' => 'gut-microbiota.png'],
                                    ['name' => 'Blood', 'icon' => 'blood.png'],
                                    ['name' => 'Reproductive Health', 'icon' => 'reph.png'],
                                ];

                                foreach ($organs as $organ): ?>
                                <div class="col-md-4 col-6">
                                    <a href="#" class="text-decoration-none">
                                        <div class="organ-card text-center">
                                            <img src="../project-assets/images/test/<?php echo $organ['icon'] ?>"
                                                alt="<?php echo $organ['name'] ?>">
                                            <h4 class="title"><?php echo $organ['name'] ?></h4>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            // Add this at the top of the file where you fetch your data
            $items_per_page = 30;
            $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $total_items = count($all_test);
            $total_pages = ceil($total_items / $items_per_page);

            // Calculate the offset for the current page
            $offset = ($current_page - 1) * $items_per_page;

            // Slice the array to get only the items for the current page
            $current_tests = array_slice($all_test, $offset, $items_per_page);
            ?>

            <section class="all_test_container" id="test_container">
                <div class="search-test-section">
                    <div class="container">
                        <div class="row d-flex mt-4 ">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold">Search Test</span>
                                        <div class="d-flex flex-row d-none">
                                            <button class="btn btn-primary mr-2">CheckUpPlans</button>
                                            <button class="btn btn-primary new active"></i>Test </button>
                                        </div>
                                    </div>
                                    <div class="mt-3 inputs">
                                        <i class="fa fa-search"></i>
                                        <input type="text" class="form-control" id="searchTest"
                                            placeholder="Search Test..." onkeyup="searchTests()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-4">
                    <div class="row g-4" id="testList">
                        <?php foreach ($current_tests as $index => $test):
                            $testID = base64_encode($test['ID']);
                            $baseprice = intval($test['TestFee']);
                            $off = 0.16 * $baseprice;
                            $totaloff = intval($baseprice + $off);
                        ?>
                        <div class="col-md-6 col-lg-4 col-sm-12">
                            <div class="test-card card" style="border-radius: unset !important;">
                                <div class="card-body">
                                    <div class="upper-col" style="border-radius: unset !important;">
                                        <div class="row align-items-center">
                                            <div class="col-7">
                                                <div class="test-name">
                                                    <p><?php echo $test['TestName'] ?></p>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="test-price-info">
                                                    <p class="mb-0">
                                                        <span
                                                            class="text-decoration-line-through text-white-50">₹<?php echo $totaloff ?></span>
                                                        <span
                                                            class="text-white fw-bold">₹<?php echo $test['TestFee'] ?></span>
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

                                    <div class="row g-2 d-flex align-items-center">
                                        <div class="col-6">
                                            <a class="detais-btn btn btn-outline-warning"
                                                href="./test-details?ID=<?php echo $testID ?>">
                                                View Details
                                            </a>
                                        </div>

                                        <div class="col-6 d-flex justify-content-between align-items-center">
                                            <div class="cart-btn_1 flex-grow-1">
                                                <button class="cart-btn btn btn-primary"
                                                    data-product-id="<?php echo $test['ID'] ?>"
                                                    data-product-name="<?php echo $test['TestName'] ?>"
                                                    data-product-price="<?php echo $test['TestFee'] ?>"
                                                    style="padding: 13px; border-radius: 4px;">
                                                    Add to cart
                                                </button>
                                            </div>

                                            <div class="cart-remove-btn_1" style="padding: 11px 2px;">
                                                <button class="remove-btn btn btn-danger ms-2" style="display: none;"
                                                    data-product-id="<?php echo $test['ID'] ?>"
                                                    onclick="removeFromCart_2(<?php echo $test['ID'] ?>)">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>

                    <!-- Add pagination controls -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <nav aria-label="Test pagination">
                                <ul class="pagination justify-content-center">
                                    <?php if ($current_page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $current_page - 1 ?>"
                                            aria-label="Previous">
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
                                        <a class="page-link" href="?page=<?php echo $current_page + 1 ?>"
                                            aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>





            <!-- Wellness Section -->
            <section class="section-highlight">
                <div class="container section-content">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="row g-4">
                                <?php
                                $checkups = [
                                    ['name' => 'Women Health', 'icon' => 'Women-Health.png'],
                                    ['name' => 'Lifestyle Checkup', 'icon' => 'Lifestyle-Checkup.png'],
                                    ['name' => 'Cancer Checkup', 'icon' => 'Cancer-Checkup.png'],
                                    ['name' => 'Senior Citizen', 'icon' => 'Senior.png'],
                                    ['name' => 'Full Body Checkups', 'icon' => 'Full-Body-Checkups.png'],
                                    ['name' => 'Diabetes Checkup', 'icon' => 'Diabetes.png'],
                                ];

                                foreach ($checkups as $checkup): ?>
                                <div class="col-md-4 col-6">
                                    <a href="#" class="text-decoration-none">
                                        <div class="organ-card text-center">
                                            <img src="../project-assets/images/test/<?php echo $checkup['icon'] ?>"
                                                alt="<?php echo $checkup['name'] ?>">
                                            <h4 class="title"><?php echo $checkup['name'] ?></h4>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h2 class="title">Prioritize Your Wellness with <span class="text-primary">Personalized
                                    Care</span></h2>
                            <p class="section-description">
                                Our customized health checkups are designed to meet your unique needs, focusing on your
                                lifestyle,
                                age, and medical history. Discover a tailored approach to preventive healthcare.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="my-3">
                <div class="container mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card gradient-bg">
                                <div class="card-header gradient-bg mb-3" style="margin-bottom: 3em;">
                                    <h2 class="title">Looking to buy a new life <span class="text-primary">Health
                                            Test?</span></h2>
                                    <p>Our experts are happy to help you!</p>
                                </div>
                                <div class="card-body">
                                    <form id="tte-review-form">
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label for="needformName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="needformName"
                                                    name="needformName" placeholder="Enter full name" required>
                                                <div class="invalid-feedback">Please enter your name.</div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="needformMobile" class="form-label">Mobile No.</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+91</span>
                                                    <input type="tel" class="form-control" id="needformMobile"
                                                        name="needformMobile" placeholder="Enter mobile number"
                                                        maxlength="10" required>
                                                    <div class="invalid-feedback">Please enter your mobile number.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="planSelect" class="">Plan</label>
                                                <select class="form-control" id="planSelect" name="planSelect" required>
                                                    <option value="" selected disabled>Select Test</option>
                                                    <option value="Complete Blood Count (CBC) with ESR">
                                                        Complete Blood Count (CBC) with ESR</option>
                                                    <option value="Complete Blood Count (CBC) with ESR">Complete Blood
                                                        Count (CBC) with ESR
                                                    </option>
                                                    <option value="I don't know/I need help">I don't know/I need help
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">Please select a Test.</div>
                                            </div>
                                            <div class="col-md-3">
                                                <br>
                                                <div
                                                    class="input-group mt-2 d-flex justify-content-between align-items-center w-100">
                                                    <button type="submit"
                                                        class="btn site-button appointment-btn btnhover13 btn-rounded"
                                                        onclick="Submitenquiry(event)">Get a Call Back</button>
                                                    <img src="../project-assets/images/whatsapp.png"
                                                        style="width:50px; height:auto; cursor: pointer;"
                                                        onclick="alert('Comming soon....')">
                                                </div>


                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-text">
                                        United Health Lumina Plan Ltd will send you updates on your policy, new products
                                        & services.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-full my-2">
                <div class="newbie-sec happy-mem-sect py-4" style="background-color:#8cc5e23d">
                    <div class="container page-container">
                        <div class="row mt-4">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 m-b30">
                                    <div class="dlab-accordion faq-1 box-sort-in m-b30" id="accordion1">
                                        <div class="panel">
                                            <div class="acod-head">
                                                <h6 class="acod-title">
                                                    <a href="javascript:void(0);" data-bs-toggle="collapse"
                                                        data-bs-target="#faq1" class="collapsed" aria-expanded="true">
                                                        1. What are the benefits of subscribing to a United Health
                                                        Lumina health plan?</a>
                                                </h6>
                                            </div>
                                            <div id="faq1" class="acod-body collapse" data-bs-parent="#accordion1">
                                                <div class="acod-content">United Health Lumina's subscription plans
                                                    offer a range of benefits,
                                                    including comprehensive coverage for outpatient department (OPD)
                                                    services, in-patient
                                                    treatment, and preventive care, with flexible claim options.</div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="acod-head">
                                                <h6 class="acod-title">
                                                    <a href="javascript:void(0);" data-bs-toggle="collapse"
                                                        data-bs-target="#faq2" class="collapsed" aria-expanded="false">
                                                        2. What makes United Health Lumina's OPD plans unique?</a>
                                                </h6>
                                            </div>
                                            <div id="faq2" class="acod-body collapse" data-bs-parent="#accordion1">
                                                <div class="acod-content">United Health Lumina's OPD-based health plans
                                                    allow claims on
                                                    outpatient treatments, offering subscribers flexibility for medical
                                                    consultations,
                                                    diagnostics, and more without needing hospitalization .</div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="acod-head">
                                                <h6 class="acod-title">
                                                    <a href="javascript:void(0);" data-bs-toggle="collapse"
                                                        data-bs-target="#faq3" class="collapsed" aria-expanded="false">
                                                        3. Can I customize my health plan with United Health Lumina?
                                                    </a>
                                                </h6>
                                            </div>
                                            <div id="faq3" class="acod-body collapse" data-bs-parent="#accordion1">
                                                <div class="acod-content"> Yes, United Health Lumina provides
                                                    customizable health plan options
                                                    to cater to specific medical needs, lifestyle requirements, and
                                                    family size.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="acod-head">
                                                <h6 class="acod-title">
                                                    <a href="javascript:void(0);" data-bs-toggle="collapse"
                                                        data-bs-target="#faq4" class="collapsed" aria-expanded="false">
                                                        4.How are claims handled in United Health Lumina subscription
                                                        plans? </a>
                                                </h6>
                                            </div>
                                            <div id="faq4" class="acod-body collapse" data-bs-parent="#accordion1">
                                                <div class="acod-content">United Health Lumina offers a streamlined
                                                    claims process with flexible
                                                    reimbursement options, making it easier for members to claim
                                                    expenses across OPD and
                                                    in-patient services.</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
            </section>
        </div>
    </div>
    <?php include("../includes/footer1.php") ?>
    <?php include("../includes/script1.php") ?>
</body>

<script>
// 	$(document).ready(function () {
//     $("#searchTest").on("keyup", function () {
//         let value = $(this).val().toLowerCase();

//         $(".test-card").each(function () {
//             let testName = $(this).find(".test-name p").text().toLowerCase();

//             if (testName.includes(value)) {
//                 $(this).parent().show();  // Show matching test
//             } else {
//                 $(this).parent().hide();  // Hide non-matching test
//             }
//         });
//     });
// });


function searchTests() {
    let query = document.getElementById("searchTest").value.trim();

    // Send AJAX request only if there is a search term
    if (query.length > 0) {
        fetch("ajax/search_test.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "query=" + encodeURIComponent(query),
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("testList").innerHTML = data;
            });
    } else {
        location.reload();
    }
}
</script>
<script type="text/javascript" src="../project-assets/js/all_test_new.js" defer></script>