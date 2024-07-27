<!-- Contact Us Section (Modified for Reset Password Form)
================================================== -->
<section id="contact-us" class="sk__contact-us sk__py-m sk__parallax-background-section sk__flex-center-y">
    <!-- Parallax Background -->
    <div class="sk__parallax-background-element sk__absolute sk__image-back-cover"></div>
    <div class="sk__tint sk__absolute"></div>

    <!-- Container for the content -->
    <div class="container sk__powercontainer">
        <!-- Section Header -->
        <div class="row sk__contact-info sk__inner-header text-center">
            <div class="col-12 col-lg-10 offset-lg-1">
                <!-- Main Title and Description -->
                <h1 class="h1-small">Reset Your Password</h1>
                <p class="p-v2">
                    To reset your password, please enter your email address below.
                    <br>
                    If the email exists in our database, a new password will be sent to you.
                </p>
            </div>
        </div>

        <!-- Form Container with Centering -->
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row justify-content-center w-100">
                <!-- Spacer Columns for Centering on Larger Screens -->
                <div class="col-12 col-md-1 col-lg-4"></div>

                <!-- Reset Password Form -->
                <div class="col-12 col-md-10 col-lg-4 sk__contact-form-col">
                    <div class="sk__contact-right text-center text-sm-start">
                        <!-- Display Form Errors -->
                        <?php echo view('../../public/themes/frontend/form_errors'); ?>

                        <!-- Password Reset Form -->
                        <form class="sk__form sk__contact-form" action="<?= base_url('reset-password'); ?>" method="post">
                            <div class="form-group">
                                <!-- Email Input -->
                                <input type="email" name="email" placeholder="Enter your email*" tabindex="1" required>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" tabindex="2">Reset Password</button>

                            <!-- Link to Login Page -->
                            <div class="mt-3">
                                <a href="<?= base_url('login'); ?>" class="text-decoration-none">
                                    <i class="icon-arrow-left"></i> Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Spacer Columns for Centering on Larger Screens -->
                <div class="col-12 col-md-1 col-lg-4"></div>
            </div>
        </div>
    </div>
</section>
<!-- /.sk__contact-us -->
