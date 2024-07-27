<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage FAQs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                <li class="breadcrumb-item active">Manage FAQs</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View All FAQs</h5>
                        <div class="alert alert-info" role="alert">
                            <strong>Manage FAQs:</strong> On this page, you can manage FAQs. You can view details, edit information, create new FAQs, and delete if necessary. Use the search and filter options within the table for easy navigation.
                        </div>

                        <div class="col-2">
                            <a class="btn btn-secondary" href="<?= base_url('admin/faq/edit'); ?>">
                                <i class="ri-add-box-line"></i> Add new FAQ
                            </a>
                        </div>

                        <hr>

                        <?= view('../../public/themes/backend/show_messages'); ?>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th class="col-1">FAQ ID</th>
                                    <th class="col-10">Title</th>
                                    <th class='col-1'>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($faqs as $faq): ?>
                                    <tr>
                                        <td><?= $faq['id']; ?></td>
                                        <td><?= $faq['title']; ?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/faq/edit/' . $faq['id']); ?>">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/faq/delete/' . $faq['id']); ?>">
                                                <i class="ri-delete-bin-line"></i>
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

</main>
