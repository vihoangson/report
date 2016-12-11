<?php
class NEWS_Model extends CI_Model{

    private $_modules = "modules";
	private $_stories = "stories";
	private $_stories_auto = "stories_auto";
	private $_stories_categories = "stories_categories";
	private $_stories_categories_language = "stories_categories_language";
	private $_stories_comments = "stories_comments";
	private $_stories_images = "stories_images";
	private $_stories_temp = "stories_temp";
	private $_stories_topic = "stories_topic";
	protected $linguaid;
	
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
		
		$this->load->model('GLOBAL_Model');
		$this->load->model('SHOP_Model');
		$this->load->model('MODULE_Model');
		
		
    }
	
	function getCategories($mid=0){	
	
		$this->GLOBAL_Model->InitLingua();
		$this->linguaid = $this->GLOBAL_Model->linguaid;
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND sl.lang_id='.$this->linguaid.' AND s.mid='.$mid);
		$this->db->order_by("s.weight","asc");
		$this->db->order_by("s.catid","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function getCategory($catid=0){
		$this->GLOBAL_Model->InitLingua();
		$this->linguaid = $this->GLOBAL_Model->linguaid;
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND sl.lang_id='.$this->linguaid.' AND s.catid='.$catid);
		$this->db->order_by("s.weight","asc");
		$this->db->order_by("s.catid","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}

	function AllStories($off="",$limit="", $modulename="News"){
		$strmid = $modulename;
		$amid = $this->MODULE_Model->GetModulesWhere("'".$strmid."'");
		
		$mid = $amid[0]['mid'];
		
		$acat = $this->getCategories($mid);
		$strcat=array();
		foreach($acat as $c){
			$strcat[]=$c['catid'];
		}
		if(sizeof($strcat)){
		$scat = implode(",",$strcat);
		}else{
		$scat="";
		}
		
		$lang = $this->GLOBAL_Model->getlingua();
		$langname = $lang['lang'];
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories.'');
		if($scat!=""){
		$this->db->where('catid IN ('.$scat.') ');
		}
		$this->db->where("alanguage='".$langname."'");
		$this->db->limit($off,$limit);
		$this->db->order_by("sid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function getParentNewsCategories($mid=0){
		
		$this->GLOBAL_Model->InitLingua();
		$this->linguaid = $this->GLOBAL_Model->linguaid;
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND s.parentid=0 AND sl.lang_id='.$this->linguaid.' AND s.mid='.$mid);
		$this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function getSubNewsCategories($pid=0){
		
		$this->GLOBAL_Model->InitLingua();
		$this->linguaid = $this->GLOBAL_Model->linguaid;
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND sl.lang_id='.$this->linguaid.' AND s.parentid='.$pid);
		$this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function StoriesCategory($catid="",$off="",$limit=""){

		$lang = $this->GLOBAL_Model->getlingua();
		$langname = $lang['lang'];
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories.'');
		$this->db->where("alanguage='".$langname."' AND catid=".$catid);
		$this->db->limit($off,$limit);
		$this->db->order_by("sid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function AllStoriesCategory($off="",$limit="", $strcat=array()){
		
		if(sizeof($strcat)){
		$scat = implode(",",$strcat);
		}else{
		$scat="";
		}
		
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories.'');
		if($scat!=""){
		$this->db->where('catid IN ('.$scat.')');
		}
		$this->db->limit($off,$limit);
		$this->db->order_by("sid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function StoriesDetail($pid=""){

		$lang = $this->GLOBAL_Model->getlingua();
		$langname = $lang['lang'];
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories.'');
		$this->db->where("alanguage='".$langname."' AND sid=".$pid);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
}
?>
