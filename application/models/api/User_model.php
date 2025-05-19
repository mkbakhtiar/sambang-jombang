<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'auth_users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all users
     * @return array
     */
    public function get_all_users() {
        $this->db->select('id_user, id_skpd, id_role, username, nama_lengkap, email, no_hp, nip, timestamp, profile_picture, date_created, status, last_login');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get user by ID
     * @param int $id
     * @return object
     */
    public function get_user_by_id($id) {
        $this->db->select('id_user, id_skpd, id_role, username, nama_lengkap, email, no_hp, nip, timestamp, profile_picture, date_created, status, last_login');
        $this->db->from($this->table);
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get user by username
     * @param string $username
     * @return object
     */
    public function get_user_by_username($username) {
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get user by email
     * @param string $email
     * @return object
     */
    public function get_user_by_email($email) {
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get user by Google ID
     * @param string $google_id
     * @return object
     */
    public function get_user_by_google_id($google_id) {
        $this->db->from($this->table);
        $this->db->where('google_id', $google_id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Create new user
     * @param array $data
     * @return int
     */
    public function create_user($data) {
        // If password is provided, hash it
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        
        // Set date created
        $data['date_created'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update user
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_user($id, $data) {
        $this->db->where('id_user', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete user
     * @param int $id
     * @return bool
     */
    public function delete_user($id) {
        $this->db->where('id_user', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Update last login
     * @param int $id
     * @return bool
     */
    public function update_last_login($id) {
        $data = [
            'last_login' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_user', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Reset password
     * @param int $id
     * @param string $password
     * @return bool
     */
    public function reset_password($id, $password) {
        $data = [
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];
        
        $this->db->where('id_user', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Check if username exists
     * @param string $username
     * @return bool
     */
    public function username_exists($username) {
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    /**
     * Check if email exists
     * @param string $email
     * @return bool
     */
    public function email_exists($email) {
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    /**
     * Verify user credentials
     * @param string $username
     * @param string $password
     * @return object|bool
     */
    public function verify_credentials($username, $password) {
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $this->db->where('status', 1); // Only active users
        $query = $this->db->get();
        
        if ($query->num_rows() === 0) {
            return false;
        }
        
        $user = $query->row();
        
        if (password_verify($password, $user->password)) {
            return $user;
        }
        
        return false;
    }
}