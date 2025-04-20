<?php

class M_geoportal extends CI_Model
{
	  private $default = null;
	public function __construct()
    {
        parent::__construct();
        $this->postgre = $this->load->database('geoportal_postgre_db', TRUE);
        $this->default = $this->load->database('default', TRUE);
    }

	public function get_datas()
	{
		$sql = "SELECT *
				FROM data_geoportal 
				ORDER BY title ASC";
		$query = $this->postgre->query($sql);
		return $query->result_array();
	}

	function insert($params)
	{
		return $this->postgre->insert('data_geoportal', $params);
	}

	public function truncate()
	{
		$data = $this->postgre->query("TRUNCATE TABLE data_geoportal");
		return $data;
	}

	public function get_datas_connect($id)
	{
		$sql = "SELECT *
				FROM data_geoportal 
				WHERE pk = ?
				ORDER BY title ASC";
		$query = $this->postgre->query($sql, array($id));
		return $query->result_array();
	}

	public function get_geo_urusan()
	{
		$urusan = $this->db->where('g_status', '1')->order_by('g_nama_urusan', 'asc')->get('tbl_geo_urusan')->result_array();
		foreach ($urusan as $ku => $vu) {
			$urusan[$ku]['key'] = strtolower(replaceee($vu['g_nama_urusan']));

			// $this->db->select('i.g_id_indikator, i.g_nama_indikator');
			$this->db->select('iu.g_id_postgres');
			$this->db->where(['g_id_urusan' => $vu['g_id_urusan']]);
			$this->db->from('g_urusan_indikator iu');
			// $this->db->join('g_indikator i', 'i.g_id_indikator = iu.g_id_indikator');
			// $ind_list = $this->db->order_by('i.g_nama_indikator', 'asc')->get()->result_array();
			$ind_list = $this->db->get()->result_array();
			$urusan[$ku]['list_ind'] = $ind_list;
		}

		return $urusan;
	}

	public function get_geo_urusan_with_titles()
	{
    $urusan = $this->db->where('g_status', '1')->order_by('g_nama_urusan', 'asc')->get('tbl_geo_urusan')->result_array();

    foreach ($urusan as $ku => $vu) {
        $urusan[$ku]['key'] = strtolower(replaceee($vu['g_nama_urusan']));

        $this->db->select('iu.g_id_postgres');
        $this->db->where(['g_id_urusan' => $vu['g_id_urusan']]);
        $this->db->from('g_urusan_indikator iu');
        $ind_list = $this->db->get()->result_array();
		$titles = array(); // Inisialisasi variabel titles di luar loop foreach

        foreach ($ind_list as $ind) {
            $titles[] = $this->get_datas_connect($ind['g_id_postgres']);
        }

        $urusan[$ku]['judul'] = $titles;
		$urusan[$ku]['list_ind'] = $ind_list;

    	}
		return $urusan;
	}
}
