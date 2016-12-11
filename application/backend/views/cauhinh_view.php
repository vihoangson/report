<?php

?>
<div class="col-lg-12 col-md-12">
<div class="panel panel-white">
<div class="panel-heading">
		<h4 class="panel-title">Câu Hình&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form method="post" action="<?php echo base_url(); ?>admin.php/Cauhinh/update" enctype="multipart/form-data">
			<table class="table">
				
				<tr><td>Tên site: </td><td><input type="text" name="name1" value="<?php echo $option1->option_value?>" class="form-control" required></td></tr>
				<tr><td>Mô tả: </td><td><input type="text" name="name2" value="<?php echo $option2->option_value?>" class="form-control" required></td></tr>
                <tr><td>Cấu hình SMTP: </td><td>
                
                <?php
				
				if($option11->option_value==1){
               	echo'<input type="checkbox" value="1" name="name11" class="form-control" checked="checked"> Remember me';
				}else{
				echo'<input type="checkbox" value="1" name="name11"  class="form-control"> Remember me';
				}
				?>
				</td></tr>
				<tr><td>Mail server url:  </td><td><input type="text" name="name3" value="<?php echo $option3->option_value?>" class="form-control" required></td></tr>
				<tr><td>Mail server login: </td><td><input type="text" name="name4" value="<?php echo $option4->option_value?>" class="form-control" required></td></tr>
				<tr><td>Mail server pass: </td><td><input type="password"" name="name5" value="<?php echo $option5->option_value?>" class="form-control" required></td></tr>
				<tr><td>Mail server port: </td><td><input type="text" name="name6" value="<?php echo $option6->option_value?>" class="form-control" required></td></tr>
				<tr><td>Số tin / mỗi trang: </td><td><input type="text" name="name7" value="<?php echo $option7->option_value?>" class="form-control" required></td></tr>
				<tr><td>Định dạng ngày: </td><td><input type="text" name="name8" value="<?php echo $option8->option_value?>" class="form-control" required></td></tr>
				<tr><td>Định dạng giờ: </td><td><input type="text" name="name9" value="<?php echo $option9->option_value?>" class="form-control" required></td></tr>
				
				<tr><td colspan="2"><input type="submit" value="Upload" class="btn btn-success">&nbsp;
				
				</td></tr>
			</table>
			</form>
			</div>
		</div>
</div>
</div>	


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

