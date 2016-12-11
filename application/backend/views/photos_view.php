<?php
//print_r(get_defined_vars());

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">PHOTOS&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Add" href="'.base_url().'index.php/logo/al"><i class="fa fa-plus"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adap"><i class="fa fa-trash"></i></a>
		</div>
		
		<div align="center">
			<form method="post" action="'.base_url().'index.php/photos/addphotos" enctype="multipart/form-data">
				<table>
					<tr>
						<td>Tên tiêu đề:</td><td><input type="file" name="userfile" size=\"50\"></td><td><input type="submit" value="Save"></td>
					</tr>
				</table>
			</form>
		</div>
    </div>';
	echo'<form method="post" id="fdap" action="'.base_url().'index.php/photos/deleteallphotos" enctype="multipart/form-data">';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th><span class="checked"><input type="checkbox" class="check-mail-all"></span></th>
				<th>Title</th>
                <th>Functions</th>
			</tr>
			</thead>
			<tbody>';
	$m =1;
	for($i =0; $i < sizeof($list); $i ++) {
			echo"<tr>
				<th scope=\"row\"><span><input name=\"dall[]\" value=\"".$list[$i]."\" type=\"checkbox\" class=\"checkbox-mail\"></span></th>
				<td>".$list[$i]."</td>
				<td>
				<a href=\"../../../uploads/gallery/".$list[$i]."\" target=\"_blank\"><i class=\"fa fa-eye\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$i."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$i."\" style=\"display:none\">
				Bạn có muốn xóa hình ảnh này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/photos/deletephotos/".$list[$i]."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$i."')\"> No </a>
				</div>
			
				</td>
			</tr>";
			$m++;
	}
	echo'	</tbody>';
	echo'</table>';
	echo'</form>';
	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
	