<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quanglynhanvien extends CI_Controller
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

		$this->load->library("MY_layout"); 
		$this->my_layout->setLayout("template"); // load file layout chÃ­nh (views/template.php)
	}

	function nhanvien() {
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['chucvus'] = $this->Nhanvien_model->findAll_position();
			$data['nhanviens'] = $this->Nhanvien_model->findAll_emp();
			$this->my_layout->view("employee_view",$data);
		}
		else
		{
			redirect(base_url()."admin.php/dashboard");
		}
	}

	function employee_add() {
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['chucvus'] = $this->Nhanvien_model->findAll_position();
			$this->my_layout->view("employee_add_view",$data);
		}
		else
		{
			redirect(base_url()."admin.php/dashboard");
		}
	}

	function employee_save() {
		$pic= "";
		if($_FILES['userfile']['name']!=null){
	 		$pic = $this->Global_Model->uploadimage(FCPATH.'uploads/gallery/', 200, 100, $img, "yes");
	 	}
		
		$tk = array(
			"name" => $this->input->post('name'),
			"level" => $this->input->post('level'),
			"pass" => md5($this->input->post('pass')),
			"email" => $this->input->post('email'),
			"fullname" => $this->input->post('fullname'),
			"birthday" => $this->input->post('birthday'),
			"sex" => $this->input->post('sex'),
			"datein" => $this->input->post('datein'),
			"dateout" => $this->input->post('dateout') != null ? $this->input->post('dateout') : null,
			"address" => $this->input->post('address'),
			"phone" => $this->input->post('phone'),
			"CMND" => $this->input->post('CMND'),
			"active" => $this->input->post('active'),
			"icon" =>  $pic != null ? $pic : null
	 		);
	 		$this->Nhanvien_model->insert_emp($tk);
	 		redirect(base_url()."admin.php/quanglynhanvien/nhanvien");
	}

	function active_lock($key) {
		$tk = $this->Nhanvien_model->find_emp($key);
		$tk->active = 1;
		$this->Nhanvien_model->update_emp($key,$tk);
		redirect(base_url()."admin.php/quanglynhanvien/nhanvien");
	}

	function unactive_lock($key) {
		$tk = $this->Nhanvien_model->find_emp($key);
		$tk->active = 0;
		$this->Nhanvien_model->update_emp($key,$tk);
		redirect(base_url()."admin.php/quanglynhanvien/nhanvien");
	}

	function del_emp($key) {
		$this->Nhanvien_model->delete_emp($id);
		redirect(base_url()."index.php/quanglynhanvien/nhanvien");
	}

	function employee_edit($key) {
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['chucvus'] = $this->Nhanvien_model->findAll_position();
			$data['nhanvien'] = $this->Nhanvien_model->find_emp($key);
			$this->my_layout->view("employee_edit_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	}

	function employee_update($key) {
		
		$nv= $this->Nhanvien_model->find_emp($key);
		$img = $nv->icon;
		if($_FILES['userfile']['name']!=null){
	 		$pic = $this->Global_Model->uploadimage(FCPATH.'uploads/gallery/', 200, 100, $img, "yes");
	 	}
		
		if($nv->pass != $this->input->post("pass")){
	 		echo "<script language='javascript'>alert('Mật khẩu không khớp');";
	 		echo 'location.href="'.base_url().'index.php/quanglynhanvien/emp_edit/'.$nv->CMND.'";</script>';
	 	}
		
			$tk = array(
			"level" => $this->input->post('level'),
			"email" => $this->input->post('email'),
			"fullname" => $this->input->post('fullname'),
			"birthday" => $this->input->post('birthday'),
			"sex" => $this->input->post('sex'),
			"datein" => $this->input->post('datein'),
			"dateout" => $this->input->post('dateout') != null ? $this->input->post('dateout') : null,
			"address" => $this->input->post('address'),
			"phone" => $this->input->post('phone'),
			"CMND" => $this->input->post('CMND'),
			"icon" => $pic != null ? $pic : $img
	 		);
	 		$this->Nhanvien_model->update_emp($key,$tk);
			redirect(base_url()."admin.php/quanglynhanvien/nhanvien");
	}
	///////////////////////Create authors///////////////////////

	function user_map($cmnd) {
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
		
			$data['a'] = $this->Nhanvien_model->find_emp($cmnd);
			print_r($data['a']);
			$this->my_layout->view("author_view",$data);
		}
		else
		{
			redirect(base_url()."admin.php/dashboard");
		}
	}


	function author_save() {
		$pic= "";
		if($_FILES['userfile']['name']!=null){
	 		$pic = $this->Global_Model->uploadimage(FCPATH.'uploads/gallery/', 200, 100, $img, "yes");
	 	}
		
		$tk = array(
			"email" => $this->input->post('email'),
			"name" => $this->input->post('name'),
			"aid" => $this->input->post('aid'),
	 		"pwd" => md5($this->input->post('pwd')),
			"avatar" => $pic != null ? $pic : null,
	 		"radminsuper" => $this->input->post('level'),
	 		);
	 		$this->Nhanvien_model->insert_auth($tk);
	 		redirect(base_url()."admin.php/quanglynhanvien/nhanvien");
	}

	/////////////////////////////////////////////////////////
	function chucvu() {
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Dashboard' => '#');
			$data['chucvus'] = $this->Nhanvien_model->findAll_position();

			$this->my_layout->view("position_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	}

	
	function position_save() {
		$tk = array(
  		'title' => $this->input->post('title')
		);
		$this->Nhanvien_model->insert_position($tk);
		redirect(base_url()."admin.php/quanglynhanvien/chucvu");
	}
	
	function position_update($id) {
		$id = $this->input->post('id');
		$tk = array(
  		'title' => $this->input->post('title')
		);
		$this->Nhanvien_model->update_position($id,$tk);
		redirect(base_url()."admin.php/quanglynhanvien/chucvu");
	}

	function position_delete($id) {
		$id = $this->input->post('id');
		$this->Nhanvien_model->delete_position($id);
		redirect(base_url()."admin.php/quanglynhanvien/chucvu");
	}
}
?>