<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Geoportal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('front_model', 'fmd');
        $this->fmd->clean_input();
        $this->load->model("indikator_model", "im");
        $this->log_visit();
        //load front geospasial
        //$this->load->model("geospasial_front_model", "gfm");
        $this->load->model("geoportal/M_geoportal", "M_geoportal");
    }

    public function geospasial()
    {
        // print_r($this->gfm->get_geonode_object());
        // exit();
        $props = array(
            'stats_counter' => '',
            'list_objects' => $this->M_geoportal->get_datas(),
        );
        $data = array(
            'title' => 'Satu Data Jombang',
            'props' => $props
        );
        $this->load->view('front/geospasial', $data);
    }


    public function geospasial_urusan()
    {
        // print_r($this->gfm->get_geonode_object());
        // exit();
        $props = array(
            'stats_counter' => '',
            // 'list_urusan' => $this->fmd->get_geo_urusan(),
            'list_urusan' => $this->M_geoportal->get_geo_urusan_with_titles(),
            'list_title' => $this->M_geoportal->get_geo_urusan_with_titles(),

        );

        $data = array(
            'title' => 'Satu Data Jombang',
            'props' => $props
        );
        $this->load->view('front/geospasial-urusan', $data);
    }

    function log_visit()
    {
        $id = $this->input->server('REQUEST_URI');
        $id = preg_replace('/[^A-Za-z0-9\-]/', '', $id);
        if ($id == '') {
            $id = '\\';
        }
        $this->load->helper('cookie');
        $check_uri = $this->input->cookie($id, FALSE);
        $ip = $this->input->ip_address();
        if ($check_uri == false) {
            date_default_timezone_set("Asia/Jakarta");
            $cookie = array("name" => $id, "value" => $ip, "expire" => 300, "secure" => false);
            $this->input->set_cookie($cookie);
            $this->fmd->update_log_visitor();
        }
    }


}
