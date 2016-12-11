<?php

	echo'<div class="default_width">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="breadcrumb">
				<ol class="breadcrumb">
					<li><a href="#">Trang chủ</a></li>
					<li><a href="#">Đồng hồ thông minh</a></li>
					<li><a href="#">Apple watch 30mm</a></li>
				</ol>
				</div>
                </div>
            </div>
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<h1>Giỏ hàng</h1>
				<div class="cart-info">
				<table class="pav-shop-cart">
				<thead class="hidden-phone">
					<tr>
					<td class="image">Ảnh</td>
					<td class="name">Tên sản phẩm</td>
					<td class="quantity">Số lượng</td>
					<td class="price">Đơn giá</td>
					<td class="total">Thành tiền</td>
					</tr>
				</thead>
				<tbody>';
				$sum = 0;
				if(sizeof($od)!=0){
				
				foreach($od as $k=>$v){
					$pid = $v['pid'];
					$info = $this->SHOP_Model->Shop($pid);
					
					$pic= $info[0]['pic'];
					$name = $info[0]['title'];
					$quantity = $v['count'];
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
				
				echo'<tr class="parentPrdCart">
			
					<td class="image" data-label="Image" id="img-cart">
					<a class="" href="'.base_url().'index.php/shop/detail/'.$k.rewrite($name).'">
					<img src="'.$img.'" alt="'.$name.'">
					</a>
					</td>
					
					<td class="name" data-label="Product Name">
					<a class="prdName" href="'.base_url().'index.php/shop/detail/'.$k.rewrite($name).'">'.$name.'</a><div></div>
					</td>
					
					<td class="quantity" data-label="Quantity">
					'.$quantity.'
					</td>
					
					<td class="price" data-label="Unit Price">
					<p class="price" style="color: #cb0101;">'.numberformat($price).' VNĐ</p></td>
					<td class="total" data-label="Total">'.numberformat($total).' VNĐ</td>
				</tr>';
				}
				}
				echo'</tbody>
				</table>
				</div><!--end div cart-->
            </div><br>
           
        </div>
	</div>
    <!--end sign in-->';
	
?>