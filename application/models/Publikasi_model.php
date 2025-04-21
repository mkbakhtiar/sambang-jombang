<?php

class Publikasi_model extends CI_Model
{
	public function get_urusan()
	{
		$raw = $this->db->get('tbl_urusan')->result_array();
		return $raw;
	}


	public function get_keluaran()
	{
		$raw = $this->db->get('tbl_keluaran')->result_array();
		return $raw;
	}

	public function get_indikator_list()
	{
		$this->db->where('status_konfirmasi', '1');
		$data = $this->db->get('v_indikator')->result_array();
		return $data;
	}

	public function get_rekap_publikasi($id = null)
	{
		$where = ['status' => '1'];
		if ($id != null) {
			$where['id_skpd'] = $id;
		}
		$cnt_buku = $this->db->where($where)->from('p_buku')->count_all_results();
		$cnt_infografis = $this->db->where($where)->from('p_infografis')->count_all_results();

		$result = array(
			'jumlah_buku' => $cnt_buku,
			'jumlah_infografis' => $cnt_infografis,
			'total' => $cnt_buku + $cnt_infografis
		);

		return $result;
	}

	public function get_selected($type, $id)
	{
		if ($id != null) {
			switch ($type) {
				case 'urusan':
					$this->db->where('id_urusan', $id);
					$raw = $this->db->get('urusan_indikator')->result_array();
					$data = [];
					foreach ($raw as $kr => $vr) {
						$data[] = $vr['id_indikator'];
					}
					return $data;

				case 'keluaran':
					$this->db->where('id_keluaran', $id);
					$raw = $this->db->get('keluaran_indikator')->result_array();
					$data = [];
					foreach ($raw as $kr => $vr) {
						$data[] = $vr['id_indikator'];
					}
					return $data;

				case 'tagar':
					$this->db->where('id_tagar', $id);
					$raw = $this->db->get('tagar_indikator')->result_array();
					$data = [];
					foreach ($raw as $kr => $vr) {
						$data[] = $vr['id_ind'];
					}
					return $data;
	
				default:
					break;
			}
		}
	}

	public function set_selected($type, $data)
	{
		switch ($type) {
			case 'urusan':
				$id = encrypt_url(false, $data['id']);
				$preselected = $this->get_selected('urusan', $id);
				$newselected = [];
				$tresult = [];
				foreach ($data['selected'] as $ks => $vs) {
					$tid = encrypt_url(false, $vs);
					$newselected[] = $tid;
					if (!in_array($tid, $preselected)) {
						$input = $this->db->insert('urusan_indikator', array('id_urusan' => $id, 'id_indikator' => $tid));
						if ($input) {
							$tresult[] = array('id' => $vs, 'status' => 'inserted');
						} else {
							$tresult[] = array('id' => $vs, 'status' => 'failed');
						}
					}
				}

				foreach ($preselected as $kp => $vp) {
					if (!in_array($vp, $newselected)) {
						$delete = $this->db->where(array('id_urusan' => $id, 'id_indikator' => $vp))->delete('urusan_indikator');
						if ($delete) {
							$tresult[] = array('id' => $vs, 'status' => 'deleted');
						} else {
							$tresult[] = array('id' => $vs, 'status' => 'failed');
						}
					}
				}
				$result = array(
					'status' => 'success',
					'message' => 'Berhasil',
					'data' => $tresult
				);

				return $result;
				break;

			case 'keluaran':
				$id = encrypt_url(false, $data['id']);
				$preselected = $this->get_selected('keluaran', $id);
				$newselected = [];
				$tresult = [];
				foreach ($data['selected'] as $ks => $vs) {
					$tid = encrypt_url(false, $vs);
					$newselected[] = $tid;
					if (!in_array($tid, $preselected)) {
						$input = $this->db->insert('keluaran_indikator', array('id_keluaran' => $id, 'id_indikator' => $tid));
						if ($input) {
							$tresult[] = array('id' => $vs, 'status' => 'inserted');
						} else {
							$tresult[] = array('id' => $vs, 'status' => 'failed');
						}
					}
				}

				foreach ($preselected as $kp => $vp) {
					if (!in_array($vp, $newselected)) {
						$delete = $this->db->where(array('id_keluaran' => $id, 'id_indikator' => $vp))->delete('keluaran_indikator');
						if ($delete) {
							$tresult[] = array('id' => $vs, 'status' => 'deleted');
						} else {
							$tresult[] = array('id' => $vs, 'status' => 'failed');
						}
					}
				}
				$result = array(
					'status' => 'success',
					'message' => 'Berhasil',
					'data' => $tresult
				);

				return $result;
				break;

			case 'tagar':
				$id = encrypt_url(false, $data['id']);
				$preselected = $this->get_selected('tagar', $id);
				$newselected = [];
				$tresult = [];
				foreach ($data['selected'] as $ks => $vs) {
					$tid = encrypt_url(false, $vs);
					$newselected[] = $tid;
					if (!in_array($tid, $preselected)) {
						$input = $this->db->insert('tagar_indikator', array('id_tagar' => $id, 'id_ind' => $tid));
						if ($input) {
							$tresult[] = array('id' => $vs, 'status' => 'inserted');
						} else {
							$tresult[] = array('id' => $vs, 'status' => 'failed');
						}
					}
				}

				foreach ($preselected as $kp => $vp) {
					if (!in_array($vp, $newselected)) {
						$delete = $this->db->where(array('id_tagar' => $id, 'id_ind' => $vp))->delete('tagar_indikator');
						if ($delete) {
							$tresult[] = array('id' => $vs, 'status' => 'deleted');
						} else {
							$tresult[] = array('id' => $vs, 'status' => 'failed');
						}
					}
				}
				$result = array(
					'status' => 'success',
					'message' => 'Berhasil',
					'data' => $tresult
				);

				return $result;
				break;

			default:
				# code...
				break;
		}
	}

