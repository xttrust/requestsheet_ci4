<main id="main" class="main">

    <div class="pagetitle">
        <h1>General Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                <li class="breadcrumb-item active">Edit General Settings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">General Settings</h5>
                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <form class="row g-3" method="post" action="<?= base_url('admin/settings/general') ?>">

                            <div class="mb-3">
                                <label class="form-label" for="website_name">Website Name</label>
                                <input class="form-control" type="text" id="website_name" name="website_name"
                                       value="<?= $website_name ? esc($website_name) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="currency_symbol">Currency Symbol</label>
                                <input class="form-control" type="text" id="currency_symbol" name="currency_symbol"
                                       value="<?= $currency_symbol ? esc($currency_symbol) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="currency_name">Currency Name</label>
                                <input class="form-control" type="text" id="currency_name" name="currency_name"
                                       value="<?= $currency_name ? esc($currency_name) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="home_seo_title">Home SEO Title</label>
                                <input class="form-control" type="text" id="home_seo_title" name="home_seo_title"
                                       value="<?= $home_seo_title ? esc($home_seo_title) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="home_seo_description">Home SEO Description</label>
                                <textarea class="form-control" id="home_seo_description" name="home_seo_description" rows="3"><?= $home_seo_description ? esc($home_seo_description) : '' ?></textarea>
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
