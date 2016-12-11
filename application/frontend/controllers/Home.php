<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper(array('url','form','file','global'));
		//$this->load->helper('GLOBAL');
		
				
		$this->load->database();
		
		$this->load->model("GLOBAL_Model");
		$this->load->model("SHOP_Model");
		$this->load->model("NEWS_Model");
		$this->load->model("MODULE_Model");
		$this->load->model("CONTACT_Model");
		$this->load->model("VIDEO_Model");
		$this->load->library("MY_lang");
		$this->load->library("MY_layout"); // Sử dụng thư viện layout
    	$this->my_layout->setLayout("template_view"); // load file layout chính (views/template.php)
		
	}

	/**
	 * 
	 */
	public function index()
	{
		$data['links'] = $this->GLOBAL_Model->urllink();
		//lang
		$curent_lang = $this->uri->segment(3);
		$data['language' ]=$this->my_lang->setLanguage($curent_lang);
		
		//end lang
		include('./path/to/config/logo_config.php');
		$data['logo']			=	$logo;
		$data['total']			=	$total;
		$data['active_logo']	=	$active_logo;
		
		$data['products']		=	$this->SHOP_Model->ShopAllProduct(8,0);
		
		
		$this->my_layout->view("home_view",$data); 
	}
	
}
