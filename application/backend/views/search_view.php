<?php

        

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading" style="border:1px solid red">
		<h4 class="panel-title">'.lang('_ADMINSITE').'</h4>
		
		
		
     <form action="'.base_url().'admin.php/Quanglykho/Search" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div><!-- Input Group -->
        </form><!-- Search Form -->
		
		</div>';
	

		
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th>ID</th>
				<th>Mã Tỉnh/TP</th>
                <th>Thuộc Tỉnh/TP</th>
                <th>Title</th>
                <th><button type="button" data-toggle="modal" data-target="#cityadd"><i class="fa fa-plus"></i>
</button>
<!-- Modal -->
<div class="modal fade" id="cityadd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <form action="'.base_url().'admin.php/Quanglykho/addcity" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit city</h4>
      </div>
      <div class="modal-body">
	  	<table>
		<tr><td>Mã Tỉnh/TP: </td><td><input type="text" name="mva" value=""></td></tr>
	  	<tr><td>Tỉnh/TP: </td><td><input type="text" name="title" value=""></td></tr><tr><td>Thuộc: </td><td>';
		echo'<select name="pid">
		<option value="0">Thành phố</option>';
		foreach($dstp as $key => $value){
			if($value['pid']=="0"){
				echo'<option value="'.$value['mva'].'" selected="selected">'.$value['title'].'</option>';
			}
		}
		echo'</select>';
		
      echo'</tr></table></div>
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
			
			foreach ($dstp as $ds) {
				$f = $this->Quanglykho_model->find_info($ds["pid"]);
				if(sizeof($f)!=0){ $p = $f->title;}else{$p="";}
	echo'	<tr>
				<td>'.$ds["id"].'</td>
				<td>'.$ds["mva"].'</td>
				<td>'.$p.'</td>
				<td>'.$ds["title"].'</td>
				<td>
<!-- Button trigger modal -->
<button type="button" data-toggle="modal" data-target="#'.$ds['id'].'">
<i class="fa fa-user"></i>
</button>
<button type="button" data-toggle="modal" data-target="#citytrash'.$ds['id'].'">
<i class="fa fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="'.$ds['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <form action="'.base_url().'admin.php/Quanglykho/editcity" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit city</h4>
      </div>
      <div class="modal-body">
	  	<table>
	  	<tr><td>Tỉnh/TP: </td><td><input type="text" name="title" value="'.$ds['title'].'"></td></tr><tr><td>Thuộc: </td><td>';
		echo'<select name="pid">
		<option value="0">Thành phố</option>';
		foreach($dstp as $key => $value){
			if($value['pid']=="0"){
				if($ds['pid']==$value['mva']){	
				echo'<option value="'.$value['mva'].'" selected="selected">'.$value['title'].'</option>';
				}else{
				echo'<option value="'.$value['mva'].'">'.$value['title'].'</option>';
				}
			}
		}
		echo'</select>';
		
      echo'</tr></table></div>
      <div class="modal-footer">
	  	<input type="hidden" name="id" value="'.$ds['id'].'">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>


<div class="modal fade" id="citytrash'.$ds['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <form action="'.base_url().'admin.php/Quanglykho/deletecity" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete city</h4>
      </div>
      <div class="modal-body">
	  Bạn có muốn xóa nội dung này hay không?
	  </div>
      <div class="modal-footer">
	  	<input type="hidden" name="id" value="'.$ds['id'].'">
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
	echo'	</tbody>';
	echo'</table>';
	echo'<div class="row" align="center"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><ul class="pagination">'.$link.'</ul></div></div>';
	echo'</div>';
	echo'</div>';
	

echo'</div>';
echo'</div>';

?>

