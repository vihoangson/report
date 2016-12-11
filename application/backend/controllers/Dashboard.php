<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	$this->load->helper(array('url','form'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	        
    $this->load->database();
    $this->load->model("Auth_model");
	$this->load->model("Global_Model");
	//$this->login();
	
	$this->lang->load(array('en'));
	$this->load->library("MY_layout"); // Sử dụng thư viện layout
    $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)

  }

  public function index(){
		// If the user is validated, then this function will run
		//echo "<h2>Hello Codeigniter Framework</h2>";
        $this->login();
  }
  
  function login()
  {
	  	//print_r($this->session->all_userdata());
	  
        if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
        {
            redirect(base_url()."admin.php/dashboard/auth");
            exit();
        }
        
        $this->form_validation->set_rules("username","Username","required");
        $this->form_validation->set_rules("password","Password","required");
		$this->form_validation->set_rules("email","Email","required");
        
        if($this->form_validation->run()==FALSE)
        {
            $this->my_layout->view("login_view",array("error"=>""));            
        }
        else
        {   
             $u = $this->input->post("username");
             $p = $this->input->post("password");
			 $e = $this->input->post("email");
             $session = $this->Auth_model->checkLogin($u,$p,$e);
             if($session)
             {
                 /*if(!$this->my_auth->is_Active($session['aid'])){
                    $data['error'] = "Please check mail and active your account !";
                    $this->my_layout->view("login",$data);
                 }
                 else
                 {*/
                     $data = array('admin' => array(
                                    "name"  => $session['name'],
                                    "aid"    => $session['aid'],
									"email"  => $session['email'],
                                    "radminsuper"  => $session['radminsuper'],
                                ));    
                     $this->session->set_userdata($data);
                     redirect(base_url()."admin.php/dashboard/auth");
                 //}
                 
             }
             else
             {  
                $this->my_layout->view("login_view",array("error"=>"Username or Password wrong"));    
             }
        }
    }
	
	//---- Logout
    function logout()
    {
        $this->my_auth->sess_destroy();
		$root = dirname(base_url());
		redirect($root);
    }
  
	//---- Auth
	function Auth()
	{
		//echo $this->session->sess_expiration."xxx";
		//print_r($this->session->all_userdata());
		if(!empty($this->session->userdata['admin']['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			
			
			$max = $this->Auth_model->num_rows();
			$min = 6;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/user";
				$config['total_rows'] = $max;
				$config['per_page'] = $min;
				$config['num_link'] = 3; 
				$config['uri_segment'] = 4;
				$this->pagination->initialize($config);
				
				$data['link'] = $this->pagination->create_links();
				$data['authors'] = $this->Auth_model->getAuthors($min,$this->uri->segment($config['uri_segment']));
				
				$this->my_layout->view("dashboard_view",$data);
			
			}else{
	
				$data['report'] = "Khong co du lieu de hien thi";
				$this->my_layout->view("report",$data);
			}
		}
		else
        {  
        	$this->my_layout->view("login_view",array("error"=>"Error login")); 
        }
	}
	
	//Edit Auth
	function Authedit()
	{
		//echo $this->input->post('aid');
	}
	
	public function changepass()
	{
		//echo $this->session->sess_expiration."xxx";
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
				
			$this->my_layout->view("changepass_view",$data);
			
		}
		else
        {  
        	$this->my_layout->view("login_view",array("error"=>"Error login"));
        }
	}
	
	public function saveeditpass(){
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');	
			
			$oldpass	= $this->input->post('oldpass');
			$newpass    = $this->input->post('newpass');
			$renewpass  = $this->input->post('renewpass');
			$flag=1;
			if($Au['pwd'] != md5($oldpass)){
				$str="Sai mật khẩu cũ";
				$flag=0;
			}
			if($newpass!=$renewpass){
				$str="Mật khẩu lặp lại không giống mật khẩu mới";
				$flag=0;
			}
			
			if($flag==0){
				$data['error'] = $str;
        		$this->my_layout->view("logoerror_view", $data);    
			}else{
				$aid = $Au['aid'];
				$data_input = array('pwd'=> md5($newpass));
				if($this->Auth_model->updateAuthor($data_input,$aid)){
					
					$this->my_auth->sess_destroy();
					redirect(base_url());
					
				}else{
					
					$data['error'] = "Không cập nhật được mật khẩu";
        			$this->my_layout->view("logoerror_view", $data);  
					
				}
			}
			
		}
		else
        {  
			$data['error'] = "Lỗi đăng nhập";
        	$this->my_layout->view("login_view", $data);    
        }
		
	}
	
	public function changeprofile()
	{
		//echo $this->session->sess_expiration."xxx";
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
				
			$this->my_layout->view("changeprofile_view",$data);
		}
		else
        {  
        	$this->my_layout->view("login_view",array("error"=>"Error login"));
        }
	}
	
	public function savechangeprofile(){
	  
	  if(!empty($this->session->userdata['aid']))
	  {
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
		
			
		  $dimages		= (int) $this->input->post('delimg');
		 
		  $name 		= $this->input->post('name')?$this->input->post('name'):$Au['name'];
		  $email 		= $this->input->post('email');
		  $image		= $Au['avatar'];
		  $aid			= $Au['aid'];
		 
		  if($dimages)
		  {	
				$images="";
				$images = $this->Global_Model->uploadimage('../admin/gallery/',60,60,$image,'yes');
		  }
		  else
		  {
				$images = $image;
		  }
	  	  $data_input = array(
		  "name"	=> $name,
		  "email"	=> $email,
		  "avatar"	=> $images);
		  
		  
		  if($this->Auth_model->updateAuthor($data_input,$aid)){
			
			 redirect(base_url()."index.php/dashboard/changeprofile");
			  
		  }else{
					
			 $data['error'] = "Không cập nhật được thông tin cá nhân";
        	 $this->my_layout->view("logoerror_view", $data);  
					
		  }
	  
    	}
		else
        {  
        	$this->my_layout->view("login_view",array("error"=>"Error login"));
        }
  }
	
}

?>