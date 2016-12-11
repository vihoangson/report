<?php
class Video_model extends CI_Model{

    private $_theloai 	= "video_categories";
	private $_video		= "video";
	
    function __contruct(){
        parent::__construct();
		
        $this->load->database();
		
    }
	
	function GetAllVideo(){
        $this->db->select('*');
        $this->db->from($this->_video);
		$this->db->order_by("name","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	
	function GetVideo($id=0){
		$this->db->select('*');
        $this->db->from($this->_video);
		$this->db->where("id='".$id."'");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function GetAllTheLoai(){
		$this->db->select('*');
        $this->db->from($this->_theloai);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function GetTheLoai($idtheloai=0){
		$this->db->select('*');
        $this->db->from($this->_theloai);
		$this->db->where("id='".$idtheloai."'");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function InsertVideo($data){
        if($this->db->insert($this->_video,$data))
            return TRUE;
        else
            return FALSE;
    }
	
	function UpdateVideo($data,$id){
        $this->db->where("id",$id);
        if($this->db->update($this->_video,$data))
            return TRUE;
        else
            return FALSE;
    }
	
	function DeleteVideo($id){
        if($id){
            $this->db->where("id",$id);
            $this->db->delete($this->_video);
			return true;
        }else{
			return false;
		}
    }
}
?>
