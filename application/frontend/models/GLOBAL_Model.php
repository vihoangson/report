<?php
class GLOBAL_Model extends CI_Model{

    private $_options = "options";
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->config->load('config');
    }
	
    /*--- 
	*Ngôn ngữ
	*/
	
	/*--- 
	*Options
	*/
	
	function getOption(){
		
        $this->db->select('*');
        $this->db->from(''.$this->_options.'');
		
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	/*--- 
	*Linking Url
	*/
	/*function urllink(){
	
		$module = $this->uri->segment(1,0);
		$categories = (int)$this->uri->segment(2,0);
		$id = (int)$this->uri->segment(3,0);
		
		if($module!=''){
			switch($module)
			{
				case 'home':
					$t_module=lang('_HOME');
					break;
				case 'aboutus':
					$t_module=lang('_ABOUTUS');
					break;
				case 'shop':
					$t_module=lang('_PRODUCT');
					break;
				case 'partner':
					$t_module=lang('_PARTNER');
					break;
				case 'news':
					$t_module=lang('_NEWS');
					break;
				case 'contactus':
					$t_module=lang('_CONTACTUS');
					break;
				case 'search':
					$t_module=lang('_SEARCH');
					break;
				default:
					$t_module='';
					break;
			}
		}
		
		$data = array(	lang('_HOME')=>base_url().'index.php/home',
						$t_module=>base_url().'index.php/'.$module);

		//$m_module = $this->uri->segment(1,0).'_Model';
		
		
		if($categories!='' && $id!=''){
			$this->load->model("SHOP_Model");
			$a_cat = $this->SHOP_Model->GetCategories($id);
			//print_r($a_cat);
			$data[$a_cat[0]['title']]= base_url().'index.php/'.$module.'/module/'.$a_cat[0]['cid'];
		}
		
		return $data;
	}*/
}
?>
