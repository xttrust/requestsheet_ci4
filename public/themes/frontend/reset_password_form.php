<!-- Change Password Section
================================================== -->
<section id="change-password" class="sk__contact-us sk__py-m sk__parallax-background-section sk__flex-center-y">
    <!-- Parallax Background -->
    <div class="sk__parallax-background-element sk__absolute sk__image-back-cover"></div>
    <div class="sk__tint sk__absolute"></div>

    <!-- Container for the content -->
    <div class="container sk__powercontainer">
        <!-- Section Header -->
        <div class="row sk__contact-info sk__inner-header text-center">
            <div class="col-12 col-lg-10 offset-lg-1">
                <!-- Main Title and Description -->
                <h1 class="h1-small">Set a New Password</h1>
                <p class="p-v2">
                    Please enter your new password and confirm it to complete the reset process.
                    <br>
                    Ensure your new password meets the security requirements.
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
                        <?php if (session()->getFlashdata('fail')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('fail'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Display Success Message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Password Reset Form -->
                        <form class="sk__form sk__contact-form" action="<?= base_url('reset-password/update-password'); ?>" method="post">
                            <!-- Hidden Field for Reset Token -->
                            <input type="hidden" name="token" value="<?= esc($token); ?>">

                            <!-- New Password Input Field -->
                            <div class="form-group">
                                <input type="password" name="password" placeholder="New Password*" tabindex="1" required>
                            </div>

                            <!-- Confirm New Password Input Field -->
                            <div class="form-group">
                                <input type="password" name="confirmPassword" placeholder="Confirm New Password*" tabindex="2" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" tabindex="3">Change Password</button>

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
