<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	function __construct()
	{
		  parent::__construct();
          $this->load->helper(array('url','form','file','global','cookie'));
          $this->load->database();
          $this->load->library(array('session','form_validation'));
        
		  $this->load->library("MY_user");
		  $this->load->library("MY_layout");
    	  $this->my_layout->setLayout("template_view"); 
          $this->load->database();
          //lang
	
		$this->load->model("GLOBAL_Model");
		$this->load->model("SHOP_Model");
		$this->load->model("ADVERTISE_Model");
		$this->load->model("USER_Model");
		//$this->load->model("login_model");
     }

     public function index()
     {
		  //is user
		  if($this->my_user->is_User())
          {
            redirect(base_url()."index.php/Welcome/index");
            exit();
          }
          //get the posted values
          $username = $this->input->post("username");
          $password = $this->input->post("password");
		  
          //set validations
          $this->form_validation->set_rules("username", "Username", "trim|required");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
			$this->my_layout->view('login_view');
          }
          else
          {
          	//validation succeeds
			if ($this->input->post('btn_login') == "Đăng nhập")
			{
				//check if username and password is correct
				$usr_result = $this->USER_Model->get_user($username, $password);
				if ($usr_result > 0) //active user record is present
				{
					//set the session variables
                    $session = array(
						'client' => array(
									"session_id" => session_id(),
                                    "name"  => $usr_result['username'],
                                    "uid"    => $usr_result['user_id'],
									"email"  => $usr_result['user_email'],
                                )
					);
                    $this->session->set_userdata($session);
					//CART
					$g = sizeof($this->session->userdata('guest'))!=0?$this->session->userdata('guest'):NULL;
					$u = sizeof($this->session->userdata('client'))!=0?$this->session->userdata('client'):NULL;

					if($g!=NULL && $u!=NULL){
						//update uid
						$mva = $this->session->userdata('__ci_last_regenerate');
						$up = json_decode($g['cart'], true);
						foreach($up as $k=>$val){
							$data_detail=array(
								"order_uname" => $u['uid']
							);
							$this->SHOP_Model->updateShoporder($mva, $data_detail);
						}
						//remove guest
						$u['cart'] = $g['cart'];
						$u['session_id'] = $g['session_id'];
						$this->session->set_userdata('client',$u);
						$this->session->unset_userdata('guest');
					}
					
					//update order & order_detail
					redirect(base_url().'index.php/Welcome/index');
				}
				else
				{
					$this->my_layout->view("login_view",array("error"=>"Username or Password wrong"));  
				}
			}
			else
			{
				redirect(base_url().'index.php/User/index');
			}             
		  }
		
     }
	 
	//---- Logout
    function logout()
    {
        //$this->my_auth->sess_destroy();
		if($this->my_user->is_User()){
			$this->session->unset_userdata('client');
			$this->my_user->sess_destroy();
			redirect(base_url().'index.php/Welcome/index');
		}
	 }
	 
	 
	function Info()
    {
		//print_r($this->session->userdata['client']);
		if($this->my_user->is_User()){
			$u = $this->USER_Model->getInfo($this->session->userdata['client']['uid']);
			$data['user'] = $u;
			$data['format']='d-F-Y';
			
			$this->my_layout->view('user_info_view', $data);
		}
	 }
}

?>