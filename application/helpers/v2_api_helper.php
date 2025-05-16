<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * API Helper Functions
 * File: application/helpers/api_helper.php
 */

// Jika helper belum diload
if (!function_exists('get_bearer_token')) {
    /**
     * Mengambil bearer token dari header Authorization
     * 
     * @return string|null
     */
    function get_bearer_token() {
        $headers = null;
        
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER['Authorization']);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER['HTTP_AUTHORIZATION']);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        
        // Cek apakah header sesuai format 'Bearer {token}'
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        
        return null;
    }
}

if (!function_exists('generate_jwt_token')) {
    /**
     * Generate JWT token
     * 
     * @param array $data Data yang akan dimasukkan ke token
     * @return string
     */
    function generate_jwt_token($data) {
        $CI =& get_instance();
        $CI->load->config('jwt');
        
        $secret_key = $CI->config->item('jwt_key');
        $issuer = $CI->config->item('jwt_issuer');
        $audience = $CI->config->item('jwt_audience');
        $timeout = $CI->config->item('jwt_timeout');
        
        $time = time();
        
        // JWT header
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        
        // JWT payload
        $payload = array_merge(
            $data,
            [
                'iss' => $issuer,
                'aud' => $audience,
                'iat' => $time,
                'nbf' => $time,
                'exp' => $time + $timeout
            ]
        );
        
        // Encode header
        $encoded_header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($header)));
        
        // Encode payload
        $encoded_payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));
        
        // Create signature
        $signature = hash_hmac('sha256', "$encoded_header.$encoded_payload", $secret_key, true);
        $encoded_signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        
        // Create JWT
        $jwt = "$encoded_header.$encoded_payload.$encoded_signature";
        
        return $jwt;
    }
}

if (!function_exists('verify_jwt_token')) {
    /**
     * Verifikasi JWT token
     * 
     * @param string $token JWT token
     * @return object|bool Payload data jika valid, FALSE jika tidak valid
     */
    function verify_jwt_token($token) {
        $CI =& get_instance();
        $CI->load->config('jwt');
        
        $secret_key = $CI->config->item('jwt_key');
        
        // Split token
        $token_parts = explode('.', $token);
        
        if (count($token_parts) != 3) {
            return false;
        }
        
        // Get header, payload, and signature
        $header = $token_parts[0];
        $payload = $token_parts[1];
        $signature_provided = $token_parts[2];
        
        // Check signature
        $signature = hash_hmac('sha256', "$header.$payload", $secret_key, true);
        $signature_encoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        
        if ($signature_provided !== $signature_encoded) {
            return false;
        }
        
        // Decode payload
        $payload_decoded = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $payload)));
        
        // Check if token is expired
        if (isset($payload_decoded->exp) && $payload_decoded->exp < time()) {
            return false;
        }
        
        return $payload_decoded;
    }
}

if (!function_exists('send_json_response')) {
    /**
     * Fungsi untuk mengirim response JSON
     * 
     * @param boolean $status Status response (true/false)
     * @param string $message Pesan response
     * @param mixed $data Data response
     * @param integer $code HTTP status code
     */
    function send_json_response($status = true, $message = '', $data = null, $code = 200) {
        $CI =& get_instance();
        
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        
        $CI->output->set_status_header($code);
        $CI->output->set_content_type('application/json');
        $CI->output->set_output(json_encode($response));
    }
}

if (!function_exists('enable_cors')) {
    /**
     * Enable CORS (Cross-Origin Resource Sharing)
     */
    function enable_cors() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        
        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }
    }
}