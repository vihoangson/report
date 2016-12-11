<?php
class CITY_Model extends CI_Model{
	
    private $_city = "city";

    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('GLOBAL_Model');
    }
	function allCity($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_city.' as s');

        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
    
    function pCity(){
		
        $this->db->select('*');
        $this->db->from(''.$this->_city.' as s');
		$this->db->where('s.pid="0"');
		
        $this->db->order_by("s.id","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function cCity($mva=''){
		
        $this->db->select('*');
        $this->db->from(''.$this->_city.' as s');
		$this->db->where('s.pid="'.$mva.'"');
		
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function getpCity($mva){
		
        $this->db->select('*');
        $this->db->from(''.$this->_city.' as s');
		$this->db->where('s.mva="'.$mva.'"');
		
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0];
    }  
	
	function getcCity($mva){
		
        $this->db->select('*');
        $this->db->from(''.$this->_city.' as s');
		$this->db->where('s.mva="'.$mva.'"');
		
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0];
    }  
}
?>
