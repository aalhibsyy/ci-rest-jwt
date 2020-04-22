<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('M_kategori');
		$this->load->model('M_barang');
		// $this->load->library('barcode');
    }
	

    public function data_kategori_get()
    {
        $hsl = $this->M_kategori->tampil_kategori()->result();
    
        if (!empty($hsl))
        {
            $this->set_response([
                'status' => 200,
                'error'  => false,
                'kategori' => $hsl
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

    public function tambah_kategori_post()
	{
        $response = $this->M_kategori->simpan_kategori(
            $this->post('kategori')
          );
        $this->response($response);
		
	}

    public function kategori_hapus_post(){
        $response = $this->M_kategori->hapus_kategori(
            $this->post('kode')
          );
        $this->response($response);
    }
    
    // Belom
    // public function edit_kategori_post()
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
    //     $this->M_kategori->update_kategori($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok);
    //     redirect('admin/kategori');
    // }
    
    public function test_post()
	{
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
	}
}
