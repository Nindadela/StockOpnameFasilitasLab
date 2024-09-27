<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PicAsset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->library('session');
    }

    public function index()
    {
        // Retrieve user name from session
        $data['usr_nama'] = $this->session->userdata('usr_nama');

        // Cek apakah session berisi data user_name
        if (!$data['usr_nama']) {
            echo "Data usr_nama tidak ditemukan di session.";
            return;
        }

        $this->load->view('dashboard/picasset', $data);
    }
}
