<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skpd_model extends CI_Model {
    
    private $_table = "tbl_skpd";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all() {
        return $this->db->get($this->_table)->result_array();
    }
    
    public function get_by_id($id) {
        return $this->db->where('id_skpd', $id)->get($this->_table)->row_array();
    }
}