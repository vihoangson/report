<?php
class Newsletter_model extends CI_Model{

    private $_newsletter 	= "newsletter";
	
    function __contruct(){
        parent::__construct();
		
        $this->load->database();
		
    }
	
	function GetAllNewsletter(){
        $this->db->select('*');
        $this->db->from($this->_newsletter);
		$this->db->order_by("id","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function DeleteNewsletter($id){
        if($id){
            $this->db->where("id",$id);
            $this->db->delete($this->_newsletter);
			return true;
        }else{
			return false;
		}
    }
}
?>
