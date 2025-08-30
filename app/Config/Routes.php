<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Article Routes
$routes->get('articles', 'Articles::index');
$routes->get('articles/create', 'Articles::create');
$routes->post('articles/store', 'Articles::store');
$routes->get('articles/(:num)', 'Articles::view/$1');
$routes->get('articles/edit/(:num)', 'Articles::edit/$1');
$routes->post('articles/update/(:num)', 'Articles::update/$1');
$routes->get('articles/delete/(:num)', 'Articles::delete/$1');

// Category Routes
$routes->get('categories', 'Categories::index');
$routes->get('categories/create', 'Categories::create');
$routes->post('categories/store', 'Categories::store');
$routes->get('categories/(:num)', 'Categories::view/$1');
$routes->get('categories/edit/(:num)', 'Categories::edit/$1');
$routes->post('categories/update/(:num)', 'Categories::update/$1');
$routes->get('categories/delete/(:num)', 'Categories::delete/$1');

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Basketball Teams
$routes->get('/teams', 'Teams::index');



use App\Controllers\CacheTest;
//Memcache product
// Route for storing a new product.
// Maps a POST request to 'cachetest/store' to the 'store' method of the 'CacheTest' controller.
$routes->post('cache-test/store', [CacheTest::class, 'store']);

// Route for showing a single product.
// Maps a GET request to 'cachetest/show/123' to the 'show' method.
$routes->get('cache-test/show/(:num)', [CacheTest::class, 'show']);

//Football Routes
$routes->get('football/leagues', 'FootballController::leagues');