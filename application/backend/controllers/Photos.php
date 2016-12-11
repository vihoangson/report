<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photos extends CI_Controller
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
    $this->load->model("Product_model");
	$this->load->model("Global_Model");
	//$this->login();
	
	/*$this->load->helper('language');
	$this->lang->load(substr(LANGUAGE,0,2),LANGUAGE);*/
	
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
			$data['p'] = array ( 'Home' => base_url(), 'Photos' => '#');
			
			//code here
			$list = array();
			$exlist  =	array('.', '..', 'index.html');
			$dir = opendir('../uploads/gallery/');
			while($func = readdir($dir)) {
				if(!in_array($func, $exlist)){$list[]= $func;}
			}
			closedir($dir);
			sort($list);
			$data['list'] = $list;
			
			$this->my_layout->view("photos_view",$data); 
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function addphotos(){
	  
	$images	=	"";
    $images = 	$this->Global_Model->uploadimage('../uploads/gallery/', 762, 460, $images);
    if (!$images) {
    $this->my_layout->view("logoerror_view",array('error'=>"Hình ảnh tải lên bị lỗi")); 	
    exit;
    }
    redirect(base_url()."index.php/photos/index");
  }
  
  public function deletephotos(){
	  $poz = $this->uri->segment(3,0);
	  
	  		$list = array();
			$exlist  =	array('.', '..', 'index.html');
			$dir = opendir('../uploads/gallery/');
			while($func = readdir($dir)) {
				if(!in_array($func, $exlist)){$list[]= $func;}
			}
			closedir($dir);
			sort($list);
			
		if($poz =="" || !in_array($poz,$list) || !file_exists('../uploads/gallery/'.$poz)) { redirect(base_url()."index.php/photos/index"); exit;}
		
		
		@unlink('../uploads/gallery/'.$poz);
		redirect(base_url()."index.php/photos/index");
  }
  
  	public function deleteallphotos()
	{
		$ap = $this->input->post('dall');
	 
	  	foreach($ap as $v)
	  	{
			$image = $v;
			
			if($image && file_exists('../uploads/gallery/'.$image))
			{
				@unlink('../uploads/gallery/'.$image);
			}
	  	}
	  	redirect(base_url()."index.php/photos/index");
	}
	
}

?>