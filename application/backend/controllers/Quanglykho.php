<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quanglykho extends CI_Controller
{

  	function __construct()
  	{
		parent::__construct();
		
		
		$this->load->helper(array('url','form'));
		$this->load->library(array("form_validation","session"));
		$this->load->library("MY_Auth");
		$this->load->library('upload');
		//$this->load->library("FCKeditor");
				
		$this->load->database();
		$this->load->model(array("Auth_model","CONFIG_Model","Global_Model"));
		$this->load->model("Quanglykho_model");
		//$this->login();
		
		$this->load->helper('global');
		$this->load->library("MY_layout"); // Sử dụng thư viện layout
		$this->my_layout->setLayout("template"); // load file layout chính (views/template.php)

  	}
  
  
  
  	function thanhpho() {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			$option7 = $this->CONFIG_Model->find(7);
			
			$c = $this->Quanglykho_model->findAll_city();
			
			$max = sizeof($c);
			$min = $option7->option_value;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."admin.php/quanglykho/thanhpho/";
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 3; 
					$config['uri_segment'] = 3;
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
					$data['dstp'] = $this->Quanglykho_model->findLimit_city($min,$this->uri->segment($config['uri_segment']));
			
					$this->my_layout->view("city_view",$data);
			}
			
			
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
		
  	}
  
  	function Search() {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			$option7 = $this->CONFIG_Model->find(7);
			
			$key = $this->input->get('search');
			$c = $this->Quanglykho_model->search_city($key);
			$max = sizeof($c);
			$min = $option7->option_value;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."admin.php/quanglykho/Search?search=".$key;
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 3; 
					$config['uri_segment'] = 3;
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
					$data['dstp'] = $this->Quanglykho_model->searchlimit_city($key, $min,$this->uri->segment($config['uri_segment']));
			
					$this->my_layout->view("search_view",$data);
			}
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
		
  	}
  
  
  	public function ccity()
	{
		$mva= $this->input->post('id');
		$ccity = $this->Quanglykho_model->find_cCity($mva);
		print_r($ccity);
		$string = "";
		foreach($ccity as $index=>$value){
			$string.='<option value="'.$value['mva'].'">'.$value['title'].'</option>';
		}
		echo $string;
	}
  
	function addcity() {
  	if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$city = array(
				'mva' => $this->input->post('mva'),
				'title' => $this->input->post('title'),
				'pid' => $this->input->post('pid')
			);	
			$this->Quanglykho_model->insert_city($city);
			redirect(base_url()."admin.php/quanglykho/thanhpho");
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
  }
  
	function editcity() {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$id = $this->input->post('id');
			$city = array(
				'title' => $this->input->post('title'),
				'pid' => $this->input->post('pid')
			);
			$this->Quanglykho_model->update_city($id,$city);
			redirect(base_url()."admin.php/quanglykho/thanhpho");
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
  }
  
  function deletecity() {
  	if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			$id = $this->input->post('id');
			$this->Quanglykho_model->delete_city($id);
			redirect(base_url()."admin.php/quanglykho/thanhpho");
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
  	}
  
	
	
	function nhacungcap() {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			$option7 = $this->CONFIG_Model->find(7);
			
			
			$ncc = $this->Quanglykho_model->findAll_sup();
			$max = sizeof($ncc);
			$min = $option7->option_value;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."admin.php/quanglykho/nhacungcap/";
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 3; 
					$config['uri_segment'] = 3;
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
					$data['dssh'] = $this->Quanglykho_model->findLimit_sup($min,$this->uri->segment($config['uri_segment']));
			
					$this->my_layout->view("suppliers_view",$data);
			}
			
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
  }
  
  
  function Search_Supplier() {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			
			$option7 = $this->CONFIG_Model->find(7);
			
			$key = $this->input->get('search');
			$ncc = $this->Quanglykho_model->search_suppliers($key);
			$max = sizeof($ncc);
			$min = $option7->option_value;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
					
					$this->load->library('pagination');
					$config['base_url'] = base_url()."admin.php/quanglykho/Search_Supplier?search=".$key;
					$config['total_rows'] = $max;
					$config['per_page'] = $min;
					$config['num_link'] = 3; 
					$config['uri_segment'] = 3;
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
					$data['dssh'] = $this->Quanglykho_model->searchlimit_suppliers($key,$min,$this->uri->segment($config['uri_segment']));
			
					$this->my_layout->view("search_suppliers_view",$data);
			}
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
		
  	}
  
  	function delete_sup($id) {
  		$this->Quanglykho_model->delete_sup($id);
  		redirect(base_url()."admin.php/quanglykho/nhacungcap");
  	}	
  
	function suppliers_add() {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			$data['dstp'] = $this->Quanglykho_model->findAll_city();
			$this->my_layout->view("suppliers_add_view",$data);
		}
		else
        {  
			redirect(base_url()."index.php/dashboard");    
        }
  }
  
  function suppliers_save() {
 	 	if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			$tk = array(
				'title' => $this->input->post('title'),
				'mva' => $this->input->post('mva'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'numtax' => $this->input->post('numtax'),
				'pid' => $this->input->post('pid'),
				'CMND' => $this->input->post('CMND'),
				'city' => $this->input->post('city'),
				'Ward' => $this->input->post('Ward'),
				'address' => $this->input->post('address'),	
				'bank' => $this->input->post('bank'),
				'branch' => $this->input->post('branch'),
				'numbank' => $this->input->post('numbank'),
				'namebank' => $this->input->post('namebank'),
				'description' => $this->input->post('description'),
				'active' => '0'			
			);
			$this->Quanglykho_model->insert_sup($tk);
			redirect(base_url()."admin.php/quanglykho/nhacungcap");
			
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
  }
  
	function suppliers_edit($id) {
  	if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['dstp'] = $this->Quanglykho_model->findAll_city();
			$data['sup'] = $this->Quanglykho_model->find_sup($id);
			$this->my_layout->view("suppliers_edit_view",$data);
		}
		else
        {  
			redirect(base_url()."index.php/dashboard");    
        }
  }
  
	function suppliers_update($id) {
  	if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			
			$sup = array(
				'title' => $this->input->post('title'),
				'mva' => $this->input->post('mva'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'numtax' => $this->input->post('numtax'),
				'pid' => $this->input->post('pid'),
				'CMND' => $this->input->post('CMND'),
				'city' => $this->input->post('city'),
				'Ward' => $this->input->post('Ward'),
				'address' => $this->input->post('address'),	
				'bank' => $this->input->post('bank'),
				'branch' => $this->input->post('branch'),
				'numbank' => $this->input->post('numbank'),
				'namebank' => $this->input->post('namebank'),
				'description' => $this->input->post('description')
			);
			
			$this->Quanglykho_model->update_sup($id,$sup);
			redirect(base_url()."admin.php/quanglykho/nhacungcap");
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
  }
  
  ///////////////////////////////////////////////////////////////////
  	
	function company_add() {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			$data['dstp'] = $this->Quanglykho_model->findAll_city();
			$this->my_layout->view("company_add_view",$data);
		}
		else
        {  
			redirect(base_url()."index.php/dashboard");    
        }
  }
  
	function company_save() {
 	 	if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			$tk = array(
				'title' => $this->input->post('title'),
				'mva' => $this->input->post('mva'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'numtax' => $this->input->post('numtax'),
				'pid' => $this->input->post('pid'),
				'namere' => $this->input->post('namere'),
				'positionre' => $this->input->post('positionre'),
				'phonere' => $this->input->post('phonere'),
				'city' => $this->input->post('city'),
				'Ward' => $this->input->post('Ward'),
				'address' => $this->input->post('address'),	
				'bank' => $this->input->post('bank'),
				'branch' => $this->input->post('branch'),
				'numbank' => $this->input->post('numbank'),
				'namebank' => $this->input->post('namebank'),
				'description' => $this->input->post('description'),
				'active' => '0'			
			);
			$this->Quanglykho_model->insert_sup($tk);
			redirect(base_url()."admin.php/quanglykho/nhacungcap");
			
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
  }
  
	function company_update($id) {
		  $sup = array(
		  		'title' => $this->input->post('title'),
				'mva' => $this->input->post('mva'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'numtax' => $this->input->post('numtax'),
				'pid' => $this->input->post('pid'),
				'namere' => $this->input->post('namere'),
				'positionre' => $this->input->post('positionre'),
				'phonere' => $this->input->post('phonere'),
				'city' => $this->input->post('city'),
				'Ward' => $this->input->post('Ward'),
				'address' => $this->input->post('address'),	
				'bank' => $this->input->post('bank'),
				'branch' => $this->input->post('branch'),
				'numbank' => $this->input->post('numbank'),
				'namebank' => $this->input->post('namebank'),
				'description' => $this->input->post('description')
  		);
  		$this->Quanglykho_model->update_sup($id,$sup);
  		redirect(base_url()."admin.php/quanglykho/nhacungcap");
	}
  
	function company_edit($id) {
  		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['dstp'] = $this->Quanglykho_model->findAll_city();
			$data['sup'] = $this->Quanglykho_model->find_sup($id);
			$this->my_layout->view("company_edit_view",$data);
		}
		else
        {  
			redirect(base_url()."admin.php/dashboard");    
        }
	}

	function active0_1($id) {
		$sup = $this->Quanglykho_model->find_sup($id);
		$sup->active = "1";
		$this->Quanglykho_model->update_sup($id,$sup);
		redirect(base_url()."admin.php/quanglykho/nhacungcap");
	}
	function active1_0($id) {
		$sup = $this->Quanglykho_model->find_sup($id);
		$sup->active = "0";
		$this->Quanglykho_model->update_sup($id,$sup);
		redirect(base_url()."admin.php/quanglykho/nhacungcap");
	}
	
 	
}	
?>