<?php
//print_r(get_defined_vars());
//echo lang('hello');

/*echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';*/

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">CATEGORIES&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats">';
	echo'<div class="text-right" colspan="5">
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Add" href="'.base_url().'admin.php/product/categories_add"><i class="fa fa-plus"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Thứ tự</th>
				<th>Active</th>
                <th>Nội dung</th>
				<th>Hình đại diện</th>
				<th>Icon</th>
				<th>Xóa</th>
			</tr>
			</thead>
			<tbody>';
	$i=0;
	foreach ($categories as $item) 
	{
		if($item['pid']=='0')
		{
			$i++;
		echo'<tr>
				<th scope="row">'.$i.'</th>
				<td><b>'.$item['title'].'</b></td>
				<td></td>
				<td></td>
				<td><button type="button" data-toggle="modal" data-target="#shop_category_edit'.$item['cid'].'"><i class="fa fa-edit"></i></button>
					<!-- Modal -->
					<div class="modal fade" id="shop_category_edit'.$item['cid'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <form action="'.base_url().'admin.php/Product/categories_update" method="post">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Chỉnh sửa danh mục sản phẩm</h4>
						  </div>
						  <div class="modal-body">';
						$categoriesinfo = $this->Product_model->getmvaCategories($item['mva']);
						$cat = $categoriesinfo[0];
						$data['cselect'] = $categoriesinfo[0]['pid'];
						$data['cid'] = $this->Product_model->ShopModuleParent();
						$acatgories =$this->load->view('grouppcp_view',$data,true);
						$icon	= base_url()."uploads/modules/categories/".$cat['icon'];
						$file_headers = @get_headers($filename);
						if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
							$ic = base_url()."uploads/modules/categories/default.jpg";
						}else {
							$ic = $icon;
						}
						
						$cpic	= base_url()."uploads/modules/categories/".$cat['cpic'];
						$file_headers = @get_headers($filename);
						if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
							$cp = base_url()."uploads/modules/categories/default.jpg";
						}else {
							$cp = $cpic;
						}
						
						echo'<table class="table" cellspacing="10">
						<tbody>
						<tr><td>Mã danh mục:</td><td><input type="text" name="title" value="'.$cat['mva'].'" class="form-control"></td></tr>
						<tr><td>Tiêu đề:</td><td><input type="text" name="title" value="'.$cat['title'].'" class="form-control"></td></tr>
						<tr><td>Thuộc chủ đề:</td><td>'.$acatgories.'</td></tr>
						<tr><td>metaTitle:</td><td><input type="text" name="metaTitle" value="'.$cat['metaTitle'].'" class="form-control"></td></tr>
						<tr><td>metaKeywords:</td><td><input type="text" name="metaKeywords" value="'.$cat['metaKeywords'].'" class="form-control"></td></tr>
						<tr><td>metaDescription:</td><td><input type="text" name="metaDescription" value="'.$cat['metaDescription'].'" class="form-control"></td></tr>
						</tbody>
						</table>
						  </div>
						  <div class="modal-footer">
							<input type="hidden" name="id" value="'.$item['cid'].'"><input type="hidden" name="mva" value="'.$item['mva'].'">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						  </div>
						  </form>
						</div>
					  </div>
					</div>
				
				</td>
				<td><button type="button" data-toggle="modal" data-target="#shop_category_cpic_edit'.$item['mva'].'"><i class="fa fa-image"></i></button>
					<!-- Modal -->
					<div class="modal fade" id="shop_category_cpic_edit'.$item['mva'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <form action="'.base_url().'admin.php/product/categories_cpic_update" method="post">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Edit city</h4>
						  </div>
						  <div class="modal-body">
						  	<table>
						  	<tr><td>Hình đại diện</td><td><input type="file" name="userfile" accept="image/*"><br>
							<img src="'.$cp.'" width="280"></td></tr>
							</table>
						  </div>
						  <div class="modal-footer">
							<input type="hidden" name="id" value="'.$item['cid'].'"><input type="hidden" name="mva" value="'.$item['mva'].'">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Yes</button>
						  </div>
						  </form>
						</div>
					  </div>
					</div></td>
				<td><button type="button" data-toggle="modal" data-target="#shop_category_icon_edit'.$item['mva'].'"><i class="fa fa-image"></i></button>
					<!-- Modal -->
					<div class="modal fade" id="shop_category_icon_edit'.$item['mva'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <form action="'.base_url().'admin.php/product/categories_icon_update" method="post">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Edit city</h4>
						  </div>
						  <div class="modal-body">
						  <table>
						  	<tr><td>Hình đại diện</td><td><input type="file" name="userfile" accept="image/*"><br>
							<img src="'.$ic.'" width="60"></td></tr>
						  </table>
						  </div>
						  <div class="modal-footer">
							<input type="hidden" name="id" value="'.$item['cid'].'"><input type="hidden" name="mva" value="'.$item['mva'].'">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Yes</button>
						  </div>
						  </form>
						</div>
					  </div>
					</div></td>
				<td><button type="button" data-toggle="modal" data-target="#shop_category_delete'.$item['mva'].'"><i class="fa fa-trash"></i></button>
					<!-- Modal -->
					<div class="modal fade" id="shop_category_delete'.$item['mva'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <form action="'.base_url().'admin.php/product/categories_delete/'.$item['mva'].'" method="post">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Edit city</h4>
						  </div>
						  <div class="modal-body">
						  Bạn có muốn xóa danh mục?
						  </div>
						  <div class="modal-footer">
							<input type="hidden" name="id" value="'.$item['cid'].'">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Yes</button>
						  </div>
						  </form>
						</div>
					  </div>
					</div>
				
				</td>
			</tr>';
			
			foreach($categories as $citem)
			{
				if($citem['pid']==$item['mva'])
				{
					$i++;
					echo'<tr>
					<th scope="row">'.$i.'</th>
					<td>&ensp;&ensp;'.$citem['title'].'</td>
					<td></td>
					<td></td>
					<td><a href="#"><i class="fa fa-edit"></i></a></td>
					<td><a href="#"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			}
			
		}
			
	}
	echo'	</tbody>';
	echo'</table>';

	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
	