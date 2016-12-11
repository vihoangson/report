<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->helper(array('form','url','html','global'));
        $this->load->database();
        $this->load->library('form_validation');
		$this->load->library("MY_user");
		$this->load->library("MY_layout"); // Sử dụng thư viện layout
    	$this->my_layout->setLayout("template_view"); 
		
	
		$this->load->model("GLOBAL_Model");
		$this->load->model(array("SHOP_Model","WISHLIST_Model"));
		$this->load->model("ADVERTISE_Model");
		
	}

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['categories'] = $this->SHOP_Model->ShopAllCategories();
		$data['o'] = $this->SHOP_Model->ShopNews(6,0);
		$data['shop'] = $this->SHOP_Model->ShopAll();
		$data['slide'] = $this->ADVERTISE_Model->getSlide();
		$data['top'] = $this->ADVERTISE_Model->getTop();
		$data['bottom'] = $this->ADVERTISE_Model->getBottom();
		$this->my_layout->view('welcome_message',$data);
	}
	public function add()
	{
		echo "đụ má";
	}
}
