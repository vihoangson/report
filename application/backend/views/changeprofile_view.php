<?php
echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">CHANGE PROFILE&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">';
			
	echo "<form action=\"".base_url()."index.php/dashboard/savechangeprofile\" method=\"POST\" enctype=\"multipart/form-data\">\n";
	echo "<table class=\"table\">";
	echo "	<tr>\n";
	echo "		<td align=\"center\">\n";
	echo "		<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">TÊN:</td>\n";
	echo "				<td align=\"left\">".$l['aid']."</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">TÀI KHOẢN:</td>\n";
	echo "				<td align=\"left\"><input type=\"text\" size=\"50\" name=\"name\" value=\"".$l['name']."\"";
	if($l['name']=="God")
		echo "disabled";
	echo "				></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">EMAIL:</td>\n";
	echo "				<td align=\"left\"><input type=\"text\" size=\"50\" name=\"email\" value=\"".$l['email']."\"></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">Hình ảnh:</td>\n";
	echo "				<td align=\"left\">";
	//if($logo[0]){
	echo "				<input type=\"hidden\" value=\"#\" name=\"image\"><i class=\"fa fa-trash\"></i><input name=\"delimg\" type=\"checkbox\" value=\"1\" />";
	echo "				<a href=\"#\">".$l['avatar']."</a>";
	//}
	echo "				<input type=\"file\" name=\"userfile\" size=\"50\"></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">&nbsp;</td>\n";
	echo "				<td align=\"left\"><input type=\"submit\" value=\"Thêm\"></td>\n";
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
	