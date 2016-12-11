<?php
class SHOP_Model extends CI_Model{
	
    private $_shop_categories = "view_shop_categories";
	private $_shop = "view_shop";
	private $_order = "shop_orders";
	private $_order_detail = "shop_orders_detail";

    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('GLOBAL_Model');
    }
	function ShopAllCategories($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s');
		$this->db->where('s.active=1');
		
		$this->db->limit($off,$limit);
        $this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
    
    function ShopCategoriesParent($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s');
		$this->db->where('s.pid="0" and s.active=1');
		
		$this->db->limit($off,$limit);
        $this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function ShopCategoriesChild($mva=''){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop_categories.' as s');
		$this->db->where('s.active=1 and s.pid="'.$mva.'"');
        $this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	
	function ShopNews($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop.' as s');
		$this->db->where('s.active=1');
		$this->db->limit($off,$limit);
		$this->db->order_by("s.pid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function ShopAll($off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop.' as s');
		$this->db->limit($off,$limit);
		$this->db->order_by("s.pid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	function ShopArray($arr, $off="",$limit=""){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop.' as s');
		$this->db->where_in('s.pid', $arr);
		$this->db->limit($off,$limit);
		$this->db->order_by("s.pid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	
	function Shop($id=0){
		
        $this->db->select('*');
        $this->db->from(''.$this->_shop.' as s');
		$this->db->where('s.id='.$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }  
	
	
	function InsertShoporder($data){
		//print_r($data);
		if($this->db->insert($this->_order,$data)){
			return TRUE;
		}else{
            return FALSE;
		}
	}
	
	function InsertShoporderdetail($data){
		//print_r($data);
		if($this->db->insert($this->_order_detail,$data)){
			return TRUE;
		}else{
            return FALSE;
		}
	}
	
	function delShoporderdetail($mva, $id){
		//print_r($data);
		if($this->db->delete($this->_order_detail, array('pid' => $id,'mva'=>$mva))){
			return TRUE;
		}else{
            return FALSE;
		}
	}
	
	function IndentShoporder(){
		$query = $this->db->query("SELECT IDENT_CURRENT('".$this->_orders."') as last_id");
		$res = $query->result();
		return $res[0]->last_id;
	}
	
	function getInfoShoporder($mva){
		$this->db->select('*');
        $this->db->from(''.$this->_order.' as s');
		$this->db->where('s.mva="'.$mva.'"');
		$query = $this->db->get();
        $data = $query->result_array();
        return $data;
		//return $mva;
	}
	function getInfoShoporderdetail($mva, $pid){
		$this->db->select('*');
        $this->db->from(''.$this->_order_detail.' as s');
		$this->db->where('s.mva="'.$mva.'" AND s.pid='.$pid);
		$query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function updateShoporder($mva, $data){
		$this->db->where('mva="'.$mva.'"');
		if($this->db->update($this->_order,$data))
			return TRUE;
        else
            return FALSE;
	}
	
	function updateShoporderdetail($pid, $mva, $data){
		$this->db->where('pid='.$pid.' AND mva="'.$mva.'"');
		if($this->db->update($this->_order_detail,$data))
			return TRUE;
        else
            return FALSE;
	}
	
	function totalQuantity($mva){
		$this->db->select_sum('count');
		$this->db->from($this->_order_detail);
		$this->db->where('mva="'.$mva.'"');
		$query = $this->db->get();
    	return $query->row()->count;
	}
	
	function orderCartDb($u){
		
		$this->db->select('*');
        $this->db->from(''.$this->_order.' as o,'.$this->_order.' as od');
		$this->db->where('o.mva=od.mva AND o.order_uname='.$u.'');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function orderInfo($u){
		
		$this->db->select('*');
        $this->db->from(''.$this->_order.' as o');
		$this->db->where('o.order_uname='.$u.' OR o.mva="'.$u.'"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function getorderInfo($u){
		
		$this->db->select('*');
        $this->db->from(''.$this->_order.' as o');
		$this->db->where('o.id='.$u.'');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0];
	}
	
	function orderLimitInfo($u, $off="",$limit=""){

		$this->db->from(''.$this->_order.' as o');
		$this->db->where('o.order_uname='.$u.' OR o.mva="'.$u.'"');
		$this->db->limit($off,$limit);
		$this->db->order_by("o.id","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function orderdetailInfo($u){
		
		$this->db->select('*');
        $this->db->from(''.$this->_order_detail.' as od');
		$this->db->where('od.mva="'.$u.'"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
}
?>
