<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data = $this->SHOP_Model->ShopModuleParent();
echo'
<div class="side-nav-categories">
	<div class="block-title"> '.lang('_CATEGORIES').' </div>
    <!--block-title--> 
    <!-- BEGIN BOX-CATEGORY -->
    <div class="box-content box-category">
    <ul>';
		foreach($data as $value)
		{
    		echo'<li> <a href="'.base_url().'index.php/shop/module/'.$value['cid'].'"> '.ucwords(strtolower($value['title'])).' </a> ';
			$datachild = $this->SHOP_Model->ShopModuleChild($value['cid']);
			if(sizeof($datachild))
			{
				echo'<span class="subDropdown plus"></span>';
				echo'<ul class="level1">';
            	foreach($datachild as $valuechild)
				{
                echo'<li> <a href="'.base_url().'index.php/shop/module/'.$valuechild['cid'].'"> '.ucwords($valuechild['title']).' </a> <span class="subDropdown plus"></span> </li>';
				}
				echo'</ul>';
			}
			echo'</li>';
		}
	echo'</ul>
    </div>
    <!--box-content box-category--> 
</div>';