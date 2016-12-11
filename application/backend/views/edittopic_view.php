<?php
//print_r(get_defined_vars());
//echo lang('hello');
//echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

$topic = $atopic[0];

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">SPECIAL CATEGORIES&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<div align="center">
			<form method="post" action="'.base_url().'index.php/news/saveedittopic/'.$topic['topicid'].'" enctype="multipart/form-data">
				<table>
					<tr>
						<td>Tên tiêu đề:</td><td><input type="text" name="title" value="'.$topic['topictitle'].'"></td><td><input type="submit" value="Save"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adeleteallproduct"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	
	
	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
	