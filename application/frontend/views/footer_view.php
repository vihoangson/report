<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo'
<footer class="footer wow bounceInUp animated">
	<!--START BOTTOM LOGO-->
	<div class="brand-logo ">
		<div class="container">
			<div class="slider-items-products">
				<div id="brand-logo-slider" class="product-flexslider hidden-buttons">
					<div class="slider-items slider-width-col6"> ';
              		for($i =0; $i < sizeof($lbottom); $i ++) 
					{
						$logoimg = @explode("|",$lbottom[$i]);	
						if($logoimg[3]=="bottom")
						{
						echo'<!-- Item -->
						<div class="item"> <a href="'.$logoimg[1].'"><img src="'.base_url().'uploads/logo/'.$logoimg[0].'" alt="Image" width="130px" height="50px"></a> </div>
						<!-- End Item --> ';
						}
					}
              
					echo'</div>
				</div>
			</div>
		</div>
	</div>
	<!--END BOTTOM LOGO-->
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-7">
            <div class="block-subscribe">
              <div class="newsletter">
                <form action="'.base_url().'index.php/newsletter/regist/'.$language.'" method="post">
                  <h4>'.lang('_NEWSLETTER').'</h4>
                  <input type="text" placeholder="Enter your email address" class="input-text required-entry validate-email" title="Sign up for our newsletter" id="newsletter1" name="email">
                  <button class="subscribe" title="Subscribe" type="submit"><span>'.lang('_SUBSCRIBE').'</span></button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-5">
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
        </div>
      </div>
    </div>
    <div class="footer-middle container">
		<div class="row">
			<div class="kode_pet_footer">
				<div class="col-md-6">
				<a href="#"><img src="'.base_url().'template/images/logo.png" alt=""></a>
				</div>
				<div class="col-md-6 slogan">
				<span class="s1">'.lang('_COMPANYNAME').'</span><br>
				<span class="s2">'.lang('_SLOGAN').' </span>
				</div>
			</div><div class="clearfix clear"></div>
        	<div class="row">
            	<div class="col-md-4">
                	<div class="kode_pet_foo_lst">
                    	<a href="'.base_url().'index.php/map/index/'.$language.'"><i class="icon-placeholder87"><img src="'.base_url().'template/images/mark.png" alt=""></i></a>
                        <h6>'.lang('_ADDRESS1').'</h6><div class="clearfix clear"></div>
						<h6>'.lang('_ADDRESS2').'</h6>
                    </div>
                </div>
                
                <div class="col-md-4">
                	<div class="kode_pet_foo_lst">
                    	<a href="#"><i class="icon-placeholder87"><img src="'.base_url().'template/images/phone.png" alt=""></i></a>
                        <h6>#'.lang('_PHONE').'</h6><div class="clearfix clear"></div>
						<h6>'.lang('_PHONE1').'</h6>
                    </div>
                </div>
                
                <div class="col-md-4">
                	<div class="kode_pet_foo_lst">
                    	<a href="#"><i class="icon-placeholder87"><img src="'.base_url().'template/images/email.png" alt=""></i></a>
						<h6>@Email</h6><div class="clearfix clear"></div>
                        <h6 style="text-transform: lowercase;">'.lang('_EMAIL1').'</h6>
                    </div>
                </div>
            </div>
      	</div>
    </div>
    <div class="footer-bottom">
      	<div class="container">
        	<div class="row">
          		<div class="col-sm-5 col-xs-12 coppyright"> &copy; 2015. All Rights Reserved. Designed by <a href="#">TẠ\'s Crafts</a> </div>
          		<div class="col-sm-7 col-xs-12 company-links"></div>
        	</div>
		</div>
    </div>

</footer>
<!-- End Footer --> ';