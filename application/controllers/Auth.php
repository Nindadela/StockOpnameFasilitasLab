<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        //validasi
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header');
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi success
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // menselect data yang ada di database
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        // jika user ada
        if ($user) {

            //cek status user
            if ($user['status'] == 'Aktif') {
                //cek password
                if ($password == $user['password']) {
                    $data = [
                        'username' => $user['username'],
                        'usr_nama' => $user['usr_nama'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    var_dump($this->session->userdata());
                    redirect('picAsset');
                    //validasi 
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Anda Salah!</div>');
                    redirect('auth');
                }
                //validasi
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username ini tidak Aktif!</div>');
                redirect('auth');
            }
            //validasi
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak valid!</div>');
            redirect('auth');
        }
    }
}
