<?php
if(sizeof($cid))
{	
	echo'<select name="cid" class="js-states form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">';
	foreach($cid as $v)
	{
		if($cselect!=0 && $cselect==$v['cid'])
			$selected="selected";
		else
			$selected="";
		
		if($v['parentid']==0)
		{	
			echo'<optgroup label="'.$v['title'].'">';
			echo'<option value="'.$v['cid'].'" '.$selected.'>'.$v['title'].'</option>';
			foreach($cid as $va)
			{
				if($cselect!=0 && $cselect==$va['cid'])
					$selected="selected";
				else
					$selected="";
				if($va['parentid']==$v['cid'])
				{
					echo'<option value="'.$va['cid'].'" '.$selected.'>&raquo;'.$va['title'].'</option>';
				}
			}
			echo'</optgroup>';
		}
		
	}
	echo'</select>';
}
	
?>
