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

                        <?php echo view('../../public/themes/backend/show_messages'); ?>

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
                                        <td>
                                            <?php
                                            $status = $user->status;
                                            $statusClass = '';
                                            $icon = '';
                                            $badgeTitle = '';

                                            switch ($status) {
                                                case 'active':
                                                    $statusClass = 'badge bg-success';
                                                    $icon = 'bi-check-circle';
                                                    $badgeTitle = "Activated";
                                                    break;
                                                case 'inactive':
                                                    $statusClass = 'badge bg-warning text-dark';
                                                    $icon = 'bi-exclamation-triangle';
                                                    $badgeTitle = "Not Activated";
                                                    break;
                                                case 'banned':
                                                    $statusClass = 'badge bg-danger';
                                                    $icon = 'bi-exclamation-octagon';
                                                    $badgeTitle = "Banned";
                                                    break;
                                                default:
                                                    $statusClass = 'badge bg-light text-dark';
                                                    $icon = 'bi-star';
                                                    $badgeTitle = "Pending";
                                            }
                                            ?>
                                            <span class="<?= $statusClass; ?>" title="<?= htmlspecialchars($badgeTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                                <i class="bi <?= $icon; ?> me-1"></i>
                                                <?= htmlspecialchars($badgeTitle, ENT_QUOTES, 'UTF-8'); ?>
                                            </span>
                                        </td>


                                        <td>
                                            <a href="<?= base_url('admin/users/edit/' . $user->id) ?>" class="btn btn-warning btn-sm">
                                                <i class="ri-pencil-line"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/users/delete/' . $user->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this membership?')">
                                                <i class="ri-delete-bin-line"></i> Delete
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
