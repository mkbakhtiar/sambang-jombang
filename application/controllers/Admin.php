<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));
		$this->load->model("indikator_model", "im");
		$this->load->model("publikasi_model", "pm");
		$this->load->model("dash_model", "dm");
	}


	public function dashboard($id = null)
	{
		// $this->output->cache(5);
		if ($this->session->admin || $this->session->admin2) {
		// if ($this->session->admin) {
			$id_skpd = $id;
		} else {
			$id_skpd = $this->session->detail['id_skpd'];
		}
		$props = array(
			'stats_indikator' => $this->im->get_rekap_konfirmasi($id_skpd),
			'stats_data' => $this->im->get_rekap_input($id_skpd),
			'stats_verifikasi' => $this->im->get_rekap_verifikasi($id_skpd),
			'stats_publikasi' => $this->pm->get_rekap_publikasi($id_skpd),
			'list_indikator' => $this->dm->get_last_indikator($id_skpd),
			'list_data' => $this->dm->get_last_data($id_skpd),
			'progres_penetapan' => $this->dm->get_progres_penetapan()
		);
		$data = array(
			'title' => 'Dashboard',
			'li_1' => 'Admin',
			'li_2' => 'Dashboard',
			'props' => $props
		);
		$this->load->view('admin/dash', $data);
	}

	public function test()
	{
		debug($this->dm->log_visitor_today());
	}
	
	public function visitor()
	{
		$props = array(
			'top_data' => $this->dm->get_top_data(),
			'visitor_log' => $this->dm->get_log_visitor(),
		);
		$data = array(
			'title' => 'Visitor Statistic',
			'li_1' => 'Admin',
			'li_2' => 'Visitor Statisic',
			'props' => $props
		);
		$this->load->view('admin/visitor', $data);
	}
}
