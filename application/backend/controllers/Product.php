<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
	
	
	$this->load->helper(array('url','form'));
	$this->load->library(array("form_validation","session"));
	$this->load->library("MY_Auth");
	$this->load->library('upload');
	//$this->load->library("FCKeditor");
	        
    $this->load->database();
	$this->load->model("Auth_model");
    $this->load->model("Product_model");
	$this->load->model("Global_Model");
	//$this->login();
	
	$this->load->helper('global');
	
	$this->load->library("MY_layout"); // Sử dụng thư viện layout
    $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)

  }

  public function index(){
		//If the user is validated, then this function will run
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Shop' => '#');
			
			$max = sizeof($this->Product_model->ShopProducts());
			$min = 12;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/product/index";
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
				$data['products'] = $this->Product_model->ShopProducts($min,$this->uri->segment($config['uri_segment']));
		
				$this->my_layout->view("shop_view",$data); 
			}
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function ap()
  {
		
		if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Shop' => '#');
			
			$data['cid'] = $this->Product_model->ShopModule();
			
			$data['catgories']=$this->load->view('grouppc_view',$data,true);//group product categories
			
			$this->my_layout->view("ap_view",$data); //add product
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function sp()
  {
	  //print_r($_FILES['userfile']);
	  
	  $image = array();
	  $pic = $this->Global_Model->uploadmultiimage('../uploads/modules/pic/',700,850);
	 	  
	  $cid 		=	$this->input->post('cid');
	  $title 	=	$this->input->post('title');
	  $ihome	=	(int)$this->input->post('ihome');
	  $hometext	=	$this->input->post('hometext');
	  $bodytext	=	$this->input->post('bodytext');
	  $this->Product_model->InitLingua();
	  $langid	=	$this->Product_model->linguaid;
	  
	  if(is_array($pic)){
	  $images 	= 	implode(",",$pic);
	  }else{$images="";}
	  
		$input_data= array(	
		"cid" 			=> 	$cid,
		"is_home" 		=> 	$ihome,
		"man_id" 		=> 	1,
		"is_public" 	=> 	1,
		"price" 		=>	0,
		"price_market" 	=> 	0,
		"is_slide" 		=> 	1,
		"is_cart" 		=>	1,
		"is_comment" 	=> 	1,	
		"images" 		=> 	$images,
		"date" 			=> 	time()	
		);
		$next = $this->Product_model->addShop($input_data);
		$input_data_extend= array(	
		"pid"			=>	$next,
		"title" 		=> 	$title,
		"hometext" 		=> 	$hometext,
		"bodytext" 		=> 	$bodytext,
		"lang_id" 		=> 	$langid
		);
		if($this->Product_model->addShopLanguage($input_data_extend))
		{
			redirect(base_url()."index.php/product");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/product");
		}
  }
  
  public function dp()
  {
	  	$pid = $this->uri->segment(3,0);
		$data = $this->Product_model->getShop($pid);
		$image = $data[0]['images'];
	
		if($image!="" && file_exists('../uploads/modules/pic/'.$image))
		{
			@unlink('../uploads/modules/pic/'.$image);
		}
		if($this->Product_model->deleteShop($pid))
		{
			redirect(base_url()."index.php/product");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/product");
		}
  }
  
  public function ep()
  {
	  	if(!empty($this->session->userdata['aid']))
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Shop' => '#');
			$data['cid'] = $this->Product_model->ShopModule();
			
			$pid = $this->uri->segment(3,0);
			$data['product'] = $this->Product_model->getShop($pid);
			$data['cselect'] = $data['product'][0]['cid'];

			$data['catgories']=$this->load->view('grouppc_view',$data,true);//group product categories
			
			$this->my_layout->view("ep_view",$data); //add product
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
	  	
  }

  
  public function sep()
  {
		//print_r($this->input->post());
		//print_r($_FILES['userfile']);
		
	  	$dimages	= $this->input->post('delimg');
		$pid 		= $this->uri->segment(3,0);
		$product 	= $this->Product_model->getShop($pid);
		$img 		= $product[0]['images'];

			
			$pic = $this->Global_Model->uploadmultiimage('../uploads/modules/pic/', 700, 850, $img, $dimages);
			if(is_array($pic)){
		  		$images 	= 	implode(",",$pic);
		  	}else{$images="";}
			
			$input_data= array(	
			"cid" => (int) $this->input->post('cid'),
			"is_home" => (int) $this->input->post('ihome'),
			"images" => $images,
			"date" => time()	
			);
		
		
		$input_data_extend= array(	
			"title" => $this->input->post('title'),
			"hometext" => $this->input->post('hometext'),
			"bodytext" => $this->input->post('bodytext')
		);
		
		if($this->Product_model->updateShop($input_data,$pid) && $this->Product_model->updateShopLanguage($input_data_extend,$pid))
		{
			redirect(base_url()."index.php/product");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/product");
		}
  }
  
  public function dap()
  {
	  $ap = $this->input->post('dall');
	 
	  foreach($ap as $v)
	  {
		 	$data = $this->Product_model->getShop($v);
		
			$image = $data[0]['images'];
			
			if($image && file_exists('../uploads/modules/pic/'.$image))
			{
				@unlink('../uploads/modules/pic/'.$image);
			}
	  }
	  	if($this->Product_model->deleteShopMulti($ap))
	  		redirect(base_url()."index.php/product");
		else
			redirect(base_url()."index.php/product");
  }
  
  /*-----------------------------------
  *CATEGORIES
  *-----------------------------------*/
  public function categories()
  {
	  	if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Shop' => '#');
			
			$max = sizeof($this->Product_model->ShopCategories());
			$min = 12;
			$data['num_rows'] = $max;
			//--- Paging
			if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/product/categories";
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
				$data['categories'] = $this->Product_model->ShopCategories(); 
				$this->my_layout->view("shopcategories_view",$data); 
			}
		}
		else
		{
			redirect(base_url()."index.php/dashboard");
		}
  }
  
  public function categories_update()
  {
	 
		$cid = $this->input->post("id");
		$mva = $this->input->post("mva");
		$title = $this->input->post("title");
		$pid = $this->input->post("pid");
		$metaTitle = $this->input->post("metaTitle");
		$metaKeywords = $this->input->post("metaKeywords");
		$metaDescription  = $this->input->post("metaDescription");
		$input_data= array(
			"mva" => $mva,
			"pid" => $pid,
			"title" => $title,
			"metaTitle" => $metaTitle,
			"metaKeywords" => $metaKeywords,
			"metaDescription" => $metaDescription
		);
		if($this->Product_model->updateCategories($input_data,$cid))
		{
			redirect(base_url()."admin.php/product/categories");
		}
  }
  
  
  public function categories_cpic_update()
  {
		$cid = $this->input->post("id");
		$mva = $this->input->post("mva");
		$c = $this->Product_model->getCategories($cid);
		$img = $c[0]['cpic'];
		if($_FILES['userfile']['name']!=null){
	 		$cpic = $this->Global_Model->uploadimage(FCPATH.'uploads/gallery/', 200, 100, $img, "yes");
	 	}
		$input_data= array(
			"cpic" => $cpic != null ? $cpic : $img
		);
		if($this->Product_model->updateCategories($input_data,$cid))
		{
			redirect(base_url()."admin.php/product/categories");
		}
  }
  
  public function categories_icon_update()
  {
		$cid = $this->input->post("id");
		$mva = $this->input->post("mva");
		$c = $this->Product_model->getCategories($cid);
		$img = $c[0]['icon'];
		if($_FILES['userfile']['name']!=null){
	 		$icon = $this->Global_Model->uploadimage(FCPATH.'uploads/gallery/', 200, 100, $img, "yes");
	 	}
		$input_data= array(
			"icon" => $cpic != null ? $icon : $img
		);
		if($this->Product_model->updateCategories($input_data,$cid))
		{
			redirect(base_url()."admin.php/product/categories");
		}
  }
  
  public function categories_delete()
  {
	  	$mva = $this->uri->segment(3,0);
	
		$data = $this->Product_model->getmvaCategories($mva);
		
		$cid = $data[0]['cid'];
		$parentid = $data[0]['pid'];
		$image = $data[0]['cpic'];
	
		if($image!="" && file_exists('../uploads/modules/shop/'.$image))
		{
			@unlink('../uploads/modules/shop/'.$image);
		}
	
		if($this->Product_model->deleteCategories($cid, $parentid))
		{
			redirect(base_url()."admin.php/product/categories");
		}
		else
		{
			//Lỗi
			redirect(base_url()."admin.php/product/categories");
		}
  }
  
  public function categories_add()
  {
		
		if($this->my_auth->is_Admin() || $this->my_auth->is_GodAdmin())
		{
			//set page
			$Au = $this->Auth_model->getInfo($this->session->userdata['admin']['aid']);
			$data['l'] = $Au;
			$data['p'] = array ( 'Home' => base_url(), 'Shop' => '#');
			
			$data['cid'] = $this->Product_model->ShopModuleParent();
			$data['acatgories']=$this->load->view('grouppcp_view',$data,true);//group product categories
			
			$this->my_layout->view("shopcategories_add_view",$data); //add product
		}
		else
		{
			redirect(base_url()."admin.php/dashboard");
		}
  }
  
  public function categories_save()
  {
	  
	  $title 	=	$this->input->post('title');
	  $parentid = 	$this->input->post("parentid");

	  //$langid	=	$this->input->post("language");
	  $langid 	= 	$this->Global_Model->linguaid();
	  $images	=	"";
	  $images 	= 	$this->Global_Model->uploadimage('../uploads/modules/shop/',700,850,$images);
	 
		$input_data= array(	
			"parentid" 	=> $parentid,
			"cat_pic" 	=> $images,
			"active" 	=> 0,
			"mid" 		=> 1,
		);
		$next = $this->Product_model->addCategories($input_data);

		$input_data_extend= array(	
			"cid" 			=> 	$next,
			"title"			=>	$title,
			"lang_id" 		=> 	$langid
		);
		if($this->Product_model->addCategoriesLanguage($input_data_extend))
		{
			redirect(base_url()."index.php/product/categories");
		}
		else
		{
			//Lỗi
			redirect(base_url()."index.php/product/categories");
		}
  }		
}

?>