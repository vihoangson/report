<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$categories = $this->SHOP_Model->ShopAllCategories();
$cha= array();
$pt=0;
for ($i=0; $i<sizeof($categories); $i++)
{
	if($categories[$i]['pid']=='0'){
		$cha[$pt] = $categories[$i];
		for ($j=0; $j<sizeof($categories); $j++)
		{
			if($categories[$j]['pid']==$categories[$i]['mva']){
				$cha[$pt]['flag'] = true;
			}else{$cha[$pt]['flag'] = false;}
		}
		$pt++;
	}
}

echo'<section id="ui-ls">
    <div class="default_width">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 logo"><img src="'.base_url().'template/img/logo.png"></div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                	<div id="hdSearch">
                    	<input id="txtSearch" type="text" name="" value="" autocomplete="off" placeholder="Tìm kiếm sản phẩm tại đây...">
                        <button class="btnSearch"><i class="fa fa-search"></i></button>
                    </div>
                    <p style="font-style:italic;"><span class="active">Fitbit, Alta, Blaze, Charge HR,&nbsp;Apple Watch, Flycam, Anker, </span><span class="normal">Garmin, BeoPlay, Kindle, Bose</span></p>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!--run on smartphone-->
    <section id="pav-mainnav" class="hidden-lg hidden-md">
    <div class="container">
        <div class="mainnav-wrap">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 row-offcanvas row-offcanvas-left" style="z-index:1000;">
                    <div class="ui-toggle">
					<p class="pull-left">
            		<a href="javascript:" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-bars" aria-hidden="true"></i></a>
					</p></div>
		  
		  			<div class="col-xs-10 col-sm-10 sidebar-offcanvas" id="sidebar" style="z-index:1000;" >
					  <div class="list-group">';
					  for($c=0; $c < sizeof($cha); $c++)
					  {
						echo'<a href="#" class="list-group-item">'.$cha[$c]['title'].'</a>';
					  }
						
					  echo'</div>
					</div><!--/.sidebar-offcanvas-->
			
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="z-index:10">
                    <div id="search" class="pull-right">
                        <form id="search-form" action="" method="get">
                            <input type="text" name="q" placeholder="Tìm kiếm">
                            <input type="submit" class="button-search" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</section>
    <!--run on smartphone-->';
?>