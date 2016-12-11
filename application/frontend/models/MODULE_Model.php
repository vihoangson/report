<?php
class MODULE_Model extends CI_Model{

    private $_module = "modules";
	
    function __contruct(){
        parent::__construct();
		
        $this->load->database();
		
    }
	
	function GetModules(){
        $this->db->select('*');
        $this->db->from($this->_module);
		$this->db->order_by("title","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function GetModulesWhere($str){
        $this->db->select('*');
        $this->db->from($this->_module);
		$this->db->where("title IN (".$str.")");
		$this->db->order_by("title","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function DeleteModules($title){
        if($title!=""){
            $this->db->where("title",$title);
            $this->db->delete($this->_module);
        }
    }
	
	function InsertModules($data){
        if($this->db->insert($this->_module,$data))
            return TRUE;
        else
            return FALSE;
    }
	
	function OptimizeModules(){
		$this->load->dbutil();
       	if ($this->dbutil->optimize_table($this->_module))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }

}
?>
