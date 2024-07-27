<main id="main" class="main">

    <!-- Page Title and Breadcrumb Navigation -->
    <div class="pagetitle">
        <h1><?= $page ? 'Edit' : 'Add' ?> Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/dashboard'); ?>">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/pages'); ?>">Manage Pages</a>
                </li>
                <li class="breadcrumb-item active"><?= $page ? 'Edit' : 'Add' ?> Page</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Page Header -->
                        <h5 class="card-title"><?= $page ? 'Edit' : 'Add' ?> Page Details</h5>
                        <div class="alert alert-info" role="alert">
                            <?= $page ? 'Update' : 'Create' ?> Page details
                        </div>

                        <!-- Display Form Messages -->
                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <!-- Page Details Form -->
                        <form class="row g-3" method="post" action="<?= base_url('admin/pages/save') ?>">
                            <?php if ($page && $page['id']): ?>
                                <!-- Hidden Input for ID (only for editing) -->
                                <input type="hidden" name="id" value="<?= esc($page['id']) ?>">
                            <?php endif; ?>

                            <!-- Name Input -->
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control"
                                       type="text"
                                       id="name"
                                       name="name"
                                       value="<?= $page ? esc($page['name']) : '' ?>"
                                       required>
                            </div>

                            <!-- Position Input -->
                            <div class="mb-3">
                                <label class="form-label" for="position">Position</label>
                                <input class="form-control"
                                       type="text"
                                       id="position"
                                       name="position"
                                       value="<?= $page ? esc($page['position']) : '' ?>">
                            </div>

                            <!-- Status Select -->
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active" <?= ($page && $page['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= ($page && $page['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <!-- Body Textarea -->
                            <div class="mb-3">
                                <label class="form-label" for="body">Body</label>
                                <textarea id="body" class="form-control" name="body" rows="10"><?= $page ? esc($page['body']) : '' ?></textarea>
                            </div>

                            <!-- Slug Input -->
                            <div class="mb-3">
                                <label class="form-label" for="slug">Slug</label>
                                <input class="form-control"
                                       type="text"
                                       id="slug"
                                       name="slug"
                                       value="<?= $page ? esc($page['slug']) : '' ?>"
                                       required>
                            </div>

                            <!-- SEO Title Input -->
                            <div class="mb-3">
                                <label class="form-label" for="seo_title">SEO Title</label>
                                <input class="form-control"
                                       type="text"
                                       id="seo_title"
                                       name="seo_title"
                                       value="<?= $page ? esc($page['seo_title']) : '' ?>"
                                       required>
                            </div>

                            <!-- SEO Description Input -->
                            <div class="mb-3">
                                <label class="form-label" for="seo_description">SEO Description</label>
                                <input class="form-control"
                                       type="text"
                                       id="seo_description"
                                       name="seo_description"
                                       value="<?= $page ? esc($page['seo_description']) : '' ?>"
                                       required>
                            </div>

                            <!-- Protected Checkbox -->
                            <div class="mb-3 form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="protected"
                                       name="protected"
                                       value="1"
                                       <?= ($page && $page['protected']) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="protected">Protected</label>
                            </div>

                            <!-- Custom Checkbox -->
                            <div class="mb-3 form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="custom"
                                       name="custom"
                                       value="1"
                                       <?= ($page && $page['custom']) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="custom">Custom</label>
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    <i class="ri-check-line"></i> Submit
                                </button>
                                <a href="<?= base_url('admin/pages') ?>" class="btn btn-secondary">
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
