<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {
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
		$this->load->model("NEWSLETTER_Model");
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
		
	}
	
	public function regist()
	{
		$data['links'] = $this->GLOBAL_Model->urllink();
		//lang
		$curent_lang = $this->uri->segment(3);
		$data['language' ]=$this->my_lang->setLanguage($curent_lang);
		
		//end lang
		$new_email	= $this->input->post('email');
		$new_email  = strtolower($new_email);
		$actionletter = 1;
		
		if ((!$new_email) || ($new_email=="") || (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/",$new_email)) || (strrpos($new_email,' ') > 0)) {
			$info = lang('_NEW_NOEMAIL');
			$actionletter = 0;
		}

			$numrow = $this->NEWSLETTER_Model->GetNewsletter($new_email);
			if(sizeof($numrow) != 0) {
			$info = lang('_NEW_ALREADY');
			$actionletter = 0;
			}
			
			if ($actionletter == 0) {
				$data['report'] = $info;
				$this->my_layout->view("report_view",$data);
			} elseif ($actionletter == 1) {
			srand ((double)microtime()*1000000);
			$mycode = rand();
			$time = time();
			list($newest_uid) = $this->NEWSLETTER_Model->GetMaxNewsletter();
			
			if ($newest_uid == "-1") { $new_uid = 1; } else { $new_uid = $newest_uid+1; }
			
			$input_data = array(
				'id' 				=> $new_uid,
				'email' 			=> $new_email,
				'status'			=> 1,
				'html'				=> 0,
				'checkkey'			=> $mycode,
				'time'				=> $time,
				'newsletterid'		=> ''
			);
			
			$result = $this->NEWSLETTER_Model->AddNewsletter($input_data);
			
			if(!$result) { return; }
			
			include ('./path/to/config/mail_config.php');
			$buildlink = base_url()."index.php/newsletter/confirm/".$new_email."/".$mycode;
			$message = "".lang('_NEW_CONFTEXT')."\n\n$buildlink";
			$subject = "".lang('_NEW_SUBJECT')."";
			$mailhead = "From: TRUONG THINH PHU Company <$mail_email>\n";
			//$mailhead .= "Content-Type: text/plain; charset= ".lang('_CHARSET')."\n";
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
			//mail($new_email, $subject, $message, $mailhead);
			$this->email->from($mailto, $mailhead);
			$this->email->to($new_email);
			$this->email->cc($new_email);
			$this->email->bcc($new_email);
			
			$this->email->subject($subject);
			$this->email->message($message);
			
				if($this->email->send(FALSE)){
					$str = "<center>".lang('_NEW_SENOK')."<br><br>"
				."<a href=\"".base_url()."index.php/home\"><b>".lang('_NEW_GOINDEX')."</b></a></center>";
					$data['report'] = $str;
					$this->my_layout->view("report_view",$data);
				}else{
					$data['report'] = "Cannot send email";
					$this->my_layout->view("report_view",$data);
				}
			}
	}
	
	public function Confirm() {
		
		//lang
		$curent_lang = $this->uri->segment(3);
		$data['language' ]=$this->my_lang->setLanguage($curent_lang);
		
		//end lang
		$new_email = $this->uri->segment(2);
		$new_check = $this->uri->segment(3);
		$past = time()-86400;
		
			$db->sql_query("DELETE FROM ".$prefix."_newsletter WHERE (time < '$past' AND status='1')");
			$db->sql_query("OPTIMIZE TABLE ".$prefix."_newsletter");
		  if ($db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_newsletter WHERE (status='1' AND email='$new_email' AND checkkey = '$new_check')")) != 1) {
		  include("header.php");
		  OpenTable();
			echo "<center>"._NEW_SUBNOT."<br><br>"
			."<a href=\"modules.php?name=$module_name&amp;func=def\">"._NEW_CLICKHERE."</a></center>";
			CloseTable();
		  include("footer.php");
			return;
		  }
			srand ((double)microtime()*1000000);
			$mycode = rand();
		  $query = $db->sql_query("UPDATE ".$prefix."_newsletter SET status='2', checkkey = '$mycode' WHERE email='$new_email'");
		  if(!$query) { return; }
		  include("header.php");
		  OpenTable();
		  echo "<center>"._NEW_SUBOK."<br>"
		  ."<a href=\"modules.php?name=$module_name&amp;func=def\"><b>"._NEW_GOINDEX."</b></a></center>";
		  CloseTable();
		  include("footer.php");
		}

	
}
