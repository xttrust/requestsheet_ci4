<!-- Contact Us Section (Modified for Login Form)
================================================== -->
<section id="contact-us" class="sk__contact-us sk__py-m sk__parallax-background-section sk__flex-center-y">
    <div class="sk__parallax-background-element sk__absolute sk__image-back-cover"></div>
    <div class="sk__tint sk__absolute"></div>
    <div class="container sk__powercontainer">
        <!-- Section Header -->
        <div class="row sk__contact-info sk__inner-header text-center">
            <div class="col-12 col-lg-10 offset-lg-1">
                <h1 class="h1-small">Login to Your Account</h1>
                <p class="p-v2">Access your account by logging in below.</p>
            </div>
        </div>
        <div class="row">
            <!-- Login Form -->
            <div class="col-12 col-lg-10 offset-0 offset-lg-1 sk__contact-form-col d-flex justify-content-end">
                <div class="sk__contact-right text-center text-sm-start">
                    <?php echo view('../../public/themes/frontend/form_errors'); ?>
                    <form class="sk__form sk__contact-form" action="<?= base_url('login'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username*" tabindex="1" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password*" tabindex="2" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe"> Remember Me</label>
                        </div>
                        <button type="submit" tabindex="4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.sk__contact-us -->
