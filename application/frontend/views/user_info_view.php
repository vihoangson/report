<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo'<div class="container">
			<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="breadcrumb">
				<ol class="breadcrumb">
					<li><a href="#">Trang chủ</a></li>
					<li><a href="#">Tài khoản</a></li>
					<li><a href="#">Đăng nhập</a></li>
				</ol>
				</div>
                </div>
            </div>
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<h1>Thông tin tài khoản</h1>
				<div class="content"><br>
					<p><b>Email:</b>&nbsp;'.$user['user_email'].'</p>
					<p><b>Điện thoại:</b>&nbsp;'.$user['user_icq'].'</p>
					<p><b>Ngày sinh:</b>&nbsp;'.$user['birthday'].'</p>
					<p><b>Địa chỉ:</b>&nbsp;'.$user['user_from'].'</p>
				</div>
				</div>
				
            </div><br>
	</div><!--end div container-->';

?>