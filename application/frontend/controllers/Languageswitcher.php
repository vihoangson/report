<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Languageswitcher extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library(array("session"));
	}
 
 	public function index()
	{
		
	}
	
    function switchLang($language = "") {
		
        $url =  $_SERVER['HTTP_REFERER'];
       
        $vn = strpos(   $url , 'vietnamese');
        $en = strpos(   $url , 'english');
        if ($vn === false && $en===false) {
        	redirect('/');
       	 
        }
        
       
        
    		if($language=='vietnamese')
    		{
    			$url =str_replace('english', 'vietnamese', $url);
    		}
    		else {
    			$url =str_replace('vietnamese', 'english', $url);
    		}
    		
    		
    		redirect($url);
        
    }
}
?>