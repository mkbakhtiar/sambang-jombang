<?php

class Dash_model extends CI_Model
{
    public function get_last_indikator($id = null)
    {
        $where = ['level' => '1'];
        if ($id != null) {
            $where['id_skpd'] = $id;
        }
        $this->db->limit(20);
        $this->db->order_by('timestamp', 'desc');
        $result = $this->db->where($where)->get('v_indikator')->result_array();
        return $result;
    }
    public function get_last_data($id = null)
    {
        $where = [];
        if ($id != null) {
            $where['id_skpd'] = $id;
        }
        $this->db->limit(30);
        $this->db->order_by('timestamp', 'desc');
        $result = $this->db->where($where)->get('v_data_full')->result_array();
        return $result;
    }

    public function get_progres_penetapan()
    {
        // $this->db->limit(10);
        $this->db->order_by('progres', 'desc');
        $this->db->order_by('konfirmasi_sudah', 'desc');
        $data = $this->db->get('v_indikator_konfirmasi_rekap')->result_array();
        return $data;
    }

    // admin visitors
    public function get_top_data()
	{
		$this->db->select('i.*, c.count');
		$this->db->join('v_indikator i', 'i.id_indikator = c.id_indikator', 'left');
		$this->db->order_by('c.count', 'desc');
		$this->db->order_by('c.timestamp', 'desc');
		$this->db->limit(100);
		$data = $this->db->get('log_visit c')->result_array();
		return $data;
	}

    public function get_log_visitor()
    {
        $query = "SELECT `timestamp`, count(*) AS count FROM log_visitors GROUP BY hour( `timestamp`) , day( `timestamp` )";
        $data = $this->db->query($query)->result_array();
        return $data;
    }

    public function log_visitor_today()
    {
        $this->db->select('h.jam, l.cnt');
        $this->db->from('log_hour h');
        $this->db->join('( SELECT HOUR( `timestamp` ) AS jam, COUNT(*) AS cnt FROM log_visitors WHERE DATE( `timestamp` ) = CURDATE() GROUP BY HOUR( `timestamp` )) l', 'l.jam = h.jam', 'left');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function log_stats()
    {
        
    }
}