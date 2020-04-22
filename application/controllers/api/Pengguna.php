<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('M_kategori');
        $this->load->model('M_barang');
        $this->load->model('M_pengguna');
		// $this->load->library('barcode');
    }
	

    public function data_pengguna_get()
    {
        $hsl = $this->M_pengguna->tampil_pengguna()->result();
    
        if (!empty($hsl))
        {
            $this->set_response([
                'status' => 200,
                'error'  => false,
                'pengguna' => $hsl
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

    public function tambah_pengguna_post()
	{   
        $password=$this->input->post('password');
		$password2=$this->input->post('password2');
        if ($password2 <> $password) {
            $this->set_response([
                'status' => 200,
                'error'  => true,
                'message' => 'Password yang anda masukan tidak sama.'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404)
		}else{
            $response = $this->M_pengguna->simpan_pengguna(
                $this->post('nama'),
                $this->post('username'),
                $this->post('password'),
                $this->post('level')
              );
            $this->response($response);
        }
		
    }
    
    public function pengguna_hapus_post()
	{   
        
        $response = $this->M_pengguna->update_status(
            $this->post('id')
          );
        $this->response($response);
      
    }

    // Gadipake
    // public function pengguna_hapus_post(){
    //     $response = $this->M_pengguna->hapus_pengguna(
    //         $this->post('kobar')
    //       );
    //     $this->response($response);
    // }
    
    // Belom
    // public function edit_pengguna_post()
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
    //     $this->m_pengguna->update_pengguna($kobar, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok);
    //     redirect('admin/pengguna');
    // }
    
    public function test_post()
	{
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
	}
}
