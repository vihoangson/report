<?php
class Nhanvien_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function find_position($key) {
		$this->db->where('id',$key);
		return $this->db->get('position')->row();
	}

	public function findAll_position() {
		$ds = $this->db->get('position');
		return $ds->result_array();
	}

	public function insert_position($tk = array()) {
		$this->db->insert('position',$tk);
	}

	public function delete_position($key){
		$this->db->where('id',$key);
		$this->db->delete('position');
	}

	public function update_position($key,$tk = array()) {
		$this->db->where('id',$key);
		$this->db->update('position',$tk);
	}
	/////////////////////////////
	public function find_emp($key) {
		$this->db->where('CMND',$key);
		return $this->db->get('employees')->row();
	}

	public function findAll_emp() {
		$ds = $this->db->get('employees');
		return $ds->result_array();
	}

	public function insert_emp($tk = array()) {
		$this->db->insert('employees',$tk);
	}

	public function delete_emp($key){
		$this->db->where('CMND',$key);
		$this->db->delete('employees');
	}

	public function update_emp($key,$tk = array()) {
		$this->db->where('CMND',$key);
		$this->db->update('employees',$tk);
	}
	////////////////////////////////////////////////////

	public function insert_auth($tk = array()) {
		$this->db->insert('authors',$tk);
	}
}
	?>