<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skpd extends CI_Controller {

    private $_table_users = "auth_users";
    
    public function __construct() {
        parent::__construct();
        // Load necessary models
        $this->load->model('Skpd_model');
    }
    
    public function select() {
        // Check if user is logged in
        if (!$this->session->userdata('user_logged')) {
            redirect('auth');
        }
        
        $data = [
            'title' => 'Pilih SKPD',
            'li_1' => 'SKPD',
            'skpd_list' => $this->Skpd_model->get_all()
        ];
        
        $this->load->view('auth/skpd/select_view', $data);
    }
    
    public function update_skpd() {
        // Check if user is logged in
        if (!$this->session->userdata('user_logged')) {
            redirect('auth');
        }
        
        $id_skpd = $this->input->post('id_skpd');
        $user_id = encrypt_url(false, $this->session->userdata('user_logged')['id_user']);
        
        if (!$id_skpd) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>×</span></button>
                    Silakan pilih Skpd terlebih dahulu.
                </div>
            </div>');
            redirect('skpd/select');
        }
        
        // Update user's SKPD
        $this->db->where('id_user', $user_id);
        $this->db->update($this->_table_users, ['id_skpd' => $id_skpd]);
        
        // Get updated user data
        $user = $this->db->where('id_user', $user_id)->get($this->_table_users)->row_array();
        
        // Get SKPD name
        $nama_skpd = $this->db->where('id_skpd', $user['id_skpd'])
                            ->get('tbl_skpd')
                            ->row_array()['nama_skpd'] ?? 'Unknown';
        
        // Update session data
        $user['id_user'] = encrypt_url(true, $user['id_user']);
        $user['nama_skpd'] = $nama_skpd;
        
        $data = [
            'user_logged' => $user,
            'admin' => ($user['id_role'] == '1'),
            'admin2' => ($user['id_role'] == '4'),
            'detail' => $user
        ];
        
        $this->session->set_userdata($data);
        
        redirect('skpd/verification_notice');
    }

    public function verification_notice() {
        // Check if user is logged in
        if (!$this->session->userdata('user_logged')) {
            redirect('auth');
        }

        $data = [
            'title' => 'Verifikasi Akun',
            'li_1' => 'Menunggu Verifikasi',
            'skpd_list' => $this->Skpd_model->get_all()
        ];
                
        $this->load->view('auth/skpd/verification_notice_view', $data);
    }
}