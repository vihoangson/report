<?php
//print_r(get_defined_vars());
//echo lang('hello');
echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">STORIES&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Add" href="'.base_url().'index.php/news/addStories"><i class="fa fa-plus"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adap"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	echo'<form method="post" id="fdap" action="'.base_url().'index.php/news/deleteallstories" enctype="multipart/form-data">';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th><span class="checked"><input type="checkbox" class="check-mail-all"></span></th>
				<th>Title</th>
                <th>Functions</th>
			</tr>
			</thead>
			<tbody>';
	foreach ($stories as $item) 
	{
		echo"<tr>
				<th scope=\"row\"><span><input name=\"dall[]\" value=\"".$item['sid']."\" type=\"checkbox\" class=\"checkbox-mail\"></span>".$item['sid']."</th>
				<td>".$item['title']."</td>
				<td>
				<a href=\"".base_url()."index.php/news/editstories/".$item['sid']."\"><i class=\"fa fa-edit\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$item['sid']."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$item['sid']."\" style=\"display:none\">
				Bạn có muốn xóa bản tin này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/news/deletestories/".$item['sid']."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$item['sid']."')\"> No </a>
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
	