<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('upload', 'Upload::get');
$routes->post('upload', 'Upload::post');
