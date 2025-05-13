<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * REST API Controller dasar
 * File: application/core/MY_Controller.php
 */
class MY_Controller extends CI_Controller {
    
    protected $response = array();
    protected $user_data;
    protected $require_auth = true;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('jwt');
        
        // Set header default untuk response JSON
        $this->output->set_content_type('application/json');
        
        // Cek autentikasi bila diperlukan
        if ($this->require_auth) {
            $this->authenticate();
        }
    }
    
    /**
     * Autentikasi token dari request header
     */
    private function authenticate() {
        // Ambil token dari Authorization header
        $headers = $this->input->request_headers();
        
        // Periksa apakah header Authorization ada
        if (!isset($headers['Authorization']) && !isset($headers['authorization'])) {
            $this->output->set_status_header(401);
            $this->response = array(
                'status' => false,
                'message' => 'Unauthorized. Authorization header tidak ditemukan.'
            );
            $this->send_response();
            exit;
        }
        
        // Ambil token dari header
        $token = isset($headers['Authorization']) ? $headers['Authorization'] : $headers['authorization'];
        
        // Hapus prefix 'Bearer ' jika ada
        if (strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }
        
        // Validasi token
        $user_data = validate_jwt_token($token);
        if (!$user_data) {
            $this->output->set_status_header(401);
            $this->response = array(
                'status' => false,
                'message' => 'Token tidak valid atau sudah kadaluarsa.'
            );
            $this->send_response();
            exit;
        }
        
        // Set user data
        $this->user_data = $user_data;
    }
    
    /**
     * Kirim response JSON
     */
    protected function send_response() {
        echo json_encode($this->response);
        exit;
    }

    /**
     * Validasi input
     * 
     * @param array $rules
     * @return boolean
     */
    protected function validate_input($rules) {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->input->post() ?: $this->input->get());
        $this->form_validation->set_rules($rules);
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400);
            $this->response = array(
                'status' => false,
                'message' => strip_tags(validation_errors()),
                'errors' => $this->form_validation->error_array()
            );
            return false;
        }
        return true;
    }
}