<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Home::adminPanel');

$routes->get('/login', 'AuthController::index');
$routes->post('/validate', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/admin/produk', 'ProdukController::index');
$routes->get('/getProduk', 'ProdukController::getProduk');
$routes->post('/create/produk', 'ProdukController::create');
$routes->get('/admin/produk/getProdukByID/(:num)','ProdukController::getProdukByID/$1');
$routes->post('/update/produk', 'ProdukController::update');
$routes->post('/delete/produk', 'ProdukController::delete');

$routes->get('/admin/pelanggan', 'PelangganController::index');
$routes->get('/getPelanggan', 'PelangganController::getPelanggan');
$routes->post('/create/pelanggan', 'PelangganController::create');
$routes->get('/admin/pelanggan/getPelangganByID/(:num)','PelangganController::getPelangganByID/$1');
$routes->post('/update/pelanggan', 'PelangganController::update');
$routes->post('/delete/pelanggan', 'PelangganController::delete');

$routes->get('/admin/user', 'UserController::index');
$routes->get('/getUser', 'UserController::getUser');
$routes->post('/create/user', 'UserController::create');
$routes->get('/admin/user/getUserByID/(:num)','UserController::getUserByID/$1');
$routes->post('/update/user', 'UserController::update');
$routes->post('/delete/user', 'UserController::delete');