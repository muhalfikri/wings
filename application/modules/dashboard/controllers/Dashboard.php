<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->auth->loginRestrict();
    }

	public function index()
	{
        $data['title']      = 'Dashboard';
        $data['content']    = 'index';
        $data['produk']     = $this->db->get_where('tb_product', ['deleted_at' => 0])->num_rows();
        $data['transaksi']  = $this->db->get_where('tb_transaction_header', ['deleted_at' => 0, 'status' => 1])->num_rows();
        $data['pendapatan'] = $this->db->select_sum('total')
                                       ->from('tb_transaction_header')
                                       ->where(['deleted_at' => 0, 'status' => 1])
                                       ->get()->row_array();

		$this->load->view('main/base', $data);
	}
}
