<?php
//print_r(get_defined_vars());
//echo lang('hello');

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">'.lang('_ADMINSITE').'</h4>
		</div>';
?>
<div class="panel-body">
<div class="table-responsive project-stats">
<table class="table">
	<thead>
			<tr>
            	<?php
				echo'<th align="center"><a href="'.base_url().'admin.php/quanglynhanvien/employee_add"><i class="fa fa-plus"></i></a></th>';
				?>
				<th>Tên đăng nhập</th>
				<th>Quyền hạn</th>
				<th>Tên đầy đủ</th>
				<th>Điện thoại</th>
				<th>Email</th>
                <th>Sửa</th>
				<th>Khóa</th>
                <th>Xóa</th>
                <th></th>
   			</tr>
			</thead>
			<tbody>
<?php 
	foreach ($nhanviens as $nv) {
		$a = $this->Auth_model->getInfo($nv['CMND']);

	echo '<tr>
		<td>'.$nv["CMND"].'</td>
		<td>'.$nv["name"].'</td>';
	foreach ($chucvus as $cv) {
		if($cv["id"] == $nv["level"]){
			echo '<td>'.$cv["title"].'</td>';
		}
	}
	echo	'<td>'.$nv["fullname"].'</td>
		<td>'.$nv["phone"].'</td>
		<td>'.$nv["email"].'</td>
		<td><a href="'.base_url().'admin.php/quanglynhanvien/employee_edit/'.$nv["CMND"].'"><i class="fa fa-edit"></i></a></td>
		<td>';
		if($nv["active"] == 0){ 
		echo'<a href="'.base_url().'admin.php/quanlynhanvien/active_lock/'.$nv["CMND"].'"><i class="fa fa-lock"></i></a>';
		}else{ 
		echo'<a href="'.base_url().'admin.php/quanlynhanvien/unactive_lock/'.$nv["CMND"].'"><i class="fa fa-unlock"></i></a>';
		}
		echo'</td>
	<td><a href="'.base_url().'admin.php/quanglynhanvien/employee_add"><i class="fa fa-trash"></i></a>';
	if($a['aid']!=NULL){
	echo'<span class="required"><i class="fa fa-connectdevelop"></i></span>';
	}else{
	echo'<a href="'.base_url().'admin.php/quanglynhanvien/user_map/'.$nv["CMND"].'"><i class="fa fa-connectdevelop"></i></a>';
	}
	echo'</td>
	</tr>

</tbody>
</table>
</div>
</div>


</div>
</div>';
	}
?>
