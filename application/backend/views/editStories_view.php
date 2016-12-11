<?php
$lang = $this->Global_Model->lingua();
$sid	 	= $stories['sid'];
$images 	= $stories['images'];
$title 		= $stories['title'];
$hometext 	= $stories['hometext'];
$bodytext 	= $stories['bodytext'];

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">NEWS&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	
	
echo"<form  action=\"".base_url()."index.php/news/saveeditstories/".$sid."\" method=\"post\" name=\"adminForm\" id=\"adminForm\" enctype=\"multipart/form-data\">";
echo"<input type=\"hidden\" name=\"author\" value=\"\"/>";	
echo"<input type=\"hidden\" name=\"source\" value=\"\"/>";	
echo"<table class=\"table\">";
echo"<tr><td width=\"40%\" valign=\"top\">";
	echo"<b>Tiêu đề:</b><input type=\"text\" name=\"subject\" size=\"50\" value=\"".$title."\"><br><br>";
echo"</td><td valign=\"top\">";
	echo $put_home;
echo"</td></tr>";

echo"<tr><td><b>Thuộc chủ đề:</b>";
	echo $show_edit_stories_section;
	echo $select_categories;
echo"</td><td><b>Ngôn ngữ:</b>";
	echo $select_language;
echo"</td></tr>";

echo"<tr><td>";
	echo $select_topic;
echo"</td><td><b>Hình ảnh</b>";
	
	if($images)
	{
		echo'<i class="fa fa-trash"></i><input name="delimg" type="checkbox" value="1" />';
		echo'<a href="'.base_url().'uploads/modules/news/'.$images.'">'.$images.'</a>';
	}
	echo '<input type="file" name="userfile" size="20" />';
echo"</td></tr>";

echo"<tr><td colspan=\"2\">";
	echo'<div id="xToolbar"></div>';
echo"</td></tr>";
echo"<tr><td colspan=\"2\">";
	draw_input("hometext",$hometext,"100%",200);
echo"</td></tr>";
echo"<tr><td colspan=\"2\">";
	draw_input("bodytext",$bodytext);
echo"</td></tr>";

echo"<tr><td colspan=\"2\">";
	echo'<input type="submit" name="OK" value="Save">';
echo"</td></tr>";

echo"</table>";
echo"</form>";

	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
