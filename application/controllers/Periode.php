<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode extends CI_Controller
{
    public function index()
    {
        $this->load->view('master/periode');
    }
}
