<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo'
<nav>
	<div class="container">
    	<div class="nav-inner">
        	<!--<div class="logo-small"><a class="logo" title="Magento Commerce" href="#"><img alt="Magento Commerce" src="'.base_url().'template/images/logo.png"></a> </div>-->
            <!-- mobile-menu -->
            <div class="hidden-desktop" id="mobile-menu">
				<ul class="navmenu">
            		<li>
              			<div class="menutop">
                            <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                            <h2>'.lang('_MOBILEMENU').'</h2>
              			</div>
                        <!--Start submenu-->
              			<ul class="submenu">
                		<li>
                  			<ul class="topnav">
								<li class="level0 nav-6 level-top first parent"> <a class="level-top" href="'.base_url().'index.php/home/index/'.$language.'"> <span>'.lang('_HOME').'</span> </a></li>
                    			<li class="level0 nav-7 level-top parent"> <a class="level-top" href="'.base_url().'index.php/aboutus/index/'.$language.'"> <span>'.lang('_ABOUTUS').'</span> </a></li>
								<li class="level0 nav-7 level-top parent"> <a class="level-top" href="'.base_url().'index.php/shop/index/'.$language.'"> <span>'.lang('_PRODUCT').'</span> </a></li>
                        		<li class="level1 nav-1-3 parent"> <a href="'.base_url().'index.php/partner/index/'.$language.'"> <span>'.lang('_PARTNER').'</span> </a></li>
                        		<li class="level1 nav-1-4 last parent"> <a href="'.base_url().'index.php/news/index/'.$language.'"> <span>'.lang('_NEWS').'</span> </a></li>
								<li class="level1 nav-1-5 last parent"> <a href="'.base_url().'index.php/contactus/index/'.$language.'"> <span>'.lang('_CONTACTUS').'</span> </a></li>
                      		</ul>
                    	</li>
                    	
                        <!--End submenu-->
					</li>
				</ul>
				<!--navmenu--> 
			</div>
            <!--End mobile-menu -->
            
            
            <!--Start desktop-menu -->
            <ul id="nav" class="hidden-xs">';
			  if($this->uri->segment(1, 0)=='shop')
			  {
              echo'<li id="nav-home" class="level0 parent drop-menu active"><a href="'.base_url().'index.php/home/index/'.$language.'" class="level-top"><span>'.lang('_HOME').'</span> </a></li>';
			  }
			  else
			  {
			  echo'<li id="nav-home" class="level0 parent drop-menu active"><a href="'.base_url().'index.php/home/index/'.$language.'" class="level-top" class="active"><span>'.lang('_HOME').'</span> </a></li>';
			  }
			  
			
			$amid = $this->MODULE_Model->GetModulesWhere("'Aboutus'");
			$mid = $amid[0]['mid'];
			$data = $this->NEWS_Model->getParentNewsCategories($mid);

			  if($this->uri->segment(1, 0)=='aboutus')
			  {
				  $sel = 'active';
			  }
			  else
			  {
				  $sel = '';
			  }
              echo'<li class="level0 parent drop-menu '.$sel.'"><a href="'.base_url().'index.php/aboutus/index/'.$language.'"><span>'.lang('_ABOUTUS').'</span></span> </a>';
			  if(sizeof($data)){
			  echo'<ul class="level1">';
			  	foreach($data as $row)
				{
			  	echo'<li class="level1 parent"><a href="'.base_url().'index.php/aboutus/module/'.$language.'/'.$row['catid'].'"><span>'.$row['title'].'</span></a> </li>';
				}
			  echo'</ul>';
			  }
			  echo'</li>';
			 
			  
			  if($this->uri->segment(1, 0)=='shop')
			  {
              echo'<li class="level0 nav-6 level-top parent"> <a href="'.base_url().'index.php/shop/index/'.$language.'" class="active"> <span>'.lang('_PRODUCT').'</span></span> </a> </li>';
			  }
			  else
			  {
			  echo'<li class="level0 nav-6 level-top parent"> <a href="'.base_url().'index.php/shop/index/'.$language.'" class="level-top"> <span>'.lang('_PRODUCT').'</span></span> </a> </li>';
			  }
			  
			  if($this->uri->segment(1, 0)=='partner')
			  {
              echo'<li class="level0 nav-5 level-top first"> <a class="level-top" href="'.base_url().'index.php/partner/index/'.$language.'"> <span>'.lang('_PARTNER').'</span></span> </a></li>';
			  }
			  else
			  {
			  echo'<li class="level0 nav-5 level-top first  active"> <a class="level-top" href="'.base_url().'index.php/partner/index/'.$language.'"> <span>'.lang('_PARTNER').'</span></span> </a></li>';
			  }
			  
			  if($this->uri->segment(1, 0)=='news')
			  {
              echo'<li class="level0 parent drop-menu active"> <a class="level-top" href="'.base_url().'index.php/news/index/'.$language.'"><span>'.lang('_NEWS').'</span></span></a></li>';
			  }
			  else
			  {
			  echo'<li class="level0 parent drop-menu"> <a class="level-top" href="'.base_url().'index.php/news/index/'.$language.'"><span>'.lang('_NEWS').'</span></span></a></li>';
			  }
			  
			  if($this->uri->segment(1, 0)=='contactus')
			  {
              echo'<li class="level0 parent drop-menu"><a href="'.base_url().'index.php/contactus/index/'.$language.'" class="active"><span>'.lang('_CONTACTUS').'</span></span></a></li>';
			  }
			  else
			  {
			  echo'<li class="level0 parent drop-menu"><a href="'.base_url().'index.php/contactus/index/'.$language.'"><span>'.lang('_CONTACTUS').'</span></span></a></li>';
			  }
            echo'</ul>
            <!--End desktop-menu -->
            
		</div>
	</div>
</nav>
<!-- end nav --> ';
?>