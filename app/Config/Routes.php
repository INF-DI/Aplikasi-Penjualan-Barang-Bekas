<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Barang::indexUser'); // Rute default untuk user
$routes->get('/user', 'Barang::indexUser'); // Rute untuk user

// Auth routes
$routes->get('/auth', 'Auth::index'); // Menampilkan form login
$routes->post('/auth/processLogin', 'Auth::processLogin'); // Memproses login
$routes->get('/auth/logout', 'Auth::logout'); // Logout

// Admin routes (semua memerlukan otentikasi, akan ditambahkan di filter/middleware jika proyek lebih besar)
$routes->get('/admin', 'Barang::indexAdmin'); // Menampilkan daftar barang (admin)
$routes->get('/barang/add', 'Barang::add'); // Menampilkan form tambah
$routes->post('/barang/save', 'Barang::save'); // Menyimpan barang baru
$routes->get('/barang/edit/(:num)', 'Barang::edit/$1'); // Menampilkan form edit
$routes->post('/barang/update/(:num)', 'Barang::update/$1'); // Memperbarui barang
$routes->get('/barang/delete/(:num)', 'Barang::delete/$1'); // Menghapus barang