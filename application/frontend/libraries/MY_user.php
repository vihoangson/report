<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_user extends CI_Session
{
    var $CI;
    var $_model;
    function __construct(){
  
        $CI =& get_instance();
        
        $this->_model = $CI;
        $this->_model->load->database();
        $this->_model->load->model("USER_Model");
    }
    
    function is_User(){
		
        $client = $this->userdata("client");
		//userdata set in Dashboard/login
        $info = $this->_model->USER_Model->getInfo($client['uid']);
		
        if($this->is_Login()){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
	
    
    function is_Active($userid)
    {
       
    }
    
    function is_Login(){
		
		$client = $this->userdata("client");

        if($client["name"] && $client["name"]!="" && $client["uid"] && $client["uid"]!="")
            return TRUE;
        else
            return FALSE;
    }
    
    function __get($var)
    {
        return $this->userdata($var);

    }
    
    
}