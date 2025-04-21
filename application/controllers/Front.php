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
		// $this->load->model("geoportal/M_geoportal", "M_geoportal");
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

	public function infokeuangan($type = null, $id = null)
	{
		if ($type == null && $id == null) {
			$folder = 2023;
			$props = array(
				'stats_counter' => '',
				'list_anggaran_2023' => $this->fmd->get_publikasi_anggaran(null, "2023"),
				'list_anggaran_2024' => $this->fmd->get_publikasi_anggaran(null, "2024"),
				'list_anggaran_2024_ringkasan' => $this->fmd->get_publikasi_anggaran(null, "2024/Ringkasan"),
				// 'list_infografis' => $this->fmd->get_publikasi_infografis(),
			);
			$data = array(
				'title' => 'Satu Data Jombang',
				'props' => $props
			);
			$this->load->view('front/anggaran', $data);
		} elseif ($type != null && $id != null) {
			$nid = createSlug(false, null, $id);
			switch ($type) {
				case 'anggaran':
					$dt = $this->fmd->get_publikasi_anggaran($nid);
					break;
				// case 'infografis':
				// 	$dt = $this->fmd->get_publikasi_infografis($nid);
				// 	break;
			}
			$props = array(
				'detail' => $dt[0],
			);
			$data = array(
				'title' => 'Satu Data Jombang',
				'props' => $props
			);
			$this->load->view('front/anggaran-detail', $data);
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
		$all_indikators = $this->im->get_all_indikators();
		$props = array(
			'ind_data' => $this->im->get_indikator($id, true),
			'sub_data' => $this->im->get_sub_indikator($id),
			'tahun' => $this->im->get_tahun()
		);

		$props['table_rows'] = $this->generateSubDataRecursively($id, $all_indikators);

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

	private function generateSubDataRecursively($id, $all_indikators, $parent_id = null, $level = 0, &$displayed_indicators = [])
	{
		$id = intval($id);
		if ($parent_id !== null) {
			$parent_id = htmlspecialchars($parent_id, ENT_QUOTES, 'UTF-8');
		}

		if ($level == 0) {
			$main_indicator = $this->findIndikatorById($id, $all_indikators);
			$main_data = $this->fmd->get_indikator_data($id);

			$table_rows = '<tr>';
			$table_rows .= '<th scope="row">' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '</th>';
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

		$sub_data = $this->findSubIndikatorsByParentId($id, $all_indikators);

		foreach ($sub_data as $ks => $vs) {
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

			$table_rows .= $this->generateSubDataRecursively($vs['id_indikator'], $all_indikators, $main_id, $level + 1, $displayed_indicators);
		}
		return $table_rows;
	}

	private function findIndikatorById($id, $all_indikators)
	{
		foreach ($all_indikators as $indikator) {
			if ($indikator['id_indikator'] == $id) {
				return $indikator;
			}
		}
		return null;
	}

	private function findSubIndikatorsByParentId($id_main, $all_indikators)
	{
		$subs = [];
		foreach ($all_indikators as $indikator) {
			if ($indikator['id_main_indikator'] == $id_main) {
				$subs[] = $indikator;
			}
		}
		return $subs;
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
					"uuid" => $data->uuid,
					"name" => $data->name,
					"workspace" => $data->workspace,
					"store" => $data->store,
					"title" => $data->title,
					"abstract" => $data->abstract,
					"attribution" => $data->attribution,
					"doi" => $data->doi,
					"alternate" => $data->alternate,
					"date" => $data->date,
					"date_type" => $data->date_type,
					"edition" => $data->edition,
					"purpose" => $data->purpose,
					"maintenance_frequency" => $data->maintenance_frequency,
					"popular_count" => $data->popular_count,
					"share_count" => $data->share_count,
					"rating" => $data->rating,
					"featured" => $data->featured,
					"is_published" => $data->is_published,
					"is_approved" => $data->is_approved,
					"detail_url" => $data->detail_url,
					"embed_url" => $data->embed_url,
					"thumbnail_url" => $data->thumbnail_url,
					"download_url" => $data->download_url,
					"link" => $data->link,
					"resource_type" => $data->resource_type,
					"mdb" => "djtz",
					"mdd" => date("Y-m-d h:i:s")
				);

				$this->M_geoportal->insert($params);
			}
		}
	}


	// Menambahkan Geospasial Urusan 


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

	public function dashboard()
	{
		$props = array(
			'stats_counter' => $this->fmd->stats(),
			'list_top' => $this->fmd->get_top_3(),
			'list_tempattidur' => $this->fmd->get_api_response('Info Tempat Tidur RSUD'),
			'list_kunjungan' => $this->fmd->get_api_response('Data Kunjungan Pasien'),
			'rsud_updated_at' => $this->fmd->get_last_updated_at('Info Tempat Tidur RSUD'), // Simpan updated_at di dalam $props
			'simpus_updated_at' => $this->fmd->get_last_updated_at('Data Kunjungan Pasien'), // Simpan updated_at di dalam $props

		);
		$data = array(
			'title' => 'Satu Data Jombang',
			'props' => $props
		);
		$this->load->view('front/dashboard', $data);
	}

	public function harga()
	{
		$props = array(
			'stats_counter' => $this->fmd->stats(),
			'list_top' => $this->fmd->get_top_3(),
		
		);
		$data = array(
			'title' => 'Satu Data Jombang',
			'props' => $props
		);
		$this->load->view('front/harga', $data);
	}


	public function dataKosong()
	{
		$this->load->view('front/partials/dataKosong');
	}
	public function dataPuskesmas()
	{
		$props = array(
			'list_tempattidur' => $this->fmd->get_api_response('Info Tempat Tidur RSUD'),
			'list_kunjungan' => $this->fmd->get_api_response('Data Kunjungan Pasien'),
			'rsud_updated_at' => $this->fmd->get_last_updated_at('Info Tempat Tidur RSUD'), // Simpan updated_at di dalam $props
			'simpus_updated_at' => $this->fmd->get_last_updated_at('Data Kunjungan Pasien'), // Simpan updated_at di dalam $props
		);
		$data = array(
			'props' => $props
		);
		$this->load->view('front/partials/dataPuskesmas', $data);
	}
	public function dataRSUD()
	{
		$props = array(
			'list_tempattidur' => $this->fmd->get_api_response('Info Tempat Tidur RSUD'),
			'list_kunjungan' => $this->fmd->get_api_response('Data Kunjungan Pasien'),
			'rsud_updated_at' => $this->fmd->get_last_updated_at('Info Tempat Tidur RSUD'), // Simpan updated_at di dalam $props
			'simpus_updated_at' => $this->fmd->get_last_updated_at('Data Kunjungan Pasien'), // Simpan updated_at di dalam $props
		);
		$data = array(
			'props' => $props
		);
		$this->load->view('front/partials/dataRSUD', $data);
	}
	public function dataIPH()
	{
		$this->load->view('front/partials/dataIPH');
	}
	public function dataHarga()
	{
		$this->load->view('front/partials/dataHargaBaru');
	}
	public function dataHargaTPID()
	{
		$this->load->view('front/partials/dataHargaTPID');
	}
	public function dataStock()
	{
		$this->load->view('front/partials/dataStockBaru');
	}
	public function dataBalita()
	{
		$this->load->view('front/partials/dataBalita');
	}

	public function dataSD()
	{
		$this->load->view('front/partials/dataSD');
	}

	public function dataSMP()
	{
		$this->load->view('front/partials/dataSMP');
	}

	public function dataPengangguran()
	{
		$this->load->view('front/partials/dataPengangguran');
	}
	public function dataPenyerapan()
	{
		$this->load->view('front/partials/dataPenyerapan');
	}
	public function dataBUMD()
	{
		$this->load->view('front/partials/dataBUMD');
	}

	public function dataPuskesmasBaru()
	{
		$this->load->view('front/partials/dataPuskesmasBaru');
	}
	public function dataRS()
	{
		$this->load->view('front/partials/dataRS');
	}

	public function dataFaskes()
	{
		$this->load->view('front/partials/dataFaskes');
	}
	public function dataRSUDPloso()
	{
		$this->load->view('front/partials/dataRSUDPloso');
	}
	public function dataPerizinan()
	{
		$this->load->view('front/partials/dataPerizinan');
	}

	public function dataProduksi()
	{
		$this->load->view('front/partials/dataProduksi');
	}

	public function dataKemiskinan()
	{
		$this->load->view('front/partials/dataKemiskinan');
	}

	public function dataRSUDJombang()
	{
		$this->load->view('front/partials/dataRSUDJombang');
	}



	// Menambahkan Modal Komoditi
	public function komoditi()
	{
		$this->load->view('front/partials/komoditi');
	}

	public function kesehatan()
	{
		$props = array(
			// 'list_gender' => $this->fmd->get_data_keboan('keboan', 'gender'),
			// 'list_tujuan' => $this->fmd->get_data_keboan('keboan', 'tujuan'),
			// 'list_umur' => $this->fmd->get_data_keboan('keboan', 'umur'),
			'list_tempattidur' => $this->fmd->get_api_response('Info Tempat Tidur RSUD'),
			'list_kunjungan' => $this->fmd->get_api_response('Data Kunjungan Pasien'),
			'rsud_updated_at' => $this->fmd->get_last_updated_at('Info Tempat Tidur RSUD'), // Simpan updated_at di dalam $props
			'simpus_updated_at' => $this->fmd->get_last_updated_at('Data Kunjungan Pasien'), // Simpan updated_at di dalam $props
		);
		$data = array(
			'props' => $props
		);
		$this->load->view('front/partials/kesehatan', $data);
	}


	public function petacoba()
	{
		$this->load->view('front/petacoba');
	}

	public function kecamatan($kecamatan)
	{
		// Memanggil fungsi untuk mendapatkan data kecamatan
		$kecamatan_data = $this->fmd->get_luas_kecamatan($kecamatan);
		$total_desa_data = $this->fmd->get_total_desa_kecamatan($kecamatan);

		// Memisahkan raw data dan nama indikator dari hasil query
		$raw_data = $kecamatan_data['raw']; // Mengakses data raw
		$raw_desa = $total_desa_data['raw'];
		// $nama_indikator = $kecamatan_data['nama_indikator']; // Mengakses nama indikator

		// Menyimpan data dalam $props
		$props = array(
			'list_kecamatan' => $raw_data, // Data raw kecamatan
			'total_desa_kecamatan' => $raw_desa, // Data raw kecamatan
			'nama_indikator' => $kecamatan // Nama indikator kecamatan
		);

		// Mengisi data yang akan dikirim ke view
		$data = array(
			'title' => 'Satu Data Jombang',
			'props' => $props
		);

		$this->load->view('front/partials/kecamatan', $data);
	}

	public function save_request()
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		$input = $this->fmd->save_request_data($raw_data);
		header('Content-Type: application/json');
		echo json_encode($input);
	}


}
