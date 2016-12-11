<?php
//print_r(get_defined_vars());
echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">CHANGE PASSWORD&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">';
			
	echo "<form action=\"".base_url()."index.php/dashboard/saveeditpass\" method=\"POST\" enctype=\"multipart/form-data\">\n";
	echo "<table class=\"table\">";
	echo "	<tr>\n";
	echo "		<td align=\"center\">\n";
	echo "		<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">MẬT KHẨU CŨ:</td>\n";
	echo "				<td align=\"left\"><input type=\"password\" size=\"50\" name=\"oldpass\" required></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">MẬT KHẨU MỚI:</td>\n";
	echo "				<td align=\"left\"><input type=\"password\" size=\"50\" name=\"newpass\"></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">NHẬP LẠI MẬT KHẨU MỚI:</td>\n";
	echo "				<td align=\"left\"><input type=\"password\" size=\"50\" name=\"renewpass\"></td>\n
	</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">&nbsp;</td>\n";
	echo "				<td align=\"left\"><input type=\"submit\" value=\"Lưu thay đổi\"></td>\n";
	echo "			</tr>\n";
	echo "			</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
	echo "</table></form>\n";
	
	echo '</div>
		</div>';
echo'</div>';
echo'</div>';
?>
	