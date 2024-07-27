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
