<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->get('/category',); 
// $routes->get('/popular',); 
// $routes->get('/favorite',);

// $routes->get('/hotel',);


// Auth
$routes->get('/signup', 'AuthController::signup'); 
$routes->get('/login', 'AuthController::index'); 
$routes->get('/forgot-password', 'AuthController::forgotPassword'); 
 
// $routes->get('/booking',);
// $routes->get('/booking
// 
// {booking_id}/payment',);

// $routes->get('/booking/{booking_id}/payment',);
// $routes->get('/booking/{booking_id}/review',);

// $routes->get('/editprofile',); 


// $routes->get('/admin/',); 
// $routes->get('/admin/login',); 
// $routes->get('/admin/',); 





// 
