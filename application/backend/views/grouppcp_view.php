<?php
if(sizeof($cid))
{	
	$selected="";
	echo'<select name="pid" class="js-states form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">';
	echo'<option value="0" '.$selected.'>Chủ đề chính</option>';
	foreach($cid as $v)
	{
		if($cselect!=0 && $cselect==$v['mva'])
			$selected="selected";
		else
			$selected="";
		if($v['pid']==0)
		{
			echo'<option value="'.$v['mva'].'" '.$selected.'>'.$v['title'].'</option>';
		}
		echo'</optgroup>';
	}
	echo'</select>';
}
	
?>
