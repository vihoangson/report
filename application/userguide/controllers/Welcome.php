<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){    
        // Load parent construct
        parent::__construct();
        // Load parser library
        $this->load->library('layout');
		$this->layout->setLayout("template_view"); 
		
    }
	public function index()
	{
		/*$data = array();
        $data['user_name'] = 'Đéo mẹ';
        $data['separator'] = '|';
        $data['profile_title'] = 'Profile view';
        $data['home_url'] = 'www.yourdomain.com/';
        $data['home_header_text'] = 'Home Page';
        
		$this->parser->parse( 'profile_view', $data );*/
		$this->load->view("welcome_message");
	}
	public function add()
	{
		echo "đụ má";
	}
}
