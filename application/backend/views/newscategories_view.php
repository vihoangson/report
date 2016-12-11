<?php
$lang = $this->Global_Model->lingua();
echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">NEWS CATEGORIES&nbsp;</h4><br>
		</div>';
	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	
	
echo"<form  action=\"".base_url()."index.php/news/savecategories\" method=\"post\" name=\"adminForm\" id=\"adminForm\">";
echo"<table class=\"table\">";
echo"<tr><td width=\"40%\" valign=\"top\">";
echo"	<table width=\"50%\" border=\"0\"  style=\"padding-left:20px;\">";

	  for($i=0;$i<count($lang); $i++)
	  {
			echo "<tr>
			<td height=\"30\"><img src=\"".base_url()."images/".$lang[$i]['flag']."\" /></td>
			<td> <input name=\"txttitle[]\" type=\"text\" size=\"40\" /><input name=\"lang[]\" type=\"hidden\" value=\"".$lang[$i]['lang_id']."\" /></td>
			</tr>";	
		
	  }	
	  
echo"	</table>";
echo"</td><td valign=\"top\">";
echo"	<table width=\"100%\" border=\"0\"  style=\"padding-left:20px;\">";
echo"	<tr><td height=\"30\" width=\"150\">Thuộc chủ đề:</td><td>";
		echo $show_stories_category;
echo"	</td></tr>";
echo"	<tr><td height=\"30\">Đưa lên trang chủ</td><td>";
		echo $show_stories_ihome;
echo"	</td></tr>";
echo"	<tr><td height=\"30\"></td><td colspan=\"2\"><input type=\"submit\" name=\"Submit\" value=\"Save\" /></td></tr>";

echo"	</table>";
echo"</td></tr>";
echo"</table>";
echo"</form>";


echo $display_stories_category;

	echo'</div>';
	echo'</div>';

echo'</div>';
echo'</div>';

?>
