<head>
  <?php include("includes/meta.php") ?>
  <?php include("includes/links1.php") ?>
  <title>United Health Lumina New health plan for new Times</title>
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
  <?php include('includes/header1.php'); ?>

  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once('uhladmin/uhl-management/include/autoloader.inc.php');
  include("uhladmin/uhl-management/include/db-connection.php");

  $conf = new Conf();
  $dbh = new Dbh();
  $core = new Core();
  $masterconn = $dbh->_connectodb();
  $test_obj = new Test($conn);
  if (isset($_SESSION['dwd_UserID'])) {
    $orders = $test_obj->GetAllOrdersByUserID($_SESSION['dwd_UserID']);

  }

  ?>
  <section class="account-section section-full bg-light">
    <?php
    if (isset($orders) && is_array($orders)) {
      ?>
      <div class="container py-5">
        <h2 class="mb-4 section-title">My Health Test Orders</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <?php foreach ($orders as $order): ?>
            <div class="col">
              <div class="order-card h-100">
                <div class="order-header">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="order-badge">Order #<?= htmlspecialchars($order['OrderID']); ?></span>
                    <span class="order-date"><?= htmlspecialchars($order['CreatedDate']); ?></span>
                  </div>
                  <div class="price-tag">₹<?= number_format($order['total_price'], 2); ?></div>
                </div>

                <div class="order-body">
                  <div class="test-info">
                    <div class="test-icon">
                      <i class="fas fa-microscope"></i>
                    </div>
                    <div class="test-details">
                      <h5><?php echo $order['product_name']; ?></h5>
                      <p class="status-badge <?= $order['Status'] === 'Pending' ? 'pending' : 'ready'; ?>">
                        <i class="fas <?= $order['Status'] === 'Pending' ? 'fa-clock' : 'fa-check-circle'; ?>"></i>
                        <?= htmlspecialchars($order['Status'] === 'Pending' ? 'Processing' : 'Report Ready'); ?>
                      </p>
                      <p class="quantity">Quantity: <?php echo $order['quantity']; ?></p>
                    </div>
                  </div>

                  <div class="action-buttons">
                    <?php if ($order['Status'] === 'Pending'): ?>
                      <button class="btn btn-secondary w-100" disabled>
                        <i class="fas fa-hourglass-half"></i> Report Pending
                      </button>
                    <?php else: ?>
                      <div class="d-grid gap-2">
                        <a href="#" class="btn btn-primary">
                          <i class="fas fa-eye"></i> View Report
                        </a>
                        <a href="#" class="btn btn-outline-secondary">
                          <i class="fas fa-download"></i> Download PDF
                        </a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php
    } else {
      echo "<div class='container py-5'><div class='alert alert-info'>No orders available to display.</div></div>";
    }
    ?>
  </section>


  <style>
    .section-title {
      color: #2c3e50;
      font-weight: 600;
      position: relative;
      margin-bottom: 2rem;
    }

    .order-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
      border: none;
    }

    .order-card:hover {
      transform: translateY(-5px);
    }

    .order-header {
      background: linear-gradient(45deg, #f8f9fa, #ffffff);
      padding: 1.5rem;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      border-radius: 15px 15px 0 0;
    }

    .order-badge {
      background: #e3f2fd;
      color: #1976d2;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .order-date {
      color: #6c757d;
      font-size: 0.9rem;
    }

    .price-tag {
      font-size: 1.5rem;
      color: #2c3e50;
      font-weight: 600;
      margin-top: 0.5rem;
    }

    .order-body {
      padding: 1.5rem;
    }

    .test-info {
      display: flex;
      align-items: flex-start;
      margin-bottom: 1.5rem;
    }

    .test-icon {
      background: #f8f9fa;
      padding: 1rem;
      border-radius: 12px;
      margin-right: 1rem;
    }

    .test-icon i {
      font-size: 1.5rem;
      color: #1976d2;
    }

    .test-details h5 {
      color: #2c3e50;
      margin-bottom: 0.5rem;
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.4rem 0.8rem;
      border-radius: 50px;
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }

    .status-badge.pending {
      background: #fff3e0;
      color: #f57c00;
    }

    .status-badge.ready {
      background: #e8f5e9;
      color: #2e7d32;
    }

    .quantity {
      color: #6c757d;
      margin: 0;
    }

    .action-buttons {
      margin-top: 1.5rem;
    }

    .btn {
      padding: 0.6rem 1.2rem;
      font-weight: 500;
      border-radius: 8px;
    }

    .btn-primary {
      background: #1976d2;
      border: none;
    }

    .btn-primary:hover {
      background: #1565c0;
    }

    .btn-outline-secondary {
      border-color: #6c757d;
    }

    .btn i {
      margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
      .order-header {
        padding: 1rem;
      }

      .order-body {
        padding: 1rem;
      }
    }
  </style>

  <?php include("includes/footer1.php") ?>
  <?php include("includes/script1.php") ?>

  <script type="text/javascript" src="project-assets/js/index.js"></script>