<?php
//print_r(get_defined_vars());

$bid			= $block[0]['bid'];
$bkey			= $block[0]['bkey'];
$title			= $block[0]['title'];
$url			= $block[0]['url'];
$bposition		= $block[0]['bposition'];
$weight			= $block[0]['weight'];
$active			= $block[0]['active'];
$refresh		= $block[0]['refresh'];
$blanguage		= $block[0]['blanguage'];
$blockfile		= $block[0]['blockfile'];
$view			= $block[0]['view'];
$expire			= $block[0]['expire'];
$action			= $block[0]['action'];
$link			= $block[0]['link'];
$module			= $block[0]['module'];

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">EDIT BLOCKS</h4>
		</div>';

	echo'<div class="panel-body">';
	
	echo "<a name='add'></a>";
	
	if(!isset($tip) || $tip=="") {
		echo "<center><form action=\"".base_url()."index.php/block/ablock#add\" method=\"POST\"><select name=\"tip\">";
		$tip_ar = array('File', 'HTML', 'RSS/RDF', 'Type');
		echo "<option value=\"\">Choose type</option>\n";
		for ($i=0; $i < sizeof($tip_ar); $i++) {
			echo "<option value=\"$i\">".ucfirst($tip_ar[$i])."</option>\n";
		}
		echo "</select>";
		echo "<input type=\"submit\" value=\"Add\"></form></center><br><br>";
	}
	if($tip!='1' AND $tip!='2' AND $tip!='3') { $tip='0'; }
	
	/************************************************************************
	*Code add block here
	************************************************************************/
	
	echo"<form action=\"".base_url()."index.php/block/saveeblock/".$bid."\" method=\"post\">";
	echo"<table border=\"0\" class=\"table\">";
	echo"<tr><td>Title:</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\" value=\"".$title."\"></td></tr>";
	if($tip==0) {
		echo "<tr><td>File name:</td><td>";
		echo "<select name=\"blockfile\" tabindex=\"-1\" aria-hidden=\"true\">";
		echo "<option name=\"blockfile\" selected>None</option>";
		
		foreach($blockslist as $bli)
		{
			if($bli!="") {
				$bl = ereg_replace("block-","",$bli);
				$bl = ereg_replace(".php","",$bl);
				$bl = ereg_replace("_view","",$bl);
				$res = $this->Block_model->GetBlocksWhere3($bli, $blockfile);
				if(sizeof($res)==0){
				echo "<option name=\"blockfile\" value=\"".$bli."\" ";
				if ($blockfile == $bli) { echo "selected"; }
				echo ">".$bl."</option>";
				}
			}
		}
		echo "</select>&nbsp;&nbsp;</td></tr>";
	} 
	
	$pos_array = array("l","c","r","d");
    $posname_array = array("Left","Left 2","Right","Right 2");
	echo "<tr><td>Position:</td><td><select name=\"bposition\">";
	for($pc=0;$pc < sizeof($pos_array);$pc++) {
    	echo "<option name = \"bposition\" value=\"$pos_array[$pc]\"";
    	if($bposition== "$pos_array[$pc]") { echo " selected"; }
    	echo ">$posname_array[$pc]</option>\n";
    }
	echo "</select></td></tr>";
	if ($active == 1) {
	echo "<tr><td>Active</td><td><input type=\"radio\" class=\"no-uniform\" name=\"active\" value=\"1\" checked>Yes &nbsp;&nbsp;"
	    ."<input type=\"radio\" class=\"no-uniform\" name=\"active\" value=\"0\">No</td></tr>";
	}else{
	echo "<tr><td>Active</td><td><input type=\"radio\" class=\"no-uniform\" name=\"active\" value=\"1\">Yes &nbsp;&nbsp;"
	    ."<input type=\"radio\" class=\"no-uniform\" name=\"active\" value=\"0\"  checked>No</td></tr>";
	}
	/*echo"<tr><td>Expiration:</td><td><input type=\"text\" name=\"expire\" size=\"4\" maxlength=\"3\" value=\"0\"> days</td></tr>"
	."<tr><td>After expiration:</td><td><select name=\"action\">"
	."<option name=\"action\" value=\"d\">Deactive</option>"
	."<option name=\"action\" value=\"r\">Delete</option></select></td></tr>";*/
	echo "<tr valign=\"top\">\n<td><b>Display area: </b></td>\n<td>";
		
		if ($module == ""){ $module = "all"; }
	    $mod_array = array("all");
	    $mod_array2 = array("All");
  	    echo "<table border=\"0\"><tr>\n";
  	    for($mo=0;$mo < sizeof($mod_array);$mo++) {
			echo "<td><input type=\"checkbox\" name=\"module[]\" value=\"$mod_array[$mo]\"";
	    	if($module == "$mod_array[$mo]") { echo " checked"; }
	    	echo"> $mod_array2[$mo]</td>\n";
		}
  	    echo "<tr>\n";
  		$resultmod = $this->Module_model->GetModules();
   		$a=1;
		$amodule=explode('|',$module);
		
   	    foreach ($resultmod as $row) {
			$title = $row['title'];
			$custom_title = $row['title'];
            if(in_array($title,$amodule))
			{ 
            echo "<td><input type=\"checkbox\" name=\"module[]\" value=\"$title\"  checked=\"checked\">$custom_title</td>\n";
			}
			else
			{
			echo "<td><input type=\"checkbox\" name=\"module[]\" value=\"$title\">$custom_title</td>\n";
			}
                if (($a%2==0)) { echo"</tr><tr>";  }
                       $a++;
		}
        echo"</td>\n</tr>\n"
	    //Het chon khu vuc hien thi
	    ."</table><br><br>";
		
	
	echo "</table>";
	echo "<input type=\"submit\" value=\"Save block\"></form>";

	echo'</div>';
	

echo'</div>';
echo'</div>';

?>
