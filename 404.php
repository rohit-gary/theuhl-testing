<head>



  <?php include("includes/meta.php") ?>
  <?php include("includes/links1.php") ?>
  <title>Page Not Found - United Health Lumina</title>
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
  <style>
    .error-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
      padding: 20px;
    }

    .error-content {
      text-align: center;
      max-width: 600px;
      padding: 40px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .medical-icon {
      position: relative;
      width: 120px;
      height: 120px;
      margin: 0 auto 30px;
    }

    .cross-symbol {
      position: absolute;
      width: 80px;
      height: 80px;
      background: #2196F3;
      border-radius: 15px;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }

    .cross-symbol::before,
    .cross-symbol::after {
      content: '';
      position: absolute;
      background: white;
      border-radius: 3px;
    }

    .cross-symbol::before {
      width: 50px;
      height: 12px;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .cross-symbol::after {
      width: 12px;
      height: 50px;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .heartbeat-pulse {
      position: absolute;
      width: 100%;
      height: 100%;
      border: 3px solid #2196F3;
      border-radius: 50%;
      animation: pulse 2s infinite;
    }

    .error-code {
      font-size: 72px;
      color: #2196F3;
      margin: 0;
      font-weight: 700;
    }

    .error-title {
      font-size: 28px;
      color: #333;
      margin: 10px 0;
    }

    .error-message {
      font-size: 18px;
      color: #666;
      margin: 10px 0;
    }

    .error-submessage {
      font-size: 16px;
      color: #888;
      margin-bottom: 30px;
    }

    .action-buttons {
      display: flex;
      gap: 15px;
      justify-content: center;
    }

    .btn {
      padding: 12px 30px;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background: #2196F3;
      color: white;
      border: none;
    }

    .btn-primary:hover {
      background: #1976D2;
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: white;
      color: #2196F3;
      border: 2px solid #2196F3;
    }

    .btn-secondary:hover {
      background: #f5f5f5;
      transform: translateY(-2px);
    }

    @keyframes pulse {
      0% {
        transform: scale(0.95);
        opacity: 0.5;
      }

      50% {
        transform: scale(1.05);
        opacity: 0.8;
      }

      100% {
        transform: scale(0.95);
        opacity: 0.5;
      }
    }

    @media (max-width: 480px) {
      .error-code {
        font-size: 56px;
      }

      .error-title {
        font-size: 24px;
      }

      .action-buttons {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }
  </style>

</head>
<!-- Content -->

<body id="bg">
  <div class="page-wraper">
    <div id="loading-area"></div>
    <!-- header -->
    <?php include('includes/header1.php'); ?>

    <div class="page-content bg-white text-black">

      <div class="error-container">
        <div class="error-content">
          <div class="medical-icon">
            <div class="heartbeat-pulse"></div>
            <div class="cross-symbol"></div>
          </div>

          <div class="error-info">
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Page Not Found</h2>
            <p class="error-message">The requested page seems to be unavailable at the moment.</p>
            <p class="error-submessage">Our medical team is working on it.</p>
          </div>

          <div class="action-buttons">
            <a href="./index" class="btn btn-primary">Return Home</a>
            <a href="./contact-us" class="btn btn-secondary">Contact Support</a>
          </div>
        </div>
      </div>
      <!-- Content END-->



      <?php include("includes/footer1.php") ?>
      <?php include("includes/script1.php") ?>
</body>