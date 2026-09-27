<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route Default diarahkan ke modul Mahasiswa
$routes->get('/', 'Mahasiswa::index');

// Route CRUD Mahasiswa (Tahap Read & Create)
$routes->group('mahasiswa', function ($routes) {
    // READ: Menampilkan daftar data mahasiswa
    $routes->get('', 'Mahasiswa::index');
    
    // CREATE: Menampilkan form tambah data
    $routes->get('create', 'Mahasiswa::create');
    
    // CREATE: Menyimpan data baru hasil submit form (POST)
    $routes->post('store', 'Mahasiswa::store');
});
