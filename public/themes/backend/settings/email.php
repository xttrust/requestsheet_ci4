<main id="main" class="main">

    <div class="pagetitle">
        <h1>Email Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                <li class="breadcrumb-item active">Edit Email Settings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Email Settings</h5>
                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <form class="row g-3" method="post" action="<?= base_url('admin/settings/email') ?>">

                            <div class="mb-3">
                                <label class="form-label" for="smto_host">SMTP Host</label>
                                <input class="form-control" type="text" id="smtp_host" name="smtp_host"
                                       value="<?= $smtp_host ? esc($smtp_host) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="smtp_user">SMTP User</label>
                                <input class="form-control" type="text" id="smtp_user" name="smtp_user"
                                       value="<?= $smtp_user ? esc($smtp_user) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="smtp_password">SMTP Password</label>
                                <input class="form-control" type="password" id="smtp_password" name="smtp_password"
                                       value="<?= $smtp_password ? esc($smtp_password) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="smtp_secure">SMTP Secure (SSL)</label>
                                <input class="form-control" type="text" id="smtp_secure" name="smtp_secure"
                                       value="<?= $smtp_secure ? esc($smtp_secure) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="smtp_port">SMTP Port</label>
                                <input class="form-control" type="text" id="smtp_port" name="smtp_port"
                                       value="<?= $smtp_port ? esc($smtp_port) : '' ?>">
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="form-label" for="admin_email">Admin Email</label>
                                <input class="form-control" type="email" id="admin_email" name="admin_email"
                                       value="<?= $admin_email ? esc($admin_email) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="support_email">Support Email</label>
                                <input class="form-control" type="email" id="support_email" name="support_email"
                                       value="<?= $support_email ? esc($support_email) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="office_email">Office Email</label>
                                <input class="form-control" type="email" id="office_email" name="office_email"
                                       value="<?= $office_email ? esc($office_email) : '' ?>">
                            </div>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    <i class="ri-check-line"></i> Submit
                                </button>
                                <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary">
                                    <i class="ri-close-line"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
