<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Auth extends CI_Session
{
    var $CI;
    var $_model;
    function __construct(){
  
        $CI =& get_instance();
        
        $this->_model = $CI;
        $this->_model->load->database();
        $this->_model->load->model("Auth_model");
    }
    
    function is_Admin(){
        
		
		//userdata set in Dashboard/login
		$a = $this->userdata("admin");
        $info = $this->_model->Auth_model->getInfo($a['aid']);
        if($this->is_Login() && $info['radminsuper']==1){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
	
	function is_GodAdmin(){
        
		//userdata set in Dashboard/login
        $info = $this->_model->Auth_model->getInfo($this->userdata("aid"));
		
        if($this->is_Login() && $info['radminsuper']==1 && $info['name']=='God'){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    function is_Active($userid)
    {
        if($this->_model->Auth_model->actived($userid))
            return TRUE;
        else
            return FALSE;
    }
    
    function is_Login(){
		
		$a = $this->userdata("admin");
		
        if($a["name"] && $a["name"]!="" && $a["aid"] && $a["aid"]!="" && $a["email"] && $a["email"]!="")
            return TRUE;
        else
            return FALSE;
    }
    
    function __get($var)
    {
        return $this->userdata($var);

    }
    
    
}