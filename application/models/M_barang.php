<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class M_barang extends CI_Model{

	function hapus_barang($kobar){
		// $hsl=$this->db->query("DELETE FROM tbl_barang where barang_id='$kode'");
		$where = array(
		"barang_id"=>$kobar
		);

		$this->db->where($where);
		$hsl = $this->db->delete("tbl_barang");
		if($hsl){
			$response['status']=200;
			$response['error']=false;
			$response['message']='Data berhasil dihapus.';
			return $response;
		}else{
			$response['status']=502;
			$response['error']=true;
			$response['message']='Data gagal dihapus.';
			return $response;
		}
	}

	function update_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$min_stok){
		 
		$hsl=$this->db->query("UPDATE tbl_barang SET barang_nama='$nabar',barang_satuan='$satuan',barang_harpok='$harpok',barang_harjul='$harjul',barang_harjul_grosir='$harjul_grosir',barang_stok='$stok',barang_min_stok='$min_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$kat' WHERE barang_id='$kobar'");
		return $hsl;
	}

	function tampil_barang(){
		$hsl=$this->db->query("SELECT barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_harjul_grosir,barang_stok,barang_min_stok,barang_kategori_id,kategori_nama FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id");
		
		return $hsl;
	}

	function simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$min_stok){
		 
		// $hsl=$this->db->query("INSERT INTO tbl_barang (barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_harjul_grosir,barang_stok,barang_min_stok,barang_kategori_id) VALUES ('$kobar','$nabar','$satuan','$harpok','$harjul','$harjul_grosir','$stok','$min_stok','$kat')");
		$data = array(
			"barang_id" => $kobar,
			"barang_nama" => $nabar,
			"barang_satuan" => $satuan ,
			"barang_harpok" => $harpok ,
			"barang_harjul" => $harjul ,
			"barang_harjul_grosir" => $harjul_grosir ,
			"barang_stok" => $stok ,
			"barang_min_stok" => $min_stok ,
			"barang_kategori_id" => $kat,
		);
		$insert = $this->db->insert("tbl_barang", $data);
		if($insert){
			$response['status']=200;
			$response['error']=false;
			$response['message']='Data berhasil ditambahkan.';
			return $response;
		  }else{
			$response['status']=502;
			$response['error']=true;
			$response['message']='Data gagal ditambahkan.';
			return $response;
		}
	}


	function get_barang($kobar){
		$hsl=$this->db->query("SELECT * FROM tbl_barang where barang_id='$kobar'");
		return $hsl;
	}

	function get_kobar(){
		$q = $this->db->query("SELECT MAX(RIGHT(barang_id,6)) AS kd_max FROM tbl_barang");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return "BR".$kd;
	}

}