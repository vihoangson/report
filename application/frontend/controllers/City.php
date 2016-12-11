<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form','file','global','cookie'));
		$this->load->library(array("form_validation","session"));
				
		$this->load->database();
		
		$this->load->model("GLOBAL_Model");
		$this->load->model("CITY_Model");
		$this->load->library(array("MY_layout","MY_user")); 
    	$this->my_layout->setLayout("template_view"); 
		
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
	}
	
	public function ccity()
	{
		$mva= $this->input->post('id');
		$ccity = $this->CITY_Model->cCity($mva);
		$string = "";
		foreach($ccity as $index=>$value){
			$string.='<option value="'.$value['mva'].'">'.$value['title'].'</option>';
		}
		echo $string;
	}
	

}
