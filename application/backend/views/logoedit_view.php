<?php

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">EDIT LOGO&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">';
			
	echo "<form action=\"".base_url()."index.php/logo/sel/".$poz."\" method=\"POST\" enctype=\"multipart/form-data\">\n";
	echo "<table class=\"table\">";
	echo "	<tr>\n";
	echo "		<td align=\"center\">\n";
	echo "		<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">TIÊU ĐỀ:</td>\n";
	echo "				<td align=\"left\"><input type=\"text\" size=\"50\" name=\"title\" value=\"".$logo[4]."\" required></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">TIÊU ĐỀ CON:</td>\n";
	echo "				<td align=\"left\"><input type=\"text\" size=\"50\" name=\"subtitle\" value=\"".$logo[2]."\"></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">MÔ TẢ:</td>\n";
	echo "				<td align=\"left\"><textarea name=\"content\" cols=\"52\" rows=\"10\">".$logo[5]."</textarea>
	</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">LIÊN KẾT:</td>\n";
	echo "				<td align=\"left\">\n";
	echo "				<input type=\"url\" size=\"50\" name=\"address\" value=\"".$logo[1]."\"></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">VỊ TRÍ:</td>\n";
	echo "				<td align=\"left\">\n";
	if($logo[3] == "topleft") {$seld1 =" selected";} 
	if($logo[3] == "topright"){$seld2 =" selected";}
	if($logo[3] == "bottom"){$seld3 =" selected";}
	echo"<select name=\"vitri\">";
	echo"<option name=\"vitri\" value=\"0\">Chọn vị trí</option>";
	echo"<option name=\"vitri\" value=\"topleft\" $seld1>topleft</option>";
	echo"<option name=\"vitri\" value=\"topright\" $seld2>topright</option>";
	echo"<option name=\"vitri\" value=\"bottom\" $seld3>bottom</option>";
	echo"</select>\n";
	echo"				</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">Hình ảnh:</td>\n";
	echo "				<td align=\"left\">";
	if($logo[0]){
	echo "				<input type=\"hidden\" value=\"".$logo[0]."\" name=\"image\"><i class=\"fa fa-trash\"></i><input name=\"delimg\" type=\"checkbox\" value=\"1\" />";
	echo "				<a href=\"".base_url()."uploads/logo/".$logo[0]."\">".$logo[0]."</a>";
	}
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
	