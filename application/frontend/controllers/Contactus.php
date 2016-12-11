<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper(array('url','form','file','global'));

		$this->load->helper('captcha');
		$this->load->library(array("form_validation","session"));
		$this->load->library('email');
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
		
		$modulename = ucfirst($this->uri->segment(1));
		$data['contactus'] = $this->NEWS_Model->AllStories(6,0,$modulename);
		
		$this->my_layout->view("contactus_view",$data); 
	}
	
	public function sendmail()
	{
		$this->load->library('email');
		
		$data['links'] 		= $this->GLOBAL_Model->urllink();
		$info 				= $this->input->post();
		$firstname 			= $info['billing']['firstname'];
		$email	 			= $info['billing']['email'];
		$company 			= $info['billing']['company'];
		$phone	 			= $info['billing']['phone'];
		$street1	 		= $info['billing']['street'][0];
		$street2	 		= $info['billing']['street'][1];
		$comment	 		= $info['comment'];
		
		$mess = '<table class="table">
		<tr><td>Company</td><td>'.$company.'</td></tr>
		<tr><td>Phone</td><td>'.$phone.'</td></tr>
		<tr><td>Street</td><td>'.$street1.'</td></tr>
		<tr><td>Street</td><td>'.$street2.'</td></tr>
		<tr><td>Comment</td><td>'.$comment.'</td></tr>
		</table>';
		
		include ('./path/to/config/mail_config.php');

		if($checkmail==0){
			
			$config = array();
            $config['useragent']           = "CodeIgniter";
            $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
            $config['protocol']            = "smtp";
            $config['smtp_host']           = "localhost";
            $config['smtp_port']           = "25";
            $config['mailtype'] = 'html';
            $config['charset']  = 'utf-8';
            $config['newline']  = "\r\n";
            $config['wordwrap'] = TRUE;

			
			$this->email->initialize($config);
			$mailto = $mail_email;
		
		}else{
		
			$config = array(
					'protocol' => 'smtp',
					'smtp_host' => $mail_mailserver,
					'smtp_user' => $mail_username,
					'smtp_pass' => $mail_password,
					'mailtype'  => 'html', 
					'charset' => 'utf-8',
					'wordwrap' => TRUE
			
			);
			$mailto = $mail_email;
			$this->email->initialize($config);
			
		}
		$this->email->from($email, $firstname);
		$this->email->to($mailto);
		$this->email->cc($mailto);
		$this->email->bcc($mailto);
		
		$this->email->subject($company);
		$this->email->message($mess);

		if($this->email->send(FALSE)){
			$data['report'] = "Đã gửi email thành công";
			$this->my_layout->view("report_view", $data); 
		}else{
			show_error($this->email->print_debugger());
		}
	}
	
}
