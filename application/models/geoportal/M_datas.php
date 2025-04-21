<?php

class M_datas extends CI_Model
{

	function build_datatables($params)
	{
		//LOAD DB
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);

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
			$postgre->order_by($order, $dir);
		}

		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($sterm == 'data_value' || $sterm == 'data_year') {
				} else {
					if ($x == 0) {
						$postgre->like($sterm, $search);
					} else {
						$postgre->or_like($sterm, $search);
					}
				}
				$x++;
			}
		}

		//GET DATABASE
		$postgre->limit($length, $start);
		$raw_data = $postgre->get($params['table']);
		$data = array();
		$no = $start + 1;

		//LOOP DATA TO VARIABEL
		foreach ($raw_data->result_array() as $rows) {

			//$checked = ($rows['status'] == '1') ? 'checked' : '';
			$row = [$no++];
			$id = $rows[$params['columns'][0]];
			$encrypted_id = encrypt_url(true, $id);
			foreach ($params['columns'] as $kc => $kv) {
				if ($kc != 0) {
					$row[] = $rows[$kv];
				}
			}

			$data[] = $row;
		}

		//GET TOTAL DATA
		$total_data = $postgre->select("COUNT(*) as num")->get($params['table'])->row()->num;

		//ASSIGN
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_data,
			"recordsFiltered" => $total_data,
			"data" => $data
		);

		//RETURN
		return $output;
	}

	function get_data_ori($params)
	{

		$query = $this->db->query("
					SELECT
					a.id_indikator AS 'data_id',
					a.id_main_indikator AS 'parent_id',
					REPLACE(REPLACE(a.nama_indikator, '\r', ''), '\n', '') AS 'title',
					b.tahun AS 'data_year',
					b.data_angka AS 'data_value'
				FROM indikator a
				LEFT JOIN data b ON a.id_indikator = b.id_indikator
				LEFT JOIN (SELECT * FROM data_verifikasi WHERE status_verifikasi = '1')dv on b.id_verifikasi = dv.id_verifikasi
				WHERE a.id_main_indikator = ?
				ORDER BY a.id_indikator, b.tahun ASC;
				", $params);
		return $query->result_array();
	}


	public function get_indicator_main()
	{
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);
		$query = $postgre->query("SELECT * FROM view_builder");
		return $query->result_array();
	}


	function insert($params)
	{
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);
		return $postgre->insert('view_builder_data', $params);
	}

	// update
	// function update($params, $where)
	// {
	// 	return $this->db->update('indikator_data', $params, $where);
	// }

	// delete
	function delete($params)
	{
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);
		return $postgre->delete('view_builder_data', $params);
	}
}
