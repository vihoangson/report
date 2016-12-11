<?php
class NEWSLETTER_Model extends CI_Model{

    private $_newsletter = "newsletter";
	private $_newsletter_send = "newsletter_send";
	
	protected $linguaid;
	
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('GLOBAL_Model');
		$this->load->model('SHOP_Model');
		$this->load->model('MODULE_Model');
		
    }
	
	function GetNewsletter($email=""){

		$this->db->select('*');
        $this->db->from(''.$this->_newsletter.'');
		$this->db->where("email='".$email."'");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function GetMaxNewsletter(){

		$this->db->select_max('id');;
        $this->db->from(''.$this->_newsletter.'');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['id'];
		
	}
	
	function AddNewsletter($data){
        if($this->db->insert($this->_newsletter,$data))
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
