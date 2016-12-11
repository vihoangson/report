<?php
$cat = $categories[0];
echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">ADD PRODUCTS&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form action="'.base_url().'index.php/product/sec" method="post" enctype="multipart/form-data">
						<table class="table" cellspacing="10">
						<tbody>
						<tr><td>Tiêu đề:</td><td><input type="hidden" name="cid" value="'.$cat['cid'].'"><input type="text" name="title" value="'.$cat['title'].'" class="form-control"></td></tr>
						<tr><td>Thuộc chủ đề:</td><td>'.$acatgories.'</td></tr>
						<!--<tr><td>Ngôn ngữ:</td><td>'.$select_language.'</td></tr>-->
						<tr><td>Hình ảnh</td><td>';
						if($cat['cat_pic'])
						{
							echo'<i class="fa fa-trash"></i><input name="delimg" type="checkbox" value="1" />';
							echo'<a href="'.base_url().'uploads/modules/pic/'.$cat['cat_pic'].'">'.$cat['cat_pic'].'</a>';
						}
						echo'<input type="file" name="userfile" size="20" /></td></tr>
						<tr><td colspan="2"><input type="submit" value="Save" class="btn btn-success">&nbsp;<a href="'.base_url().'index.php/product/categories"><input class="btn btn-success" value="Cancel"></a></td></tr>
						</tbody>
						</table>
			</form>
		</div>
		</div>';
echo'</div>';
echo'</div>';

	
?>
