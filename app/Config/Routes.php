<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Main Routes
$routes->get('/', 'Home::index');
$routes->get('/popular', 'Hotels::popular');
$routes->get('/category', 'Hotels::category');
$routes->get('/favorite', 'Users::favorites');

// Hotel Routes
$routes->group('hotels', function($routes) {
    $routes->get('/', 'Hotels::index');
    $routes->get('(:num)', 'Hotels::detail/$1');
    $routes->get('search', 'Hotels::search');
});

// Booking Routes
$routes->group('booking', function($routes) {
    $routes->get('/', 'Bookings::index');
    $routes->get('(:num)', 'Bookings::detail/$1');
    $routes->get('(:num)/payment', 'Bookings::payment/$1');
    $routes->get('(:num)/review', 'Bookings::review/$1');
    $routes->post('(:num)/confirm', 'Bookings::confirm/$1');
});

// Authentication Routes
$routes->group('', function($routes) {
    $routes->get('signup', 'AuthController::signup');
    $routes->post('register', 'AuthController::register');
    $routes->get('login', 'AuthController::index');
    $routes->post('authenticate', 'AuthController::authenticate');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->post('reset-password', 'AuthController::resetPassword');
});

// User Profile Routes
$routes->group('user', function($routes) {
    $routes->get('profile', 'Users::profile');
    $routes->get('edit-profile', 'Users::editProfile');
    $routes->post('update-profile', 'Users::updateProfile');
    $routes->get('bookings', 'Users::bookings');
});

// Admin Routes
$routes->group('admin', ['filter' => 'admin-auth'], function($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('authenticate', 'Admin\Auth::authenticate');
    
    $routes->group('hotels', function($routes) {
        $routes->get('/', 'Admin\Hotels::index');
        $routes->get('add', 'Admin\Hotels::add');
        $routes->post('save', 'Admin\Hotels::save');
        $routes->get('(:num)/edit', 'Admin\Hotels::edit/$1');
        $routes->post('(:num)/update', 'Admin\Hotels::update/$1');
        $routes->get('(:num)/delete', 'Admin\Hotels::delete/$1');
    });
    
    $routes->group('bookings', function($routes) {
        $routes->get('/', 'Admin\Bookings::index');
        $routes->get('(:num)', 'Admin\Bookings::detail/$1');
        $routes->post('(:num)/update-status', 'Admin\Bookings::updateStatus/$1');
    });
});

// API Routes (if needed)
$routes->group('api', function($routes) {
    $routes->get('cities', 'Api::cities');
    $routes->get('hotels', 'Api::hotels');
    $routes->get('hotel/(:num)', 'Api::hotelDetail/$1');
});

// Fallback Route
$routes->set404Override(function() {
    return view('errors/html/error_404');
});