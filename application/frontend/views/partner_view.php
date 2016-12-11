<?php
if(sizeof($partner))
{

$row = $partner[0];
$title 		= $row['title'];
$hometext 	= $row['hometext'];
$bodytext 	= $row['bodytext'];
$img	 	= $row['images'];

if(!file_exists(FCPATH."uploads/modules/news/".$img) || $img=="")
{
	$img = 'default.jpg';
}
else
{
	$img = $img;
}		
echo'<div>
	<p><img src="'.base_url().'uploads/modules/news/'.$img.'" class="zoomImg" style="width: 100%; height: 300px; border: none; max-width: none;"></p>
	<h1 align="center">'.$title.'</h1>

	<p>'.$hometext.'</p>
	<p>'.$bodytext.'</p>
</div>';

}
?>