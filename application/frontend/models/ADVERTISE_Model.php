<?php
class ADVERTISE_Model extends CI_Model{
	
    private $_ad = "view_advertise";

    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('GLOBAL_Model');
    }
	function getSlide($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_ad.' as s');
		$this->db->where('s.active=1 and s.position="slide"');
		
		$this->db->limit($off,$limit);
        $this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function getTop($off="",$limit=""){
		
         $this->db->select('*');
        $this->db->from(''.$this->_ad.' as s');
		$this->db->where('s.active=1 and s.position="top"');
		
		$this->db->limit($off,$limit);
        $this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function getBottom($off="",$limit=""){
		
         $this->db->select('*');
        $this->db->from(''.$this->_ad.' as s');
		$this->db->where('s.active=1 and s.position="bottom"');
		
		$this->db->limit($off,$limit);
        $this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
    
    
	
	
}
?>
