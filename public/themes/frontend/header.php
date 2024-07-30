<!DOCTYPE html>
<html lang="en-US">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : "This is the next requestsheet website"; ?>">
        <meta name="author" content="kcon">
        <meta name="keywords" content="<?= isset($pageKeywords) ? $pageKeywords : ""; ?>"/>

        <meta property="og:title" content="<?= isset($pageTitle) ? $pageTitle : "Untitled Webpage"; ?>"/>
        <meta property="og:description" content="<?= isset($pageDescription) ? $pageDescription : "This is the next requestsheet website"; ?>"/>
        <meta property="og:image" content="<?= $themeUrl; ?>assets/images/facebook-post-image-default.jpg"/>

        <meta property="og:site_name" content="creativeigniter.com"/>

        <title><?= isset($pageTitle) ? $pageTitle : "Untitled Webpage"; ?></title>

        <link rel="icon" href="<?= base_url('public/uploads/images/' . ($settings['favicon'] ?? 'default_favicon.ico')) ?>">

        <!-- Bootstrap CSS -->
        <link href="<?= $themeUrl; ?>assets/vendor/bootstrap/5.1.3/bootstrap.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Lato:wght@100;300;400;700;900&family=Poppins:wght@200;300;400;600;700;800&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
        <!-- Icon Fonts -->
        <link href="<?= $themeUrl; ?>assets/vendor/icomoon/icomoon.min.css" rel="stylesheet">

        <!-- Off Canvas Menu - Default Theme -->
        <link href="<?= $themeUrl; ?>assets/vendor/offcanvas-nav/hc-offcanvas-nav.css" rel="stylesheet" />

        <!-- Theme CSS -->
        <link href="<?= $themeUrl; ?>assets/css/theme.css" rel="stylesheet">
        <link href="<?= $themeUrl; ?>assets/css/theme-colors.css" rel="stylesheet">
        <link href="<?= $themeUrl; ?>assets/css/custom.css" rel="stylesheet">

        <!-- Theme Preview Only CSS -->
        <link href="<?= $themeUrl; ?>assets/css/theme-preview-color-styler.css" rel="stylesheet">

        <!-- jQuery -->
        <script src="<?= $themeUrl; ?>assets/vendor/jquery/jquery.min.js"></script>

        <!-- Slick (carousel) -->
        <link href="<?= $themeUrl; ?>assets/vendor/slick/1.8.1/slick.css" rel="stylesheet">
        <link href="<?= $themeUrl; ?>assets/vendor/slick/1.8.1/slick-theme-skilltech.css" rel="stylesheet">

        <!-- Simple Forms -->
        <!-- <link rel="stylesheet" href="assets/vendor/simple-forms/css/simple-forms-skilltech-mod.css"> -->

    </head>

    <body class="sk__homepage sk__home-combo-slider dark-shade-1-bg">

        <main id="primary" class="site-main">

            <!-- Master Curtain Effect -->
            <section class="sk__master-curtain">
                <div class="mcurtain mcurtain-left"></div>
                <div class="mcurtain mcurtain-center"></div>
                <div class="mcurtain mcurtain-right"></div>
            </section>

            <!-- Back to top button -->
            <div class="sk__back-to-top-wrap">
                <a class="sk__back-to-top" href="#smooth-content"><span class="sk__back-to-top"></span></a>
            </div>

            <!-- Navigation Menu ================================================== -->
            <div class="sk__mobile-menu-bar"></div>

            <!-- Mobile Menu Logo -->
            <a class="sk__mobile-main-logo" href="<?= base_url(); ?>">
                <img alt="<?= esc($settings['website_name'] ?? 'Default Website Name') ?>"
                     src="<?= base_url('public/uploads/images/' . ($settings['logo'] ?? 'default_logo.png')) ?>">
            </a>

            <nav id="main-nav" style="opacity: 0;" class="sk__menu navbar sk__navbar navbar-expand-lg navbar-dark static-top">

                <!-- Desktop Menu Logo -->
                <a class="navbar-brand" href="<?= base_url(); ?>">
                    <img id="sk__main-logo" alt="<?= esc($settings['website_name'] ?? 'Default Website Name') ?>"
                         src="<?= base_url('public/uploads/images/' . ($settings['logo'] ?? 'default_logo.png')) ?>">
                </a>

                <!-- The Menu -->
                <ul class="navbar-nav ms-auto">

                    <!-- Mobile Menu Logo (only use if "close" buttons are set to false in JS) -->
                    <li data-nav-custom-content class="custom-content sk__mobile-menu-logo">
                        <a class="sk__mobile-navbar-brand" href="<?= base_url(); ?>">
                            <img alt="<?= esc($settings['website_name'] ?? 'Default Website Name') ?>"
                                 src="<?= base_url('public/uploads/images/' . ($settings['logo'] ?? 'default_logo.png')) ?>">
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-center" href="<?= base_url(); ?>">
                            <span class="sk__menu-icon">
                                <span class="icon-home"></span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-center" href="<?= base_url('top-song-requests'); ?>">
                            <span class="sk__menu-icon"><span class="icon-music1"></span></span>Top Requests
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-center" href="<?= base_url('features'); ?>">
                            <span class="sk__menu-icon"><span class="icon-list1"></span></span>Features
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pricing'); ?>">
                            <span class="sk__menu-icon"><span class="icon-shopping-cart"></span></span>Pricing
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('contact-us'); ?>">
                            <span class="sk__menu-icon"><span class="icon-envelope"></span></span>Contact
                        </a>
                    </li>

                    <?php if (!$loggedUser): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login'); ?>">
                                <span class="sk__menu-icon"><span class="icon-lock1"></span></span>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('register'); ?>">
                                <span class="sk__menu-icon"><span class="icon-shield1"></span></span>Register
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Logged user menu -->
                        <li class="nav-item menu-item-has-children">
                            <a class="nav-link hvr-underline-from-center" href="#"><?= $loggedUser['username']; ?></a>
                            <ul class="sk__submenu-ul">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('profile/dashboard/' . $loggedUser['username']); ?>">
                                        <span class="sk__menu-icon">
                                            <span class="icon-dashboard"></span>
                                        </span>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('profile/' . $loggedUser['username']); ?>">
                                        <span class="sk__menu-icon">
                                            <span class="icon-profile"></span>
                                        </span>Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('profile/settings/' . $loggedUser['username']); ?>">
                                        <span class="sk__menu-icon">
                                            <span class="icon-settings"></span>
                                        </span>Settings
                                    </a>
                                </li>
                                <?php if ($loggedUser['role'] === 'admin') : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">
                                            <span class="sk__menu-icon"><span class="icon-wrench"></span></span>Admin
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('logout'); ?>">
                                        <span class="sk__menu-icon"><span class="icon-sign-out"></span></span>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- Mobile Menu Social Icons -->
                    <li data-nav-custom-content class="custom-content sk__menu-socials">
                        <section class="footer-socials-section">
                            <h3><strong>Connect</strong> with us</h3>
                            <div class="footer-socials-inner">
                                <div class="footer-socials">
                                    <a class="social-icons" href="#" target="_blank">
                                        <span><span class="icon-facebook1"></span></span>
                                    </a>
                                    <a class="social-icons" href="#" target="_blank">
                                        <span><span class="icon-twitter1"></span></span>
                                    </a>
                                    <a class="social-icons" href="#" target="_blank">
                                        <span><span class="icon-behance1"></span></span>
                                    </a>
                                    <a class="social-icons" href="#" target="_blank">
                                        <span><span class="icon-dribbble1"></span></span>
                                    </a>
                                </div>
                            </div>
                        </section>
                    </li>

                </ul>
            </nav>
            <!-- /.sk__menu -->

