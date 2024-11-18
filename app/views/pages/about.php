<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-8 text-white">
                <h1>About Us</h1>
                <p>
                    Welcome to <strong>Smart Shop</strong>, your ultimate destination for quality products at unbeatable prices.
                    We take pride in offering a wide range of products to meet all your shopping needs.
                    At Smart Shop, we believe in providing value to our customers through exceptional service,
                    seamless shopping experiences, and trusted brands.
                    Our mission is to bring convenience, quality, and affordability together, making shopping more enjoyable for everyone.
                </p>
                <p>
                    Whether you're looking for the latest gadgets, fashionable apparel, or everyday essentials,
                    Smart Shop is here to serve you with excellence. Discover the joy of shopping with us today!
                </p>
            </div>
            <div class="col-md-4">
                <img src="<?php echo URLROOT ?>/public/images/about.png" class="img-fluid" alt="About Hero">
            </div>
        </div>
    </div>
</section>

<!-- Close Banner -->

<!-- Start Section -->
<section class="container py-5">
    <div class="row text-center pt-5 pb-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Our Services</h1>
            <p>
                At <strong>Smart Shop</strong>, we go the extra mile to ensure your shopping experience is seamless, enjoyable, and reliable.
                Here’s what we offer to make your life easier:
            </p>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fa fa-truck fa-lg"></i></div>
                <h2 class="h5 mt-4 text-center">Fast Delivery</h2>
                <p class="text-center">Get your orders delivered to your doorstep quickly and safely.</p>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fas fa-exchange-alt"></i></div>
                <h2 class="h5 mt-4 text-center">Easy Returns</h2>
                <p class="text-center">Hassle-free return and exchange policies for your convenience.</p>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fa fa-percent"></i></div>
                <h2 class="h5 mt-4 text-center">Exciting Promotions</h2>
                <p class="text-center">Enjoy exclusive deals, discounts, and seasonal offers.</p>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fa fa-user"></i></div>
                <h2 class="h5 mt-4 text-center">24/7 Support</h2>
                <p class="text-center">Our customer support team is here to assist you around the clock.</p>
            </div>
        </div>
    </div>
</section>

<!-- End Section -->

<!-- Start Brands -->
<section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Brands</h1>
                <p>
                    At <strong>Smart Shop</strong>, we partner with the most trusted and popular brands
                    to ensure you get top-quality products. Here are some of the brands we proudly offer:
                </p>
            </div>
            <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <!--End Controls-->

                    <!--Carousel Wrapper-->
                    <div class="col">
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/samsung.png" alt="Samsung Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/motorola.png" alt="Motorola Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/redmi.png" alt="Redmi Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/realme.png" alt="Realme Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End First slide-->

                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/apple.png" alt="Apple Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/hp.png" alt="HP Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/dell.png" alt="Dell Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?php echo URLROOT; ?>/public/images/lenovo.png" alt="Lenovo Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Second slide-->
                            </div>
                            <!--End Slides-->
                        </div>
                    </div>
                    <!--End Carousel Wrapper-->

                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
        </div>
    </div>
</section>

<!--End Brands-->

<?php require APPROOT . '/views/includes/footer.php'; ?>