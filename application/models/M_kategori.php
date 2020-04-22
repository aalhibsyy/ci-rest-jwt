<?php
class M_kategori extends CI_Model{

	function hapus_kategori($kode){
		$hsl=$this->db->query("DELETE FROM tbl_kategori where kategori_id='$kode'");
		if($hsl){
			$response['status']=200;
			$response['error']=false;
			$response['message']='Berhasil.';
			return $response;
		}else{
			$response['status']=502;
			$response['error']=true;
			$response['message']='Gagal.';
			return $response;
		}
	}

	function update_kategori($kode,$kat){
		$hsl=$this->db->query("UPDATE tbl_kategori set kategori_nama='$kat' where kategori_id='$kode'");
		if($hsl){
			$response['status']=200;
			$response['error']=false;
			$response['message']='Berhasil.';
			return $response;
		}else{
			$response['status']=502;
			$response['error']=true;
			$response['message']='Gagal.';
			return $response;
		}
	}

	function tampil_kategori(){
		$hsl=$this->db->query("select * from tbl_kategori order by kategori_id desc");
		return $hsl;
	}

	function simpan_kategori($kat){
		$hsl=$this->db->query("INSERT INTO tbl_kategori(kategori_nama) VALUES ('$kat')");
		if($hsl){
			$response['status']=200;
			$response['error']=false;
			$response['message']='Berhasil.';
			return $response;
		}else{
			$response['status']=502;
			$response['error']=true;
			$response['message']='Gagal.';
			return $response;
		}
	}

}