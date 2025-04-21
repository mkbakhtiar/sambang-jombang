<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
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

	public function index()
	{
		$props = array(
			'stats_counter' => $this->fmd->stats(),
			'list_top' => $this->fmd->get_top_3()
		);
		$data = array(
			'title' => 'Satu Data Jombang',
			'props' => $props
		);
		$this->load->view('front/home', $data);
	}

	public function urusan()
	{
		$props = array(
			'stats_counter' => '',
			'list_urusan' => $this->fmd->get_urusan(),
		);
		$data = array(
			'title' => 'Satu Data Jombang',
			'props' => $props
		);
		$this->load->view('front/urusan', $data);
	}
	public function produsen()
	{
		$props = array(
			'stats_counter' => '',
			'list_produsen' => $this->fmd->get_produsen(),
		);
		$data = array(
			'title' => 'Satu Data Jombang',
			'props' => $props
		);
		$this->load->view('front/produsen', $data);
	}

	public function publikasi($type = null, $id = null)
	{
		if ($type == null && $id == null) {
			$props = array(
				'stats_counter' => '',
				'list_buku' => $this->fmd->get_publikasi_buku(),
				'list_infografis' => $this->fmd->get_publikasi_infografis(),
			);
			$data = array(
				'title' => 'Satu Data Jombang',
				'props' => $props
			);
			$this->load->view('front/publikasi', $data);
		} elseif ($type != null && $id != null) {
			$nid = createSlug(false, null, $id);
			switch ($type) {
				case 'buku':
					$dt = $this->fmd->get_publikasi_buku($nid);
					break;
				case 'infografis':
					$dt = $this->fmd->get_publikasi_infografis($nid);
					break;
			}
			$props = array(
				'detail' => $dt[0],
			);
			$data = array(
				'title' => 'Satu Data Jombang',
				'props' => $props
			);
			$this->load->view('front/publikasi-detail', $data);
		}
	}

	public function katalog_data()
	{
		$props = array(
			'stats_counter' => '',
			'list' => $this->fmd->get_indikator_list()
		);

		$data = array(
			'title' => 'Data - Satu Data Jombang',
			'props' => $props
		);
		$this->load->view('front/katalog-data', $data);
	}

	public function data($id = null)
	{
		$id = createSlug(false, null, $id);
		if ($id != null) {
			$props = array(
				'ind_data' => $this->im->get_indikator($id, true),
				'sub_data' => $this->im->get_sub_indikator($id),
				'tahun' => $this->im->get_tahun()
			);
			if ($props['ind_data'] == null)
				redirect(base_url('oops/not_found'));
			$props['ind_data']['data'] = $this->fmd->get_indikator_data($props['ind_data']['id_indikator']);
			foreach ($props['sub_data']['subs'] as $ks => $vs) {
				$props['sub_data']['subs'][$ks]['data'] = $this->fmd->get_indikator_data($vs['id_indikator']);
			}
			$data = array(
				'title' => $props['ind_data']['nama_indikator'] . ' - Satu Data Jombang',
				'props' => $props
			);
			$this->load->view('front/data-detail', $data);
			$this->add_count($id);
		} else {
			$props = array(
				'stats_counter' => '',
				'list' => $this->fmd->get_indikator_list()
			);

			$data = array(
				'title' => 'Data - Satu Data Jombang',
				'props' => $props
			);
			$this->load->view('front/data', $data);
		}
	}

	public function detail($id)
	{
		$id = createSlug(false, null, $id);
		// $id = $this->security->xss_clean($this->input->post('id'));
		// $id = encrypt_url(false, $id);
		$props = array(
			'ind_data' => $this->im->get_indikator($id, true),
			'sub_data' => $this->im->get_sub_indikator($id),
			'tahun' => $this->im->get_tahun()
		);
		
		$props['table_rows'] = $this->generateSubDataRecursively($id);

		$props['ind_data']['data'] = $this->fmd->get_indikator_data($props['ind_data']['id_indikator']);
		foreach ($props['sub_data']['subs'] as $ks => $vs) {
			$props['sub_data']['subs'][$ks]['data'] = $this->fmd->get_indikator_data($vs['id_indikator']);
		}
		$data = array(
			'title' => $props['ind_data']['nama_indikator'] . ' - Satu Data Jombang',
			'props' => $props
		);
		$this->load->view('front/partials/detail', $data);
		$this->add_count($id);
	}

	private function generateSubDataRecursively($id, $parent_id = null, $level = 0, &$displayed_indicators = []) {
		
		$id = intval($id); 
		if ($parent_id !== null) {
			$parent_id = htmlspecialchars($parent_id, ENT_QUOTES, 'UTF-8'); 
		}
	
		if ($level == 0) {
			$main_indicator = $this->im->get_indikator($id); 
			$main_data = $this->fmd->get_indikator_data($id); 
	
			$table_rows = '<tr>';
			$table_rows .= '<th scope="row">' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '</th>'; // ID utama adalah ID yang Anda miliki
			$table_rows .= '<td style="padding-left:10px">' . htmlspecialchars($main_indicator['nama_indikator'], ENT_QUOTES, 'UTF-8') . '</td>';
			foreach ($main_data as $vd) {
				$table_rows .= '<td class="text-end">' . htmlspecialchars(convert_number($vd['data_angka']), ENT_QUOTES, 'UTF-8') . '</td>';
			}
			$table_rows .= '<td>' . htmlspecialchars($main_indicator['definisi_operasional'], ENT_QUOTES, 'UTF-8') . '</td>';
			$table_rows .= '<td>' . htmlspecialchars($main_indicator['nama_satuan'], ENT_QUOTES, 'UTF-8') . '</td>';
			$table_rows .= '</tr>';
		} else {
			$table_rows = '';
		}
	
		$sub_data = $this->im->get_sub_indikator($id);
	
		foreach ($sub_data['subs'] as $ks => $vs) {
			$main_id = $parent_id !== null ? $parent_id . '.' . ($ks + 1) : $id . '.' . ($ks + 1);
			if (in_array($vs['id_indikator'], $displayed_indicators)) {
				continue; 
			}
			$displayed_indicators[] = $vs['id_indikator'];
	
			$sub_data_values = $this->fmd->get_indikator_data($vs['id_indikator']);
	
			$table_rows .= '<tr>';
			$table_rows .= '<th scope="row">' . htmlspecialchars($main_id, ENT_QUOTES, 'UTF-8') . '</th>';
			$table_rows .= '<td style="padding-left:' . (15 + $level * 10) . 'px">' . htmlspecialchars($vs['nama_indikator'], ENT_QUOTES, 'UTF-8') . '</td>';
			foreach ($sub_data_values as $vsd) {
				$table_rows .= '<td class="text-end">' . htmlspecialchars(convert_number($vsd['data_angka']), ENT_QUOTES, 'UTF-8') . '</td>';
			}
			$table_rows .= '<td>' . htmlspecialchars($vs['definisi_operasional'], ENT_QUOTES, 'UTF-8') . '</td>';
			$table_rows .= '<td>' . htmlspecialchars($vs['nama_satuan'], ENT_QUOTES, 'UTF-8') . '</td>';
			$table_rows .= '</tr>';
	
			// Rekursif untuk menangani subkategori hanya jika ada
			$table_rows .= $this->generateSubDataRecursively($vs['id_indikator'], $main_id, $level + 1, $displayed_indicators);
		}
		return $table_rows;
	}	

	function add_count($id)
	{
		$this->load->helper('cookie');
		$check_visitor = $this->input->cookie($id, FALSE);
		$ip = $this->input->ip_address();
		if ($check_visitor == false) {
			date_default_timezone_set("Asia/Jakarta");
			$cookie = array("name" => $id, "value" => $ip, "expire" => 300, "secure" => false);
			$this->input->set_cookie($cookie);
			$this->fmd->update_counter($id);
		}
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

	public function test()
	{
		$input = $this->input->server('REQUEST_URI');
		debug($input);
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

	// public function geoportalsync()
	// {
	// 	# URL
	// 	$url = "https://geoportal.bantulkab.go.id/api/base/?limit=20000";
	// 	$url = "https://geoportal.bantulkab.go.id/api/v2/datasets/";
	// 	$url = "https://geoportal.jombangkab.go.id/api/v2/datasets";
	// 	// $url = "https://geoportal.bantulkab.go.id/api/v2/datasets";

	// 	# get data from json
	// 	$json = file_get_contents($url);
	// 	$raw_datas = json_decode($json);
	// 	$total_data = $raw_datas->total;
	// 	$total_size = $raw_datas->page_size;
	// 	$total_page = ceil($total_data / $total_size);

	// 	$this->M_geoportal->truncate();
	// 	# loop data from list
	// 	for ($i = 1; $i <= $total_page; $i++) {
	// 		// for ($i = 1; $i <= 1; $i++) {
	// 		# parsing data
	// 		$uri = $url . "?page=" . $i;
	// 		$json_data = file_get_contents($uri);
	// 		$datas = json_decode($json_data);
	// 		// echo "<pre>";
	// 		// print_r($data->datasets[0]);
	// 		// echo "</pre>";
	// 		// echo "<br />";

	// 		foreach ($datas->datasets as $key => $data) {
	// 			# code...
	// 			$params = array(
	// 				"pk" 					=> $data->pk,
	// 				"uuid" 					=>  $data->uuid,
	// 				"name" 					=>  $data->name,
	// 				"workspace" 			=>  $data->workspace,
	// 				"store" 				=>  $data->store,
	// 				"title" 				=>  $data->title,
	// 				"abstract" 				=>  $data->abstract,
	// 				"attribution" 			=>  $data->attribution,
	// 				"doi" 					=>  $data->doi,
	// 				"alternate" 			=>  $data->alternate,
	// 				"date" 					=>  $data->date,
	// 				"date_type" 			=>  $data->date_type,
	// 				"edition" 				=>  $data->edition,
	// 				"purpose" 				=>  $data->purpose,
	// 				"maintenance_frequency" =>  $data->maintenance_frequency,
	// 				"popular_count" 		=>  $data->popular_count,
	// 				"share_count" 			=>  $data->share_count,
	// 				"rating" 				=>  $data->rating,
	// 				"featured" 				=>  $data->featured,
	// 				"is_published" 			=>  $data->is_published,
	// 				"is_approved" 			=>  $data->is_approved,
	// 				"detail_url" 			=>  $data->detail_url,
	// 				"embed_url" 			=>  $data->embed_url,
	// 				"thumbnail_url" 		=>  $data->thumbnail_url,
	// 				"download_url" 			=>  $data->download_url,
	// 				"link" 					=>  $data->link,
	// 				"resource_type" 		=>  $data->resource_type,
	// 				"mdb"					=> "djtz",
	// 				"mdd"					=> date("Y-m-d h:i:s")
	// 			);
	// 			// echo "<pre>";
	// 			// print_r($params);
	// 			// echo "</pre>";
	// 			// echo "<br />";
	// 			// echo "<br />";

	// 			$this->M_geoportal->insert($params);
	// 		}
	// 	}
	// }
	
	public function geoportalsync()
	{
		# URL
		$url = "https://geoportal.bantulkab.go.id/api/base/?limit=20000";
		$url = "https://geoportal.bantulkab.go.id/api/v2/datasets/";
		$url = "https://geoportal.jombangkab.go.id/api/v2/datasets";
		// $url = "https://geoportal.bantulkab.go.id/api/v2/datasets";

		# get data from json
		$opts = [
			"http" => [
				"method" => "GET",
				"header" => "User-Agent: PHP"
			],
			"ssl" => [
				"verify_peer" => false
			]
		];

		$context = stream_context_create($opts);
		$json = file_get_contents($url, false, $context);
		$raw_datas = json_decode($json);
		$total_data = $raw_datas->total;
		$total_size = $raw_datas->page_size;
		$total_page = ceil($total_data / $total_size);

		$this->M_geoportal->truncate();
		# loop data from list
		for ($i = 1; $i <= $total_page; $i++) {
			// for ($i = 1; $i <= 1; $i++) {
			# parsing data
			$uri = $url . "?page=" . $i;
			$json_data = file_get_contents($uri, false, $context);
			$datas = json_decode($json_data);
			// echo "<pre>";
			// print_r($data->datasets[0]);
			// echo "</pre>";
			// echo "<br />";

			foreach ($datas->datasets as $key => $data) {
				# code...
				$params = array(
					"pk" => $data->pk,
					"uuid" =>  $data->uuid,
					"name" =>  $data->name,
					"workspace" =>  $data->workspace,
					"store" =>  $data->store,
					"title" =>  $data->title,
					"abstract" =>  $data->abstract,
					"attribution" =>  $data->attribution,
					"doi" =>  $data->doi,
					"alternate" =>  $data->alternate,
					"date" =>  $data->date,
					"date_type" =>  $data->date_type,
					"edition" =>  $data->edition,
					"purpose" =>  $data->purpose,
					"maintenance_frequency" =>  $data->maintenance_frequency,
					"popular_count" =>  $data->popular_count,
					"share_count" =>  $data->share_count,
					"rating" =>  $data->rating,
					"featured" =>  $data->featured,
					"is_published" =>  $data->is_published,
					"is_approved" =>  $data->is_approved,
					"detail_url" =>  $data->detail_url,
					"embed_url" =>  $data->embed_url,
					"thumbnail_url" =>  $data->thumbnail_url,
					"download_url" =>  $data->download_url,
					"link" =>  $data->link,
					"resource_type" =>  $data->resource_type,
					"mdb" => "djtz",
					"mdd" => date("Y-m-d h:i:s")
				);

				$this->M_geoportal->insert($params);
			}
		}
	}


	// Menambahkan Geospasial Urusan 

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

	// Menambahkan Detail Geo
	public function detailGeo($id)
	{
		$id = createSlug(false, null, $id);
	
		$props = array(
			'list_objects' => $this->M_geoportal->get_datas_connect($id),
		);
		$data = array(
			'props' => $props
		);
		$this->load->view('front/partials/detailgeo', $data);
		$this->add_count($id);

	}

	
	// Menambahkan Modal Komoditi
	public function komoditi()
	{
			$this->load->view('front/partials/komoditi');
	}

	public function kesehatan()
	{
		$updated_at = $this->fmd->get_last_updated_at('Info Tempat Tidur RSUD'); // Mengambil updated_at
		$props = array(
			// 'list_gender' => $this->fmd->get_data_keboan('keboan', 'gender'),
			// 'list_tujuan' => $this->fmd->get_data_keboan('keboan', 'tujuan'),
			// 'list_umur' => $this->fmd->get_data_keboan('keboan', 'umur'),
			// 'list_kategori' => $this->fmd->get_data_keboan('keboan', 'kategori'),
			'list_tempattidur' => $this->fmd->get_api_response('Info Tempat Tidur RSUD'),
			'updated_at' => $updated_at // Simpan updated_at di dalam $props
		);
		$data = array(
			'props' => $props
		);
		$this->load->view('front/partials/kesehatan', $data);
	}


}
