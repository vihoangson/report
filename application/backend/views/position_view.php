<?php
//print_r(get_defined_vars());
//echo lang('hello');

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">'.lang('_ADMINSITE').'</h4>
		</div>';

echo'<div class="panel-body">';
echo'<div class="table-responsive project-stats"> ';
echo'<table class="table">';
echo'	<thead>
			<tr>
				<th>Mã chức vụ</th>
				<th>Tên chức vụ</th>
                <th>Chức năng: <button type="button" data-toggle="modal" data-target="#position_add"><i class="fa fa-plus"></i>
</button>
<!-- Modal -->
<div class="modal fade" id="position_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <form action="'.base_url().'admin.php/Quanglynhanvien/position_save" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">POSITION ADD</h4>
      </div>
      <div class="modal-body">
	  	<table class="table">
				<tr><td>Tên chức vụ</td><td><input type="text" name="title" class="form-control" required></td></tr>
		</table>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>
			
				
				</th>
   			</tr>
			</thead>
			<tbody>';
foreach ($chucvus as $cv) {
	if($cv['id'] == 1){
		echo '<tr>
					<td>'.$cv["id"].'</td>
					<td>'.$cv["title"].'</td>
				</tr>';						
	}else{
		echo '<tr>
					<td>'.$cv["id"].'</td>
					<td>'.$cv["title"].'</td>
					<td>
<button type="button" data-toggle="modal" data-target="#'.$cv['id'].'">
<i class="fa fa-edit"></i>
</button>
<button type="button" data-toggle="modal" data-target="#trash'.$cv['id'].'">
<i class="fa fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="'.$cv['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <form action="'.base_url().'admin.php/Quanglynhanvien/position_update" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">EDIT POSITION</h4>
      </div>
      <div class="modal-body">
	  	<table class="table">
			<tr><td>Tên chức vụ</td><td><input type="text" name="title" value="'.$cv['title'].'" class="form-control" required></td></tr>
		</table>
	  </div>
      <div class="modal-footer">
	  	<input type="hidden" name="id" value="'.$cv['id'].'">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>


<div class="modal fade" id="trash'.$cv['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <form action="'.base_url().'admin.php/Quanglynhanvien/position_delete" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete city</h4>
      </div>
      <div class="modal-body">
	  Bạn có muốn xóa nội dung này hay không?
	  </div>
      <div class="modal-footer">
	  	<input type="hidden" name="id" value="'.$cv['id'].'">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Yes</button>
      </div>
	  </form>
    </div>
  </div>
</div>
					
				</td>
				</tr>';
	}
}
echo'	</tbody>';
echo'</table>';
echo'</div>';
echo'</div>';


echo'</div>';
echo'</div>';

?>

