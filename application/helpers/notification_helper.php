<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sweetalert'))
{
	function sweetalert($tipe = '', $status = '', $message = '')
    {
        $CI =& get_instance();
        return $CI->session->set_flashdata('alert', 'Swal.fire(
                                                        "'.$status.'",
                                                        "'.$message.'",
                                                        "'.$tipe.'"
                                                    );
                                            ');
    }
}