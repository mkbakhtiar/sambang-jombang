<?php

class Indikator_model extends CI_Model
{
    public function get_metadata_cols()
    {
        $result = $this->db->where('status', '1')->get('tbl_metadata')->result_array();
        return $result;
    }
    public function get_satuan()
    {
        $result = $this->db->where('status', '1')->get('tbl_satuan')->result_array();
        return $result;
    }
    public function get_periodik()
    {
        $result = $this->db->where('status', '1')->get('tbl_periodik')->result_array();
        return $result;
    }
    public function get_skpd()
    {
        $result = $this->db->where('status', '1')->get('tbl_skpd')->result_array();
        return $result;
    }
    public function get_akses()
    {
        $result = $this->db->where('status', '1')->get('tbl_akses')->result_array();
        return $result;
    }
    public function get_tagar_list()
    {
        $results = $this->db->where('status', '1')->get('tbl_tagar')->result_array();
        return $results;
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
    public function get_urusan($id = null)
    {
        $result = $this->db->where('status', '1')->get('tbl_urusan')->result_array();
        return $result;
    }
    public function get_keluaran()
    {
        $result = $this->db->where('status', '1')->get('tbl_keluaran')->result_array();
        return $result;
    }

    public function get_indikator_list($id_skpd = null, $id_tagar = null)
    {
        $where = ['status_konfirmasi' => '1'];
        if ($id_skpd != null) {
            $where['id_skpd'] = $id_skpd;
        }
        if ($id_tagar != null) {
            // Jika id_tagar tidak null, tambahkan kondisi where untuk id_tagar
            $this->db->join('tagar_indikator viii', 'v_indikator.id_indikator = viii.id_ind', 'right');
            $this->db->where('viii.id_tagar', $id_tagar);
        } else {
            $this->db->where($where);
        }
        $data = $this->db->get('v_indikator')->result_array();
        return $data;
    }

    function get_all_indikator($id_skpd = null, $id_tagar = null)
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

        if ($id_tagar != null) {
            // Jika id_tagar tidak null, tambahkan kondisi where untuk id_tagar
            $this->db->join('tagar_indikator viii', 'vi.id_indikator = viii.id_ind', 'right');
            // $this->db->where('vii.id_indikator', 141);
        }

        $result = $this->db->get('v_indikator vi')->result_array();
        return $result;
    }


    function get_count_data($id_skpd, $id_tagar)
    {
        // $this->db->cache_on();
        if ($id_skpd == null) {
            $where = [[], []];
        } else {
            $where = [['id_skpd' => $id_skpd], ['main_id_skpd' => $id_skpd]];
        }

        $this->db->select('vd.tahun, vd.id_skpd, vd.main_id_skpd, COUNT(*) AS jumlah');

        $this->db->group_by('tahun');
        if ($id_tagar != null) {
            // Jika id_tagar tidak null, tambahkan kondisi where untuk id_tagar
            $this->db->join('tagar_indikator viii', 'vd.id_indikator = viii.id_ind', 'right');
            $this->db->where('viii.id_tagar', $id_tagar);

            $this->db->where($where[0]);
            $this->db->or_where($where[1]);
        } else {
            $this->db->where($where[0]);
            $this->db->or_where($where[1]);
        }
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

        // var_dump($result);
    }

