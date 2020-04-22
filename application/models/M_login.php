<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class M_login extends CI_Model{
    
    function get_user($q) {
        return $this->db->get_where('tbl_user',$q);
    }
  
}
