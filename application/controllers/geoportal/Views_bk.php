<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Views extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//CEK ADMIN
		$this->load->model('auth_model');
		if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));

		//LOAD MODEL
		$this->load->model('geoportal/M_views', 'M_views');
		$this->load->model('Masterdata_model', 'md_model');
	}

	// public function index()
	// {
	// 	$props = array(
	// 		'cols' => ['#', 'ID Data', 'Tahun', 'Label Views', 'Website', 'Aksi']
	// 	);

	// 	$data = array(
	// 		'title' => 'Views',
	// 		'li_1' => 'Geoportal',
	// 		'li_2' => 'Views',
	// 		'props' => $props
	// 	);
	// 	$this->load->view('geoportal/views', $data);
	// }


	public function index()
	{
		$datas = $this->M_views->get_datas();

		$props = array(
			'cols' => ['#', 'ID Data', 'Tahun', 'Indikator', 'Label View', 'Aksi']
		);

		$data = array(
			'title' => 'Views',
			'li_1' => 'Geoportal',
			'li_2' => 'Views',
			'props' => $props,
			'datas' => $datas
		);

		$this->load->view('geoportal/views', $data);
	}


	// public function get_data()
	// {
	// 	$params = array(
	// 		'columns' => ['view_id', 'data_id', 'data_name', 'view_label', 'area_type'],
	// 		'table' => 'view_builder',
	// 	);

	// 	$result = $this->M_views->build_datatables($params);
	// 	echo json_encode($result);
	// 	exit();
	// }


	// public function get_data()
	// {
	// 	$params = array(
	// 		'columns' => ['history_id', 'data_id', 'data_year', 'data_name', 'view_label'],
	// 		'table' => 'view_builder_history',
	// 	);

	// 	$result = $this->M_views->build_datatables($params);
	// 	echo json_encode($result);
	// 	exit();
	// }
}