    function get_count_data_ver($id_skpd)
    {
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

    public function get_selected($type, $id, $detail = false)
    {
        if ($id != null) {
            switch ($type) {
                case 'urusan':
                    $this->db->select('u.id_ur_in, u.id_urusan, tu.nama_urusan, tu.keterangan');
                    $this->db->where('u.id_indikator', $id);
                    $this->db->join('tbl_urusan tu', 'tu.id_urusan = u.id_urusan', 'left');
                    $raw = $this->db->get('urusan_indikator u')->result_array();
                    $data = [];
                    $details = [];
                    $str = [];
                    foreach ($raw as $kr => $vr) {
                        $data[] = $vr['id_urusan'];
                        $str[] = $vr['nama_urusan'];
                        $details[] = $vr;
                    }
                    if ($detail == true) {
                        return $details;
                    } else {
                        return $data;
                    }

                case 'keluaran':
                    $this->db->select('k.id_ur_in, k.id_keluaran, tk.nama_keluaran, tk.keterangan');
                    $this->db->where('k.id_indikator', $id);
                    $this->db->join('tbl_keluaran tk', 'tk.id_keluaran = k.id_keluaran', 'left');
                    $raw = $this->db->get('keluaran_indikator k')->result_array();
                    $data = [];
                    $details = [];
                    $str = [];
                    foreach ($raw as $kr => $vr) {
                        $data[] = $vr['id_keluaran'];
                        $str[] = $vr['nama_keluaran'];
                        $details[] = $vr;
                    }
                    if ($detail == true) {
                        return $details;
                    } else {
                        return $data;
                    }

                case 'urusan_str':
                    $this->db->select('u.id_ur_in, u.id_urusan, tu.nama_urusan, tu.keterangan');
                    $this->db->where('u.id_indikator', $id);
                    $this->db->join('tbl_urusan tu', 'tu.id_urusan = u.id_urusan', 'left');
                    $raw = $this->db->get('urusan_indikator u')->result_array();
                    $data = [];
                    $details = [];
                    $str = [];
                    foreach ($raw as $kr => $vr) {
                        $str[] = $vr['nama_urusan'];
                    }

                    return $str;

                case 'keluaran_str':
                    $this->db->select('k.id_ur_in, k.id_keluaran, tk.nama_keluaran, tk.keterangan');
                    $this->db->where('k.id_indikator', $id);
                    $this->db->join('tbl_keluaran tk', 'tk.id_keluaran = k.id_keluaran', 'left');
                    $raw = $this->db->get('keluaran_indikator k')->result_array();
                    $str = [];
                    foreach ($raw as $kr => $vr) {
                        $str[] = $vr['nama_keluaran'];
                    }
                    return $str;

                default:
                    break;
            }
        }
    }

    public function get_indikator_data($id = null)
    {
        $query = "SELECT * FROM (SELECT t.nama_tahun, dt.* FROM tbl_tahun t LEFT JOIN ( SELECT df.id_data, df.id_indikator, df.id_verifikasi, df.data_angka, df.data_file, df.`timestamp`, df.status_verifikasi, df.keterangan, df.tahun FROM v_data_full df, ( SELECT tahun, max( `timestamp` ) AS `timestamp` FROM data WHERE id_indikator = '" . $id . "' GROUP BY tahun ) max_ts WHERE df.tahun = max_ts.tahun AND df.`timestamp` = max_ts.`timestamp` ) dt ON t.nama_tahun = dt.tahun WHERE t.status = '1' ORDER BY nama_tahun) f GROUP BY f.nama_tahun";

        $raw = $this->db->query($query)->result_array();
        return $raw;
    }

    public function get_data($id)
    {
        $raw = $this->db->where('id_data', $id)->get('data')->row_array();
        return $raw;
    }

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

    public function get_rekap_konfirmasi($id_skpd = null, $id_tagar = null)
    {
        // Selalu lakukan join dengan tabel tagar_indikator menggunakan id_skpd

        // Jika id_tagar tidak null, tambahkan kondisi where untuk id_tagar
        // if ($id_tagar !== null) {
        //     $this->db->where('tagar_indikator.id_tagar', $id_tagar);
        //     $this->db->join('tagar_indikator', 'v_indikator_konfirmasi_rekap.id_skpd = tagar_indikator.id_ind', 'left');
        // }

        if ($id_skpd !== null && $id_skpd !== 'all') {
            // Lakukan join dengan tabel tagar_indikator
            $this->db->join('tagar_indikator', 'v_indikator_konfirmasi_rekap.id_skpd = tagar_indikator.id_ind', 'left');

            // Tambahkan kondisi where untuk id_tagar jika ada
            if ($id_tagar !== null) {
                $this->db->where('tagar_indikator.id_tagar', $id_tagar);
            }

            // Tambahkan kondisi where untuk id_skpd
            $this->db->where('v_indikator_konfirmasi_rekap.id_skpd', $id_skpd);

            // Eksekusi query dan dapatkan hasilnya
            $rest = $this->db->get('v_indikator_konfirmasi_rekap')->row_array();
        } elseif ($id_skpd === 'all') {
            // Jika id_skpd adalah 'all', ambil semua hasil
            $rest = $this->db->get('v_indikator_konfirmasi_rekap')->result_array();
        } else {
            // Jika id_skpd adalah null, lakukan perhitungan agregat
            $this->db->select('
                SUM(vr.konfirmasi_belum) AS konfirmasi_belum,
                SUM(vr.konfirmasi_sudah) AS konfirmasi_sudah,
                SUM(vr.konfirmasi_ok) AS konfirmasi_ok,
                SUM(vr.konfirmasi_not_ok) AS konfirmasi_not_ok
            ');


            // Eksekusi query dan ambil hasilnya
            $rest = $this->db->get('v_indikator_konfirmasi_rekap vr')->row_array();

            // $rest = $this->db->get('v_indikator_konfirmasi_rekap vr')->row_array();
        }

        return $rest;
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
        $this->db->where('nama_skpd IS NOT NULL');
        $this->db->where($where[0]);
        $this->db->where_in('tahun', $tahun);
        // $this->db->or_where($where[1]);
        $raw = $this->db->get('v_data_full v')->row_array();
        // $query = "SELECT COUNT(*) AS jumlah, COUNT( IF ( `v`.`status_verifikasi` IS NULL, `v`.`id_indikator`, NULL )) AS `verifikasi_belum`, COUNT( IF ( `v`.`status_verifikasi` = '1', `v`.`id_indikator`, NULL )) AS `verifikasi_ok`, COUNT( IF ( `v`.`status_verifikasi` = '2', `v`.`id_indikator`, NULL )) AS `verifikasi_not_ok`  FROM v_data_full v";
        // $raw = $this->db->query($query)->row_array();
        return $raw;
    }

    public function get_rekap_input($id = null, $idt = null)
    {
        $cnt_tahun = count($this->get_tahun());
        $cnt_indikator = count($this->get_all_indikator($id, $idt));
        $cnt_data = $this->get_count_data($id, $idt);

        if ($cnt_indikator == 0) {
            $zero = true;
        } else {
            $zero = false;
        }

        $result['data'] = $cnt_data;
        $result['indikator'] = $zero ? 0 : $cnt_indikator;
        $result['cnt_tahun'] = $cnt_tahun; // Menambahkan jumlah tahun ke dalam hasil
        $result['cnt_indikator'] = $cnt_indikator; // Menambahkan jumlah tahun ke dalam hasil
        $result['cnt_data'] = array_sum($cnt_data); // Menambahkan jumlah tahun ke dalam hasil

        $result['total'] = $zero ? 0 : number_format(((array_sum($cnt_data) / ($cnt_tahun * $cnt_indikator)) * 100), 2);
        $result['detail'] = [];

        foreach ($this->get_tahun() as $kt => $vt) {
            $result['detail'][$vt['nama_tahun']] = $zero ? 0 : number_format(($cnt_data[$vt['nama_tahun']] / $cnt_indikator * 100), 2);
        }

        return $result;

    }

    public function get_rekap_input_rev($id = null)
    {
        $tahun = $this->get_tahun();
        $sumif = [];
        foreach ($tahun as $kt => $vt) {
            $sumif[] = 'SUM(IF(tahun = ' . $vt['nama_tahun'] . ',indikator_terisi,0) ) AS t_' . $vt['nama_tahun'];
        }
        // $q1 = "SELECT GROUP_CONCAT( DISTINCT CONCAT( 'SUM( IF(tahun = ', tahun, ',indikator_terisi,0) ) AS t_', tahun ) ) AS strtahun FROM k_indikator_terisi";
        // $r1 = $this->db->query($q1)->row_array();
        // return $r1;
        $q2 = "SELECT a.id_skpd, a.nama_skpd, (a.indikator + IFNULL(b.sub_indikator, 0) ) AS jml_indikator, " . implode(', ', $sumif) . " FROM k_indikator a LEFT JOIN k_sub_indikator b ON a.id_skpd = b.id_skpd LEFT JOIN k_indikator_terisi c ON a.id_skpd = c.id_skpd  GROUP BY a.id_skpd";
        $r2 = $this->db->query($q2)->result_array();
        return $r2;
    }

    function build_ind_datatables($params)
    {
        $where = array(
            'level' => '1'
        );
        if ($params['id_skpd'] != null) {
            $where['id_skpd'] = $params['id_skpd'];
        }
        if ($this->session->detail['id_role'] == '3') {
            $where['id_skpd'] = $this->session->detail['id_skpd'];
        }
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
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $raw_data = $this->db->where($where)->get($params['table']);
        $data = array();
        $no = $start + 1;
        foreach ($raw_data->result_array() as $rows) {
            $row = [$no++];
            $id = $rows[$params['columns'][0]];
            $encrypted_id = encrypt_url(true, $id);
            $sub_cnt = $this->get_sub_indikator($rows[$params['columns'][0]]);
            $st_konfirm = array(
                'color' => ($rows['status_konfirmasi'] == '1' ? 'btn-success' : ($rows['status_konfirmasi'] == '2' ? 'btn-danger' : 'btn-warning')),
                'text' => ($rows['status_konfirmasi'] == '1' ? 'Tersedia' : ($rows['status_konfirmasi'] == '2' ? 'Tidak Tersedia' : 'Konfirmasi'))
            );
            foreach ($params['columns'] as $kc => $kv) {
                if ($kc != 0) {
                    $row[] = $rows[$kv];
                }
            }

            $row[] = [
                '<button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light btn-sub-detail" data-id="' . $encrypted_id . '" ' . ($sub_cnt['count'] == '0' ? 'disabled' : '') . '>' . $sub_cnt['count'] . '</button>'
            ];

            $status_metadata = $this->get_status_metadata($rows['id_indikator']);
            $label_class = '';
            if ($status_metadata === 'LENGKAP') {
                $label_class = 'success'; // METADATA LENGKAP
            } elseif ($status_metadata === 'TIDAK LENGKAP') {
                $label_class = 'danger'; // METADATA TIDAK LENGKAP
            }

            $row[] = '<button class="btn btn-sm btn-' . $label_class . '">' . $status_metadata . '</span>';

            $row[] = [
                '<button class="btn btn-sm btn-confirm ' . $st_konfirm['color'] . '" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Konfirmasi">' . $st_konfirm['text'] . '</button>'
            ];
            $row[] = [
                '<div class="d-grid gap-1 d-md-flex justify-content-md-center">' .
                '<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button> ' .
                '<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> ' .
                ($this->session->admin ? '<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button></div>' : '</div>')
            ];
            $data[] = $row;
        }
        $total_data = $this->db->select("COUNT(*) as num")->where($where)->get($params['table'])->row()->num;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }

    function build_subind_datatables($params)
    {
        $where = array(
            'id_main_indikator' => $params['id_indikator']
        );
        $enc_main_id = encrypt_url(true, $params['id_indikator']);
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
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $raw_data = $this->db->where($where)->get($params['table']);
        $data = array();
        $no = $start + 1;
        foreach ($raw_data->result_array() as $rows) {
            $row = [$no++];
            $id = $rows[$params['columns'][0]];
            $encrypted_id = encrypt_url(true, $id);
            $sub_cnt = $this->get_sub_indikator($rows[$params['columns'][0]]);
            $st_konfirm = array(
                'color' => ($rows['status_konfirmasi'] == '1' ? 'btn-success' : ($rows['status_konfirmasi'] == '2' ? 'btn-danger' : 'btn-warning')),
                'text' => ($rows['status_konfirmasi'] == '1' ? 'Tersedia' : ($rows['status_konfirmasi'] == '2' ? 'Tidak Tersedia' : 'Konfirmasi'))
            );
            foreach ($params['columns'] as $kc => $kv) {
                if ($kc != 0) {
                    $row[] = $rows[$kv];
                }
            }

            $row[] = [
                '<button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light btn-sub-detail" data-id="' . $encrypted_id . '" ' . ($sub_cnt['count'] == '0' ? 'disabled' : '') . '>' . $sub_cnt['count'] . '</button>'
            ];
            $row[] = [
                '<button class="btn btn-sm btn-confirm ' . $st_konfirm['color'] . '" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Konfirmasi">' . $st_konfirm['text'] . '</button>'
            ];
            $row[] = [
                '<div class="d-grid gap-1 d-md-flex justify-content-md-center">' .
                '<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button> ' .
                '<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> ' .
                ($this->session->admin ? '<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button></div>' : '</div>')
            ];
            $data[] = $row;
        }
        $total_data = $this->db->select("COUNT(*) as num")->where($where)->get($params['table'])->row()->num;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }


    function build_ind_datatables_input($params)
    {
        $where = array(
            // 'id_main_indikator' => $params['id_indikator']
        );

        if ($params['id_skpd'] != null) {
            $where['id_skpd'] = $params['id_skpd'];
        }

        if ($this->session->detail['id_role'] == '3') {
            $where['id_skpd'] = $this->session->detail['id_skpd'];
        }

        if ($params['type'] == 'input') {
            $where['status_konfirmasi'] = '1';
        }
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
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }

        // $this->db->limit($length, $start);

        // // Corrected join statement
        // $this->db->join('tagar_indikator', 'v_indikator.id_indikator = tagar_indikator.id_ind', 'left');

        // // Add condition for `id_tagar` in the join table
        // if (isset($params['id_tagar'])) {
        //     $this->db->where('tagar_indikator.id_tagar', $params['id_tagar']);
        // }
        // Corrected join statement
        $this->db->join('tagar_indikator', 'v_indikator.id_indikator = tagar_indikator.id_ind', 'left');

        // Add condition for `id_tagar` in the join table
        if (isset($params['id_tagar'])) {
            $this->db->where('tagar_indikator.id_tagar', $params['id_tagar']);
        }

        // Setelah konstruksi WHERE clause, tambahkan GROUP BY jika diperlukan


        // Copy the active query for later use
        $sub_query = clone $this->db;

        // Execute the query with the constructed where clause
        $this->db->limit($length, $start);
        $this->db->group_by('v_indikator.id_indikator');

        $raw_data = $this->db->where($where)->get($params['table']);
        $data = array();

        // // Execute the query with the constructed where clause
        // $raw_data = $this->db->where($where)->get($params['table']);
        // $data = array();

        // var_dump($raw_data);
        $no = $start + 1;
        foreach ($raw_data->result_array() as $rows) {
            $row = [$no++];
            $id = $rows[$params['columns'][0]];
            $encrypted_id = encrypt_url(true, $id);
            $sub_cnt = $this->get_sub_indikator($rows[$params['columns'][0]]);
            $st_konfirm = array(
                'color' => ($rows['status_konfirmasi'] == '1' ? 'btn-success' : ($rows['status_konfirmasi'] == '2' ? 'btn-danger' : 'btn-warning')),
                'text' => ($rows['status_konfirmasi'] == '1' ? 'Tersedia' : ($rows['status_konfirmasi'] == '2' ? 'Tidak Tersedia' : 'Konfirmasi'))
            );
            foreach ($params['columns'] as $kc => $kv) {
                if ($kc != 0) {
                    $row[] = $rows[$kv];
                }
            }
            $tagar = $this->get_tagar($rows['id_indikator']);
            if (!empty($tagar)) {
                $tagar_html = '';
                foreach ($tagar as $nama_tagar) {
                    $tagar_html .= '<button class="btn btn-sm btn-outline-primary waves-effect waves-light">#' . $nama_tagar . '</button> ';
                }
                $row[] = $tagar_html;
            } else {
                $row[] = ''; // Atau sesuaikan dengan penanganan khusus jika tidak ada tagar ditemukan
            }


            $row[] = [
                '<div class="d-grid gap-1 d-md-flex justify-content-md-center">' .
                '<button class="btn btn-sm btn-warning btn-input" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="input"><i class="fas fa-edit"></i> Input</button> ' .
                '<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="far fa-eye"></i> Lihat</button></div>'
            ];
            $data[] = $row;
        }
        // Use the copied active query to count the total data
        $total_data_query = $sub_query->select("COUNT(*) as num")->where($where)->get($params['table']);
        $total_data = $total_data_query->row()->num;
        // $total_data = $this->db->select("COUNT(*) as num")->where($where)->get($params['table'])->row()->num;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }

    public function get_sub_indikator($id_main = null)
    {
        $raw = $this->db->where('id_main_indikator', $id_main)->get('v_indikator')->result_array();
        $result = array(
            'subs' => $raw,
            'count' => count($raw)
        );

        return $result;
    }

    public function get_data_files($id)
    {

        // Mengambil semua data berdasarkan id_indikator
        $result = $this->db->where('id_indikator', $id)
            ->get('data')
            ->result_array();

        return $result;
    }


    // rev 05072023 sub dt ss
    public function get_sub_indikator_data($id = null)
    {
        // $query = "SELECT DISTINCTROW t.nama_tahun, dt.* FROM tbl_tahun t LEFT JOIN ( SELECT df.id_data, df.id_indikator, df.id_verifikasi, df.data_angka, df.data_file, df.`timestamp`, df.status_verifikasi, df.keterangan, df.tahun FROM v_data_full df, ( SELECT tahun, max( `timestamp` ) AS `timestamp` FROM data WHERE id_indikator = '" . $id . "' GROUP BY tahun ) max_ts WHERE df.tahun = max_ts.tahun AND df.`timestamp` = max_ts.`timestamp` AND df.status_verifikasi = '1' ) dt ON t.nama_tahun = dt.tahun WHERE t.status = '1' ORDER BY nama_tahun";
        $query = "SELECT d.* FROM (SELECT DISTINCTROW t.nama_tahun, dt.* FROM tbl_tahun t LEFT JOIN (SELECT df.id_data, df.id_indikator, df.id_verifikasi, df.data_angka, df.data_file, df.`timestamp`, df.status_verifikasi, df.keterangan, df.tahun FROM v_data_full df, ( SELECT tahun, max( `timestamp` ) AS `timestamp` FROM data WHERE id_indikator = '" . $id . "' GROUP BY tahun ) max_ts WHERE df.tahun = max_ts.tahun AND df.`timestamp` = max_ts.`timestamp` AND df.status_verifikasi = '1' ) dt ON t.nama_tahun = dt.tahun WHERE t.STATUS = '1' ORDER BY nama_tahun ASC, id_data DESC ) d GROUP BY d.nama_tahun";
        $raw = $this->db->query($query)->result_array();
        return $raw;
    }
    function build_ind_datatables_input_sub_list($params)
    {
        $where = array(
            'id_main_indikator' => encrypt_url(false, $params['id_indikator'])
        );
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
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $raw_data = $this->db->where($where)->get($params['table']);
        $data = array();
        $no = $start + 1;
        foreach ($raw_data->result_array() as $rows) {
            $row = [$no++];
            $id = $rows[$params['columns'][0]];
            $encrypted_id = encrypt_url(true, $id);
            $row[] = $rows['nama_indikator'];
            $sdt = $this->get_sub_indikator_data($id);
            foreach ($this->get_tahun() as $kt => $vt) {
                $row[] = $sdt[$kt]['data_angka'];
            }
            $row[] = [
                '<a href=" ' . base_url('indikator/input/' . $encrypted_id) . '" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> <button class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Grafik"><i class="fas fa-chart-bar"></i></button>'
            ];
            $data[] = $row;
        }
        $total_data = $this->db->select("COUNT(*) as num")->where($where)->get($params['table'])->row()->num;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }

    function build_sub_datatables($params)
    {
        $where = array(
            'id_main_indikator' => $params['id_indikator']
        );
        $enc_main_id = encrypt_url(true, $params['id_indikator']);
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
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $raw_data = $this->db->where($where)->get($params['table']);
        $data = array();
        $no = $start + 1;
        foreach ($raw_data->result_array() as $rows) {
            $row = [$no++];
            $id = $rows[$params['columns'][0]];
            $encrypted_id = encrypt_url(true, $id);
            foreach ($params['columns'] as $kc => $kv) {
                if ($kc != 0) {
                    $row[] = $rows[$kv];
                }
            }
            $row[] = [
                '<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-main-id="' . $enc_main_id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> ' .
                '<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-main-id="' . $enc_main_id . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash-alt"></i></button>'
            ];
            $data[] = $row;
        }
        $total_data = $this->db->select("COUNT(*) as num")->where($where)->get($params['table'])->row()->num;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }

    function build_data_datatables($id)
    {
        $query = "SELECT * FROM (SELECT t.nama_tahun, dt.*, v.status_verifikasi, v.keterangan, v.lock_data  FROM tbl_tahun t LEFT JOIN ( SELECT data .*  FROM data, ( SELECT tahun, max( `timestamp` ) AS `timestamp` FROM data WHERE id_indikator = '" . $id . "' GROUP BY tahun ) max_ts  WHERE data.tahun = max_ts.tahun  AND data.`timestamp` = max_ts.`timestamp`  ) dt ON t.nama_tahun = dt.tahun LEFT JOIN data_verifikasi v ON dt.id_verifikasi = v.id_verifikasi  WHERE t.STATUS = '1'  ORDER BY nama_tahun ASC, id_data DESC) f	 GROUP BY f.nama_tahun";
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
        $valid_columns = ['nama_tahun', 'data_angka', 'data_file', 'timestamp', 'aksi'];
        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }
        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $raw_data = $this->db->query($query);
        $data = array();
        $no = $start + 1;
        $tahun_lock = $this->get_tahun('input_lock');
        foreach ($raw_data->result_array() as $rows) {
            $encrypted_id = encrypt_url(true, $id);
            $encrypted_iddata = encrypt_url(true, $rows['id_data']);
            if ($rows['timestamp'] != null) {
                switch ($rows['status_verifikasi']) {
                    case null:
                        $stvr = '<button class="btn btn-sm btn-warning btn-ver" data-id="' . $encrypted_iddata . '">Pending</button>';
                        break;
                    case '1':
                        $stvr = '<button class="btn btn-sm btn-success btn-ver" data-id="' . $encrypted_iddata . '">Lolos</button>';
                        break;
                    case '2':
                        $stvr = '<button class="btn btn-sm btn-danger btn-ver" data-id="' . $encrypted_iddata . '">Revisi</button>';
                        break;
                }
            } else {
                $stvr = null;
            }
            ;
            $row = [
                $rows['nama_tahun'],
                $rows['data_angka'],
                '<a href="' . base_url('assets/upload/' . $rows['data_file']) . '">' . $rows['data_file'] . '</a>',
                $rows['catatan'],
                $rows['timestamp'],
                $stvr,
                $rows['keterangan'],
            ];


            if (!$this->session->admin && !in_array($rows['nama_tahun'], $tahun_lock)) {
                $row[] = '<button class="btn btn-sm btn-info">Input Data Terkunci</button>';
            } elseif ($rows['status_verifikasi'] == '1' && $rows['lock_data'] == '1') {
                $row[] = '<button class="btn btn-sm btn-success">Data Sudah Terkunci</button>';
            } else {
                $row[] = [
                    '<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-tahun="' . $rows['nama_tahun'] . '" data-iddata="' . $encrypted_iddata . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i> Edit</button> ' .
                    '<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-tahun="' . $rows['nama_tahun'] . '" data-iddata="' . $encrypted_iddata . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash-alt"></i> Hapus</button>'
                ];
            }
            $data[] = $row;
        }
        // $total_data = $this->db->select("COUNT(*) as num")->where($where)->get($params['table'])->row()->num;
        $total_data = count($raw_data->result_array());
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }

    function check_satuan($id)
    {
        $q = $this->db->where('id_satuan', $id)->get('tbl_satuan')->result_array();
        if (count($q) == 0) {
            $q2 = $this->db->where('nama_satuan', $id)->get('tbl_satuan')->result_array();
            if (count($q2) == 0) {
                $qi = $this->db->insert('tbl_satuan', array('nama_satuan' => $id));
                if ($qi) {
                    $newid = $this->db->insert_id();
                    return $newid;
                }
            } else {
                $newid = $q2[0]['id_satuan'];
                return $newid;
            }
        } else {
            return $q[0]['id_satuan'];
        }
    }

    public function save_indikator($data)
    {
        $md_cols = [];
        $metadata = [];
        foreach ($this->get_metadata_cols() as $key => $value) {
            $metadata[$value['key_metadata']] = $data[$value['key_metadata']];
            unset($data[$value['key_metadata']]);
        }
        $input_data = $data;
        unset($input_data['id_urusan']);
        unset($input_data['id_keluaran']);
        $input_data['id_satuan'] = $this->check_satuan($input_data['id_satuan']);
        $input_data['level'] = 1;
        $input_data['metadata'] = json_encode($metadata);
        if (isset($input_data['id_indikator'])) {
            $input = $this->db->where('id_indikator', $input_data['id_indikator'])->update('indikator', $input_data);
        } else {
            $input = $this->db->insert('indikator', $input_data);
        }
        if ($input) {
            if (isset($data['id_indikator'])) {
                $newid = $data['id_indikator'];
            } else {
                $newid = $this->db->insert_id();
            }

            if (isset($data['id_urusan'])) {
                $selected_urusan = $this->set_selected('urusan', array(
                    'id' => $newid,
                    'selected' => $data['id_urusan']
                ));
            }
            if (isset($data['id_keluaran'])) {
                $selected_keluaran = $this->set_selected('keluaran', array(
                    'id' => $newid,
                    'selected' => $data['id_keluaran']
                ));
            }

            $result = array(
                'success' => true,
                'inserted_id' => encrypt_url(true, $newid)
            );
            return $result;
        } else {
            $result = array(
                'success' => false,
                'inserted_id' => $this->db->error()
            );
            return $result;
        }
    }

    public function save_sub_indikator($data) #DURUNG MARI
    {
        $metadata = [];
        foreach ($this->get_metadata_cols() as $key => $value) {
            $metadata[$value['key_metadata']] = $data[$value['key_metadata']];
            unset($data[$value['key_metadata']]);
        }
        $data['metadata'] = json_encode($metadata);

        if ($data['act'] == 'edit') {
            $data['id_indikator'] = encrypt_url(false, $data['id_indikator']);
            $update_data = $data;
            unset($update_data['id_indikator']);
            unset($update_data['act']);
            // $update_data['level'] = '2';
            $this->db->where('id_indikator', $data['id_indikator']);
            $submit = $this->db->update('indikator', $update_data);
        } elseif ($data['act'] == 'add') {
            $add_data = $data;
            // $add_data['level'] = '2';
            unset($add_data['act']);
            $submit = $this->db->insert('indikator', $add_data);
        }

        if ($submit) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        if ($this->session->admin) {
            // Hapus indikator utama dan sub-indikator yang terkait secara rekursif
            $this->delete_recursive($id);
            return true;
        } else {
            return false;
        }
    }

    private function delete_recursive($id)
    {
        // Dapatkan semua sub-indikator yang memiliki id_main_indikator sama dengan $id
        $sub_indikators = $this->db->select('id_indikator')
            ->where('id_main_indikator', $id)
            ->get('indikator')
            ->result();

        // Hapus indikator utama
        $this->db->group_start();
        $this->db->where('id_indikator', $id);
        $this->db->or_where('id_main_indikator', $id);
        $this->db->group_end();
        $this->db->delete('indikator');

        // Panggil rekursif untuk setiap sub-indikator
        foreach ($sub_indikators as $sub) {
            $this->delete_recursive($sub->id_indikator);
        }
    }
    public function delete_sub($id)
    {
        $delete = $this->db->where('id_indikator', $id)->delete('indikator');
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }

    function set_selected($type, $data)
    {
        switch ($type) {
            case 'urusan':
                $id = $data['id'];
                $preselected = $this->get_selected('urusan', $id);
                $newselected = [];
                $tresult = [];
                foreach ($data['selected'] as $ks => $vs) {
                    $tid = $vs;
                    $newselected[] = $tid;
                    if (!in_array($tid, $preselected)) {
                        $input = $this->db->insert('urusan_indikator', array('id_indikator' => $id, 'id_urusan' => $tid));
                        if ($input) {
                            $tresult[] = array('id' => $vs, 'status' => 'inserted');
                        } else {
                            $tresult[] = array('id' => $vs, 'status' => 'failed');
                        }
                    }
                }

                foreach ($preselected as $kp => $vp) {
                    if (!in_array($vp, $newselected)) {
                        $delete = $this->db->where(array('id_indikator' => $id, 'id_urusan' => $vp))->delete('urusan_indikator');
                        if ($delete) {
                            $tresult[] = array('id' => $vs, 'status' => 'deleted');
                        } else {
                            $tresult[] = array('id' => $vs, 'status' => 'failed');
                        }
                    }
                }
                $result = array(
                    'status' => 'success',
                    'message' => 'Berhasil',
                    'data' => $tresult
                );

                return $result;
                break;

            case 'keluaran':
                $id = $data['id'];
                $preselected = $this->get_selected('keluaran', $id);
                $newselected = [];
                $tresult = [];
                foreach ($data['selected'] as $ks => $vs) {
                    $tid = $vs;
                    $newselected[] = $tid;
                    if (!in_array($tid, $preselected)) {
                        $input = $this->db->insert('keluaran_indikator', array('id_indikator' => $id, 'id_keluaran' => $tid));
                        if ($input) {
                            $tresult[] = array('id' => $vs, 'status' => 'inserted');
                        } else {
                            $tresult[] = array('id' => $vs, 'status' => 'failed');
                        }
                    }
                }

                foreach ($preselected as $kp => $vp) {
                    if (!in_array($vp, $newselected)) {
                        $delete = $this->db->where(array('id_indikator' => $id, 'id_keluaran' => $vp))->delete('keluaran_indikator');
                        if ($delete) {
                            $tresult[] = array('id' => $vs, 'status' => 'deleted');
                        } else {
                            $tresult[] = array('id' => $vs, 'status' => 'failed');
                        }
                    }
                }
                $result = array(
                    'status' => 'success',
                    'message' => 'Berhasil',
                    'data' => $tresult
                );
                return $result;
                break;

            default:
                # code...
                break;
        }
    }

    public function save_data($data)
    {
        $input_data = array(
            'id_indikator' => encrypt_url(false, $data['id_indikator']),
            'data_angka' => $data['data-angka'],
            'catatan' => $data['catatan'],
            // 'data_file' => $data['data_file'],
            'tahun' => $data['tahun']
        );

        $msg = 'nofile';

        if ($_FILES['file']['name'] != '') {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'xls|xlsx|csv|jpg|png|jpeg|bmp|pdf';
            $config['file_name'] = $_FILES['file']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $msg = $this->upload->display_errors();
            } else {
                $file = $this->upload->data();
                $input_data['data_file'] = $file['file_name'];
                $msg = 'file upload success';
            }
        }


        $input = $this->db->insert('data', $input_data);

        if ($input) {
            $result = array(
                'success' => true,
                'msg' => $data
            );
            return $result;
        } else {
            $result = array(
                'success' => false,
                'inserted_id' => $this->db->error()
            );
            return $result;
        }
    }

