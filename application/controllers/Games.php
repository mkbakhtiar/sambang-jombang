<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Games extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Satu Data Jombang',
        );
        $this->load->view('front/games', $data);
    }
}