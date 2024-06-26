<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('admin/', 'Admin::index');

$routes->get('manage-users', 'Users::manage');

$routes->get('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
