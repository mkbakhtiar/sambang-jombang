<?php

class Notification_model extends CI_Model
{
    public function get_rev()
    {

        $query = "SELECT * FROM v_data_full WHERE status_verifikasi = '2' AND (id_skpd = '22' OR main_id_skpd = '22')";
        $result = $this->db->query($query)->result_array();
        return $result;
    }
}
