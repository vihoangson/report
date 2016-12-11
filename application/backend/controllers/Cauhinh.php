<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cauhinh extends CI_Controller
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
		$this->load->model("Auth_model");
		$this->load->model("Cauhinh_model");
		$this->load->model("Global_Model");
		//$this->login();

		$this->load->helper('global');

		$this->load->library("MY_layout"); // Sử dụng thư viện layout
		$this->my_layout->setLayout("template_upload"); // load file layout chính (views/template.php)
	}

	function index() {
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['option1'] = $this->Cauhinh_model->find(1);
			$data['option2'] = $this->Cauhinh_model->find(2);
			$data['option3'] = $this->Cauhinh_model->find(3);
			$data['option4'] = $this->Cauhinh_model->find(4);
			$data['option5'] = $this->Cauhinh_model->find(5);
			$data['option6'] = $this->Cauhinh_model->find(6);
			$data['option7'] = $this->Cauhinh_model->find(7);
			$data['option8'] = $this->Cauhinh_model->find(8);
			$data['option9'] = $this->Cauhinh_model->find(9);
			$data['option11'] = $this->Cauhinh_model->find(11);
			
			$this->my_layout->view("cauhinh_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	}
	
	function update() {
		$value1 = array('option_value' => $this->input->post('name1'));
		$value2 = array('option_value' => $this->input->post('name2'));
		$value3 = array('option_value' => $this->input->post('name3'));
		$value4 = array('option_value' => $this->input->post('name4'));
		$value5 = array('option_value' => md5($this->input->post('name5')));
		$value6 = array('option_value' => $this->input->post('name6'));
		$value7 = array('option_value' => $this->input->post('name7'));
		$value8 = array('option_value' => $this->input->post('name8'));
		$value9 = array('option_value' => $this->input->post('name9'));
		$value11 = array('option_value' => $this->input->post('name11'));

		$this->Cauhinh_model->update(1,$value1);
		$this->Cauhinh_model->update(2,$value2);
		$this->Cauhinh_model->update(3,$value3);
		$this->Cauhinh_model->update(4,$value4);
		$this->Cauhinh_model->update(5,$value5);
		$this->Cauhinh_model->update(6,$value6);
		$this->Cauhinh_model->update(7,$value7);
		$this->Cauhinh_model->update(8,$value8);
		$this->Cauhinh_model->update(9,$value9);
		$this->Cauhinh_model->update(11,$value11);
		
		redirect(base_url()."admin.php/cauhinh");
	}
	
	function logo() {
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['option10'] = $this->Cauhinh_model->find(10);
			
			
			$this->my_layout->view("slogan_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	}
	
	function upload(){
		if (!empty($_FILES)) {
        $tempFile = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $targetPath = getcwd() . '/uploads/logo/';
		
				$f_name = explode(".",$fileName);
				$extension = strtolower($f_name[1]);
				$datakod = date('U');
				$newfname= "".$datakod.".".$extension."";
				
        $targetFile = $targetPath . $newfname ;
        move_uploaded_file($tempFile, $targetFile);
		
		$config['source_image']     = $targetFile;
        $config['maintain_ratio']   = FALSE;
		$config['width']            = 275;
        $config['height']           = 137;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        // if you want to save in db,where here
		$value10 = array('option_value' => $newfname);
        $this->Cauhinh_model->update(10,$value10);
        }
	}
}

?>