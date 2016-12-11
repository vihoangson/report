<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	$this->load->helper(array('url','form','global'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	        
    $this->load->database();
    $this->load->model("Auth_model");
	$this->load->model("Global_Model");
	$this->load->model("Module_model");
	//$this->login();
	
	$this->load->library("MY_layout"); // Sử dụng thư viện layout
    $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)
	
  }

  public function index(){
		// If the user is validated, then this function will run
		
		if($this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Module' => '#');
			
			//config module
			$modlist = "";

			$exmodlist  =	array('.', '..', 'Languageswitcher.php', 'index.html', 'Welcome.php', 'Home.php');
		
			$testmodhandle=opendir('../application/frontend/controllers');
			
			while ($file = readdir($testmodhandle)) {
			
				if ( !preg_match('/^(?:[a-z0-9_-]|\..\.(?!\.))+$/iD', $file) && !in_array($file, $exmodlist) ) {
				
					$modlist .= substr($file, 0, strlen($file) - 4)." ";
			
				}
			}
			
			closedir($testmodhandle);
			
			$modlist = explode(" ", $modlist);
			
			sort($modlist);		
			
			$listmods = "";

			$listadmins = "";
			
			$ml2result = $this->Module_model->GetModules();
			
			foreach($ml2result as $rowmod) {
				
				$titlemod = $rowmod['title'];
	
				if(in_array($titlemod, $modlist)) {
			
					if($listmods!= "") { $listmods .= "|"; $listadmins .= "|"; }

					$listmods .= "".$titlemod.""; $listadmins .= "".$rowmod['admins']."";
			
				} else {
			
					$this->Module_model->DeleteModules($titlemod);
					if(!$this->Module_model->OptimizeModules()){
						
						redirect(base_url()."index.php/dashboard/auth");  
						
					}
			
				}
			
			}
			
			$listmods2 = explode("|",$listmods);
			
			for ($i=0; $i < sizeof($modlist); $i++) {
			
				if($modlist[$i] != "" AND !in_array($modlist[$i],$listmods2)) {
	
					$datainput = array(
						'mid'			=> NULL,
						'title'			=> $modlist[$i],
						'custom_title'	=> $modlist[$i],
						'active'		=> 0,
						'view'			=> 0,
						'inmenu'		=> 1,
						'admins'		=> ''
					);
					$this->Module_model->InsertModules($datainput);
			
					if($listmods!= "") { $listmods .= "|"; $listadmins .= "|"; }
			
					$listmods .= "".$modlist[$i]."";
			
				}
			
			}
			
			$listmods = explode("|",$listmods);
			
			$listadmins = explode("|",$listadmins);
			
			$data['modules'] = $ml2result;
			
			$this->my_layout->view("module_view", $data); 
		}
		else
        {  
        	redirect(base_url()."index.php/dashboard/auth");  
        }
  }
  
}

?>