<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Main Routes
$routes->get('/', 'Home::index');
$routes->get('/popular', 'Hotels::popular');
$routes->get('/category', 'Hotels::category');

// Hotel Routes
$routes->group('hotels', function($routes) {
    $routes->get('/', 'Hotels::index');
    $routes->get('(:num)', 'Hotels::detail/$1');
    $routes->get('search', 'Hotels::search');
});

// app/Config/Routes.php
$routes->post('hotels/(:num)/favorite', 'Users::toggleFavorite/$1');
$routes->post('reviews/store', 'Reviews::store');
$routes->post('bookings/store', 'Bookings::store');

// Booking Routes
$routes->group('booking', function($routes) {
    $routes->get('/', 'Bookings::index');
    $routes->get('(:num)', 'Bookings::detail/$1');
    $routes->get('(:num)/payment', 'Bookings::payment/$1');
    $routes->get('(:num)/review', 'Bookings::review/$1');
    $routes->post('(:num)/confirm', 'Bookings::confirm/$1');
});

// Auth Routes
$routes->group('', function($routes) {
    $routes->get('login', 'AuthController::index');
    $routes->post('login', 'AuthController::loginProcess');
    $routes->get('signup', 'AuthController::signup');
    $routes->post('register', 'AuthController::registerProcess');
    $routes->get('logout', 'AuthController::logout');
});

// User Profile Routes
$routes->group('user', function($routes) {
    $routes->get('profile', 'UserController::profile');
    $routes->get('edit-profile', 'UserController::editProfile');
    $routes->post('update-profile', 'UserController::updateProfile');
    $routes->get('bookings', 'UserController::bookings');
    $routes->get('favorites', 'UserController::favorites');
});

// Admin Hotel Routes
$routes->group('admin', function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('room', 'AdminController::room');
    $routes->get('booking', 'AdminController::booking');
    $routes->get('setting', 'AdminController::setting');
});

// Admin Hotel Routes
$routes->group('super', function($routes) {
    $routes->get('/', 'SuperController::index');
    $routes->get('dashboard', 'SuperController::index');
    $routes->get('setting', 'SuperController::setting');
});



// Fallback Route
$routes->set404Override(function() {
    return view('errors/html/error_404');
});