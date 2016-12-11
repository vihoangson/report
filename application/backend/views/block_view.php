<?php
//print_r(get_defined_vars());


echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">BLOCKS MANAGER</h4>
		</div>';

	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	echo'<div class="text-right" colspan="5">
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
		<a class="btn btn-default m-r-sm" data-toggle="tooltip" data-placement="top" title="Add" href="'.base_url().'index.php/block/ablock"><i class="fa fa-plus"></i></a>
		<div class="btn-group m-r-sm mail-hidden-options">
			<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Delete" id="adap"><i class="fa fa-trash"></i></a>
		</div>
    </div>';
	echo'<div class="table-responsive project-stats"> ';
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th>Title</th>
				<th>Position</th>
                <th>Type</th>
                <th>Status</th>
                <th>Display area</th>
				<th>Functions</th>
			</tr>
			</thead>
			<tbody>';
	foreach($blocks as $block) {
	    $bid 				= $block['bid'];
	    $bkey 				= intval($block['bkey']);
	    $title				= $block['title'];
	    $url 				= $block['url'];
	    $bposition 			= $block['bposition'];
	    $weight 			= $block['weight'];
	    $active 			= $block['active'];
	    $blockfile 			= $block['blockfile'];
	    $view 				= $block['view'];
	    $link 				= $block['link'];
	    $module 			= $block['module'];
	   
	    $weight3 			= intval($block['weight']);
		$amodule			= explode('|',$module);
		
		
		echo"<tr>
			<td>".$title."</td>";
			if ($bposition == "l") {
			$bposition = "Left";
			} elseif ($bposition == "r") {
			$bposition = "Right";
			} elseif ($bposition == "c") {
			$bposition = "Left 2";
			} elseif ($bposition == "d") {
			$bposition = "Right 2";
			}
		echo"<td>".$bposition."</td>";
			if($bkey == "3"){
				$type = "Type";
			}elseif ($bkey == "2") {
				$type = "RSS/RDF";
			} elseif ($bkey == "1") {
				$type = "HTML";
			} else {
				$type = "File";
			}
		echo"<td>".$type."</td>";
		if ($active == 1) {
		$active = "<i class=\"fa fa-unlock\"></i>Active";
		$change = "<i class=\"fa fa-lock\"></i>";//Deactive
	    } elseif ($active == 0) {
		$active = "<i class=\"fa fa-lock\"></i><i>Inactive</i>";
		$change = "<i class=\"fa fa-unlock\"></i>";//Active
	    }
		echo"<td>$active</td>";
		$amodule= explode('|',$module);
	  	$display_area="";
	 	if (in_array("home",$amodule))
	 	{
	    	$display_area = "Home";	 
		 }elseif  (in_array("all",$amodule)){ 
			$display_area = "All";	 
		 }elseif (in_array("acp",$amodule)){ 
			$display_area = "Administrator Control Panel";	
		 }else{
	 
			$n=count($amodule);
			$strmodule="";
			for($i=0;$i<$n;$i++)
			{
				$strmodule.="'".$amodule[$i]."'";
				if($i<$n-1)	
					$strmodule.=",";
			} 

			$resultmod = $this->Module_model->GetModulesWhere($strmodule);
			foreach($resultmod as $rowmod)
			{
					$display_area .= $rowmod['title'];
			}
        }  
		echo"<td>".$display_area."</td>";
		echo"<td>
		<a href=\"".base_url()."index.php/block/eblock/".$bid."\"><i class=\"fa fa-edit\"></i></a>
		<a href=\"#\" onclick=\"myFunction('".$bid."')\"><i class=\"fa fa-trash\"></i></a>
		<a href=\"".base_url()."index.php/block/status/".$bid."\">$change</a>
		
		<div id=\"".$bid."\" style=\"display:none\">
			Bạn có muốn xóa block này: <a class=\"waves-effect waves-button waves-classic\" href=\"".base_url()."index.php/block/dblock/".$bid."\"> Yes</a> - <a class=\"waves-effect waves-button waves-classic\" href=\"#\" onclick=\"myFunctionClose('".$bid."')\"> No </a>
		</div>
		
		</td>
		</tr>";
	}
	echo'	</tbody>';
	echo'</table>';
	echo'</div>';
	echo'</div>';
	

echo'</div>';
echo'</div>';

?>
