
<?php

	$filename	= base_url()."uploads/gallery/".$nhanvien->icon;
	$file_headers = @get_headers($filename);
	if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
		$img = base_url()."uploads/gallery/default.jpg";
	}else {
		$img = $filename;
	}

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">Nhân Viên&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form method="post" action="'.base_url().'admin.php/quanglynhanvien/employee_update/'.$nhanvien->CMND.'" enctype="multipart/form-data">
			<table class="table">
				<tr><td>Tên đăng nhập <span class="required">*</span></td><td><label class="form-control">'.$nhanvien->name.'</label></td></tr>
				
				<tr><td>Phân quyên</td><td><select name="level">';
foreach ($chucvus as $cv) {
	if($cv["id"] == $nhanvien->level){
		echo '<option value="'.$cv["id"].'" selected>'.$cv['title'].'</option>';
	}else{
		echo '<option value="'.$cv["id"].'">'.$cv['title'].'</option>';
	}
}
echo '			</select></td></tr>
				
				<tr><td>Xác nhận mật khẩu <span class="required">*</span></td><td><input type="password" name="pass" class="form-control" required;"></td></tr>
				
				<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
				
				<tr><td>Email <span class="required">*</span></td><td><input type="text" name="email" value="'.$nhanvien->email.'" class="form-control" required></td></tr>				
				<tr><td>Tên Đầy Đủ <span class="required">*</span></td><td><input type="text" name="fullname" value="'.$nhanvien->fullname.'" class="form-control" required></td></tr>
				<tr><td>Ngày sinh</td><td><input type="date" name="birthday" value="'.$nhanvien->birthday.'" class="form-control" required></td></tr>
				<tr><td>Giới tính</td><td><select name="sex">';
					if($nhanvien->sex == 0){
						echo '<option value="0" selected >Nam</option>
							<option value="1">Nữ</option>';	
					}else{
						echo '<option value="0">Nam</option>
							<option value="1" selected >Nữ</option>';	
					}
echo '				</select></td></tr>
				<tr><td>Ngày vào làm</td><td><input type="date" name="datein" value="'.$nhanvien->datein.'" class="form-control" required></td></tr>
				<tr><td>Ngày nghỉ việc</td><td><input type="date" name="dateout" value="'.$nhanvien->dateout.'" class="form-control"></td></tr>
				
				<tr><td>Địa chỉ</td><td><input type="text" name="address" value="'.$nhanvien->address.'" class="form-control" required></td></tr>
				<tr><td>Điện thoại</td><td><input type="number" name="phone" value="'.$nhanvien->phone.'" class="form-control" required></td></tr>
				<tr><td>Số chứng minh thư</td><td><input type="number" name="CMND" value="'.$nhanvien->CMND.'" class="form-control" required></td></tr>
				
				<tr><td>Hình đại diện</td><td><input type="file" name="userfile" accept="image/*">
				<img src="'.$img.'" width="120" height="100"></td></tr>
				
				<tr><td colspan="2"><input type="submit" value="Upload" class="btn btn-success">&nbsp;
				
				<a href="'.base_url().'index.php/quanglynhanvien/nhanvien"><input class="btn btn-success" value="Cancel"></a></td></tr>
			</table>
			</form>
			</div>
		</div>';
echo'</div>';
echo'</div>';

echo FCPATH;
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

