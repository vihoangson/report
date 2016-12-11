<?php
class Product_model extends CI_Model{

    private $_shop = "view_shop";
	private $_shop_categories = "view_shop_categories";
	private $_shop_categories_language = "shop_categories_language";
	private $_shop_module = "shop_module";
	private $_shop_order = "shop_orders";
	private $_shop_usercat = "shop_usercat";
	private $_shop_language = "shop_language";

	public $linguaid;
	
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('Global_Model');
    }
	
	function InitLingua()
	{
		$this->linguaid = $this->Global_Model->linguaid();
	}
	
	function ShopProducts($off="",$limit=""){

		$this->Product_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_shop.' as s,'.$this->_shop_language.' as sl');
		//$this->db->where('s.pid=sl.pid AND sl.lang_id='.$this->linguaid);
		$this->db->where('s.pid=sl.pid');
		$this->db->limit($off,$limit);
		$this->db->order_by("s.pid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	function ShopModule(){
		
		$this->Product_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s,'.$this->_shop_categories_language.' as sl');
		//$this->db->where('s.cid=sl.cid AND sl.lang_id='.$this->linguaid.'');
		$this->db->where('s.cid=sl.cid');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
    function ShopModuleParent($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s');
		$this->db->where('s.pid="0"');
		$this->db->limit($off,$limit);
        $this->db->order_by("s.cid","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function addShop($data){
        if($this->db->insert($this->_shop,$data))
		{
            $this->db->select_max('pid');
			$query = $this->db->get($this->_shop);
			$data = $query->result_array();
			return $data[0]['pid'];
		}
        else
		{
            return FALSE;
		}
    }
	function addShopLanguage($data){
        if($this->db->insert($this->_shop_language,$data))
			return TRUE;
        else
            return FALSE;
    }
	function getShop($id=0){
		
		$this->Product_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_shop.' as s,'.$this->_shop_language.' as sl');
		//$this->db->where('s.pid=sl.pid AND sl.lang_id='.$this->linguaid.' AND s.pid='.$id);
		$this->db->where('s.pid=sl.pid  AND s.pid='.$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	function deleteShop($id=0){
        if($id!=0){
			$this->Product_model->InitLingua();
			
            $this->db->where("pid",$id);
            $this->db->delete($this->_shop);
			
			//$this->db->where('pid='.$id.' AND lang_id='.$this->linguaid);
			$this->db->where('pid='.$id.'');
			$this->db->delete($this->_shop_language);
			
			return TRUE;
        }
		else
		{
			return FALSE;
		}
    }
	function deleteShopMulti($arr){
        
			$this->Product_model->InitLingua();
			
			$strsap = implode(",", $arr);
			
            $this->db->where("pid IN (".$strsap.")");
            
			if($this->db->delete($this->_shop))
			{
				//$this->db->where("pid IN (".$strsap.') AND lang_id='.$this->linguaid);
				$this->db->where("pid IN (".$strsap.')');
				if($this->db->delete($this->_shop_language))
					return TRUE;
				else
					return FALSE;
			}else{
				return FALSE;
			}
        
    }
	function updateShop($data,$id){
        $this->db->where("pid",$id);
        if($this->db->update($this->_shop,$data))
            return TRUE;
        else
            return FALSE;
    }
	function updateShopLanguage($data,$id){
		$this->Product_model->InitLingua();
       // $this->db->where("pid=".$id." AND lang_id=".$this->linguaid);
	    $this->db->where("pid=".$id."");
        if($this->db->update($this->_shop_language,$data))
            return TRUE;
        else
            return FALSE;
    }
	/*************************
	*CATEGORIES
	**************************/
	function ShopCategories($off="",$limit=""){

		$this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s');
		$this->db->limit($off,$limit);
		$this->db->order_by("s.cid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	function getmvaCategories($id=0){
		$this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s');
		$this->db->where('s.mva="'.$id.'"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	function getCategories($id=0){
		$this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s');
		$this->db->where('s.cid='.$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	function getChildCategories($id=0){
		
		$this->Product_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s,'.$this->_shop_categories_language.' as sl');
		//$this->db->where('s.cid=sl.cid AND sl.lang_id='.$this->linguaid.' AND s.parentid='.$id);
		$this->db->where('s.cid=sl.cid AND s.parentid='.$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	function updateCategories($data,$id){
        $this->db->where("cid",$id);
        if($this->db->update($this->_shop_categories,$data))
            return TRUE;
        else
            return FALSE;
    }
	function updateCategoriesLanguage($data,$id){
		$this->Product_model->InitLingua();
		
        //$this->db->where("cid=".$id." AND lang_id=".$this->linguaid);
		$this->db->where("cid=".$id."");
        if($this->db->update($this->_shop_categories_language,$data))
            return TRUE;
        else
            return FALSE;
    }
	function deleteCategories($id=0, $parentid=0){
        if($id!=0){

            $this->db->where("cid",$id);
            $this->db->delete($this->_shop_categories);
		
			if($parentid==0)
			{
				$c = $this->getChildCategories($id);
				$this->db->where('parentid='.$id);
				$this->db->delete($this->_shop_categories);	
				
				foreach($c as $v)
				{	
				//$this->db->where('cid='.$v['cid'].' AND lang_id='.$this->linguaid);
				$this->db->where('cid='.$v['cid'].'');
				$this->db->delete($this->_shop_categories_language);
				}
			}
			
			return TRUE;
        }
		else
		{
			return FALSE;
		}
    }
	function addCategories($data){
        if($this->db->insert($this->_shop_categories,$data))
		{
            $this->db->select_max('cid');
			$query = $this->db->get($this->_shop_categories);
			$data = $query->result_array();
			return $data[0]['cid'];
		}
        else
		{
            return FALSE;
		}
    }
	function addCategoriesLanguage($data){
        if($this->db->insert($this->_shop_categories_language,$data))
			return TRUE;
        else
            return FALSE;
    }
}
?>
