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
// $routes->group('booking', function($routes) {
//     $routes->get('/', 'BookingController::store');
//     $routes->get('(:num)/payment', 'BookingController::payment/$1');
//     $routes->get('(:num)/review', 'BookingController::review/$1');
//     $routes->post('(:num)/confirm', 'BookingController::confirm/$1');
// $routes->get('(:num)', 'BookingController::detail/$1');
// });

$routes->group('booking', function($routes) {
    $routes->get('new/(:num)/(:num?)', 'BookingController::new/$1/$2');
    $routes->post('create', 'BookingController::create');
    $routes->get('show/(:num)', 'BookingController::show/$1');
    $routes->post('upload/(:num)', 'BookingController::uploadPayment/$1');
    $routes->post('cancel/(:num)', 'BookingController::cancel/$1');
});

// Di dalam group yang sudah ada (jika ada)
$routes->get('hotel/(:num)/book/(:num?)', 'Hotels::book/$1/$2');

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

        $routes->group('gallery', function($routes) {
            $routes->get('/', 'HotelGalleryController::index/$1');
            $routes->post('upload/(:num)', 'HotelGalleryController::upload/$1');
            $routes->delete('delete/(:num)', 'HotelGalleryController::delete/$1');
        });

        $routes->group('room-gallery', function($routes) {
            $routes->get('(:num)', 'RoomGalleryController::index/$1');
            $routes->post('upload/(:num)', 'RoomGalleryController::upload/$1');
            $routes->get('delete/(:num)', 'RoomGalleryController::delete/$1');
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

        $routes->group('users', function($routes) {
            $routes->get('/', 'SuperController::users');
            $routes->get('create', 'SuperController::usersCreate');
            $routes->post('store', 'SuperController::usersStore');
            $routes->get('delete/(:num)', 'SuperController::usersDelete/$1');
            $routes->get('export', 'SuperController::usersExport');
            $routes->get('reset-password/(:num)', 'SuperController::usersResetPassword/$1'); 
        });


        $routes->group('cities', ['filter' => 'auth'], function($routes) {
            $routes->post('test', 'CityController::kontol');
            $routes->get('/', 'CityController::index');
            $routes->get('create', 'CityController::create');
            $routes->post('store', 'CityController::store');
            $routes->get('edit/(:num)', 'CityController::edit/$1');
            $routes->post('update/(:num)', 'CityController::update/$1');
            $routes->get('delete/(:num)', 'CityController::delete/$1');
        });
    
        $routes->get('setting', 'SuperController::setting');
    });

    
});

$routes->get('/tests', 'TestController::testUser');

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