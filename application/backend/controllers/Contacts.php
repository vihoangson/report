<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	$this->load->helper(array('url','form','global'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	        
    $this->load->database();
    $this->load->model("Auth_model");
	$this->load->model("Contact_model");
	$this->load->model("Global_Model");
	//$this->login();
	
	$this->load->library("MY_layout"); // Sử dụng thư viện layout
    $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)

  }

  public function index(){
		// If the user is validated, then this function will run
		if($this->my_auth->is_Admin())
        {
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Blocks' => '#');
			
			//code here
			
			$max = sizeof($this->Contact_model->GetAllContact());
			$min = 12;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/contact/index";
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
				$data['contact'] = $this->Contact_model->GetAllContact($min,$this->uri->segment($config['uri_segment']));
			
			$this->my_layout->view("contact_view",$data);
			}
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  public function addcontact()
  {
		
	  	$name 		=	$this->input->post('name');
		$handphone 	=	$this->input->post('handphone');
		$telephone 	=	$this->input->post('phone');
		$email 	=	$this->input->post('email');
		$yahoo 	=	$this->input->post('yahoo');
		$skype 	=	$this->input->post('skype');
		
	 
		$input_data= array(	
		"name" 			=> 	$name,
		"handphone" 	=> 	$handphone,
		"telephone" 	=> 	$telephone,
		"email" 		=> 	$email,
		"yahoo" 		=> 	$yahoo,
		"skype" 		=> 	$skype
		);
		
		if($this->Contact_model->addContact($input_data))
		{
			redirect(base_url()."index.php/contacts/index");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/contacts/index");
		}
  }
  
  public function editcontact()
  {
	  	if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Contact' => '#');
			
			
			$id = $this->uri->segment(3,0);
			$data['contact'] = $this->Contact_model->getContact($id);
		
			$this->my_layout->view("editcontact_view",$data); //add product
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	  	
  }
  
  public function saveeditcontact()
  {
		$id = $this->uri->segment(3,0);
		
		
		$name 		=	$this->input->post('name');
		$handphone 	=	$this->input->post('handphone');
		$telephone 	=	$this->input->post('phone');
		$email 	=	$this->input->post('email');
		$yahoo 	=	$this->input->post('yahoo');
		$skype 	=	$this->input->post('skype');
		
	 
		$input_data= array(	
		"name" 			=> 	$name,
		"handphone" 	=> 	$handphone,
		"telephone" 	=> 	$telephone,
		"email" 		=> 	$email,
		"yahoo" 		=> 	$yahoo,
		"skype" 		=> 	$skype
		);
	
		
		if($this->Contact_model->updateContact($input_data,$id))
		{
			redirect(base_url()."index.php/contacts/index");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/contacts/index");
		}
  }
  
  public function deletecontact()
  {
	  	$id = $this->uri->segment(3,0);
		
		if($this->Contact_model->deleteContact($id))
		{
			redirect(base_url()."index.php/contacts/index");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/contacts/index");
		}
  }
  
  public function deleteallcontact()
  {
	   	$ap = $this->input->post('dall');
	 
	  	if($this->Contact_model->deleteContactMulti($ap))
	  		redirect(base_url()."index.php/contacts/index");
		else
			redirect(base_url()."index.php/contacts/index");
  }
  
}

?>