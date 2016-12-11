<?php
?>
<div class="col-lg-12 col-md-12">
<div class="panel panel-white">
<div class="panel-heading">
		<h4 class="panel-title">Config site&nbsp;</h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive project-stats">
			
					<div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Dropzone</h3>
                                </div>
                                <div class="panel-body">
                                <form action="<?php echo base_url(); ?>admin.php/Cauhinh/Upload" class="dropzone"  enctype="multipart/form-data">
</form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Plupload</h3>
                                </div>
                                <div class="panel-body">
                                    <?php
	$filename	= base_url()."uploads/logo/".$option10->option_value;
	$file_headers = @get_headers($filename);
	if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
		$img = base_url()."uploads/modules/pic/default.jpg";
	}else {
		$img = $filename;
	}
					echo'<img src="'.$img.'">';
									?>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
			
			</div>
		</div>
</div>
</div>	

