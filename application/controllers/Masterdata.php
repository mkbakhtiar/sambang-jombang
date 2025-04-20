<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));
		$this->load->model('Masterdata_model', 'md_model');
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

	public function keluaran()
	{
		$props = array(
			'cols' => ['#', 'Nama Keluaran', 'Keterangan', 'Aksi'],
			'type' => 'keluaran'
		);

		$data = array(
			'title' => 'Keluaran',
			'li_1' => 'Master Data',
			'li_2' => 'Keluaran',
			'props' => $props
		);
		$this->load->view('master-data/md-list', $data);
	}

	public function urusan()
	{
		$props = array(
			'cols' => ['#', 'Nama Urusan', 'Keterangan', 'Aksi'],
			'type' => 'urusan'
		);

		$data = array(
			'title' => 'Urusan',
			'li_1' => 'Master Data',
			'li_2' => 'Urusan',
			'props' => $props
		);
		$this->load->view('master-data/md-list', $data);
	}

	public function satuan()
	{
		$props = array(
			'cols' => ['#', 'Nama Satuan', 'Lambang', 'Keterangan', 'Status', 'Aksi'],
			'type' => 'satuan'
		);

		$data = array(
			'title' => 'Satuan',
			'li_1' => 'Master Data',
			'li_2' => 'Satuan',
			'props' => $props
		);
		$this->load->view('master-data/md-list', $data);
	}

	public function metadata()
	{
		$props = array(
			'cols' => ['#', 'Nama Metadata', 'Keterangan', 'Status', 'Aksi'],
			'type' => 'metadata'
		);

		$data = array(
			'title' => 'Metadata',
			'li_1' => 'Master Data',
			'li_2' => 'Metadata',
			'props' => $props
		);
		$this->load->view('master-data/md-list', $data);
	}

	public function skpd()
	{
		$props = array(
			'cols' => ['#', 'Nama SKPD', 'Alamat', 'No Telp', 'Website', 'Status', 'Aksi'],
			'type' => 'skpd'
		);

		$data = array(
			'title' => 'SKPD',
			'li_1' => 'Master Data',
			'li_2' => 'SKPD',
			'props' => $props
		);
		$this->load->view('master-data/md-list', $data);
	}

	public function tahun()
	{
		$props = array(
			'cols' => ['#', 'Tahun', 'Keterangan', 'Status', 'Lock Input Data', 'Aksi'],
			'type' => 'tahun'
		);

		$data = array(
			'title' => 'Tahun',
			'li_1' => 'Master Data',
			'li_2' => 'Tahun',
			'props' => $props
		);
		$this->load->view('master-data/md-list', $data);
	}

	public function periodik()
	{
		$props = array(
			'cols' => ['#', 'Periodik', 'Keterangan', 'Status', 'Aksi'],
			'type' => 'periodik'
		);

		$data = array(
			'title' => 'Periodik',
			'li_1' => 'Master Data',
			'li_2' => 'Periodik',
			'props' => $props
		);
		$this->load->view('master-data/md-list', $data);
	}

	public function get_data($what = null)
	{
		switch ($what) {
			case 'skpd':
				$params = array(
					'columns' => ['id_skpd', 'nama_skpd', 'alamat', 'no_telp', 'website'],
					'table' => 'tbl_skpd',
				);
				break;
			case 'satuan':
				$params = array(
					'columns' => ['id_satuan', 'nama_satuan', 'lambang', 'keterangan'],
					'table' => 'tbl_satuan',
				);
				break;
			case 'keluaran':
				$params = array(
					'columns' => ['id_keluaran', 'nama_keluaran', 'keterangan'],
					'table' => 'tbl_keluaran',
				);
				break;
			case 'urusan':
				$params = array(
					'columns' => ['id_urusan', 'nama_urusan', 'keterangan'],
					'table' => 'tbl_urusan',
				);
				break;
			case 'metadata':
				$params = array(
					'columns' => ['id_metadata', 'nama_metadata', 'keterangan'],
					'table' => 'tbl_metadata',
				);
				break;
			case 'tahun':
				$params = array(
					'columns' => ['id_tahun', 'nama_tahun', 'keterangan'],
					'table' => 'tbl_tahun',
				);
				break;
			case 'periodik':
				$params = array(
					'columns' => ['id_periodik', 'nama_periodik', 'keterangan'],
					'table' => 'tbl_periodik',
				);
				break;
			case 'tagar':
				$params = array(
					'columns' => ['id_tagar', 'nama_tagar', 'keterangan'],
					'table' => 'tbl_tagar',
				);
				break;

			default:
				# code...
				break;
		}

		$result = $this->md_model->build_datatables($params);
		echo json_encode($result);
		exit();
	}

	public function get_detail($what = null)
	{
		switch ($what) {
			case 'skpd':
				$id = encrypt_url(false, $this->input->post('id'));
				$raw = $this->db->where('id_skpd', $id)->get('tbl_skpd')->row_array();
				$result = array(
					'Nama SKPD' => $raw['nama_skpd'],
					'Alamat' => $raw['alamat'],
					'No Telp' => $raw['no_telp'],
					'Website' => $raw['website']
				);
				header('Content-Type: application/json');
				echo json_encode($result);
				break;

			case 'cs':
				break;

			default:
				# code...
				break;
		}
	}

	public function edit($what = null)
	{
		$id = encrypt_url(false, $this->input->post('id'));
		switch ($what) {
			case 'skpd':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_skpd', $id)->get('tbl_skpd')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID SKPD',
						'name' => 'id_skpd',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Nama SKPD',
						'name' => 'nama_skpd',
						'type' => 'text',
						'data' => $edit ? $raw['nama_skpd'] : null
					),
					array(
						'label' => 'Alamat',
						'name' => 'alamat',
						'type' => 'text',
						'data' => $edit ? $raw['alamat'] : null
					),
					array(
						'label' => 'No Telpon',
						'name' => 'no_telp',
						'type' => 'number',
						'data' => $edit ? $raw['no_telp'] : null
					),
					array(
						'label' => 'Website',
						'name' => 'website',
						'type' => 'text',
						'data' => $edit ? $raw['website'] : null
					)
				);
				break;

			case 'satuan':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_satuan', $id)->get('tbl_satuan')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID Satuan',
						'name' => 'id_satuan',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Nama Satuan',
						'name' => 'nama_satuan',
						'type' => 'text',
						'data' => $edit ? $raw['nama_satuan'] : null
					),
					array(
						'label' => 'Lambang',
						'name' => 'lambang',
						'type' => 'text',
						'data' => $edit ? $raw['lambang'] : null
					),
					array(
						'label' => 'Keterangan',
						'name' => 'keterangan',
						'type' => 'text',
						'data' => $edit ? $raw['keterangan'] : null
					)
				);
				break;

			case 'keluaran':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_keluaran', $id)->get('tbl_keluaran')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID Keluaran',
						'name' => 'id_keluaran',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Nama Keluaran',
						'name' => 'nama_keluaran',
						'type' => 'text',
						'data' => $edit ? $raw['nama_keluaran'] : null
					),
					array(
						'label' => 'Keterangan',
						'name' => 'keterangan',
						'type' => 'text',
						'data' => $edit ? $raw['keterangan'] : null
					)
				);
				break;

			case 'urusan':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_urusan', $id)->get('tbl_urusan')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID Urusan',
						'name' => 'id_urusan',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Nama Urusan',
						'name' => 'nama_urusan',
						'type' => 'text',
						'data' => $edit ? $raw['nama_urusan'] : null
					),
					array(
						'label' => 'Keterangan',
						'name' => 'keterangan',
						'type' => 'text',
						'data' => $edit ? $raw['keterangan'] : null
					)
				);
				break;

			case 'metadata':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_metadata', $id)->get('tbl_metadata')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID Metadata',
						'name' => 'id_metadata',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Nama Metadata',
						'name' => 'nama_metadata',
						'type' => 'text',
						'data' => $edit ? $raw['nama_metadata'] : null
					),
					array(
						'label' => 'Key Metadata',
						'name' => 'key_metadata',
						'type' => 'text',
						'data' => $edit ? $raw['key_metadata'] : null
					),
					array(
						'label' => 'Keterangan',
						'name' => 'keterangan',
						'type' => 'text',
						'data' => $edit ? $raw['keterangan'] : null
					)
				);
				break;

			case 'tahun':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_tahun', $id)->get('tbl_tahun')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID Tahun',
						'name' => 'id_tahun',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Tahun',
						'name' => 'nama_tahun',
						'type' => 'text',
						'data' => $edit ? $raw['nama_tahun'] : null
					),
					array(
						'label' => 'Keterangan',
						'name' => 'keterangan',
						'type' => 'text',
						'data' => $edit ? $raw['keterangan'] : null
					)
				);
				break;

			case 'periodik':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_periodik', $id)->get('tbl_periodik')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID Periodik',
						'name' => 'id_periodik',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Periodik',
						'name' => 'nama_periodik',
						'type' => 'text',
						'data' => $edit ? $raw['nama_periodik'] : null
					),
					array(
						'label' => 'Keterangan',
						'name' => 'keterangan',
						'type' => 'text',
						'data' => $edit ? $raw['keterangan'] : null
					)
				);
				break;

			case 'tagar':
				$edit = $this->input->post('act') == 'edit' ? true : false;
				$raw = $this->db->where('id_tagar', $id)->get('tbl_tagar')->row_array();

				$edit_data = array(
					array(
						'label' => 'ID Tagar',
						'name' => 'id_tagar',
						'type' => 'hidden',
						'data' => $edit ? $this->input->post('id') : null
					),
					array(
						'label' => 'Nama Tagar',
						'name' => 'nama_tagar',
						'type' => 'text',
						'data' => $edit ? $raw['nama_tagar'] : null
					),
					array(
						'label' => 'Keterangan',
						'name' => 'keterangan',
						'type' => 'text',
						'data' => $edit ? $raw['keterangan'] : null
					)
				);
				break;

			default:
				break;
		}

		$data['edit_data'] = $edit_data;
		$data['type'] = $what;
		$data['act'] = $this->input->post('act');

		$this->load->view('master-data/md-edit', $data);
	}

	public function submit($what = null)
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		switch ($what) {
			case 'skpd':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_skpd'] = encrypt_url(false, $raw_data['id_skpd']);
					$update_data = $raw_data;
					unset($update_data['id_skpd']);
					unset($update_data['act']);
					$this->db->where('id_skpd', $raw_data['id_skpd']);
					$submit = $this->db->update('tbl_skpd', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_skpd', $add_data);
				}
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
				break;

			case 'satuan':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_satuan'] = encrypt_url(false, $raw_data['id_satuan']);
					$update_data = $raw_data;
					unset($update_data['id_satuan']);
					unset($update_data['act']);
					$this->db->where('id_satuan', $raw_data['id_satuan']);
					$submit = $this->db->update('tbl_satuan', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_satuan', $add_data);
				}
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
				break;

			case 'keluaran':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_keluaran'] = encrypt_url(false, $raw_data['id_keluaran']);
					$update_data = $raw_data;
					unset($update_data['id_keluaran']);
					unset($update_data['act']);
					$this->db->where('id_keluaran', $raw_data['id_keluaran']);
					$submit = $this->db->update('tbl_keluaran', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_keluaran', $add_data);
				}
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
				break;

			case 'urusan':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_urusan'] = encrypt_url(false, $raw_data['id_urusan']);
					$update_data = $raw_data;
					unset($update_data['id_urusan']);
					unset($update_data['act']);
					$this->db->where('id_urusan', $raw_data['id_urusan']);
					$submit = $this->db->update('tbl_urusan', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_urusan', $add_data);
				}
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
				break;
			case 'metadata':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_metadata'] = encrypt_url(false, $raw_data['id_metadata']);
					$update_data = $raw_data;
					unset($update_data['id_metadata']);
					unset($update_data['act']);
					$this->db->where('id_metadata', $raw_data['id_metadata']);
					$submit = $this->db->update('tbl_metadata', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_metadata', $add_data);
				}
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
				break;

			case 'tahun':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_tahun'] = encrypt_url(false, $raw_data['id_tahun']);
					$update_data = $raw_data;
					unset($update_data['id_tahun']);
					unset($update_data['act']);
					$this->db->where('id_tahun', $raw_data['id_tahun']);
					$submit = $this->db->update('tbl_tahun', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_tahun', $add_data);
				}
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
				break;

			case 'periodik':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_periodik'] = encrypt_url(false, $raw_data['id_periodik']);
					$update_data = $raw_data;
					unset($update_data['id_periodik']);
					unset($update_data['act']);
					$this->db->where('id_periodik', $raw_data['id_periodik']);
					$submit = $this->db->update('tbl_periodik', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_periodik', $add_data);
				}
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
				break;
			case 'tagar':
				if ($raw_data['act'] == 'edit') {
					$raw_data['id_tagar'] = encrypt_url(false, $raw_data['id_tagar']);
					$update_data = $raw_data;
					unset($update_data['id_tagar']);
					unset($update_data['act']);
					$this->db->where('id_tagar', $raw_data['id_tagar']);
					$submit = $this->db->update('tbl_tagar', $update_data);
				} elseif ($raw_data['act'] == 'add') {
					$add_data = $raw_data;
					unset($add_data['act']);
					$submit = $this->db->insert('tbl_tagar', $add_data);
				}
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
				break;
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}

	public function delete($what)
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		$id = encrypt_url(false, $raw_data['id']);
		switch ($what) {
			case 'skpd':
				$del = $this->db->delete('tbl_skpd', array('id_skpd' => $id));
				break;
			case 'satuan':
				$del = $this->db->delete('tbl_satuan', array('id_satuan' => $id));
				break;
			case 'urusan':
				$del = $this->db->delete('tbl_urusan', array('id_urusan' => $id));
				break;
			case 'keluaran':
				$del = $this->db->delete('tbl_keluaran', array('id_keluaran' => $id));
				break;
			case 'tahun':
				$del = $this->db->delete('tbl_tahun', array('id_tahun' => $id));
				break;
			case 'metadata':
				$del = $this->db->delete('tbl_metadata', array('id_metadata' => $id));
				break;
			case 'periodik':
				$del = $this->db->delete('tbl_periodik', array('id_periodik' => $id));
				break;
			case 'tagar':
				$del = $this->db->delete('tbl_tagar', array('id_tagar' => $id));
				break;
		}
		if ($del) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui',
				'data' => $raw_data
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

	public function upstate($what)
	{
		$raw_data = $this->security->xss_clean($this->input->post());
		$id = encrypt_url(false, $raw_data['id']);
		switch ($what) {
			case 'skpd':
				$upstate = $this->md_model->upstate(['id_col' => 'id_skpd', 'id' => $id, 'table' => 'tbl_skpd']);
				break;
			case 'satuan':
				$upstate = $this->md_model->upstate(['id_col' => 'id_satuan', 'id' => $id, 'table' => 'tbl_satuan']);
				break;
			case 'urusan':
				$upstate = $this->md_model->upstate(['id_col' => 'id_urusan', 'id' => $id, 'table' => 'tbl_urusan']);
				break;
			case 'keluaran':
				$upstate = $this->md_model->upstate(['id_col' => 'id_keluaran', 'id' => $id, 'table' => 'tbl_keluaran']);
				break;
			case 'tahun':
				$upstate = $this->md_model->upstate(['id_col' => 'id_tahun', 'id' => $id, 'table' => 'tbl_tahun']);
				break;
			case 'metadata':
				$upstate = $this->md_model->upstate(['id_col' => 'id_metadata', 'id' => $id, 'table' => 'tbl_metadata']);
				break;
			case 'periodik':
				$upstate = $this->md_model->upstate(['id_col' => 'id_periodik', 'id' => $id, 'table' => 'tbl_periodik']);
				break;
			case 'lock_input':
				$upstate = $this->md_model->upstate_lock_tahun(['id_col' => 'id_tahun', 'id' => $id, 'table' => 'tbl_tahun']);
				break;
			case 'tagar':
				$upstate = $this->md_model->upstate(['id_col' => 'id_tagar', 'id' => $id, 'table' => 'tbl_tagar']);
				break;
		}
		if ($upstate) {
			$result = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diperbaharui',
				'data' => $raw_data
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
}
