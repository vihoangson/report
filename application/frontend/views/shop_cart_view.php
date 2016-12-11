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
				//print_r($cart);
				$sum = 0;
				if(sizeof($cart)!=0){
				
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
				
				echo'<tr class="parentPrdCart">
				<!--<input type="hidden" class="prdId" value="'.$k.'">
				<input type="hidden" class="prdName" value="'.$name.'">
				<input type="hidden" class="prdPrice" value="'.$price.'">
				<input type="hidden" class="prdImage" value="'.$pic.'">
				<input type="hidden" class="prdCategory" value="">-->
					
					<td class="image" data-label="Image" id="img-cart">
					<a class="" href="'.base_url().'index.php/shop/detail/'.$k.rewrite($name).'">
					<img src="'.$img.'" alt="'.$name.'">
					</a>
					</td>
					
					<td class="name" data-label="Product Name">
					<a class="prdName" href="'.base_url().'index.php/shop/detail/'.$k.rewrite($name).'">'.$name.'</a><div></div>
					</td>
					
					<td class="quantity" data-label="Quantity">
					<input type="text" name="quantity" value="'.$quantity.'" size="1" class="updateCart" dataName="'.$name.'" dataPrice="'.$price.'" dataImg="'.$pic.'" dataId="'.$k.'">
					<i class="fa fa-trash-o removeCart" rel-category="" rel-quantity="'.$quantity.'" rel-price="'.$price.'" rel-id="'.$k.'" rel-name="'.$name.'" style="cursor: pointer;" dataid="'.$k.'"></i>
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
				
				<div class="row">
					<div class="col-lg-9">
					<div class="buttons clearfix">
						<div class="pull-right right">
							<a href="'.base_url().'index.php/shop/checkout" class="button">Thanh toán</a>
						</div>
						<div class="center pull-left">
							<a href="'.base_url().'" class="button">Tiếp tục mua hàng</a>
						</div>
					</div>
					</div><!--end col 9-->
					<div class="col-lg-3">
						<div class="cart-total clearfix">
						<table id="total" border="0"><tbody>
						<tr>
						<td class="right"><b>Tổng tiền:</b></td>
						<td class="left">'.numberformat($sum).' VNĐ</td>
						</tr>
						</tbody></table>
						</div>
					</div>
				</div>
				<!--end div total-->
                </div>
            </div><br>
           
        </div>
	</div>
    <!--end sign in-->';
	
?>