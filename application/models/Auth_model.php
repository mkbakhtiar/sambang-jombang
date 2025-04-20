<?php

class Auth_model extends CI_Model
{
	private $_table = 'auth_users';

	public function doLogin()
	{
		// Check if this is a Google login
		if ($this->input->post('google_login') === 'true') {
			return $this->google_login();
		}
		
		// Regular login process
		$admin = false;
		$admin2 = false;

		$post = $this->input->post();

		$this->db->where('username', $post['username']);
		$user = $this->db->get($this->_table)->row_array();

		if ($user) {
			$isPasswordTrue = md5($post['password']) == $user['password'];
			if ($isPasswordTrue) {
				unset($user['password']);
				$user['id_user'] = encrypt_url(true, $user['id_user']);
				$user['nama_skpd'] = $this->db->where('id_skpd', $user['id_skpd'])->get('tbl_skpd')->row_array()['nama_skpd'];
				if ($user['id_role'] == '1') {
					$admin = true;
				} else if ($user['id_role'] == '4') {
					$admin2 = true;
				} else {
					$admin = false;
					$admin2 = false;
				}
				$data = array(
					'user_logged' => $user,
					'admin' => $admin,
					'admin2' => $admin2,
					'detail' => $user
				);
				$this->session->set_userdata($data);
				return true;
			}
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Username/Password Salah</div></div>');
		return false;
	}

	public function process_google_login(){
		$client = new Google_Client(['client_id' => '583603102197-63th62gs4mkfqklk2cfdmm57pvmf32u3.apps.googleusercontent.com']);
        
        $id_token = $this->input->post('id_token');
    
        if (!$id_token) {
            return ['success' => false, 'message' => 'Token tidak ditemukan'];
        }
        
        try {
            $payload = $client->verifyIdToken($id_token);
                        
            if ($payload) {
                // Get user info from Google
                $google_id = $payload['sub'];
                $email = $payload['email'];
                $name = isset($payload['name']) ? $payload['name'] : '';
                $picture = isset($payload['picture']) ? $payload['picture'] : '';
                
                // Check if the user exists by Google ID or email
                $this->db->group_start()
                    ->where('google_id', $google_id)
                    ->or_where('email', $email)
                    ->group_end();
                $user = $this->db->get($this->_table)->row_array();
                
                // If user doesn't exist, register a new user automatically
                if (!$user) {
                    
                    // Create new user
                    $new_user = [
                        'google_id' => $google_id,
                        'email' => $email,
                        'nama_lengkap' => $name,
                        'profile_picture' => $picture,
                        'id_role' => NULL, // Default role for new users
                        'id_skpd' => NULL, // Default SKPD, adjust as needed
                        'status' => 0, // Active by default
                        'date_created' => date('Y-m-d H:i:s'),
                        'last_login' => date('Y-m-d H:i:s')
                    ];
                    
                    $this->db->insert($this->_table, $new_user);
                    $user_id = $this->db->insert_id();
                    
                    // Get the newly created user
                    $user = $this->db->where('id_user', $user_id)->get($this->_table)->row_array();
                    
                    // Set session data
                    $user['id_user'] = encrypt_url(true, $user['id_user']);
                    
                    $data = array(
                        'user_logged' => $user,
                        'detail' => $user
                    );
                    
                    $this->session->set_userdata($data);
                    
                    // Return response indicating this is a new registration
                    return [
                        'success' => true,
                        'isNewRegistration' => true,
                        'message' => 'Akun berhasil terdaftar'
                    ];
                    return;
                } else {
                    // Update Google ID if it's null but email matches
                    if (empty($user['google_id'])) {
                        $this->db->where('id_user', $user['id_user']);
                        $this->db->update($this->_table, ['google_id' => $google_id]);
                    }
                    
                    // Update profile picture and last login time
                    $this->db->where('id_user', $user['id_user']);
                    $this->db->update($this->_table, [
                        'profile_picture' => $picture,
                        'last_login' => date('Y-m-d H:i:s')
                    ]);
                    
                    // Check if user is active
                    if ($user['status'] == 0) {
						
						$nama_skpd = $this->db->where('id_skpd', $user['id_skpd'])
                            ->get('tbl_skpd')
                            ->row_array()['nama_skpd'] ?? 'Unknown';
						$user['nama_skpd'] = $nama_skpd;
						
						$data = array(
							'user_logged' => $user,
							'detail' => $user
						);
						
						$this->session->set_userdata($data);

                        return [
							'success' => true,
							'isVerified' => false,
							'isNewRegistration' => false,
						];
                    }
                    
                    // User exists and active, log them in
                    $admin = ($user['id_role'] == '1');
                    $admin2 = ($user['id_role'] == '4');
                    
                    // Get SKPD name
                    $nama_skpd = $this->db->where('id_skpd', $user['id_skpd'])
                                        ->get('tbl_skpd')
                                        ->row_array()['nama_skpd'] ?? 'Unknown';
                    
                    // Set session data
                    $user['id_user'] = encrypt_url(true, $user['id_user']);
                    $user['nama_skpd'] = $nama_skpd;
                    
                    $data = array(
                        'user_logged' => $user,
                        'admin' => $admin,
                        'admin2' => $admin2,
                        'detail' => $user
                    );
                    
                    $this->session->set_userdata($data);
                    
                    // Return response for existing user login
                    return [
                        'success' => true,
                        'isNewRegistration' => false,
						'isVerified' => true,
                    ];
                }
            } else {
                return ['success' => false, 'message' => 'Token tidak valid'];
            }
        }   catch (Exception $e) {
            return [
                'success' => false, 
                'message' => 'Error: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ];
        }
	}


	public function isNotLogin()
	{
		return $this->session->userdata('user_logged') === null;
	}

	function build_datatables()
	{
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
		$valid_columns = ['id_user', 'username', 'nama_role', 'nama_skpd', 'nama_lengkap', 'nip', 'email', 'no_hp'];
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
		$this->db->join('auth_role r', 'r.id_role = a.id_role', 'left');
		$this->db->join('tbl_skpd s', 's.id_skpd = a.id_skpd', 'left');
		$raw_data = $this->db->get('auth_users a');
		$data = array();
		$no = $start + 1;
		foreach ($raw_data->result_array() as $rows) {
			$encrypted_id = encrypt_url(true, $rows['id_user']);
			$row = [$no++];
			$row[] = $rows['username'];
			$row[] = $rows['nama_role'];
			$row[] = $rows['nama_skpd'];
			$row[] = $rows['nama_lengkap'];
			$row[] = $rows['nip'];
			$row[] = $rows['email'];
			$row[] = $rows['no_hp'];
			$row[] = [
				'<button class="btn btn-sm btn-info btn-detail" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button> ' .
					'<button class="btn btn-sm btn-warning btn-edit" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> ' .
					'<button class="btn btn-sm btn-danger btn-delete" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash-alt"></i></button> ' .
					'<button class="btn btn-sm btn-dark btn-reset" data-id="' . $encrypted_id . '" data-toggle="tooltip" data-placement="top" title="Reset Password"><i class="fas fa-sync-alt"></i></button>'
			];
			$data[] = $row;
		}
		$total_data = $this->db->select("COUNT(*) as num")->get('auth_users')->row()->num;
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_data,
			"recordsFiltered" => $total_data,
			"data" => $data
		);
		return $output;
		// exit();
	}

	public function get_user_detail($id = null)
	{
		$raw = $this->db->where('id_user', $id)->get('auth_users')->row_array();
		$raw['id_user'] = encrypt_url(true, $id);
		unset($raw['password']);
		return $raw;
	}

	public function save_data($data)
	{
		switch ($data['act']) {
			case 'add':
				$insert_data = $data;
				unset($insert_data['act']);
				$insert_data['password'] = md5($insert_data['password']);
				$submit = $this->db->insert('auth_users', $insert_data);
				break;

			case 'edit':
				$update_data = $data;
				unset($update_data['act']);
				$update_data['id_user'] = encrypt_url(false, $update_data['id_user']);
				$this->db->where('id_user', $update_data['id_user']);
				$submit = $this->db->update('auth_users', $update_data);
				break;

			case 'reset':
				$newPass = array(
					'password' => md5($data['password'])
				);
				$this->db->where('id_user', encrypt_url(false, $data['id_user']));
				$submit = $this->db->update('auth_users', $newPass);
				break;
		}

		if ($submit) {
			$result = array(
				'status' => 'success',
				'message' => 'Berhasil'
			);
		} else {
			$result = array(
				'status' => 'failed',
				'message' => 'Gagal'
			);
		}

		return $result;
	}

	public function get_user_data()
	{
		$id = encrypt_url(false, $this->session->detail['id_user']);
		$this->db->select('u.id_skpd, u.id_role, u.username, u.nama_lengkap, u.email, u.no_hp, u.nip, s.nama_skpd');
		$this->db->where('id_user', $id);
		$this->db->join('tbl_skpd s', 's.id_skpd = u.id_skpd');
		$data = $this->db->get('auth_users u')->row_array();
		return $data;
	}
	
	public function loginSso($username)
	{
		$this->db->where('username', $username);
		$user = $this->db->get($this->_table)->row_array();
		if ($user == null) {
			return false;
		}
	
    	$user['id_user'] = encrypt_url(true, $user['id_user']);
    	$user['nama_skpd'] = $this->db->where('id_skpd', $user['id_skpd'])->get('tbl_skpd')->row_array()['nama_skpd'];
    
    	$admin = ($user['id_role'] == '1');
    	$admin2 = ($user['id_role'] == '4');
    
    	$data = array(
    		'user_logged' => $user,
    		'admin' => $admin,
    		'admin2' => $admin2,
    		'detail' => $user
    	);
    	$this->session->set_userdata($data);
    	return true;
		

		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Username/Password Salah</div></div>');
		return false;
	}
}
