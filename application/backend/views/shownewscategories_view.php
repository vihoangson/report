<?php
//print_r(get_defined_vars());
//echo lang('hello');

	echo "<table width=\"100%\" border=\"0\"  style=\"padding-left:20px;\">";
	for($i=0;$i<count($cat);$i++)
	{
		$catid		=		$cat[$i]['catid'];
		$title		=		$cat[$i]['title'];
		$weight		=		$cat[$i]['weight'];
		
		$child 		=	$this->News_model->getSubNewsCategories($catid);
		 echo "<tr><td height=\"30\" width=\"70%\"><a href=\"#\">".$title."</a></td> <td height=\"30\" width=\"10%\">
		 <form action=\"".base_url()."index.php/news/setweightcategories/".$catid."\" method=\"post\">
			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			<tr><td>
			<input type=\"text\" name=\"weight\" value=\"".$weight."\" size=\"1\" />
			</td><td width=\"3%\">
			<input type=\"hidden\" name=\"xxcat\" value=\"".$catid."\" />
			<input type=\"submit\" name=\"Submit\" value=\"Set\" />
			</td></tr></table>
			</form></td> <td height=\"30\" align=\"right\">
				<a href=\"".base_url()."index.php/news/editnewscategories/".$catid."\"><i class=\"fa fa-edit\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$catid."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$catid."\" style=\"display:none\">
				Bạn có muốn xóa nhóm tin này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/news/deletenewscategories/".$catid."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$catid."')\"> No </a>
				</div></td></tr>";
			echo "<tr><td  height=\"1\" bgcolor=\"#CCCCCC\" colspan=\"3\"></td></tr>";	
		
		if(sizeof($child)) //child
		{
		  	foreach($child as $c){
		   	echo "<tr><td height=\"30\" width=\"70%\"><a href=\"#\">--&raquo;".$c['title']."</a></td> <td height=\"30\" width=\"10%\">
		 <form action=\"#\" method=\"post\">
			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			<tr><td>
			<input type=\"text\" name=\"weight\" value=\"".$c['weight']."\" size=\"1\" />
			</td><td width=\"3%\">
			<input type=\"hidden\" name=\"xxcat\" value=\"".$c['catid']."\" />
			<input type=\"submit\" name=\"Submit\" value=\"Set\" />
			</td></tr></table>
			</form></td> <td height=\"30\" align=\"right\">
				<a href=\"".base_url()."index.php/news/editnewscategories/".$c['catid']."\"><i class=\"fa fa-edit\"></i></a>
				<a href=\"#\" onclick=\"myFunction('".$c['catid']."')\"><i class=\"fa fa-trash\"></i></a>
				<div id=\"".$c['catid']."\" style=\"display:none\">
				Bạn có muốn xóa nhóm tin này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/news/deletenewscategories/".$c['catid']."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$c['catid']."')\"> No </a>
				</div></td></tr>";
			echo "<tr><td  height=\"1\" bgcolor=\"#CCCCCC\" colspan=\"3\"></td></tr>";	
			}
		}
	 }
	  echo "</table>";

?>
	