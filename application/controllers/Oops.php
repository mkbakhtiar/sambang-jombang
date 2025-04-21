<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oops extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function forbidden()
    {
        $data = array(
            'msg' => 'Anda Tidak Dapat Mengakses Halaman Ini',
            'err_code' => '403'
        );
        $this->load->view('errors/oops', $data);
    }

    public function not_found()
    {
        $data = array(
            'msg' => 'Halaman Tidak Ditemukan',
            'err_code' => '404'
        );
        $this->load->view('errors/oops', $data);
    }
}
