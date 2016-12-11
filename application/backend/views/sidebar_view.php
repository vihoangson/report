			<div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <div class="sidebar-header">
                        <div class="sidebar-profile">
                            <a href="javascript:void(0);" id="profile-menu-link">
                                <div class="sidebar-profile-image">
                                	<?php
                                    echo"<img src=\"".base_url()."uploads/gallery/".$l['avatar']."\" class=\"img-circle img-responsive\" alt=\"\">";
									?>
                                </div>
                                <div class="sidebar-profile-details">
                                	<?php
                                    echo"<span>".$l['name']."<br><small></small></span>";
									?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <ul class="menu accordion-menu">
                        <li class="active"><a href="<?php echo base_url().'admin.php/dashboard/auth' ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span><p>Users</p><span class="arrow"></span></a>
                        	<ul class="sub-menu">
							<?php
							echo'<li><a href="'.base_url().'admin.php/quanglykho/thanhpho">Tài khoản</a></li>';
							echo'<li><a href="'.base_url().'admin.php/quanglynhanvien/nhanvien">Nhân viên</a></li>';
							echo'<li><a href="'.base_url().'admin.php/quanglynhanvien/chucvu">Chức vụ</a></li>';
							?>
                        	</ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Products</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
							<?php
							echo'<li><a href="'.base_url().'admin.php/product/index">Products</a></li>';
							echo'<li><a href="'.base_url().'admin.php/product/categories">Categories</a></li>';
							?>
                            </ul>
                        </li>
                        
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Store</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
							<?php
							echo'<li><a href="'.base_url().'admin.php/quanglykho/thanhpho">Thành phố</a></li>';
							echo'<li><a href="'.base_url().'admin.php/quanglykho/nhacungcap">Nhà cung cấp</a></li>';
							?>
                            </ul>
                        </li>
                        
                        <li><a href="<?php echo base_url(); ?>admin.php/block/index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th"></span><p>Blocks</p></a></li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-edit"></span><p>News</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                            <?php
                            echo'<li><a href="'.base_url().'admin.php/news/index">News</a></li>';
                            echo'<li><a href="'.base_url().'admin.php/news/categories">Category</a></li>';
                            echo'<li><a href="'.base_url().'admin.php/news/specialcat">Special category</a></li>';
                            echo'<li><a href="'.base_url().'admin.php/news/addStories">Create new</a></li>';
							?>
                            </ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-gift"></span><p>Advertise</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                            	<?php
                                echo'<li><a href="'.base_url().'admin.php/logo/index">Logo</a></li>';
                              	?>
                            </ul>
                        </li>
                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-flash"></span><p>Tools</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                            	<?php
                                /*echo'<li><a href="'.base_url().'admin.php/module/index">Modules</a></li>';
								echo'<li><a href="'.base_url().'admin.php/photos/index">Photos</a></li>';
								echo'<li><a href="'.base_url().'admin.php/contacts/index">Contact</a></li>';
								echo'<li><a href="'.base_url().'admin.php/mail/index">Mail</a></li>';
								echo'<li><a href="'.base_url().'admin.php/video/index">Video</a></li>';
								echo'<li><a href="'.base_url().'admin.php/newsletter/index">Newletters</a></li>';*/
								echo'<li><a href="'.base_url().'admin.php/Cauhinh/index">Config</a></li>';
								echo'<li><a href="'.base_url().'admin.php/Cauhinh/logo">Logo</a></li>';
								?>
                            </ul>
                        </li>
                    </ul>
                </div><!-- Page Sidebar Inner -->
			</div><!-- Page Sidebar -->