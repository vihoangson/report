<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mod = $this->uri->segment(1);

if($mod=="" || $mod=='Welcome'){
echo' <!-- banner -->
<div id="owl-demo" class="owl-carousel owl-theme">';

if(sizeof($slide)!=0){
	for($i=0; $i<sizeof($slide); $i++)	
	{
  		echo'<div class="item"><img src="'.base_url().'uploads/logo/'.$slide[$i]['icon'].'" alt="The Last of us"></div>';
	}
}
 
echo'</div>';
}

?>