<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth 
{
    function loginRestrict()
    {
        $CI =& get_instance();
        if (empty($CI->session->userdata('id'))) {
            redirect(base_url('home/index'));
        } else{
            return TRUE;
        }
    }
}
