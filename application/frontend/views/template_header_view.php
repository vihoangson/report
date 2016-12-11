<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($this->session->all_userdata());
$u = $this->my_user->is_User()?$this->session->userdata('client'):$this->session->userdata('guest');

$cart=0;
if(isset($u['session_id'])){	
	$cart = $this->SHOP_Model->totalQuantity($u['session_id'])!=0?$this->SHOP_Model->totalQuantity($u['session_id']):0;
}

echo'	
    <header class="floor-fixed">
	<div class="gt_top2_wrap default_width">
    	<div class="container">
        	<div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-6">
                	<ul class="hotline">
                    <li><a href="#">Hotline: 1900636464(1.000đ/phút)</a></li>
                    </ul>
                </div>
				<div class="col-lg-8 col-md-7 col-sm-6 col-xs-6">
                	<ul class="ui-element">
                        <li><a href="'.base_url().'index.php/shop/cart"><span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge">'.$cart.'</span></span></a></li>
                        <li>';
						if($this->my_user->is_User()){
						$uid = $this->session->userdata['client']['uid'];
						$uname = $this->session->userdata['client']['name'];
						echo'Xin chào '.$uname.'&nbsp;|&nbsp;<a href="'.base_url().'index.php/User/logout">Thoát</a>';
						}else{
						echo'<a href="'.base_url().'index.php/User/index">Đăng nhập</a>';
						}
						echo'</li>
                        <li class="checkOrder"><a href="#">Kiểm tra bảo hành</a></li>
					</ul>
                </div>
        	</div>
		</div>
    </div>
    </header>';