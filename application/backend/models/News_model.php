<?php
class News_model extends CI_Model{

    private $_modules = "modules";
	private $_stories = "stories";
	private $_stories_auto = "stories_auto";
	private $_stories_categories = "stories_categories";
	private $_stories_categories_language = "stories_categories_language";
	private $_stories_comments = "stories_comments";
	private $_stories_images = "stories_images";
	private $_stories_temp = "stories_temp";
	private $_stories_topic = "stories_topic";
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
	
	function GetAllTopic($off="",$limit=""){
		
		$this->db->select('*');
        $this->db->from($this->_stories_topic);
		$this->db->limit($off,$limit);
		$this->db->order_by("topicid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function getTopic($id=0){
		
		$this->db->select('*');
        $this->db->from($this->_stories_topic);
		$this->db->where("topicid",$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function addTopic($data){
        if($this->db->insert($this->_stories_topic,$data))
			return TRUE;
        else
            return FALSE;
    }
	
	function deleteTopic($id=0){
        if($id!=0){

            $this->db->where("topicid",$id);
            $this->db->delete($this->_stories_topic);
		
			return TRUE;
        }
		else
		{
			return FALSE;
		}
    }
	
	function deleteTopicMulti($arr){
        
			$strsap = implode(",", $arr);
			
            $this->db->where("topicid IN (".$strsap.")");
            
			if($this->db->delete($this->_stories_topic))
			{
				return TRUE;
			}else{
				return FALSE;
			}
        
    }
	
	function updateTopic($data,$id){
        $this->db->where("topicid",$id);
        if($this->db->update($this->_stories_topic,$data))
            return TRUE;
        else
            return FALSE;
    }
	
	
	function getNewsCategories($mid=0){
		
		$this->News_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND sl.lang_id='.$this->linguaid.' AND s.mid='.$mid);
		$this->db->order_by("s.parentid","asc");
		$this->db->order_by("s.weight","asc");
		$this->db->order_by("s.catid","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function addNewsCategories($data){
        if($this->db->insert($this->_stories_categories,$data))
		{
            $this->db->select_max('catid');
			$query = $this->db->get($this->_stories_categories);
			$data = $query->result_array();
			return $data[0]['catid'];
		}
        else
		{
            return FALSE;
		}
    }
	
	function addNewsCategoriesLang($sql_ary){
		if (!sizeof($sql_ary))
		{
			return false;
		}
		foreach ($sql_ary as $ary)
		{
			if (!is_array($ary))
			{
				return false;
			}

			$this->db->insert($this->_stories_categories_language,$ary);
		}
		
		return true;
	}
	
	function getCategories($catid=0){
		
		$this->News_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND sl.lang_id='.$this->linguaid.' AND s.catid='.$catid);
		$this->db->order_by("s.weight","asc");
		$this->db->order_by("s.catid","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function getCategoriesLang($catid=0, $langid=1){
		
		$this->News_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND sl.lang_id='.$langid.' AND s.catid='.$catid);
		$this->db->order_by("s.weight","asc");
		$this->db->order_by("s.catid","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function deleteCategories($id=0, $parentid=0){
        if($id!=0){
			$this->News_model->InitLingua();
            $this->db->where("catid",$id);
            $this->db->delete($this->_stories_categories);
			
			$this->db->where('catid='.$id.' AND lang_id='.$this->linguaid);
			$this->db->delete($this->_stories_categories_language);
			
			if($parentid==0)
			{
				$c = $this->getSubNewsCategories($id);
				$this->db->where('parentid='.$id);
				$this->db->delete($this->_stories_categories);	
				
				foreach($c as $v)
				{	
				$this->db->where('catid='.$v['catid'].' AND lang_id='.$this->linguaid);
				$this->db->delete($this->_stories_categories_language);
				}
			}
			
			return TRUE;
        }
		else
		{
			return FALSE;
		}
    }
	
	function getParentNewsCategories($mid=0){
		
		$this->News_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND s.parentid=0 AND sl.lang_id='.$this->linguaid.' AND s.mid='.$mid);
		$this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function getSubNewsCategories($pid=0){
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories_categories.' as s,'.$this->_stories_categories_language.' as sl');
		$this->db->where('s.catid=sl.catid AND sl.lang_id='.$this->linguaid.' AND s.parentid='.$pid);
		$this->db->order_by("s.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function updateCategories($data,$id){
        $this->db->where("catid",$id);
        if($this->db->update($this->_stories_categories,$data))
            return TRUE;
        else
            return FALSE;
    }
	function updateCategoriesLanguage($data,$id,$langid=1){
		
        $this->db->where("catid=".$id." AND lang_id=".$langid);
        if($this->db->update($this->_stories_categories_language,$data))
            return TRUE;
        else
            return FALSE;
    }
	
	
	function getSection($mid=0){
		
		$this->News_model->InitLingua();
		
		$this->db->distinct('b.mid as mid');
		$this->db->select('b.mid, b.title as title');
		$this->db->from(''.$this->_stories_categories.' as a ');
		$this->db->join(''.$this->_modules.' as b', 'a.mid = b.mid', 'right');
		$this->db->order_by("a.weight","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	
	function addStories($data){
        if($this->db->insert($this->_stories,$data))
		{
            $this->db->select_max('sid');
			$query = $this->db->get($this->_stories);
			$data = $query->result_array();
			return $data[0]['sid'];
		}
        else
		{
            return FALSE;
		}
    }
	
	function AllStories($off="",$limit=""){

		$this->News_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories.'');
		//$this->db->where('lang_id='.$this->linguaid);
		$this->db->limit($off,$limit);
		$this->db->order_by("sid","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
		
	}
	
	function getStories($id=0){
		
		$this->News_model->InitLingua();
		
		$this->db->select('*');
        $this->db->from(''.$this->_stories.'');
		$this->db->where(' sid='.$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
	}
	function deleteStories($id=0){
        if($id!=0){
			$this->News_model->InitLingua();
            $this->db->where("sid",$id);
            if($this->db->delete($this->_stories))		
				return TRUE;
			else
				return FALSE;
        }
		else
		{
			return FALSE;
		}
    }
	function deleteStoriesMulti($arr){
        
			$this->News_model->InitLingua();
			$strsap = implode(",", $arr);
			
            $this->db->where("sid IN (".$strsap.")");
            
			if($this->db->delete($this->_stories))
			{
				$this->db->where("sid IN (".$strsap.')');
				if($this->db->delete($this->_stories))
					return TRUE;
				else
					return FALSE;
			}else{
				return FALSE;
			}
        
    }
	function updateStories($data,$id){
        $this->db->where("sid",$id);
        if($this->db->update($this->_stories,$data))
            return TRUE;
        else
            return FALSE;
    }
}
?>
