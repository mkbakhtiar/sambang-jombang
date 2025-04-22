<?php

use PhpParser\Node\Stmt\Break_;

defined('BASEPATH') or exit('No direct script access allowed');

class Indikator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if ($this->auth_model->isNotLogin())
			redirect(base_url('auth'));
		$this->load->model("indikator_model", "im");
		$this->load->model("publikasi_model", "pm");
		$this->load->model("download_model", "dm");
	}


	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'li_1' => 'Minia',
			'li_2' => 'Dashboard'
		);
		$this->load->view('dash', $data);
	}

	public function dashboard()
	{
		$data = array(
			'title' => 'Dashboard',
			'li_1' => 'Minia',
			'li_2' => 'Dashboard'
		);
		$this->load->view('dash', $data);
	}

	// public function penetapan($id = null)
	// {
	// 	$props = array(
	// 		'rekap' => $this->im->get_rekap_konfirmasi($id != null ? $id : null),
	// 		'skpd_list' => $this->im->get_skpd(),
	// 		'transfer_count' => $this->im->get_transfer_count(),
	// 		'id_skpd' => $id
	// 	);
	// 	$data = array(
	// 		'title' => 'Penetapan',
	// 		'li_1' => 'Indikator',
	// 		'li_2' => 'Penetapan',
	// 		'props' => $props
	// 	);
	// 	$this->load->view('indikator/i-penetapan', $data);
	// }

	public function penetapan($id = null)
	{
		$props = array(
			'rekap' => $this->im->get_rekap_konfirmasi($id != null ? $id : null),
			'skpd_list' => $this->im->get_skpd(),
			'transfer_count' => $this->im->get_transfer_count(),
			'id_skpd' => $id,
			'test' => $this->im->get_tagar(141)
		);
		$data = array(
			'title' => 'Penetapan',
			'li_1' => 'Indikator',
			'li_2' => 'Penetapan',
			'props' => $props
		);

		// var_dump($props['test']);

		$this->load->view('indikator/i-penetapan', $data);
	}

	public function delete()
	{
		$id = encrypt_url(false, $this->input->post('id'));
		$submit = $this->im->delete($id);
		if ($submit) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui'
			);
		} else {
			$result = array(
				'status' => 'failed',
				'message' => 'Data Gagal Diperbaharui'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}

	public function transfer($type = null)
	{
		switch ($type) {
			case null:
				$props = array(
					// 'list' => $this->im->get_skpd()
				);

				$data = array(
					'title' => 'Transfer Indikator',
					'li_1' => 'Indikator',
					'li_2' => 'Transfer',
					'props' => $props
				);

				$this->load->view('indikator/partials/indikator-transfer', $data);
				break;

			case 'data':
				$raw = $this->im->build_ind_datatables_transfer();
				echo json_encode($raw);
				exit();
				break;

			case 'konfirmasi':
				$id = encrypt_url(false, $this->input->post('id'));
				$this->db->select('ik.*, i.id_skpd AS id_skpd_asal, i.nama_indikator, i.nama_skpd AS nama_skpd_asal, s.nama_skpd AS nama_skpd_pengganti');
				$this->db->join('v_indikator i', 'ik.id_indikator = i.id_indikator', 'left');
				$this->db->join('tbl_skpd s', 'ik.skpd_pengganti = s.id_skpd', 'left');
				$raw = $this->db->where('ik.id_konfirmasi', $id)->order_by('timestamp', 'DESC')->limit(1)->get('indikator_konfirmasi ik')->row_array();

				$data = array(
					'konfirmasi' => $raw,
					'skpd' => $this->im->get_skpd(),
					'id' => $this->input->post('id')
				);

				$this->load->view('indikator/partials/indikator-transfer-konfirmasi', $data);
				break;

			case 'submit':
				$raw = $this->security->xss_clean($this->input->post());
				$result = $this->im->konfirmasi_transfer($raw);

				header('Content-Type: application/json');
				echo json_encode($result);
				exit();
				break;

			default:
				# code...
				break;
		}
	}

	public function penetapan_progres()
	{
		$props = array(
			'rekap' => $this->im->get_rekap_konfirmasi('all')
		);
		$data = array(
			'title' => 'Progres Penetapan',
			'li_1' => 'Indikator',
			'li_2' => 'Progres Penetapan',
			'props' => $props
		);
		$this->load->view('indikator/partials/progres-penetapan', $data);
	}

	public function pengisian_progres()
	{
		// $this->output->cache(5);
		$props = array(
			'tahun' => $this->im->get_tahun(),
			'skpd_list' => $this->im->get_skpd(),
			'stats_indikator' => $this->im->get_rekap_konfirmasi(),
			'stats_data' => $this->im->get_rekap_input(),
		);

		foreach ($props['skpd_list'] as $ks => $vs) {
			$props['skpd_list'][$ks]['progres'] = $this->im->get_rekap_input($vs['id_skpd']);
		}
		$data = array(
			'title' => 'Progres Pengisian',
			'li_1' => 'Indikator',
			'li_2' => 'Progres Pengisian',
			'props' => $props
		);
		$this->load->view('indikator/partials/progres-pengisian', $data);
	}

	public function pengisian_progres_rev()
	{
		// $this->output->cache(5);
		$props = array(
			'tahun' => $this->im->get_tahun(),
			// 'skpd_list' => $this->im->get_skpd(),
			// 'stats_indikator' => $this->im->get_rekap_konfirmasi(),
			// 'stats_data' => $this->im->get_rekap_input(),
			'stats' => $this->im->get_rekap_input_rev()
		);

		// foreach ($props['skpd_list'] as $ks => $vs) {
		// 	$props['skpd_list'][$ks]['progres'] = $this->im->get_rekap_input($vs['id_skpd']);
		// }
		$data = array(
			'title' => 'Progres Pengisian',
			'li_1' => 'Indikator',
			'li_2' => 'Progres Pengisian',
			'props' => $props
		);
		$this->load->view('indikator/partials/progres-pengisian-rev', $data);
	}

	public function publikasi()
	{
		$props = array(
			// 'rekap' => $this->im->get_rekap_konfirmasi()
		);
		$data = array(
			'title' => 'Publikasi',
			'li_1' => 'Indikator',
			'li_2' => 'Publikasi',
			'props' => $props
		);
		$this->load->view('indikator/i-publikasi', $data);
	}

	public function get_rekap_konfirmasi($id = null, $idt = null)
	{
		$raw = $this->im->get_rekap_konfirmasi($id, $idt);
		header('Content-Type: application/json');
		echo json_encode($raw);
		exit();
	}

	public function get_rekap_verifikasi()
	{
		$raw = $this->im->get_rekap_verifikasi();
		header('Content-Type: application/json');
		echo json_encode($raw);
		exit();
	}

	public function get_indikator_data($id)
	{
		$id = encrypt_url(false, $id);
		$raw = $this->im->get_indikator_data($id);
		return $raw;
	}

	public function get_datas()
	{
		$id = encrypt_url(false, $this->input->post('id'));

		$props = array(
			'ind_data' => $this->im->get_indikator($id),
			'sub_data' => $this->im->get_sub_indikator($id),
			'tahun' => $this->im->get_tahun()
		);
		$props['ind_data']['data'] = $this->im->get_indikator_data($props['ind_data']['id_indikator']);
		foreach ($props['sub_data']['subs'] as $ks => $vs) {
			$props['sub_data']['subs'][$ks]['data'] = $this->im->get_indikator_data($vs['id_indikator']);
		}

		$data = array(
			'props' => $props
		);

		$this->load->view('indikator/partials/indikator-data', $data);
	}

	public function get_indikator_list($type, $id_skpd = null, $id_tagar = null)
	{
		if ($id_skpd === 'all') {
			$id_skpd = null;
		}

		switch ($type) {
			case 'confirm':
				$params = array(
					'columns' => ['id_indikator', 'nama_indikator', 'definisi_operasional', 'nama_satuan'],
					'table' => 'v_indikator',
					'type' => $type,
					'id_skpd' => $id_skpd
				);

				$result = $this->im->build_ind_datatables($params);
				break;

			case 'input':
				$params = array(
					'columns' => ['id_indikator', 'nama_indikator', 'definisi_operasional', 'nama_satuan'],
					'table' => 'v_indikator',
					'type' => $type,
					'id_skpd' => $id_skpd,
					'id_tagar' => $id_tagar // Tambahkan ini
				);

				$result = $this->im->build_ind_datatables_input($params);
				break;

			case 'verifikasi':
				$result = $this->im->build_ind_datatables_verifikasi();
				break;
			default:
				# code...
				break;
		}
		echo json_encode($result);
		exit();
	}

	public function get_indikator_detail()
	{
		$id = encrypt_url(false, $this->input->post('id'));

		// Mendapatkan data indikator utama dan sub-indikator
		$ind_data = $this->im->get_indikator($id);
		$sub_data = $this->im->get_sub_indikator($id);

		// Mengatur data untuk dikirimkan ke view
		$props = array(
			'metadata_cols' => $this->im->get_metadata_cols(),
			'ind_data' => $this->im->get_indikator($id),
			'tahun' => $this->im->get_tahun(),
			'sub_data' => $this->im->get_sub_indikator($id)
			// 'rows' => $this->generateSubDataRecursively($id) // Mulai dari level 0

		);

		$props['table_rows'] = $this->generateSubDataRecursively($id);

		$data = array(
			'title' => $props['ind_data']['nama_indikator'] . ' - Satu Data Jombang',
			'props' => $props
		);

		// $props['ind_data']['data'] = $this->fmd->get_indikator_data($props['ind_data']['id_indikator']);
		// 	foreach ($props['sub_data']['subs'] as $ks => $vs) {
		// 		$props['sub_data']['subs'][$ks]['data'] = $this->fmd->get_indikator_data($vs['id_indikator']);
		// 	}

		// Memuat view indikator-detail.php
		$this->load->view('indikator/partials/indikator-detail', $data);
	}

	private function generateSubDataRecursively($id, $parent_id = null, $level = 0, &$displayed_indicators = [])
	{

		if ($level == 0) {
			$main_indicator = $this->im->get_indikator($id); // Ganti dengan fungsi yang benar untuk mendapatkan indikator tingkat teratas

			// Sisipkan data indikator tingkat teratas ke dalam baris tabel
			$table_rows = '<tr>';
			$table_rows .= '<th scope="row">' . $id . '</th>'; // ID utama adalah ID yang Anda miliki
			$table_rows .= '<td style="padding-left:' . ($level * 10) . 'px">' . $main_indicator['nama_indikator'] . '</td>';
			$table_rows .= '<td>' . $main_indicator['definisi_operasional'] . '</td>';
			$table_rows .= '<td>' . $main_indicator['nama_satuan'] . '</td>';
			$table_rows .= '</tr>';
		} else {
			$table_rows = '';
		}

		// Mengambil data sub-indikator dari get_sub_indikator_rev
		// $table_rows = '';
		$sub_data = $this->im->get_sub_indikator($id);

		foreach ($sub_data['subs'] as $ks => $vs) {
			// Menentukan ID utama berdasarkan level
			// $main_id = $parent_id !== null ? $parent_id . '.' . str_pad(($ks + 1), 3, '0', STR_PAD_LEFT) : $vs['id_indikator'];

			$main_id = $parent_id !== null ? $parent_id . '.' . ($ks + 1) : $id . '.' . ($ks + 1);
			// Mengecek apakah indikator ini sudah ditampilkan sebelumnya sebagai id_main_indikator
			if (in_array($vs['id_indikator'], $displayed_indicators)) {
				continue; // Lanjut ke iterasi berikutnya jika sudah ditampilkan sebelumnya
			}

			// Tambahkan indikator ke array yang sudah ditampilkan
			$displayed_indicators[] = $vs['id_indikator'];

			// Sisipkan data sub-indikator ke dalam baris tabel
			// $table_rows .= '<tr>';
			// if ($level == 0) {
			// 	$table_rows .= '<th scope="row">' . ($ks + 1) . '</th>';
			// } else {
			// 	$table_rows .= '<th scope="row"></th>';
			// }
			$table_rows .= '<tr>';
			$table_rows .= '<th scope="row">' . $main_id . '</th>';
			$table_rows .= '<td style="padding-left:' . ($level * 10) . 'px">' . $vs['nama_indikator'] . '</td>';
			$table_rows .= '<td>' . $vs['definisi_operasional'] . '</td>';
			$table_rows .= '<td>' . $vs['nama_satuan'] . '</td>';
			$table_rows .= '</tr>';

			// Rekursif untuk menangani subkategori hanya jika ada
			$table_rows .= $this->generateSubDataRecursively($vs['id_indikator'], $main_id, $level + 1, $displayed_indicators);
		}
		return $table_rows;

	}

	public function pengisian($id = null, $idt = null)
	{
		if ($idt === 'all') {
			$idt = null;
		}

		if ($this->session->admin || $this->session->admin2) {
			if ($id === "all") {
				$id = null;
			} else {
				$id = $id;
			}
			$idt = $idt;
		} else {
			$id = $this->session->detail['id_skpd'];
		}
		$props = array(
			'skpd_list' => $this->im->get_skpd(),
			'stats_indikator' => $this->im->get_rekap_konfirmasi($id),
			'stats_data' => $this->im->get_rekap_input($id, $idt),
			'tagar_list' => $this->im->get_tagar_list()
		);
		$data = array(
			'title' => 'Pengisian',
			'li_1' => 'Indikator',
			'li_2' => 'Pengisian',
			'props' => $props
		);
		// var_dump("Tahun =" . $props['stats_data']['cnt_tahun'] .  "Data =" . $props['stats_data']['cnt_data']);

		// var_dump($idt);
		$this->load->view('indikator/i-pengisian', $data);
	}

	public function input($rid = null)
	{
		$id = encrypt_url(false, $rid);
		$props = array(
			'metadata_cols' => $this->im->get_metadata_cols(),
			'ind_data' => $this->im->get_indikator($id),
			'sub_data' => $this->im->get_sub_indikator($id),
			'tahun' => $this->im->get_tahun(),
			'id' => $rid,
			'history' => $this->im->get_data_files($id)
		);

		$data = array(
			'title' => 'Input Data',
			'li_1' => 'Data',
			'li_2' => $id,
			'props' => $props
		);

		$this->load->view('indikator/partials/indikator-input', $data);
	}


	// rev
	public function get_input_sub_list($id)
	{
		$params = array(
			'columns' => ['id_indikator', 'nama_indikator'],
			'table' => 'v_indikator',
			'id_indikator' => $id
		);

		$result = $this->im->build_ind_datatables_input_sub_list($params);
		echo json_encode($result);
		exit();
	}

	public function input_edit($id = null)
	{
		$iddata = encrypt_url(false, $this->input->post('iddata'));
		$props = array(
			'id_indikator' => $this->input->post('id'),
			'tahun' => $this->input->post('tahun'),
			'ind_data' => $this->im->get_indikator(encrypt_url(false, $this->input->post('id'))),
			'cur_data' => $this->im->get_data($iddata),
			'edit' => $iddata != '' ? true : false
		);

		$data = array(
			'title' => 'Input Data',
			'li_1' => 'Data',
			'li_2' => $id,
			'props' => $props
		);
		$this->load->view('indikator/partials/indikator-input-edit', $data);
	}

	public function input_get_list($id)
	{
		$id = encrypt_url(false, $id);
		$result = $this->im->build_data_datatables($id);
		echo json_encode($result);
		exit();
	}

	public function input_save()
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		$input = $this->im->save_data($raw_data);
		header('Content-Type: application/json');
		echo json_encode($input);
	}

	public function verifikasi()
	{
		$props = array(
			'skpd_list' => $this->im->get_skpd(),
			'tahun' => $this->im->get_tahun(),
		);
		$data = array(
			'title' => 'Verifikasi',
			'li_1' => 'Indikator',
			'li_2' => 'Verifikasi',
			'props' => $props
		);
		$this->load->view('indikator/i-verifikasi', $data);
	}

	public function data_verifikasi($type = null)
	{
		if ($type == null) {
			$id = encrypt_url(false, $this->input->post('id'));
			$raw = $this->db->where('id_data', $id)->order_by('timestamp', 'DESC')->limit(1)->get('v_data_verifikasi')->row_array();

			$data = array(
				'verifikasi' => $raw,
				'skpd' => $this->im->get_skpd(),
				'id' => $this->input->post('id')
			);

			$this->load->view('indikator/partials/data-verifikasi', $data);
		} elseif ($type == 'submit') {
			$raw = $this->security->xss_clean($this->input->post());
			$result = $this->im->verifikasi($raw);

			header('Content-Type: application/json');
			echo json_encode($result);
			exit();
		}
	}

	public function data_verifikasi_bulk($type = null)
	{
		if ($type == null) {
			// Ambil array ID yang dikirim dari frontend
			$ids = $this->input->post('ids');
			
			// Jika tidak ada ID yang dikirim
			if (empty($ids)) {
				echo "Tidak ada data yang dipilih";
				return;
			}
			
			// Array untuk menyimpan data verifikasi
			$verifikasi_data = [];
			
			// Ambil data verifikasi untuk setiap ID
			foreach ($ids as $id) {
				$encrypted_id = encrypt_url(false, $id);
				$row = $this->db->where('id_data', $encrypted_id)
							->order_by('timestamp', 'DESC')
							->limit(1)
							->get('v_data_verifikasi')
							->row_array();
				
				if ($row) {
					$verifikasi_data[$id] = $row;
				}
			}
			
			$data = array(
				'verifikasi_data' => $verifikasi_data,
				'skpd' => $this->im->get_skpd(),
				'ids' => $ids
			);
			
			// Load view untuk verifikasi massal
			$this->load->view('indikator/partials/data-verifikasi-bulk', $data);
		} elseif ($type == 'submit') {
			// Proses submit verifikasi massal
			$raw = $this->security->xss_clean($this->input->post());
			$result = $this->im->verifikasi_bulk($raw);
			
			header('Content-Type: application/json');
			echo json_encode($result);
			exit();
		}
	}

	// Tambahkan juga fungsi untuk menyimpan verifikasi massal
	public function save_verifikasi_bulk()
	{
		$raw = $this->security->xss_clean($this->input->post());
		$result = $this->im->verifikasi_bulk($raw);
		
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}

	public function add($id = null)
	{
		$id = encrypt_url(false, $id);
		$props = array(
			'metadata_cols' => $this->im->get_metadata_cols(),
			'satuan' => $this->im->get_satuan(),
			'periodik' => $this->im->get_periodik(),
			'akses' => $this->im->get_akses(),
			'skpd' => $this->im->get_skpd(),
			'keluaran' => $this->im->get_keluaran(),
			'keluaran_selected' => $this->im->get_selected('keluaran', $id),
			'urusan' => $this->im->get_urusan($id),
			'urusan_selected' => $this->im->get_selected('urusan', $id),
			'ind_data' => ($id != null ? $this->im->get_indikator($id) : null)
		);
		$data = array(
			'title' => ($id != null ? 'Edit' : 'Tambah') . ' Indikator',
			'li_1' => ($id != null ? 'Edit' : 'Tambah'),
			'li_2' => 'Indikator',
			'props' => $props,
			'id' => $id,
			'enc_id' => $this->encryption->encrypt($id),
			'edit' => ($id != null ? true : false)
		);
		$this->load->view('indikator/partials/indikator-edit', $data);
	}

	public function save()
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		$input = $this->im->save_indikator($raw_data);
		header('Content-Type: application/json');
		echo json_encode($input);
	}

	public function get_sub_list($id)
	{
		$params = array(
			'columns' => ['id_indikator', 'nama_indikator', 'definisi_operasional', 'nama_satuan'],
			'table' => 'v_indikator',
			'id_indikator' => $id
		);

		$result = $this->im->build_sub_datatables($params);
		echo json_encode($result);
		exit();
	}

	public function sub_edit()
	{
		$id = encrypt_url(false, $this->input->post('id'));
		$edit = $this->input->post('act') == 'edit' ? true : false;
		$raw = $this->db->where('id_indikator', $id)->get('indikator')->row_array();
		$props = array(
			'metadata_cols' => $this->im->get_metadata_cols(),
			'ind_data' => ($id != null ? $this->im->get_indikator($id) : null)
		);

		$data = array(
			'id_indikator' => $this->input->post('id'),
			'edit' => $edit,
			'edit_data' => $props['ind_data'],
			'satuan' => $this->im->get_satuan(),
			'main_id' => $this->input->post('mainid'),
			'props' => $props
		);

		$this->load->view('indikator/partials/sub-indikator-edit', $data);
	}

	public function sub_delete()
	{
		$id = encrypt_url(false, $this->input->post('id'));
		$submit = $this->im->delete_sub($id);
		if ($submit) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui'
			);
		} else {
			$result = array(
				'status' => 'failed',
				'message' => 'Data Gagal Diperbaharui'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}

	public function indikator_konfirmasi($type = null)
	{
		if ($type == null) {
			$id = encrypt_url(false, $this->input->post('id'));
			$raw = $this->db->where('id_indikator', $id)->order_by('timestamp', 'DESC')->limit(1)->get('indikator_konfirmasi')->row_array();

			$data = array(
				'konfirmasi' => $raw,
				'skpd' => $this->im->get_skpd(),
				'id' => $this->input->post('id')
			);

			$this->load->view('indikator/partials/indikator-konfirmasi', $data);
		} elseif ($type == 'submit') {
			$raw = $this->security->xss_clean($this->input->post());
			$result = $this->im->konfirmasi($raw);

			header('Content-Type: application/json');
			echo json_encode($result);
			exit();
		}
	}

	public function sub_submit()
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		$raw_data['id_main_indikator'] = encrypt_url(false, $raw_data['id_main_indikator']);
		$submit = $this->im->save_sub_indikator($raw_data);
		if ($submit) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui'
			);
		} else {
			$result = array(
				'status' => 'failed',
				'message' => 'Data Gagal Diperbaharui'
			);
		}
		$result = array_merge($result, $raw_data);
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}

	public function cetak($type = null, $id_skpd = null, $id_tagar = null)
	{
		if ($this->session->admin) {
			$id_skpd = $id_skpd;
		} else {
			$id_skpd = $this->session->detail['id_skpd'];
		}
		switch ($type) {
			case 'pilih':
				$props = array(
					'indikator_list' => $this->im->get_indikator_list($id_skpd, $id_tagar)
				);
				$data = array(
					'props' => $props
				);
				$this->load->view('indikator/partials/cetak-pilih', $data);
				break;

			case 'preview':
				$props = array(
					'tahun' => $this->im->get_tahun(),
					'selected_data' => []
				);
				foreach ($this->input->post('selected') as $ks => $vs) {
					$props['selected_data'][] = $this->im->get_indikator_full(encrypt_url(false, $vs));
				}
				;
				$data = array(
					'props' => $props
				);
				// debug($data);
				$this->load->view('indikator/partials/cetak-preview', $data);
				break;

			case 'excel':
				$this->dm->download();
				break;


			default:
				# code...
				break;
		}
	}

	public function test()
	{
		debug($this->im->get_rekap_input_rev());
	}

	public function get_subind_list($id)
	{
		$params = array(
			'columns' => ['id_indikator', 'nama_indikator', 'definisi_operasional', 'nama_satuan'],
			'table' => 'v_indikator',
			'id_indikator' => $id
		);

		$result = $this->im->build_subind_datatables($params);
		echo json_encode($result);
		exit();
	}

	public function daftarrequest()
	{
		if (!$this->session->admin)
			redirect(base_url('oops/forbidden'));
		$props = array(
			'cols' => ['#', 'Nama', 'Email', 'Telepon', 'Asal', 'Nama Instansi', 'Kebutuhan Data', 'Keperluan', 'Tanggal'],
			'type' => 'request_data',
		);
		$data = array(
			'title' => 'Permintaan Data',
			'li_1' => 'Publikasi',
			'li_2' => 'Permintaan Data',
			'props' => $props
		);
		$this->load->view('indikator/request-list', $data);
	}

	public function get_data()
	{
		$params = array(
			'columns' => ['id', 'nama', 'email', 'telepon', 'asal', 'nama_instansi', 'kebutuhan_data', 'keperluan', 'created_at'],
			'table' => 'req_data',
		);
		$result = $this->im->build_publikasi_datatables_req($params);


		echo json_encode($result);
		exit();
	}

	public function import_data()
	{
		// Check if request is AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		
		try {
			// Get the data from the request
			$data = $this->input->post('data');
			
			// Validate data format
			if (empty($data)) {
				return $this->output
					->set_content_type('application/json')
					->set_status_header(400)
					->set_output(json_encode([
						'status' => 'error',
						'message' => 'Format data tidak valid'
					]));
			}
			
			// Restructure the data into a more manageable format
			$years = array();
			$indicator_name = '';
			$values = array();
			
			// Extract years (first row, data[0])
			for ($i = 0; $i < count($data[0]); $i++) {
				if (!empty($data[0][$i]) && is_numeric($data[0][$i])) {
					$years[] = trim($data[0][$i]);
				}
			}
			
			// Check if we have any valid years
			if (empty($years)) {
				return $this->output
					->set_content_type('application/json')
					->set_status_header(400)
					->set_output(json_encode([
						'status' => 'error',
						'message' => 'Tidak ada tahun yang valid ditemukan'
					]));
			}
			
			// Get indicator name from the second column of the first data row
			if (isset($data[1][1])) {
				$indicator_name = trim($data[1][1]);
			}
			
			// Check if indicator name is provided
			if (empty($indicator_name)) {
				return $this->output
					->set_content_type('application/json')
					->set_status_header(400)
					->set_output(json_encode([
						'status' => 'error',
						'message' => 'Nama indikator tidak ditemukan'
					]));
			}
			
			// Get the indicator ID from the database based on the name
			$indicator = $this->db->where('nama_indikator', $indicator_name)->get('indikator')->row();
			
			if (!$indicator) {
				return $this->output
					->set_content_type('application/json')
					->set_status_header(400)
					->set_output(json_encode([
						'status' => 'error',
						'message' => 'Indikator "' . $indicator_name . '" tidak ditemukan dalam database'
					]));
			}
			
			$id_indikator = $indicator->id_indikator;
			
			// Extract values (subsequent rows)
			for ($row = 1; $row < count($data); $row++) {
				$row_values = array();
				
				// Find the years' column indices
				$year_indices = array();
				foreach ($years as $index => $year) {
					foreach ($data[0] as $col_index => $header) {
						if (trim($header) == $year) {
							$year_indices[$year] = $col_index;
							break;
						}
					}
				}
				
				// Extract values for each year
				foreach ($years as $year) {
					if (isset($year_indices[$year]) && isset($data[$row][$year_indices[$year]])) {
						$row_values[$year] = trim($data[$row][$year_indices[$year]]);
					}
				}
				
				if (!empty($row_values)) {
					$values[] = $row_values;
				}
			}
			
			// Process data and prepare for database operations
			$insert_data = array();
			$update_count = 0;
			$insert_count = 0;
			$timestamp = date('Y-m-d H:i:s');
			
			// Start database transaction
			$this->db->trans_start();
			
			// Process each year-value pair
			foreach ($values as $value_set) {
				foreach ($value_set as $year => $value) {
					// Skip if year or value is invalid
					if (empty($year) || !is_numeric($value)) {
						continue;
					}
					
					// Check if data already exists for this year and indicator
					$existing = $this->db->where('id_indikator', $id_indikator)
									->where('tahun', $year)
									->get('data')
									->row();
					
					if ($existing) {
						// Update existing data
						$this->db->set('data_angka', $value)
								->set('timestamp', $timestamp)
								->where('id_data', $existing->id_data)
								->update('data');
						$update_count++;
					} else {
						// Prepare new data for batch insert
						$insert_data[] = [
							'id_indikator' => $id_indikator,
							'tahun' => $year,
							'data_angka' => $value,
							'data_file' => '',  // No file for imported data
							'catatan' => 'Imported via Excel',
							'timestamp' => $timestamp
						];
						$insert_count++;
					}
				}
			}
			
			// Insert new data in batch
			if (!empty($insert_data)) {
				$this->db->insert_batch('data', $insert_data);
			}
			
			// Complete the transaction
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE) {
				return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode([
						'status' => 'error',
						'message' => 'Gagal menyimpan data'
					]));
			}
			
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'success',
					'message' => "Berhasil import data. $insert_count data ditambahkan, $update_count data diperbarui.",
					'insert_count' => $insert_count,
					'update_count' => $update_count
				]));
				
		} catch (Exception $e) {
			log_message('error', 'Import data error: ' . $e->getMessage());
			return $this->output
				->set_content_type('application/json')
				->set_status_header(500)
				->set_output(json_encode([
					'status' => 'error',
					'message' => 'Terjadi kesalahan: ' . $e->getMessage()
				]));
		}
	}
}
