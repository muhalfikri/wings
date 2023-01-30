<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->auth->loginRestrict();
        $this->load->helper('laporan');
    }

	public function index()
	{
        $data['title']     = 'Laporan';
        $data['content']   = 'index';
        $data['transaksi'] = $this->db->get_where('tb_transaction_header', ['deleted_at' => 0, 'status' => 1])->result_array();

		$this->load->view('main/base', $data);
	}
}
