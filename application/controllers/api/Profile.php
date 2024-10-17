<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Profile extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Models');
    }
    public function index_get(){
        $id = $this->get('id');
        $data =  [
            'id' => $id
        ];
        $result = $this->Models->getWhere('db_kembang.user', $data);
        
        if($result){
            // Menggunakan Count untuk mendapatkan total following
            foreach ($result as $index => $post) {
                $followingData = $this->Models->Count3('following', 'from_id_user', $id);
                $followerData = $this->Models->Count3('following', 'to_id_user', $id);
                // $post = (!empty($followingData)) ?  : "0";
                $result[$index]['following'] =  (!empty($followingData)) ? $followingData : "0"; 
                $result[$index]['follower'] =  (!empty($followerData)) ? $followerData : "0"; 
            }
            $this->response([
                'status' => true,
                'Message' => 'Profile Succesfully Retreived',
                'data' => $result
            ], REST_Controller::HTTP_OK);     
        } else {
            $this->response([
                'status' => false,
                'Message' => 'No profile found',
                'data' => array()
            ], REST_Controller::HTTP_OK);  
        }
    }
    public function changephoto_post(){
        // Mengambil ID pengguna dari POST data
        $id_user = $this->post('id_user');
    
        // Validasi apakah ID pengguna disediakan
        if (!$id_user) {
            $this->response([
                'status' => false,
                'Message' => 'User ID is required'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
    
        // Cek apakah ada file gambar yang diupload
        if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
            $this->response([
                'status' => false,
                'Message' => 'No image file uploaded or there was an upload error'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
    
        // Memuat library upload
        $this->load->library('upload');
    
        // Konfigurasi upload
        $config['upload_path'] = './img/profile/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = uniqid(); // Nama file unik
        $config['max_size'] = 4096; // Max 4MB per file (4096 KB)
        $config['overwrite'] = true; // Meng-overwrite file jika nama sama
    
        // Inisialisasi konfigurasi upload
        $this->upload->initialize($config);
    
        // Lakukan upload dan cek keberhasilan
        if ($this->upload->do_upload('img')) { // Pastikan nama field sesuai
            // Jika upload berhasil, ambil data file yang diupload
            $uploadData = $this->upload->data();
    
            // Data yang akan diupdate di tabel user
            $data = [
                'photo_profile' => $uploadData['file_name']
            ];
    
            // Update data pengguna di database
            $result = $this->Models->edit("user", 'id', $id_user, $data);
    
            if($result){
                $this->response([
                    'status' => true,
                    'Message' => 'Profile Image Successfully Updated'
                ], REST_Controller::HTTP_OK);
            } else {
                // Jika update database gagal, hapus file yang telah diupload
                unlink($config['upload_path'] . $uploadData['file_name']);
    
                $this->response([
                    'status' => false,
                    'Message' => 'Failed to update profile image in database'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            // Jika upload gagal, dapatkan pesan error
            $error = $this->upload->display_errors('', '');
            $this->response([
                'status' => false,
                'Message' => 'Upload failed: ' . $error
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function notification_post(){
        $id_user = $this->post('id_user');
        $data = [
            'id_user' => $id_user,
            'status' => "1",
            'updated_by' => $this->Models->GetTimestamp()
        ];            
        $result = $this->Models->edit("notification",'id_user',$id_user,$data); 
        if($result){

            $this->response([
                'status' => true,
                'Message' => 'Notification Succesfully Updated'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Notification Failed Updated'
            ], REST_Controller::HTTP_OK);
        }
    }
    public function notification_get(){
        $id_user = $this->get('id_user');
        $result = $this->Models->Notification($id_user);
 
        if($result){
            foreach ($result as $post) {
                $Count = $this->Models->Count3('notification', 'status', '0');
                $post->Unread =  (!empty($Count)) ?  $Count: "0"; 
            }
   
            $this->response([
                'status' => true,
                'Message' => 'Data Succesfully Received',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Data Failed Received',
                'data' => array()
            ], REST_Controller::HTTP_OK);
        }
    }
  
    public function follow_post() {

        // Ambil nama dan id_user dari request
        $name = $this->post('name');
        $id_user = $this->post('id_user');
        $to_id_user = $this->post('to_id_user'); // Id user yang akan di-follow
        
        // Data untuk pengguna yang melakukan following
        $from_id_user = $id_user;
    
        // Ambil data following dan follower
        $following = $this->Models->UserFollow($to_id_user, null, $id_user); // Filter user
        $follower = $this->Models->UserFollow(null, $from_id_user, $id_user); // Filter user
    
        // Jika following tidak ditemukan, set sebagai array kosong
        if (!$following) {
            $following = [];
        }
    
        // Jika follower tidak ditemukan, set sebagai array kosong
        if (!$follower) {
            $follower = [];
        }
    
        // Proses status untuk pengguna yang di-follow
        foreach ($following as &$follows) {
            $status = "0"; // Default status 0
            $data = [
                'from_id_user' => $id_user,
                'to_id_user' => $follows->id // Mengakses sebagai objek
            ];
    
            // Cek apakah pengguna yang di-follow sudah mengikuti balik
            $result = $this->Models->getWhere2('following', $data);
            if ($result) {
                $dataReverse = [
                    'from_id_user' => $follows->id, // Mengakses sebagai objek
                    'to_id_user' => $id_user
                ];
                $result2 = $this->Models->getWhere2('following', $dataReverse);
                if ($result2) {
                    $status = "2"; // Saling mengikuti
                } else {
                    $status = "1"; // Sudah mengikuti, tapi belum diikuti balik
                }
            }
    
            $follows->status = $status; // Mengakses sebagai objek
        }
    
        // Return hasil atau proses selanjutnya
        // Misalnya return dalam bentuk JSON:
        $this->response([
            'status' => true,
            'Message' => 'Data Succesfully Received',
            'Following' => $following,
            'Follower' => $follower
        ], REST_Controller::HTTP_OK);
    }
    
    public function search_post(){
        $name = $this->post('name');
        $id_user = $this->post('id_user');
        $result = $this->Models->SearchLike('user','name',$name,'id_user',$id_user);
        
        if($result){
            $this->response([
                'status' => true,
                'Message' => 'Data Succesfully Received',
                'data' => $result
            ], REST_Controller::HTTP_OK);  
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Data Succesfully Received',
                'data' => array()
            ], REST_Controller::HTTP_OK);  
        }
    }
    public function userpost_post(){
        $id_user = $this->post('id_user');
        $result = $this->Models->SearchLike('user','name',$name);
        
        if($result){
            $this->response([
                'status' => true,
                'Message' => 'Data Succesfully Received',
                'data' => $result
            ], REST_Controller::HTTP_OK);  
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Data Succesfully Received',
                'data' => array()
            ], REST_Controller::HTTP_OK);  
        }
    }
    public function following_post(){
        $from_id_user = $this->post('from_id_user');
        $to_id_user = $this->post('to_id_user');
        $data = [
            'from_id_user' => $from_id_user,
            'to_id_user' => $to_id_user,
            'created_by' => $from_id_user,
            'updated_by' => $from_id_user
        ];   
        $dataCheck = [
            'from_id_user' => $from_id_user,
            'to_id_user' => $to_id_user
        ];   
        $result = $this->Models->getWhere('following',$dataCheck);
        if($result){
            $result2 = $this->Models->delete("following",'id',$result[0]['id']); 
            if($result){
                // Response sukses
                    $this->response([
                        'status' => true,
                        'Message' => 'Following successfully Deleted',
                        'Code' => "1",
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Response gagal
                    $this->response([
                        'status' => false,
                        'Message' => 'Following Failed Deleted',
                        'Code' => "0",
                    ], REST_Controller::HTTP_OK);
            }
        }else{
            $result2 = $this->Models->insert("following", $data); 
            if($result2){
                // Response sukses
                    $this->response([
                        'status' => true,
                        'Message' => 'Following successfully created',
                        'Code' => "1",
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Response gagal
                    $this->response([
                        'status' => false,
                        'Message' => 'Following Failed created',
                        'Code' => "0",
                    ], REST_Controller::HTTP_OK);
            }
        }
    }
    public function checkfollow_post(){
        $from_id_user = $this->post('from_id_user');
        $to_id_user = $this->post('to_id_user');
        $data = [
            'from_id_user' => $from_id_user,
            'to_id_user' => $to_id_user
        ];   
        $result = $this->Models->getWhere2('following',$data);
        if($result){
            $data = [
                'from_id_user' => $to_id_user,
                'to_id_user' => $from_id_user
            ];   
            $result2 = $this->Models->getWhere2('following',$data);
            if($result2){
                $this->response([
                    'status' => true,
                    'Message' => 'Friend',
                    'Code' => '2',
                    'data' => $result
                ], REST_Controller::HTTP_OK);  
            }else{
                $this->response([
                    'status' => true,
                    'Message' => 'Already Follow',
                    'Code' => '1',
                    'data' => $result
                ], REST_Controller::HTTP_OK);  
            }
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Not Following Yet',
                'Code' => '0',
                'data' => array()
            ], REST_Controller::HTTP_OK);  
        }
    }
}