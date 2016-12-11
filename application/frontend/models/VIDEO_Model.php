<?php
class VIDEO_Model extends CI_Model{

    private $_theloai 	= "video_categories";
	private $_video 	= "video";

    
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('GLOBAL_Model');
		$this->load->model('SHOP_Model');
		$this->load->model('MODULE_Model');
		
		
    }
	
	function getVideo(){	
	
		$this->db->select('*');
        $this->db->from(''.$this->_video.'');
		$this->db->order_by("id","desc");
		$this->db->where("ihome=1");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
}
?>
