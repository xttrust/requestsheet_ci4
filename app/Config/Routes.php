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

// Display forgot password form (GET)
$routes->get('forgot-password', 'Auth::forgotPassword');

// Process forgot password form submission (POST)
$routes->post('forgot-password', 'Auth::processForgotPassword');

// Display reset password form (GET)
$routes->get('reset-password/(:any)', 'Auth::resetPassword/$1');

// Process reset password form submission (POST)
$routes->post('reset-password', 'Auth::processResetPassword');

// Test route for profile
$routes->get('profile/(:any)', 'Home::profile/$1');

/*
 * Admin Routes
 * Routes for admin-specific functionalities
 */
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    // Display admin dashboard (GET)
    $routes->get('dashboard', 'Admin::dashboard');
    // Manage users (GET)
    $routes->get('users', 'Admin::manageUsers');
    // Approve user (POST)
    $routes->post('users/approve/(:num)', 'Admin::approveUser/$1');
    // Delete user (POST)
    $routes->post('users/delete/(:num)', 'Admin::deleteUser/$1');
    // Manage feedback (GET)
    $routes->get('feedback', 'Admin::manageFeedback');
});

/*
 * DJ Profile Management Routes
 * Routes for DJ profile management
 */



//$routes->group('dj', ['filter' => 'auth:dj'], function ($routes) {
//    // Display DJ profile (GET)
//    $routes->get('profile', 'DJ::profile');
//    // Update DJ profile (POST)
//    $routes->post('profile/update', 'DJ::updateProfile');
//    // Upload DJ profile picture (POST)
//    $routes->post('profile/picture', 'DJ::uploadPicture');
//    // Display DJ availability (GET)
//    $routes->get('availability', 'DJ::availability');
//    // Update DJ availability (POST)
//    $routes->post('availability/update', 'DJ::updateAvailability');
//});

/*
 * Song Request System Routes
 * Routes for song request submission and management
 */
$routes->group('songs', ['filter' => 'auth'], function ($routes) {
    // Display song request form (GET)
    $routes->get('request', 'Songs::requestForm');
    // Submit song request (POST)
    $routes->post('request', 'Songs::submitRequest');
    // View song requests (GET)
    $routes->get('requests', 'Songs::viewRequests');
    // Mark song request as played (POST)
    $routes->post('requests/mark-played/(:num)', 'Songs::markPlayed/$1');
});

/*
 * Tipping System Routes
 * Routes for users to tip DJs and DJs to view tip history
 */
$routes->group('tips', ['filter' => 'auth'], function ($routes) {
    // Display tipping form for a DJ (GET)
    $routes->get('tip/(:any)', 'Tips::tipForm/$1');
    // Process tip submission (POST)
    $routes->post('tip/(:any)', 'Tips::processTip/$1');
    // View tipping history (GET)
    $routes->get('history', 'Tips::viewHistory');
});

/*
 * Social Media Integration Routes
 * Routes for DJs to manage social media links
 */
$routes->group('social', ['filter' => 'auth:dj'], function ($routes) {
    // Display social media links (GET)
    $routes->get('links', 'Social::links');
    // Update social media links (POST)
    $routes->post('links/update', 'Social::updateLinks');
});

/*
 * QR Code Integration Routes
 * Routes for generating and downloading QR codes for DJs
 */
$routes->group('qr', ['filter' => 'auth:dj'], function ($routes) {
    // Generate QR code (GET)
    $routes->get('generate', 'QR::generate');
    // Download QR code (GET)
    $routes->get('download', 'QR::download');
});

/*
 * Subscription Management Routes
 * Routes for managing DJ subscriptions
 */
$routes->group('subscriptions', ['filter' => 'auth:dj'], function ($routes) {
    // View subscription plans (GET)
    $routes->get('plans', 'Subscriptions::viewPlans');
    // Subscribe to a plan (POST)
    $routes->post('subscribe/(:any)', 'Subscriptions::subscribe/$1');
    // Manage current subscription (GET)
    $routes->get('manage', 'Subscriptions::manage');
    // Upgrade subscription (POST)
    $routes->post('upgrade', 'Subscriptions::upgrade');
    // Downgrade subscription (POST)
    $routes->post('downgrade', 'Subscriptions::downgrade');
    // Cancel subscription (POST)
    $routes->post('cancel', 'Subscriptions::cancel');
});

/*
 * Payment Integration Routes (Stripe)
 * Routes for processing payments and viewing payment history
 */
$routes->group('payments', ['filter' => 'auth:dj'], function ($routes) {
    // Process payment (POST)
    $routes->post('process', 'Payments::process');
    // View payment history (GET)
    $routes->get('history', 'Payments::viewHistory');
});

/*
 * Notifications and Alerts Routes
 * Routes for managing notifications for DJs and users
 */
$routes->group('notifications', ['filter' => 'auth'], function ($routes) {
    // View DJ notifications (GET)
    $routes->get('dj', 'Notifications::djNotifications');
    // View user notifications (GET)
    $routes->get('user', 'Notifications::userNotifications');
});

/*
 * Security and Compliance Routes
 * Routes for managing security settings, accessible only by admins
 */
$routes->group('security', ['filter' => 'auth:admin'], function ($routes) {
    // View security settings (GET)
    $routes->get('settings', 'Security::settings');
    // Update security settings (POST)
    $routes->post('update', 'Security::updateSettings');
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
