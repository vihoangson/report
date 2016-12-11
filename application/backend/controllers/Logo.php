<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logo extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	
	$this->load->helper(array('url','form','file','global'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	$this->load->library('upload');
	//$this->load->library("FCKeditor");
	        
    $this->load->database();
	$this->load->model("Auth_model");
    $this->load->model("Product_model");
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
			$data['p'] = array ( 'Home' => base_url(), 'Logo' => '#');
			
			//code here
			include('../path/to/config/logo_config.php');
			$data['logo']			=	$logo;
			$data['total']			=	$total;
			$data['active_logo']	=	$active_logo;
			
			$this->my_layout->view("logo_view",$data); 
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function al(){
	  	if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Logo' => '#');
			
			//code here
			include('../path/to/config/logo_config.php');
			
			
			$this->my_layout->view("logoadd_view",$data); 
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function sl(){
	  
	  include('../path/to/config/logo_config.php');
	$title = trim(FixQuotes($this->input->post('title')));
	$subtitle = trim(FixQuotes($this->input->post('subtitle')));
	$content = trim(FixQuotes($this->input->post('content')));
	$address = trim(FixQuotes($this->input->post('address')));
	$vitri = trim(FixQuotes($this->input->post('vitri')));
	
	
	
	if($vitri =="0") {
	$this->my_layout->view("logoerror_view",array('error'=>"Chọn vị trí hiển thị logo")); 
	exit;		
	}	
	
	$images	=	"";
    $images = 	$this->Global_Model->uploadimage('../uploads/logo/', 762, 460, $images);
    if (!$images) {
    $this->my_layout->view("logoerror_view",array('error'=>"Hình ảnh tải lên bị lỗi")); 	
    exit;
    }
    
    
    $logonew = "$images|$address|$title|$vitri|$subtitle|$content";
    $total_n = $total + 1;
    
	@chmod('../path/to/config/logo_config.php', 0777);
    @$file = fopen('../path/to/config/logo_config.php', "w");
    if (!$file) {
    $this->my_layout->view("logoerror_view",array('error'=>"Lỗi không  mở được tập tin")); 
    exit;
    }
    
    $line = "######################################################################\n";
    
    $content = "<?php\n\n";
	$content .= "defined('BASEPATH') OR exit('No direct script access allowed');";
    $content .= "\$active_logo = $active_logo;\n";
    $content .= "\$total = $total_n;\n";
    $content .= "\$logo =\"\";\n";
    for($i =0; $i < sizeof($logo); $i ++) {
    if($logo[$i] !="") {		
    $content .= "\$logo[] = \"$logo[$i]\";\n";
    }
    }	
    $content .= "\$logo[] = \"$logonew\";\n";
    $content .= "\n";
    $content .= "$line\n";
    $content .= "\n";
    $content .= "?>\n";
    
    @$writefile = fwrite($file, $content);
    if (!$writefile) {
    $this->my_layout->view("logoerror_view",array('error'=>"Lỗi không  mở được tập tin")); 
    exit;
    }
    @fclose($file);
    @chmod('../path/to/config/logo_config.php', 0604);
    redirect(base_url()."index.php/logo/index");
  }
  
  public function el(){
	  
	if(!empty($this->session->userdata['aid']))
	{
	  	$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
		$data['l'] = $Au;
		$data['p'] = array ( 'Home' => base_url(), 'Logo' => '#');
	  
	  	include('../path/to/config/logo_config.php');
	 	$poz = $this->uri->segment(3,0);
		$nums = sizeof($logo);
		for($k =0; $k < $nums; $k ++) {
			$testnums[] = $k;
		}	
		sort($testnums);
		if($poz =="" || !in_array($poz,$testnums)) {redirect(base_url()."index.php/logo/index"); exit;}
	
		$logo_edit = $logo[$poz];
		$logoedit = @explode("|",$logo_edit);
		$data['logo'] 	= $logoedit;
		$data['poz']	= $poz;
		
		$this->my_layout->view("logoedit_view",$data); 
	}
	else
	{
		redirect(base_url()."index.php/logo/dashboard");
	}
	
  }
  
  public function sel(){
	  
	  $dimages		= (int) $this->input->post('delimg');
	  $poz 			= $this->uri->segment(3,0);
	  $image 		= $this->input->post('image');
	  $title 		= $this->input->post('title');
	  $subtitle 	= $this->input->post('subtitle');
	  $content 		= $this->input->post('content');
	  $address 		= $this->input->post('address');
	  $vitri 		= $this->input->post('vitri');

	  if($dimages)
	  {	
			$images="";
			$images = $this->Global_Model->uploadimage('../uploads/logo/',762,460,$image,'yes');
	  }
	  else
	  {
		  	$images = $image;
	  }
	  
	include('../path/to/config/logo_config.php');
	$nums = sizeof($logo);
	for($k =0; $k < $nums; $k ++) {
	$testnums[] = $k;
	}	
	sort($testnums);
	if($poz =="" || !in_array($poz,$testnums)) {header("Location: ".$adminfile.".php?op=logomain"); exit;}
	$title = trim(FixQuotes($title));
	$address = trim(FixQuotes($address));
	
	
	if($vitri =="0") {
	$this->my_layout->view("logoerror_view",array('error'=>"Chọn vị trí hiển thị logo")); 
	exit;		
	}	
	
	
    if (!$images) {
    $this->my_layout->view("logoerror_view",array('error'=>"Hình ảnh tải lên bị lỗi")); 
    exit;
    }
    
    $logonew = "$images|$address|$title|$vitri|$subtitle|$content";
    @chmod('../path/to/config/logo_config.php', 0777);
    @$file = fopen('../path/to/config/logo_config.php', "w");
    if (!$file) {
    $this->my_layout->view("logoerror_view",array('error'=>"Không mở được tập tin lữu trữ hình ảnh")); 
    exit;
    }
    
    $line = "######################################################################\n";
    
    $content = "<?php\n\n";
	$content .= "defined('BASEPATH') OR exit('No direct script access allowed');";
    $content .= "\$active_logo = $active_logo;\n";
    $content .= "\$total = $total;\n";
    $content .= "\$logo =\"\";\n";
    for($i =0; $i < sizeof($logo); $i ++) {
    if($i == $poz) {
    $logo[$i] = $logonew;
    }		
    $content .= "\$logo[] = \"$logo[$i]\";\n";
    }	
    $content .= "\n";
    $content .= "$line\n";
    $content .= "\n";
    $content .= "?>\n";
    
    @$writefile = fwrite($file, $content);
    if (!$writefile) {
    $this->my_layout->view("logoerror_view",array('error'=>"Không ghi dữ liệu lên tập tin")); 
    exit;
    }
    @fclose($file);
    @chmod('../path/to/config/logo_config.php', 0604);
    redirect(base_url()."index.php/logo/index");
  }
  
  public function dl(){
	  $poz = $this->uri->segment(3,0);
	  include('../path/to/config/logo_config.php');
	  	$nums = sizeof($logo);
		for($k =0; $k < $nums; $k ++) {
		$testnums[] = $k;
		}	
		sort($testnums);
		if($poz =="" || !in_array($poz,$testnums)) { redirect(base_url()."index.php/logo/index"); exit;}
		
		$logo_del = $logo[$poz];
		$logodel = @explode("|",$logo_del);
		@unlink('../uploads/logo/'.$logodel[0]);
		
		$total_n = $total - 1;
		@chmod('../path/to/config/logo_config.php', 0777);
		@$file = fopen('../path/to/config/logo_config.php', "w");
		if (!$file) {
		$this->my_layout->view("logoerror_view",array('error'=>"Không load được tập tin")); 
		exit;
		}
		
		$line = "######################################################################\n";
		
		$content = "<?php\n\n";
		$content .= "\$active_logo = $active_logo;\n";
		$content .= "\$total = $total_n;\n";
		$content .= "\$logo =\"\";\n";
		for($i =0; $i < sizeof($logo); $i ++) {
		if($i != $poz && $logo[$i] !="") {	
		$content .= "\$logo[] = \"$logo[$i]\";\n";
		}
		}	
		$content .= "\n";
		$content .= "$line\n";
		$content .= "\n";
		$content .= "?>\n";
		
		@$writefile = fwrite($file, $content);
		if (!$writefile) {
		include ("../header.php");
		$this->my_layout->view("logoerror_view",array('error'=>"Không lưu được tập tin")); 
		exit;
		}
		@fclose($file);
		@chmod('../path/to/config/logo_config.php', 0604);
		redirect(base_url()."index.php/logo/index");
  }
			
}

?>