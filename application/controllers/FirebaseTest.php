<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Kreait\Firebase\Factory;

class FirebaseTest extends CI_Controller {

    public function index() {
        $factory = (new Factory)
            ->withServiceAccount(APPPATH . 'firebase_credentials.json');
        
        // Ambil Firebase Auth Service
        $auth = $factory->createAuth();

        echo "Firebase SDK is working!";
    }
}