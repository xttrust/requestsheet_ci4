<main id="main" class="main">

    <!-- Page Title and Breadcrumb Navigation -->
    <div class="pagetitle">
        <h1>Manage Pages</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/dashboard'); ?>">Admin</a>
                </li>
                <li class="breadcrumb-item active">Manage Pages</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Page Header -->
                        <h5 class="card-title">View All Pages</h5>
                        <!-- Information Alert Box -->
                        <div class="alert alert-info" role="alert">
                            Manage your pages here.
                        </div>

                        <a href="<?= base_url('admin/pages/edit') ?>" class="btn btn-primary">
                            <i class="ri-add-line"></i> Add New Page
                        </a>

                        <hr>

                        <!-- Display Form Messages -->
                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <!-- Pages Table -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pages as $page): ?>
                                    <tr>
                                        <td><?= esc($page['id']) ?></td>
                                        <td><?= esc($page['name']) ?></td>
                                        <td><?= esc($page['position']) ?></td>
                                        <td><?= esc($page['status']) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/pages/edit/' . esc($page['id'])) ?>" class="btn btn-warning btn-sm">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/pages/delete/' . esc($page['id'])) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this page?');">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
