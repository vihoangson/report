<?php
if(sizeof($product))
{
	
$pr = $product[0];

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">ADD PRODUCTS&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form method="post" action="'.base_url().'index.php/product/sep/'.$pr['pid'].'" enctype="multipart/form-data">
			<table class="table">
				<tr><td width="16%">Nhóm sản phẩm</td><td>';
				echo $catgories;
				echo'</td></tr>
				<tr><td>Tiêu đề</td><td><input type="text" name="title" value="'.$pr['title'].'" class="form-control"></td></tr>
				<tr><td>Hiển thị trang chủ</td><td>';
				if($pr['is_home']==0){
					echo'<input name="ihome" class="no-uniform" type="radio" value="0" checked="checked" />No';
      				echo'<input name="ihome" class="no-uniform" type="radio" value="1" />Yes';
				}
				else
				{
					echo'<input name="ihome" class="no-uniform" type="radio" value="0"  />No';
      				echo'<input name="ihome" class="no-uniform" type="radio" value="1" checked="checked"/>Yes';
				}
				echo'</td></tr>
				<tr><td>Hình ảnh</td><td>';
				
					if($pr['images'])
					{
						echo'<i class="fa fa-trash"></i><br>';
						$pic = explode(",",$pr['images']);
						foreach($pic as $p){
						echo'<input name="delimg[]" type="checkbox" value="'.$p.'" />';
						echo'<a href="#">'.$p.'</a><br>';
						}
					}
					echo'<input type="file" multiple name="userfile[]" size="20" /></td></tr>
				<tr><td colspan="2"><div id="xToolbar"></div>';
				draw_input("hometext",$pr['hometext'],"100%",200);
				echo'</td></tr>
				<tr><td colspan="2">';
				draw_input("bodytext",$pr['bodytext']);
				echo'</td></tr>
				<tr><td colspan="2"><input type="submit" value="Upload" class="btn btn-success">&nbsp;<a href="'.base_url().'index.php/product"><input class="btn btn-success" value="Cancel"></a></td></tr>
			</table>
			</form>
			</div>
		</div>';
echo'</div>';
echo'</div>';
}
?>
