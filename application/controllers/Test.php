<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('front_model', 'fmd');
		$this->fmd->clean_input();
		// $this->load->library('curl');
        $this->load->library('api_helper'); // Memuat library Api_helper
   
	}
    
	public function simpus()
	{
		$props = array(
			'list_gender' => $this->hitungGender()
		);
		$data = array(
			'props' => $props
		);
	
		
		$this->load->view('front/partials/simpus', $data);
	}

	public function hitungGender(){
		$api_helper = new Api_helper();

		$response = $api_helper->call_api('kunjungan/data', 'GET');
		$data = json_decode($response, true);

		// Inisialisasi jumlah pasien laki-laki dan perempuan
		$jumlah_laki_laki = 0;
		$jumlah_perempuan = 0;
		
		// Hitung jumlah pasien berdasarkan jenis kelamin
		foreach ($data as $pasien) {
			if ($pasien['gender'] == 'L') {
				$jumlah_laki_laki++;
			} elseif ($pasien['gender'] == 'P') {
				$jumlah_perempuan++;
			}
		}

		$data_to_insert = array(
			'nama_data' => 'jumlah_laki_laki',
			'total_data' => $jumlah_laki_laki,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Memasukkan data jumlah pasien laki-laki ke dalam database
		$this->fmd->insertOrUpdateData($data_to_insert);

		$data_to_insert = array(
			'nama_data' => 'jumlah_perempuan',
			'total_data' => $jumlah_perempuan,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Memasukkan data jumlah pasien perempuan ke dalam database
		$this->fmd->insertOrUpdateData($data_to_insert);

		// Mengembalikan data yang sesuai untuk ditampilkan pada view
		$data_chart = [$jumlah_laki_laki, $jumlah_perempuan];
		return $data_chart;
	}
}