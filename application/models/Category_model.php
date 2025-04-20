<?php
class Category_Model extends CI_Model
{
    public function getCategories() {
        // Mendapatkan instance dari object CI (CodeIgniter)
        $db = $this->db;
    
        // Query untuk mengambil data kategori
        $query = $db->get('v_indikator');
    
        // Array untuk menyimpan hasil
        $categories = array();
    
        // Memasukkan hasil query ke dalam array
        if ($query->num_rows() > 0) {
            $categories = $query->result_array();
        }
    
        return $categories;
    }
    
}
?>
