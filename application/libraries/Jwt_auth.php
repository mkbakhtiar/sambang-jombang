<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Jwt_auth {

    private $CI;
    private $secret_key;

    public function __construct() {
        $this->CI =& get_instance();
        
        // Load config JWT
        $this->CI->load->config('jwt');
        $this->secret_key = $this->CI->config->item('jwt_key');

    }

    /**
     * Verifikasi token JWT
     * @return array
     */
    public function verify_token() {
        $headers = $this->CI->input->request_headers();
        
        // Debug headers
        log_message('debug', 'Headers: ' . json_encode($headers));
        
        // Cek header Authorization
        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
        } elseif (isset($headers['authorization'])) {
            // Case-sensitive di beberapa server
            $token = str_replace('Bearer ', '', $headers['authorization']);
        } else {
            // Jika tidak ada di header, coba cek di GET atau POST
            $token = $this->CI->input->get_post('token');
            
            if (empty($token)) {
                return [
                    'status' => false,
                    'message' => 'Token tidak ditemukan'
                ];
            }
        }

        try {
            // Decode token menggunakan Firebase JWT
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
                'message' => 'Token tidak valid: ' . $headers['Authorization']
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
            
            echo json_encode($response);
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
            
            echo json_encode($response);
        }
        
        // Cek role user - gunakan 'role' sesuai dengan field di token
        if (!empty($allowed_roles)) {
            $userRole = isset($result['data']->role) ? $result['data']->role : 
                       (isset($result['data']->id_role) ? $result['data']->id_role : null);
                       
            if ($userRole === null || !in_array($userRole, $allowed_roles)) {
                $response = [
                    'status' => false,
                    'message' => 'Anda tidak memiliki akses untuk fitur ini'
                ];
                
                 echo json_encode($response);
            }
        }
        
        // Simpan data user di property CI untuk digunakan di controller
        $this->CI->user_data = $result['data'];
    }
    
    /**
     * Generate JWT token
     * @param array $data
     * @return string
     */
    public function generate_token($data) {
        // Load config JWT
        $this->CI->load->config('jwt');
        
        $issuer = $this->CI->config->item('jwt_issuer');
        $audience = $this->CI->config->item('jwt_audience');
        $timeout = $this->CI->config->item('jwt_timeout');
        
        $time = time();
        
        // JWT payload
        $payload = array_merge(
            $data,
            [
                'iss' => $issuer ?: 'api',
                'aud' => $audience ?: 'users',
                'iat' => $time,
                'nbf' => $time,
                'exp' => $time + ($timeout ?: 3600)
            ]
        );
        
        // Generate JWT menggunakan Firebase JWT
        return JWT::encode($payload, $this->secret_key, 'HS256');
    }
}