<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	
	$this->load->helper(array('url','form','file','global'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	$this->load->library('upload');
	//$this->load->library("FCKeditor");
	        
    $this->load->database();
	$this->load->model("Auth_model");
	$this->load->model("Global_Model");
	$this->load->model("Newsletter_model");
	//$this->login();
	
	
	$this->load->library("MY_layout"); // Sử dụng thư viện layout
    $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)

  }

  public function index(){
		//If the user is validated, then this function will run
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Video' => '#');
			
			//code here
			
			$result	=	$this->Newsletter_model->GetAllNewsletter();
			$numrow	=	sizeof($result);
			if($numrow!=0){
				$data['newsletter'] = $result;
				$this->my_layout->view("newsletter_view",$data); 
				
			}else {
				$data['error'] = "Danh sách đăng ký email bị lỗi";
				$this->my_layout->view("logoerror_view",$data);
				
			}
			
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function deletenewsletter(){
	  
		$id = (int)$this->uri->segment(3);
		
		if($this->Newsletter_model->DeleteNewsletter($id)){
			
			redirect(base_url()."index.php/newsletter/index");
			
		}else{
			
			$data['error'] = "Danh sách đăng ký email bị lỗi";
			$this->my_layout->view("logoerror_view",$data);		
		}
  }			
}

?>