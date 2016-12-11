<?php
class Cauhinh_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function find($key) {
		$this->db->where('id',$key);
		return $this->db->get('options')->row();
	}

	public function findAll() {
		$ds = $this->db->get('options');
		return $ds->result_array();
	}

	public function insert($tk = array()) {
		$this->db->insert('options',$tk);
	}

	public function delete($key){
		$this->db->where('id',$key);
		$this->db->delete('options');
	}

	public function update($key,$tk = array()) {
		$this->db->where('id',$key);
		$this->db->update('options',$tk);
	}
}
?>
