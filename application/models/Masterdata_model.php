<?php

class Masterdata_model extends CI_Model
{
	function build_datatables($params)
	{
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

			$checked = ($rows['status'] == '1') ? 'checked' : '';
			$row = [$no++];
			$id = $rows[$params['columns'][0]];
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
			if ($params['table'] == 'tbl_tahun') {
				$row[] =
					'<div class="mx-auto">
					<div class="form-check form-switch form-switch-lg d-flex justify-content-center" dir="ltr">
						<input type="checkbox" class="form-check-input check-lock-input" data-id="' . $encrypted_id . '" value="1" ' . (($rows['input_lock'] == '1') ? 'checked' : '') . '>
					</div>
				</div>';
			}
			$row[] = [
				// '<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button> ' .
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

	function upstate($params)
	{
		$check_prev_state = $this->db->where($params['id_col'], $params['id'])->get($params['table'])->row_array();
		if ($check_prev_state['status'] == '1') {
			$update = $this->db->where($params['id_col'], $params['id'])->update($params['table'], ['status' => '2']);
		} else {
			$update = $this->db->where($params['id_col'], $params['id'])->update($params['table'], ['status' => '1']);
		}
		
		if ($update) {
			return true;
		} else {
			return false;
		}
		
	}

	function upstate_lock_tahun($params)
	{
		$check_prev_state = $this->db->where($params['id_col'], $params['id'])->get($params['table'])->row_array();
		if ($check_prev_state['input_lock'] == '1') {
			$update = $this->db->where($params['id_col'], $params['id'])->update($params['table'], ['input_lock' => '2']);
		} else {
			$update = $this->db->where($params['id_col'], $params['id'])->update($params['table'], ['input_lock' => '1']);
		}
		
		if ($update) {
			return true;
		} else {
			return false;
		}
		
	}
}
