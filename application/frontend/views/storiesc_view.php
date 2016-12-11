<?php
echo'<div class="category-title"><h1>'.$title[0]['title'].'</h1></div>';

echo'<div class="pager"><div class="pages"><ul class="pagination">'.$link.'</ul></div></div>';

echo'<ol id="products-list" class="products-list">';
foreach($stories as $key => $value)
{
		$img	=	$value['images'];
		if(!file_exists(FCPATH."uploads/modules/news/".$img) || $img=="")
		{
			$img = 'default.jpg';
		}
		else
		{
			$img = $img;
		}		
	echo'<li class="item odd">
                <div class="product-image"> <a href="'.base_url().'index.php/'.$modulename.'/detail/'.$language.'/'.$value['catid'].'/'.$value['sid'].'" title="#"> <img class="small-image" src="'.base_url().'uploads/modules/news/'.$img.'" alt="#" width="230"> </a> </div>
                <div class="product-shop">
                  <h2 class="product-name"><a title="'.$value['title'].'" href="'.base_url().'index.php/'.$modulename.'/detail/'.$language.'/'.$value['catid'].'/'.$value['sid'].'"> '.$value['title'].' </a></h2>
                 
                  <div class="desc std">
                    '.$value['hometext'].'... <a class="link-learn" title="" href="'.base_url().'index.php/'.$modulename.'/detail/'.$language.'/'.$value['catid'].'/'.$value['sid'].'">'.lang('_DETAIL').'</a> </p>
                  </div>
                </div>
              </li>';
}
echo'</ol>';
?>