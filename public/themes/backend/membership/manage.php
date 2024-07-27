<main id="main" class="main">

    <!-- Page Title and Breadcrumb Navigation -->
    <div class="pagetitle">
        <h1>Manage Memberships</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/dashboard'); ?>">Admin</a>
                </li>
                <li class="breadcrumb-item active">Manage Memberships</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Page Header -->
                        <h5 class="card-title">Membership List</h5>
                        <div class="alert alert-info" role="alert">
                            Here you can manage your memberships.
                        </div>

                        <!-- Add New Membership Button -->
                        <a href="<?= base_url('admin/membership/edit') ?>" class="btn btn-primary mt-3">
                            <i class="ri-add-line"></i> Add New Membership
                        </a>

                        <hr>

                        <!-- Display Form Messages -->
                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <!-- Membership Table -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Duration (Days)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($memberships as $membership): ?>
                                    <tr>
                                        <td><?= esc($membership['id']) ?></td>
                                        <td><?= esc($membership['name']) ?></td>
                                        <td><?= number_format(esc($membership['price']), 2) ?></td>
                                        <td>
                                            <?php
                                            $seconds = esc($membership['time']);
                                            $days = round($seconds / 86400); // Convert seconds to days
                                            echo number_format($days); // Format to 2 decimal places
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/membership/edit/' . $membership['id']) ?>" class="btn btn-warning btn-sm">
                                                <i class="ri-pencil-line"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/membership/delete/' . $membership['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this membership?')">
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
