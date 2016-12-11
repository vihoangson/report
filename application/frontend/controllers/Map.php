<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper(array('url','form','file','global'));
		$this->load->model(array('GLOBAL_Model','SHOP_Model','NEWS_Model','MODULE_Model','CONTACT_Model','VIDEO_Model'));
				
		$this->load->database();
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
		$data['minus'] = 0;
		
		$this->my_layout->view("map_view",$data); 
	}
	
}
