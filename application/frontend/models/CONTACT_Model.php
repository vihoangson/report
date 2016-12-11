<?php
class CONTACT_Model extends CI_Model{

    private $_contact = "contact";
	
	public $linguaid;
	
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('Global_Model');
		$this->load->model('SHOP_Model');
		$this->load->model('MODULE_Model');
    }
	
	function getContact(){	
	
			$this->db->select('*');
        	$this->db->from(''.$this->_contact.'');
       	 	$query = $this->db->get();
        	$data = $query->result_array();
        	return $data;
		
	}

}
?>
