<?php
/**
 * JWT Helper untuk implementasi token authorization
 * File: application/helpers/jwt_helper.php
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

/**
 * Generate token JWT
 *
 * @param array $data Data yang akan disimpan dalam token
 * @return string
 */
if (!function_exists('generate_jwt_token')) {
    function generate_jwt_token($data)
    {
        $CI =& get_instance();
        $CI->config->load('jwt'); // Load konfigurasi JWT
        
        $key = $CI->config->item('jwt_key');
        $issued_at = time();
        $expire = $issued_at + $CI->config->item('jwt_timeout'); // Timeout dalam detik (default 3600 = 1 jam)
        
        $payload = array(
            'iat' => $issued_at,
            'exp' => $expire,
            'data' => $data
        );
        
        return JWT::encode($payload, $key, 'HS256');
    }
}

/**
 * Validasi token JWT
 *
 * @param string $token Token JWT yang akan divalidasi
 * @return object|boolean
 */
if (!function_exists('validate_jwt_token')) {
    function validate_jwt_token($token)
    {
        $CI =& get_instance();
        $CI->config->load('jwt');
        
        $key = $CI->config->item('jwt_key');
        
        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
            return $decoded->data;
        } catch (Exception $e) {
            return false;
        }
    }
}