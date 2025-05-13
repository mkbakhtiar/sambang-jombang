<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Jwt_auth {

    private $CI;
    private $secret_key;

    public function __construct() {
        $this->CI =& get_instance();
        $this->secret_key = "your_secret_key_here"; // Ganti dengan kunci rahasia yang sama dengan controller
    }

    /**
     * Verifikasi token JWT
     * @return bool|object
     */
    public function verify_token() {
        $headers = $this->CI->input->request_headers();
        
        // Cek header Authorization
        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
        } else {
            return [
                'status' => false,
                'message' => 'Token tidak ditemukan'
            ];
        }

        try {
            // Decode token
            $decoded = JWT::decode($token, new Key($this->secret_key, 'HS256'));
            return [
                'status' => true,
                'data' => $decoded
            ];
        } catch (\Firebase\JWT\ExpiredException $e) {
            return [
                'status' => false,
                'message' => 'Token kadaluarsa'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Token tidak valid'
            ];
        }
    }

    /**
     * Middleware untuk mengecek autentikasi
     * @return void
     */
    public function auth_check() {
        $result = $this->verify_token();
        
        if (!$result['status']) {
            $response = [
                'status' => false,
                'message' => $result['message']
            ];
            
            $this->CI->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode($response));
            exit;
        }
        
        // Simpan data user di property CI untuk digunakan di controller
        $this->CI->user_data = $result['data'];
    }

    /**
     * Middleware untuk mengecek role user
     * @param array $allowed_roles
     * @return void
     */
    public function role_check($allowed_roles = []) {
        $result = $this->verify_token();
        
        if (!$result['status']) {
            $response = [
                'status' => false,
                'message' => $result['message']
            ];
            
            $this->CI->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode($response));
            exit;
        }
        
        // Cek role user
        if (!empty($allowed_roles) && !in_array($result['data']->id_role, $allowed_roles)) {
            $response = [
                'status' => false,
                'message' => 'Anda tidak memiliki akses untuk fitur ini'
            ];
            
            $this->CI->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode($response));
            exit;
        }
        
        // Simpan data user di property CI untuk digunakan di controller
        $this->CI->user_data = $result['data'];
    }
}