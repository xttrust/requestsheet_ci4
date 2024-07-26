<main id="main" class="main">

    <!-- Page Title and Breadcrumb Navigation -->
    <div class="pagetitle">
        <h1>Edit User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/dashboard'); ?>">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/users'); ?>">Manage Users</a>
                </li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Membership Status</h5>

                        <?php echo view('../../public/themes/backend/show_messages'); ?>

                        <div class="alert alert-info" role="alert">
                            Use this form to manually update user subscription.
                        </div>

                        <!-- Subscription management form -->
                        <form class="g-3" method="post" action="<?= base_url('admin/users/activate-membership/' . $user->id) ?>">
                            <?= csrf_field() ?>
                            <?php if ($user_subscription): ?>
                                <?php
                                $subscriptionEndDate = $user_subscription[0]['end_date'];
                                $currentDate = time(); // Current Unix timestamp
                                ?>

                                <?php if ($currentDate > $subscriptionEndDate): ?>
                                    <div class="alert alert-danger" role="alert">
                                        This user’s subscription has expired on
                                        <strong><?= date('F j, Y', $subscriptionEndDate) ?></strong>.
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-info" role="alert">
                                        This user has an active subscription until:
                                        <strong><?= date('F j, Y', $subscriptionEndDate) ?></strong>.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="alert alert-warning" role="alert">
                                    No active subscription found for this user.
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="m_id" class="form-label">Update User Membership</label>
                                <select class="form-select" id="m_id" name="m_id">
                                    <?php foreach ($memberships as $m): ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    <i class="ri-check-line"></i> Submit
                                </button>

                                <button class="btn btn-danger" type="submit" name="suspend" value="Suspend">
                                    <i class="ri-remove"></i> Suspend
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <!-- Page Header -->
                        <h5 class="card-title">Edit User Details</h5>
                        <div class="alert alert-info" role="alert">
                            Update user details as needed.
                        </div>

                        <!-- User details update form -->
                        <form class="row g-3" method="post" action="<?= base_url('admin/users/do_update/' . $user->id) ?>">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label">User Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="default" <?= $user->role == 'default' ? 'selected' : '' ?>>Default</option>
                                        <option value="member" <?= $user->role == 'member' ? 'selected' : '' ?>>Member</option>
                                        <option value="admin" <?= $user->role == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">User Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="active" <?= $user->status == 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= $user->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                        <option value="blocked" <?= $user->status == 'blocked' ? 'selected' : '' ?>>Blocked</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input class="form-control" type="text" value="<?= esc($user->username) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" name="first_name" value="<?= esc($user->first_name) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="<?= esc($user->last_name) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" value="<?= esc($user->email) ?>" readonly>
                            </div>

                            <div class="alert alert-warning" role="alert">
                                Leaving the password fields empty will keep the current password unchanged.
                                Only enter a new password if you wish to update it.
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Repeat Password</label>
                                <input class="form-control" type="password" name="repeat_password">
                            </div>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    <i class="ri-check-line"></i> Submit
                                </button>
                                <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">
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
