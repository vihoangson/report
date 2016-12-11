<?php
echo"
<div id=\"magik-slideshow\" class=\"magik-slideshow\">
	<div class=\"container\">
		<div class=\"row\">
		<div class=\"col-lg-8 col-sm-12 col-md-8 wow bounceInUp animated\">
			<div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container' >
            	<div id='rev_slider_4' class='rev_slider fullwidthabanner'>
				<ul>";
				
              	for($i =0; $i < sizeof($logo); $i ++) 
				{
					$logoimg = @explode("|",$logo[$i]);	
					if($logoimg[3]=="topleft")
					{
                echo"<li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='".base_url()."uploads/logo/slider_img_2.jpg'><img src=\"".base_url()."uploads/logo/".$logoimg[0]."\" data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' alt=\"banner\"/>
					<div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='45'  data-y='30'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'>".$logoimg[2]."</div>
                  	<div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='45'  data-y='70'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3; white-space:nowrap;'>".$logoimg[4]."</div>
                  	<div class='tp-caption sfb  tp-resizeme ' data-x='45'  data-y='360'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><a href='".$logoimg[1]."' class=\"view-more\">".lang('_DETAIL')."</a> <!--<a href='#' class=\"buy-btn\">Buy Now</a>--></div>
                  	<div class='tp-caption Title sft  tp-resizeme ' data-x='45'  data-y='130'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'>".$logoimg[5]."</div>
                  	<!--<div    class='tp-caption Title sft  tp-resizeme ' data-x='45'  data-y='400'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;font-size:11px'>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>-->
                </li>";
					}
				}
                
              	echo"</ul>
				<div class=\"tp-bannertimer\"></div>
			</div>
		</div>
		</div><!--div row-->
		<aside class=\"col-xs-12 col-sm-12 col-md-4 wow bounceInUp animated\">
			<div class=\"RHS-banner\">";
				/*for($i =0; $i < sizeof($logo); $i ++) 
				{
					$logoimg = @explode("|",$logo[$i]);	
					if($logoimg[3]=="topright")
					{
				echo"<div class=\"add\"><a href=\"".$logoimg[1]."\"><img alt=\"banner-img\" src=\"".base_url()."uploads/logo/".$logoimg[0]."\" width=\"360\" height=\"460\"></a>
					<div class=\"overlay\"><a class=\"info\" href=\"#\">Learn More</a></div>
				</div>";
					}
				}*/
				$v = $this->VIDEO_Model->getVideo();
				$url = $v[0]['url'];
				echo'<object width="360" height="460"><param name="movie" value="http://www.youtube.com/v/'.$url.'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$url.'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="360" height="460"></embed></object>';
			echo"</div>
		</aside>
      	</div>
	</div>
</div>
<!-- end Slider --> ";



echo"
<section class=\"main-container col1-layout home-content-container\">
	<div class=\"container\">
      	<div class=\"std\">
        	<div class=\"best-seller-pro wow bounceInUp animated\">
          		<div class=\"slider-items-products\">
					<div class=\"new_title center\">
              		<h2>".lang('_NEWPRODUCTS')."</h2>
            		</div>
            		<div id=\"best-seller-slider\" class=\"product-flexslider hidden-buttons\">";
					$i=0;
					echo"<div class=\"slider-items slider-width-col4\">";
					foreach($products as $value)
              		{
						if($value['images']!=""){
							$pic	=	explode(",",$value['images']);
							$img    =   $pic[0];
							if(!file_exists(FCPATH."uploads/modules/pic/".$img) || $img=="")
							{
								$img = 'default.jpg';
							}
						}
						else
						{
							$img = $img;
						}		
						$i++;	
						echo"
						<!-- Item -->
						<div class=\"item\">
                  			<div class=\"col-item\">
							
                    		<div class=\"product-image-area\"> <a class=\"product-image\" title=\"\" href=\"".base_url()."index.php/shop/detail/".$language."/".$value['cid']."/".$value['pid']."\"> <img src=\"".base_url()."uploads/modules/pic/".$img."\" class=\"img-responsive\" alt=\"product-image\" /> </a>
                      		<div class=\"hover_fly\"> 
								<a class=\"exclusive ajax_add_to_cart_button\" href=\"".base_url()."index.php/contactus/index/".$language."\" title=\"Add to cart\">
                        			<div><i class=\"icon-shopping-cart\"></i><span>".lang('_ADDCART')."</span></div>
                        		</a> 
								<a class=\"quick-view\" href=\"".base_url()."index.php/shop/detail/".$language."/".$value['cid']."/".$value['pid']."\">
                        			<div><i class=\"icon-eye-open\"></i><span>".lang('_DETAIL')."</span></div>
                        		</a> 
							</div>
                    		</div>
							
                    		<div class=\"info\">
                      			<div class=\"info-inner\">
                        			<div class=\"item-title\"> <a title=\"".$value['title']."\" href=\"".base_url()."index.php/shop/detail/".$language."/".$value['cid']."/".$value['pid']."\"> ".$value['title']." </a> </div>
                        			<div class=\"item-content\">
                          				
                        			</div>
                        			<!--item-content--> 
                      			</div>
                      			<!--info-inner-->
                      			<div class=\"clearfix\"> </div>
                    		</div>
                  			
							</div>
						</div>
                		<!-- End Item -->  ";
						if($i%4==0){
							echo"</div>
						<!--end row-->
						<div class=\"slider-items slider-width-col4\">";
						}
					}
						
						
						
					echo"</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
";

?>