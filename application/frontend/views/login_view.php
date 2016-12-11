<?php
defined('BASEPATH') OR exit('No direct script access allowed');
		//print_r($_SESSION);
		//echo $this->session->sess_expiration;
		//echo $this->session->userdata('username')."xxx";
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
            	<h1>Đăng nhập hệ thống</h1>
                </div>
            </div><br>
            <div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="ui-login">
						<div class="inner">
						<h2>Khách hàng mới</h2>
						<div class="content">
							<p><b>Đăng ký tài khoản</b></p>
							<p>Bằng cách tạo một tài khoản bạn sẽ có thể mua sắm nhanh hơn, được cập nhật về tình trạng một đơn đặt hàng, và theo dõi các đơn đặt hàng bạn đã thực hiện trước đó.</p>
							<a href="#" class="ui-button">Đăng ký</a>
						</div>
						</div>
					</div>
				</div>
             	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                	<div class="inner">
						<h2>Đăng nhập</h2>
						<span class=error>';
                        echo validation_errors();
                        if(isset($error)&&$error!="")
                        	echo $error;	
						echo'</span>
						<form method="post" class="f" action="'.base_url().'index.php/User/index">
                        <ul class="ui-widget">
                        <li><label for="username" class="required"><span>*</span> Tên đăng nhập hoặc Email</label><input type="username" name="username" id="username" class="tb validate[required]" placeholder="Username" required></li>
                        <li><label for="password" class="required"><span>*</span> Mật khẩu</label><input type="password" name="password" id="password" class="tb validate[required]" value=""></li>
                        <li class="btns"><input name="btn_login" type="submit" id="btnSubmit" class="htmlBtn first" value="Đăng nhập"></li>
                        </ul>
                        </form>
                        <a target="_top" class="loginFb" href="#">
                        <i class="fa fa-facebook"></i>Facebook</a><a target="_top" class="loginGg" href="#"><i class="fa fa-google"></i>Google</a>											
					</div>
                </div> 
            </div>
	</div><!--end div container-->';

?>