<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
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
		$modulename = $this->uri->segment(1);
		$data['modulename'] = $modulename;
		
				$max = sizeof($this->NEWS_Model->AllStories());
				$min = 6;
				$data['num_rows'] = $max;
				//--- Paging
				if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."index.php/news/index/".$data['language' ];
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 4; 
					$config['uri_segment'] = 5;
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
					$data['title']= 	array(0=>array('title'=>lang('_NEWS')));
					$data['stories'] = $this->NEWS_Model->AllStories($min,$this->uri->segment($config['uri_segment']),$modulename);
					if($max==1){
					$this->my_layout->view("storiesd_view", $data); 
					}else{
					$this->my_layout->view("storiesc_view", $data); 
					}
				}else{
					$data['report'] = lang('_NOTAVAILABLE');
					$this->my_layout->view("report_view",$data);
				}
	}
	
	
	public function module()
	{
		$data['links'] = $this->GLOBAL_Model->urllink();
		//lang
		$curent_lang = $this->uri->segment(3);
		$data['language' ]=$this->my_lang->setLanguage($curent_lang);
		
		//end lang
		$catid = $this->uri->segment(4);
		$modulename = $this->uri->segment(1);
		$p = $this->NEWS_Model->getCategory($catid);
		
		$data['modulename'] = $modulename;
		
		if($p[0]['parentid']==0){
			
			$data['minus'] = $catid;
			$pp= $this->NEWS_Model->getSubNewsCategories($catid);
			if(sizeof($pp))
			{
				
					$data['report'] = lang('_NOTLAVEL1');
					$this->my_layout->view("report_view",$data);
			}
			else
			{
				$max = sizeof($this->NEWS_Model->StoriesCategory($catid));
				$min = 6;
				$data['num_rows'] = $max;
				//--- Paging
				if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."index.php/aboutus/module/".$data['language' ].'/'.$catid;
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 4; 
					$config['uri_segment'] = 5;
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
					$data['title']	= 	$p;
					$data['stories'] = $this->NEWS_Model->StoriesCategory($catid,$min,$this->uri->segment($config['uri_segment']));
					if($max==1){
					$this->my_layout->view("storiesd_view", $data); 
					}else{
					$this->my_layout->view("storiesc_view", $data); 
					}
				}else{
					$data['report'] = lang('_NOTAVAILABLE');
					$this->my_layout->view("report_view",$data);
				}
			}
		}else{
			$max = sizeof($this->NEWS_Model->StoriesCategory($catid));
				$min = 6;
				$data['num_rows'] = $max;
				//--- Paging
				if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."index.php/aboutus/module/".$data['language' ].'/'.$catid;
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 4; 
					$config['uri_segment'] = 5;
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
					$data['title']	= 	$p;
					$data['stories'] = $this->NEWS_Model->StoriesCategory($catid,$min,$this->uri->segment($config['uri_segment']));
				
					$this->my_layout->view("storiesc_view", $data); 
				}else{
					$data['report'] = lang('_NOTAVAILABLE');
					$this->my_layout->view("report_view",$data);
				}
			
			
		}
		
		
	}
	
	public function detail()
	{
		$data['links'] = $this->GLOBAL_Model->urllink();
		//lang
		$curent_lang = $this->uri->segment(3);
		$data['language' ]=$this->my_lang->setLanguage($curent_lang);
		
		//end lang
		$sid = $this->uri->segment(5);
		
		$data['stories'] = $this->NEWS_Model->StoriesDetail($sid);
		$catid = $data['stories'][0]['catid'];
		$cat = $this->NEWS_Model->getCategory($catid);
		
		$this->my_layout->view("storiesd_view",$data);
	}
}
