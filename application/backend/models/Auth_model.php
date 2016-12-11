<?php
class Auth_model extends CI_Model{

    private $_table = "authors";
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }

    //--- Lay du lieu
    function getAuthors($off="",$limit=""){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($off,$limit);
        //$this->db->order_by("aid","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    //--- Lay thong tin 1 record qua id
    function getInfo($id){
		
        $this->db->where("aid",$id);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    //---- Lay thong tin qua email
    function getInfoByEmail($email){
        $this->db->where("email",$email);
        $query = $this->db->get($this->_table);

        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    //--- Them User moi
    function addAuthor($data){
        if($this->db->insert($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    //--- Xoa user
    function deleteAuthor($id){
        if($id!=1){
            $this->db->where("aid",$id);
            $this->db->delete($this->_table);
        }
    }

    //--- Cap nhat user
    function updateAuthor($data,$id){
        $this->db->where("aid",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    // Tong so record
    function num_rows(){
        return $this->db->count_all($this->_table);
    }
    
    
    //---- Kiem tra username hop le
    function getAuthor($username,$id,$email){
        if(isset($id)){ //use for update
           $this->db->where("name",$username);
           $this->db->where("aid !=",$id);
           $query = $this->db->get($this->_table);
        }
        else{ //user for add
            $this->db->where("name",$username);
            $query = $this->db->get($this->_table);
        }
        
        if($query->num_rows()!=0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    //--- da kich hoat 
    function actived($userid){
        $this->db->select("user_id,user_active");
        $this->db->where("user_id",$userid);
        $query = $this->db->get($this->_table);
        $info  = $query->row_array();
        if($info){
            if($info['user_active']==1)
            return TRUE;
        else
            return FALSE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //--- Kiem tra userid và key
    function checkActive($userid,$key){
         if($userid!="" && $key!=""){
            
            $this->db->where("aid",$userid);
            $this->db->where("md5(salt)",$key);
            $query = $this->db->get($this->_table);
            if($query->num_rows()!=0){
                
                return $query->row_array();
                
            }else{
                return FALSE;
            }
            
        }else{
            return FALSE;
        }
    }
    //--- Kiem tra Email
    function checkEmail($email,$id=""){
        
        if(isset($id) && $id!="")
        { //use for update
           $this->db->where("email",$email);
           $this->db->where("aid !=",$id);
           $query = $this->db->get($this->_table);
        }
        else
        { //user for add
            $this->db->where("email",$email);
            $query = $this->db->get($this->_table);
        }
        
        if($query->num_rows()!=0){
            return FALSE;
        }
        else{
            return TRUE;
        }
        
    }
    
    //--- Kiem tra dang nhap
    //----------------------------- CHECK LOGIN
    function checkLogin($username,$password,$email){
        $u = $username;
        $p = md5($password);
		$e = $email;
        $this->db->where("aid",$u);
        $this->db->where("pwd",$p);
		$this->db->where("email",$e);
        $query = $this->db->get($this->_table);
        if($query->num_rows()==0){
            return FALSE;
        }
        else{
            return $query->row_array();
        }
        
    }
}
?>
