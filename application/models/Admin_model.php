<?php

class Admin_model extends CI_Model
{
    
    // public function get_rekap_konfirmasi($id_skpd = null)
    // {
    //     if ($id_skpd != null && $id_skpd != 'all') {
    //         $where = array(
    //             'id_skpd' => $id_skpd
    //         );
    //         $this->db->where($where);
    //         $rest = $this->db->get('v_indikator_konfirmasi_rekap')->row_array();
    //     } elseif ($id_skpd == 'all') {
    //         $rest = $this->db->get('v_indikator_konfirmasi_rekap')->result_array();
    //     } else {
    //         $this->db->select('SUM(vr.konfirmasi_belum) AS konfirmasi_belum, SUM(vr.konfirmasi_sudah) AS konfirmasi_sudah, SUM(vr.konfirmasi_ok) AS konfirmasi_ok, SUM(vr.konfirmasi_not_ok) AS konfirmasi_not_ok');
    //         $rest = $this->db->get('v_indikator_konfirmasi_rekap vr')->row_array();
    //     }
    //     return $rest;
    // }

    public function get_rekap_konfirmasi($id_skpd = null)
{
    $this->db->select('SUM(konfirmasi_belum) AS konfirmasi_belum, SUM(konfirmasi_sudah) AS konfirmasi_sudah, SUM(konfirmasi_ok) AS konfirmasi_ok, SUM(konfirmasi_not_ok) AS konfirmasi_not_ok');

    if ($id_skpd != null && $id_skpd != 'all') {
        $this->db->where('id_skpd', $id_skpd);
        $result = $this->db->get('v_indikator_konfirmasi_rekap')->row_array();
    } elseif ($id_skpd == 'all') {
        $result = $this->db->get('v_indikator_konfirmasi_rekap')->result_array();
    } else {
        $result = $this->db->get('v_indikator_konfirmasi_rekap')->row_array();
    }

    return $result;
}


    
    // public function get_rekap_input($id = null)
    // {
    //     $cnt_tahun = count($this->get_tahun());
    //     $cnt_indikator = count($this->get_all_indikator($id));
    //     $cnt_data = $this->get_count_data($id);

    //     if ($cnt_indikator == 0) {
    //         $zero = true;
    //     } else {
    //         $zero = false;
    //     }

    //     $result['data'] = $cnt_data;
    //     $result['indikator'] = $zero ? 0 : $cnt_indikator;

    //     $result['total'] = $zero ? 0 : number_format(((array_sum($cnt_data) / ($cnt_tahun * $cnt_indikator)) * 100), 2);
    //     $result['detail'] = [];

    //     foreach ($this->get_tahun() as $kt => $vt) {
    //         $result['detail'][$vt['nama_tahun']] = $zero ? 0 : number_format(($cnt_data[$vt['nama_tahun']] / $cnt_indikator * 100), 2);
    //     }

    //     return $result;
    // }

    public function get_rekap_input($id = null)
{
    // Mengambil data tahun sekali dan menyimpannya dalam variabel
    $tahunData = $this->get_tahun();

    // Mengambil data indikator sekali dan menyimpannya dalam variabel
    $indikatorData = $this->get_all_indikator($id);
    $cnt_indikator = count($indikatorData);

    // Mengambil data jumlah per tahun sekali dan menyimpannya dalam variabel
    $cnt_data = $this->get_count_data($id);

    // Menghitung jumlah tahun sekali
    $cnt_tahun = count($tahunData);

    // Memeriksa jika jumlah indikator = 0
    $zero = ($cnt_indikator == 0);

    // Menghitung total
    $total = $zero ? 0 : number_format((array_sum($cnt_data) / ($cnt_tahun * $cnt_indikator)) * 100, 2);

    // Menginisialisasi array result
    $result = [
        'data' => $cnt_data,
        'indikator' => $zero ? 0 : $cnt_indikator,
        'total' => $total,
        'detail' => []
    ];

    // Menghitung detail per tahun
    foreach ($tahunData as $tahun) {
        $detailValue = $zero ? 0 : number_format(($cnt_data[$tahun['nama_tahun']] / $cnt_indikator) * 100, 2);
        $result['detail'][$tahun['nama_tahun']] = $detailValue;
    }

    return $result;
    }

