<?php
// Determine the protocol (HTTP or HTTPS)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

// Get the base URL dynamically
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/Projects/theuhl-testing';
?>

<!-- Footer -->
<footer class="site-footer style1">
    <!-- newsletter part -->
    <div class="dlab-newsletter">
        <!-- <div class="container">
            <div class="ft-contact wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
                <div class="ft-contact-bx">
                    <img src="project-assets/images/icon/icon1.png" alt="">
                    <h4 class="title">Address</h4>
                    <p>8901 Marmora Road Chi Minh City, Vietnam</p>
                </div>
                <div class="ft-contact-bx">
                    <img src="project-assets/images/icon/icon2.png" alt="">
                    <h4 class="title">Phone</h4>
                    <p>8901 Marmora Road Chi Minh City, Vietnam</p>
                </div>
                <div class="ft-contact-bx">
                    <img src="project-assets/images/icon/icon3.png" alt="">
                    <h4 class="title">Email Contact</h4>
                    <p>8901 Marmora Road Chi Minh City, Vietnam</p>
                </div>
            </div>
        </div> -->
    </div>
    <!-- footer top part -->
    <div class="footer-top" style="background-image:url(<?php echo $base_url; ?>/project-assets/images/background/bg2.png); background-size: contain;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="widget widget_about">
                        <h4 class="footer-title">About United Health Lumina</h4>
                        <p>At United Health Lumina, we specialize in delivering top-notch health services and maintenance solutions</p>
                        <a href="<?php echo $base_url; ?>/about-us.php" class="readmore">Read More</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="widget">
                        <h4 class="footer-title">Useful Link</h4>
                        <ul class="list-2">
                            <li><a href="<?php echo $base_url; ?>/about-us.php">About Us</a></li>
                            <li><a href="<?php echo $base_url; ?>/blogs.php">Blog</a></li>
                            <li><a href="<?php echo $base_url; ?>/privacy-policy">Privacy Policy</a></li>
                            <li><a href="<?php echo $base_url; ?>/grievance-redressa">Grievance Redressa</a></li>
                            <li><a href="<?php echo $base_url; ?>/terms-conditions">Terms-Conditions</a></li>
                            <li><a href="<?php echo $base_url; ?>/cancellation-and-refund-policy">Cancellation and Refund Policy</a></li>
                            <li><a href="<?php echo $base_url; ?>/all-plans.php">Plans</a></li>
                            <li><a href="<?php echo $base_url; ?>/contact-us.php">Help Desk</a></li>
                            <li><a href="<?php echo $base_url; ?>/contact-us.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="widget widget_subscribe">
                        <h4 class="footer-title">Contact US</h4>
                        <p>If you have any questions. Subscribe to our newsletter to get our latest products.</p>
                        <form class="dzSubscribe" action="script/mailchamp.php" method="post">
                            <div class="dzSubscribeMsg"></div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="dzEmail" required="required" type="email" class="form-control" placeholder="Your Email Address">
                                    <div class="input-group-addon">
                                        <button name="submit" value="Submit" type="submit" class="site-button far fa-paper-plane"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom footer-line">
        <div class="container">
            <div class="footer-bottom-in">
                <!-- <div class="footer-bottom-logo"><a href="index.html"><img src="project-assets/images/green-new-logo.png" alt=""></a></div> -->
                <div class="footer-bottom-social">
                    <ul class="dlab-social-icon dez-border">
                        <li><a class="fab fa-facebook-f" href="https://www.facebook.com/unitedhealthluminacare/"></a></li>
                        <li><a class="fab fa-twitter" href="javascript:void(0);"></a></li>
                        <li><a class="fab fa-linkedin-in" href="https://www.linkedin.com/company/unitedhealthlumina/"></a></li>
                        <li><a class="fab fa-instagram" href="https://www.instagram.com/unitedhealthlumina/"></a></li>
                        <li><a class="fab fa-youtube" href="https://www.youtube.com/@UnitedHealthLumina-UHL" target="_blank"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer END -->
<!-- <button class="scroltop icon-up" type="button"><i class="fas fa-arrow-up"></i></button> -->

<?php include 'cookie-banner.php'; ?>
