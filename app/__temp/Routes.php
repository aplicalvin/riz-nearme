<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Homepage
$routes->get('/', 'Home::index');

// ==================== AUTENTIKASI ====================
$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    // Login/Register
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('register', 'AuthController::register', ['filter' => 'guest']);
    $routes->post('register', 'AuthController::attemptRegister', ['filter' => 'guest']);
    $routes->get('logout', 'AuthController::logout');
    
    // Reset Password
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->post('forgot-password', 'AuthController::attemptForgotPassword');
    $routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1');
    $routes->post('reset-password', 'AuthController::attemptResetPassword');
});

// ==================== PUBLIC ROUTES ====================
$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    // Hotel
    $routes->get('hotels', 'HotelController::index');
    $routes->get('hotels/(:num)', 'HotelController::show/$1');
    $routes->get('hotels/city/(:num)', 'HotelController::byCity/$1');
    
    // Reviews
    $routes->get('reviews/hotel/(:num)', 'ReviewController::hotelReviews/$1');
});

// ==================== USER ROUTES (Harus Login) ====================
$routes->group('', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function($routes) {
    // Booking
    $routes->get('bookings', 'BookingController::index');
    $routes->get('bookings/(:num)', 'BookingController::show/$1');
    $routes->get('bookings/create/(:num)', 'BookingController::create/$1');
    $routes->post('bookings', 'BookingController::store');
    $routes->post('bookings/(:num)/cancel', 'BookingController::cancel/$1');
    
    // Payment
    $routes->get('payments/(:num)', 'PaymentController::show/$1');
    $routes->post('payments/upload-proof', 'PaymentController::uploadProof');
    
    // Profile
    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/edit', 'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');
    $routes->post('profile/update-photo', 'ProfileController::updatePhoto');
    
    // Favorites
    $routes->post('favorites', 'FavoriteController::toggle');
    
    // Reviews
    $routes->post('reviews', 'ReviewController::store');
});

// ==================== ADMIN HOTEL ROUTES ====================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'role:hotel'], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'AdminController::dashboard');
    
    // Hotel Management
    $routes->get('hotels', 'HotelController::index');
    $routes->get('hotels/edit', 'HotelController::edit');
    $routes->post('hotels/update', 'HotelController::update');
    $routes->post('hotels/update-photo', 'HotelController::updatePhoto');
    
    // Room Management
    $routes->get('rooms', 'RoomController::index');
    $routes->match(['get', 'post'], 'rooms/add', 'RoomController::create');
    $routes->match(['get', 'post'], 'rooms/edit/(:num)', 'RoomController::edit/$1');
    $routes->post('rooms/delete/(:num)', 'RoomController::delete/$1');
    
    // Booking Management
    $routes->get('bookings', 'BookingController::index');
    $routes->post('bookings/(:num)/status', 'BookingController::updateStatus/$1');
    
    // Facilities
    $routes->resource('facilities', ['controller' => 'FacilityController']);
    
    // Complaints
    $routes->get('complaints', 'ComplaintController::index');
    $routes->post('complaints/(:num)/resolve', 'ComplaintController::resolve/$1');
});

// ==================== SUPER ADMIN ROUTES ====================
$routes->group('super', ['namespace' => 'App\Controllers\Admin', 'filter' => 'role:admin'], function($routes) {
    // User Management
    $routes->get('users', 'SuperAdminController::users');
    $routes->match(['get', 'post'], 'users/add', 'SuperAdminController::createUser');
    $routes->match(['get', 'post'], 'users/edit/(:num)', 'SuperAdminController::editUser/$1');
    $routes->post('users/delete/(:num)', 'SuperAdminController::deleteUser/$1');
    
    // City Management
    $routes->resource('cities', ['controller' => 'CityController']);
    
    // Categories
    $routes->resource('categories', ['controller' => 'CategoryController']);
    
    // Payment Methods
    $routes->get('payment-methods', 'PaymentMethodController::index');
    $routes->post('payment-methods/toggle/(:num)', 'PaymentMethodController::toggle/$1');
});

// ==================== API ROUTES ====================
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('hotels', 'HotelController::index');
    $routes->get('hotels/(:num)', 'HotelController::show/$1');
    
    // API dengan JWT Auth
    $routes->group('', ['filter' => 'api-auth'], function($routes) {
        $routes->post('bookings', 'BookingController::create');
    });
});

// ==================== ERROR HANDLING ====================
$routes->set404Override(function() {
    return view('errors/404');
});

$routes->setTranslateURIDashes(true);
$routes->setAutoRoute(false);