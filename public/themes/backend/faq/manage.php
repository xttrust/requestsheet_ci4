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
                                    <th>FAQ ID</th>
                                    <th>Title</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($faqs as $faq): ?>
                                    <tr>
                                        <td><?= $faq['id']; ?></td>
                                        <td><?= $faq['title']; ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/faq/edit/' . $faq['id']) ?>" class="btn btn-warning btn-sm">
                                                <i class="ri-pencil-line"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/faq/delete/' . $faq['id']) ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this membership?')">
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

</main>
