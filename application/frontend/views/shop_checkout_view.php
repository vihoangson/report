<?php
$uid= isset($u['user_id'])?$u['user_id']:"";
$email = isset($u['user_email'])?$u['user_email']:"";
$uname = isset($u['viewuname'])?$u['viewuname']:"";
$phone = isset($u['user_icq'])?$u['user_icq']:"";
$address = isset($u['user_from'])?$u['user_from']:"";

//print_r($pCity);
echo'<form method="post" class="f" action="'.base_url().'index.php/shop/payment">
	<div class="default_width">
    	<div class="container">
			<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1>Thanh toán đơn hàng</h1>
			<div id="payment-address">
			<div class="checkout-heading"><span>Thông tin khách hàng</span></div>
			<div class="checkout-content" style="display: block;">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                	<div id="c"><input type="text" name="customerName" class="validate[required]" value="'.$uname.'" placeholder="Họ và tên"></div>
                    <div id="c"><input type="text" name="customerMobile" class="validate[required]" value="'.$phone.'" placeholder="Điện thoại"></div>
                    <div id="c"><input type="text" name="customerEmail" class="validate[required]" value="'.$email.'" placeholder="Email"></div>
                 </div>
				 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                	<div id="c">
					<select id="cityId" name="customerCityId" class="validate[required]">
                    <option value="">Thành phố</option>';
					foreach($pCity as $index =>$value){
					echo'<option value="'.$value['mva'].'">'.$value['title'].'</option>';
					}
					echo'</select>
					</div>
					<div id="c">
					<select id="districtId" name="customerDistrictId" class="validate[required]">
                    <option value="">Quận Huyện</option>
					</select>
					</div>
					<div id="c"><input type="text" name="customerAddress" class="validate[required]" value="'.$address.'" placeholder="Địa chỉ"></div>
				 </div>
			</div>
			</div>
			</div></div><!--end row-->
			
			<!--Hình thức thanh toán-->
			<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div id="payment-address">
			<div class="checkout-heading"><span>Hình thức thanh toán</span></div>
			<div class="checkout-content" style="display: block;">
            	<div id="paymentMethod col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="b">
               	<label><input type="radio" id="rdPaymentMethodCod" name="paymentMethod" class="validate[required]" value="1">Thanh toán tại nhà</label></div>
                                        
                <div class="b"><label><input type="radio" name="paymentMethod" class="validate[required]" value="2"> Thanh toán bằng thẻ ngân hàng nội địa <i></i></label>
				<div class="listBank"></div>
				</div>
				
				<div class="b"><label><input type="radio" name="paymentMethod" class="validate[required]" value="3"> Thanh toán bằng thẻ quốc tế Visa/Master card <i></i></label>
				<div class="listBank"></div>
				</div>                                    
				</div>
			</div>
			</div>
			</div></div><!--end row-->
			
			
			<!--CART-->
			<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="checkout-heading"><span>Thông tin đơn hàng</span></div>
			<div class="cart-info">
            <table class="pav-shop-cart tbcheckout">
            	<thead class="hidden-phone thcheckout">
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
                    echo'<input type="hidden" name="prdId" class="prdId" value="'.$k.'">
                    <input type="hidden" name="prdName" class="prdName" value="'.$name.'">
                    <input type="hidden" name="prdPrice" class="prdPrice" value="'.$price.'">
                    <input type="hidden" name="prdCategory"  class="prdCategory" value="">
           
                    <tr>
                    	<td class="image" data-label="Ảnh" id="img-cart"><a class="" href="#"><img src="'.$img.'" alt="'.$name.'"></a></td>
                        <td class="name" data-label="Tên sản phẩm">
                       	<a class="" href="'.base_url().'index.php/shop/detail/'.$k.rewrite($name).'">'.$name.'</a>
                        </td>
                        <td class="quantity" data-label="Số lượng">'.$quantity.'</td>
                        <td class="price" data-label="Giá">'.numberformat($price).' vnđ</td>
                        <td class="total" data-label="Thành tiền"> '.numberformat($total).' vnđ  </td>
                     </tr>';
				}}
                     echo'<tr>
                        <td class="tdnone"><!--<textarea style="display: none;" id="productShipfee">{"3379548":"4"}</textarea><input type="hidden" id="totalCartMoney" value="1200000">--></td>
                        <td class="tRight tdnone" colspan="3" >Tổng đơn hàng</td>
                        <td data-label="" class="tRight tdnone"><b>'.numberformat($sum).' vnđ</b></td>
                     </tr>
                     <tr>
                        <td class="tRight tdnone" colspan="4" >Phí vận chuyển</td>
                        <td data-label="" class="tRight tdnone"><b id="shipFee">0 vnđ</b></td>
                     </tr>
                     <tr>
                        <td class="tRight tdnone" colspan="4">Tổng tiền</td>
                        <td data-label="" class="tRight tdnone"><b id="showTotalMoney">'.numberformat($sum).' vnđ</b></td><input type="hidden" name="totalMn" value="'.$sum.'">
                     </tr>
                     <tr>
                        <td class="tdnone"></td>
                        <td colspan="4" class="tRight tdnone">
                        <!--<p id="txtCode">Mã giảm giá</p>
                        <input id="coupon" type="text" name="couponCode" style="height: 30px; width: 150px;">
                        <button type="button" id="getCoupon" class="button btn btnColor" style="border-radius: 4px;text-transform: uppercase; vertical-align: top; height: 30px">Sử dụng</button>
                        <br>-->
                        <!--<input type="hidden" id="baokimPmMethodId" name="baokimBankPaymentMethodId">-->
                        <button type="submit" class="btn button btnCheckout" style="border-radius:4px;text-transform: uppercase;margin-top: 10px; ">Xác nhận &amp; Đặt hàng</button>
						</td>
					</tr>
				</tbody>                                        
			</table>
			</div></div><!--end row-->
		</div><!--end div container-->
	</div>
	</form>';
?>
	
