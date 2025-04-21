<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("auth_model");
    }

    public function index()
    {
        redirect("https://sso.jombangkab.go.id/login");
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("https://sso.jombangkab.go.id/aplikasi");
    }

    public function user()
    {
        if ($this->auth_model->isNotLogin())
            redirect(base_url('auth'));
        $data = array(
            'title' => 'User',
            'li_1' => 'Auth',
            'li_2' => 'User'
        );
        $this->load->view('auth/auth-user', $data);
    }

    public function get_data()
    {
        if ($this->auth_model->isNotLogin())
            redirect(base_url('auth'));
        $result = $this->auth_model->build_datatables();
        echo json_encode($result);
        exit();
    }

    public function edit()
    {
        if ($this->auth_model->isNotLogin())
            redirect(base_url('auth'));
        $data = array(
            'act' => $this->input->post('act'),
            'edit' => ($this->input->post('act') == 'edit' ? true : false),
            'edit_data' => $this->auth_model->get_user_detail(encrypt_url(false, $this->input->post('id'))),
            'skpd' => $this->db->get('tbl_skpd')->result_array(),
            'role' => $this->db->get('auth_role')->result_array(),
        );
        $this->load->view('auth/auth-user-edit', $data);
    }

    public function reset()
    {
        if ($this->auth_model->isNotLogin())
            redirect(base_url('auth'));
        $data = array(
            'edit_data' => $this->auth_model->get_user_detail(encrypt_url(false, $this->input->post('id'))),
        );
        $this->load->view('auth/auth-user-reset', $data);
    }

    public function save()
    {
        if ($this->auth_model->isNotLogin())
            redirect(base_url('auth'));
        $raw_data = $this->security->xss_clean($this->input->post());
        $input = $this->auth_model->save_data($raw_data);
        header('Content-Type: application/json');
        echo json_encode($input);
        exit();
    }

    public function profile($type = null)
    {
        if ($this->auth_model->isNotLogin())
            redirect(base_url('auth'));
        switch ($type) {
            case null:
                $props = array(
                    'profile_data' => $this->auth_model->get_user_data()
                );
                $data = array(
                    'title' => 'Profile',
                    'li_1' => 'Auth',
                    'li_2' => 'Profile',
                    'props' => $props
                );
                $this->load->view('auth/auth-profile', $data);
                break;

            case 'edit_profile':
                $data = array(
                    'edit_data' => $this->auth_model->get_user_detail(encrypt_url(false, $this->input->post('id'))),
                );
                $this->load->view('auth/auth-profile-edit', $data);
                break;

            case 'edit_password':
                $data = array(
                    'edit_data' => $this->auth_model->get_user_detail(encrypt_url(false, $this->input->post('id'))),
                );
                $this->load->view('auth/auth-user-reset', $data);
                break;
            default:
                # code...
                break;
        }
    }
    // public function index()
    // {
    //     $data = array(
    //         'title' => 'Login'
    //     );
    //     $this->load->view('admin/auth-login', $data);
    // }
}
