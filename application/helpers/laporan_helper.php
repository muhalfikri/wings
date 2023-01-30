<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('item_list'))
{
	function item_list($document_number)
    {
        $res = '';
        $CI =& get_instance();
        $cek_item = $CI->db->select('a.*, b.product_name')
                           ->from('tb_transaction_detail AS a')
                           ->join('tb_product AS b', 'a.product_code = b.product_code')
                           ->where('a.document_number', $document_number)
                           ->get()->result_array();
        if (!empty($cek_item)) {
            foreach ($cek_item as $key => $value) {
                $res .= $value['product_name'].' X '.$value['quantity'].'<br>';
            }
        } else {
            $res = '-';
        }

        return $res;
    }
}
