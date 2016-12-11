<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper(array('url','form','file','global'));
		$this->load->library(array("form_validation","session"));
				
		$this->load->database();
		
		$this->load->model("GLOBAL_Model");
		$this->load->model("SHOP_Model");
		$this->load->model("MODULE_Model");
		$this->load->model("CONTACT_Model");
		$this->load->library(array("MY_layout","MY_user")); 
    	$this->my_layout->setLayout("template_view"); 
		
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
			$max = sizeof($this->SHOP_Model->ShopAllProduct());
			$min = 6;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/shop/index/".$data['language' ];
				$config['total_rows'] = $max;
				$config['per_page'] = $min;
				$config['num_link'] = 3; 
				$config['uri_segment'] =4;
				//config first
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				//config last
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				//config next
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['next_link'] = '&raquo;';
				//config prev
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo;';
				//config num
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				//config cur
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				
				$this->pagination->initialize($config);
				
				$data['link'] = $this->pagination->create_links();
				$data['title']	= 	array( 0 =>array( 'title' => lang('_PRODUCT')));
				$data['products'] = $this->SHOP_Model->ShopAllProduct($min,$this->uri->segment($config['uri_segment']));
			
				//$this->my_layout->view("modulec_view", $data); 
				$this->load->view("modulec_view", $data); 
			}else{
					$data['report'] = lang('_NOTAVAILABLE');
					//$this->my_layout->view("report_view",$data);
					$this->load->view("report_view",$data);
			}
	}
	
	
	public function detail()
	{
		//print_r($this->uri->segment_array());
		//end lang
		$pid = (int)$this->uri->segment(3);
		
		$data['product'] = $this->SHOP_Model->Shop($pid);
		//$this->my_layout->view("shop_detail_view",$data);
		$this->my_layout->view('welcome');
	}
	
	public function addcart()
	{
		//print_r($this->uri->segment_array());
		//end lang
		return "xxx";
	}
	
}
