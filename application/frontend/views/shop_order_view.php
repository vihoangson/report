<?php


//print_r($pCity);
echo'
	<div class="default_width">
    	<div class="container">
			<!--CART-->
			<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<h1>Danh sách đơn hàng</h1>
			
			<div class="content">
            <div class="wishlist-info">
			<table>
            <thead>
            	<tr class="tt">
                <td class="headCode">Mã đơn hàng</td>
                <td class="headInfo">Thông tin đơn hàng</td>
                <td class="headStatus">Trang thái đơn hàng</td>
                <td class="headAction">Hành động</td>
                </tr>
            </thead>
            <tbody id="wishlist-row40">';
            if(sizeof($o)){
				foreach($o as $key=>$value){
					$id = $value['id'];
					$mva = $value['mva'];
					$status = $value['status'];
					$method  = $value['order_method'];
					$date = $value['order_date'];
					$address = $value['order_address'];
					
					echo'<tr class="order-item">
                <td class="code" style="text-align: center">'.$mva.'</td>
                <td class="info">
                    <p>- Ngày đặt mua: '.$date.'</p>
					<p>- Hình thức thanh toán: '.$method.'</p>
					<p>- Thông tin nhận hàng: '.$address.'</p>
				</td>
                <td class="status" style="text-align: center">
                    <span class="statusContent"></span>
					<p>'.$status.'</p>
                </td>
                <td class="action" style="text-align: center">
					<a href="'.base_url().'index.php/shop/orderDetail/'.$id.'"><i class="fa fa-eye"></i></a>
               		<a class="delOrderBtn" data-id="'.$id.'"><i class="fa fa-trash-o"></i></a>
                    <a href="#" class="checkoutBtn"></a>
                </td>
                </tr>';
				}
			}
            echo'</tbody>
            </table>
            </div>
            </div>
			
			</div></div><!--end row-->
			<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><ul class="pagination">'.$link.'</ul></div></div>

		</div><!--end div container-->
	</div>
	</form>';
?>
	
