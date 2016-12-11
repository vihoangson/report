<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Qlsanpham extends CI_Controller
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
		$this->load->model("Nhanvien_model");
		$this->load->model("Global_Model");
		//$this->login();

		$this->load->helper('global');

		$this->load->library("MY_layout"); // Sử dụng thư viện layout
		$this->my_layout->setLayout("template"); // load file layout chính (views/template.php)
	}

	function danhmuc() {
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			
			$this->my_layout->view("spdanhmuc_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	}
}