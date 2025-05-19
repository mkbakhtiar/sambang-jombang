<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class User extends RestController {

    public function __construct() {
        parent::__construct();
        $this->load->model('api/User_model', 'User_model');
        $this->load->library('jwt_auth');
        
        // Terapkan middleware JWT pada semua method kecuali yang dikecualikan
        $excluded_methods = ['login'];
        if (!in_array($this->router->fetch_method(), $excluded_methods)) {
            $this->jwt_auth->auth_check();
        }
    }

    /**
     * API untuk mendapatkan daftar user (hanya admin)
     * @method GET
     * @return Response
     */
    public function list_get() {
        // Cek apakah user adalah admin (id_role = 1)
        $this->jwt_auth->role_check([1]);
        
        $users = $this->User_model->get_all_users();
        
        if ($users) {
            $this->response([
                'status' => true,
                'message' => 'Daftar user berhasil diambil',
                'data' => $users
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data user'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    /**
     * API untuk mendapatkan detail user (admin atau diri sendiri)
     * @method GET
     * @param int $id
     * @return Response
     */
    public function detail_get($id = null) {
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'ID user diperlukan'
            ], RestController::HTTP_BAD_REQUEST);
            return;
        }
        
        // Cek apakah user adalah admin atau mengakses data dirinya sendiri
        if ($this->user_data->id_role != 1 && $this->user_data->id_user != $id) {
            $this->response([
                'status' => false,
                'message' => 'Anda tidak memiliki akses untuk melihat data user ini'
            ], RestController::HTTP_FORBIDDEN);
            return;
        }
        
        $user = $this->User_model->get_user_by_id($id);
        
        if ($user) {
            $this->response([
                'status' => true,
                'message' => 'Detail user berhasil diambil',
                'data' => $user
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    /**
     * API untuk update profil user (admin atau diri sendiri)
     * @method PUT
     * @param int $id
     * @return Response
     */
    public function update_put($id = null) {
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'ID user diperlukan'
            ], RestController::HTTP_BAD_REQUEST);
            return;
        }
        
        // Cek apakah user adalah admin atau mengakses data dirinya sendiri
        if ($this->user_data->id_role != 1 && $this->user_data->id_user != $id) {
            $this->response([
                'status' => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah data user ini'
            ], RestController::HTTP_FORBIDDEN);
            return;
        }
        
        // Ambil input
        $data = [
            'nama_lengkap' => $this->put('nama_lengkap'),
            'email' => $this->put('email'),
            'no_hp' => $this->put('no_hp'),
            'nip' => $this->put('nip')
        ];
        
        // Hanya admin yang bisa update role dan status
        if ($this->user_data->id_role == 1) {
            $role = $this->put('id_role');
            $status = $this->put('status');
            
            if ($role !== null) {
                $data['id_role'] = $role;
            }
            
            if ($status !== null) {
                $data['status'] = $status;
            }
        }
        
        // Hapus field kosong
        foreach ($data as $key => $value) {
            if ($value === null) {
                unset($data[$key]);
            }
        }
        
        if (empty($data)) {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data yang diupdate'
            ], RestController::HTTP_BAD_REQUEST);
            return;
        }
        
        $updated = $this->User_model->update_user($id, $data);
        
        if ($updated) {
            $this->response([
                'status' => true,
                'message' => 'Data user berhasil diupdate'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengupdate data user'
            ], RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * API untuk ubah password (admin atau diri sendiri)
     * @method POST
     * @return Response
     */
    public function change_password_post() {
        $id_user = $this->post('id_user');
        $old_password = $this->post('old_password');
        $new_password = $this->post('new_password');
        $confirm_password = $this->post('confirm_password');
        
        // Validasi input
        if (empty($id_user) || empty($new_password) || empty($confirm_password)) {
            $this->response([
                'status' => false,
                'message' => 'Semua field harus diisi'
            ], RestController::HTTP_BAD_REQUEST);
            return;
        }
        
        // Cek apakah user adalah admin atau mengakses data dirinya sendiri
        if ($this->user_data->id_role != 1 && $this->user_data->id_user != $id_user) {
            $this->response([
                'status' => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah password user ini'
            ], RestController::HTTP_FORBIDDEN);
            return;
        }
        
        // Cek konfirmasi password
        if ($new_password != $confirm_password) {
            $this->response([
                'status' => false,
                'message' => 'Konfirmasi password tidak sesuai'
            ], RestController::HTTP_BAD_REQUEST);
            return;
        }
        
        // Jika bukan admin, harus verifikasi password lama
        if ($this->user_data->id_role != 1) {
            if (empty($old_password)) {
                $this->response([
                    'status' => false,
                    'message' => 'Password lama harus diisi'
                ], RestController::HTTP_BAD_REQUEST);
                return;
            }
            
            $user = $this->User_model->get_user_by_id($id_user);
            
            if (!password_verify($old_password, $user->password)) {
                $this->response([
                    'status' => false,
                    'message' => 'Password lama salah'
                ], RestController::HTTP_UNAUTHORIZED);
                return;
            }
        }
        
        // Update password
        $updated = $this->User_model->reset_password($id_user, $new_password);
        
        if ($updated) {
            $this->response([
                'status' => true,
                'message' => 'Password berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengubah password'
            ], RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}