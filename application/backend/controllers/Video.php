<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller
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
	$this->load->model("Video_model");
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
			
			$result	=	$this->Video_model->GetAllVideo();
			$numrow	=	sizeof($result);
			$v		= 	array();
			if($numrow!=0){
				$i=0;
				foreach($result as $row)
				{
					$idtheloai=$row["id_theloai"];
					$tl = $this->Video_model->GetTheLoai($idtheloai);
					
					$v[$i] 					= $row;
					$v[$i]['tentheloai']	= $tl[0]['theloai'];
					
					$i++;
				}
				$data['video'] = $v;
				$this->my_layout->view("video_view",$data); 
				
			}else {
				
				$this->my_layout->view("logoerror_view",array('error'=>"Video tải lên bị lỗi"));
				
			}
			
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function addvideo(){
	  	if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Logo' => '#');
			
			//code here
			
			$data['theloai'] = $this->theloai();
			$data['ihome']	= $this->ihome();
			$this->my_layout->view("videoadd_view",$data); 
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function ihome($ihome=0){
	  
	  $str="";
	  if($ihome==0){
	  $str.="<input type=\"radio\" class=\"no_uniform\" name=\"ihome\" value=\"1\">Yes<input type=\"radio\" class=\"no_uniform\" name=\"ihome\" value=\"0\" checked=\"checked\">No";
	  }else{
	  $str.="<input type=\"radio\" class=\"no_uniform\" name=\"ihome\" value=\"1\" checked=\"checked\">Yes<input type=\"radio\" class=\"no_uniform\" name=\"ihome\" value=\"0\">No";
	  }
	  return $str;
  }
  
  public function theloai($idtheloai=0){
	  
	  $result = $this->Video_model->GetAllTheLoai();
	  $str="";
	  $str.='<select name="theloai">';
	  foreach($result as $row)
	  {
		if($row['id']==$idtheloai)
		  	$str.='<option value="'.$row['id'].'" selected="selected">'.$row['theloai'].'</option>';
		else
			$str.='<option value="'.$row['id'].'">'.$row['theloai'].'</option>';
	  }
	  $str.='</select>';
	  return $str;
  }
  
  public function savevideo(){
	  
		$title 		= $this->input->post('title');
		$theloai	= $this->input->post('theloai');
		$address	= $this->input->post('address');
		$ihome		= $this->input->post('ihome');
		
		$data_input = array(
			'name'	=> $title,
			'url'	=> $address,
			'id_theloai' => $theloai,
			'ihome' => $ihome
		);
		
		if($this->Video_model->InsertVideo($data_input)){
			
			redirect(base_url()."index.php/video/index");
			
		}else{
			
			$this->my_layout->view("logoerror_view",array('error'=>"Không thể upload video")); 		
		}
  }
  
  public function editvideo(){
	  	if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Logo' => '#');
			
			//code here
			$id = $this->uri->segment(3);
			$result = $this->Video_model->GetVideo($id);
				$idtheloai = $result[0]['id_theloai'];
				$ihome = $result[0]['ihome'];
			$data['theloai'] = $this->theloai($idtheloai);
			$data['ihome']	= $this->ihome($ihome);
			$data['video']	= $result;
			$this->my_layout->view("videoedit_view",$data); 
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function saveeditvideo(){
	  
	  	$id 		= $this->uri->segment(3);
		$title 		= $this->input->post('title');
		$theloai	= $this->input->post('theloai');
		$address	= $this->input->post('address');
		$ihome		= $this->input->post('ihome');
		
		$data_input = array(
			'name'	=> $title,
			'url'	=> $address,
			'id_theloai' => $theloai,
			'ihome' => $ihome
		);
		
		if($this->Video_model->UpdateVideo($data_input,$id)){
			
			redirect(base_url()."index.php/video/index");
			
		}else{
			
			$this->my_layout->view("logoerror_view",array('error'=>"Không thể upload video")); 		
		}
  }
  
  public function deletevideo(){
	  
		$id = (int)$this->uri->segment(3);
		
		if($this->Video_model->DeleteVideo($id)){
			
			redirect(base_url()."index.php/video/index");
			
		}else{
			
			$this->my_layout->view("logoerror_view",array('error'=>"Không thể xóa video")); 		
		}
  }			
}

?>