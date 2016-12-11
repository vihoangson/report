<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
	public function __construct(){    
        // Load parent construct
        parent::__construct();
        // Load parser library
        //$this->load->library('layout');
		//$this->layout->setLayout("template"); 
		
    }
	public function index()
	{
		$this->load->view("welcome");
	}
	public function add()
	{
		echo "đụ má";
	}
	
}