    public function get_rekap_verifikasi($id_skpd = null)
    {
        if ($id_skpd == null) {
            $where = [[], []];
        } else {
            $where = [['id_skpd' => $id_skpd], ['main_id_skpd' => $id_skpd]];
        }
        $tahun = $this->get_tahun('dict');
        $this->db->select("COUNT(*) AS jumlah, COUNT( IF ( `v`.`status_verifikasi` IS NULL, `v`.`id_indikator`, NULL )) AS `verifikasi_belum`, COUNT( IF ( `v`.`status_verifikasi` = '1', `v`.`id_indikator`, NULL )) AS `verifikasi_ok`, COUNT( IF ( `v`.`status_verifikasi` = '2', `v`.`id_indikator`, NULL )) AS `verifikasi_not_ok`");
        $this->db->where($where[0]);
        $this->db->where_in('tahun', $tahun);
        $this->db->or_where($where[1]);
        $raw = $this->db->get('v_data_full v')->row_array();
        // $query = "SELECT COUNT(*) AS jumlah, COUNT( IF ( `v`.`status_verifikasi` IS NULL, `v`.`id_indikator`, NULL )) AS `verifikasi_belum`, COUNT( IF ( `v`.`status_verifikasi` = '1', `v`.`id_indikator`, NULL )) AS `verifikasi_ok`, COUNT( IF ( `v`.`status_verifikasi` = '2', `v`.`id_indikator`, NULL )) AS `verifikasi_not_ok`  FROM v_data_full v";
        // $raw = $this->db->query($query)->row_array();
        return $raw;
    }


    public function get_tahun($type = null)
    {
        $result = $this->db->where('status', '1')->get('tbl_tahun')->result_array();
        if ($type == 'dict') {
            $tmp = [];
            foreach ($result as $kt => $vt) {
                $tmp[] = $vt['nama_tahun'];
            }
            $result = $tmp;
        } elseif ($type == 'input_lock') {
            $tmp = [];
            foreach ($result as $kt => $vt) {
                if ($vt['input_lock'] == '1') {
                    $tmp[] = $vt['nama_tahun'];
                }
            }
            $result = $tmp;
        }

        return $result;
    }

    function get_all_indikator($id_skpd = null)
    {
        if ($id_skpd == null) {
            $where = [[], []];
        } else {
            $where = [['vi.id_skpd' => $id_skpd], ['vii.id_skpd' => $id_skpd]];
        }
        $this->db->select('vi.id_indikator, vi.`level`, IFNULL(vi.id_skpd, vii.id_skpd) AS id_skpd, vi.nama_skpd, vi.nama_indikator, vi.id_konfirmasi, IFNULL(vi.status_konfirmasi, vii.status_konfirmasi) AS status_konfirmasi');
        $this->db->where($where[0]);
        $this->db->or_where($where[1]);
        $this->db->join('v_indikator vii', 'vi.id_main_indikator = vii.id_indikator', 'left');
        $result = $this->db->get('v_indikator vi')->result_array();
        return $result;
    }

    
    function get_count_data($id_skpd)
    {
        // $this->db->cache_on();
        if ($id_skpd == null) {
            $where = [[], []];
        } else {
            $where = [['id_skpd' => $id_skpd], ['main_id_skpd' => $id_skpd]];
        }
        $this->db->select('vd.tahun, vd.id_skpd, vd.main_id_skpd, COUNT(*) AS jumlah');
        $this->db->where($where[0]);
        $this->db->or_where($where[1]);
        $this->db->group_by('tahun');
        $data = $this->db->get('v_data_full vd')->result_array();

        $tahun = $this->get_tahun();
        $result = [];
        foreach ($tahun as $kt => $vt) {
            $result[$vt['nama_tahun']] = 0;
            foreach ($data as $kd => $vd) {
                if ($vd['tahun'] == $vt['nama_tahun']) {
                    $result[$vt['nama_tahun']] = $vd['jumlah'];
                    break;
                }
            }
        }

        return $result;
    }

    // ---------------------------------------------
}

