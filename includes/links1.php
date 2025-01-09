<?php
// Determine the protocol (HTTP or HTTPS)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

// Get the base URL dynamically
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/Projects/theuhl-testing';
?>

<!-- FAVICONS ICON -->
<link rel="icon" href="<?php echo $base_url; ?>/project-assets/images/favicon/uhlfavtemp.png" type="image/png">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_url; ?>/project-assets/images/favicon/uhlfavtemp.png">

<!-- STYLESHEETS -->
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/project-assets/css/plugins.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/project-assets/css/style.css">
<link class="skin" rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/project-assets/css/skin/skin-1.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/project-assets/css/templete.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/project-assets/css/custom.css">

<!-- Google Font -->
<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Playfair+Display:400,400i,700,700i,900,900i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');
</style>

<!-- REVOLUTION SLIDER CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/css/revolution.min.css">

<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

