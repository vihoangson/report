<?php
class Block_model extends CI_Model{

    private $_block = "blocks";
	
    function __contruct(){
        parent::__construct();
		
        $this->load->database();
		
    }
	
	function GetBlocks(){
        $this->db->select('*');
        $this->db->from($this->_block);
		$this->db->order_by("bposition","asc");
		$this->db->order_by("weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function GetBlocksWhereId($bid){
        $this->db->select('*');
        $this->db->from($this->_block);
		$this->db->where("bid='".$bid."'");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function GetBlocksWhere($title){
        $this->db->select('*');
        $this->db->from($this->_block);
		$this->db->where("blockfile='".$title."'");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function GetBlocksWhere2($position){
        $this->db->select('*');
        $this->db->from($this->_block);
		$this->db->where("bposition='".$position."'");
		$this->db->order_by("weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function GetBlocksWhere3($title, $bfile){
        $this->db->select('*');
        $this->db->from($this->_block);
		$this->db->where("blockfile='".$title."' AND blockfile!='".$bfile."'");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function InsertBlock($data){
        if($this->db->insert($this->_block,$data))
            return TRUE;
        else
            return FALSE;
    }
	
	function UpdateBlock($data,$id){
        $this->db->where("bid",$id);
        if($this->db->update($this->_block,$data))
            return TRUE;
        else
            return FALSE;
    }
	
	function DeleteBlock($id){
        if($id){
            $this->db->where("bid",$id);
            $this->db->delete($this->_block);
        }
    }
	
	function OptimizeBlock(){
		$this->load->dbutil();
       	if ($this->dbutil->optimize_table($this->_block))
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
