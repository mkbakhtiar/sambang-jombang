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
		$this->load->model('geoportal/M_year', 'M_year');
		$this->load->model('geoportal/M_indicators', 'M_indicators');
	}


	public function index()
	{
		//GET DATA
		$years = $this->M_year->get_years();
		$datas = $this->M_views->get_datas();
		foreach ($datas as $key => $data) {
			$datas[$key]['id'] = encrypt_url(true, $data['history_id']);
		}
		//SET TABLE
		// $props = array('cols' => ['#', 'ID Data', 'Tahun', 'Indikator', 'Label View', 'Aksi']);
		$props = array('cols' => ['#', 'ID Data', 'Tahun', 'Indikator / Label View']);

		//ASSIGN
		$data = array(
			'title' => 'Views',
			'li_1' => 'Geoportal',
			'li_2' => 'Views',
			'props' => $props,
			'datas' => $datas,
			'years' => $years
		);
		//VIEW
		$this->load->view('geoportal/views', $data);
	}


	public function submit()
	{
		//GET DATA
		$raw_data = $this->security->xss_clean($this->input->post());
		$year = $raw_data['data_year'];
		//$year = 2020;

		//get data
		$indicators = $this->M_indicators->get_indicator_main();
		$tot_view = 0;

		//loop data
		foreach ($indicators as $key => $indicator) {
			//modif data
			$data_id = $indicator['data_id'];
			$data_year = $year;
			$view_label = $indicator['view_label'] . '_th_' . $year;
			if (strlen($view_label) > 50) {
				$view_label = "vi_indikator_" . $data_id . '_th_' . $year;
			}

			$params = array(
				"data_id" => $data_id,
				"data_year" => $data_year,
				"view_label" => $view_label,
				"mdb"	=> "djtz",
				"mdd"	=> date("Y-m-d h:i:s"),
			);

			//cek data & insert if not exist
			if (empty($this->M_views->get_indicator_by_params(array($data_id, $data_year)))) {
				$this->M_views->insert($params);
			}

			//CREATE VIEW
			$query = "CREATE OR REPLACE VIEW public." . $view_label . " as
					SELECT a.data_name AS nama,
						a.data_value AS jumlah,
						b.geometry
					FROM view_builder_data a
					LEFT JOIN batas_kecamatan b ON a.data_name ~~* (('%'::text || b.wadmkc::text) || '%'::text)
					WHERE 
					a.data_year = " . $data_year . "
					AND a.parent_id = " . $data_id . "::text
					GROUP BY a.data_name, a.data_value, b.geometry;";
			$this->M_views->create($query);
			$tot_view++;
		}

		//return data
		if ($tot_view > 0) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui, dengan create view yang berjumlah ' . $tot_view
			);
		} else {
			$result = array(
				'status' => 'failed',
				'message' => 'Data Gagal Diperbaharui'
			);
		}

		//assign
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}
}
