<?php
class M_suplier extends CI_Model{

	function hapus_suplier($kode){
		$hsl=$this->db->query("DELETE FROM tbl_suplier where suplier_id='$kode'");
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

	function update_suplier($kode,$nama,$alamat,$notelp){
		$hsl=$this->db->query("UPDATE tbl_suplier set suplier_nama='$nama',suplier_alamat='$alamat',suplier_notelp='$notelp' where suplier_id='$kode'");
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

	function tampil_suplier(){
		$hsl=$this->db->query("select * from tbl_suplier order by suplier_id desc");
		return $hsl;
	}

	function simpan_suplier($nama,$alamat,$notelp){
		$hsl=$this->db->query("INSERT INTO tbl_suplier(suplier_nama,suplier_alamat,suplier_notelp) VALUES ('$nama','$alamat','$notelp')");
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