<main id="main" class="main">

    <div class="pagetitle">
        <h1>Layout Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                <li class="breadcrumb-item active">Edit Layout Settings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Layout Settings</h5>
                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <!-- Logo Upload Form -->
                        <form class="row g-3" method="post" action="<?= base_url('admin/settings/layout/upload-logo') ?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="logo">Upload Logo</label>
                                <input class="form-control" type="file" id="logo" name="logo">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Upload Logo">
                                    <i class="ri-check-line"></i> Upload Logo
                                </button>
                            </div>
                        </form>

                        <!-- Favicon Upload Form -->
                        <form class="row g-3 mt-4" method="post" action="<?= base_url('admin/settings/layout/upload-favicon') ?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="favicon">Upload Favicon</label>
                                <input class="form-control" type="file" id="favicon" name="favicon">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Upload Favicon">
                                    <i class="ri-check-line"></i> Upload Favicon
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
