<?php
defined('BASEPATH') OR exit('No direct script access allowed');


echo'	
    <!-- breadcrumbs -->
  	<div class="breadcrumbs">
    	<div class="container">
      		<div class="row">
        		<ul>';
				$i=0;
				foreach($links as $key=>$value)
				{
          		echo'<li class="home"> <a href="'.$value.'" title="Go to Home Page">'.$key.'</a>';
				if($i<sizeof($links)-1){echo'<span>&mdash;›</span>';}
				echo'</li>';
				$i++;
				}
        		echo'</ul>
      		</div>
    	</div>
  </div>
  <!-- End breadcrumbs --> ';