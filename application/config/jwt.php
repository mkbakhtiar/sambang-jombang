<?php
/**
 * Konfigurasi JWT
 * File: application/config/jwt.php
 */

defined('BASEPATH') OR exit('No direct script access allowed');

// Kunci untuk signing JWT (HARUS diganti dengan kunci yang aman dan acak)
$config['jwt_key'] = 'gantiKunciIniDenganKunciAcakYangAman123!';

// Durasi token dalam detik (default: 3600 = 1 jam)
$config['jwt_timeout'] = 3600;