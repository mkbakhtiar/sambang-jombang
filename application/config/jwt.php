<?php
/**
 * Konfigurasi JWT
 * File: application/config/jwt.php
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$config['jwt_key'] = '4a3744a7bbac8edc37bbf9bc2946fb2ea955b8d8e5bdd7937ed8bb3cf6b86769032e6debccbda166dba4935e7305dddaf8b9a4fe99736a54e2c30f730527f228be4b139eb1f03907883d75d556d7f10f8610a11f0bebebaf4d87076e7b078dbe';

// Durasi token dalam detik (default: 3600 = 1 jam)
$config['jwt_timeout'] = 3600;