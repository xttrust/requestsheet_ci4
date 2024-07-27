<main id="main" class="main">

    <!-- Page Title and Breadcrumb Navigation -->
    <div class="pagetitle">
        <h1><?= $membership ? 'Edit' : 'Add' ?> Membership</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/dashboard'); ?>">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/membership'); ?>">Manage Memberships</a>
                </li>
                <li class="breadcrumb-item active"><?= $membership ? 'Edit' : 'Add' ?> Membership</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Page Header -->
                        <h5 class="card-title"><?= $membership ? 'Edit' : 'Add' ?> Membership Details</h5>
                        <div class="alert alert-info" role="alert">
                            <?= $membership ? 'Update' : 'Create' ?> Membership details
                        </div>

                        <!-- Display Form Messages -->
                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <!-- Membership Details Form -->
                        <form class="row g-3" method="post" action="<?= base_url('admin/membership/save') ?>">
                            <?php if ($membership): ?>
                                <!-- Hidden Input for ID (only for editing) -->
                                <input type="hidden" name="id" value="<?= esc($membership['id']) ?>">
                            <?php endif; ?>

                            <!-- Name Input -->
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control"
                                       type="text"
                                       id="name"
                                       name="name"
                                       value="<?= $membership ? esc($membership['name']) : '' ?>"
                                       required>
                            </div>

                            <!-- Price Input -->
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <input class="form-control"
                                       type="number"
                                       id="price"
                                       name="price"
                                       step="0.20"
                                       value="<?= $membership ? esc($membership['price']) : '' ?>"
                                       required>
                            </div>

                            <!-- Duration Select -->
                            <div class="mb-3">
                                <label class="form-label" for="time">Duration</label>
                                <select class="form-select" id="time" name="time" required>
                                    <option value="86400" <?= $membership && esc($membership['time']) == 86400 ? 'selected' : '' ?>>1 Day</option>
                                    <option value="2592000" <?= $membership && esc($membership['time']) == 2592000 ? 'selected' : '' ?>>30 Days</option>
                                    <option value="0" <?= $membership && esc($membership['time']) == 0 ? 'selected' : '' ?>>Lifetime</option>
                                </select>
                            </div>

                            <!-- Comments Input -->
                            <div class="mb-3">
                                <label class="form-label" for="comments">Comments</label>
                                <textarea id="comments" class="form-control tinymce-editor" name="comments" rows="5"><?= $membership ? esc($membership['comments']) : '' ?></textarea>
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    <i class="ri-check-line"></i> Submit
                                </button>
                                <a href="<?= base_url('admin/membership') ?>" class="btn btn-secondary">
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
