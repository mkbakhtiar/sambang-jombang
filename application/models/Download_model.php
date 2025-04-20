<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;

class Download_model extends CI_Model
{
    public function ba_list($id_skpd)
    {
        $where = array(
            'id_skpd' => $id_skpd,
            'level' => '1',
            'status_konfirmasi' => '1'
        );
        $this->db->select('id_indikator, nama_indikator, definisi_operasional, nama_skpd, nama_satuan');
        $this->db->where($where);
        $raw_list = $this->db->get('v_indikator')->result_array();

        foreach ($raw_list as $kr => $vr) {
            $raw_list[$kr]['subs'] = $this->db->where(['level' => '2', 'id_main_indikator' => $vr['id_indikator']])->get('v_indikator')->result_array();
        }

        return $raw_list;
    }

    public function download($params = null)
    {

        // $data = $this->data->get_skpd_data(hashcrypt('dec', $id));

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $cell = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM");

        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'Nama Indikator');
        $sheet->setCellValue('C2', 'Satuan');
        $sheet->setCellValue('D2', 'Kategori');
        $sheet->setCellValue('E2', 'Definisi Operasional');

        // $tahun = $this->data->get_tahun();
        // $no = 1;
        // $row = 3;
        // $sub_stat = false;

        // foreach ($tahun as $kt => $vt) {
        //     $sheet->setCellValue($cell[$kt + 5] . '2', $vt);
        // }

        // foreach ($data as $key => $value) {
        //     if ($sub_stat) {
        //         $row = $row - 1;
        //         $sub_stat = false;
        //     }

        //     $sheet->setCellValue('A' . $row, $no);
        //     $sheet->setCellValue('B' . $row, $value['nama_indikator']);
        //     $sheet->setCellValue('C' . $row, $value['nama_satuan']);
        //     $sheet->setCellValue('D' . $row, $value['id_kategori']);
        //     $sheet->setCellValue('E' . $row, html_entity_decode($value['deskripsi_operasional']));

        //     foreach ($tahun as $kt => $vt) {
        //         if (isset($value['data'][$vt])) {
        //             $sheet->setCellValue($cell[$kt + 5] . $row, $value['data'][$vt]['value']);
        //         }
        //     }

        //     $no++;
        //     $row++;

        //     foreach ($value['sub'] as $key2 => $value2) {
        //         $sheet->setCellValue('B' . $row, $value2['nama_sub_indikator']);
        //         $sheet->setCellValue('C' . $row, '');
        //         $sheet->setCellValue('E' . $row, $value2['deskripsi']);

        //         foreach ($tahun as $kt => $vt) {
        //             if (isset($value2['detail'][$vt])) {
        //                 $sheet->setCellValue($cell[$kt + 5] . $row, $value2['detail'][$vt]['value']);
        //             }
        //         }

        //         $row++;
        //         $sub_stat = true;
        //     }
        // }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename ="testtt.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function get_indikator_list($id_skpd = null)
    {
        $raw = $this->db->order_by('nama_indikator', 'asc')->get('v_indikator')->result_array();
        $indikator = [];
        foreach ($raw as $kr => $vr) {
            if ($vr['status_konfirmasi'] == '1' && $vr['level'] == '1') {
                if ($id_skpd != null) {
                    if ($vr['id_skpd'] == $id_skpd) {
                        $indikator[] = $vr;
                    }
                } else {
                    $indikator[] = $vr;
                }
            }
        }

        foreach ($indikator as $ki => $vi) {
            foreach ($raw as $kr => $vr) {
                if ($vr['id_main_indikator'] == $vi['id_indikator']) {
                    $indikator[$ki]['subs'][] = $vr;
                }
            }
        }
        return $indikator;
    }

    public function get_skpd_detail($id_skpd)
    {
        $result = $this->db->where('id_skpd', $id_skpd)->get('tbl_skpd')->row_array();
        return $result;
    }
}
