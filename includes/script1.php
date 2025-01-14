<?php
// Determine the protocol (HTTP or HTTPS)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

// Get the base URL dynamically
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/Projects/theuhl-testing';
?>

<script src="<?php echo $base_url; ?>/project-assets/js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/wow/wow.js"></script><!-- WOW JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/lightgallery/js/lightgallery-all.min.js"></script><!-- Lightgallery -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/scroll/scrollbar.min.js"></script><!-- SCROLL -->
<script src="<?php echo $base_url; ?>/project-assets/js/custom.js"></script><!-- CUSTOM FUNCTIONS -->
<script src="<?php echo $base_url; ?>/project-assets/js/dz.carousel.min.js"></script><!-- SORTCODE FUNCTIONS -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUNCTIONS -->
<script src="<?php echo $base_url; ?>/project-assets/js/dz.ajax.js"></script><!-- CONTACT JS -->
<script src="<?php echo $base_url; ?>/project-assets/js/jquery.lazy.min.js"></script><!-- LAZY LOAD -->

<!-- REVOLUTION JS FILES -->
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/plugins/revolution/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="<?php echo $base_url; ?>/project-assets/js/rev.slider.js"></script><!-- REVOLUTION SLIDER -->

<script>
jQuery(document).ready(function() {
  'use strict';
  dz_rev_slider_2();  
  $('.lazy').Lazy();
}); /*ready*/
</script>


<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/672c65f94304e3196ade871b/1ic2mslop';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->