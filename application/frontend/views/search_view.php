<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data = $this->SHOP_Model->ShopModuleParent();

echo'
			<!-- Search-col -->
          	<div class="search-box">
            <form action="'.base_url().'index.php/search/index/" method="POST" id="search_mini_form" name="Categories">
			<select name="category_id" class="cate-dropdown hidden-xs">
				<option value="0">'.lang('_CHOOSECATEGORIES').'</option>';
				foreach($data as $value)
				{
                echo'<option value="'.$value['cid'].'">'.$value['title'].'</option>';
				}
echo'		</select>
			<input type="text" placeholder="'.lang('_LOOKINGFOR').'" value="" maxlength="70" class="" name="search" id="search">
			<button id="submit-button" class="search-btn-bg"><span>'.lang('_SEARCH').'</span></button>
            </form>
          	</div>
          	<!-- End Search-col -->';


?>