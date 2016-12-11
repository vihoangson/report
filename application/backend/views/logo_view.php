<?php
//print_r(get_defined_vars());

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">LOGO&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Add" href="'.base_url().'index.php/logo/al"><i class="fa fa-plus"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adap"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	echo'<form method="post" id="fdap" action="'.base_url().'index.php/logo/dal" enctype="multipart/form-data">';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th><span class="checked"><input type="checkbox" class="check-mail-all"></span></th>
				<th>Title</th>
				<th>Images</th>
				<th>Position</th>
                <th>Functions</th>
			</tr>
			</thead>
			<tbody>';
	$m =1;
	for($i =0; $i < sizeof($logo); $i ++) {
			$logo_old = @explode("|",$logo[$i]);
			echo"<tr>
				<th scope=\"row\"><span><input name=\"dall[]\" value=\"".$i."\" type=\"checkbox\" class=\"checkbox-mail\"></span>".$logo_old[2]."</th>
				<td>".$logo_old[0]."</td>
				<td>".$logo_old[1]."</td>	
				<td>".$logo_old[3]."</td>	
				<td>
				<a href=\"".base_url()."index.php/logo/el/".$i."\"><i class=\"fa fa-edit\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$i."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$i."\" style=\"display:none\">
				Bạn có muốn xóa sản phẩm này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/logo/dl/".$i."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$i."')\"> No </a>
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
	