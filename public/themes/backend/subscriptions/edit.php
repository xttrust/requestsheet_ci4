<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= esc($pageTitle) ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/subscriptions'); ?>">Subscriptions</a></li>
                <li class="breadcrumb-item active"><?= $subscription ? 'Edit Subscription' : 'Add Subscription' ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $subscription ? 'Edit Subscription' : 'Add Subscription' ?></h5>
                        <form action="<?= base_url('admin/subscriptions/save'); ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $subscription ? esc($subscription['id']) : '' ?>">
                            <div class="mb-3">
                                <label class="form-label" for="user_id">User ID</label>
                                <input class="form-control"
                                       type="number"
                                       id="user_id"
                                       name="user_id"
                                       value="<?= $subscription ? esc($subscription['user_id']) : '' ?>"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="membership_id">Membership ID</label>
                                <input class="form-control"
                                       type="number"
                                       id="membership_id"
                                       name="membership_id"
                                       value="<?= $subscription ? esc($subscription['membership_id']) : '' ?>"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="start_date">Start Date</label>
                                <input class="form-control"
                                       type="date"
                                       id="start_date"
                                       name="start_date"
                                       value="<?= $subscription ? esc($subscription['start_date']) : '' ?>"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="end_date">End Date</label>
                                <input class="form-control"
                                       type="date"
                                       id="end_date"
                                       name="end_date"
                                       value="<?= $subscription ? esc($subscription['end_date']) : '' ?>"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active" <?= $subscription && $subscription['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $subscription && $subscription['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit" name="submit" value="Submit">
                                    <i class="ri-check-line"></i> Submit
                                </button>
                                <a href="<?= base_url('admin/subscriptions') ?>" class="btn btn-secondary">
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
