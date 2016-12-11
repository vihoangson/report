<?php
//print_r(get_defined_vars());


echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">ADD BLOCKS</h4>
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
	
	echo"<form action=\"".base_url()."index.php/block/saveablock\" method=\"post\">";
	echo"<table border=\"0\" class=\"table\">";
	echo"<tr><td>Title:</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\"></td></tr>";
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
				$res = $this->Block_model->GetBlocksWhere($bli);
				if(sizeof($res)==0){
				echo "<option name=\"blockfile\" value=\"".$bli."\">".$bl."</option>";
				}
			}
		}
		echo "</select>&nbsp;&nbsp;</td></tr>";
	} 
	echo "<tr><td>Position:</td><td><select name=\"bposition\"><option name=\"bposition\" value=\"l\">Left</option>"
	    ."<option name=\"bposition\" value=\"c\">Left 2</option>"
	    ."<option name=\"bposition\" value=\"d\">Right 2</option>"
	    ."<option name=\"bposition\" value=\"r\">Right</option></select></td></tr>";
	echo "<tr><td>Active</td><td><input type=\"radio\" class=\"no-uniform\" name=\"active\" value=\"1\" checked>Yes &nbsp;&nbsp;"
	    ."<input type=\"radio\" class=\"no-uniform\" name=\"active\" value=\"0\">No</td></tr>";
	/*echo"<tr><td>Expiration:</td><td><input type=\"text\" name=\"expire\" size=\"4\" maxlength=\"3\" value=\"0\"> days</td></tr>"
	."<tr><td>After expiration:</td><td><select name=\"action\">"
	."<option name=\"action\" value=\"d\">Deactive</option>"
	."<option name=\"action\" value=\"r\">Delete</option></select></td></tr>";*/
	echo "<tr valign=\"top\">\n<td><b>Display area: </b></td>\n<td>";

  	    echo "<table border=\"0\"><tr>\n";
  	    echo "<td><input type=\"checkbox\" name=\"module[]\" value=\"all\"> All</td>\n"
  	    /*."<td><input type=\"checkbox\" name=\"module[]\" value=\"home\"> Home </td>\n"*/
	    ."</tr>\n";
  	    echo "<tr>\n";
  		$resultmod = $this->Module_model->GetModules();
   		$a=1;
		
   	    foreach ($resultmod as $row) {
			$title = $row['title'];
			$custom_title = $row['title'];
           
            echo "<td><input type=\"checkbox\" name=\"module[]\" value=\"$title\">$custom_title</td>\n";
			
                if (($a%2==0)) { echo"</tr><tr>";  }
                       $a++;
		}
        echo"</td>\n</tr>\n"
	    //Het chon khu vuc hien thi
	    ."</table><br><br>";
		
	
	echo "</table>";
	echo "<input type=\"submit\" value=\"Create block\"></form>";

	echo'</div>';
	

echo'</div>';
echo'</div>';

?>
