<?php
echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">ADD PRODUCTS&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form action="'.base_url().'index.php/product/categories_save" method="post" enctype="multipart/form-data">
						<table class="table" cellspacing="10">
						<tbody>
						<tr><td>Mã danh mục:</td><td><input type="text" name="mva" class="form-control"></td></tr>
						<tr><td>Tiêu đề:</td><td><input type="hidden" name="cid"><input type="text" name="title" class="form-control"></td></tr>
						<tr><td>Thuộc chủ đề:</td><td>'.$acatgories.'</td></tr>
						<tr><td>Hình đại diện</td><td><input type="file" name="cpic" size="20" /></td></tr>
						<tr><td>Icon</td><td><input type="file" name="icon" size="20" /></td></tr>
						<tr><td>metaTitle</td><td><input type="text" name="metaTitle" class="form-control" /></td></tr>
						<tr><td>metaKeywords</td><td><input type="text" name="metaKeywords" class="form-control" /></td></tr>
						<tr><td>metaDescription</td><td><input type="text" name="metaDescription" class="form-control" /></td></tr>
						<tr><td colspan="2"><input type="submit" value="Save" class="btn btn-success">&nbsp;<a href="'.base_url().'admin.php/product/categories"><input class="btn btn-success" value="Cancel"></a></td></tr>
						<tr><td colspan="2"><div id="xToolbar"></div>';
						draw_input("hometext","","100%",200);
						echo'</td></tr>
						</tbody>
						</table>
			</form>
		</div>
		</div>';
echo'</div>';
echo'</div>';

	
?>
