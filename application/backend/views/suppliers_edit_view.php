<?php
//print_r($sup);
echo'<div class="col-lg-12 col-md-12">';
echo'<div class="panel panel-white">';
echo'	<div class="panel-heading">
		
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			<form method="post" action="'.base_url().'admin.php/quanglykho/suppliers_update/'.$sup->id.'" enctype="multipart/form-data">
			<table class="table">
				<tr><td>Tên nhà cung cấp: </td><td><input type="text" name="title" class="form-control" value="'.$sup->title.'" required></td></tr>
				<tr><td>Mã nhà cung cấp: </td><td><input type="text" name="mva" class="form-control" value="'.$sup->mva.'" required></td></tr>
				<tr><td>SĐT liên hệ: </td><td><input type="number" name="phone" value="'.$sup->phone.'" class="form-control" required></td></tr>
				<tr><td>Email: </td><td><input type="Email" name="email" value="'.$sup->email.'" class="form-control" required></td></tr>
				<tr><td>Mã số thuế: </td><td><input type="number" name="numtax" value="'.$sup->numtax.'" class="form-control" required></td></tr>
				<tr><td>Cá nhân/tổ chức</td><td><Select name="pid">
					<option value="0">Cá nhân</option>
				<Select></td></tr>
				<tr><td colspan="2"><h3>DÀNH CHO CÁ NHÂN</h3></td></tr>
				<tr><td>Số CMND: </td><td><input type="number" name="CMND" value="'.$sup->CMND.'" class="form-control" required></td></tr>
				<tr><td>Thành Phố: </td><td><select name="city" class="btncity">';
					foreach ($dstp as $ds){
						if($ds["pid"] == "0" && $ds["mva"] == $sup->city){
							echo '<option value="'.$ds["mva"].'" selected> '.$ds["title"].' </option>';	
						}
						if($ds["pid"] == "0" && $ds["mva"] != $sup->city)
						{
							echo '<option value="'.$ds["mva"].'" > '.$ds["title"].' </option>';	
						}
					}	
echo '				</select></td></tr>
				<tr><td>Quận/Huyện: </td><td><select name="Ward" class="btnward"><option value="0">Chọn quận/huyện</option>';
					foreach ($dstp as $ds){
						if($ds["pid"] != "0" && $ds["mva"] == $sup->ward){
							echo '<option value="'.$ds["mva"].'" selected>'.$ds["title"].'</option>';	
						}
						if($ds["pid"] != "0" && $ds["mva"] != $sup->ward){
							echo '<option value="'.$ds["mva"].'">'.$ds["title"].'</option>';	
						}
					}	
echo '				</select></td></tr>
				<tr><td>Địa chỉ: </td><td><input type="text" name="address" value="'.$sup->address.'" class="form-control" required></td></tr>
				
				<tr><td colspan="2"><h3>THÔNG TIN NGÂN HÀNG</h3></td></tr>
				<tr><td>Ngân hàng: </td><td><input type="text" name="bank" value="'.$sup->bank.'" class="form-control"></td></tr>
				<tr><td>Chi nhánh: </td><td><input type="text" name="branch" value="'.$sup->branch.'" class="form-control"></td></tr>
				<tr><td>Số tài khoản: </td><td><input type="text" name="numbank" value="'.$sup->numbank.'" class="form-control"></td></tr>
				<tr><td>Số chủ tài khoản: </td><td><input type="text" name="namebank" value="'.$sup->namebank.'" class="form-control"></td></tr>
				<tr><td>Ghi chú: </td><td><textarea rows="3" cols="70" name="description" >'.$sup->description.'</textarea></td></tr>
				<tr><td colspan="2"><input type="submit" value="Upload" class="btn btn-success">&nbsp;
						<a href="'.base_url().'admin.php/quanglykho/nhacungcap"><input class="btn btn-success" value="Cancel"></a></td></tr>
			</table>
			</form>
			</div>
		</div>';
echo'</div>';
echo'</div>';
	
?>