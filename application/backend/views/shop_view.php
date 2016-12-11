<?php
//print_r(get_defined_vars());
//echo lang('hello');
echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">PRODUCTS&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Add" href="'.base_url().'index.php/product/ap"><i class="fa fa-plus"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adap"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	echo'<form method="post" id="fdap" action="'.base_url().'index.php/product/dap" enctype="multipart/form-data">';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th><span class="checked"><input type="checkbox" class="check-mail-all"></span></th>
				<th>Title</th>
                <th>Functions</th>
			</tr>
			</thead>
			<tbody>';
	foreach ($products as $item) 
	{
		echo"<tr>
				<th scope=\"row\"><span><input name=\"dall[]\" value=\"".$item['pid']."\" type=\"checkbox\" class=\"checkbox-mail\"></span>".$item['pid']."</th>
				<td>".$item['title']."</td>
				<td>
				<a href=\"".base_url()."index.php/product/ep/".$item['pid']."\"><i class=\"fa fa-edit\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$item['pid']."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$item['pid']."\" style=\"display:none\">
				Bạn có muốn xóa sản phẩm này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/product/dp/".$item['pid']."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$item['pid']."')\"> No </a>
				</div>
			
				</td>
			</tr>";
			
	}
	echo'	</tbody>';
	echo'</table>';
	echo'</form>';
	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
	