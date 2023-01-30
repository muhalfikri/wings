<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->auth->loginRestrict();
    }

	public function index()
	{
        $data['title']          = 'Transaksi';
        $data['content']        = 'index';
        $data['produk']         = $this->db->get_where('tb_product', ['deleted_at' => 0])->result_array();
        $data['transaksi']      = $this->db->get_where('tb_transaction_header', ['status' => 0])->row_array();
        if (!empty($data['transaksi'])) {
            $data['transaksi_item'] = $this->db->select('a.*, b.product_name')
                                               ->from('tb_transaction_detail AS a')
                                               ->join('tb_product AS b', 'a.product_code = b.product_code', 'left')
                                               ->where('document_number', $data['transaksi']['document_number'])
                                               ->get()->result_array();
        }
        
		$this->load->view('main/base', $data);
	}

    public function detail_produk()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('tb_product', ['id' => $id])->row_array();
        echo json_encode($data);
    }

    public function buy_item()
    {
        $id            = $this->input->post('id');
        $produk        = $this->db->get_where('tb_product', ['id' => $id])->row_array();
        $cek_transaksi = $this->db->get_where('tb_transaction_header', ['status' => 0])->row_array();
        if (empty($cek_transaksi)) {
            $document_number    = $this->document_number();
            $transaction_header = [
                'document_code'   => 'TRX',
                'document_number' => $document_number,
                'user'            => $this->session->userdata('user'),
                'date'            => date('Y-m-d'),
            ];

            $this->db->insert('tb_transaction_header', $transaction_header);

            $price = $produk['price'];
            if ($produk['discount'] != 0) {
                $price = $produk['price'] - (($produk['price'] * 10) / 100);
            }

            $transaction_detail = [
                'document_code'   => 'TRX',
                'document_number' => $document_number,
                'product_code'    => $produk['product_code'],
                'price'           => $price,
                'quantity'        => 1,
                'unit'            => $produk['unit'],
                'subtotal'        => $price,
                'currency'        => $produk['currency']
            ];

            $this->db->insert('tb_transaction_detail', $transaction_detail);

            $total = $this->db->select_sum('subtotal')
                              ->from('tb_transaction_detail')
                              ->where('document_number', $document_number)
                              ->get()->row_array();
            
            $this->db->where('document_number', $document_number)
                     ->update('tb_transaction_header', [
                        'total' => $total['subtotal']
                     ]);
        } else {
            $document_number = $cek_transaksi['document_number'];
            $price = $produk['price'];
            if ($produk['discount'] != 0) {
                $price = $produk['price'] - (($produk['price'] * 10) / 100);
            }

            $cek_item = $this->db->get_where('tb_transaction_detail', [
                                                                        'product_code'    => $produk['product_code'],
                                                                        'document_number' => $document_number
                                                                      ])->row_array();

            if (empty($cek_item)) {
                $transaction_detail = [
                    'document_code'   => 'TRX',
                    'document_number' => $document_number,
                    'product_code'    => $produk['product_code'],
                    'price'           => $price,
                    'quantity'        => 1,
                    'unit'            => $produk['unit'],
                    'subtotal'        => $price,
                    'currency'        => $produk['currency']
                ];
    
                $this->db->insert('tb_transaction_detail', $transaction_detail);
    
                $total = $this->db->select_sum('subtotal')
                                  ->from('tb_transaction_detail')
                                  ->where('document_number', $document_number)
                                  ->get()->row_array();
                
                $this->db->where('document_number', $document_number)
                         ->update('tb_transaction_header', [
                            'total' => $total['subtotal']
                         ]);
            } else {
                $qty = $cek_item['quantity'] + 1;
                $transaction_detail = [
                    'document_code'   => 'TRX',
                    'document_number' => $document_number,
                    'product_code'    => $produk['product_code'],
                    'price'           => $price,
                    'quantity'        => $qty,
                    'unit'            => $produk['unit'],
                    'subtotal'        => $price * $qty,
                    'currency'        => $produk['currency']
                ];
    
                $this->db->where('product_code', $produk['product_code']);
                $this->db->where('document_number', $document_number);
                $this->db->update('tb_transaction_detail', $transaction_detail);
    
                $total = $this->db->select_sum('subtotal')
                                  ->from('tb_transaction_detail')
                                  ->where('document_number', $document_number)
                                  ->get()->row_array();
                
                $this->db->where('document_number', $document_number)
                         ->update('tb_transaction_header', [
                            'total' => $total['subtotal']
                         ]);
            }
        }

        $response = [
            'status' => 'success',
            'document_number' => $document_number
        ];

        echo json_encode($response);
    }

    public function hapus_item($id = '')
    {
        $this->db->where('id', $id)
                 ->delete('tb_transaction_detail');

        $total = $this->db->select_sum('subtotal')
                                  ->from('tb_transaction_detail')
                                  ->where('document_number', $document_number)
                                  ->get()->row_array();
                
        $this->db->where('document_number', $document_number)
                    ->update('tb_transaction_header', [
                    'total' => $total['subtotal']
                    ]);

        sweetalert('success', 'Berhasil!', 'Item Produk telah dihapus.');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function change_qty()
    {
        $id  = $this->input->post('id');
        $qty = $this->input->post('qty');

        $cek_item = $this->db->get_where('tb_transaction_detail', ['id' => $id])->row_array();
        $price    = $cek_item['price'] * $qty;
        $transaction_detail = [
            'quantity'        => $qty,
            'subtotal'        => $price,
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_transaction_detail', $transaction_detail);

        $total = $this->db->select_sum('subtotal')
                            ->from('tb_transaction_detail')
                            ->where('document_number', $cek_item['document_number'])
                            ->get()->row_array();
        
        $this->db->where('document_number', $cek_item['document_number'])
                    ->update('tb_transaction_header', [
                        'total' => $total['subtotal']
                    ]);

        $response = [
            'price' => $price,
            'total' => $total['subtotal']
        ];

        echo json_encode($response);
    }

    public function proses_selesai($document_number = '')
    {
        $cek_item = $this->db->get_where('tb_transaction_detail', ['document_number' => $document_number])->num_rows();
        if ($cek_item > 0) {
            $this->db->where('document_number', $document_number)
                     ->update('tb_transaction_header', ['status' => 1]);
            sweetalert('success', 'Berhasil!', 'Transaksi telah selesai.');
        } else {
            sweetalert('warning', 'Maaf!', 'Item transaksi masih kosong.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function document_number()
    {
        $this->db->select('RIGHT(document_number,2) as document_number', FALSE);
        $this->db->order_by('document_number','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('tb_transaction_header');
        if($query->num_rows() <> 0){          
            $data = $query->row();      
            $kode = intval($data->document_number) + 1; 
        }
        else{      
            $kode = 1;
        }

        $tgl=date('dmY'); 
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);    
        return $batas;  
    }
}
