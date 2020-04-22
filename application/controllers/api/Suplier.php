<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('M_kategori');
        $this->load->model('M_barang');
        $this->load->model('M_suplier');
		// $this->load->library('barcode');
    }
	

    public function data_suplier_get()
    {
        $hsl = $this->M_suplier->tampil_suplier()->result();
    
        if (!empty($hsl))
        {
            $this->set_response([
                'status' => 200,
                'error'  => false,
                'suplier' => $hsl
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

    public function tambah_suplier_post()
	{   $response = $this->M_suplier->simpan_suplier(
            $this->post('nama'),
            $this->post('alamat'),
            $this->post('notelp')
          );
        $this->response($response);
		
	}

    public function suplier_hapus_post(){
        $response = $this->M_suplier->hapus_suplier(
            $this->post('id')
          );
        $this->response($response);
    }
    
    // Belom
    // public function edit_suplier_post()
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
    //     $this->m_suplier->update_suplier($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok);
    //     redirect('admin/suplier');
    // }
    
    public function test_post()
	{
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
	}
}