    public function get_indikator($id, $detail = false)
    {
        $raw = $this->db->where('id_indikator', $id)->get('v_indikator')->row_array();
        if (isset($raw)) {
            $rmetadata = json_decode($raw['metadata'], true);
            $colmd = $this->get_metadata_cols();
            foreach ($colmd as $key => $value) {
                $metadata[$value['key_metadata']] = isset($rmetadata[$value['key_metadata']]) ? $rmetadata[$value['key_metadata']] : null;
                $colmd[$key]['value'] = isset($rmetadata[$value['key_metadata']]) ? $rmetadata[$value['key_metadata']] : null;
            }
            $data = array_merge($raw, $metadata);
            if ($detail) {
                $data['urusan'] = $this->get_selected('urusan', $id, true);
                $data['keluaran'] = $this->get_selected('keluaran', $id, true);
                $data['metadata'] = $colmd;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function get_status_metadata($id, $detail = false)
    {
        $raw = $this->db->where('id_indikator', $id)->get('v_indikator')->row_array();
        if (isset($raw)) {
            $rmetadata = json_decode($raw['metadata'], true);
            $colmd = $this->get_metadata_cols();
            foreach ($colmd as $key => $value) {
                $metadata[$value['key_metadata']] = isset($rmetadata[$value['key_metadata']]) ? $rmetadata[$value['key_metadata']] : null;
                $colmd[$key]['value'] = isset($rmetadata[$value['key_metadata']]) ? $rmetadata[$value['key_metadata']] : null;
            }
            $data = array_merge($raw, $metadata);

            // Cek apakah ada nilai kosong dalam metadata
            $metadataIsEmpty = false;
            foreach ($metadata as $value) {
                if ($value === null || $value === "") {
                    $metadataIsEmpty = true;
                    break;
                }
            }

            if (!$metadataIsEmpty) {
                if ($detail) {
                    $data['urusan'] = $this->get_selected('urusan', $id, true);
                    $data['keluaran'] = $this->get_selected('keluaran', $id, true);
                    $data['metadata'] = $colmd;
                }
                return "LENGKAP"; // Semua data metadata terisi penuh
            } else {
                return "TIDAK LENGKAP"; // Ada data metadata yang kosong
            }
        } else {
            return null;
        }
    }

    public function get_tagar($id)
    {
        $results = [];
        $raw_data = $this->db->where('id_ind', $id)->get('tagar_indikator')->result_array();
        if (!empty($raw_data)) {
            foreach ($raw_data as $raw) {
                $id_tagar = $raw['id_tagar'];
                // Mengambil nama_tagar dari tabel tbl_tagar berdasarkan id_tagar
                $tagar_info = $this->db->where('id_tagar', $id_tagar)->get('tbl_tagar')->row_array();
                if (isset($tagar_info['nama_tagar'])) {
                    $results[] = $tagar_info['nama_tagar'];
                }
            }
        }
        return $results;
    }


    public function konfirmasi($data)
    {
        $id = encrypt_url(false, $data['id_indikator']);
        $insert_data = array(
            'id_indikator' => $id,
            'status_konfirmasi' => (isset($data['konfirmasi']) ? '1' : '2'),
            'alasan' => (isset($data['konfirmasi']) ? null : $data['alasan']),
            'skpd_pengganti' => (isset($data['konfirmasi']) ? null : ($data['alasan'] == '2' ? $data['id_skpd'] : null)),
            'keterangan' => (isset($data['konfirmasi']) ? null : $data['keterangan'])
        );


        $submit = $this->db->insert('indikator_konfirmasi', $insert_data);
        if ($submit) {
            $newid = $this->db->insert_id();
            $update = $this->db->where('id_indikator', $id)->update('indikator', ['id_konfirmasi' => $newid]);
            if ($update) {
                $result = array(
                    'status' => 'success',
                    'message' => 'Data Berhasil Diperbaharui'
                );
            }
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'Data Gagal Diperbaharui'
            );
        }

        return $result;
    }

    public function konfirmasi_transfer($data)
    {
        $id = $data['id_indikator'];
        if (isset($data['konfirmasi'])) {
            $insert_data = array(
                'id_indikator' => $id,
                'status_konfirmasi' => null,
                'alasan' => null,
                'skpd_pengganti' => null,
                'keterangan' => null,
            );

            $update = $this->db->where('id_indikator', $id)->update('indikator', ['id_skpd' => $data['id_skpd_pengganti']]);
            $update = $this->db->where('id_konfirmasi', $data['id_konfirmasi'])->update('indikator_konfirmasi', ['status' => '1']);
            $submit = $this->db->insert('indikator_konfirmasi', $insert_data);
            $newid = $this->db->insert_id();
            $update = $this->db->where('id_indikator', $id)->update('indikator', ['id_konfirmasi' => $newid]);
        } else {
            $submit = $this->db->where('id_konfirmasi', $data['id_konfirmasi'])->update('indikator_konfirmasi', ['status' => '2']);
        }

        if ($submit) {
            $result = array(
                'status' => 'success',
                'message' => 'Data Berhasil Diperbaharui'
            );
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'Data Gagal Diperbaharui'
            );
        }

        return $result;
    }

    public function get_transfer_count()
    {
        $where = array(
            'i.alasan' => '2',
            'ik.alasan' => '2',
            'ik.status' => '0'
        );
        $this->db->select('ik.*, i.id_skpd AS id_skpd_asal, i.nama_indikator, i.nama_skpd AS nama_skpd_asal, s.nama_skpd AS nama_skpd_pengganti');
        $this->db->join('indikator_konfirmasi ik', 'ik.id_indikator = i.id_indikator', 'left');
        $this->db->join('tbl_skpd s', 'ik.skpd_pengganti = s.id_skpd', 'left');
        $this->db->where($where);
        $raw_data = $this->db->order_by('timestamp', 'desc')->get('v_indikator i');
        $total_data = $raw_data->num_rows();
        return $total_data;
    }

    function build_ind_datatables_verifikasi()
    {
        $params = array(
            'columns' => ['id_data', 'nama_indikator', 'nama_skpd', 'data_angka', 'data_file', 'catatan', 'tahun', 'timestamp'],
            'table' => 'v_data_full',
        );
        $where = array();

        $type = $this->input->get('type');
        switch ($type) {
            case 'all':
                $where = [];
                break;
            case 'pending':
                $where['status_verifikasi'] = null;
                break;
            case 'revisi':
                $where['status_verifikasi'] = '2';
                break;
            case 'lolos':
                $where['status_verifikasi'] = '1';
                break;
        }

        if ($this->input->get('tahun') != null) {
            $where['tahun'] = $this->input->get('tahun');
        }
        if ($this->input->get('skpd') != null) {
            $where['id_skpd'] = $this->input->get('skpd');
        }

        // $this->db->where('nama_skpd IS NOT NULL');
        $where['nama_skpd !='] = null;

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
        if (!isset($valid_columns[$col-1])) { // Adjust for the checkbox column
            $order = null;
        } else {
            $order = $valid_columns[$col-1]; // Adjust column index for checkbox
        }
        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $raw_data = $this->db->where($where)->order_by('timestamp', 'desc')->get($params['table']);
        $data = array();
        $no = $start + 1;


        foreach ($raw_data->result_array() as $rows) {
            $id = $rows[$params['columns'][0]];
            $encrypted_id = encrypt_url(true, $id);
            
            // Store the ID first for checkbox column (will be transformed on client-side)
            $row = [$id]; // This will be converted to checkbox in dataSrc function
            $row[] = $no++; // Sequential numbering
            
            if ($rows['level'] == '2') {
                $rows['nama_indikator'] = $rows['main_indikator'] . '<br> > ' . $rows['nama_indikator'];
                $rows['id_indikator'] = $rows['id_main_indikator'];
                $rows['nama_skpd'] = $rows['main_skpd'];
            }

            $st_konfirm = array(
                'color' => ($rows['status_verifikasi'] == '1' ? 'btn-success' : ($rows['status_verifikasi'] == '2' ? 'btn-danger' : 'btn-warning')),
                'text' => ($rows['status_verifikasi'] == '1' ? 'Lolos' : ($rows['status_verifikasi'] == '2' ? 'Revisi' : 'Verifikasi'))
            );
            $row[] = '<a href="' . base_url('indikator/get_indikator_detail') . '" class="a-detail-indikator" data-id = "' . encrypt_url(true, $rows['id_indikator']) . '">' . $rows['nama_indikator'] . '</a>';

            $row[] = $rows['nama_skpd'];
            $row[] = $rows['tahun'];
            $row[] = '<a href="' . base_url('indikator/get_datas') . '" class="a-detail-data" data-id = "' . encrypt_url(true, $rows['id_indikator']) . '">' . $rows['data_angka'] . '</a>';
            $row[] = $rows['data_file'];
            $row[] = $rows['catatan'];
            $row[] = $rows['timestamp'];
            $row[] = $rows['status_verifikasi'];

            $status_metadata = $this->get_status_metadata($rows['id_indikator']);
            $label_class = '';
            if ($status_metadata === 'LENGKAP') {
                $label_class = 'success'; // METADATA LENGKAP
            } elseif ($status_metadata === 'TIDAK LENGKAP') {
                $label_class = 'danger'; // METADATA TIDAK LENGKAP
            }

            $row[] = '<button class="btn btn-sm btn-' . $label_class . '">' . $status_metadata . '</span>';

            $row[] = [
                '<button class="btn btn-sm btn-verifikasi ' . $st_konfirm['color'] . '" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Verifikasi">' . $st_konfirm['text'] . '</button>'
            ];
            $row[] = $rows['keterangan'];
            $data[] = $row;
        }
        $total_data = $this->db->select("COUNT(*) as num")->where($where)->get($params['table'])->row()->num;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }

    function build_ind_datatables_transfer()
    {
        $params = array(
            'columns' => ['id_konfirmasi', 'nama_indikator', 'nama_skpd_asal', 'nama_skpd_pengganti', 'keterangan', 'timestamp'],
            // 'table' => 'v_data_full',
        );

        $where = array();
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
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $where = array(
            'i.alasan' => '2',
            'ik.alasan' => '2',
            'ik.status' => '0'
        );
        $this->db->limit($length, $start);
        $this->db->select('ik.*, i.id_skpd AS id_skpd_asal, i.nama_indikator, i.nama_skpd AS nama_skpd_asal, s.nama_skpd AS nama_skpd_pengganti');
        $this->db->join('indikator_konfirmasi ik', 'ik.id_indikator = i.id_indikator', 'left');
        $this->db->join('tbl_skpd s', 'ik.skpd_pengganti = s.id_skpd', 'left');
        $this->db->where($where);
        $raw_data = $this->db->order_by('timestamp', 'desc')->get('v_indikator i');
        $data = array();
        $no = $start + 1;
        foreach ($raw_data->result_array() as $rows) {
            $row = [$no++];
            $row[] = $rows['nama_indikator'];
            $row[] = $rows['nama_skpd_asal'];
            $row[] = $rows['nama_skpd_pengganti'];
            $row[] = $rows['keterangan'];
            $row[] = $rows['timestamp'];
            $encrypted_id = encrypt_url(true, $rows['id_konfirmasi']);
            $row[] = [
                '<button class="btn btn-sm btn-confirm btn-primary" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Verifikasi">Konfirmasi</button>'
            ];
            $data[] = $row;
        }
        $total_data = $raw_data->num_rows();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
    }

    public function verifikasi($data)
    {
        $id = encrypt_url(false, $data['id_data']);
        $insert_data = array(
            'id_data' => $id,
            'status_verifikasi' => (isset($data['verifikasi']) ? '1' : '2'),
            'lock_data' => (isset($data['lock_data']) ? '1' : '2'),
            'keterangan' => $data['keterangan']
        );


        $submit = $this->db->insert('data_verifikasi', $insert_data);
        if ($submit) {
            $newid = $this->db->insert_id();
            $update = $this->db->where('id_data', $id)->update('data', ['id_verifikasi' => $newid]);
            if ($update) {
                $result = array(
                    'status' => 'success',
                    'message' => 'Data Berhasil Diperbaharui'
                );
            }
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'Data Gagal Diperbaharui'
            );
        }

        return $result;
    }

