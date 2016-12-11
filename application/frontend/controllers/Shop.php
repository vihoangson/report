<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form','file','global','cookie'));
		$this->load->library(array("form_validation","session"));
				
		$this->load->database();
		
		$this->load->model(array("GLOBAL_Model", "SHOP_Model", "MODULE_Model", "CONTACT_Model", "USER_Model", "CITY_Model", "CONFIG_Model","WISHLIST_Model"));
		$this->load->library(array("MY_layout","MY_user")); 
    	$this->my_layout->setLayout("template_view"); 
		
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
	}
	
	public function detail()
	{
		//print_r($this->uri->segment_array());
		//end lang
		$pid = (int)$this->uri->segment(3);
		
		$data['product'] = $this->SHOP_Model->Shop($pid);
		$this->my_layout->view("shop_detail_view",$data);
	}
	
	public function add()
	{
		$id			= $this->input->post("id");
        $name		= $this->input->post("name");
		$quantity	= (int)$this->input->post("quantity");
		$price		= (float)$this->input->post("price");
		$image		= $this->input->post("image");
		$summary	= $this->input->post("summary");
		
		//not user, not guest
		if(!$this->my_user->is_User() && !$this->session->userdata('guest')){
			$session = array(
				'guest' => array(
					'expire' => time()+86500,
					'flag' => FALSE,
					'session_id' => session_id()
                )
			);
            $this->session->set_userdata($session);
			$u = $this->session->userdata("guest");
			$mva = $u['session_id'];
		}
		
		$cart = $this->my_user->is_User()?$this->session->userdata('client'):$this->session->userdata('guest');
		
		if(isset($cart['cart'])){
			//echo "update cart";
			$cart['cart']= $this->addPro($cart['cart'],$id,$name,$quantity,$price,$image,$summary);
		}else{
			//echo "insert cart";
			$cart['cart']= $this->setPro($id,$name,$quantity,$price,$image,$summary);
		}
		//update session
		$this->my_user->is_User() ? $this->session->set_userdata('client', $cart) : $this->session->set_userdata('guest', $cart);
		
		$flag = true;
		$flag = $this->updateDborder();
		echo $flag;
	}
	function updateDborder(){
		$flag = true;
		$json = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
		$mva = $json['session_id'];
		$result = $this->SHOP_Model->getInfoShoporder($mva);
		if(sizeof($result)!=0){
			//echo "Update";
			$data_cart = json_decode($json['cart'],true); 
			foreach($data_cart as $k=>$v){
				$dresult = $this->SHOP_Model->getInfoShoporderdetail($mva, $k);
				if(sizeof($dresult)!=0){
					$data_detail = array(
						"count"=> $data_cart[$k]['quantity']
					);
					if(!$this->SHOP_Model->updateShoporderdetail($k, $mva, $data_detail)){$flag = false;};
				}else{
					$data_detail = array(
					"mva" => $mva,
					"pid" => $k,
					"count"=> $data_cart[$k]['quantity'],
					"price"=> $data_cart[$k]['price']
					);
					if(!$this->SHOP_Model->InsertShoporderdetail($data_detail)){$flag = false;};
				}
			}
			
		}else{
			//echo "Insert";
			$data = array(
			"mva" 			=> $mva,
			"order_uname"	=> isset($json['uid'])==NULL?NULL:$json['uid'],
			"order_date" 	=> date('Y-m-d H:i:s'),
			"status"		=> 'Mới');
			$this->SHOP_Model->InsertShoporder($data);

			$data_cart = json_decode($json['cart'],true); 
			foreach($data_cart as $k=>$v){
				$data_detail = array(
					"mva" => $mva,
					"pid" => $k,
					"count"=> $data_cart[$k]['quantity'],
					"price"=> $data_cart[$k]['price']
				);
				if(!$this->SHOP_Model->InsertShoporderdetail($data_detail)){$flag = false; exit();}
			}
			
		}
		return $flag;
	}
	public function totalPro(){
		
		$cart = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
		
		$json = json_decode($cart['cart'], true);
		
		$total = 0;
		foreach($json as $k=>$val){
			$total = $total + $json[$k]['quantity'];
		}
		
		
		return $total;
	}
	
	public function setPro($id=0,$name="",$quantity	= 1,$price= 0,$image		= "",$summary	= 1)
	{
		$data_pro = json_encode(array($id=>array(
        	'name'		=> $name,
			'quantity'	=> $quantity,
			'price'		=> $price,
			'image'		=> $image,
			'summary'	=> $summary
		)), JSON_NUMERIC_CHECK);
		return $data_pro;
	}
	
	public function addPro($json,$id,$name,$quantity,$price,$image,$summary)
	{
		$json = json_decode($json, true);
		//print_r($json);
		$flag = false;
		foreach($json as $key => $value){
			if($key==$id){
				$total  = $value['quantity'];
				$new  	= gettype($quantity)==null ? 1: $quantity;
				
				$json[$key]['quantity']  = $total + $new;
				$flag=true;
			}
		}
		
		if($flag==false){
			$json[$id]= array(
				'name'		=> $name,
				'quantity'	=> $quantity,
				'price'		=> $price,
				'image'		=> $image,
				'summary'	=> $summary
			);
		}
		$json = json_encode($json,  JSON_NUMERIC_CHECK);
		return $json;
	}
	
	public function updatePro($json,$id,$quantity)
	{
		$json = json_decode($json, true);
		foreach($json as $key => $value){
			if($key==$id){
				$new  	= gettype($quantity)==null ? 1: $quantity;
				
				$json[$key]['quantity']  = $new;
				$flag=true;
			}
		}
		
		$json = json_encode($json,  JSON_NUMERIC_CHECK);
		return $json;
	}
	
	public function removePro($json,$id)
	{
		$json = json_decode($json, true);
		foreach($json as $key => $value){
			if($key==$id){
				unset($json[$key]);
			}
		}
		
		$json = json_encode($json,  JSON_NUMERIC_CHECK);
		
		return $json;
	}
	
	function cart(){
		
		$cart = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
		$data['cart'] = json_decode($cart['cart'],true);
		
		$this->my_layout->view("shop_cart_view", $data);
	}
	
	function updatecart(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$quantity = $this->input->post('quantity');
		
		//print_r($this->input->post());
		
		$json = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
		
		$mva = $json['session_id'];
		$cart['cart']= $this->updatePro($json['cart'],$id,$quantity);
		
		$json['cart'] = $cart['cart'];
		
		//update session
		$this->my_user->is_User() ? $this->session->set_userdata('client', $json) : $this->session->set_userdata('guest', $json);
		
		$flag = true;
		$flag = $this->updateDborder();
		echo $flag;
	}
	
	function removecart(){
		$id = $this->input->post('id');
		$json = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
		
		$mva = $json['session_id'];
		$cart['cart']= $this->removePro($json['cart'],$id);
		$json['cart'] = $cart['cart'];
		
		//update session
		$this->my_user->is_User() ? $this->session->set_userdata('client', $json) : $this->session->set_userdata('guest', $json);

		echo $this->SHOP_Model->delShoporderdetail($mva, $id);
	}
	
	function checkout(){
		
		$cart = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
		$data['u'] = $this->my_user->is_User() ? $this->USER_Model->getInfo($cart['uid']): null;
		$data['cart'] = json_decode($cart['cart'],true);
		$data['pCity'] = $this->CITY_Model->pCity();
		
		$this->my_layout->view("shop_checkout_view", $data);
	}
	
	function payment(){
		$customerName = $this->input->post('customerName');
		$customerMobile = $this->input->post('customerMobile');
		$customerEmail = $this->input->post('customerEmail');
		$customerCityId = $this->input->post('customerCityId');
		$customerDistrictId = $this->input->post('customerDistrictId');
		$customerAddress = $this->input->post('customerAddress');
		$paymentMethod = $this->input->post('paymentMethod');

		$order = array(
			'order_uname'	=> $customerName,
			'order_date'	=> date('Y-m-d H:i:s'),
			'order_address'	=> $customerAddress,
			'order_phone'	=> $customerMobile,
			'order_method'	=> $paymentMethod,
			'order_city'	=> $customerCityId,
			'order_ward'	=> $customerDistrictId
		);
		//update order
		$u = $this->my_user->is_User()?$this->session->userdata('client'):$this->session->userdata('guest');
		$mva = $u['session_id'];
		$cart = json_decode($u['cart'],true);
		//$flag = $this->SHOP_Model->updateShoporder($mva, $order);
		$flag= true;
		
		if($flag ==true){
			//send email
			$option = $this->GLOBAL_Model->getOption();
			$site_name = $option[0]['option_value'];
			$laco = $option[10]['option_value'];
			$mail_server = $option[2]['option_value'];
			$mail_login = $option[3]['option_value'];
			$mail_pass = $option[4]['option_value'];
			$mail_port = $option[5]['option_value'];
			
			$content='<h3>Xác nhận đơn hàng</h3>
			<p>Xin chào quý khách <b>'.$customerName.'</b>,</p>
			<p>Cảm ơn quý khách đã mua sắm tại  . Chúng tôi hi vọng quý khách sẽ yêu thích sản phẩm mình đã mua và hài lòng với dịch vụ từ <b>'.$site_name.'</b>.</p>
			<p>Mã số đơn hàng của quý khách là '.$mva.' với thông tin chi tiết như sau:</p>
			<p>Phương thức thanh toán: '.$this->moneycase($paymentMethod).'<br>
			Người nhận: <b>'.$customerName.'</b><br>
			Địa chỉ nhận hàng: <b>'.$customerAddress.'</b><br>
			Số điện thoại: <b>'.$customerMobile.'</b></p>
			<p>
        	<h3>Thông tin đơn hàng</h3>
            <table style="border-collapse:collapse;" border="1">
            	<thead>
            	<tr>
                    <td><b>Tên sản phẩm</b></td>
                    <td><b>Số lượng</b></td>
                    <td><b>Đơn giá</b></td>
                    <td><b>Thành tiền</b></td>
				</tr>
                </thead>
                <tbody>';
				$sum = $this->input->post('totalMn');;
				if(sizeof($cart)!=0){
				
				foreach($cart as $k=>$v){
					
					$pic= $v['image'];
					$name = $v['name'];
					$quantity = $v['quantity'];
					$price = $v['price'];
					
					$total = $price * $quantity;
				
                   $content.='<tr>
                    	<td>'.$name.'</td>
                        <td>'.$quantity.'</td>
                        <td align="right">'.numberformat($price).' vnđ</td>
                        <td align="right"> '.numberformat($total).' vnđ  </td>
                     </tr>';
				}}
                     $content.='<tr>
                        <td>Tổng đơn hàng</td>
                        <td colspan="3" align="right"><b>'.numberformat($sum).' vnđ</b></td>
                     </tr>
                     <tr>
                        <td>Phí vận chuyển</td>
                        <td colspan="3" align="right"><b id="shipFee">0 vnđ</b></td>
                     </tr>
                     <tr>
                        <td>Tổng tiền</td>
                        <td colspan="3" align="right"><b id="showTotalMoney">'.numberformat($sum).' vnđ</b></td>
                     </tr>
				</tbody>                                        
			</table>
			
			<p>Xin vui lòng ghi nhận lại thông tin chi tiết ở trên về đơn hàng của quý khách. Những thông tin mà quý khách đã cung cấp cũng như chi tiết sản phẩm đã chọn trong đơn hàng này sẽ không thay đổi được.</p>
			<p>Để theo dõi tình trạng đơn hàng của mình, vui lòng đăng nhập vào tài khoản của bạn trên website của <b>'.$site_name.'</b> và vào phần <b>Quản lý đơn hàng</b>.<p>
			<p>Hãy đừng bỏ lỡ những thông tin khuyến mãi hấp dẫn và các phần quà đặc biệt dành cho khách hàng thân thiết tại giobien.vn</p>
			<p>Cảm ơn quý khách đã sử dụng dịch vụ của <b>'.$site_name.'</b>.</p>
			<p><i>Trân trọng.</i></p>
			<h4><i>'.$site_name.'</i></h4>';
			
			$subject = "THƯ XÁC NHẬN ĐƠN HÀNG";
			$fmail = $this->sendmail($content, $mail_server, $mail_login, $mail_pass, $mail_port, $laco, $customerEmail, $customerName, $subject);
			
			if($fmail['success']==1){
				//clear cart, update session id
				session_regenerate_id();
				$new_sessionid = session_id();
				$u['cart'] = null;
				$u['session_id'] = $new_sessionid;
				$this->my_user->is_User() ? $this->session->set_userdata('client', $u) : $this->session->set_userdata('guest', $u);
				redirect(base_url()."index.php/Welcome/index");
			}else{
				show_error($this->email->print_debugger());
			}
			
            exit();
		}else{
			redirect(base_url()."index.php/shop/cart");
            exit();
		}
		
	}
	
	public function sendmail($content, $host, $mail, $pass, $mail_port, $laco, $tomail, $toname, $subject)
	{
		
		$this->load->library('email');   
		if((int)$laco==0){
			
			$config = array();
            $config['useragent']           = "CodeIgniter";
            $config['mailpath']            = "/usr/sbin/sendmail"; // or "/usr/bin/sendmail"
            $config['protocol']            = "sendmail";
            $config['smtp_host']           = "localhost";
            $config['smtp_port']           = "25";
            $config['mailtype'] = 'html';
            $config['charset']  = 'utf-8';
			$config['crlf'] 	= "\r\n";
            $config['newline']  = "\r\n";
            $config['wordwrap'] = TRUE;

			
			$this->email->initialize($config);    
			$this->email->set_newline("\r\n");  
			$mailto = $tomail;
		
		}else{
		
			$config = array(
					'protocol' => 'smtp',
					'smtp_port' => $mail_port,
					'smtp_host' => $host,
					'smtp_user' => $mail,
					'smtp_pass' => $pass,
					'mailtype'  => 'html', 
					'charset' => 'utf-8',
					'wordwrap' => TRUE,
					'validation' => TRUE // bool whether to validate email or not 
			
			);
			$mailto = $tomail;
			$this->email->initialize($config);    
			$this->email->set_newline("\r\n");  
			
		}
		
		$this->email->from($mail, $toname);
		$this->email->to($mailto);
		$this->email->cc($mailto);
		$this->email->bcc($mailto);
		
		$this->email->subject($subject);
		$this->email->message($content);

		if ($this->email->send()) {
        	$data['success'] = 1;
		} else {
			$data['success'] = 0;
			$data['error'] = $this->email->print_debugger(array('headers'));
		}
		return $data;
	}
	
	function orderCart(){
		$cart = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
		
		$ses = $this->my_user->is_User() ? $cart['uid'] : $cart['session_id'];
		$o = $this->SHOP_Model->orderInfo($ses);
		
		
		$max = sizeof($o);
		$min = 12;
		$data['num_rows'] = $max;
		//--- Paging
		if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/shop/orderCart";
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
				$data['o'] = $this->SHOP_Model->orderLimitInfo($ses,$min,$this->uri->segment($config['uri_segment']));
		
				$this->my_layout->view("shop_order_view",$data); 
		}
	}
	
	function orderDetail(){
		
		$id = $this->uri->segment(3);
		$info = $this->SHOP_Model->getorderInfo($id);
		$mva = $info['mva'];
		
		$data['od'] = $this->SHOP_Model->orderdetailInfo($mva);
		$this->my_layout->view("shop_order_detail_view",$data); 
		
	}
	
	function deleteOrder(){
		
		$id = $this->input->post('id');
		$info = $this->SHOP_Model->getorderInfo($id);
		$mva = $info['mva'];
		$status = $info['status'];
		if($status=="Mới"){ 
			$data = array("status"=>"Khách hủy");
			$flag = $this->SHOP_Model->updateShoporder($mva, $data);
		}else{
			$flag = FALSE;
		}
		echo $flag;
	}
	
	
	function module(){
		
		$mva = $this->uri->segment(3);
		$c = $this->SHOP_Model->ShopCategoriesChild($mva);
			
		$arr = array();
		array_push($arr,$mva);
		foreach($c as $k=>$v){
			array_push($arr,$v['mva']);	
		}
		$option7 = $this->CONFIG_Model->find(7);
		
		$data['c'] = $c;
		
		$p = $this->SHOP_Model->ShopArray($arr);

		$max = sizeof($p);
		$min = $option7->option_value;
		$data['num_rows'] = $max;
		//--- Paging
		if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/shop/module/".$mva;
				$config['total_rows'] = $max;
				$config['per_page'] = $min;
				$config['num_link'] = 3; 
				$config['uri_segment'] = 4;
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
				$data['o'] = $this->SHOP_Model->ShopArray($arr,$min,$this->uri->segment($config['uri_segment']));
		
				$this->my_layout->view("shop_module_view",$data); 
		}
	}
	
	function category(){
		
		$mva = $this->uri->segment(3);
		
		$arr = array();
		array_push($arr,$mva);
		
		$option7 = $this->CONFIG_Model->find(7);
		
		
		$p = $this->SHOP_Model->ShopArray($arr);
		
		$max = sizeof($p);
		$min = $option7->option_value;
		$data['num_rows'] = $max;
		//--- Paging
		if($max!=0){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url()."index.php/shop/category/".$mva;
				$config['total_rows'] = $max;
				$config['per_page'] = $min;
				$config['num_link'] = 3; 
				$config['uri_segment'] = 4;
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
				$data['o'] = $this->SHOP_Model->ShopArray($arr,$min,$this->uri->segment($config['uri_segment']));
		
				$this->my_layout->view("shop_category_view",$data); 
		}
	}
	
	public function wishlist()
	{
		$id			= $this->input->post("id");
        $name		= $this->input->post("name");
		$quantity	= (int)$this->input->post("quantity");
		$price		= (float)$this->input->post("price");
		$image		= $this->input->post("image");
		$summary	= $this->input->post("summary");
		if($this->my_user->is_User()){
			
			$u = $this->session->userdata('client');
			$uid = $u['uid'];

			$data = array(
				'uid' => $uid,
				'pid' => $id
			);
			//print_r($data);
			$o = $this->WISHLIST_Model->find($id, $uid);
			if(sizeof($o)){
				echo "Sản phẩm đã tồn tại trong wishlist của bạn";
			}else{
				if($this->WISHLIST_Model->insert($data)==true)
					echo "Đã thêm sản phẩm vào wishlist";
			}
			
		}else{
			echo "Bạn phải đăng nhập tài khoản trước khi thực hiện tác vụ này";
		}
		
	}
	
	function moneycase($num){
		switch($num){
			case 1:
				return "Thanh toán tại nhà";
				break;
			case 2:
				return "Thanh toán bằng thẻ ngân hàng nội địa";
				break;
			case 3:
				return "Thanh toán bằng thẻ quốc tế Visa/Master card";
				break;
		}
	}
	
}
