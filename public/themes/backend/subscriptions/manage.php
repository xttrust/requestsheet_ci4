<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= esc($pageTitle) ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                <li class="breadcrumb-item active">Manage Subscriptions</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Subscriptions List</h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Membership ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subscriptions as $subscription): ?>
                                    <tr>
                                        <td><?= esc($subscription['id']) ?></td>
                                        <td><?= esc($subscription['user_id']) ?></td>
                                        <td><?= esc($subscription['membership_id']) ?></td>
                                        <td><?= date('Y-m-d H:i:s', esc($subscription['start_date'])) ?></td>
                                        <td><?= date('Y-m-d H:i:s', esc($subscription['end_date'])) ?></td>
                                        <td>
                                            <?php
                                            $status = esc($subscription['status']); // Ensure the status is properly escaped
                                            $statusClass = '';
                                            $icon = '';
                                            $badgeTitle = '';

                                            switch ($status) {
                                                case 'active':
                                                    $statusClass = 'badge bg-success';
                                                    $icon = 'ri-check-line'; // Remix icon for active status
                                                    $badgeTitle = "Active";
                                                    break;
                                                case 'inactive':
                                                    $statusClass = 'badge bg-secondary'; // Using bg-secondary for inactive
                                                    $icon = 'ri-close-line'; // Remix icon for inactive status
                                                    $badgeTitle = "Inactive";
                                                    break;
                                                default:
                                                    $statusClass = 'badge bg-light text-dark';
                                                    $icon = 'ri-question-line'; // Remix icon for unknown status
                                                    $badgeTitle = "Unknown";
                                            }
                                            ?>
                                            <span class="<?= $statusClass; ?>" title="<?= htmlspecialchars($badgeTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                                <i class="ri <?= $icon; ?> me-1"></i>
                                                <?= htmlspecialchars($badgeTitle, ENT_QUOTES, 'UTF-8'); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('admin/subscriptions/edit/' . $subscription['id']) ?>"
                                               class="btn btn-warning btn-sm"><i class="ri-edit-line"></i> Edit</a>
                                            <a href="<?= base_url('admin/subscriptions/delete/' . $subscription['id']) ?>"
                                               class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
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
