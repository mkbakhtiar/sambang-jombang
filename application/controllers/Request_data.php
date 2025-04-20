<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("front_model", "fmd");
        $this->load->model("indikator_model", "im");
    }
    public function index($id = null)
    {
        $id = encrypt_url(false, $id);
        $props = array(
            'metadata_cols' => $this->im->get_metadata_cols(),
            'satuan' => $this->im->get_satuan(),
            'periodik' => $this->im->get_periodik(),
            'akses' => $this->im->get_akses(),
            'skpd' => $this->im->get_skpd(),
            'keluaran' => $this->im->get_keluaran()
        );
        $data = array(
            'title' => ($id = null ? 'Edit' : 'Tambah') . ' Indikator',
            'li_1' => ($id = null ? 'Edit' : 'Tambah'),
            'li_2' => 'Indikator',
            'props' => $props,
            'id' => $id,
            'enc_id' => $this->encryption->encrypt($id),
            'edit' => ($id = null ? true : false)
        );
        $this->load->view('front/request-data', $data);
    }


    public function save()
    {
        $raw_data = $this->security->xss_clean($this->input->post());
        $input = $this->fmd->save_request_data($raw_data);
        header('Content-Type: application/json');
        echo json_encode($input);
    }

}