<?php
echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

echo'<ol id="products-list" class="products-list">';
foreach($list as $key => $value)
{
		$img	=	$value['images'];
		if(!file_exists(FCPATH."uploads/modules/pic/".$img) || $img=="")
		{
			$img = 'default.jpg';
		}
		else
		{
			$img = $img;
		}		
	echo'<li class="item odd">
                <div class="product-image"> <a href="'.base_url().'index.php/shop/detail/'.$language.'/'.$value['cid'].'/'.$value['pid'].'" title="#"> <img class="small-image" src="'.base_url().'uploads/modules/pic/'.$img.'" alt="#" width="230"> </a> </div>
                <div class="product-shop">
                  <h2 class="product-name"><a title=" Sample Product" href="'.base_url().'index.php/shop/detail/'.$language.'/'.$value['cid'].'/'.$value['pid'].'"> '.$value['title'].' </a></h2>
                 
                  <div class="desc std">
                    '.$value['hometext'].'... <a class="link-learn" title="" href="'.base_url().'index.php/shop/detail/'.$language.'/'.$value['cid'].'/'.$value['pid'].'">'.lang('_DETAIL').'</a> </p>
                  </div>
                </div>
              </li>';
}
echo'</ol>';
?>