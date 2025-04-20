<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('memory_limit', '600M');
// Memuat Api_Helper dari folder yang sama dengan kontroler
// require_once(APPPATH . 'controllers/api_helper.php');

class Api extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('front_model', 'fmd');
		$this->fmd->clean_input();

		$this->load->helper('api_helper');
	}
    
	public function hitungKeboan()
	{
		$api_helper = new Api_helper();
		$response = $api_helper->call_api('kunjungan/data', 'GET');
		$data = json_decode($response, true);

		// Inisialisasi array asosiatif untuk menyimpan jumlah pasien berdasarkan jenis kelamin, tujuan pelayanan, dan umur
		$jumlah_data = array();

		// Iterasi data pasien dan akumulasikan jumlah pasien berdasarkan jenis kelamin, tujuan pelayanan, dan umur
		foreach ($data as $pasien) {
			// Hitung umur pasien
			$dob = new DateTime($pasien['dob']);
			$now = new DateTime();
			$umur = $now->diff($dob)->y;

			// Tambahkan umur ke dalam array jumlah data
			$this->tambahData($jumlah_data, 'umur_' . $umur);

			// Hitung jumlah pasien berdasarkan jenis kelamin
			$gender = $pasien['gender'];
			$this->tambahData($jumlah_data, 'gender_' . $gender);

			// Hitung jumlah pasien berdasarkan tujuan pelayanan
			$tujuan = $pasien['tujuan'];
			$this->tambahData($jumlah_data, 'tujuan_' . $tujuan);

			$kategori = $pasien['kategori'];
			$this->tambahData($jumlah_data, 'kategori_' . $kategori);
		}

		// Input data ke dalam database dengan menambahkan add-ons di belakang nama data
		foreach ($jumlah_data as $nama_data => $jumlah) {
			$cat = explode('_', $nama_data)[0];
			$nama_baru = explode('_', $nama_data)[1];
			$data_to_insert = array(
				'nama_data' => $nama_baru . '_keboan',
				'kategori' => $cat, // Gunakan nilai $kategori langsung sebagai kategori
				'total_data' => $jumlah,
				'updated_at' => date('Y-m-d H:i:s')
			);
			// Memasukkan data jumlah pasien ke dalam database
			$this->fmd->insertOrUpdateData($data_to_insert);
		}       

		var_dump($data);

		// Mengembalikan array asosiatif jumlah pasien berdasarkan jenis kelamin, tujuan pelayanan, dan umur
		return $jumlah_data;
	}
	
	public function getDummy(){
	    $api_helper = new Api_helper();
	    $dummy = $api_helper->get_dummy_token();
        var_dump($dummy);

	}

	private function tambahData(&$jumlah_data, $cat)
	{
		if (!isset($jumlah_data[$cat])) {
			$jumlah_data[$cat] = 1;
		} else {
			$jumlah_data[$cat]++;
		}
	}
	
	
	public function rajal(){
        $url = "https://apirs.rsudjombang.com/realtime/infokunjunganrajal";
        $ch = curl_init($url);

        $headers = array(
            // 'Authorization: Bearer ' . $api,
            'Content-Type: application/json'
        );
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $result = curl_exec($ch);
        if($result === false) {
            $error = curl_error($ch);
            echo "Curl error: " . $error;
        } else {
            print_r($result);
        }
    
        curl_close($ch);

        //code 200 sukses, selain itu berarti error
    }

    public function tempattidur(){
        $url = "https://apirs.rsudjombang.com/realtime/infott";
        $ch = curl_init($url);
		$nama_data = 'Info Tempat Tidur RSUD';

        $headers = array(
            'Content-Type: application/json',
            'consid: 82096',
            'userkey: 773037345128297fc3c4aafb66c187ad97ef582dcd04cb0e298d47eedd6bfd8f',
            'signature: LmuHxibAumrIOHPxZ1m6eU8M2PWLscKjjdXTJx2d9Wk=',
            'timestamp: 1715828416'
        );

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
        if ($result === false) {
            $error = curl_error($ch);
            echo "Curl error: " . $error;
        } else {
            // Parsing JSON untuk mengambil bagian "response"
            $decoded_response = json_decode($result, true);
            if (isset($decoded_response['response'])) {
                $response_only = json_encode($decoded_response['response']);

                // Panggil model untuk menyimpan atau memperbarui data
                $this->fmd->insertOrUpdateApiResponse($nama_data, $response_only);
                echo "Data processed successfully";
            } else {
                echo "Invalid response from API";
            }
        }

        curl_close($ch);
    }
    
    public function simpuskunjungan()
	{
		$api_helper = new Api_helper();
		$response = $api_helper->call_api('kunjungan/data', 'GET');
		$data = json_decode($response, true);

		if ($data === null) {
			echo "Invalid JSON response";
			return;
		}

		// Mengembalikan array asosiatif jumlah pasien berdasarkan tujuan pelayanan, umur, dan tanggal
		$jumlah_data = array(
			'tujuan_pelayanan' => array(),
			'umur' => array(),
			'tanggal' => array()
		);

		foreach ($data as $item) {
			// Pengelompokan berdasarkan tujuan pelayanan
			if (isset($item['tujuan_kedatangan'])) {
				if (!isset($jumlah_data['tujuan_pelayanan'][$item['tujuan_kedatangan']])) {
					$jumlah_data['tujuan_pelayanan'][$item['tujuan_kedatangan']] = 0;
				}
				$jumlah_data['tujuan_pelayanan'][$item['tujuan_kedatangan']]++;
			}

			// Pengelompokan berdasarkan umur
			$umur = intval($item['age_year']);
			if ($umur <= 5) {
				$umur_kategori = '0-5';
			} elseif ($umur <= 12) {
				$umur_kategori = '6-12';
			} elseif ($umur <= 18) {
				$umur_kategori = '13-18';
			} elseif ($umur <= 35) {
				$umur_kategori = '19-35';
			} elseif ($umur <= 60) {
				$umur_kategori = '36-60';
			} else {
				$umur_kategori = '60+';
			}

			if (!isset($jumlah_data['umur'][$umur_kategori])) {
				$jumlah_data['umur'][$umur_kategori] = 0;
			}
			$jumlah_data['umur'][$umur_kategori]++;

			// Pengelompokan berdasarkan tanggal
			if (isset($item['tanggal'])) {
				if (!isset($jumlah_data['tanggal'][$item['tanggal']])) {
					$jumlah_data['tanggal'][$item['tanggal']] = 0;
				}
				$jumlah_data['tanggal'][$item['tanggal']]++;
			}
		}

		$nama_data = 'Data Kunjungan Pasien';
		$response_only = json_encode($jumlah_data);

		// Panggil model untuk menyimpan atau memperbarui data
		$this->fmd->insertOrUpdateApiResponse($nama_data, $response_only);

		echo "Data processed successfully";

		return $jumlah_data;
	}
}