<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Status extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Models');
    }
    public function index_get(){
        $id_user = $this->get('id_user');
        $following = $this->Models->getIDArray('following','to_id_user',$id_user);
        $result = $this->Models->GetStatus($following);
        if($result){
            foreach ($result as $index -> $stat) {
                // Ambil gambar berdasarkan id post
                $id_status = $result[$index]['id'];
                $data = [
                    'id_user' => $id_user,
                    'id' => $id_status
                ];
                $result2 = $this->Models->getWhere2('status_view', $data);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada
 
                $stat->status = (!empty($result2)) ? $result : [];
            }
            // Kirimkan respon dengan data yang telah dimodifikasi
            $this->response([
                'status' => true,
                'Message' => 'Status Succesfully retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'Message' => $this->db->last_query(),
                // 'Message' => 'Status Failed retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        }
    }
}