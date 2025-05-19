<?php
/**
 * Konfigurasi JWT
 * File: application/config/jwt.php
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$config['jwt_key'] = 'thisIsSecrettutajom123';

// Durasi token dalam detik (default: 3600 = 1 jam)
$config['jwt_timeout'] = 3600;