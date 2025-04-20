<?php

class M_views extends CI_Model
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
		$search = $search['value'];
		$search = 'a';
		$col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		//SORTING
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

		//SEARCH
		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->postgre->like($sterm, $search, false);
				} else {
					$this->postgre->or_like($sterm, $search, false);
				}
				$x++;
			}
		}
		$this->postgre->limit($length, $start);


		// $sql = "
		// 			SELECT a.history_id::varchar,
		// 			b.data_id,
		// 			a.data_year::varchar,
		// 			b.data_name,
		// 			a.view_label
		// 			FROM view_builder_history a
		// 			LEFT JOIN view_builder b ON a.data_id = b.data_id
		// 			ORDER BY data_name, data_year

		// 	";
		// $raw_data = $this->postgre->get($sql);

		//print_r($this->postgre);
		// $raw_data = $this->postgre->get($params['table']);


		$this->postgre->select('history_id::text, view_builder.data_id');
		$this->postgre->from('view_builder_history');
		$this->postgre->join('view_builder', 'view_builder_history.data_id = view_builder.data_id');
		$raw_data = $this->postgre->get();

		//print_r($raw_data->result_array());
		$data = array();
		$no = $start + 1;
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
			// $row[] =
			// 	'<div class="mx-auto">
			// 	<div class="form-check form-switch form-switch-lg d-flex justify-content-center" dir="ltr">
			// 		<input type="checkbox" class="form-check-input check-status" data-id="' . $encrypted_id . '" value="1" ' . $checked . '>
			// 	</div>
			// </div>';
			// if ($params['table'] == 'tbl_tahun') {
			// 	$row[] =
			// 		'<div class="mx-auto">
			// 		<div class="form-check form-switch form-switch-lg d-flex justify-content-center" dir="ltr">
			// 			<input type="checkbox" class="form-check-input check-lock-input" data-id="' . $encrypted_id . '" value="1" ' . (($rows['input_lock'] == '1') ? 'checked' : '') . '>
			// 		</div>
			// 	</div>';
			// }
			$row[] = [
				// '<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button> ' .
				'<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> ' .
					'<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash-alt"></i></button>'
			];
			$data[] = $row;
		}

		$sql = "SELECT COUNT(*) as num FROM 
			(
				SELECT a.history_id::varchar,
				b.data_id,
				a.data_year::varchar,
				b.data_name,
				a.view_label
				FROM view_builder_history a
				LEFT JOIN view_builder b ON a.data_id = b.data_id
				ORDER BY data_name, data_year
			)x
		";

		$total_data = $this->postgre->query($sql)->row()->num;
		//$total_data = 100;
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_data,
			"recordsFiltered" => $total_data,
			"data" => $data
		);
		return $output;
		// exit();
	}


	function insert($params)
	{
		return $this->postgre->insert('view_builder_history', $params);
	}

	// delete
	function delete($params)
	{
		$postgre = $this->load->database('geoportal_postgre_db', TRUE);
		return $postgre->delete('view_builder_data', $params);
	}

	public function get_datas()
	{
		$sql = "SELECT
				a.history_id, b.data_id, a.data_year, b.data_name, a.view_label
				FROM view_builder_history a
				LEFT JOIN view_builder b ON a.data_id = b.data_id
				ORDER BY data_name, data_year ASC";
		$query = $this->postgre->query($sql);
		return $query->result_array();
	}

	public function get_indicator_by_params($params)
	{
		$query = "SELECT * 
					FROM view_builder_history a
					WHERE 
					a.data_id = ?
					AND a.data_year  = ?";
		$data = $this->postgre->query($query, $params)->row_array();
		return $data;
	}

	public function create($query)
	{
		$data = $this->postgre->query($query);
		return $data;
	}
}
