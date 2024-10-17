<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\Auth;
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Authorization extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Models');
        // $this->firebase = (new Factory)->withServiceAccount(APPPATH . 'firebase_credentials.json');
    }
    public function login_post(){
        $username = $this->post('username');
        $password = md5($this->post('password'));
        $data =  [
            'username' => $username,
            'password' => $password,
        ];
        $result = $this->Models->getWhere('user',$data);
        if($result){
            $this->response([
                'status' => true,
                'Message' => 'Login Success',
                'data' => $result
            ], REST_Controller::HTTP_OK);     
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Username or Password is wrong '.$password,
                'data' => array()
            ], REST_Controller::HTTP_OK);  
        }
    }
}