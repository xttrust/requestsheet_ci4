<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('admin/', 'Admin::index');

$routes->get('manage-users', 'Users::manage');

$routes->get('login', 'Auth::index');
$routes->post('dologin', 'Auth::login');

$routes->get('logout', 'Auth::logout');
$routes->post('dologout', 'Auth::logout');

// Test Toutes
$routes->get('test', 'Home::test');
$routes->get('home/profile/(:any)', 'Home::profile/$1');
