<?php
//print_r(get_defined_vars());
//echo lang('hello');
//echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">SPECIAL CATEGORIES&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<div align="center">
			<form method="post" action="'.base_url().'index.php/news/addtopic" enctype="multipart/form-data">
				<table>
					<tr>
						<td>Tên tiêu đề:</td><td><input type="text" name="title"></td><td><input type="submit" value="Save"></td>
					</tr>
				</table>
			</form>
		</div>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adatopic"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	
	echo'<form method="post" id="fdatopic" action="'.base_url().'index.php/news/deletealltopic" enctype="multipart/form-data">';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th><span class="checked"><input type="checkbox" class="check-mail-all"></span></th>
				<th>Title</th>
                <th>Functions</th>
			</tr>
			</thead>
			<tbody>';
	$i=1;
	foreach ($topic as $item) 
	{
		echo"<tr>
				<th scope=\"row\"><span><input name=\"dall[]\" value=\"".$item['topicid']."\" type=\"checkbox\" class=\"checkbox-mail\"></span>".$i."</th>
				<td>".$item['topictitle']."</td>
				<td>
				<a href=\"".base_url()."index.php/news/edittopic/".$item['topicid']."\"><i class=\"fa fa-edit\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$item['topicid']."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$item['topicid']."\" style=\"display:none\">
				Bạn có muốn xóa topic này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/news/deletetopic/".$item['topicid']."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$item['topicid']."')\"> No </a>
				</div>
			
				</td>
			</tr>";
		$i++;
	}
	echo'	</tbody>';
	echo'</table>';
	echo'</form>';
	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
	