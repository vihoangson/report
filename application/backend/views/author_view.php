
<?php

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">Tạo tài khoản đăng nhập</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form method="post" action="'.base_url().'admin.php/quanglynhanvien/author_save" enctype="multipart/form-data">
			<table class="table">
				<tr><td>Tên đăng nhập <span class="required">*</span></td><td><input type="text" name="aid" value="'.$a->CMND.'"  class="form-control" required></td></tr>
				<tr><td>Mật khẩu <span class="required">*</span></td><td><input type="password" name="pwd" value="'.$a->pass.'" class="form-control" required></td></tr>
				<tr><td>Email <span class="required">*</span></td><td><input type="text" name="email" value="'.$a->email.'" class="form-control" required></td></tr>				
				<tr><td>Họ và tên <span class="required">*</span></td><td><input type="text" name="name" value="'.$a->fullname.'"  class="form-control" required></td></tr>				
				<tr><td>Hình đại diện</td><td><input type="file" name="userfile" accept="image/*"></td></tr>
				
				<tr><td colspan="2"><input type="hidden" name="level" value="'.$a->level.'" ><input type="submit" value="Upload" class="btn btn-success">&nbsp;
				
				<a href="'.base_url().'index.php/quanglynhanvien/nhanvien"><input class="btn btn-success" value="Cancel"></a></td></tr>
			</table>
			</form>
			</div>
		</div>';
echo'</div>';
echo'</div>';

?>


<script type="text/javascript">
$(document).ready(function() {
    $("#pass2").keyup(function() {
        var password = $("#pass1").val();
        $("#divCheckPasswordMatch").html(password == $(this).val()
            ? "Passwords match."
            : "Passwords do not match!"
        );
    });
});​
</script>

