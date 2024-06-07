<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Checklist::index');
$routes->get('export', 'Checklist::export');
$routes->post('search', 'Checklist::search');

$routes->get('add', 'Add::index');
$routes->post('add', 'Add::add');
$routes->post('import', 'Add::import');

$routes->get('open', 'Edit::index');
$routes->post('open', 'Edit::open');
$routes->post('edit', 'Edit::edit');
$routes->post('delete', 'Edit::delete');
