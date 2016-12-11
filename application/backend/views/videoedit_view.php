<?php
//print_r(get_defined_vars());
$row = $video[0];
$id = $row['id'];
$name = $row['name'];
$url = $row['url'];
echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">VIDEO ADD&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adap"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	echo'<form method="post" id="fdap" action="'.base_url().'index.php/video/saveeditvideo/'.$id.'" enctype="multipart/form-data">';
	echo "<table class=\"table\">";
	echo "	<tr>\n";
	echo "		<td align=\"center\">\n";
	echo "		<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">TIÊU ĐỀ:</td>\n";
	echo "				<td align=\"left\"><input type=\"text\" size=\"50\" name=\"title\" value=\"".$name."\" required></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\" width=\"150\">CHỦ ĐỀ CON:</td>\n";
	echo "				<td align=\"left\">".$theloai."</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">LIÊN KẾT:</td>\n";
	echo "				<td align=\"left\">\n";
	echo "				<input type=\"text\" size=\"50\" name=\"address\" value=\"".$url."\"></td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">VIDEO HOME:</td>\n";
	echo "				<td align=\"left\">".$ihome."</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td align=\"right\">&nbsp;</td>\n";
	echo "				<td align=\"left\"><input type=\"submit\" value=\"Thêm\"></td>\n";
	echo "			</tr>\n";
	echo "			</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
	echo "</table></form>\n";
	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
	