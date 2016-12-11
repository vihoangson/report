<?php
//print_r(get_defined_vars());
//echo lang('hello');

echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		<h4 class="panel-title">'.lang('_ADMINSITE').'</h4>
		
		
		<form action="'.base_url().'admin.php/Quanglykho/Search_Supplier" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div><!-- Input Group -->
        </form><!-- Search Form -->
		
		</div>';

	echo'<div class="panel-body">';
	echo'<div class="table-responsive project-stats"> ';
	
	echo'<div class="row" align="center"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><ul class="pagination">'.$link.'</ul></div></div>';
	
	echo'<table class="table">';
	echo'	<thead>
			<tr>
				<th>ID</th>
				<th>Mã</th>
                <th>Loại</th>
                <th>Doanh Ngiệp</th>
                <th>Điện Thoại</th>
                <th>Kích hoạt</th>
                <th><a href="'.base_url().'admin.php/quanglykho/suppliers_add"><i class="fa fa-user"></i></a>
                <a href="'.base_url().'admin.php/quanglykho/company_add"><i class="fa fa-users"></i></a></th>
   			</tr>
			</thead>
			<tbody>';
			foreach ($dssh as $ds) {
	echo'	<tr>
				<td>'.$ds["id"].'</td>
				<td>'.$ds["mva"].'</td>
				<td>'.$ds["pid"].'</td>
				<td>'.$ds["title"].'</td>
				<td>'.$ds["phone"].'</td>
				<td>';
					if($ds["active"] == "0"){
						echo '<a href="active0_1/'.$ds["id"].'"><i class="fa fa-lock"></i><a>';
					}
					if($ds["active"] == "1"){
						echo '<a href="active1_0/'.$ds["id"].'"><i class="fa fa-unlock"></i><a>';
					}
	echo 		'</td>
				<td>';
				if($ds["pid"] == "0"){
					echo '<a href="'.base_url().'admin.php/quanglykho/suppliers_edit/'.$ds["id"].'"><i class="fa fa-edit"></i></a>';	
				}else {
					echo '<a href="'.base_url().'admin.php/quanglykho/company_edit/'.$ds["id"].'"><i class="fa fa-edit"></i></a>';
				}
	echo '		| <a href="#" onclick="myFunction('.$ds['id'].')"><i class="fa fa-trash"></i></a>
				<div id="'.$ds['id'].'" style="display:none">
				<p>Bạn có muôn xóa nội dung này ???</p>
				<a href="delete_sup/'.$ds["id"].'"><button>Ok</button></a>
				<a href="'.base_url().'admin.php/quanglykho/nhacungcap"><button>Cancel</button></a>
				</div></td>
			</tr>';
			}
	echo'	</tbody>';
	echo'</table>';
	
	echo'<div class="row" align="center"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><ul class="pagination">'.$link.'</ul></div></div>';
	
	echo'</div>';
	echo'</div>';
	

echo'</div>';
echo'</div>';

?>

<script type="text/javascript">
//$(document).ready(function() {
	function myFunction(v) {
		$("#"+v).dialog();
		//$("#"+v).css("display","block");
	}
//});
</script>
