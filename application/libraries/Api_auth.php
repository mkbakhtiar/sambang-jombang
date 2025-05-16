<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_auth {
    protected $CI;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->helper('jwt');
    }
    
    /**
     * Verify API request has valid token
     * 
     * @return boolean TRUE if authorized, FALSE otherwise
     */
    public function verify_token() {
        $token = get_bearer_token();
        
        if (!$token) {
            return FALSE;
        }
        
        $decoded_token = validate_jwt_token($token);
        
        if (!$decoded_token) {
            return FALSE;
        }
        
        // Store user data from token to be accessible in controller
        $this->CI->user_data = $decoded_token->data;
        
        return TRUE;
    }
    
    /**
     * Send unauthorized response
     */
    public function send_unauthorized() {
        $response = [
            'status' => FALSE,
            'message' => 'Unauthorized access',
            'data' => NULL
        ];
        
        $this->CI->output
            ->set_content_type('application/json')
            ->set_status_header(401)
            ->set_output(json_encode($response));
    }
}