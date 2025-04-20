<?php

class M_indicators extends CI_Model
{
	private $postgre = null;
	public function __construct()
	{
		$this->postgre = $this->load->database('geoportal_postgre_db', TRUE);
	}

	function build_datatables($params)
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		// $search = $search['value'];
		if (!empty($search)) {
			$search = $search['value'];
		}
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
			$this->postgre->order_by($order, $dir);
		}

		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($sterm == 'view_id') {
				} else {
					if ($x == 0) {
						$this->postgre->like($sterm, $search);
					} else {
						$this->postgre->or_like($sterm, $search);
					}
				}
				$x++;
			}
		}

		//GET DATABASE
		// $postgre->limit($length, $start);
		$raw_data = $this->postgre->get($params['table']);
		$result = $raw_data->result_array();
		$data = array();
		$no = $start + 1;

		//LOOP DATA TO VARIABEL
		foreach ($result as $rows) {

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
		$total_data = $this->postgre->select("COUNT(*) as num")->get($params['table'])->row()->num;

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

	public function get_indicator_pg()
	{
		$sql = "SELECT * FROM view_builder a";

		// $sql = "SELECT
		// 			a.view_id, a.data_id, a.data_name, a.view_label, a.area_type,
		// 			COUNT(b.data_id) AS tot_view, COUNT(c.data_id) AS tot_data
		// 		FROM view_builder a
		// 		LEFT JOIN view_builder_history b on a.data_id = b.data_id
		// 		LEFT JOIN view_builder_data c on a.data_id = c.parent_id
		// 		GROUP BY a.data_id, a.view_id";
		$query = $this->postgre->query($sql);
		return $query->result_array();
	}
	public function get_indicator_main()
	{
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);
		$query = $postgre->query("SELECT * FROM view_builder");
		return $query->result_array();
	}

	public function get_indicator_main_by_id($params)
	{
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);
		$query = "SELECT * FROM view_builder WHERE data_id = ?";
		$data = $postgre->query($query, $params)->row_array();
		return $data;
	}

	public function get_indicator()
	{
		$query = "SELECT
		a.id_indikator, a.nama_indikator, ts.nama_skpd
		FROM indikator a
		LEFT JOIN tbl_skpd ts on a.id_skpd = ts.id_skpd
		WHERE a.level = '1'";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function get_indicator_by_id($params)
	{
		$query = "SELECT
			a.id_indikator, a.nama_indikator, ts.nama_skpd
			FROM indikator a
			LEFT JOIN tbl_skpd ts on a.id_skpd = ts.id_skpd
			WHERE a.level = '1'
			AND a.id_indikator = ?";
		$data = $this->db->query($query, $params)->row_array();
		return $data;
	}


	function insert($params)
	{
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);
		return $postgre->insert('view_builder', $params);
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
