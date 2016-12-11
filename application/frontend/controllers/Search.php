<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper(array('url','form','file','global'));

		$this->load->helper('captcha');
		$this->load->library(array("form_validation","session"));
		//$this->load->helper('GLOBAL');
		
				
		$this->load->database();
		$this->load->model("GLOBAL_Model");
		$this->load->model("SHOP_Model");
		$this->load->model("NEWS_Model");
		$this->load->model("MODULE_Model");
		$this->load->model("CONTACT_Model");
		
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
		
		$cid = $this->input->post('category_id')?$this->input->post('category_id'):$this->uri->segment(4);
		$search = $this->input->post('search')?$this->input->post('search'):$this->uri->segment(5);
		if($cid)
		{
				$max = sizeof($this->SHOP_Model->SearchProduct($cid, $search));
				$min = 6;
				$data['num_rows'] = $max;
				//--- Paging
				if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."index.php/search/index/".$data['language' ].'/'.$cid."/".$search;
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 5; 
					$config['uri_segment'] = 6;
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
					$data['list'] = $this->SHOP_Model->SearchProduct($cid, $search, $min, $this->uri->segment($config['uri_segment']));
		
					$this->my_layout->view("searchdetail_view", $data); 
					
				}else{
					$data['report'] = lang('_NOTAVAILABLE');
					$this->my_layout->view("report_view",$data);
				}
		}
		else
		{
			$data['report'] = lang('_NOTAVAILABLE');
			$this->my_layout->view("report_view",$data);
		}
	}
	
}
