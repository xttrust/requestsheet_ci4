<!-- Contact Us Section (Modified for Registration Form)
================================================== -->
<section id="contact-us" class="sk__contact-us sk__py-m sk__parallax-background-section sk__flex-center-y">
    <div class="sk__parallax-background-element sk__absolute sk__image-back-cover"></div>
    <div class="sk__tint sk__absolute"></div>
    <div class="container sk__powercontainer">
        <!-- Section Header -->
        <div class="row sk__contact-info sk__inner-header text-center">
            <div class="col-12 col-lg-10 offset-lg-1">
                <h1 class="h1-small">Register new account</h1>
                <p class="p-v2">Please fill in all required fields</p>
            </div>
        </div>
        <div class="row">
            <!-- Registration Form -->
            <div class="col-12 col-lg-10 offset-0 offset-lg-1 sk__contact-form-col d-flex justify-content-end">
                <div class="sk__contact-right text-center text-sm-start">
                    <?php echo view('../../public/themes/frontend/form_errors'); ?>
                    <form class="sk__form sk__contact-form" action="<?= base_url('register'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" name="firstName" placeholder="First Name*" tabindex="1" value="<?= set_value('firstName'); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastName" placeholder="Last Name*" tabindex="2" value="<?= set_value('lastName'); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email*" tabindex="3" value="<?= set_value('email'); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username*" tabindex="4" value="<?= set_value('username'); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password*" tabindex="5" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirmPassword" placeholder="Confirm Password*" tabindex="6" required>
                        </div>
                        <div class="form-group form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" <?= set_value('terms') ? 'checked' : ''; ?> required>
                            <label class="form-check-label px-2" for="terms">
                                I agree to the <a href="#">terms and conditions</a>
                                (By pressing register you agree with terms and conditions)
                            </label>
                        </div>
                        <button type="submit" tabindex="7">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.sk__contact-us -->
