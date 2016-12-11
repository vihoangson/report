<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller
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
			$data['p'] = array ( 'Home' => base_url(), 'Mail' => '#');
			
			//code here
			include ('../path/to/config/mail_config.php');
			$data['mail_email']	= $mail_email;
			$data['checkmail']	= $checkmail;
			
			$data['mail_mailserver']	= $mail_mailserver;
			$data['mail_username']		= $mail_username;
			$data['mail_password']		= $mail_password;
			
			$this->my_layout->view("mail_view",$data);
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  
  function savemail()
  {
		$address 		= $this->input->post('address');
		$typemail 		= $this->input->post('typemail');
		$mailserver		= $this->input->post('mailserver');
		$mailpassword	= $this->input->post('mailpassword');
		$mailusername	= $this->input->post('mailusername');
	
		@chmod('../path/to/config/mail_config.php', 0777);
		@$file = fopen('../path/to/config/mail_config.php', "w");
		if (!$file) 
		{
			redirect(base_url()."index.php/mail/index");
		}
		$note = "\n/***************************************************************************"
				."\n*                                mail.php"
				."\n*                            -------------------"
				."\n*   begin                : friday, Juanuary 12, 2007"
				."\n*   copyright            : (C) 2007 me"
				."\n*   email                : tahongtram@gmail.com"
				."\n*   file: mail.php"
				."\n*"
				."\n***************************************************************************/\n";
				
		$content = "<?php\n\n$note";
		$content .= "\$checkmail = $typemail;\n/*\n0 - mail() \n 1- smtp\n*/\n";
		$content .= "\$mail_email = \"$address\";\n";
		$content .= "\$mail_username =\"$mailusername\";\n";
		$content .= "\$mail_password = \"$mailpassword\";\n";
		$content .= "\$mail_mailserver =\"$mailserver\";\n";
		$content .= "\n";
		$content .= "?>\n";
		@$writefile = fwrite($file, $content);
		if (!$writefile) {
			redirect(base_url()."index.php/mail/index");
		}
		
		@fclose($file);
		@chmod('../path/to/config/mail_config.php', 0604);
		redirect(base_url()."index.php/mail/index");
	}// end function SaveMail				
 
}

?>