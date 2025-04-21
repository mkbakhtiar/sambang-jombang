<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use Symfony\Component\HttpFoundation\StreamedResponse;

date_default_timezone_set("Asia/Jakarta");

class Download extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }



    public function export_penetapan($id_skpd = null)
    {
        $this->load->model('auth_model');
        if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));

        $this->load->model('Indikator_model', 'indikator');
        $this->load->model('Download_model', 'download');

        if (!$this->session->admin || $this->session->admin2) {
        // if (!$this->session->admin) {
            $id_skpd = $this->session->detail['id_skpd'];
        }

        $data = $this->data->get_skpd_data($id_skpd);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $cell = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM");

        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'Nama Indikator');
        $sheet->setCellValue('C2', 'Satuan');
        $sheet->setCellValue('D2', 'Kategori');
        $sheet->setCellValue('E2', 'Definisi Operasional');

        $tahun = $this->data->get_tahun();
        $no = 1;
        $row = 3;
        $sub_stat = false;

        foreach ($tahun as $kt => $vt) {
            $sheet->setCellValue($cell[$kt + 5] . '2', $vt);
        }

        foreach ($data as $key => $value) {
            if ($sub_stat) {
                $row = $row - 1;
                $sub_stat = false;
            }

            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $value['nama_indikator']);
            $sheet->setCellValue('C' . $row, $value['nama_satuan']);
            $sheet->setCellValue('D' . $row, $value['id_kategori']);
            $sheet->setCellValue('E' . $row, html_entity_decode($value['deskripsi_operasional']));

            foreach ($tahun as $kt => $vt) {
                if (isset($value['data'][$vt])) {
                    $sheet->setCellValue($cell[$kt + 5] . $row, $value['data'][$vt]['value']);
                }
            }

            $no++;
            $row++;

            foreach ($value['sub'] as $key2 => $value2) {
                $sheet->setCellValue('B' . $row, $value2['nama_sub_indikator']);
                $sheet->setCellValue('C' . $row, '');
                $sheet->setCellValue('E' . $row, $value2['deskripsi']);

                foreach ($tahun as $kt => $vt) {
                    if (isset($value2['detail'][$vt])) {
                        $sheet->setCellValue($cell[$kt + 5] . $row, $value2['detail'][$vt]['value']);
                    }
                }

                $row++;
                $sub_stat = true;
            }
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename ="data_' . replaceee($data[0]['nama_skpd'], 'r') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function berita_acara($id_skpd = null)
    {
        $this->load->model('auth_model');
        if ($this->auth_model->isNotLogin()) redirect(base_url('auth'));

        $this->load->model('Indikator_model', 'indikator');
        $this->load->model('Download_model', 'download');

        if (!$this->session->admin) {
            $id_skpd = $this->session->detail['id_skpd'];
        }

        $rekap = $this->indikator->get_rekap_konfirmasi($id_skpd);
        $indikator = $this->download->ba_list($id_skpd);

        if ($rekap['konfirmasi_belum'] != '0') {
            echo '<center><h4>Anda belum menyelesaikan proses Konfirmasi Daftar Data (Kurang ' . $rekap['konfirmasi_belum'] . ' Lagi)</h4></center>';
            die();
        }

        $file = '/home/satudatajom/public_html/assets/template/ba_template.docx';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($file);

        $tanggal = date("j-n-Y");
        $tanggal = explode('-', $tanggal);

        $nama_skpd = $indikator[0]['nama_skpd'];
        $values = array(
            'nama_skpd' => $nama_skpd,
            'hari' => $this->hari_ini(date('D')),
            'tanggal' => str_replace('  ', ' ', ucwords(strtolower($this->terbilang($tanggal[0])))),
            'bulan' => str_replace('  ', ' ', ucwords(strtolower($this->bulan($tanggal[1])))),
            'tahun' => str_replace('  ', ' ', ucwords(strtolower($this->terbilang($tanggal[2])))),
            // 'tanggal_cetak' => $this->tgl_indo(date('Y-m-d'))
        );
        $templateProcessor->setValues($values);
        $rowcnt = 0;
        foreach ($indikator as $dk => $dv) {
            $rowcnt += 1;
            if (count($dv['subs']) != 0) {
                foreach ($dv['subs'] as $sk => $sv) {
                    $rowcnt += 1;
                }
            }
        }

        $templateProcessor->cloneRow('no', $rowcnt);
        $currow = 1;
        $no = 1;
        foreach ($indikator as $dk => $dv) {
            $templateProcessor->setValue('no#' . strval($currow), $no);
            $templateProcessor->setValue('nama_indikator#' . strval($currow), preg_replace('/\s+[^A-Za-z0-9\-()]/', '', trim(strip_tags($dv['nama_indikator']))));
            $templateProcessor->setValue('definisi#' . strval($currow), preg_replace('/\s+[^A-Za-z0-9\-()]/', '', trim(strip_tags($dv['definisi_operasional']))));
            $templateProcessor->setValue('satuan#' . strval($currow), preg_replace('/\s+[^A-Za-z0-9\-()]/', '', trim(strip_tags($dv['nama_satuan']))));
            $currow += 1;
            if (count($dv['subs']) != 0) {
                foreach ($dv['subs'] as $sk => $sv) {
                    $templateProcessor->setValue('no#' . strval($currow), '');
                    $templateProcessor->setValue('nama_indikator#' . strval($currow), strval($no) . '.' . strval($sk + 1) . '. ' . preg_replace('/\s+[^A-Za-z0-9\-()]/', '', trim(strip_tags($sv['nama_indikator']))));
                    $templateProcessor->setValue('definisi#' . strval($currow), preg_replace('/\s+[^A-Za-z0-9\-()]/', '', trim(strip_tags($dv['definisi_operasional']))));
                    $templateProcessor->setValue('satuan#' . strval($currow), preg_replace('/\s+[^A-Za-z0-9\-()]/', '', trim(strip_tags($dv['nama_satuan']))));
                    $currow += 1;
                }
            }
            $no += 1;
        }

        header('Content-Disposition: attachment; filename=Berita Acara - ' . $nama_skpd . '.docx');
        $templateProcessor->saveAs('php://output');
        // } else {
        //     echo 'Belum Selesai Konfirmasi';
        // }
    }

    function terbilang($nilai)
    {
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if ($nilai == 0) {
            return "Kosong";
        } elseif ($nilai < 12 & $nilai != 0) {
            return "" . $huruf[$nilai];
        } elseif ($nilai < 20) {
            return Terbilang($nilai - 10) . " Belas ";
        } elseif ($nilai < 100) {
            return Terbilang($nilai / 10) . " Puluh " . Terbilang($nilai % 10);
        } elseif ($nilai < 200) {
            return " Seratus " . Terbilang($nilai - 100);
        } elseif ($nilai < 1000) {
            return Terbilang($nilai / 100) . " Ratus " . Terbilang($nilai % 100);
        } elseif ($nilai < 2000) {
            return " Seribu " . Terbilang($nilai - 1000);
        } elseif ($nilai < 1000000) {
            return Terbilang($nilai / 1000) . " Ribu " . Terbilang($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            return Terbilang($nilai / 1000000) . " Juta " . Terbilang($nilai % 1000000);
        } elseif ($nilai < 1000000000000) {
            return Terbilang($nilai / 1000000000) . " Milyar " . Terbilang($nilai % 1000000000);
        } elseif ($nilai < 100000000000000) {
            return Terbilang($nilai / 1000000000000) . " Trilyun " . Terbilang($nilai % 1000000000000);
        } elseif ($nilai <= 100000000000000) {
            return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
        }
    }

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function hari_ini($tanggal)
    {
        switch ($tanggal) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }

        return $hari_ini;
    }

    function bulan($bulan)
    {
        switch ($bulan) {
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
        }
        return $bulan;
    }


    public function download($type = null, $filetype = null, $skpd = null, $params = null)
    {
        if ($this->session->admin || $this->session->admin2) {
        // if ($this->session->admin) {
            $id_skpd = $skpd;
        } else {
            $id_skpd = $this->session->detail['id_skpd'];
        }

        $this->load->model('Download_model', 'download');
        $this->load->model('Indikator_model', 'indikator');

        if ($id_skpd != null) {
            $skpd_detail = $this->download->get_skpd_detail($id_skpd);
        } else {
            $skpd_detail = ['nama_skpd' => ''];
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setHorizontalCentered(true);
        $sheet->getPageMargins()->setTop(0.6);
        $sheet->getPageMargins()->setRight(0.6);
        $sheet->getPageMargins()->setLeft(0.6);
        $sheet->getPageMargins()->setBottom(0.6);
        $cell = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM");

        $styleHeader = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $styleBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        switch ($type) {
            case 'penetapanAll':
                // Mengambil semua indikator
                $ind_list = $this->download->get_indikator_list();
                
                // Inisialisasi array untuk menyimpan semua ID
                $all_ids = [];
            
                // Mengatur lebar kolom dan gaya sel
                $sheet->getStyle('A1')->applyFromArray($styleBorder);
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true); // Kolom baru untuk Status Metadata
            
                // Menetapkan nilai dan gaya header
                $sheet->setCellValue('A1', 'Daftar Indikator Semua SKPD');
                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Nama Indikator');
                $sheet->setCellValue('C2', 'OPD');
                $sheet->setCellValue('D2', 'Status Metadata'); // Menambah judul kolom baru untuk Status Metadata
                $sheet->getStyle('A2:D2')->applyFromArray($styleHeader);
            
                $no = 1;
                $row = 3;
            
                foreach ($ind_list as $ik => $iv) {
                    $all_ids[] = $iv['id_indikator'];
            
                    $sheet->setCellValue('A' . $row, $ik + 1);
                    $sheet->setCellValue('B' . $row, $iv['nama_indikator']);
                    $sheet->setCellValue('C' . $row, $iv['nama_skpd']);
            
                    $status_metadata = $this->indikator->get_status_metadata($iv['id_indikator']);
                    
                    $sheet->setCellValue('D' . $row, $status_metadata);
            
                    $sheet->getStyle('A' . $row . ':D' . $row)->applyFromArray($styleBorder);
            
                    $row++;
            
                    if (isset($iv['subs'])) {
                        foreach ($iv['subs'] as $sk => $sv) {
                            $all_ids[] = $sv['id_indikator'];
            
                            $sheet->setCellValue('A' . $row, strval(($ik + 1) . '.' . ($sk + 1)));
                            $sheet->setCellValue('B' . $row, $sv['nama_indikator']);
                            $sheet->setCellValue('C' . $row, $iv['nama_skpd']);
            
                            $status_metadata = $this->indikator->get_status_metadata($sv['id_indikator']);
                            
                            $sheet->setCellValue('D' . $row, $status_metadata);
            
                            $sheet->getStyle('A' . $row . ':D' . $row)->applyFromArray($styleBorder);
                            $row++;
                        }
                    }
                }
            
                $sheet->getStyle('A2:D' . strval($row - 1))->applyFromArray($styleBorder);
            
                break;
            
            case 'penetapan':
                $ind_list = $this->download->get_indikator_list($id_skpd);
                $md_cols = $this->indikator->get_metadata_cols();
                // $sheet->getStyle('A1')->applyFromArray($styleHeader);
                $sheet->getStyle('A1')->applyFromArray($styleBorder);
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true); // Kolom baru untuk Status Metadata
            
                $sheet->setCellValue('A1', 'Daftar Indikator ' . $skpd_detail['nama_skpd']);
            
                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Nama Indikator');
                $sheet->setCellValue('C2', 'Definisi Operasional');
                $sheet->setCellValue('D2', 'Satuan');
                $sheet->setCellValue('E2', 'Akses');
                $sheet->setCellValue('F2', 'Periodik');
                $sheet->setCellValue('G2', 'Keluaran');
                $sheet->setCellValue('H2', 'Urusan');
                $sheet->setCellValue('I2', 'OPD');
                foreach ($md_cols as $mdk => $mdv) {
                    $cmd = $cell[9 + $mdk];
                    $sheet->setCellValue($cmd . '2', $mdv['nama_metadata']);
                    $sheet->getColumnDimension($cmd)->setAutoSize(true);
                }
            
                // Menambah judul kolom baru untuk Status Metadata
                $status_metadata_title_cell = $cell[9 + count($md_cols)] . '2';
                $sheet->setCellValue($status_metadata_title_cell, 'Status Metadata');
                
                // Terapkan gaya border untuk sel judul Status Metadata
                $sheet->getStyle($status_metadata_title_cell)->applyFromArray($styleBorder);
                // Beri gaya bold untuk judul Status Metadata
                $sheet->getStyle($status_metadata_title_cell)->getFont()->setBold(true);
            
                $no = 1;
                $row = 3;
            
                foreach ($ind_list as $ik => $iv) {
            
                    $sheet->setCellValue('A' . $row, $ik + 1);
                    $sheet->setCellValue('B' . $row, $iv['nama_indikator']);
                    $sheet->setCellValue('C' . $row, $iv['definisi_operasional']);
                    $sheet->setCellValue('D' . $row, $iv['nama_satuan']);
                    $sheet->setCellValue('E' . $row, $iv['nama_akses']);
                    $sheet->setCellValue('F' . $row, $iv['nama_periodik']);
                    $keluaran = $this->indikator->get_selected('keluaran_str', $iv['id_indikator'], 'str');
                    $sheet->setCellValue('G' . $row, implode(', ', $keluaran));
                    $urusan = $this->indikator->get_selected('urusan_str', $iv['id_indikator'], 'str');
                    $sheet->setCellValue('H' . $row, implode(', ', $urusan));
                    $sheet->setCellValue('I' . $row, $iv['nama_skpd']);
                    $md = json_decode($iv['metadata'], true);
                    if (isset($md)) {
                        foreach ($md_cols as $mdk => $mdv) {
                            $sheet->setCellValue($cell[9 + $mdk] . $row, $md[$mdv['key_metadata']]);
                        }
                    }
            
                    // Mendapatkan status metadata
                    $status_metadata = $this->indikator->get_status_metadata($iv['id_indikator']);
                    
                    // Tentukan lokasi sel untuk setiap baris data
                    $status_metadata_cell = $cell[9 + count($md_cols)] . $row;
                    
                    // Isi sel dengan status metadata
                    $sheet->setCellValue($status_metadata_cell, $status_metadata);
            
                    // Terapkan gaya border untuk sel status metadata
                    $sheet->getStyle($status_metadata_cell)->applyFromArray($styleBorder);
            
                    $row++;
            
                    if (isset($iv['subs'])) {
                        foreach ($iv['subs'] as $sk => $sv) {
                            $sheet->setCellValue('A' . $row, strval(($ik + 1) . '.' . ($sk + 1)));
                            $sheet->setCellValue('B' . $row, $sv['nama_indikator']);
                            $sheet->setCellValue('C' . $row, $sv['definisi_operasional']);
                            $sheet->setCellValue('D' . $row, $sv['nama_satuan']);
                            $sheet->setCellValue('E' . $row, $sv['nama_akses']);
                            $sheet->setCellValue('F' . $row, $sv['nama_periodik']);
                            $sheet->setCellValue('G' . $row, '');
                            $sheet->setCellValue('H' . $row, '');
                            $sheet->setCellValue('I' . $row, $iv['nama_skpd']);
                            $md = json_decode($iv['metadata'], true);
                            if (isset($md)) {
                                foreach ($md_cols as $mdk => $mdv) {
                                    $sheet->setCellValue($cell[9 + $mdk] . $row, $md[$mdv['key_metadata']]);
                                }
                            }
            
                            // Mendapatkan status metadata
                            $status_metadata = $this->indikator->get_status_metadata($iv['id_indikator']);
                            
                            // Tentukan lokasi sel untuk setiap baris data
                            $status_metadata_cell = $cell[9 + count($md_cols)] . $row;
                            
                            // Isi sel dengan status metadata
                            $sheet->setCellValue($status_metadata_cell, $status_metadata);
            
                            // Terapkan gaya border untuk sel status metadata
                            $sheet->getStyle($status_metadata_cell)->applyFromArray($styleBorder);
                            $row++;
                        }
                    }
                }
            
                $sheet->getStyle('A2:' . $cmd . '2')->applyFromArray($styleHeader);
                $sheet->getStyle('A2:' . $cmd . strval($row - 1))->applyFromArray($styleBorder);
                
                break;

            case 'data':
                $selected = $this->input->post('selected');
                $tahun = $this->indikator->get_tahun();
                $ind_data = [];
                if (isset($selected)) {
                    $selected = explode(',', $selected);
                    foreach ($selected as $ks => $vs) {
                        $ind_data[] = $this->indikator->get_indikator_full(encrypt_url(false, $vs));
                    };
                } else {
                    $ind_list = $this->download->get_indikator_list($id_skpd);
                    foreach ($ind_list as $ks => $vs) {
                        $ind_data[] = $this->indikator->get_indikator_full($vs['id_indikator']);
                    };
                }
                // $sheet->getStyle('A1')->applyFromArray($styleHeader);
                $sheet->getStyle('A1')->applyFromArray($styleBorder);
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true);
                $sheet->getColumnDimension('K')->setAutoSize(true);
                $sheet->getColumnDimension('L')->setAutoSize(true);

                $sheet->setCellValue('A1', 'Data ' . $skpd_detail['nama_skpd']);

                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Nama Indikator');
                $sheet->setCellValue('C2', 'Definisi Operasional');
                $sheet->setCellValue('D2', 'OPD');
                $sheet->setCellValue('E2', 'Satuan');
                foreach ($tahun as $mdk => $mdv) {
                    $cmd = $cell[5 + $mdk];
                    $sheet->setCellValue($cmd . '2', $mdv['nama_tahun']);
                    $sheet->getColumnDimension($cmd)->setAutoSize(true);
                }

                $no = 1;
                $row = 3;

                foreach ($ind_data as $ik => $iv) {
                    $sheet->setCellValue('A' . $row, $ik + 1);
                    $sheet->setCellValue('B' . $row, $iv['nama_indikator']);
                    $sheet->setCellValue('C' . $row, $iv['definisi_operasional']);
                    $sheet->setCellValue('D' . $row, $iv['nama_skpd']);
                    $sheet->setCellValue('E' . $row, $iv['nama_satuan']);
                    foreach ($tahun as $mdk => $mdv) {
                        $cmd = $cell[5 + $mdk];
                        $sheet->setCellValue($cmd . $row, $iv['data'][$mdk]['data_angka']);
                    }
                    $row++;

                    if ($iv['sub']['count'] != '0') {
                        foreach ($iv['sub']['subs'] as $sk => $sv) {
                            $sheet->setCellValue('A' . $row, strval(($ik + 1) . '.' . ($sk + 1)));
                            $sheet->setCellValue('B' . $row, $sv['nama_indikator']);
                            $sheet->setCellValue('C' . $row, $sv['definisi_operasional']);
                            $sheet->setCellValue('D' . $row, $iv['nama_skpd']);
                            $sheet->setCellValue('E' . $row, $sv['nama_satuan']);
                            foreach ($tahun as $mdk => $mdv) {
                                $cmd = $cell[5 + $mdk];
                                $sheet->setCellValue($cmd . $row, $sv['data'][$mdk]['data_angka']);
                            }

                            $row++;
                        }
                    }
                }

                $sheet->getStyle('A2:' . $cmd . '2')->applyFromArray($styleHeader);
                $sheet->getStyle('A2:' . $cmd . strval($row - 1))->applyFromArray($styleBorder);
                break;

            default:
                # code...
                break;
        }




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

        switch ($filetype) {
            case 'excel':
                $writer = new Xlsx($spreadsheet);

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename = "' . $skpd_detail['nama_skpd'] . ' - ' . $type . '.xlsx"');
                break;

            case 'pdf':
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf($spreadsheet);
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment;filename = "' . $skpd_detail['nama_skpd'] . ' - ' . $type . '.pdf"');
                break;

            default:
                # code...
                break;
        }
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function test()
    {
        $this->load->model('Download_model', 'download');
        $this->load->model('Indikator_model', 'indikator');
        // $data = $this->download->get_indikator_list(20);
        $data = $this->indikator->get_selected('keluaran', 70, 'str');
        debug($data);
    }
}
