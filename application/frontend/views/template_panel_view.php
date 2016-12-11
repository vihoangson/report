<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo'
<input type="checkbox" name="cp-settings-toggle" id="cp-settings-toggle">
<label class="ion-android-cart" for="cp-settings-toggle">
<ul class="" ><!-- nav nav-tabs tabs-left -->
    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-cart-plus"></i><p>Giỏ hàng</p></a></li>
    <li><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i><p>Tài khoản</p></a></li>
    <li><a href="#messages" data-toggle="tab"><i class="fa fa-heart"></i><p>Yêu thích</p></a></li>
    <li><a href="#settings" data-toggle="tab"><i class="fa fa-eye"></i><p>Đã xem</p></a></li>
</ul>
</label>


  <div class="cp-settings-pannel">
      <div class="cp-settings tab-content">
      <div class="tab-pane active" id="home">';
	  $json = $this->my_user->is_User() ? $this->session->userdata('client') : $this->session->userdata('guest');
	  if(isset($json['cart']) && sizeof($json['cart'])){
		$cart = json_decode($json['cart'],true);
		$sum=0;
	  	foreach($cart as $k=>$v){
					
					$pic= $v['image'];
					$name = $v['name'];
					$quantity = $v['quantity'];
					$price = $v['price'];
					
					$total = $price * $quantity;
					$sum = $sum + $total;
					
					$filename	= base_url()."uploads/modules/pic/".$pic;
					$file_headers = @get_headers($filename);
					if($file_headers[0] == 'HTTP/1.1 404 Not Found') 
					{
						$img = base_url()."uploads/modules/pic/default.jpg";
					}else {
						$img = $filename;
					}
			echo'<div class="itemCarts">
           	<a href="index.php/shop/detail/'.$k.rewrite($name).'"><img src="'.$img.'" alt="'.$name.'"></a>
			<p><a title="'.$name.'" href="index.php/shop/detail/'.$k.rewrite($name).'">'.$name.'</a></p>
           	<p><b>SL: '.$quantity.' x </b><b>'.numberformat($price).' VNĐ</b><br><b>'.numberformat($total).' VNĐ</b><i rel-id="'.$k.'"  class="removeCart fa fa-trash-o"></i></p><i class="clearfix"></i>            </div>';
	  	}
		echo'<p style="padding:10px 0">Tổng tiền: <b style="float:right;color:#f04e23">'.numberformat($sum).' VNĐ</b></p>';
		echo'<p style="text-align: center;padding: 10px 0;"><a style="display: inline-block;line-height: 35px;width: 240px;font-size: 13px;font-weight: bold" href="'.base_url().'index.php/cart/checkout" class="btnRed btnColor">Đặt hàng</a></p>';
	  }
	  echo'</div>
      <div class="tab-pane" id="profile">';
    
	  if($this->my_user->is_User())
	  {
	  $u = $this->USER_Model->getInfo($this->session->userdata['client']['uid']);
	  echo $u['user_email'];
	  echo '<div class="itemCarts"></div>';
	  echo '<a href="'.base_url().'index.php/User/info">Thông tin cá nhân</a><br>';
	  echo '<a href="'.base_url().'index.php/shop/orderCart">Quản lí đơn hàng</a>';
	  echo '<div class="itemCarts"></div>';
	  echo '<div align="center"><a href="'.base_url().'index.php/User/logout">Thoát</a></div>';
	  }
	
      echo'</div>
      <div class="tab-pane" id="messages">';
	  if($this->my_user->is_User())
	  {
		  $u = $this->session->userdata('client');
		  $uid = $u['uid'];
		  $w = $this->WISHLIST_Model->findAll($uid);
		  foreach($w as $k=>$v){
			
			$p = $this->SHOP_Model->Shop($v['pid']);
			$pic= $p[0]['pic'];
			$name = $p[0]['title'];
			$saledate = $p[0]['saledate'];
			if((time()-(60*60*24)) < strtotime($saledate)){ 
				$price = $p[0]['saleprice'];
			}else{
				$price = $p[0]['price'];
			}
				
					
					$filename	= base_url()."uploads/modules/pic/".$pic;
					$file_headers = @get_headers($filename);
					if($file_headers[0] == 'HTTP/1.1 404 Not Found') 
					{
						$img = base_url()."uploads/modules/pic/default.jpg";
					}else {
						$img = $filename;
					}
				echo'<div class="itemCarts">
				<a href="index.php/shop/detail/'.$k.rewrite($name).'"><img src="'.$img.'" alt="'.$name.'"></a>
				<p><a title="'.$name.'" href="index.php/shop/detail/'.$k.rewrite($name).'">'.$name.'</a></p>
				<p><b>'.numberformat($price).' VNĐ</b></p><i class="clearfix"></i>            </div>';
					
		  }
	  }
	  echo'</div>
      <div class="tab-pane" id="settings">Settings Tab.</div>
		</div>
  </div>';
?>	
