<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    public function __construct() 
    {
        parent::__construct();
    }

	public function index()
	{
		$this->load->view('auth/login');
	}

    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek_data = $this->db->select('user, password')
                             ->from('tb_users')
                             ->where('user', $username)
                             ->where('deleted_at', 0)
                             ->get()->row_array();
        if (!empty($cek_data)) {
            $cek_pass = $this->db->select('*')
                                ->from('tb_users')
                                ->where('user', $username)
                                ->where('password', md5($password))
                                ->where('deleted_at', 0)
                                ->get()->row_array();
            if (!empty($cek_pass)) {
                $session = [
                    'id'        => $cek_pass['id'],
                    'user'      => $cek_pass['user'],
                    'logged_in' => TRUE
                ];

                $this->session->set_userdata($session);

                $data['status']  = 'success';
                $data['message'] = '<div class="alert alert-success radius shadow" role="alert">
                                        Berhasil! Selamat Datang '.$cek_pass['user'].'
                                    </div>';
                $data['url']     = base_url('dashboard');
            } else {
                $data['status']  = 'error';
                $data['message'] = '<div class="alert alert-danger radius shadow" role="alert">
                                        Error! Email & Password Anda Salah.
                                    </div>';
            }
        } else{
            $data['status']  = 'error';
            $data['message'] = '<div class="alert alert-danger radius shadow" role="alert">
                                    Error! Email & Password tidak terdaftar.
                                </div>';
        }

        echo json_encode($data);
    }

    public function logout()
    {
        session_destroy();
        redirect(base_url());
    }
}
