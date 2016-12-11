<?php

?>
        <div class="navbar">
			<div class="navbar-inner">
				<div class="sidebar-pusher">
					<a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
					<i class="fa fa-bars"></i>
					</a>
				</div>
                <div class="logo-box">
                	<a href="#" class="logo-text"><span>TẠ's Crafts</span></a>
				</div><!-- Logo Box -->
				<div class="search-button">
					<a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
				</div>
				<div class="topmenu-outer">
					<div class="top-menu">
						<ul class="nav navbar-nav navbar-left">
						<li><a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a></li>
                        <li><a href="#" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-diamond"></i></a></li>
                        <li><a href="#" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
                        </ul>
                        
                        <ul class="nav navbar-nav navbar-right">
                        <li><a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                        <?php
						echo'<span class="user-name">'.$l['name'].'<i class="fa fa-angle-down"></i></span>';
						echo'<img class="img-circle avatar" src="'.base_url().'uploads/gallery/'.$l['avatar'].'" width="40" height="40" alt="">';
						?>
                        </a>
                        	<ul class="dropdown-menu dropdown-list" role="menu">
                            	<?php
								echo'<li role="presentation"><a href="'.base_url().'admin.php/dashboard/changeprofile"><i class="fa fa-user"></i>Profile</a></li>';
                                echo'<li role="presentation"><a href="'.base_url().'admin.php/dashboard/changepass"><i class="fa fa-lock"></i>Change password</a></li>';
                                echo'<li role="presentation" class="divider"></li>';
								echo'<li role="presentation"><a href="'.base_url().'admin.php/dashboard/logout"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>';
								?>
							</ul>
						</li>
                        <li>
							<?php
                            echo'<a href="'.base_url().'admin.php/dashboard/logout" class="log-out waves-effect waves-button waves-classic">';
                            ?>
							<span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
						</a></li>
                       	</ul><!-- Nav -->
					</div><!-- Top Menu -->
				</div>
			</div>
		</div><!-- Navbar -->