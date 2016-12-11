<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$categories = $this->SHOP_Model->ShopAllCategories();

$cha= array();
$pt=0;
for ($i=0; $i<sizeof($categories); $i++)
{
	if($categories[$i]['pid']=='0'){
		$cha[$pt] = $categories[$i];
		for ($j=0; $j<sizeof($categories); $j++)
		{
			if($categories[$j]['pid']==$categories[$i]['mva']){
				$cha[$pt]['flag'] = true;
			}else{$cha[$pt]['flag'] = false;}
		}
		$pt++;
	}
}

$mod = $this->uri->segment(1);		
if($mod=="" || $mod=='Welcome'){
	$class='class="ui-menu-categories"';
}else{
	$class='class="ui-hmenu-categories"';
}

echo'
	<ul '.$class.'>
	<li>DANH MỤC SẢN PHẨM<i class="fa fa-bars"></i></li>';
	for($c=0; $c < sizeof($cha); $c++)
	{
		echo'<li class="h">
        <span><img src="'.base_url().'uploads/modules/categories/'.$cha[$c]['icon'].'"></span>
        <a href="'.base_url().'index.php/shop/module/'.$cha[$c]['mva'].'">'.$cha[$c]['title'].'<i class="fa fa-angle-right hidden-xs"></i></a>';
		
		if($cha[$c]['flag']==true)
		{
			echo'<ul>';
			for($n=0; $n < sizeof($categories); $n++)
			{
				
				if($categories[$n]['pid'] == $cha[$c]['mva']){ 
					
					echo'<li><span><img src="'.base_url().'uploads/modules/categories/'.$categories[$n]['icon'].'"></span>
			<a href="'.base_url().'index.php/shop/category/'.$cha[$c]['mva'].'">'.$categories[$n]['title'].'<i class="hidden-xs"></i></a></li>';
				}
			}
			echo'</ul>';
		}
        echo'</li>';
	}
echo'</ul>';


?>