    public function get_indikator_full($id)
    {
        $ind = $this->get_indikator($id);
        $ind['data'] = $this->get_indikator_data($id);
        $ind['sub'] = $this->get_sub_indikator($id);
        foreach ($ind['sub']['subs'] as $ks => $vs) {
            $ind['sub']['subs'][$ks]['data'] = $this->get_indikator_data($vs['id_indikator']);
        }

        return $ind;
    }

    public function get_all_indikators()
    {
        $raw = $this->db->get('v_indikator')->result_array();
        return $raw;
    }

    function build_publikasi_datatables_req($params)
    {
        $where = [];
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
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $raw_data = $this->db->get($params['table']);
        $data = array();
        $no = $start + 1;
        foreach ($raw_data->result_array() as $rows) {
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
        $total_data = $this->db->select("COUNT(*) as num")->get($params['table'])->row()->num;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        return $output;
        // exit();
    }
    public function verifikasi_bulk($data)
    {
        $ids = $data['ids'];
        $success_count = 0;
        $failed_count = 0;
        $results = [];
        
        // Mulai transaksi database
        $this->db->trans_start();
        
        foreach ($ids as $id) {
            // Buat data verifikasi untuk setiap ID
            $verif_data = [
                'id_data' => $id,
                'status_verifikasi' => $data['verifikasi'],
                'keterangan' => $data['keterangan'],
                'lock_data' => $data['lock_data'] ?? NULL,
                'timestamp' => date('Y-m-d H:i:s')
            ];
            
            // Cek apakah data dengan id tersebut sudah ada
            $existing_data = $this->db->where('id_data', $id)->get('data_verifikasi')->row();

            if ($existing_data) {
                // Data sudah ada, lakukan update
                $this->db->where('id_data', $id);
                $insert_result = $this->db->update('data_verifikasi', $verif_data);
            } else {
                // Data belum ada, lakukan insert
                $insert_result = $this->db->insert('data_verifikasi', $verif_data);
            }
            
            if ($insert_result) {
                $success_count++;
                $results[$id] = true;
            } else {
                $failed_count++;
                $results[$id] = false;
            }
        }
        
        // Commit transaksi
        $this->db->trans_complete();
        
        return [
            'status' => $this->db->trans_status(),
            'message' => "Berhasil memverifikasi $success_count data. Gagal memverifikasi $failed_count data.",
            'results' => $results
        ];
    }
}
