<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Auth untuk manajemen token dan autentikasi API
 * File: application/controllers/api/Auth.php
 */
class Auth extends CI_Controller {
    protected $response = [];
    protected $user_data = [];
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->helper('v2_api_helper'); // Load helper untuk fungsi-fungsi API
        
        // Enable CORS
        $this->_enable_cors();
        
        // Set default content type to JSON
        $this->output->set_content_type('application/json');
    }

    /**
     * Enable CORS (Cross-Origin Resource Sharing)
     */
    private function _enable_cors() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        
        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }
    }

    public function test() {
        $response = [
            'status' => TRUE,
            'message' => 'API test successful',
            'data' => [
                'timestamp' => time()
            ]
        ];
        
        echo json_encode($response);
    }
    
    /**
     * Endpoint untuk login dan mendapatkan token
     */
    public function login() {
        // Parse JSON input jika content type adalah application/json
        $content_type = $this->input->server('CONTENT_TYPE');
        if (strpos($content_type, 'application/json') !== false) {
            $raw_input = file_get_contents('php://input');
            $json_data = json_decode($raw_input, true);
            
            // Set data JSON ke $_POST agar bisa diakses dengan $this->input->post()
            if (is_array($json_data)) {
                foreach ($json_data as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        }
        
        // Validasi input
        $rules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
            )
        );
        
        if (!$this->validate_input($rules)) {
            $this->send_response();
            return;
        }
        
        // Proses login
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->Auth_model->check_credentials($username, $password);
        
        if (!$user) {
            $this->output->set_status_header(401);
            $this->response = array(
                'status' => false,
                'message' => 'Username atau password salah.'
            );
            $this->send_response();
            return;
        }
        
        // Buat data untuk token
        $token_data = array(
            'id' => $user->id_user,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->id_role
        );
        
        // Generate token
        $token = generate_jwt_token($token_data);
        
        // Kembalikan token
        $this->response = array(
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $this->config->item('jwt_timeout')
        );
        
        $this->send_response();
    }
    
    /**
     * Endpoint untuk cek token
     */
    public function check_token() {
        // Aktifkan autentikasi untuk endpoint ini
        $this->authenticate();
        
        // Jika sampai sini, berarti token valid
        $this->response = array(
            'status' => true, 
            'message' => 'Token valid',
            'user' => $this->user_data
        );
        
        $this->send_response();
    }
    
    /**
     * Validasi input dari request
     * 
     * @param array $rules Aturan validasi
     * @return boolean
     */
    protected function validate_input($rules) {
        $errors = array();
        
        foreach ($rules as $rule) {
            $field = $rule['field'];
            $label = isset($rule['label']) ? $rule['label'] : ucfirst($field);
            $value = $this->input->post($field);
            
            // Validasi field tidak boleh kosong
            if (empty($value) && $value !== '0') {
                $errors[$field] = "$label tidak boleh kosong";
            }
            
        }
        
        if (!empty($errors)) {
            $this->output->set_status_header(400);
            $this->response = array(
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $errors
            );
            return false;
        }
        
        return true;
    }
    
    /**
     * Validasi token dan autentikasi user
     * 
     * @return boolean
     */
    protected function authenticate() {
        // Get token dari header
        $token = get_bearer_token();
        
        if (!$token) {
            $this->output->set_status_header(401);
            $this->response = array(
                'status' => false,
                'message' => 'Unauthorized: Token tidak ditemukan'
            );
            $this->send_response();
            exit;
        }
        
        // Verifikasi token
        $payload = verify_jwt_token($token);
        
        if (!$payload) {
            $this->output->set_status_header(401);
            $this->response = array(
                'status' => false,
                'message' => 'Unauthorized: Token tidak valid'
            );
            $this->send_response();
            exit;
        }
        
        // Set user data
        $this->user_data = (array)$payload;
        
        return true;
    }
    
    /**
     * Kirim response JSON
     */
    protected function send_response() {
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($this->response));
    }
}