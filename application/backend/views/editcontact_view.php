<?php
//print_r(get_defined_vars());
//echo lang('hello');
//echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';
$row = $contact[0];
$id = $row['id'];
$name = $row['name'];
$handphone= $row['handphone'];
$telephone= $row['telephone'];
$email= $row['email'];
$yahoo= $row['yahoo'];
$skype= $row['skype'];


echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">CONTACTS&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<div align="center">
			<form method="post" action="'.base_url().'index.php/contacts/saveeditcontact/'.$id.'" enctype="multipart/form-data">
				<table>
					<tr>
						<td>Tên:</td><td><input type="text" name="name" value="'.$name.'"></td>
					</tr>
					<tr>
						<td>Handphone:</td><td><input type="text" name="handphone" value="'.$handphone.'"></td>
					</tr>
					<tr>
						<td>Điện thoại:</td><td><input type="text" name="phone" value="'.$telephone.'"></td>
					</tr>
					<tr>
						<td>Email:</td><td><input type="text" name="email" value="'.$email.'"></td>
					</tr>
					<tr>
						<td>Yahoo:</td><td><input type="text" name="yahoo" value="'.$yahoo.'"></td>
					</tr>
					<tr>
						<td>Skype:</td><td><input type="text" name="skype" value="'.$skype.'"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="OK" value="Save"></td>
					</tr>
				</table>
			</form>
		</div>
    </div>';
	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
	