<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API_Controller extends MY_Controller {
    protected $auth_methods = []; // Controller methods that require authentication
    
    public function __construct() {
        parent::__construct();
        
        // Load necessary libraries
        $this->load->library('api_auth');
        
        // Enable CORS
        $this->_enable_cors();
        
        // Set default content type to JSON
        $this->output->set_content_type('application/json');
        
        // Check if current method requires authentication
        $this->_check_auth();
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
    
    /**
     * Check if current method requires authentication
     */
    private function _check_auth() {
        $current_method = $this->router->fetch_method();
        
        // If current method requires authentication
        if (in_array($current_method, $this->auth_methods) || in_array('*', $this->auth_methods)) {
            if (!$this->api_auth->verify_token()) {
                $this->api_auth->send_unauthorized();
                exit;
            }
        }
    }
    
    /**
     * Send JSON response
     * 
     * @param boolean $status Success or failure status
     * @param string $message Response message
     * @param mixed $data Response data
     * @param integer $code HTTP status code
     */
    protected function send_response($status = TRUE, $message = '', $data = NULL, $code = 200) {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        
        $this->output->set_status_header($code);
        $this->output->set_output(json_encode($response));
    }
}