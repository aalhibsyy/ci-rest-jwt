<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Auth extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('M_login');
    }

    public function login_post()
    {
        $u = $this->post('username'); //Username Posted
        $p = md5($this->post('password')); //Pasword Posted
        $q = array('user_username' => $u); //For where query condition
        $kunci = $this->config->item('thekey');
        $invalidLogin = ['message' => 'Username atau Password Salah']; //Respon if login invalid
        $akses = 2;
        $val = $this->M_login->get_user($q)->row(); //Model to get single data row from database base on username
        if($this->M_login->get_user($q)->num_rows() == 0){$this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);}
		$match = $val->user_password;   //Get password for user from database
        if($p == $match){  //Condition if password matched
            if ($val->user_level == 1)
                $akses = 1;
            $token['user_id'] = $val->user_id;  //From here
            $token['user_username'] = $u;
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 60*60*5; //To here is to generate token
            $output['message'] ='Berhasil Login'; //Respon if login invalid
            $output['akses'] = $akses;
            $output['token'] = JWT::encode($token,$kunci ); //This is the output token
            $this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success
        }
        else {
            $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
    }

    

}
