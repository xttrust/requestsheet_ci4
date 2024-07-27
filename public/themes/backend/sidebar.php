<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('admin'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url(); ?>" target="_blank">
                <i class="bi bi-globe"></i>
                <span>Frontend</span>
            </a>
        </li><!-- End Frontend Nav -->

        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-target="#modules-nav" data-bs-toggle="collapse">
                <i class="bi bi-gear"></i><span>Modules</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="modules-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('admin/users'); ?>">Users</a>
                </li>
                <li>
                    <a href="<?= base_url('admin/faq'); ?>">FAQ</a>
                </li>
                <li>
                    <a href="<?= base_url('admin/pages'); ?>">Pages</a>
                </li>
                <li>
                    <a href="<?= base_url('admin/membership'); ?>">Membership Prices</a>
                </li>
                <li>
                    <a href="<?= base_url('admin/subscriptions'); ?>">Subscriptions</a>
                </li>
            </ul>
        </li><!-- End Modules Nav -->


        <li class="nav-heading">Settings</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-sliders"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="settings-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('admin/email-settings'); ?>">Email</a>
                </li>
                <li>
                    <a href="<?= base_url('admin/layout-settings'); ?>">Layout</a>
                </li>
            </ul>
        </li><!-- End Settings Nav -->

    </ul>

</aside><!-- End Sidebar -->
