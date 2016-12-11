<?php 
class Quanglykho_model extends CI_Model
{
	private $_city = "city";
	private $_supplier = "shop_suppliers";
	
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    	
	public function find_info($key) {
		$this->db->where('mva',$key);
		return $this->db->get('city')->row();
		//return $this->db->query("select * form users where username = $user")->row();
	}	
		
	function find_cCity($mva=''){
		
        $this->db->select('*');
		$this->db->where('pid="'.$mva.'"');
		
        $query = $this->db->get('city');
        $data = $query->result_array();
        return $data;
    }  	
		
	public function find_city($key) {
		$this->db->where('id',$key);
		return $this->db->get('city')->row();
		//return $this->db->query("select * form users where username = $user")->row();
	}
	
	public function search_city($key) {
		$this->db->like('title', $key);
		$ds = $this->db->get('city');
		return $ds->result_array();
		
	}
	
	public function searchlimit_city($key,$off="",$limit="") {
		$this->db->like('title', $key);
		$this->db->limit($off,$limit);
		$this->db->order_by("id","desc");
		$ds = $this->db->get('city');
		return $ds->result_array();
	}
	
	public function search_suppliers($key) {
		$this->db->like('title', $key);
		$ds = $this->db->get($this->_supplier);
		return $ds->result_array();
		
	}
	
	public function searchlimit_suppliers($key,$off="",$limit="") {
		$this->db->like('title', $key);
		$this->db->order_by("id","desc");
		$this->db->limit($off,$limit);
		$ds = $this->db->get($this->_supplier);
		return $ds->result_array();
	} 
	
	public function findAll_city() {
		$ds = $this->db->get('city');
		return $ds->result_array();
	}
	
	function findLimit_city($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_city.' as s');
		$this->db->limit($off,$limit);
		$this->db->order_by("s.id","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	public function insert_city($tk = array()) {
		$this->db->insert('city',$tk);
	}
	
	public function delete_city($key){
		$this->db->where('id',$key);
		$this->db->delete('city');
	}
	
	public function update_city($key,$tk = array()) {
		$this->db->where('id',$key);
		$this->db->update('city',$tk);
	}
	///////////////////////////////////////////////////////
	
	public function find_sup($key) {
		$this->db->where('id',$key);
		return $this->db->get('shop_suppliers')->row();
		//return $this->db->query("select * form users where username = $user")->row();
	}
	
	public function findAll_sup() {
		$ds = $this->db->get('shop_suppliers');
		return $ds->result_array();
	}
	
	function findLimit_sup($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_supplier.' as s');
		$this->db->limit($off,$limit);
		$this->db->order_by("s.id","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	public function insert_sup($tk = array()) {
		$this->db->insert('shop_suppliers',$tk);
	}
	
	public function delete_sup($key){
		$this->db->where('id',$key);
		$this->db->delete('shop_suppliers');
	}
	
	public function update_sup($key,$tk = array()) {
		$this->db->where('id',$key);
		$this->db->update('shop_suppliers',$tk);
	}
	
	
}
?>