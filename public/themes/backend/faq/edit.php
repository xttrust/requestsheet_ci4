<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $faq ? 'Edit' : 'Add' ?> FAQ</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/faq'); ?>">Manage FAQs</a></li>
                <li class="breadcrumb-item active"><?= $faq ? 'Edit' : 'Add' ?> FAQ</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $faq ? 'Edit' : 'Add' ?> FAQ Details</h5>
                        <div class="alert alert-info" role="alert">
                            <?= $faq ? 'Update' : 'Create' ?> FAQ details
                        </div>

                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <form class="row g-3" method="post" action="<?= base_url('admin/faq/save') ?>">
                            <?php if ($faq): ?>
                                <input type="hidden" name="id" value="<?= esc($faq['id']) ?>">
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label" for="title">Title</label>
                                <input class="form-control" type="text" id="title" name="title" value="<?= $faq ? esc($faq['title']) : '' ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="content">Content</label>
                                <textarea id="content" class="form-control" name="content" rows="5" required><?= $faq ? esc($faq['content']) : '' ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    <i class="ri-check-line"></i> Submit
                                </button>
                                <a href="<?= base_url('admin/faq') ?>" class="btn btn-secondary">
                                    <i class="ri-close-line"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
