<?php

echo'<div class="category-title"><h1><a href="'.base_url().'index.php/shop/module/'.$categories['cid'].'">'.$categories['title'].'</a></h1></div>';
if(sizeof($products)!=0)
{
	echo'<ul class="products-grid">';
	foreach($products as $key => $value)
	{
		$pic	=	explode(",",$value['images']);
		$img    =   $pic[0];
		if(!file_exists(FCPATH."uploads/modules/pic/".$img) || $img=="")
		{
			$img = 'default.jpg';
		}
		else
		{
			$img = $img;
		}		
		echo'<li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
		<div class="col-item">
		
			<div class="product-image-area"> 
				<a class="product-image" title="Sample Product" href="'.base_url().'index.php/shop/detail/'.$language.'/'.$value['cid'].'/'.$value['pid'].'"><img src="'.base_url().'uploads/modules/pic/'.$img.'" class="img-responsive" alt="a" /> </a>
				<div class="hover_fly"> 
					<a class="exclusive ajax_add_to_cart_button" href="'.base_url().'index.php/contactus/index/'.$language.'" title="Add to cart">
					<div><i class="icon-shopping-cart"></i><span>'.lang('_ADDCART').'</span></div>
					</a> 
					<a class="addToWishlist wishlistProd_5" href="'.base_url().'index.php/shop/detail/'.$language.'/'.$value['cid'].'/'.$value['pid'].'">
					<div><i class="icon-heart"></i><span>'.lang('_DETAIL').'</span></div>
					</a> 
				</div>
			</div>
			<div class="info">
				<div class="info-inner">
					<div class="item-title"> <a title=" Sample Product" href="'.base_url().'index.php/shop/detail/'.$language.'/'.$value['cid'].'/'.$value['pid'].'"> '.$value['title'].' </a> </div>
					
				</div>
				<div class="clearfix"> </div>
			</div>
	
		</div>
		</li>';
	}
	echo'</ul>';
}
echo'<div class="clearfix"> </div>';
?>