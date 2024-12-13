<section class="brand_logo pt-4">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="why_dwd_heading mb-0">
                    <h2 class="mb-0">Our Clients</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-sm-12">
                <div class="marquee">
                    <ul class="marquee-content">

                        <li>
                            <div class="client_img">
                                <img src="<?php echo $_URL ?>/assets/images/clients/client-1.png" alt="" />
                            </div>
                        </li>
                        <li>
                            <div class="client_img">
                                <img src="<?php echo $_URL ?>/assets/images/clients/client-2.png"
                                    class="img-fluid lazyloaded" alt="">

                            </div>
                        </li>
                        <li>
                            <div class="client_img">
                                <img src="<?php echo $_URL ?>/assets/images/clients/client-3.png" alt="">
                            </div>

                        </li>
                        <li>
                            <div class="client_img">
                                <img src="<?php echo $_URL ?>/assets/images/clients/client-4.png"
                                    class="img-fluid lazyloaded" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="client_img">
                                <img src="<?php echo $_URL ?>/assets/images/clients/client-5.png" alt="">
                            </div>
                        </li>


                        <!-- end  -->


                    </ul>


                </div>

            </div>

        </div>
    </div>
</section>


<script>
const root = document.documentElement;
const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");
const marqueeContent = document.querySelector("ul.marquee-content");

root.style.setProperty("--marquee-elements", marqueeContent.children.length);

for (let i = 0; i < marqueeElementsDisplayed; i++) {
    marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
}
window.onload = function() {
    if (!sessionStorage.getItem('reloaded')) {
        sessionStorage.setItem('reloaded', true);
        window.location.reload(true);
    }
};
</script>