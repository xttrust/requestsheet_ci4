<!-- Footer
                   ================================================== -->
<footer class="dark-shade-2-bg position-relative">

    <div class="footer-background-container sk__absolute">
        <div class="sk__gradient-background-tint footer-background sk__absolute"></div>
    </div>

    <div class="container sk__supercontainer position-relative">

        <div class="row footer-top">
            <div class="col-12 col-sm-6 top-footer-logo">
                <img alt="<?= esc($settings['website_name'] ?? 'Default Website Name') ?>"
                     src="<?= base_url('public/uploads/images/' . ($settings['logo'] ?? 'default_logo.png')) ?>">
            </div>
            <div class="col-12 col-sm-6 top-footer-tagline">
                <h5 class="h5-elegant">ADVANCEMENT IN <strong>DESIGN</strong></h5>
            </div>
        </div>

        <span class="divider sk__subtle-divider"></span>

        <div class="row footer-main text-center text-sm-start">
            <div class="col-md-12 col-lg-6 footer-main-large-col mb-4 mb-lg-0">
                <div class="fancy-gradient-text-box">
                    <h3 class="h3-elegant sk__gradient-fancy-text">Start your journey now.</h3>
                </div>
                <p class="p-v2 mw-440">Salvia vape blue bottle bespoke wolf celiac quinoa cloud bread letterpress hammock photo booth. Palo santo vexillologist venmo shaman pitchfork tote bag.</p>
                <h5>Manhattan Studio</h5>
                <p class="p-v2 mw-440"><span>1000 Park Avenue Manhattan, </span><span>NY 10001, </span><span>+1 (0) 212 555-0475 </span><br /><span>info@website.com</span></p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 footer-main-small-col widget_nav_menu">
                <h5>Skilltech Dark&#8198;star Web</h5>
                <ul>
                    <li>
                        <a href="#" class="footer-main-links gradient-links">About Dark&#8198;star Theme</a>
                    </li>
                    <li>
                        <a href="#" class="footer-main-links gradient-links">Portfolio & Works</a>
                    </li>
                    <li>
                        <a href="#" class="footer-main-links gradient-links">Pricing & Terms</a>
                    </li>
                    <li>
                        <a href="#" class="footer-main-links gradient-links">Skills & Story</a>
                    </li>
                    <li>
                        <a href="#" class="footer-main-links gradient-links">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 footer-main-small-col">
                <div class="row">
                    <div class="col">
                        <!-- Footer Social Icons Menu -->
                        <section class="footer-socials-section">
                            <h5>Follow Us & Stay Informed</h5>
                            <div class="footer-socials-inner">
                                <div class="footer-socials">
                                    <a class="social-icons" href="https://www.facebook.com/SkilltechWebDesign" target="_blank"><span><span class="icon-facebook1"></span></span></a>
                                    <a class="social-icons" href="https://www.facebook.com/SkilltechWebDesign" target="_blank"><span><span class="icon-twitter1"></span></span></a>
                                    <a class="social-icons" href="https://www.facebook.com/SkilltechWebDesign" target="_blank"><span><span class="icon-behance1"></span></span></a>
                                    <a class="social-icons" href="https://www.facebook.com/SkilltechWebDesign" target="_blank"><span><span class="icon-dribbble1"></span></span></a>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- Widget - Subscribe
                        ================================================== -->
                        <div class="widget custom_subscribe_widget">
                            <div class="sk__widget-inner">

                                <!-- Preview Only Static Form -->
                                <form class="sk__form sk__subscribe-form">
                                    <div class="form-group">
                                        <input type="email" name="the_email" placeholder="Enter email address*" tabindex="1">
                                    </div>
                                    <button type="submit" tabindex="2">SUB</button>
                                </form>

                                <!-- Real Working Form - Simple Forms V3 -->
                                <!-- <div class="sf-wrapper">
                                        <form id="sk__subscribe-form-1" class="sk__form sk__subscribe-form" action="assets/vendor/simple-forms/sendmail.php" method="post">
                                                <div class="form-group">
                                                        <input type="text" name="email" placeholder="Enter email address*" class="validate-email" value="" tabindex="1">
                                                </div>
                                                <div class="form-submit">
                                                        <button type="submit" tabindex="2">SUB</button>
                                                </div>
                                                <div class="server-response"></div>
                                        </form>
                                </div> -->

                            </div>
                        </div>
                        <!-- /.custom_subscribe_widget -->
                    </div>
                </div>
            </div>
        </div>

        <span class="divider sk__subtle-divider"></span>

        <div class="row footer-bottom">
            <div class="col-xs-12 col-sm-6 col-md-4 text-center text-sm-start">
                <h5>Skilltech Dark&#8198;star Web</h5>
            </div>
            <div class="col-12 col-md-4 order-xs-3 order-sm-3 order-md-2 text-center text-sm-start text-md-center">
                <p class="p-footer-copyright">Copyright © 2022    <a href="http://www.skilltechwebdesign.com/" target="_blank">SkilltechWebDesign.com</a></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 order-sm-2 order-md-3 text-center text-sm-end">
                <a class="footer-bottom-right-links" href="#" target="_blank">Privacy</a>
                <a class="footer-bottom-right-links" href="#" target="_blank">Terms</a>
                <a class="footer-bottom-right-links" href="#" target="_blank">Contact</a>
            </div>
        </div>
    </div>

</footer>


<!-- Helper div for inserting before scripts
================================================== -->
<div class="sk__body-end"></div>

</div>
<!-- /#smooth-content -->

</div>
<!-- /#smooth-wrapper -->

</main>
<!-- /main#primary.site-main -->


<!-- Scripts / Body End
================================================== -->
<!-- Vendor Scripts -->
<script src="<?= $themeUrl; ?>assets/vendor/bootstrap/5.1.3/bootstrap.min.js"></script>
<script src="<?= $themeUrl; ?>assets/vendor/offcanvas-nav/hc-offcanvas-nav.js"></script>
<script src="<?= $themeUrl; ?>assets/vendor/greensock/gsap.min.js"></script>
<script src="<?= $themeUrl; ?>assets/vendor/greensock/ScrollTrigger.min.js"></script>
<script src="<?= $themeUrl; ?>assets/vendor/greensock/ScrollSmoother.min.js"></script>
<script src="<?= $themeUrl; ?>assets/vendor/greensock/ScrollToPlugin.min.js"></script>
<script src="<?= $themeUrl; ?>assets/vendor/slick/1.8.1/slick.min.js"></script>
<script src="<?= $themeUrl; ?>assets/vendor/parallax/3.1.0/parallax.min.js"></script>

<!-- Delivery Form Scripts -->
<!-- <script src="assets/vendor/simple-forms/js/simple-forms-translations.js"></script>
<script src="assets/vendor/simple-forms/js/simple-forms.min.js"></script>
<script src="assets/js/form.js"></script> -->

<!-- Main Theme JS File -->
<script src="<?= $themeUrl; ?>assets/js/theme.js"></script>
<!-- xttrust's custom JS File -->
<script src="<?= $themeUrl; ?>assets/js/custom.js"></script>


</body>

</html>