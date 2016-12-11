<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Block extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	$this->load->helper(array('url','form','global'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	        
    $this->load->database();
    $this->load->model("Auth_model");
	$this->load->model("Block_model");
	$this->load->model("Module_model");
	$this->load->model("Global_Model");
	//$this->login();
	
	$this->load->library("MY_layout"); // Sử dụng thư viện layout
    $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)

  }

  public function index(){
		// If the user is validated, then this function will run
		if($this->my_auth->is_Admin())
        {
			$rs = explode("@","0@Necessary information@@0@1257903712@english@block-uil.php@0@0@d@@all@238@1");
			//echo $rs[8];
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Blocks' => '#');
			
			//code here
			
			$data['blocks']	= $this->Block_model->GetBlocks();
			
			$this->my_layout->view("block_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  public function ablock(){
		// If the user is validated, then this function will run
		if($this->my_auth->is_Admin())
        {
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Blocks' => '#');
			
			//code here
			$blockslist ="";
			$blocksdir = opendir('../application/frontend/views/block');
			while($func = readdir($blocksdir)) {
				if(substr($func, 0, 6) == "block-") {
					$blockslist .= $func." ";
				}
			}
			closedir($blocksdir);
			$blockslist = explode(" ", $blockslist);
			sort($blockslist);
			
			$data['tip']		= $this->input->post('tip');
			$data['blockslist']	= $blockslist;
					
			$this->my_layout->view("ablock_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  public function saveablock(){
	  	if($this->my_auth->is_Admin())
      	{
			$title 		= $this->input->post('title');
			$blockfile	= $this->input->post('blockfile');
			$bposition	= $this->input->post('bposition');
			$active		= $this->input->post('active');
			$module		= $this->input->post('module');
			$btime 		= time();
			$weight=1;
			
			$result 	= $this->Block_model->GetBlocksWhere2($bposition);
			if(sizeof($result))
			{
			$weight 	= $result[0]['weight'];
    		$weight++;
			}
			
			$txtmodule ="";
			if(empty($module))
			{
				$txtmodule = "all";
			}
			else
			{
				$n=count($module);
				for($i=0;$i<$n;$i++)
				{
					
					if($module[$i]=="all" || $module[$i]=="home"||$module[$i]=="acp")
					{
						$txtmodule = $module[$i];
						break;
					}
					
					$txtmodule.= $module[$i];
					if($i<$n-1)
						$txtmodule.="|";
					
				}
			
			}
			
			$inputdata 	= array(
				'bid'		=> NULL,
				'bkey'		=> 0,
				'title'		=> $title,
				'url'		=> '',
				'bposition'	=> $bposition,
				'weight'	=> $weight,
				'active'	=> $active,
				'refresh'	=> 0,
				'time'		=> $btime,
				'blanguage'	=> 'english',
				'blockfile'	=> $blockfile,
				'view'		=> 0,
				'expire'	=> 0,
				'action'	=> 'd',
				'link'		=> '',
				'module'	=> $txtmodule
			);
			
			if($this->Block_model->InsertBlock($inputdata))
			{
				$this->blist();
				redirect(base_url()."index.php/block");
			}
			redirect(base_url()."index.php/block");
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  public function eblock(){
		// If the user is validated, then this function will run
		if($this->my_auth->is_Admin())
        {
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Blocks' => '#');
			
			//code here
			$bid = $this->uri->segment(3);
			$blockslist ="";
			$blocksdir = opendir('../application/frontend/views/block');
			while($func = readdir($blocksdir)) {
				if(substr($func, 0, 6) == "block-") {
					$blockslist .= $func." ";
				}
			}
			closedir($blocksdir);
			$blockslist = explode(" ", $blockslist);
			sort($blockslist);
			
			$data['tip']		= $this->input->post('tip');
			$data['blockslist']	= $blockslist;
			
			$data['block']		= $this->Block_model->GetBlocksWhereId($bid);
					
			$this->my_layout->view("eblock_view",$data);
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  public function saveeblock(){
	  	if($this->my_auth->is_Admin())
      	{
			$bid  		= $this->uri->segment(3);
			$oblock		= $this->Block_model->GetBlocksWhereId($bid);
			$oweight	= $oblock[0]['weight'];
			$oposition	= $oblock[0]['bposition'];
			
			$title 		= $this->input->post('title');
			$blockfile	= $this->input->post('blockfile');
			$bposition	= $this->input->post('bposition');
			$active		= $this->input->post('active');
			$module		= $this->input->post('module');
			$btime 		= time();
			
			if ($oposition != $bposition) {
			$result 	= $this->Block_model->GetBlocksWhere2($bposition);
			$weight 	= $result[0]['weight'];
    		$weight++;
			}else{
			$weight = $oweight;
			}
			
			$txtmodule ="";
			if(empty($module))
			{
				$txtmodule = "all";
			}
			else
			{
				$n=count($module);
				for($i=0;$i<$n;$i++)
				{
					
					if($module[$i]=="all" || $module[$i]=="home"||$module[$i]=="acp")
					{
						$txtmodule = $module[$i];
						break;
					}
					
					$txtmodule.= $module[$i];
					if($i<$n-1)
						$txtmodule.="|";
					
				}
			
			}
			
			$inputdata 	= array(
				'bkey'		=> 0,
				'title'		=> $title,
				'url'		=> '',
				'bposition'	=> $bposition,
				'weight'	=> $weight,
				'active'	=> $active,
				'refresh'	=> 0,
				'time'		=> $btime,
				'blanguage'	=> 'english',
				'blockfile'	=> $blockfile,
				'view'		=> 0,
				'expire'	=> 0,
				'action'	=> 'd',
				'link'		=> '',
				'module'	=> $txtmodule
			);
			
			if($this->Block_model->UpdateBlock($inputdata,$bid))
			{
				$this->fixweight();
				$this->blist();
				redirect(base_url()."index.php/block");
			}
			redirect(base_url()."index.php/block");
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  public function dblock(){
		// If the user is validated, then this function will run
		if($this->my_auth->is_Admin())
        {
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Blocks' => '#');
			
			//code here
			$bid = $this->uri->segment(3);
			$result = $this->Block_model->GetBlocksWhereId($bid);
			
			if(sizeof($result)!=0)
			{
			$blockfile = $result[0]['blockfile'];
			
			$this->Block_model->DeleteBlock($bid);
			$this->Block_model->OptimizeBlock();
			$this->fixweight();
			$this->blist();
			}
			redirect(base_url()."index.php/block/index");

		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  
  public function status(){
		// If the user is validated, then this function will run
		if($this->my_auth->is_Admin())
        {
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Blocks' => '#');
			
			//code here
			$bid = $this->uri->segment(3);
			$result	= $this->Block_model->GetBlocksWhereId($bid);
			
			$active	= $result[0]['active'];
			if ($active == 0) {
				$active = 1;
			} elseif ($active == 1) {
				$active = 0;
			}
			$datainput = array('active' => $active);
			$this->Block_model->UpdateBlock($datainput,$bid);
			$this->blist();	
			redirect(base_url()."index.php/block/index");	
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard/login");
		}
  }
  
  function blist() {
		
		date_default_timezone_set('Asia/Saigon');
		@chmod('../path/to/config/blist.php', 0777);
		@$file = fopen('../path/to/config/blist.php', "w");
		$content = "<?php\n\n";
		$fctime = date("d-m-Y H:i:s",filectime ('../path/to/config/blist.php'));
		$fmtime = date("d-m-Y H:i:s");
		$content .= "// File: blist.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Do not change anything in this file!\n\n";
		$content .= "\n";
		$bp_ar = array("l","r","c","d");
		for($t=0;$t < sizeof($bp_ar);$t++) {
			$fresult = $this->Block_model->GetBlocksWhere2($bp_ar[$t]);
			foreach($fresult as $frow) {
				$vtbl = intval($frow['weight'])-1;
				$content .= "\$bl_".$bp_ar[$t]."[".$vtbl."] = \"".$frow['bkey']."@".$frow['title']."@".$frow['url']."@".$frow['refresh']."@".$frow['time']."@".$frow['blanguage']."@".$frow['blockfile']."@".$frow['view']."@".$frow['expire']."@".$frow['action']."@".$frow['link']."@".$frow['module']."@".$frow['bid']."@".$frow['active']."\";\n";
			}
			$content .= "\n";
		}
		$content .= "?>";
		@$writefile = fwrite($file, $content);
		@fclose($file);
		@chmod('../path/to/config/blist.php', 0604);
	}
	
	
	function fixweight() {
		
		$result = $this->Block_model->GetBlocks();
		$xweight = 1;
		$old_posit = 0;
		foreach ($result as $row) {
			$posit = $row['bposition'];
			if($posit != $old_posit) $xweight = 1;
			$old_posit = $posit;
			$input = array('weight' => $xweight);
			$this->Block_model->UpdateBlock($input,$row['bid']);
			$xweight++;
		}
	}

}

?>