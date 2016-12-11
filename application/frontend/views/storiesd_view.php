<?php
$img = $stories[0]['images'];
if(!file_exists(FCPATH."uploads/modules/news/".$img) || $img=="")
{
	$img = 'default.jpg';
}
else
{
	$img = $img;
}		
echo'
<div class="product-view">
	<div class="product-essential">
    <form action="#" method="post" id="product_addtocart_form">
		<input name="form_key" value="6UbXroakyQlbfQzK" type="hidden">
		<div class="product-img-box col-lg-6 col-sm-6 col-xs-12">
		<img src="'.base_url().'uploads/modules/news/'.$img.'" class="zoomImg" style="width: 100%; height: 100%; border: none; max-width: none;">
		<!--<ul class="moreview" id="moreview">
			<li class="moreview_thumb thumb_1"> 
            	<img class="moreview_thumb_image" src="'.base_url().'uploads/modules/news/product1.jpg" alt="thumbnail"> 
                <img class="moreview_source_image" src="'.base_url().'uploads/modules/news/product2.jpg" alt="">
                <span class="roll-over">Roll over image to zoom in</span> 
                <img  class="zoomImg" src="'.base_url().'uploads/modules/pic/product3.jpg" alt="thumbnail">
			</li> 
            <li class="moreview_thumb thumb_2 moreview_thumb_active"> 
            	<img class="moreview_thumb_image" src="'.base_url().'uploads/modules/pic/product4.jpg" alt="thumbnail"> 
                <img class="moreview_source_image" src="'.base_url().'uploads/modules/pic/product4.jpg" alt=""> 
                <span class="roll-over">Roll over image to zoom in</span> 
                <img  class="zoomImg" src="images/product4.jpg" alt="thumbnail">
			</li>
		</ul>-->
		<div class="moreview-control"> 
        <a href="javascript:void(0)" class="moreview-prev"></a> 
        <a href="javascript:void(0)" class="moreview-next"></a> </div>
		</div>
        <div class="product-shop col-lg-6 col-sm-6 col-xs-12">
			<!--<div class="product-next-prev"> <a class="product-next" href="#"><span></span></a> <a class="product-prev" href="#"><span></span></a> </div>-->
			<div class="product-name"><h1>'.$stories[0]['title'].'</h1></div>
			<!--<div class="ratings">
				<div class="rating-box">
					<div class="rating"></div>
				</div>
                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
			</div>
			<p class="availability in-stock">Availability: <span>In stock</span></p>
			<div class="price-block">
				<div class="price-box">
				<p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $315.99 </span> </p><p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $309.99 </span> </p>
				</div>
			</div>-->
            <div class="short-description">
				<h2>'.lang('_QUICKVIEW').'</h2>
				'.$stories[0]['hometext'].'
			</div>
			<div class="social">
			<ul>
            	<li class="fb"><a href="http://facebook.com"></a></li>
				<li class="tw"><a href="http://twitter.com/"></a></li>
				<li class="googleplus"><a href="http://plus.google.com"></a></li>
				<li class="pintrest"><a href="http://www.pinterest.com/"></a></li>
				<li class="linkedin"><a href="http://www.linkedin.com/"></a></li>
				<li class="youtube"><a href="http://www.youtube.com/"></a></li>
			</ul>
            </div>
		</div>
	</form>
</div>

<div class="product-collateral">
	<div class="col-sm-12 wow bounceInUp animated animated" style="visibility: visible;">'.$stories[0]['bodytext'].'</div>
</div>';
?>