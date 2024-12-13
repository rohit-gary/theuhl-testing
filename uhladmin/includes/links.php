<?php
    @session_start();
    include('./controllers/common_controllers.php');
?>
 
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $_URL ?>/assets/images/favicon/apple-touch-icon.png">
 <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $_URL ?>/assets/images/favicon/favicon-32x32.png">
 <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $_URL ?>/assets/images/favicon/favicon-16x16.png">
 <link rel="manifest" href="<?php echo $_URL ?>/assets/images/favicon/site.webmanifest">
 <meta name="msapplication-TileColor" content="#da532c">
 <meta name="theme-color" content="#ffffff">

 <link rel="stylesheet" href="<?php echo $_URL ?>/assets/css/style.css">
 <link href="<?php echo $_URL ?>/assets/css/navigation.css" rel="stylesheet">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
 <link href="<?php echo $_URL ?>/assets/css/examples.css" rel="stylesheet">
 <link href="<?php echo $_URL ?>/assets/css/navigation.css" rel="stylesheet">
 <link href="<?php echo $_URL ?>/assets/css/responsive.css" rel="stylesheet">


 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link
     href="https://fonts.googleapis.com/css2?family=Aleo:wght@700&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lato:wght@700&display=swap"
     rel="stylesheet">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TEZT8J1SHZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TEZT8J1SHZ');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P6JZ7CV2');</script>
<!-- End Google Tag Manager -->