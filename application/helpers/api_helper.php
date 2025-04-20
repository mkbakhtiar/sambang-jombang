<?php
// application/libraries/Api_helper.php

class Api_helper {
    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
        // $this->ci->load->library('curl');
        // $this->ci->load->library('encryption');
        $this->ci->load->config('config'); // Load konfigurasi CodeIgniter
    }
    
    public function call_api($endpoint, $method = 'GET', $data = array()) {
        // Ambil konfigurasi API
        $api_base_url = $this->ci->config->item('api_base_url');
        // $api_token = $this->ci->config->item('api_access_token');
        $api_token = $this->get_access_token('auth/login', 'POST');
        
        // Atur URL API
        $url = $api_base_url . $endpoint;
        $ch = curl_init($url);
    
        // Tambahkan header dan token bearer
        $headers = array(
            'Authorization: Bearer ' . $api_token,
            'Content-Type: application/json'
        );
        // var_dump($headers);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    
        $result = curl_exec($ch);
    
        curl_close($ch);
    
        return $result;
    }
    
    public function get_access_token($endpoint, $method = 'POST', $data = array()) {
        // Ambil konfigurasi API
        $username = $this->ci->config->item('usersimpus');
        $password = $this->ci->config->item('pwsimpus');
        $apisimpus = $this->ci->config->item('apisimpus');
        $api_base_url = $this->ci->config->item('api_base_url');
        // $api_token = $this->ci->config->item('api_access_token');
        $data = json_encode(array(
            'username' => $username,
            'password' => $password
        ));
        // Atur URL API
        $url = $api_base_url . $endpoint;
        $ch = curl_init($url);
    
        // Tambahkan header dan token bearer
        $headers = array(
            // 'Authorization: Bearer ' . $api_token,
            'Content-Type: application/json',
            'Apikey: ' . $apisimpus
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Menggunakan http_build_query() untuk mengonversi data ke format key-value
       
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    
        $result = curl_exec($ch);
        $response_data = json_decode($result, true);
        $token = $response_data['token'];
        // var_dump($response_data['token']);

        curl_close($ch);
    
        return $token;
    }

    public function call_api2($endpoint, $method = 'GET', $data = array()) {
        // Ambil konfigurasi API
        $api_base_url =  "https://apirs.rsudjombang.com/realtime/";
        // $api_token = $this->get_access_token('auth/login', 'POST');
        
        // Atur URL API
        $url = $api_base_url . $endpoint;
        $ch = curl_init($url);
    
        // Tambahkan header dan token bearer
        $headers = array(
            'Content-Type: application/json',
            'consID: 82096',
            'userKey: 773037345128297fc3c4aafb66c187ad97ef582dcd04cb0e298d47eedd6bfd8f',
            'signature: LmuHxibAumrIOHPxZ1m6eU8M2PWLscKjjdXTJx2d9Wk=',
            'timestamp: 1715828416'
        );
        // var_dump($headers);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    
        $result = curl_exec($ch);
    
        curl_close($ch);
    
        return $result;
    }

   
}