	function build_publikasi_datatables($params)
	{
		$where = [];
		if ($this->session->detail['id_role'] == '3') {
			$where = ['t.id_skpd' => $this->session->detail['id_skpd']];
		}
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}
		$valid_columns = $params['columns'];
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		}

		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->db->like($sterm, $search);
				} else {
					$this->db->or_like($sterm, $search);
				}
				$x++;
			}
		}
		$this->db->limit($length, $start);
		$this->db->select('t.*, s.nama_skpd, f.filename AS en_file, f.original_filename AS file_name, fc.filename AS en_cover, fc.original_filename AS cover_name');
		$this->db->where($where);
		$this->db->join('tbl_skpd s', 's.id_skpd = t.id_skpd', 'left');
		$this->db->join('files f', 'f.id_file = t.file', 'left');
		$this->db->join('files fc', 'fc.id_file = t.cover', 'left');
		$raw_data = $this->db->get($params['table'] . ' t');
		$data = array();
		$no = $start + 1;
		foreach ($raw_data->result_array() as $rows) {
			$row = [$no++];
			$id = $rows[$params['columns'][0]];
			$encrypted_id = encrypt_url(true, $id);
			$row[] = $rows['judul'];
			$row[] = $rows['deskripsi'];
			$row[] = $rows['nama_skpd'];

			$row[] = '<a href="' . base_url('assets/upload/' . $rows['en_cover']) . '">' . $rows['cover_name'] . '</a>';
    
    		$row[] = '<a href="' . base_url('assets/upload/' . $rows['en_file']) . '">' . $rows['file_name'] . '</a>';

			$row[] = [
				'<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button> ' .
					'<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> ' .
					'<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash-alt"></i></button>'
			];
			$data[] = $row;
		}
		$total_data = $this->db->select("COUNT(*) as num")->get($params['table'])->row()->num;
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_data,
			"recordsFiltered" => $total_data,
			"data" => $data
		);
		return $output;
		// exit();
	}
	// $row[] = '<a href="' . base_url('assets/upload/' . $rows['data_file']) . '">' . $rows['data_file'] . '</a>';

	function save($data, $type)
	{
		if ($_FILES['cover']['name'] != '') {
			$config['upload_path'] = './assets/upload';
			$config['allowed_types'] = 'jpg|png|jpeg|bmp';
			$config['file_name'] = encrypt_url(true, $_FILES['cover']['name']);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('cover')) {
				$msg = $this->upload->display_errors();
				return array(
					'success' => false,
					'msg' => 'cover_error ' . $msg
				);
			} else {
				$file = $this->upload->data();
				$msg = 'file upload success';
				$save_file = $this->save_file_info(['filename' => $file['file_name'], 'original_filename' => $_FILES['cover']['name']]);
				if ($save_file['success']) {
					$input_data['cover'] = $save_file['id_file'];
				};
			}
		} else {
			return array(
				'success' => false,
				'msg' => 'cover_error not set'
			);
		}

		if ($_FILES['file']['name'] != '') {
			$config['upload_path'] = './assets/upload';
			$config['allowed_types'] = 'pdf';
			$config['file_name'] = encrypt_url(true, $_FILES['file']['name']);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')) {
				$msg = $this->upload->display_errors();
				return array(
					'success' => false,
					'msg' => 'file_error ' . $msg
				);
			} else {
				$file = $this->upload->data();
				$msg = 'file upload success';
				$save_file = $this->save_file_info(['filename' => $file['file_name'], 'original_filename' => $_FILES['file']['name']]);
				if ($save_file['success']) {
					$input_data['file'] = $save_file['id_file'];
				};
			}
		} else {
			return array(
				'success' => false,
				'msg' => 'file_error not set'
			);
		}

		if ($data['act'] == 'edit') {
			$data['id_' . $type] = encrypt_url(false, $data['id_' . $type]);
			$update_data = $data;
			if (!$this->session->admin) {
				$update_data['id_skpd'] = $this->session->detail['id_skpd'];
			}
			unset($update_data['id_' . $type]);
			unset($update_data['act']);
			$update_data['cover'] = $input_data['cover'];
			$update_data['file'] = $input_data['file'];
			$this->db->where('id_' . $type, $data['id_' . $type]);
			$submit = $this->db->update('p_' . $type, $update_data);
		} elseif ($data['act'] == 'add') {
			$insert_data = $data;
			if (!$this->session->admin) {
				$insert_data['id_skpd'] = $this->session->detail['id_skpd'];
			}
			$insert_data['cover'] = $input_data['cover'];
			$insert_data['file'] = $input_data['file'];
			unset($insert_data['act']);
			$submit = $this->db->insert('p_' . $type, $insert_data);
		}

		if ($submit) {
			return array(
				'success' => true,
				'msg' => 'success'
			);
		} else {
			return array(
				'success' => false,
				'msg' => 'check type and size'
			);
		}
	}

	function save_file_info($data)
	{
		$insert_files = array(
			'filename' => $data['filename'],
			'original_filename' => $data['original_filename']
		);
		$insert = $this->db->insert('files', $insert_files);
		$insert_id = $this->db->insert_id();
		if ($insert) {
			return array(
				'success' => true,
				'id_file' => $insert_id
			);
		} else {
			return array(
				'success' => false,
				'id_file' => '12334'
			);
		}
	}

	function build_publikasi_datatables_uk($params)
	{
		$where = [];
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}
		$valid_columns = $params['columns'];
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		}

		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->db->like($sterm, $search);
				} else {
					$this->db->or_like($sterm, $search);
				}
				$x++;
			}
		}
		$this->db->limit($length, $start);
		$raw_data = $this->db->get($params['table']);
		$data = array();
		$no = $start + 1;
		foreach ($raw_data->result_array() as $rows) {
			$row = [$no++];
			$checked = ($rows['status'] == '1') ? 'checked' : '';
			$id = $rows[$params['columns'][0]];
			$cnt = $this->count_list($params['type'], $id);
			$encrypted_id = encrypt_url(true, $id);
			foreach ($params['columns'] as $kc => $kv) {
				if ($kc != 0) {
					$row[] = $rows[$kv];
				}
			}
			$row[] =
				'<div class="mx-auto">
					<div class="form-check form-switch form-switch-lg d-flex justify-content-center" dir="ltr">
						<input type="checkbox" class="form-check-input check-status" data-id="' . $encrypted_id . '" value="1" ' . $checked . '>
					</div>
				</div>';
			$row[] = [
                '<button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light btn-count" data-id="' . $encrypted_id . '" ' . ($cnt == '0' ? 'disabled' : '') . '>' . $cnt . '</button>'
            ];
			$row[] = [
				'<button class="btn btn-sm btn-info btn-c-data" data-id="' . $encrypted_id . '" type="button">Pilih Data</button> '.
				'<button class="btn btn-sm btn-success btn-s-data" data-id="' . $encrypted_id . '" type="button">Lihat Data</button> '.
				'<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" type="button">Edit</button> '.
				'<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" type="button">Delete</button> '
				// '<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button> ' .
				// 	'<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> ' .
				// 	'<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash-alt"></i></button>'
			];
			$data[] = $row;
		}
		$total_data = $this->db->select("COUNT(*) as num")->get($params['table'])->row()->num;
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_data,
			"recordsFiltered" => $total_data,
			"data" => $data
		);
		return $output;
		// exit();
	}

	function count_list($type, $id)
	{
		switch ($type) {
			case 'urusan':
				$cnt = $this->db->select('COUNT(*) AS cnt')->where('id_urusan', $id)->get('urusan_indikator')->row_array()['cnt'];
				break;

			case 'keluaran':
				$cnt = $this->db->select('COUNT(*) AS cnt')->where('id_keluaran', $id)->get('keluaran_indikator')->row_array()['cnt'];
				break;
			
			case 'tagar':
				$cnt = $this->db->select('COUNT(*) AS cnt')->where('id_tagar', $id)->get('tagar_indikator')->row_array()['cnt'];
				break;
			
			default:
				# code...
				break;
		}

		return $cnt;
	}
	
	public function get_tagar()
	{
		$raw = $this->db->get('tbl_tagar')->result_array();
		return $raw;
	}
}
