<main id="main" class="main">

    <!-- Page Title and Breadcrumb Navigation -->
    <div class="pagetitle">
        <h1>Manage Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/dashboard'); ?>">Admin</a>
                </li>
                <li class="breadcrumb-item active">Manage Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Page Header -->
                        <h5 class="card-title">View All Users</h5>
                        <!-- Information Alert Box -->
                        <div class="alert alert-info" role="alert">
                            <strong>Manage Users:</strong> On this page, you can manage user accounts. You can view details, edit user information, approve new users, and delete accounts if necessary. Use the search and filter options within the table for easy navigation.
                        </div>

                        <!-- DataTable for Managing Users -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>UserID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through the list of users and display each user's information in a table row -->
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $user->id; ?></td>
                                        <td><?= $user->username; ?></td>
                                        <td><?= $user->email; ?></td>
                                        <td><?= $user->status; ?></td>
                                        <td>
                                            <!-- Edit User Button -->
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/users/edit/' . $user->id); ?>">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <!-- Delete User Button -->
                                            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/users/delete/' . $user->id); ?>">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table><!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
