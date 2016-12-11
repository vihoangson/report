<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	
	$this->load->helper(array('url','form','global'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	$this->load->library('upload');
	//$this->load->library("FCKeditor");
	        
    $this->load->database();
	$this->load->model("Auth_model");
    $this->load->model("Module_model");
	$this->load->model("News_model");
	$this->load->model("Global_Model");
	//$this->login();
	
	/*$this->load->helper('language');
	$this->lang->load(substr(LANGUAGE,0,2),LANGUAGE);*/
	
	$this->load->library("MY_layout"); // Sử dụng thư viện layout
    $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)

  }

  public function index(){
		//If the user is validated, then this function will run
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'News' => '#');
			
			$max = sizeof($this->News_model->AllStories());
			$min = 12;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/news/index";
				$config['total_rows'] = $max;
				$config['per_page'] = $min;
				$config['num_link'] = 3; 
				$config['uri_segment'] = 3;
				//config first
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				//config last
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				//config next
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['next_link'] = '&raquo;';
				//config prev
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo;';
				//config num
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				//config cur
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				
				$this->pagination->initialize($config);
				
				$data['link'] = $this->pagination->create_links();
				$data['stories'] = $this->News_model->AllStories($min,$this->uri->segment($config['uri_segment']));
		
				$this->my_layout->view("stories_view",$data); 
			}
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function specialcat()
  {
		
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Shop' => '#');
			
			//code here
			$data['topic'] = $this->News_model->GetAllTopic();
			$this->my_layout->view("specialcat_view",$data); 
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
		
  }
  
  public function addtopic()
  {
		
	  	$title 	=	$this->input->post('title');
	 
		$input_data= array(	
		"topictitle" 		=> 	$title
		);
		
		if($this->News_model->addTopic($input_data))
		{
			redirect(base_url()."index.php/news/specialcat");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/news/specialcat");
		}
  }
  
  public function deletetopic()
  {
	  	$topicid = $this->uri->segment(3,0);
		
		if($this->News_model->deleteTopic($topicid))
		{
			redirect(base_url()."index.php/news/specialcat");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/news/specialcat");
		}
  }
  
  
  public function edittopic()
  {
	  	if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'News' => '#');
			
			
			$topicid = $this->uri->segment(3,0);
			$data['atopic'] = $this->News_model->getTopic($topicid);
		
			$this->my_layout->view("edittopic_view",$data); //add product
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	  	
  }
  
  public function saveedittopic()
  {
		$topicid = $this->uri->segment(3,0);
		
		$input_data= array(	
			"topictitle" => $this->input->post('title')
		);
		
		
		if($this->News_model->updateTopic($input_data,$topicid))
		{
			redirect(base_url()."index.php/news/specialcat");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/news/specialcat");
		}
  }
  
  public function deletealltopic()
  {
	   	$ap = $this->input->post('dall');
	 
	  	if($this->News_model->deleteTopicMulti($ap))
	  		redirect(base_url()."index.php/news/specialcat");
		else
			redirect(base_url()."index.php/news/specialcat");
  }
	
  /***************************************************************************
  *CATEGORIES
  ***************************************************************************/
  public function categories()
  {
		
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'News' => '#');
			
			//code here
			$data['show_stories_category'] = $this->show_stories_category();
			$data['show_stories_ihome'] = $this->show_stories_ihome();
			
			
			$data['display_stories_category'] = $this->display_stories_category();
			
			$this->my_layout->view("newscategories_view",$data); //add product
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
		
  }
  
  public function savecategories()
  {
	  
		$input_data= array(
		"catimage" 	=> 	'',
		"mid" 		=> 	(int)$this->input->post('mid'),
		"ihome" 	=> 	(int)$this->input->post('xihome'),
		"linkshome" => 	0,
		
		"aid" 		=>	0,
		"weight" 	=> 	0,
		"parentid" 	=> 	(int)$this->input->post('parentid')
		);
		$next = $this->News_model->addNewsCategories($input_data);
		
	
		$title= is_array($_POST['txttitle'])?$_POST['txttitle']:array();
		$lang= is_array($_POST['lang'])?$_POST['lang']:array();
	
		$input_data_extend=array();
		for($i=0;$i<count($title);$i++)
		{
			$input_data_extend[$i] = array("catid"=>$next,"lang_id"=>$lang[$i],"title"=>$title[$i]);		
		}	
		$result = $this->News_model->addNewsCategoriesLang($input_data_extend);
		if($result)
		{
			 redirect(base_url()."index.php/news/categories");
		}
		redirect(base_url()."index.php/news/categories");
  }
  
  public function deletenewscategories(){
	  
	  	$catid = $this->uri->segment(3,0);
		$data = $this->News_model->getCategories($catid);
		$parentid = $data[0]['parentid'];
		
	
		if($this->News_model->deleteCategories($catid, $parentid))
		{
			redirect(base_url()."index.php/news/categories");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/news/categories");
		}
	  
  }
  
  public function editnewscategories(){
	  
	  	if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'News' => '#');
			
			//code here
			$catid = $this->uri->segment(3,0);
			$result = $this->News_model->getCategories($catid);
			$xihome = $result[0]['ihome'];
			$mid = $result[0]['mid'];
			
			$data['catid'] = $catid;
			$data['show_edit_stories_category'] = $this->show_edit_stories_category($mid);
			$data['show_stories_ihome'] = $this->show_stories_ihome($xihome);
			$data['select_categories_parent'] = $this->select_categories_parent($catid,$mid);
			
			$data['display_stories_category'] = $this->display_stories_category();
			
			$this->my_layout->view("editnewscategories_view",$data); //add product
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	  
  }
  
  public function saveeditcategories(){
	  
		$catid= (int) $this->uri->segment(3,0);
		
		$input_data= array(
			"mid" => (int)$this->input->post('mid'),
			"ihome" => (int)$this->input->post('xihome'),
			"parentid" =>(int) $this->input->post('parentid')
			);
	
		if($this->News_model->updateCategories($input_data,$catid)){
			
			$title= is_array($_POST['txttitle'])?$_POST['txttitle']:array();
			$lang= is_array($_POST['lang'])?$_POST['lang']:array();
			
			$input_data=array();
			for($i=0;$i<count($title);$i++)
			{
			
				$input_data = array("title"=>$title[$i]);	
				$this->News_model->updateCategoriesLanguage($input_data,$catid,$lang[$i]);
			}	
		
		}
	 	redirect(base_url()."index.php/news/categories");
  }
  
  public function setweightcategories(){
	  
	  	$catid= (int) $this->uri->segment(3,0);
		
		$input_data= array(
			"weight" => (int)$this->input->post('weight')
		);
		if($this->News_model->updateCategories($input_data, $catid))
		{
			redirect(base_url()."index.php/news/categories");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/news/categories");
		}
	
  }
  
  function show_edit_stories_category($id=0)
  {
	  	$string ="";
	  	
		$string.='<script language="javascript" type="text/javascript">
		
		var sectioncategories = new Array;
		sectioncategories[0] = new Array( \'-1\',\'-1\',\'Select Category\' );
		sectioncategories[1] = new Array( \'0\',\'0\',\'Uncategorized\' );';
		
		
	
	 	$result = $this->Module_model->GetModules();
	  	$i=2;
	  	foreach($result as $rs) 
	  	{
	  		$mid=$rs['mid'];
			$string.="sectioncategories[$i] = new Array( '$mid','0','Chủ đề chính','0' ); \n\n";
			$i++;
			$row = $this->News_model->getNewsCategories($mid);
			foreach($row as $r)
			{
				$mid=$r['mid'];
				$catid=$r['catid'];
				$title=$r['title'];
				$pid=$r['parentid'];
				
				$string.="sectioncategories[$i] = new Array( '$mid','$catid','$title','$pid' ); \n\n";
				$i++;
			}
	  	}
	 	
		
		$string.='</script>

        <select name="mid" id="mid" class="inputbox" size="1" onchange="changeDynaList(\'parentid\', sectioncategories, document.adminForm.mid.options[document.adminForm.mid.selectedIndex].value, 0, 0);">
        
        <option value="0"  selected="selected">--Modules--</option>';
        
        $result = $this->Module_model->GetModules();
        foreach($result as $row) {
			$sel="";
		  	if($row['mid']==$id)
		  		$sel='selected="selected"';
				
			$string.= "<option value=\"".$row['mid']."\" ".$sel.">".$row['title']."</option>";
		}
        
        $string.='</select>';
       
	   	return $string;
  }
  
  function put_home($ihome, $acomm) {

		$string="<b>Đưa lên trang chủ</b>&nbsp;&nbsp;";
	
		if ($ihome == 1) {
	
			$sel1 = "checked";
	
			$sel2 = "";
	
		} else {
	
			$sel1 = "";
	
			$sel2 = "checked";
	
		}
	
		$string.="<input type=\"radio\" class=\"no-uniform\" name=\"ihome\" value=\"1\" $sel1>Yes&nbsp;";
	
		$string.="<input type=\"radio\" class=\"no-uniform\" name=\"ihome\" value=\"0\" $sel2>No<br>";
		
		return $string;
	
		/*echo "<br><b>"._ACTIVATECOMMENTS."</b>&nbsp;&nbsp;";
	
		if (($acomm == 0) OR ($acomm == "")) {
	
			$sel1 = "checked";
	
			$sel2 = "";
	
		}
	
		if ($acomm == 1) {
	
			$sel1 = "";
	
			$sel2 = "checked";
	
		}
	
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>"._YES."&nbsp;"
	
			."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>"._NO."</font><br><br>";*/
	
	}

  function select_language($sellang) {
		$string="";
		$lang = $this->Global_Model->lingua();
		for($i=0;$i<count($lang); $i++)
	 	{
			$string.="<input type=\"radio\" class=\"no-uniform\" name=\"language\" value=\"".$lang[$i]['lang']."\"";
			if($sellang==$lang[$i]['lang'])
				$string.=" checked ";
			$string.="><img src=\"".base_url()."images/".$lang[$i]['flag']."\" />";
		}
		return $string;
  }

  function select_topic($topicid=0) {
	
		$string="";
		
		$result = $this->News_model->GetAllTopic();
	
		$string.="<br><b>Nhóm tin liên quan</b> ";
	
		$string.="<select name=\"topicid\">";
	
		$string.="<option name=\"topicid\" value=\"0\">Chọn nhóm tin liên quan</option>";
	
		foreach( $result as $row) {
	
			$string.="<option name=\"topicid\" value=\"$row[topicid]\"";
	
			if ($row['topicid'] == $topicid) { $string.=" selected"; }
	
			$string.=">$row[topictitle]</option>";
	
		}
	
		$string.="</select>";
		return $string;
	
	}

  function show_edit_stories_section($id=0)
  {
	  	$string ="";
	  	
		$string.='<script language="javascript" type="text/javascript">
		
		var sectioncategories = new Array;
		sectioncategories[0] = new Array( \'-1\',\'-1\',\'Select Category\' );
		sectioncategories[1] = new Array( \'0\',\'0\',\'Uncategorized\' );';
		
		
	
	 	$result = $this->Module_model->GetModules();
	  	$i=2;
	  	foreach($result as $rs) 
	  	{
	  		$mid=$rs['mid'];
			$string.="sectioncategories[$i] = new Array( '$mid','0','Chủ đề chính','0' ); \n\n";
			$i++;
			$row = $this->News_model->getNewsCategories($mid);
			foreach($row as $r)
			{
				$mid=$r['mid'];
				$catid=$r['catid'];
				$title=$r['title'];
				$pid=$r['parentid'];
				
				$string.="sectioncategories[$i] = new Array( '$mid','$catid','$title','$pid' ); \n\n";
				$i++;
			}
	  	}
	 	
		
		$string.='</script>

        <select name="sectionid" id="sectionid" class="inputbox" size="1" onchange="changeDynaList(\'catid\', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value,0 ,0);">
		<option value="-1" >- Select Section -</option>';
        
        $result = $this->News_model->getSection();
        foreach($result as $row) {
			if($row['mid']==$id)
		  		$string.="<option value=\"".$row['mid']."\" selected=\"selected\">".$row['title']."</option>";
		  	else
		    	$string.="<option value=\"".$row['mid']."\" >".$row['title']."</option>";
		}
        
        $string.='</select>';
       
	   	return $string;
  }

  function show_stories_section($id=0)
  {
	  	$string ="";
	  	
		$string.='<script language="javascript" type="text/javascript">
		
		var sectioncategories = new Array;
		sectioncategories[0] = new Array( \'-1\',\'-1\',\'Select Category\' );
		sectioncategories[1] = new Array( \'0\',\'0\',\'Uncategorized\' );';
		
		
	
	 	$result = $this->Module_model->GetModules();
	  	$i=2;
	  	foreach($result as $rs) 
	  	{
	  		$mid=$rs['mid'];
			$string.="sectioncategories[$i] = new Array( '$mid','0','Chủ đề chính','0' ); \n\n";
			$i++;
			$row = $this->News_model->getNewsCategories($mid);
			foreach($row as $r)
			{
				$mid=$r['mid'];
				$catid=$r['catid'];
				$title=$r['title'];
				$pid=$r['parentid'];
				
				$string.="sectioncategories[$i] = new Array( '$mid','$catid','$title','$pid' ); \n\n";
				$i++;
			}
	  	}
	 	
		
		$string.='</script>

        <select name="sectionid" id="sectionid" class="inputbox" size="1" onchange="changeDynaList(\'catid\', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);">
		<option value="-1" >- Select Section -</option>
		<option value="0"  selected="selected">Uncategorized</option>';
        
        $result = $this->News_model->getSection();
        foreach($result as $row) {
			$string.= "<option value=\"".$row['mid']."\" >".$row['title']."</option>";
		}
        
        $string.='</select>
        <select name="catid" id="catid" class="inputbox" size="1">
		<option value="-1" >Select Category</option>
		</select>';
       
	   	return $string;
  }
  
  function show_stories_category($id=0)
  {
	  	$string ="";
	  	
		$string.='<script language="javascript" type="text/javascript">
		
		var sectioncategories = new Array;
		sectioncategories[0] = new Array( \'-1\',\'-1\',\'Select Category\' );
		sectioncategories[1] = new Array( \'0\',\'0\',\'Uncategorized\' );';
		
		
	
	 	$result = $this->Module_model->GetModules();
	  	$i=2;
	  	foreach($result as $rs) 
	  	{
	  		$mid=$rs['mid'];
			$string.="sectioncategories[$i] = new Array( '$mid','0','Chủ đề chính','0' ); \n\n";
			$i++;
			$row = $this->News_model->getNewsCategories($mid);
			foreach($row as $r)
			{
				$mid=$r['mid'];
				$catid=$r['catid'];
				$title=$r['title'];
				$pid=$r['parentid'];
				
				$string.="sectioncategories[$i] = new Array( '$mid','$catid','$title','$pid' ) \n\n";
				$i++;
			}
	  	}
	 	
		
		$string.='</script>

        <select name="mid" id="mid"  onchange="changeDynaList(\'parentid\', sectioncategories, document.adminForm.mid.options[document.adminForm.mid.selectedIndex].value, 0, 0);">
        
        <option value="1"  selected="selected">--Modules--</option>';
        
        $result = $this->Module_model->GetModules();
        foreach($result as $row) {
			$sel="";
		  	if($row['mid']==$id)
		  		$sel='selected="selected"';
				
			$string.= "<option value=\"".$row['mid']."\" ".$sel.">".$row['title']."</option>";
		}
        
        $string.='</select>
        <select name="parentid" id="parentid" class="inputbox" size="1">
        <option name="parentid" id="parentid" value="-1"  >Select Category</option>
        </select>';
       
	   	return $string;
  }
  
  function show_stories_ihome($id=0)
  {
	$string="";
	if($id==1)
	{
		$string.="<input type=\"radio\" class=\"no-uniform\" name=\"xihome\" value=\"1\" checked>Yes";
		$string.="<input type=\"radio\" class=\"no-uniform\" name=\"xihome\" value=\"0\" >No"; 
	}
	else
	{
		$string.="<input type=\"radio\" class=\"no-uniform\" name=\"xihome\" value=\"1\"  >Yes";
		$string.="<input type=\"radio\" class=\"no-uniform\" name=\"xihome\" value=\"0\" checked>No"; 
	}
	return $string;
  }
  
  function display_stories_category()
  {
	  	$string="";
	  
		$result = $this->Module_model->GetModules();
		foreach($result as $row)
		{
			$mid 	= intval($row['mid']);
			$xtitle = $row['title'];
			//$acat= explode('**',$row['title']);
			//$xtitle = $acat[0];
			$rs = $this->News_model->getParentNewsCategories($mid);
			if(sizeof($rs))
			{
				$data['cat'] = $rs;
				$string.="<table width=\"100%\" border=\"0\">";
				$string.="<tr><td>";
				$string.='<b>'.$xtitle.'</b>';
				$string.="</td></tr>";
				$string.="<tr><td  height=\"1\" bgcolor=\"#CCCCCC\"></td></tr>";		
				$string.="</table>";
				$string.= $this->load->view('shownewscategories_view', $data, true);	
			}
			
		}	
		return $string;	
  }
  
  function select_categories($cat,$mid,$catname='catid') {
	
	$string="";
    $result = $this->News_model->getParentNewsCategories($mid);

	$string.=' <select name="'.$catname.'" id="'.$catname.'" class="inputbox" size="1">
	<option value="0"  selected="selected">Select Category</option>';
	$i=1;
		foreach ($result as $row) 
		{
			if($i%2==0) $color="#FF0000";
			else $color="#0000FF";
			$ctitle = $row['title'];
			$ccatid=$row['catid'];
	
			if ($row['catid'] == $cat)
			{
			$string.="<option  value=\"$row[catid]\" style=\"color:$color; font-weight:bold;\" selected=\"selected\">$ctitle</option>";
			}
			else
			{
			$string.="<option  value=\"$row[catid]\" style=\"color:$color; font-weight:bold;\">$ctitle</option>";
			}
		   
			
			
			$cre = $this->News_model->getSubNewsCategories($ccatid);
			
			foreach ($cre as $crow) 
			{
				$xtitle = $crow['title'];
				$vtitle = "$ctitle&raquo;$xtitle";
				if ($crow['catid'] == $cat)
				{
					$string.="<option  value=\"$crow[catid]\" selected=\"selected\">$vtitle</option>";
				}
				else
				{
					$string.="<option  value=\"$crow[catid]\" style=\"color:$color; font-weight:bold;\">$vtitle</option>";
				}
				
	
			}
			$i++;
			
	
		}
	
		$string.="</select>";
		return $string;
	
	}

  function select_categories_parent($cat,$mid) {
	
    $result = $this->News_model->getCategories($cat);
	$row = $result[0];
	$parentcaitd=$row['parentid'];
	

    $query  = $this->News_model->getParentNewsCategories($mid);
	$string="";
   
	$string.=' <select name="parentid" id="parentid" class="inputbox" size="1">
	<option value="0" >Chủ đề chính</option>';
	
		$i=1;
		foreach($query as $rs) 
		{
			if($i%2==0) $color="#FF0000";
			else $color="#0000FF";
			$ctitle = $rs['title'];
			$ccatid=$rs['catid'];
			$parentid=$rs['parentid'];
			if ($ccatid == $parentcaitd && $parentcaitd==0)
			{
			$string.="<option  value=\"$row[catid]\" style=\"color:$color; font-weight:bold;\" selected=\"selected\">$ctitle</option>";
			}
			else
			{
				$string.="<option  value=\"$row[catid]\" style=\"color:$color; font-weight:bold;\">$ctitle</option>";
				
		    }
			
			$i++;
			
		}
	
	 $string.="</select>";
	 return $string;
	
	}
	/***************************************************************************
	*NEWS
	***************************************************************************/
	public function addStories()
	{
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'News' => '#');
			
			//code here
			$data['show_stories_section'] = $this->show_stories_section();
			$data['select_topic'] = $this->select_topic(0);
			$data['put_home'] = $this->put_home(1, 0);
			$data['select_language'] = $this->select_language(1);
			
			
			$data['display_stories_category'] = $this->display_stories_category();
			
			$this->my_layout->view("addStories_view",$data); //add product
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	}
	
	public function saveStories()
	{
		
		$subject 		= $this->input->post('subject');
		$hometext		= $this->input->post('hometext');
		$bodytext 		= $this->input->post('bodytext');
		$source 		= $this->input->post('source');
		$author 		= $this->input->post('author');
		$ihome 			= $this->input->post('ihome');
		$sectionid 		= $this->input->post('sectionid');
		$catid	 		= $this->input->post('catid');
		$lang	 		= $this->input->post('language');
		$topicid 		= $this->input->post('topicid');
		
		
	  	$images="";
	  	$images 	= 	$this->Global_Model->uploadimage('../uploads/modules/news/',700,850,$images);
		$input_data= array(	
		"sid" 			=> 	NULL,
		"catid" 		=> 	$catid,
		"aid" 			=> 	$author,
		"title" 		=> 	$subject,
		"time" 			=>	time()	,
		"hometext" 		=> 	$hometext,
		"bodytext" 		=> 	$bodytext,
		"images" 		=>	$images,
		"comments" 		=> 	0,	
		"counter" 		=> 	0,
		"notes" 		=> 	"",
		"ihome" 		=> 	$ihome,
		"alanguage" 	=> 	$lang,
		"acomm" 		=> 	0,
		"imgtext" 		=> 	0,
		"source" 		=> 	$source,
		"topicid" 		=> 	$topicid,
		"newsst"		=>  0
		);
		
		if($this->News_model->addStories($input_data))
		{
			redirect(base_url()."index.php/news/index");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/news/index");
		}
  
	}
	
	public function deletestories(){
		
		$sid = $this->uri->segment(3,0);

		$result = $this->News_model->getStories($sid);
	
		$row = $result[0];
	
		$images = $row['images'];
	
		@unlink('../uploads/modules/news/'.$images);
	
		if($this->News_model->deleteStories($sid)){
	
			redirect(base_url()."index.php/news/index");
		}
		else
		{
			redirect(base_url()."index.php/news/index");
		}
	}
	
	public function deleteallstories()
	{
		$ap = $this->input->post('dall');
	 
	  	foreach($ap as $v)
	  	{
		 	$data = $this->News_model->getStories($v);
		
			$image = $data[0]['images'];
			
			if($image && file_exists('../uploads/modules/news/'.$image))
			{
				@unlink('../uploads/modules/news/'.$image);
			}
	  	}
	  	if($this->Product_model->deleteStoriesMulti($ap))
	  		redirect(base_url()."index.php/news/index");
		else
			redirect(base_url()."index.php/news/index");
	}
	
	public function editstories()
	{
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'News' => '#');
			
			//code here
			$sid = $this->uri->segment(3,0);
			$result = $this->News_model->getStories($sid);
			$row = $result[0];
			$catid = $row['catid'];
			$ihome = $row['ihome'];
			$selang = $row['alanguage'];
			$topicid = $row['topicid'];
			$cat = $this->News_model->getCategories($catid);
			if(sizeof($cat)){
			$mid = $cat[0]['mid'];
			}else{
			$mid=0;
			}
			
			$data['show_edit_stories_section'] = $this->show_edit_stories_section($mid);
			$data['select_topic'] = $this->select_topic($topicid);
			$data['put_home'] = $this->put_home($ihome, 0);
			$data['select_language'] = $this->select_language($selang);
			$data['select_categories'] = $this->select_categories($catid,$mid);
			
			
			$data['stories'] = $row;
			
			$this->my_layout->view("editStories_view",$data); //add product
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	}
	
	public function saveeditstories()
	{
			//print_r($this->input->post());
			$dimages=(int) $this->input->post('delimg');
			$sid = $this->uri->segment(3,0);
			$stories = $this->News_model->getStories($sid);
		
			if($dimages || $stories[0]['images']=="")
			{
				
				$images="";
				$images = $this->Global_Model->uploadimage('../uploads/modules/news/',700,850,$stories[0]['images'],'yes');
				
				$input_data= array(	
				"catid" 		=> 	$this->input->post('catid'),
				"title" 		=> 	$this->input->post('subject'),
				"time" 			=>	time()	,
				"hometext" 		=> 	$this->input->post('hometext'),
				"bodytext" 		=> 	$this->input->post('bodytext'),
				"images" 		=>	$images,
				"ihome" 		=> 	$this->input->post('ihome'),
				"alanguage" 	=> 	$this->input->post('language'),
				"topicid" 		=> 	$this->input->post('topicid')
				);
			}
			else
			{
				$input_data= array(	
				"catid" 		=> 	$this->input->post('catid'),
				"title" 		=> 	$this->input->post('subject'),
				"time" 			=>	time()	,
				"hometext" 		=> 	$this->input->post('hometext'),
				"bodytext" 		=> 	$this->input->post('bodytext'),
				"ihome" 		=> 	$this->input->post('ihome'),
				"alanguage" 	=> 	$this->input->post('language'),
				"topicid" 		=> 	$this->input->post('topicid')
				);
			}
			
			if($this->News_model->updateStories($input_data,$sid))
			{
				redirect(base_url()."index.php/news/index");
			}
			else
			{
				//Lỗi
				redirect(base_url()."index.php/news/index");
			}
	  }
}

?>