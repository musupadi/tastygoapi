<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Post extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Models');
    }
    public function index_get() {
        $id_user = $this->get('id_user');
        $following = $this->Models->getIDArray('following','from_id_user',$id_user);
        $result = $this->Models->GetPost($following); 
        
        // Cek apakah hasilnya ada
        if ($result) {
            foreach ($result as &$post) {
                // Ambil gambar berdasarkan id post
                $image = $this->Models->getID('image_post', 'id_post', $post->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post->image_url = (!empty($image)) ? $image : [];
            }
            foreach ($result as &$post2) {
                // Ambil gambar berdasarkan id post
                $file = $this->Models->getID('file_post', 'id_post', $post2->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post2->pdf = (!empty($file)) ? $file : [];
            }
            // Kirimkan respon dengan data yang telah dimodifikasi
            $this->response([
                'status' => true,
                'Message' => 'Post Succesfully retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'Message' => 'Post failed to be retrieved',
                'data' => []
            ], REST_Controller::HTTP_OK);
        }
    }
    public function detail_get(){
        $id_post = $this->get('id_post');

        $result = $this->Models->SearchPost(null,$id_post);
        // Cek apakah hasilnya ada
        if ($result) {
            foreach ($result as &$post) {
                // Ambil gambar berdasarkan id post
                $image = $this->Models->getID('image_post', 'id_post', $post->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post->image_url = (!empty($image)) ? $image : [];
            }
            foreach ($result as &$post2) {
                // Ambil gambar berdasarkan id post
                $file = $this->Models->getID('file_post', 'id_post', $post2->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post2->pdf = (!empty($file)) ? $file : [];
            }
            $this->response([
                'status' => true,
                'Message' => 'Post Succesfully retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'Message' => 'Post failed to be retrieved',
                'data' => []
            ], REST_Controller::HTTP_OK);
        }
    }
    public function userpost_get() {
        $id_user = $this->get('id_user');
        $result = $this->Models->GetUserPost($id_user); 
        // Cek apakah hasilnya ada
        if ($result) {
            foreach ($result as &$post) {
                // Ambil gambar berdasarkan id post
                $image = $this->Models->getID('image_post', 'id_post', $post->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post->image_url = (!empty($image)) ? $image : [];
            }
            foreach ($result as &$post2) {
                // Ambil gambar berdasarkan id post
                $file = $this->Models->getID('file_post', 'id_post', $post2->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post2->pdf = (!empty($file)) ? $file : [];
            }
            // Kirimkan respon dengan data yang telah dimodifikasi
            $this->response([
                'status' => true,
                'Message' => 'Post Succesfully retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'Message' => 'Post failed to be retrieved',
                'data' => []
            ], REST_Controller::HTTP_OK);
        }
    }
    public function likespost_get() {
        $id_user = $this->get('id_user');
        $likesData = $this->Models->getIDArray('likes','id_user',$id_user);
        $result = $this->Models->GetPostLikes($likesData); 
        // Cek apakah hasilnya ada
        if ($result) {
            foreach ($result as &$post) {
                // Ambil gambar berdasarkan id post
                $image = $this->Models->getID('image_post', 'id_post', $post->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post->image_url = (!empty($image)) ? $image : [];
            }
            foreach ($result as &$post2) {
                // Ambil gambar berdasarkan id post
                $file = $this->Models->getID('file_post', 'id_post', $post2->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $post2->pdf = (!empty($file)) ? $file : [];
            }
            // Kirimkan respon dengan data yang telah dimodifikasi
            $this->response([
                'status' => true,
                'Message' => 'Post Succesfully retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'Message' => 'Post failed to be retrieved',
                'data' => []
            ], REST_Controller::HTTP_OK);
        }
    }
    public function searchimg_get(){
        $result = $this->Models->SearchPost(); 
        
        // Inisialisasi array untuk hasil akhir
        $finalResult = [];
    
        // Cek apakah hasilnya ada
        if ($result) {
            foreach ($result as &$post) {
                // Ambil gambar berdasarkan id post
                $image = $this->Models->getID('image_post', 'id_post', $post->id);
                // Jika gambar ada, masukkan post ke hasil final
                if (!empty($image)) {
                    $post->image_url = $image; // Assign image ke post
                    $finalResult[] = $post; // Tambahkan post yang memiliki gambar ke finalResult
                }
            }
            // Kirimkan respon dengan data yang telah dimodifikasi
            $this->response([
                'status' => true,
                'Message' => 'Post Succesfully retrieved',
                'data' => $finalResult
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'Message' => 'Post failed to be retrieved',
                'data' => []
            ], REST_Controller::HTTP_OK);
        }
    }
    
    public function image_get(){
        $id_user = $this->get('id_user');

        $result = $this->Models->GetImage($id_user);
        // Cek apakah hasilnya ada
        if ($result) {
            $this->response([
                'status' => true,
                'Message' => 'Image Succesfully retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'Message' => 'Image failed to be retrieved',
                'data' => []
            ], REST_Controller::HTTP_OK);
        }
    }
    //Comment
    public function insertsubcomment_post(){
        $id_user = $this->post('id_user');
        $label = $this->post('label');
        $id_comment = $this->post('id_comment');
        $data = [
            'id_user' => $id_user,
            'label' => $label,
            'id_comment' => $id_comment
        ];            
        $result = $this->Models->insert("subcomment", $data); 
        if($result){
            $user = $this->Models->getIDArray('user', 'id',$id_user);
            $post = $this->Models->getIDArray('comment','id',$id_comment);
            $checkUser = $this->Models->getID('post','id',$post[0]['id_post']);
            if($checkUser[0]->id_user != $id_user){
                $this->Models->MakeNotification($checkUser[0]->id_user,$post[0]['id_post'],$user[0]['name'].' has reply your comment','');
                $this->response([
                    'status' => true,
                    'Message' => $this->db->last_query(),
                    'Code' => "1",
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => true,
                    'Message' => 'Comment successfully created',
                    'Code' => "1",
                ], REST_Controller::HTTP_OK);
            }
            
          
        // Response sukses
            $this->response([
                'status' => true,
                'Message' => 'Subcomment successfully created',
                'Code' => "1",
            ], REST_Controller::HTTP_OK);
        }else{
            // Response gagal
            $this->response([
                'status' => false,
                'Message' => 'Subcomment Failed created',
                'Code' => "0",
            ], REST_Controller::HTTP_OK);
        }
    }
    public function insertcomment_post(){
        $id_user = $this->post('id_user');
        $id_post = $this->post('id_post');
        $comment = $this->post('comment');
        $data = [
            'id_user' => $id_user,
            'id_post' => $id_post,
            'comment' => $comment
        ];            
        $result = $this->Models->insert("comment", $data); 
        if($result){
        // Response sukses
            $user = $this->Models->getIDArray('user', 'id',$id_user);
            $checkUser = $this->Models->getID('post','id',$id_post);
            if($checkUser[0]->id_user != $id_user){
                $this->Models->MakeNotification($checkUser[0]->id_user,$id_post,$user[0]['name'].' has commented your post','1');
                $this->response([
                    'status' => true,
                    'Message' => $this->db->last_query(),
                    'Code' => "1",
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => true,
                    'Message' => 'Comment successfully created',
                    'Code' => "1",
                ], REST_Controller::HTTP_OK);
            }
            
          
      
        }else{
            // Response gagal
            $this->response([
                'status' => false,
                'Message' => 'Comment Failed created',
                'Code' => "0",
            ], REST_Controller::HTTP_OK);
        }
    }
    public function comments_get(){
        $id_post = $this->get('id_post');   
        $result = $this->Models->Comment($id_post); 
        
        // Cek apakah hasilnya ada
        if ($result) {
            foreach ($result as &$comment) {
                // Ambil gambar berdasarkan id post
                $data = $this->Models->SubComment($comment->id);
                // Asumsikan hanya satu gambar per post, ambil yang pertama jika ada

                $comment->subcomment = (!empty($data)) ? $data : [];
            }
            // Kirimkan respon dengan data yang telah dimodifikasi
            $this->response([
                'status' => true,
                'Message' => 'Comment Succesfully retrieved',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'Message' => 'Comment failed to be retrieved',
                'data' => []
            ], REST_Controller::HTTP_OK);
        }
    }

    //Likes
    public function countlikes_get(){
      
        $id_post = $this->get('id_post');
      
         // Insert ke tabel post
         $result = $this->Models->Count("likes",'id_post',$id_post); 
         if($result){
         // Response sukses
             $this->response([
                 'status' => true,
                 'Message' => 'Likes successfully finded',
                 'Code' => "1",
                 'data' => $result
             ], REST_Controller::HTTP_OK);
         }else{
             // Response gagal
             $this->response([
                 'status' => false,
                 'Message' => 'Likes Failed finded',
                 'Code' => "2",
                 'data' => array()
             ], REST_Controller::HTTP_OK);
         }
    }
    public function likes_get(){
        $id_user = $this->get('id_user');
        $id_post = $this->get('id_post');
        $data = [
            'id_user' => $id_user,
            'id_post' => $id_post
        ]; 
         // Insert ke tabel post
         $result = $this->Models->getWhere("likes",$data); 
         if($result){
         // Response sukses
             $this->response([
                 'status' => true,
                 'Message' => 'Likes successfully finded',
                 'Code' => "1",
                 'data' => $result
             ], REST_Controller::HTTP_OK);
         }else{
             // Response gagal
             $this->response([
                 'status' => false,
                 'Message' => 'Likes Failed finded',
                 'Code' => "2",
                 'data' => array()
             ], REST_Controller::HTTP_OK);
         }
    }
    public function likepost_post(){
        $id_user = $this->post('id_user');
        $id_post = $this->post('id_post');
        $data = [
            'id_user' => $id_user,
            'id_post' => $id_post
        ];    
                    
        // Insert ke tabel post
        $Checker = $this->Models->getWhere("likes", $data); 
        if($Checker){
            $result = $this->Models->delete("likes","id" ,$Checker[0]['id']);
            if($result){
            // Response sukses
                $this->response([
                    'status' => true,
                    'Message' => 'Likes successfully Deleted',
                    'Code' => "2",
                ], REST_Controller::HTTP_OK);
            }else{
                // Response gagal
                $this->response([
                    'status' => false,
                    'Message' => 'Likes Failed Deleted',
                    'Code' => "0",
                ], REST_Controller::HTTP_OK);
            }
        }else{
            // Data untuk tabel post
            $data2 = [
                'id_user' => $id_user,
                'id_post' => $id_post,
                'created_by' => $id_user,
                'updated_by' => $id_user
            ];    
                        
            // Insert ke tabel post
            $result = $this->Models->insert("likes", $data2); 
            if($result){
                // Response sukses
                $user = $this->Models->getIDArray('user', 'id',$id_user);
                $checkUser = $this->Models->getID('post','id',$id_post);
                if($checkUser[0]->id_user != $id_user){
                  
                    $data = $this->Models->MakeNotification($checkUser[0]->id_user,$id_post,$user[0]['name'].' has like your post','0');
                    $this->response([
                        'status' => true,
                        'Message' => $this->db->last_query(),
                        'Code' => "1",
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->response([
                        'status' => true,
                        'Message' => 'Likes successfully created',
                        'Code' => "1",
                    ], REST_Controller::HTTP_OK);
                }
                
               
            }else{
                // Response gagal
                $this->response([
                    'status' => false,
                    'Message' => 'Likes Failed created',
                    'Code' => "0",
                ], REST_Controller::HTTP_OK);
            }
        }
    }
    public function newpost_post(){
        $id_user = $this->post('id_user');
        $title = $this->post('title');
        $label = $this->post('label');
        $id_category = $this->post('id_category');
        $img = isset($_FILES['img']) ? $_FILES['img'] : null;  // Cek apakah ada file gambar
        $file = isset($_FILES['file']) ? $_FILES['file'] : null;  // Cek apakah ada file
        
        // Data untuk tabel post
        $data = [
            'id_user' => $id_user,
            'title' => $title,
            'label' => $label,
            'id_category' => $id_category,
            'created_by' => $id_user,
            'updated_by' => $id_user
        ];
        
        // Insert ke tabel post
        $result = $this->Models->insert("post", $data); 
        
        if ($result) {
            // Mendapatkan ID post yang baru di-insert
            $id_post = $this->db->insert_id();
        
            // Cek apakah ada file gambar yang diunggah
            if (!empty($img) && !empty($img['name'][0])) {  // Pastikan ada file yang diunggah
                $this->load->library('upload');
                // Looping untuk upload banyak gambar
                for ($i = 0; $i < count($img['name']); $i++) {
                    $_FILES['img_single']['name'] = $img['name'][$i];
                    $_FILES['img_single']['type'] = $img['type'][$i];
                    $_FILES['img_single']['tmp_name'] = $img['tmp_name'][$i];
                    $_FILES['img_single']['error'] = $img['error'][$i];
                    $_FILES['img_single']['size'] = $img['size'][$i];
        
                    // Konfigurasi upload
                    $config['upload_path'] = './img/post/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = uniqid(); // Nama file unik
                    $config['max_size'] = 10000; // Max 4MB per file
        
                    $this->upload->initialize($config);
        
                    // Lakukan upload dan cek keberhasilan
                    if ($this->upload->do_upload('img_single')) {
                        // Jika upload berhasil, insert ke tabel image_post
                        $uploadData = $this->upload->data();
                        $data2 = [
                            'id_post' => $id_post, // ID post yang baru di-insert
                            'img_url' => $uploadData['file_name'],
                            'created_by' => $id_user,
                            'updated_by' => $id_user
                        ];
        
                        $this->Models->insert("image_post", $data2);
                    } else {
                        // Jika upload gagal, beri pesan kesalahan
                        $this->response([
                            'status' => false,
                            'Message' => 'Image upload failed: ' . $this->upload->display_errors(),
                            'Code' => "0",
                            'data' => array()
                        ], REST_Controller::HTTP_OK);
                        return;
                    }
                }
            }
            if (!empty($file) && !empty($file['name'][0])) {  // Pastikan ada file yang diunggah
                $this->load->library('upload');
                // Looping untuk upload banyak gambar
                for ($i = 0; $i < count($file['name']); $i++) {
                    $_FILES['file_single']['name'] = $file['name'][$i];
                    $_FILES['file_single']['type'] = $file['type'][$i];
                    $_FILES['file_single']['tmp_name'] = $file['tmp_name'][$i];
                    $_FILES['file_single']['error'] = $file['error'][$i];
                    $_FILES['file_single']['size'] = $file['size'][$i];
        
                    // Konfigurasi upload
                    $config['upload_path'] = './report/';
                    $config['allowed_types'] = 'pdf';
                    $config['file_name'] = uniqid(); // Nama file unik
                    $config['max_size'] = 50000; // Max 4MB per file
        
                    $this->upload->initialize($config);
        
                    // Lakukan upload dan cek keberhasilan
                    if ($this->upload->do_upload('file_single')) {
                        // Jika upload berhasil, insert ke tabel image_post
                        $uploadData = $this->upload->data();
                        $data2 = [
                            'id_post' => $id_post, // ID post yang baru di-insert
                            'file_url' => $uploadData['file_name'],
                            'created_by' => $id_user,
                            'updated_by' => $id_user
                        ];
        
                        $this->Models->insert("file_post", $data2);
                    } else {
                        // Jika upload gagal, beri pesan kesalahan
                        $this->response([
                            'status' => false,
                            'Message' => 'File upload failed: ' . $this->upload->display_errors(),
                            'Code' => "0",
                            'data' => array()
                        ], REST_Controller::HTTP_OK);
                        return;
                    }
                }
            }
        
            // Response sukses
            $this->response([
                'status' => true,
                'Message' => 'Post successfully created',
                'Code' => "1",
                'data' => $result
            ], REST_Controller::HTTP_OK);
        
        } else {
            // Response gagal insert post
            $this->response([
                'status' => false,
                'Message' => 'Post failed to create',
                'Code' => "0",
                'data' => array()
            ], REST_Controller::HTTP_OK);
        }
    }
}