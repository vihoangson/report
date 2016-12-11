<?php
//print_r(get_defined_vars());
//echo lang('hello');
//echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">MAIL CONFIG&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<div align="center">
			<form method="post" action="'.base_url().'index.php/mail/savemail" enctype="multipart/form-data">
				<table class="table">
					<tr>
						<td>Địa chỉ email:</td><td><input name="address" value="'.$mail_email.'"></td>
					</tr>
					<tr>
						<td>Loại email:</td><td>';
						if($checkmail==0){$checked[1]=''; $checked[2]='checked';}
						else{$checked[1]='checked'; $checked[2]='';}
						echo "<input type=\"radio\" name=\"typemail\" class=\"no-uniform\" value=\"0\" ".$checked[2].">Mail()";
						echo "<input type=\"radio\" name=\"typemail\" class=\"no-uniform\" value=\"1\" ".$checked[1].">SMTP Server";
						echo'</td>
					</tr>
					<tr>
						<td colspan="2">Chỉ sử dụng khi SMTP Server:</td>
					</tr>
					<tr>
						<td>SMTP Server:</td><td><input name="mailserver" value="'.$mail_mailserver.'"></td>
					</tr>
					<tr>
						<td>SMTP Username<br>(Chỉ nhập tên nếu máy chủ SMTP của bạn yêu cầu chứng thực):</td><td><input name="mailusername" value="'.$mail_username.'"></td>
					</tr>
					<tr>
						<td>SMTP Password <br>Chỉ nhập password nếu máy chủ SMTP của bạn yêu cầu chứng thực:</td><td><input name="mailpassword" type="password" value="'.$mail_password.'"></td>
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
	