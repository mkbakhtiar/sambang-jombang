<?php
/**
 * File: application/config/rest.php
 * Bagian yang perlu diubah
 */

defined('BASEPATH') OR exit('No direct script access allowed');

// Nonaktifkan Basic Authentication
$config['rest_auth'] = ''; // atau 'none'

// Nonaktifkan REST Keys jika tidak digunakan
$config['rest_enable_keys'] = FALSE;

// Aktifkan CORS agar API bisa diakses dari domain lain
$config['check_cors'] = TRUE;
$config['allowed_cors_headers'] = [
    'Origin',
    'X-Requested-With',
    'Content-Type',
    'Accept',
    'Access-Control-Request-Method',
    'Authorization'
];
$config['allowed_cors_methods'] = [
    'GET',
    'POST',
    'PUT',
    'DELETE',
    'OPTIONS'
];
$config['allow_any_cors_domain'] = TRUE;