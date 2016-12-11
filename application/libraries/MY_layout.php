<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_layout
{

    var $obj;
    var $layout;

    function MY_layout($layout = "")
    {
        $this->obj =& get_instance();
        $this->layout = $layout;
    }

    function setLayout($layout)
    {
      $this->layout = $layout;
    }

    function view($view, $data=null, $return=false)
    {
		//print_r($data);
        $loadedData = array();
        $loadedData['content_for_layout'] = $this->obj->load->view($view,$data,true);
        if($return)
        {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        }
        else
        {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }
	
	
}