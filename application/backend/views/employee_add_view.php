
<?php

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">Nhân Viên&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form method="post" action="'.base_url().'admin.php/quanglynhanvien/employee_save" enctype="multipart/form-data">
			<table class="table">
				<tr><td>Tên đăng nhập<span class="required">*</span></td><td><input type="text" name="name" class="form-control" required></td></tr>
				
				<tr><td>Phân quyền</td><td><select name="level">';
foreach ($chucvus as $cv) {
	echo '<option value="'.$cv["id"].'">'.$cv['title'].'</option>';
}
echo '			</select></td></tr>
				
				<tr><td>Mật khẩu<span class="required">*</span></td><td><input id="pass1" type="password" name="pass" class="form-control" required></td></tr>
				<tr><td>Xác nhận mật khẩu<span class="required">*</span></td><td><input id="pass2" type="password" name="pass1" class="form-control" required;"></td></tr>
				
				<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
				
				<tr><td>Email<span class="required">*</span></td><td><input type="text" name="email" class="form-control" required></td></tr>				
				<tr><td>Tên Đầy Đủ<span class="required">*</span></td><td><input type="text" name="fullname" class="form-control" required></td></tr>
				<tr><td>Ngày sinh</td><td><input type="date" name="birthday" class="form-control" required></td></tr>
				<tr><td>Giới tính</td><td><select name="sex">
					<option value="0">Nam</option>
					<option value="1">Nữ</option>
				</select></td></tr>
				<tr><td>Ngày vào làm</td><td><input type="date" name="datein" class="form-control" required></td></tr>
				<tr><td>Ngày nghỉ việc</td><td><input type="date" name="dateout" class="form-control"></td></tr>
				
				<tr><td>Địa chỉ</td><td><input type="text" name="address" class="form-control" required></td></tr>
				<tr><td>Điện thoại</td><td><input type="number" name="phone" class="form-control" required></td></tr>
				<tr><td>Số chứng minh thư</td><td><input type="number" name="CMND" class="form-control" required></td></tr>
				<tr><td>Kích hoạt</td><td>
					<input name="active" type="radio" class="no-uniform" value="0" checked="checked" />Active&nbsp;
      				<input name="active" type="radio" class="no-uniform" value="1" />Unactive
				</td></tr>
				
				<tr><td>Hình đại diện</td><td><input type="file" name="icon" accept="image/*"></td></tr>
				
				<tr><td colspan="2"><input type="submit" value="Upload" class="btn btn-success">&nbsp;
				
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

