<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Auth untuk manajemen token dan autentikasi API
 * File: application/controllers/api/Auth.php
 */
class Auth extends MY_Controller {
    
    public function __construct() {
        $this->require_auth = false; // Matikan autentikasi untuk controller ini
        parent::__construct();
        $this->load->model('Auth_model');
    }
    
    /**
     * Endpoint untuk login dan mendapatkan token
     */
    public function login() {
        // Validasi input
        $rules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
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
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role
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
}