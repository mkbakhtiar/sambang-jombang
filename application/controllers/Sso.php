<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SSO extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("auth_model");
    }
    
    public function login() {
        $data = $this->input->get();
        $token = $data['access_token'];
        if (!$token) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(['error' => 'Token tidak disediakan']));
            return;
        }
    
        $client_id = "NnY5iprmzlb9AvGMuzrmx2E2EHBiR0iiS8K5f4XS";
        $url = 'https://sso.jombangkab.go.id/api/validate-token';
    
        // Membuat request cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Tidak memverifikasi SSL sertifikat
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'id' => 5,
            'client_id' => $client_id,
        ]));
    
        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_status != 200) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(['error' => 'Unauthorized']));
            return;
        }
    
        $data = json_decode($response, true);
    
        try {
            $username = $data['user']['username'];
            if ($this->auth_model->loginSso($username)) {
                redirect(base_url('admin/dashboard'));
            } else {
                redirect("https://sso.jombangkab.go.id/aplikasi/akses?status=false&message=1");
            }
        } catch (\Throwable $th) {
            redirect("https://sso.jombangkab.go.id/aplikasi/akses?status=false&message=2");
        }
    
        redirect("login")->withErrors("Gagal mendapatkan informasi user login, coba lagi.");
    }


}