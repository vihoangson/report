<?php
$row = $stories[0];
$title 		= $row['title'];
$hometext 	= $row['hometext'];
$bodytext 	= $row['bodytext'];

echo'<div>
	<div class="category-title"><h1>'.$title.'</h1></div>

	<p>'.$hometext.'</p>
	<p>'.$bodytext.'</p>
</div>';
?>