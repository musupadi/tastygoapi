<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('privacy');
    }
}

/* End of file Controllername.php */
