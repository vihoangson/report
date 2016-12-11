<?php
defined('BASEPATH') OR exit('No direct script access allowed');



echo'<!--advertise-->
    <section class="gt-2ad">
    <div class=" default_width">
    	<div class="container">
        	<div class="row">';
			if(sizeof($top)!=0){
				for($i=0; $i<sizeof($top); $i++)	
				{
					echo'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><img src="'.base_url().'uploads/logo/'.$top[$i]['icon'].'"></div>';
				}
			}
            echo'
            </div>
        </div>
    </div>
    </section>
    <!--end advertise-->';
	

echo' <!--new product-->
    <section class="gt-group">
    <div class="default_width">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-h"><i class="ui-head ui-icon1"></i><span>Sản phẩm mới</span></div>
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
				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
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
				</div><!--end col-lg-12-->';
				}
                echo'
                </div><!--end col-lg-12-->
            </div>
        </div>
    </div>
    </section>
    <!--end new product-->';
	
	
$pcat = array();
for($j=0; $j<sizeof($categories); $j++){
	if($categories[$j]['pid']=="0"){
		$pcat[] = $categories[$j];
	}
}

for($i=0; $i<sizeof($pcat); $i++)
{
	$cid = $pcat[$i]['mva'];
	$ctitle = $pcat[$i]['title'];
	$cicon  = $pcat[$i]['cpic'];
	$filename	= base_url()."uploads/modules/categories/".$cicon;
	$file_headers = @get_headers($filename);
	if($cicon!="" && $file_headers[0] != 'HTTP/1.1 404 Not Found') {
		echo'<!--advertise-->
		<section class="gt-2ad">
		<div class=" default_width">
			<div class="container">
				<div class="row"><img src="'.$filename.'"></div>
			</div>
		</div>
		</section>
		<!--end advertise-->';
	}
	
echo'<!--new product-->
    <section class="gt-group">
    <div class="default_width">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-h"><i class="ui-head ui-icon1"></i><span>'.$ctitle.'</span>
                	<ul class="ui-h-more">';
					$carr[] = $cid;
					for($k=0; $k<sizeof($categories); $k++)
					{
						
						if($categories[$k]['pid']==$cid){
						$ttitle = $categories[$k]['title'];
						$carr[] = $categories[$k]['mva'];
                    	echo'<li><a href="#">'.$ttitle.'</a></li>';
						}
					}
                    echo'</ul>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-gt-block">';
				$dem=0;
				for($s=0; $s<sizeof($shop); $s++)
				{
					if($dem<6 && in_array($shop[$s]['pid'],$carr)){
						$id 	= $shop[$i]['id'];
						$mva 	= $shop[$i]['mva'];
						$pid	= $shop[$i]['pid'];
						$price	= $shop[$i]['price'];
						$pic	= $shop[$i]['pic'];
						$saleprice	= $shop[$i]['saleprice'];
						$saledate	= $shop[$i]['saledate'];
						$title		= $shop[$i]['title'];
						$rewtitle	= rewrite($title);
						$filename	= base_url()."uploads/modules/pic/".$pic;
						$file_headers = @get_headers($filename);
						if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
							$img = base_url()."uploads/modules/pic/default.jpg";
						}else {
							$img = $filename;
						}
						echo'<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
							<div class="ui-block">
								<div class="ui-img-block">
								<img src="'.$img.'">
								</div>
								<div class="ui-hyperlink">
								<a href="'.base_url().'index.php/shop/detail/'.$id.$rewtitle.'">'.$title.'</a>
								</div>';
								if((time()-(60*60*24)) < strtotime($saledate)){
								$iprice= $saleprice;
								echo'<div class="ui-price">'.numberformat($saleprice).' VNĐ</div>';
								echo'<div class="ui-price-sale">'.numberformat($price).' VNĐ</div>';
								echo'<div class="ui-icon-sale"><img src="'.base_url().'template/img/sale.png"></div>';
								}else{
								$iprice = $price;
								echo'<div class="ui-price">'.numberformat($price).' VNĐ</div>';
								}
								echo'
								<div class="ui-quick">
									<div class="quickview">
									<a href="#" class="fa fa-eye"><span>Quick view</span></a>
									</div>
									<div class="wishlist">
									<a href="#" class="fa fa-heart"><span>Wish List</span></a>
									</div>
									<div class="shoping">
									<a class="fa fa-shopping-cart my-cart-btn" data-id="'.$id.'" data-name="'.$title.'" data-summary="1" data-price="'.$iprice.'" data-quantity="1" data-image="'.$pic.'"><span>Add cart</span></a>
									</div>
								</div>
							</div>
						</div><!--end col-lg-12-->';
						$dem++;
					}
				}
                echo'</div><!--end col-lg-12-->
            </div>
        </div>
    </div>
    </section>
   
    <!--end new product-->';
}
	

	
echo'<!--advertise-->
    <section class="gt-2ad">
    <div class="default_width">
    	<div class="container">
        	<div class="row">';
			if(sizeof($bottom)!=0){
				for($i=0; $i<sizeof($bottom); $i++)	
				{
					echo'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><img src="'.base_url().'uploads/logo/'.$bottom[$i]['icon'].'"></div>';
				}
			}
            echo'
            </div>
        </div>
    </div>
    </section>
    <!--end advertise-->';

?>