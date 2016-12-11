<?php
//print_r(get_defined_vars());
//echo lang('hello');

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">'.lang('_ADMINSITE').'</h4>
		</div>';
if($num_rows>0)
{
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<table class="table" border="0">';
	echo'	<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
                <th>Email</th>
                <th>Authorities</th>
                <th>Functions</th>
				<th></th>
			</tr>
			</thead>
			<tbody>';
	foreach ($authors as $item) 
	{
		echo'<tr>
				<th scope="row">'.$item['name'].'</th>
				<td>'.$item['aid'].'</td>
				<td><span class="label label-success">'.$item['email'].'</span></td>';
				if($item['name']=='God' && $item['radminsuper']==1)
				{
					echo '<td>'.lang('_GOADMIN').'</td>';
					echo "<td>
                    		<!--<a href=\"#\" onclick=\"myFunction('AuEd".$item['aid']."')\"><i class=\"fa fa-user\"></i></a>
							<a href=\"#\" onclick=\"myFunction('AuPa".$item['aid']."')\"><i class=\"fa fa-edit\"></i></a>-->
						  </td>";
				}
				else
				{
					if($item['name']!='God' && $item['radminsuper']==1)
					{
						echo '<td>'.lang('_SUPERUSER').'</td>';
					}
					else
					{
						echo '<td>'.lang('_SUBUSER').'</td>';
					}
					echo "<td>
                    		<!--<a href=\"#\" onclick=\"myFunction('AuEd".$item['aid']."')\"><i class=\"fa fa-user\"></i></a>
							<a href=\"#\" onclick=\"myFunction('AuPa".$item['aid']."')\"><i class=\"fa fa-edit\"></i></a>
							<a href=\"#\" onclick=\"myFunction('AuDe".$item['aid']."')\"><i class=\"fa fa-trash\"></i></a>-->
						  </td>";
					
				}
				
		echo'<td width="1%"><div id="AuEd'.$item['aid'].'" style="display:none">
				<form action="'.base_url().'admin.php/dashboard/authedit" method="post">
				<table>
				<tr><td>Tài khoản</td><td><input type="text" name="aid" value="'.$item['aid'].'" required></td></tr>
				<tr><td>Email</td><td><input type="email" name="email" value="'.$item['email'].'" required></td></tr>
				<tr><td></td><td>
					<!--<input style="color:black" type="checkbox" name="vehicle" value="1"> I have a bike-->
				</td></tr>
				<tr><td></td><td><input type="submit" value="'.lang('_AUTHSAVE').'"></td></tr>
				</table>
				</form>		
			</div>
			
			<div id="AuPa'.$item['aid'].'" style="display:none">
				<form action="'.base_url().'admin.php/dashboard/autheditpass" method="post">
				<table>
				<tr><td>Tài khoản</td><td><input type="text" name="aid" value="'.$item['aid'].'"></td></tr>
				<tr><td>Email</td><td><input type="text" name="email" value="'.$item['email'].'"></td></tr>
				<tr><td></td><td><input type="submit" value="'.lang('_AUTHSAVE').'"></td></tr>
				</table>
				</form>		
			</div>
			</td>
			</tr>';
	}
	echo'	</tbody>';
	echo'</table>';
	echo'</div>';
	echo'</div>';
	
}
echo'</div>';
echo'</div>';

?>

<script type="text/javascript">
//$(document).ready(function() {
	function myFunction(v) {
		$("#"+v).dialog();
		//$("#"+v).css("display","block");
	}
//});
</script>
