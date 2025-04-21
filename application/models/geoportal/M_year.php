<?php

class M_year extends CI_Model
{
	private $postgre = null;
	public function __construct()
	{
		$this->postgre = $this->load->database('geoportal_postgre_db', TRUE);
	}

	public function get_years()
	{
		$sql = "SELECT *, nama_tahun AS data_year
				FROM tbl_tahun 
				ORDER BY nama_tahun ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_datas()
	{
		$sql = "SELECT *
				FROM view_builder_year 
				ORDER BY data_year ASC";
		$query = $this->postgre->query($sql);
		return $query->result_array();
	}

	public function get_indicator_by_id($params)
	{
		$query = "SELECT * FROM view_builder_year a
				WHERE a.data_year = ?";
		$data = $this->postgre->query($query, $params)->row_array();
		return $data;
	}

	function insert($params)
	{
		return $this->postgre->insert('view_builder_year', $params);
	}
}
