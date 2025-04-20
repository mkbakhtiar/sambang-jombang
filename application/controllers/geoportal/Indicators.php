<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Indicators extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//CEK ADMIN
		$this->load->model('auth_model');
		if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));

		//LOAD MODEL
		$this->load->model('geoportal/M_indicators', 'M_indicators');
	}


	public function index($id = null)
	{
		$indicators = $this->M_indicators->get_indicator();
		$indicators_pg = $this->M_indicators->get_indicator_pg();

		foreach ($indicators_pg as $key => $value) {
			# code...
			$encrypted_id = encrypt_url(true, $value['view_id']);
			$indicators_pg[$key]['encrypted_id'] = $encrypted_id;
		}

		// $props = array(
		// 	'cols' => ['#', 'ID Data', 'Judul/Label View', 'Tipe Area', 'Datas', 'Views', 'Aksi']
		// );

		$props = array(
			'cols' => ['#', 'ID Data', 'Judul/Label View', 'Tipe Area']
		);

		$data = array(
			'title' => 'Indikator',
			'li_1' => 'Geoportal',
			'li_2' => 'Indikator',
			'props' => $props,
			'indicators' => $indicators,
			'indicators_pg' => $indicators_pg,
		);

		// print_r($indicators);
		$this->load->view('geoportal/indicators', $data);
	}


	public function get_data()
	{
		$params = array(
			'columns' => ['view_id', 'data_id', 'data_name', 'view_label', 'area_type'],
			'table' => 'view_builder',
		);

		$result = $this->M_indicators->build_datatables($params);
		echo json_encode($result);
	}

	// public function sync()
	// {
	// 	print_r("SYNC");
	// 	print_r("<br />");

	// 	//get list indikator
	// 	$values = $this->M_datas->get_indicator_main();
	// 	$total = 0;

	// 	//loop indicator
	// 	foreach ($values as $key => $value) {
	// 		print_r("data	: " . $value['data_id']);
	// 		print_r("<br />");
	// 		//get data list
	// 		$datas = $this->M_datas->get_data_ori($value['data_id']);
	// 		//loop data to get the value
	// 		foreach ($datas as $key => $data) {
	// 			//counting total
	// 			$total++;
	// 			//delete data before insert
	// 			$params = array(
	// 				"data_id" => $data['data_id'],
	// 				"parent_id" => $data['parent_id'],
	// 				"data_year" => $data['data_year']
	// 			);
	// 			$this->M_datas->delete($params);

	// 			//params
	// 			$params = array(
	// 				"data_id" => $data['data_id'],
	// 				"parent_id" => $data['parent_id'],
	// 				"data_name" => $data['title'],
	// 				"data_year" => $data['data_year'],
	// 				"data_value" => $data['data_value'],
	// 				'mdb' => 'djtz',
	// 				'mdd' => date("Y-m-d H:i:s")
	// 			);
	// 			//exec
	// 			$this->M_datas->insert($params);
	// 		}
	// 	}
	// 	echo "<br />";
	// 	echo "total		= " . $total;
	// 	//print_r($datas);
	// }


	public function add_process()
	{
		//get data post
		$id_indikator = $_POST['id_indikator'];
		$area_type = $_POST['area_type'];

		if (!empty($id_indikator) && !empty($area_type)) {
			//cek data
			$existing = $this->M_indicators->get_indicator_main_by_id(array($id_indikator));
			$params = array($id_indikator);
			if (empty($existing)) {
				//get detail
				$result = $this->M_indicators->get_indicator_by_id(array($id_indikator));
				$data_name = $result['nama_indikator'];
				$view_label = "vi " . strtolower($data_name);
				$view_label = str_replace(" ", "_", trim($view_label));
				if (strlen($view_label) > 50) {
					$view_label = "vi_indikator_" . $id_indikator;
				}
				$params = array(
					"data_id" 	=> $id_indikator,
					"data_name" 	=> $data_name,
					"view_label" 	=> $view_label,
					"area_type" 	=> $area_type,
					'pivot_st' 		=> 'no',
					'mdb' 			=> 'djtz',
					'mdd' 			=> date("Y-m-d H:i:s")
				);

				//print_r($params);
				//insert
				$this->M_indicators->insert($params);
			}
		}
		redirect("geoportal/indicators");
		//exit();
	}
}
