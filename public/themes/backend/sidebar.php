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
            <a class="nav-link collapsed" data-bs-target="#modules-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Modules</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="modules-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('admin/users'); ?>">
                        <i class="bi bi-people"></i><span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/pages'); ?>">
                        <i class="bi bi-file-earmark"></i><span>Pages</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/news'); ?>">
                        <i class="bi bi-newspaper"></i><span>News</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/membership'); ?>">
                        <i class="bi bi-currency-exchange"></i><span>Membership Prices</span>
                    </a>
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
                    <a href="<?= base_url('admin/email-settings'); ?>">
                        <i class="bi bi-envelope"></i><span>Email</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/layout-settings'); ?>">
                        <i class="bi bi-layout-text-window-reverse"></i><span>Layout</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Settings Nav -->

    </ul>

</aside><!-- End Sidebar -->
