<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Article Routes
$routes->get('articles', 'Articles::index');
$routes->get('articles/create', 'Articles::create');
$routes->post('articles/create', 'Articles::create');
$routes->get('articles/(:num)', 'Articles::view/$1');
$routes->get('articles/edit/(:num)', 'Articles::edit/$1');
$routes->post('articles/edit/(:num)', 'Articles::edit/$1');
$routes->get('articles/delete/(:num)', 'Articles::delete/$1');

// Category Routes
$routes->get('categories', 'Categories::index');
$routes->get('categories/create', 'Categories::create');
$routes->post('categories/create', 'Categories::create');
$routes->get('categories/(:num)', 'Categories::view/$1');
$routes->get('categories/edit/(:num)', 'Categories::edit/$1');
$routes->post('categories/edit/(:num)', 'Categories::edit/$1');
$routes->get('categories/delete/(:num)', 'Categories::delete/$1');

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
