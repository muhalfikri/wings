<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->auth->loginRestrict();
    }

	public function index()
	{
        $data['title']   = 'Data Produk';
        $data['content'] = 'index';
        $data['product'] = $this->db->get_where('tb_product', ['deleted_at' => 0])->result_array();

		$this->load->view('main/base', $data);
	}
}
