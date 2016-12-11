<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	
	$this->load->helper(array('url','form','global'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	        
    $this->load->database();
    $this->load->model("Auth_model");
	$this->load->model("Global_Model");
	//$this->login();
	
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
			$data['p'] = array ( 'Home' => base_url(), 'Configuration' => '#');
			
			//code here
			include('../application/frontend/config/config.php');
			$lan = $config['language'];
			
			$lingua = $this->Global_Model->lingua();
			
			$str = "";
			if(sizeof($lingua)){
				$str.='<select name="language" onChange="top.location.href=this.options[this.selectedIndex].value">';
				foreach($lingua as $l)
				{
					if($l['lang']==$lan){
						
						$str.='<option name="language" value="setlang'.$l['lang_id'].'" selected="selected">'.$l['lang'].'</option>';
						
					}else{
						
						$str.='<option name="language" value="setlang/'.$l['lang_id'].'">'.$l['lang'].'</option>';
					}
					
				}
				$str.='</select>';
			}
			
			$data['language'] = $str;
			$this->my_layout->view("configuration_view",$data);
			
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function setlang(){
	  
	 $langid = $this->uri->segment(3);
	 include('../application/frontend/config/config.php');
	 @chmod('../application/frontend/config/config.php', 0777);
     @$file = fopen('../application/frontend/config/config.php', "w");
     if (!$file) {
     $this->my_layout->view("logoerror_view",array('error'=>"Lỗi không  mở được tập tin")); 
     exit;
     }
	$content = "<?php\n\n";
	$content .= "defined('BASEPATH') OR exit('No direct script access allowed');";
	$content .= "\$config['base_url'] = '';\n";
	$content .= "\$config['index_page'] = 'index.php';\n";
	$content .= "\$config['uri_protocol']	= 'REQUEST_URI';\n";
	$content .= "\$config['url_suffix'] = '';\n";
	$content .= "\$config['language']	= '".$this->Global_Model->linguaname($langid)."';\n";
	$content .= "\$config['charset'] = 'UTF-8';\n";
	$content .= "\$config['enable_hooks'] = TRUE;\n";
	$content .= "\$config['subclass_prefix'] = 'MY_';\n";
	$content .= "\$config['composer_autoload'] = FALSE;\n";
	$content .= "\$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';\n";
	$content .= "\$config['allow_get_array'] = TRUE;\n";
	$content .= "\$config['enable_query_strings'] = FALSE;\n";
	$content .= "\$config['controller_trigger'] = 'c';\n";
	$content .= "\$config['function_trigger'] = 'm';\n";
	$content .= "\$config['directory_trigger'] = 'd';\n";
	$content .= "\$config['log_threshold'] = 0;\n";
	$content .= "\$config['log_path'] = '';\n";
	$content .= "\$config['log_file_extension'] = '';\n";
	$content .= "\$config['log_file_permissions'] = 0644;\n";
	$content .= "\$config['log_date_format'] = 'Y-m-d H:i:s';\n";
	$content .= "\$config['error_views_path'] = '';\n";
	$content .= "\$config['cache_path'] = '';\n";
	$content .= "\$config['cache_query_string'] = FALSE;\n";
	$content .= "\$config['encryption_key'] = '';\n";
	$content .= "\$config['sess_driver'] = 'files';\n";
	$content .= "\$config['sess_cookie_name'] = 'ci_session';\n";
	$content .= "\$config['sess_expiration'] = 7200;\n";
	$content .= "\$config['sess_save_path'] = sys_get_temp_dir();\n";
	$content .= "\$config['sess_match_ip'] = FALSE;\n";
	$content .= "\$config['sess_time_to_update'] = 300;\n";
	$content .= "\$config['sess_regenerate_destroy'] = FALSE;\n";
	$content .= "\$config['cookie_prefix']	= '';\n";
	$content .= "\$config['cookie_domain']	= '';\n";
	$content .= "\$config['cookie_secure']	= FALSE;\n";
	$content .= "\$config['cookie_httponly'] 	= FALSE;\n";
	$content .= "\$config['standardize_newlines'] = FALSE;\n";
	$content .= "\$config['global_xss_filtering'] = FALSE;\n";
	$content .= "\$config['csrf_protection'] = FALSE;\n";
	$content .= "\$config['csrf_token_name'] = 'csrf_test_name';\n";
	$content .= "\$config['csrf_cookie_name'] = 'csrf_cookie_name';\n";
	$content .= "\$config['csrf_expire'] = 7200;\n";
	$content .= "\$config['csrf_regenerate'] = TRUE;\n";
	$content .= "\$config['csrf_exclude_uris'] = array();\n";
	$content .= "\$config['compress_output'] = FALSE;\n";
	$content .= "\$config['time_reference'] = 'local';\n";
	$content .= "\$config['rewrite_short_tags'] = FALSE;\n";
	$content .= "\$config['proxy_ips'] = '';\n";
	
	@$writefile = fwrite($file, $content);
    if (!$writefile) {
    $this->my_layout->view("logoerror_view",array('error'=>"Lỗi không  mở được tập tin")); 
    exit;
    }
    @fclose($file);
    @chmod('../application/frontend/config/config.php', 0604);
    redirect(base_url()."index.php/configuration/index");
	  
  }
}

?>