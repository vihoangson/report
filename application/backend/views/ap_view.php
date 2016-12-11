<?php

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">ADD PRODUCTS&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form method="post" action="'.base_url().'index.php/product/sp" enctype="multipart/form-data">
			<table class="table">
				<tr><td width="16%">Nhóm sản phẩm</td><td>';
				echo $catgories;
				echo'</td></tr>
				<tr><td>Tiêu đề</td><td><input type="text" name="title" class="form-control"></td></tr>
				<tr><td>Hiển thị trang chủ</td><td>
					<input name="ihome" type="radio" class="no-uniform" value="0" checked="checked" />Yes
      				<input name="ihome" type="radio" class="no-uniform" value="1" />No</td></tr>
				<tr><td>Hình ảnh</td><td>
					<input type="file" multiple name="userfile[]" size="20" /></td></tr>
				<tr><td colspan="2"><div id="xToolbar"></div>';
				draw_input("hometext","","100%",200);
				echo'</td></tr>
				<tr><td colspan="2">';
				draw_input("bodytext");
				echo'</td></tr>
				<tr><td colspan="2"><input type="submit" value="Upload" class="btn btn-success">&nbsp;<a href="'.base_url().'index.php/product"><input class="btn btn-success" value="Cancel"></a></td></tr>
			</table>
			</form>
			</div>
		</div>';
echo'</div>';
echo'</div>';
	
?>
