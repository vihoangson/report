<?php
class Contact_model extends CI_Model{

    	private $_contact = "contact";
	
		public $linguaid;
	
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('Global_Model');
    }

	function InitLingua()
	{
		$this->linguaid = $this->Global_Model->linguaid();
	}
	
	function GetAllContact($off="",$limit=""){
		
		$this->db->select('*');
		$this->db->from($this->_contact);
		$this->db->limit($off,$limit);
		$this->db->order_by("id","desc");
        	$query = $this->db->get();
        	$data = $query->result_array();
        	return $data;
		
	}
	
	function getContact($id=0){
		
		$this->db->select('*');
		$this->db->from($this->_contact);
		$this->db->where("id",$id);
        	$query = $this->db->get();
        	$data = $query->result_array();
        	return $data;
		
	}
	
	function addContact($data){
        	if($this->db->insert($this->_contact,$data))
				return TRUE;
        	else
				return FALSE;
    	}
	
	function deleteContact($id=0){
		if($id!=0){

			$this->db->where("id",$id);
			$this->db->delete($this->_contact);
		
			return TRUE;
       	}
		else
		{
			return FALSE;
		}
    }
	
	function deleteContactMulti($arr){
        
			$strsap = implode(",", $arr);
			
            $this->db->where("id IN (".$strsap.")");
            
			if($this->db->delete($this->_contact))
			{
				return TRUE;
			}else{
				return FALSE;
			}
        
    }
	
	function updateContact($data,$id){
        	$this->db->where("id",$id);
        	if($this->db->update($this->_contact,$data))
           	 	return TRUE;
        	else
				return FALSE;
	}
	
}
?>
