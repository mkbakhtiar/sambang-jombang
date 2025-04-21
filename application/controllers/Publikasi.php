<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));
		$this->load->model("publikasi_model", "pubm");
		$this->load->model("indikator_model", "i_m");
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

	public function keluaran()
	{
		if (!$this->session->admin) redirect(base_url('oops/forbidden'));
		$props = array(
			'cols' => ['#', 'Nama Keluaran', 'Deskripsi', 'Status', 'Daftar Data', 'Aksi'],
			'type' => 'keluaran',
			'keluaran' => $this->pubm->get_keluaran()
		);
		$data = array(
			'title' => 'Keluaran',
			'li_1' => 'Publikasi',
			'li_2' => 'Keluaran',
			'props' => $props
		);
		$this->load->view('publikasi/p-list-uk', $data);
	}
	public function urusan()
	{
		if (!$this->session->admin) redirect(base_url('oops/forbidden'));
		$props = array(
			'cols' => ['#', 'Nama Urusan', 'Deskripsi', 'Status', 'Daftar Data', 'Aksi'],
			'type' => 'urusan',
			'urusan' => $this->pubm->get_urusan()
		);
		$data = array(
			'title' => 'Urusan',
			'li_1' => 'Publikasi',
			'li_2' => 'Urusan',
			'props' => $props
		);
		$this->load->view('publikasi/p-list-uk', $data);
	}

	public function pilih_data($type = null)
	{
		$id = encrypt_url(false, $this->input->post('id'));
		$props = array(
			'id' => $this->input->post('id'),
			'selected' => $this->pubm->get_selected($type, $id),
			'indikator_list' => $this->pubm->get_indikator_list(),
			'type' => $type
		);
		$data = array(
			'props' => $props
		);
		$this->load->view('publikasi/partials/p-choose', $data);
	}

	public function lihat_data($type = null)
	{
		$id = encrypt_url(false, $this->input->post('id'));
		$props = array(
			'id' => $this->input->post('id'),
			'type' => $type,
			'tahun' => $this->i_m->get_tahun(),
			'selected_data' => []
		);
		foreach ($this->pubm->get_selected($type, $id) as $ks => $vs) {
			$props['selected_data'][] = $this->i_m->get_indikator_full($vs);
		};
		$data = array(
			'props' => $props
		);
		$this->load->view('publikasi/partials/p-lihat', $data);
	}

	public function submit($type)
	{
		$raw = $this->security->xss_clean($this->input->post());
		switch ($type) {
			case 'urusan':
				$save = $this->pubm->set_selected('urusan', $raw);
				header('Content-Type: application/json');
				echo json_encode($save);
				exit();

			case 'keluaran':
				$save = $this->pubm->set_selected('keluaran', $raw);
				header('Content-Type: application/json');
				echo json_encode($save);
				exit();

			case 'tagar':
				$save = $this->pubm->set_selected('tagar', $raw);
				header('Content-Type: application/json');
				echo json_encode($save);
				exit();

			default:
				# code...
				break;
		}
	}

	public function buku()
	{
		if (!$this->session->admin) redirect(base_url('oops/forbidden'));
		$props = array(
			'cols' => ['#', 'Judul', 'Deskripsi', 'OPD', 'Cover', 'File', 'Aksi'],
			'type' => 'buku'
		);

		$data = array(
			'title' => 'Buku',
			'li_1' => 'Publikasi',
			'li_2' => 'Buku',
			'props' => $props
		);
		$this->load->view('publikasi/p-list', $data);
	}

	public function anggaran()
	{
		if (!$this->session->admin) redirect(base_url('oops/forbidden'));
		$props = array(
			'cols' => ['#', 'Judul', 'Deskripsi', 'OPD', 'Cover', 'File', 'Aksi'],
			'type' => 'anggaran'
		);

		$data = array(
			'title' => 'Anggaran',
			'li_1' => 'Publikasi',
			'li_2' => 'Anggaran',
			'props' => $props
		);
		$this->load->view('publikasi/p-list', $data);
	}

	public function infografis()
	{
		if (!$this->session->admin) redirect(base_url('oops/forbidden'));
		$props = array(
			'cols' => ['#', 'Judul', 'Deskripsi', 'OPD', 'Cover', 'File', 'Aksi'],
			'type' => 'infografis'
		);

		$data = array(
			'title' => 'Infografis',
			'li_1' => 'Publikasi',
			'li_2' => 'Infografis',
			'props' => $props
		);
		$this->load->view('publikasi/p-list', $data);
	}

	public function get_data($what = null)
	{
		switch ($what) {
			case 'buku':
				$params = array(
					'columns' => ['id_buku', 'judul', 'deskripsi', 'nama_skpd', 'cover_name', 'file_name'],
					'table' => 'p_buku',
				);
				$result = $this->pubm->build_publikasi_datatables($params);
				break;
			case 'infografis':
				$params = array(
					'columns' => ['id_infografis', 'judul', 'deskripsi', 'nama_skpd', 'cover_name', 'file_name'],
					'table' => 'p_infografis',
				);
				$result = $this->pubm->build_publikasi_datatables($params);
				break;
			case 'anggaran':
				$params = array(
					'columns' => ['id_anggaran', 'judul', 'deskripsi', 'nama_skpd', 'cover_name', 'file_name'],
					'table' => 'p_anggaran',
				);
				$result = $this->pubm->build_publikasi_datatables($params);
				break;
			case 'urusan':
				$params = array(
					'columns' => ['id_urusan', 'nama_urusan', 'keterangan'],
					'table' => 'tbl_urusan',
					'type' => 'urusan',
				);
				$result = $this->pubm->build_publikasi_datatables_uk($params);
				break;
			case 'keluaran':
				$params = array(
					'columns' => ['id_keluaran', 'nama_keluaran', 'keterangan'],
					'table' => 'tbl_keluaran',
					'type' => 'keluaran',
				);
				$result = $this->pubm->build_publikasi_datatables_uk($params);
				break;
			case 'tagar':
				$params = array(
					'columns' => ['id_tagar', 'nama_tagar', 'keterangan'],
					'table' => 'tbl_tagar',
					'type' => 'tagar',
				);
				$result = $this->pubm->build_publikasi_datatables_uk($params);
				break;
		}
		echo json_encode($result);
		exit();
	}

	public function edit($what)
	{
		$id = encrypt_url(false, $this->input->post('id'));
		switch ($what) {
			case 'buku':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_buku', $id)->get('p_buku')->row_array();
				$edit_data = array(
					array(
						'label' => 'ID Buku',
						'name' => 'id_buku',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Judul',
						'name' => 'judul',
						'type' => 'text',
						'data' => $edit ? $raw['judul'] : null
					),
					array(
						'label' => 'Deskripsi',
						'name' => 'deskripsi',
						'type' => 'textarea',
						'data' => $edit ? $raw['deskripsi'] : null
					),
					array(
						'label' => 'Nama SKPD',
						'name' => 'id_skpd',
						'type' => 'select_skpd',
						'option' => $this->i_m->get_skpd(),
						'data' => $edit ? $raw['id_skpd'] : null
					),
					array(
						'label' => 'Cover',
						'name' => 'cover',
						'type' => 'file',
						'data' => $edit ? $raw['cover'] : null
					),
					array(
						'label' => 'File',
						'name' => 'file',
						'type' => 'file',
						'data' => $edit ? $raw['file'] : null
					)
				);
				break;

			case 'infografis':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_infografis', $id)->get('p_infografis')->row_array();
				$edit_data = array(
					array(
						'label' => 'ID Infografis',
						'name' => 'id_infografis',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Judul',
						'name' => 'judul',
						'type' => 'text',
						'data' => $edit ? $raw['judul'] : null
					),
					array(
						'label' => 'Deskripsi',
						'name' => 'deskripsi',
						'type' => 'textarea',
						'data' => $edit ? $raw['deskripsi'] : null
					),
					array(
						'label' => 'Nama SKPD',
						'name' => 'id_skpd',
						'type' => 'select_skpd',
						'option' => $this->i_m->get_skpd(),
						'data' => $edit ? $raw['id_skpd'] : null
					),
					// array(
					// 	'label' => 'Cover',
					// 	'name' => 'cover',
					// 	'type' => 'file',
					// 	'data' => $edit ? $raw['cover'] : null
					// ),
					// array(
					// 	'label' => 'File',
					// 	'name' => 'file',
					// 	'type' => 'file',
					// 	'data' => $edit ? $raw['file'] : null
					// )
				);
				break;
				case 'anggaran':
					$edit = $this->input->post('act') == 'edit' ? true : false;
					$raw = $this->db->where('id_anggaran', $id)->get('p_anggaran')->row_array();
					$edit_data = array(
						array(
							'label' => 'ID Anggaran',
							'name' => 'id_anggaran',
							'type' => 'hidden',
							'data' => $edit ? $this->input->post('id') : null
						),
						array(
							'label' => 'Judul',
							'name' => 'judul',
							'type' => 'text',
							'data' => $edit ? $raw['judul'] : null
						),
						array(
							'label' => 'Deskripsi',
							'name' => 'deskripsi',
							'type' => 'textarea',
							'data' => $edit ? $raw['deskripsi'] : null
						),
						array(
							'label' => 'Nama SKPD',
							'name' => 'id_skpd',
							'type' => 'select_skpd',
							'option' => $this->i_m->get_skpd(),
							'data' => $edit ? $raw['id_skpd'] : null
						),
						array(
							'label' => 'Cover',
							'name' => 'cover',
							'type' => 'file',
							'data' => $edit ? $raw['cover'] : null
						),
						array(
							'label' => 'File',
							'name' => 'file',
							'type' => 'file',
							'data' => $edit ? $raw['file'] : null
						)
					);
					break;
			default:
				break;
		}

		$data['edit_data'] = $edit_data;
		$data['type'] = $what;
		$data['act'] = $this->input->post('act');

		$this->load->view('publikasi/p-edit', $data);
	}

	public function delete($what)
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		$id = encrypt_url(false, $raw_data['id']);
		switch ($what) {
			case 'buku':
				$del = $this->db->delete('p_buku', array('id_buku' => $id));
				break;
			case 'infografis':
				$del = $this->db->delete('p_infografis', array('id_infografis' => $id));
				break;
			// ANGGARAN 
			case 'anggaran':
				$del = $this->db->delete('p_anggaran', array('id_anggaran' => $id));
				break;
		}
		if ($del) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui',
			);
		} else {
			$result = array(
				'status' => 'failed',
				'message' => 'Data Gagal Diperbaharui'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function save($what = null)
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		switch ($what) {
			case 'buku':
				$submit = $this->pubm->save($raw_data, 'buku');
				break;
			case 'infografis':
				$submit = $this->pubm->save($raw_data, 'infografis');
				break;
			// ANGGARAN 
			case 'anggaran':
				$submit = $this->pubm->save($raw_data, 'anggaran');
				break;
		}
		if ($submit['success']) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui'
			);
		} else {
			$result = array(
				'status' => 'failed',
				'message' => $submit['msg']
			);
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}

	public function tagar()
	{
		if (!$this->session->admin) redirect(base_url('oops/forbidden'));
		$props = array(
			'cols' => ['#', 'Nama Tagar', 'Deskripsi', 'Status', 'Daftar Data', 'Aksi'],
			'type' => 'tagar',
			'urusan' => $this->pubm->get_tagar()
		);
		$data = array(
			'title' => 'Tagar',
			'li_1' => 'Publikasi',
			'li_2' => 'Tagar',
			'props' => $props
		);
		$this->load->view('publikasi/p-list-tagar', $data);
	}
}
