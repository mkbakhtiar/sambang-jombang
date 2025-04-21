<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//CEK ADMIN
		$this->load->model('auth_model');
		if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));

		//LOAD MODEL
		$this->load->model('geoportal/M_datas', 'M_datas');
	}


	public function index($id = null)
	{
		$props = array(
			'cols' => ['#', 'ID Parent', 'ID Data',  'Tahun', 'Judul', 'Nilai'],
			'type' => 'datas'
		);

		$data = array(
			'title' => 'Datas',
			'li_1' => 'Geoportal',
			'li_2' => 'Datas',
			'props' => $props
		);

		// $postgre = $this->load->database('geoportal_postgre_db', TRUE);

		// $query = $postgre->query("
		// 		SELECT * FROM indikator_data");
		// print_r($query->result_array());
		// echo "xxxx";
		// exit();

		$this->load->view('geoportal/datas', $data);
	}


	public function get_data($what = null)
	{
		switch ($what) {
			case 'datas':
				$params = array(
					'columns' => ['data_id', 'parent_id', 'data_id', 'data_year',  'data_name', 'data_value'],
					'table' => 'view_builder_data',
				);
				break;
			default:
				# code...
				break;
		}

		$result = $this->M_datas->build_datatables($params);
		echo json_encode($result);
		exit();
	}

	public function sync()
	{
	//	print_r("SYNC");
	//	print_r("<br />");

		//get list indikator
		$values = $this->M_datas->get_indicator_main();
		$total = 0;

		//loop indicator
		foreach ($values as $key => $value) {
			// print_r("data	: " . $value['data_id']);
			// print_r("<br />");
			//get data list
			$datas = $this->M_datas->get_data_ori($value['data_id']);
			//print_r($datas);

			//loop data to get the value
			foreach ($datas as $key => $data) {
				//counting total
				$total++;
				//delete data before insert
				$params = array(
					"data_id" => $data['data_id'],
					"parent_id" => $data['parent_id'],
					"data_year" => $data['data_year']
				);
				$this->M_datas->delete($params);

				$data_value = $data['data_value'];
				if (is_numeric($data_value)) {
					$data_value = $data['data_value'];
				} else {
					$data_value = NULL;
				}
				// print_r("data_id		: " . $data['data_id'] . "<br />");
				// print_r("-data_year		: " . $data['data_year'] . "<br />");
				// print_r("-data_value	: " . $data['data_value'] . "<br />");
				// print_r("-data_value 2	: " . $data_value . "<br />");
				// print_r("<br />");
				//params
				$params = array(
					"data_id" => $data['data_id'],
					"parent_id" => $data['parent_id'],
					"data_name" => $data['title'],
					"data_year" => $data['data_year'],
					"data_value" => $data_value,
					'mdb' => 'djtz',
					'mdd' => date("Y-m-d H:i:s")
				);
				// print_r($params);
				//exec
				$this->M_datas->insert($params);

				//exit();
			}
		}
		// echo "<br />";
		// echo "total		= " . $total;
		// print_r($datas);

		redirect('geoportal/datas');
	}
}
