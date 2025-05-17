<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Main Routes
$routes->get('/', 'Home::index');
$routes->get('/popular', 'Hotels::popular');
$routes->get('/category', 'Hotels::category');
$routes->get('/404', 'Hotels::category');


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

// Add Filter utk Auth
$routes->group('',['filter' => 'auth'], function($routes) {
    // User Profile Routes
    $routes->group('user', ['filter' => 'role:user'] , function($routes) {
        $routes->get('profile', 'UserController::profile');
        $routes->get('edit-profile', 'UserController::editProfile');
        $routes->post('update-profile', 'UserController::updateProfile');
        $routes->get('bookings', 'UserController::bookings');
        $routes->get('favorites', 'UserController::favorites');
    });
    
    // Admin Hotel Routes
    $routes->group('admin', ['filter' => 'role:hotel'] , function($routes) {
        $routes->get('/', 'AdminController::index');
        $routes->get('dashboard', 'AdminController::index');
        $routes->get('room', 'AdminController::room');
        $routes->group('rooms', function($routes) {
            $routes->get('/', 'AdminController::room');
            $routes->get('add', 'AdminController::addRoom');
            $routes->post('save', 'AdminController::saveRoom');
            $routes->get('edit/(:num)', 'AdminController::editRoom/$1');
            $routes->post('update/(:num)', 'AdminController::updateRoom/$1');
            $routes->get('delete/(:num)', 'AdminController::deleteRoom/$1');
        });
        $routes->get('booking', 'AdminController::booking');
        $routes->post('bookings/update-status', 'AdminController::updateStatus');
        $routes->post('setting/update', 'AdminController::updateHotelData');
        $routes->get('setting', 'AdminController::setting');
    });
    
    // Admin Hotel Routes
    $routes->group('super', ['filter' => 'role:admin'] , function($routes) {
        $routes->get('/', 'SuperController::index');
        $routes->get('dashboard', 'SuperController::index');
        $routes->get('hotel', 'SuperController::hotel');
        $routes->get('hotel/create', 'SuperController::createHotel');
        $routes->post('hotel/store-admin', 'SuperController::storeHotelAdmin');
        $routes->get('hotel/create-step2', 'SuperController::createHotelStep2');
        $routes->post('hotel/store', 'SuperController::storeHotel');
        $routes->get('hotel/edit/(:num)', 'SuperController::hotelEdit/$1');
        $routes->post('hotel/update/(:num)', 'SuperController::hotelUpdate/$1');
        $routes->get('hotel/delete/(:num)', 'SuperController::hotelDelete/$1');
    
        $routes->get('setting', 'SuperController::setting');
    });

    
});

// app/Config/Routes.php
$routes->get('/debug-session', function() {
    echo '<h1>Session Data</h1>';
    echo '<pre>';
    print_r(session()->get());
    echo '</pre>';
    
    if (session()->has('user')) {
        echo '<h2>User Role: ' . session()->get('user.role') . '</h2>';
    }
});



// Fallback Route
$routes->set404Override(function() {
    return view('errors/html/error_404');
});