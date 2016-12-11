<?php
class WISHLIST_Model extends CI_Model{

	private $_wishlist = "wishlist";
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function find($key1, $key2) {
		$this->db->where('pid',$key1);
		$this->db->where('uid',$key2);
		return $this->db->get($this->_wishlist)->row();
	}

	public function findAll($u) {
		$this->db->where('uid',$u);
		$ds = $this->db->get($this->_wishlist);
		return $ds->result_array();
	}

	public function insert($tk = array()) {
		if($this->db->insert($this->_wishlist,$tk))
			return true;
		else
			return false;
	}

	public function delete($key){
		$this->db->where('id',$key);
		$this->db->delete($this->_wishlist);
	}

	public function update($key,$tk = array()) {
		$this->db->where('id',$key);
		$this->db->update($this->_wishlist,$tk);
	}
}
?>
