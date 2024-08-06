<?php

use CodeIgniter\Router\RouteCollection;

// Default Route
$routes->get('/', 'Home::index');

/*
 * Auth Routes
 */
// Display registration form (GET)
$routes->get('register', 'Register::index');

// Process registration form submission (POST)
$routes->post('register', 'Register::register');

// Process account activation from user email
$routes->get('activate/(:any)', 'Auth::activateAccount/$1');

// Display login form (GET)
$routes->get('login', 'Auth::index');

// Process login form submission (POST)
$routes->post('login', 'Auth::login');

// Log out user (GET)
$routes->get('logout', 'Auth::logout');

/*
 * Password Reset Routes
 */
// Display reset password request form (GET)
$routes->get('reset-password', 'ResetPassword::index');

// Process reset password request (POST)
$routes->post('reset-password', 'ResetPassword::requestReset');

// Display form to reset password using token (GET)
$routes->get('reset-password/reset-form/(:any)', 'ResetPassword::resetForm/$1');

// Process new password submission (POST)
$routes->post('reset-password/update-password', 'ResetPassword::updatePassword');

// Test route for auth user
$routes->get('profile/(:any)', 'Home::profile/$1');

/*
 * Admin Routes
 * Routes for admin-specific functionalities
 */
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    // Display admin dashboard (GET)
    $routes->get('dashboard', 'Admin::dashboard');

    /* Users Routes */
    $routes->get('users', 'Users::manage');
    $routes->get('users/edit/(:any)', 'Users::edit/$1');
    $routes->post('users/edit/(:any)', 'Users::save/$1');
    $routes->post('users/activate-membership/(:any)', 'Users::activateMembership/$1');
    $routes->post('users/approve/(:num)', 'Users::approve/$1');
    $routes->get('users/delete/(:num)', 'Users::delete/$1');

    /* FAQ Routes */
    $routes->get('faq', 'Faq::manage');
    $routes->get('faq/edit/(:any)', 'Faq::edit/$1');
    $routes->get('faq/edit', 'Faq::edit');
    $routes->post('faq/save', 'Faq::save');
    $routes->get('faq/delete/(:num)', 'Faq::delete/$1');

    /* Membership Routes */
    $routes->get('membership', 'Membership::manage');
    $routes->get('membership/edit/(:num)', 'Membership::edit/$1');
    $routes->get('membership/edit', 'Membership::edit');
    $routes->post('membership/save', 'Membership::save');
    $routes->get('membership/delete/(:num)', 'Membership::delete/$1');

    // Pages management routes
    $routes->get('pages', 'Pages::manage');
    $routes->get('pages/edit/(:num)', 'Pages::edit/$1');
    $routes->get('pages/edit', 'Pages::edit');
    $routes->post('pages/save', 'Pages::save');
    $routes->get('pages/delete/(:num)', 'Pages::delete/$1');

    // Subscriptions management routes
    $routes->get('subscriptions', 'Subscriptions::manage');
    $routes->get('subscriptions/edit/(:num)', 'Subscriptions::edit/$1');
    $routes->get('subscriptions/edit', 'Subscriptions::edit');
    $routes->post('subscriptions/save', 'Subscriptions::save');
    $routes->get('subscriptions/delete/(:num)', 'Subscriptions::delete/$1');

    // Settings
    $routes->get('settings/email', 'AppSettings::email');
    $routes->post('settings/email', 'AppSettings::email');

    $routes->get('settings/general', 'AppSettings::general');
    $routes->post('settings/general', 'AppSettings::general');

    // Layout Settings Routes
    $routes->get('settings/layout', 'AppSettings::layout');
    // Handle the uploads
    $routes->post('settings/layout/upload-logo', 'AppSettings::uploadLogo');
    $routes->post('settings/layout/upload-favicon', 'AppSettings::uploadFavicon');

    $routes->get('settings/security', 'AppSettings::security');
    $routes->post('settings/save', 'AppSettings::saveSettings');
});

/*
 * Additional Routes
 * Miscellaneous routes for the website frontend
 */
// Display home page (GET)
$routes->get('home', 'Home::index');
// Display about page (GET)
$routes->get('about', 'Home::about');
// Display contact page (GET)
$routes->get('contact', 'Home::contact');
// Display FAQ page (GET)
$routes->get('faq', 'Home::faq');

/**
 * API Routes
 * Routes to handle all API calls
 */
// Routes for requests
$routes->get('/api/requests/sorted', 'Requests::getAllRequestsSorted');
$routes->get('/api/requests/rejected', 'Requests::getAllRejectedRequests');
$routes->delete('/api/requests/delete/user/(:num)', 'Requests::deleteRequestsByUserId/$1');

$routes->get('/api/requests/(:segment)', 'Requests::getRequestById/$1');
$routes->patch('/api/requests/(:segment)', 'Requests::updateRequest/$1');
$routes->patch('/api/requests/approve/(:segment)', 'Requests::approveRequest/$1');
$routes->patch('/api/requests/reject/(:segment)', 'Requests::rejectRequest/$1');
$routes->delete('/api/requests/delete/(:segment)', 'Requests::deleteRequest/$1');

