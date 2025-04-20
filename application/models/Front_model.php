<?php

class Front_model extends CI_Model
{
	public function get_indikator($id)
	{
		# code...
	}

	public function stats()
	{
		$tdata = $this->db->select('count(*) as jumlah')->where(['status_verifikasi' => '1', 'id_akses' => '1'])->get('v_data_full')->row_array()['jumlah'];
		$turusan = $this->db->select('count(*) as jumlah')->get('tbl_urusan')->row_array()['jumlah'];
		$tprodusen = $this->db->select('count(*) as jumlah')->get('tbl_skpd')->row_array()['jumlah'];
		$tbuku = $this->db->select('count(*) as jumlah')->get('p_buku')->row_array()['jumlah'];
		$tinfografis = $this->db->select('count(*) as jumlah')->get('p_infografis')->row_array()['jumlah'];
		$rest = array(
			'total_data' => $tdata,
			'total_urusan' => $turusan,
			'total_produsen' => $tprodusen,
			'total_publikasi' => intval($tbuku) + intval($tinfografis),
		);
		return $rest;
	}

	public function get_indikator_data($id = null)
	{
		// $query = "SELECT DISTINCTROW t.nama_tahun, dt.* FROM tbl_tahun t LEFT JOIN ( SELECT df.id_data, df.id_indikator, df.id_verifikasi, df.data_angka, df.data_file, df.`timestamp`, df.status_verifikasi, df.keterangan, df.tahun FROM v_data_full df, ( SELECT tahun, max( `timestamp` ) AS `timestamp` FROM data WHERE id_indikator = '" . $id . "' GROUP BY tahun ) max_ts WHERE df.tahun = max_ts.tahun AND df.`timestamp` = max_ts.`timestamp` AND df.status_verifikasi = '1' ) dt ON t.nama_tahun = dt.tahun WHERE t.status = '1' ORDER BY nama_tahun";
		$query = "SELECT d.* FROM (SELECT DISTINCTROW t.nama_tahun, dt.* FROM tbl_tahun t LEFT JOIN (SELECT df.id_data, df.id_indikator, df.id_verifikasi, df.data_angka, df.data_file, df.`timestamp`, df.status_verifikasi, df.keterangan, df.tahun FROM v_data_full df, ( SELECT tahun, max( `timestamp` ) AS `timestamp` FROM data WHERE id_indikator = '" . $id . "' GROUP BY tahun ) max_ts WHERE df.tahun = max_ts.tahun AND df.`timestamp` = max_ts.`timestamp` AND df.status_verifikasi = '1' ) dt ON t.nama_tahun = dt.tahun WHERE t.STATUS = '1' ORDER BY nama_tahun ASC, id_data DESC ) d GROUP BY d.nama_tahun";
		$raw = $this->db->query($query)->result_array();
		return $raw;
	}

	public function get_urusan()
	{
		$urusan = $this->db->where('status', '1')->order_by('nama_urusan', 'asc')->get('tbl_urusan')->result_array();
		foreach ($urusan as $ku => $vu) {
			$urusan[$ku]['key'] = strtolower(replaceee($vu['nama_urusan']));

			$this->db->select('i.id_indikator, i.nama_indikator');
			$this->db->where(['id_urusan' => $vu['id_urusan'], 'i.id_akses' => '1', 'i.status_konfirmasi' => '1']);
			$this->db->from('urusan_indikator iu');
			$this->db->join('v_indikator i', 'i.id_indikator = iu.id_indikator');
			$ind_list = $this->db->order_by('i.nama_indikator', 'asc')->get()->result_array();
			$urusan[$ku]['list_ind'] = $ind_list;
		}

		return $urusan;
	}

	public function get_produsen()
	{
		$skpd = $this->db->order_by('nama_skpd', 'asc')->get('tbl_skpd')->result_array();
		foreach ($skpd as $ku => $vu) {
			$skpd[$ku]['key'] = strtolower(replaceee($vu['nama_skpd']));

			$this->db->select('i.id_indikator, i.nama_indikator');
			$this->db->where(['id_skpd' => $vu['id_skpd'], 'i.id_akses' => '1', 'i.status_konfirmasi' => '1']);
			$this->db->from('v_indikator i');
			$ind_list = $this->db->order_by('i.nama_indikator', 'asc')->get()->result_array();
			$skpd[$ku]['list_ind'] = $ind_list;
		}

		return $skpd;
	}

