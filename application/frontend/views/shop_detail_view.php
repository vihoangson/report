<?php
if(sizeof($product))
{
	$id	= $product[0]['id'];
	$pid	= $product[0]['pid'];
	$mva	= $product[0]['mva'];
	$price	= $product[0]['price'];
	$pic	= $product[0]['pic'];
	$spic 	= json_decode($product[0]['spic'],true);
	$saleprice	= $product[0]['saleprice'];
	$saledate	= $product[0]['saledate'];
	$importprice= $product[0]['importprice'];
	$wsprice	= $product[0]['wsprice'];
	$counter	= $product[0]['counter'];
	$tonkho		= $product[0]['tonkho'];
	$color		= json_decode($product[0]['color'], true);
	$title		= $product[0]['title'];
	$keywords	= $product[0]['keywords'];
	$description1	= $product[0]['description1'];
	$description2	= $product[0]['description2'];
	$description3	= $product[0]['description3'];
	$key1		= $product[0]['key1'];
	$key2		= $product[0]['key2'];
	$key3		= $product[0]['key3'];
	
	array_push ( $spic , $pic );
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
            	<header class="prod-detail-title col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<h1>Apple Watch Sport 38mm Series 2 - Silver</h1>
            	</header>
            </div><br>
            <div class="row">
            	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-9 col-xs-9">
					
					<div id="sync1" class="owl-carousel">';
					foreach($spic as $k=>$v){
						$filename	= base_url()."uploads/modules/pic/".$pic;
						$file_headers = @get_headers($filename);
						if($file_headers[0] == 'HTTP/1.1 404 Not Found') 
						{
							$img = base_url()."uploads/modules/pic/default.jpg";
						}else {
							$img = $filename;
						}
						echo'<div class="item"><img src="'.$img.'" alt="" /></div>';
					}
					echo'</div>
					<div id="sync2" class="owl-carousel">';
					foreach($spic as $k=>$v){
						$filename	= base_url()."uploads/modules/pic/".$pic;
						$file_headers = @get_headers($filename);
						if($file_headers[0] == 'HTTP/1.1 404 Not Found') 
						{
							$img = base_url()."uploads/modules/pic/default.jpg";
						}else {
							$img = $filename;
						}
						echo'<div class="item"><img src="'.$img.'" alt="" /></div>';
					}
					echo'</div>
					<!--end sync-->
				
					</div><!--end col-9-->
					<div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">
						<section class="prod-code prod-bt">
                                Mã sản phẩm: <label> '.$mva.'</label>
                        </section>
						<section class="prod-price prod-bt">';
						if((time()-(60*60*24)) < strtotime($saledate)){
						$iprice = $saleprice;
                       	echo'<p class="price">'.numberformat($saleprice).' VNĐ</p>';
						echo'<p class="ui-price-sale">'.numberformat($price).' VNĐ</p>';
						}else{
						$iprice = $price;
						echo'<p class="price">'.numberformat($price).' VNĐ</p>';
						}
                        echo'</section>
						<!--<section id="pro-colr" class="prod-color"> <span class="order-step">1</span><span> <strong>Chọn màu</strong></span><div class="attr"><span>Bạn vui lòng chọn màu sắc <i class="close">X</i>
						<ul class="color" id="ui_product_style">-->';
						
						/*foreach($color as $key=>$value){
							echo '<li><a href="#"><img src="http://cdn.giordano.co.kr//Product/0111571668.jpg" alt="Indigo Blue 68" title="Indigo Blue 68" width="19" height="19"></a></li>';
						}*/
						echo'<!--</ul></span></div>  
						</section>-->
						<section id="quality-box" class="fea-row">
                                <!--<span class="order-step">2</span>--><span> <strong>Số lượng</strong></span>
                                <select id="qtt" class="inp quali-val">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
						</section>
						<section>
                            <span class="cart">
                            <a id="addToCart" class="btnCart btn btn-danger my-cart-btn" data-id="'.$id.'" data-name="'.$title.'" data-summary="1" data-price="'.$iprice.'" data-quantity="" data-image="'.$pic.'"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Mua ngay </a>
                            </span>
                        </section>
						<section class="highlight">
							<div id="highlight">'.$keywords.'</div>
						</section>
						<section class="share-box">
                                <p>Chia sẻ</p>
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_default_style">
                                    
                                </div>
                                <!-- AddThis Button END -->
                            </section>
					</div><!--end col-3-->
					
					
					</div><!--end div row-->
					<div class="row">
						<div id="exTab2" class="container">	
						<ul class="nav nav-tabs">
							<li class="active">
							<a href="#1" data-toggle="tab">'.mb_strtoupper($key1).'</a>
							</li>
							<li>
							<a href="#2" data-toggle="tab">'.mb_strtoupper($key2).'</a>
							</li>
							<li>
							<a href="#3" data-toggle="tab">'.mb_strtoupper($key3).'</a>
							</li>
						</ul>
						<div class="tab-content ">
							<div class="tab-pane active" id="1">
							Đặc điểm nổi bật'.$description1.'
							</div>
							<div class="tab-pane" id="2">
							Thông số'.$description2.'
							</div>
							<div class="tab-pane" id="3">
							Video'.$description3.'
							</div>
						</div>
						</div><!--end ExTb-->
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<!--code block here-->
				</div>
            </div><!--row-->
        </div>
	</div>
    <!--end sign in-->';
	
}
?>
