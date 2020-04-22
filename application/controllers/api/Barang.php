<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('M_kategori');
		$this->load->model('M_barang');
		// $this->load->library('barcode');
    }
	

    public function data_barang_get()
    {
        $hsl = $this->M_barang->tampil_barang()->result();
    
        if (!empty($hsl))
        {
            $this->set_response([
                'status' => 200,
                'error'  => false,
                'barang' => $hsl
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => 200,
                'error'  => false,
                'message' => 'Tidak ada data'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function tambah_barang_post()
	{
        $kobar = $this->M_barang->get_kobar();
        $response = $this->M_barang->simpan_barang(
            $kobar,
            $this->post('nabar'),
            $this->post('kat'),
            $this->post('satuan'),
            $this->post('harpok'),
            $this->post('harjul'),
            $this->post('harjul_grosir'),
            $this->post('stok'),
            $this->post('min_stok')
          );
        $this->response($response);
		
	}

    public function barang_hapus_post(){
        $response = $this->M_barang->hapus_barang(
            $this->post('kobar')
          );
        $this->response($response);
    }
    
    // Belom
    // public function edit_barang_post()
	// {
    //     $kobar = $this->input->post('kobar');
    //     $nabar = $this->input->post('nabar');
    //     $kat = $this->input->post('kategori');
    //     $satuan = $this->input->post('satuan');
    //     $harpok = str_replace(',', '', $this->input->post('harpok'));
    //     $harjul = str_replace(',', '', $this->input->post('harjul'));
    //     $harjul_grosir = str_replace(',', '', $this->input->post('harjul_grosir'));
    //     $stok = $this->input->post('stok');
    //     $min_stok = $this->input->post('min_stok');
    //     $this->m_barang->update_barang($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok);
    //     redirect('admin/barang');
    // }
    
    public function test_post()
	{
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
	}
}