	public function get_indikator_list()
	{
		$this->db->select('v_indikator.*, v.count');
		$this->db->join('log_visit v', 'v.id_indikator = v_indikator.id_indikator', 'left');
		$this->db->order_by('nama_indikator', 'asc');
		// $list = $this->db->where(['status_konfirmasi' => '1', 'id_akses' => '1', 'level' => '1'])->order_by('nama_indikator', 'asc')->get('v_indikator')->result_array();
		$raw = $this->db->get('v_indikator')->result_array();
		$indikator = [];
		foreach ($raw as $kr => $vr) {
			if ($vr['status_konfirmasi'] == '1' && $vr['id_akses'] == '1' && $vr['level'] == '1') {
				$indikator[] = $vr;
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

	public function get_publikasi_buku($id = null)
	{
		$this->db->select('t.*, s.nama_skpd, f.filename AS file_name, fc.filename AS cover_name');
		$this->db->join('tbl_skpd s', 's.id_skpd = t.id_skpd', 'left');
		$this->db->join('files f', 'f.id_file = t.file', 'left');
		$this->db->join('files fc', 'fc.id_file = t.cover', 'left');
		if ($id != null) {
			$this->db->where('id_buku', $id);
		}
		$data = $this->db->get('p_buku t')->result_array();
		return $data;
	}
	public function get_publikasi_infografis($id = null)
	{
		$this->db->select('t.*, s.nama_skpd, f.filename AS file_name, fc.filename AS cover_name');
		$this->db->join('tbl_skpd s', 's.id_skpd = t.id_skpd', 'left');
		$this->db->join('files f', 'f.id_file = t.file', 'left');
		$this->db->join('files fc', 'fc.id_file = t.cover', 'left');
		if ($id != null) {
			$this->db->where('id_infografis', $id);
		}
		$data = $this->db->get('p_infografis t')->result_array();
		return $data;
	}

	public function get_publikasi_anggaran($id = null, $folder = null)
	{
		$this->db->select('t.*, s.nama_skpd, f.filename AS file_name, fc.filename AS cover_name');
		$this->db->join('tbl_skpd s', 's.id_skpd = t.id_skpd', 'left');
		$this->db->join('files f', 'f.id_file = t.file', 'left');
		$this->db->join('files fc', 'fc.id_file = t.cover', 'left');

		if ($id != null) {
			$this->db->where('id_anggaran', $id);
		}

		if ($folder != null) {
			$this->db->where('folder', $folder);
		}

		$data = $this->db->get('p_anggaran t')->result_array();
		return $data;
	}

	function update_counter($id)
	{
		$this->db->where('id_indikator', $id);
		$this->db->select('count');
		$count = $this->db->get('log_visit')->row_array();

		if (isset($count)) {
			$this->db->where('id_indikator', $id);
			$this->db->set('count', (intval($count['count']) + 1));
			$this->db->update('log_visit');
		} else {
			$this->db->insert('log_visit', array('id_indikator' => $id, 'count' => 1));
		}
	}

	function update_log_visitor()
	{
		$data = array(
			'ip' => $this->input->ip_address(),
			'uri' => $this->input->server('REQUEST_URI')
		);
		$this->db->insert('log_visitors', $data);

	}

	public function get_top_3()
	{
		$this->db->select('i.*');
		$this->db->join('v_indikator i', 'i.id_indikator = c.id_indikator', 'left');
		$this->db->limit(3);
		$this->db->order_by('c.count', 'desc');
		$this->db->order_by('c.timestamp', 'desc');
		$data = $this->db->get('log_visit c')->result_array();
		return $data;
	}

	public function clean_input()
	{
		$_POST = array();
		if (isset($_GET['q'])) {
			$_GET = array('q' => $_GET['q']);
		} else {
			$_GET = array();
		}
	}

	// Menambahkan model get geo urusan

	public function get_geo_urusan()
	{
		$urusan = $this->db->where('g_status', '1')->order_by('g_nama_urusan', 'asc')->get('tbl_geo_urusan')->result_array();
		foreach ($urusan as $ku => $vu) {
			$urusan[$ku]['key'] = strtolower(replaceee($vu['g_nama_urusan']));

			// $this->db->select('i.g_id_indikator, i.g_nama_indikator');
			$this->db->select('iu.g_id_postgres');
			$this->db->where(['g_id_urusan' => $vu['g_id_urusan']]);
			$this->db->from('g_urusan_indikator iu');
			// $this->db->join('g_indikator i', 'i.g_id_indikator = iu.g_id_indikator');
			// $ind_list = $this->db->order_by('i.g_nama_indikator', 'asc')->get()->result_array();
			$ind_list = $this->db->get()->result_array();
			$urusan[$ku]['list_ind'] = $ind_list;
		}

		return $urusan;
	}

	public function insertOrUpdateData($data)
	{
		// Gunakan parameterized query untuk menghindari SQL injection
		$sql = "INSERT INTO simpus_data (nama_data, kategori, total_data, updated_at) VALUES (?, ?, ?, ?)";
		$sql .= " ON DUPLICATE KEY UPDATE total_data = VALUES(total_data), updated_at = VALUES(updated_at)";

		// Jalankan query dengan menggunakan parameterized query
		$this->db->query($sql, array($data['nama_data'], $data['kategori'], $data['total_data'], $data['updated_at']));
	}

	public function get_api_response($nama_data)
	{
		// Inisialisasi array untuk menyimpan hasil
		$data = array();

		// Buat query dengan kondisi WHERE nama_data = ? dan urutkan berdasarkan updated_at DESC, ambil 1 data terbaru
		$sql = "SELECT response, nama_data, updated_at FROM api_responses WHERE nama_data = ? ORDER BY updated_at DESC LIMIT 1";

		// Jalankan query dengan menggunakan parameterized query
		$query = $this->db->query($sql, array($nama_data));

		// Jika ada hasil, simpan response dan nama_data ke dalam array $data
		if ($query->num_rows() > 0) {
			$row = $query->row_array(); // Mengambil baris hasil query sebagai array
			// Decode JSON pada kolom response
			$response_data = json_decode($row['response'], true);

			// Memecah data JSON dan mengambil informasi yang diperlukan berdasarkan nama_data
			if ($nama_data === 'Info Tempat Tidur RSUD') {
				if (isset($response_data['ruangan'])) {
					foreach ($response_data['ruangan'] as $ruangan) {
						$nama_ruangan = $ruangan['nama'];
						foreach ($ruangan['tempatrawat'] as $tempat_rawat) {
							$data[] = array(
								'nama_ruangan' => $nama_ruangan,
								'nama_tempat_rawat' => $tempat_rawat['nama'],
								'kelas' => $tempat_rawat['kelas'],
								'kapasitas' => $tempat_rawat['kapasitas'],
								'kosong' => $tempat_rawat['kosong'],
								'terisi' => $tempat_rawat['terisi']
							);
						}
					}
				}
			} elseif ($nama_data === 'Data Kunjungan Pasien') {
				if (isset($response_data['tujuan_pelayanan'])) {
					$data['tujuan_pelayanan'] = $response_data['tujuan_pelayanan'];
				}
				if (isset($response_data['umur'])) {
					$data['umur'] = $response_data['umur'];
				}
				if (isset($response_data['tanggal'])) {
					$data['tanggal'] = $response_data['tanggal'];
				}
			}
		}

		// Mengembalikan data
		return $data;
	}

	public function insertOrUpdateApiResponse($nama_data, $response)
	{
		$data = array(
			'nama_data' => $nama_data,
			'response' => $response
		);

		$sql = $this->db->insert_string('api_responses', $data) .
			' ON DUPLICATE KEY UPDATE response=VALUES(response), updated_at=CURRENT_TIMESTAMP';

		// Execute the query
		$this->db->query($sql);
	}


	public function get_last_updated_at($nama_data)
	{
		$sql = "SELECT updated_at FROM api_responses WHERE nama_data = ? ORDER BY updated_at DESC LIMIT 1";
		$query = $this->db->query($sql, array($nama_data));

		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row['updated_at'];
		} else {
			return null; // Atau sesuaikan dengan penanganan kesalahan yang Anda inginkan
		}
	}


	public function get_nama_kecamatan($nama_kecamatan)
	{
		// Membuat query untuk mencari indikator yang dimulai dengan 'Luas wilayah' dan diakhiri dengan nama kecamatan
		$this->db->like('nama_indikator', 'Luas wilayah');
		$this->db->like('nama_indikator', $nama_kecamatan, 'after'); // Mencari kecamatan di akhir

		// Menjalankan query dengan dua kondisi
		$this->db->where('nama_indikator LIKE', 'Luas wilayah%');
		$this->db->where('nama_indikator LIKE', '%' . $nama_kecamatan); // Menambahkan wildcard di depan nama kecamatan

		// Eksekusi query dan ambil data
		$data = $this->db->get('v_indikator')->result_array();

		return $data;
	}

	public function get_luas_kecamatan($nama_kecamatan)
	{
		// Query pertama: Ambil id_indikator berdasarkan nama kecamatan
		$this->db->where('nama_indikator LIKE', 'Luas wilayah%');
		$this->db->where('nama_indikator LIKE', '%Kecamatan ' . $nama_kecamatan); // Menambahkan wildcard di depan nama kecamatan

		// Eksekusi query dan ambil data (id_indikator)

		$indikator_data = $this->db->get('v_indikator')->result_array();


		if (empty($indikator_data)) {
			return []; // Jika tidak ada data, kembalikan array kosong
		}

		// Ambil ID dari hasil query pertama
		$id_indikator = $indikator_data[0]['id_indikator']; // Asumsikan menggunakan data pertama yang ditemukan
		$nama_indikator = $indikator_data[0]['nama_indikator']; // Asumsikan menggunakan data pertama yang ditemukan

		$query = "SELECT d.* 
			FROM (
				SELECT df.id_data, df.id_indikator, df.data_angka, df.data_file, df.`timestamp`, df.status_verifikasi, df.keterangan, df.tahun 
				FROM v_data_full df, (
					SELECT max(tahun) AS max_tahun, max(`timestamp`) AS `timestamp`
					FROM data 
					WHERE id_indikator = '" . $id_indikator . "'
					AND tahun = 2023
					GROUP BY tahun
				) max_ts 
				WHERE df.tahun = max_ts.max_tahun 
				AND df.`timestamp` = max_ts.`timestamp`
				AND df.status_verifikasi = '1'
				AND df.data_angka IS NOT NULL -- Hanya ambil data yang tidak NULL
				ORDER BY df.tahun ASC, df.id_data DESC -- Urutkan berdasarkan tahun terbaru
			) d 
			GROUP BY d.tahun 
			LIMIT 1";

		// Eksekusi query kedua
		$raw = $this->db->query($query)->result_array();

		// return $raw;
		return [
			'raw' => $raw,
			'nama_indikator' => $nama_indikator
		];
	}

	public function get_total_desa_kecamatan($nama_kecamatan)
	{
		// Query pertama: Ambil id_indikator dari indikator utama
		$this->db->select('id_indikator');
		$this->db->where('nama_indikator LIKE', 'Jumlah Desa%');
		$this->db->where('nama_indikator LIKE', '%Kecamatan ' . $nama_kecamatan);
		$indikator_data = $this->db->get('v_indikator')->result_array();

		if (empty($indikator_data)) {
			return []; // Kembalikan array kosong jika tidak ada data
		}

		// Simpan id_indikator dari hasil query pertama
		$id_indikator = $indikator_data[0]['id_indikator'];

		// Query kedua: Cari sub-indikator "Jumlah Desa" dengan id_main_indikator = id_indikator
		$this->db->select('id_indikator');
		$this->db->where('nama_indikator', 'Jumlah Desa');
		$this->db->where('id_main_indikator', $id_indikator);
		$sub_indikator_data = $this->db->get('v_indikator')->result_array();

		if (empty($sub_indikator_data)) {
			return []; // Kembalikan array kosong jika tidak ada data sub-indikator
		}

		// Simpan id_indikator dari hasil query kedua (sub-indikator)
		$id_sub_indikator = $sub_indikator_data[0]['id_indikator'];

		// Query ketiga: Ambil data dari v_data_full
		$query = "SELECT d.* 
			FROM (
				SELECT df.id_data, df.id_indikator, df.data_angka, df.data_file, df.`timestamp`, df.status_verifikasi, df.keterangan, df.tahun 
				FROM v_data_full df, (
					SELECT MAX(tahun) AS max_tahun, MAX(`timestamp`) AS max_timestamp
					FROM data 
					WHERE id_indikator = '" . $id_sub_indikator . "'
					AND tahun = 2023
					GROUP BY tahun
				) max_ts 
				WHERE df.tahun = max_ts.max_tahun 
				AND df.`timestamp` = max_ts.max_timestamp
				AND df.data_angka IS NOT NULL
				ORDER BY df.tahun ASC, df.id_data DESC
			) d 
			GROUP BY d.tahun 
			LIMIT 1";

		$raw = $this->db->query($query)->result_array();

		return [
			'raw' => $raw,
			'nama_indikator' => 'Jumlah Desa'
		];
	}

	public function save_request_data($data)
	{
		$md_cols = [];

		$input_data = $data;

		$input = $this->db->insert('req_data', $input_data);

		if ($input) {
			$result = array(
				'success' => true,
				'msg' => 'Data berhasil disimpan'
			);
			return $result;
		} else {
			$error = $this->db->error(); // Ambil pesan error dari database
			$result = array(
				'success' => false,
				'error' => 'Database error: ' . $error['message'] // Mengembalikan pesan error dari database
			);
			return $result;
		}
	}



}
