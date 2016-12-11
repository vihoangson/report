<?php
//print_r(get_defined_vars());
//echo lang('hello');
//echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">CONTACTS&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<div align="center">
			<form method="post" action="'.base_url().'index.php/contacts/addcontact" enctype="multipart/form-data">
				<table>
					<tr>
						<td>Tên:</td><td><input type="text" name="name"></td>
					</tr>
					<tr>
						<td>Handphone:</td><td><input type="text" name="handphone"></td>
					</tr>
					<tr>
						<td>Điện thoại:</td><td><input type="text" name="phone"></td>
					</tr>
					<tr>
						<td>Email:</td><td><input type="text" name="email"></td>
					</tr>
					<tr>
						<td>Yahoo:</td><td><input type="text" name="yahoo"></td>
					</tr>
					<tr>
						<td>Skype:</td><td><input type="text" name="skype"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="OK" value="Save"></td>
					</tr>
				</table>
			</form>
		</div>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adatopic"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	
	echo'<form method="post" id="fdatopic" action="'.base_url().'index.php/contacts/deleteallcontact" enctype="multipart/form-data">';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th><span class="checked"><input type="checkbox" class="check-mail-all"></span></th>
				<th>Title</th>
				<th>Handphone</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Yahoo</th>
				<th>Skype</th>
                <th>Functions</th>
			</tr>
			</thead>
			<tbody>';
	$i=1;
	foreach ($contact as $item) 
	{
		echo"<tr>
				<th scope=\"row\"><span><input name=\"dall[]\" value=\"".$item['id']."\" type=\"checkbox\" class=\"checkbox-mail\"></span>".$i."</th>
				<td>".$item['name']."</td>
				<td>".$item['handphone']."</td>
				<td>".$item['telephone']."</td>
				<td>".$item['email']."</td>
				<td>".$item['yahoo']."</td>
				<td>".$item['skype']."</td>
				<td>
				<a href=\"".base_url()."index.php/contacts/editcontact/".$item['id']."\"><i class=\"fa fa-edit\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$item['id']."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$item['id']."\" style=\"display:none\">
				Bạn có muốn xóa topic này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/contacts/deletecontact/".$item['id']."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$item['id']."')\"> No </a>
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
	