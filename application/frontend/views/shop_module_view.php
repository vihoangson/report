<?php



echo'
	<div class="default_width">
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
			
			<!--menu child-->
			<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="category-list clearfix">
				<ul>';
				foreach($c as $key=>$value){
				echo'<li><a href="'.base_url().'index.php/shop/category/'.$value['mva'].'">'.mb_strtoupper($value['title']).'</a></li>';
				}
				echo'</ul>
				</div>
			</div>
			</div>
			
			
			
			<!--CART-->
			<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-gt-block">';
				for($i=0; $i<sizeof($o); $i++)
				{
					$id 	= $o[$i]['id'];
					$mva 	= $o[$i]['mva'];
					$pid	= $o[$i]['pid'];
					$price	= $o[$i]['price'];
					$pic	= $o[$i]['pic'];
					$saleprice	= $o[$i]['saleprice'];
					$saledate	= $o[$i]['saledate'];
					$title		= $o[$i]['title'];
					$rewtitle   = rewrite($title);
					$filename	= base_url()."uploads/modules/pic/".$pic;
					$file_headers = @get_headers($filename);
					if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
						$img = base_url()."uploads/modules/pic/default.jpg";
					}else {
						$img = $filename;
					}
                echo'
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
					<div class="ui-block">
                    	<div class="ui-img-block"><img src="'.$img.'"></div>
                        <div class="ui-hyperlink">
                        <a href="'.base_url().'index.php/shop/detail/'.$id.$rewtitle.'">'.$title.'</a>
                        </div>';
						if((time()-(60*60*24)) < strtotime($saledate)){
						$iprice=$saleprice;
						echo'<div class="ui-price">'.numberformat($saleprice).' VNĐ</div>';
						echo'<div class="ui-price-sale">'.numberformat($price).' VNĐ</div>';
						echo'<div class="ui-icon-sale"><img src="'.base_url().'template/img/sale.png"></div>';
						}else{
						$iprice=$price;
						echo'<div class="ui-price">'.numberformat($price).' VNĐ</div>';
						}
                        echo'<div class="ui-quick">
                            <div class="quickview">
                            <a href="#" class="fa fa-eye"><span>Quick view</span></a>
                            </div>
                            <div class="wishlist">
                            <a data-id="'.$id.'" data-name="'.$title.'" data-summary="1" data-price="'.$iprice.'" data-quantity="1" data-image="'.$pic.'" class="fa fa-heart my-wishlist-btn"><span>Wish List</span></a>
                            </div>
                            <div class="shoping">
                            <a data-id="'.$id.'" data-name="'.$title.'" data-summary="1" data-price="'.$iprice.'" data-quantity="1" data-image="'.$pic.'" class="fa fa-shopping-cart my-cart-btn"><span>Add cart</span></a>
                            </div>
                        </div>
                    </div>
				</div><!--end col-lg-3-->';
				}
                echo'
                </div><!--end col-lg-12-->
			
			</div><!--end row-->
			<div class="row" align="center"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><ul class="pagination">'.$link.'</ul></div></div>

		</div><!--end div container-->
	</div>
	</form>';
?>
	
