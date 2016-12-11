<?php
class GLOBAL_Model extends CI_Model{

    private $_lingua = "lingua";
	private $_uploaded = array();
	private $_error = array();
    protected $linguaid;
	
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->config->load('config');
    }

    /*--- 
	*Ngôn ngữ
	*/
	function getsitelang(){
		if($this->session->userdata('site_lang'))
			$site_lang =  $this->session->userdata('site_lang');
		else
			$site_lang =  $this->config->item('language');
			
		return $site_lang;
	}
	
    function linguaid(){
		$site_lang = $this->getsitelang();

        $this->db->select('*');
        $this->db->from($this->_lingua);
		$this->db->where("lang",$site_lang);
        $this->db->order_by("lang_id","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['lang_id'];
    }
	
	function linguaname($langid){
        $this->db->select('*');
        $this->db->from($this->_lingua);
		$this->db->where("lang_id",$langid);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['lang'];
    }
	
	function lingua(){
		$this->db->select('*');
        $this->db->from($this->_lingua);
		$this->db->order_by("lang_id","asc");
        $query = $this->db->get();
        $data = $query->result_array();
		return $data;
	}
	
	function InitLingua()
	{
		$ci =& get_instance();
		// Phần này ngôn ngữ luôn là 1
		// $ci->linguaid = $this->linguaid();
		$ci->linguaid = 1;
	}
	
	function uploadimage($path="", $width=700, $height=850, $newname, $dimages="")
	{
		date_default_timezone_set('Asia/Saigon');
		if ($dimages == "yes") {
			@unlink($path."/".$newname."");
			$newname = "";
		}
		print_r($_FILES);
		

		if($_FILES['userfile']['name'])
		{
				$realname = $_FILES['userfile']['name'];	
				$f_name = explode(".",$realname);
				$extension = strtolower($f_name[1]);
				$datakod = date('U');
				$newname = "".$datakod.".".$extension."";
		
		
				$config['upload_path']          = $path;
                $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
				$config['file_name'] 			= $newname;
                //$config['max_size']             = 100;
                $config['max_width']            = 1424;
                $config['max_height']           = 1424;

				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

                if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());
						$newname="";

                        //$this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$newname =  $this->upload->file_name;
						//Image Resizing
						$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config['maintain_ratio'] = FALSE;
						$config['width'] = $width;
						$config['height'] = $height;
				
						$this->load->library('image_lib', $config);
				
						if ( ! $this->image_lib->resize()){
							$error = array('error' => $this->image_lib->display_errors());
							$newname="";
						}else{
							$newname = $newname;
						}
                        //$this->load->view('upload_success', $data);
                }
		}
		return $newname;
	}
	
	
	
	function uploadmultiimage($path="", $width=700, $height=850, $fname="", $dimages=array())
	{
		$flag = true;
		if($fname!=""){
		$pic = explode(",",$fname);
		}
		
		if($dimages && sizeof($dimages)){
			foreach($dimages as $d)
			{
				foreach($pic as $i=>$p)
				{
					if($p==$d)
					{
						@unlink($path."/".$d."");
						unset($pic[$i]);
					}
					else
					{
						$flag = false;
					}
				}
			}
		}
		
    	$number_of_files = sizeof($_FILES['userfile']['tmp_name']);
 
    	$files = $_FILES['userfile'];
		
		$errors = array();
		
		for($i=0;$i<$number_of_files;$i++)
		{
		  if($_FILES['userfile']['error'][$i] != 0)
		  {
			//$this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');
			$errors[$i] = array('error' => 'Couldn\'t upload the file(s)');
			$flag = FALSE;
		  }
		}
		
				
			
		
		date_default_timezone_set('Asia/Saigon');
		if(sizeof($errors)==0)
    	{
			for ($i = 0; $i < $number_of_files; $i++)
			{
			  $realname = $files['name'][$i];	
			  $f_name = explode(".",$realname);
			  $extension = strtolower($f_name[1]);
			  $datakod = date('U');
			  $newname = "".$datakod.".".$extension."";
			  
			  	$config['upload_path']          = $path;
                $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
				$config['file_name'] 			= $newname;
                $config['max_width']            = 1424;
                $config['max_height']           = 1424;
				
				$this->load->library('upload', $config);
			  
			  $_FILES['userfile']['name'] = $newname;
			  $_FILES['userfile']['type'] = $files['type'][$i];
			  $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
			  $_FILES['userfile']['error'] = $files['error'][$i];
			  $_FILES['userfile']['size'] = $files['size'][$i];
			
					
			  $this->upload->initialize($config);
			  if ($this->upload->do_upload('userfile'))
			  {
					$this->_uploaded[$i] = $this->upload->data();
					$newwidth 	= $this->_uploaded[$i]['image_width'];
					$newheight 	= $this->_uploaded[$i]['image_height'];
					
					if($newwidth > $width || $newheight >$height)
					{
						//$newname =  $this->upload->file_name;
						//Image Resizing
						$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config['maintain_ratio'] = FALSE;
						$config['width'] = $width;
						$config['height'] = $height;
						
						$this->load->library('image_lib', $config);
						
						if ( ! $this->image_lib->resize()){
							$errors[0] = array('error' => $this->image_lib->display_errors());
							$flag = false;
						}else{
							$flag = true;
						}
					}
			  }
			  else
			  {
				//$this->form_validation->set_message('fileupload_check', $this->upload->display_errors());
				$errors[0] = array('error' => $this->upload->display_errors());
				$flag = false;
			  }
			}
		}
		if($flag == true || sizeof($pic)!=0){
			foreach($this->_uploaded as $_u)
			{
				$pic[] = $_u['file_name'];
			}
			return $pic;
		}
		else
		{
			//print_r($errors);
			return $errors[0]['error'];
		}
	}
}
?>
