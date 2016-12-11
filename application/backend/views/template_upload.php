<!DOCTYPE html>
<html>
<head>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="UTF-8">
<meta name="description" content="Admin Dashboard" />
<meta name="keywords" content="admin,dashboard" />
<meta name="author" content="Ta's crafts" />
<title>TẠ's crafts</title>

<!-- Styles -->
<link href="<?php echo base_url()."template/admin/css/css-family=Open+Sans-400,300,600.css";?>" rel='stylesheet' type='text/css'>
<link href="<?php echo base_url()."template/admin/css/pace-theme-flash.css"; ?>" rel="stylesheet"/>
<link href="<?php echo base_url()."template/admin/css/uniform.default.min.css"; ?>" rel="stylesheet"/>
<link href="<?php echo base_url()."template/admin/css/bootstrap.min.css"; ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()."template/admin/css/font-awesome.css"; ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()."template/admin/css/simple-line-icons.css"; ?>" rel="stylesheet" type="text/css"/>	
<link href="<?php echo base_url()."template/admin/css/menu_cornerbox.css"; ?>" rel="stylesheet" type="text/css"/>	
<link href="<?php echo base_url()."template/admin/css/waves.min.css"; ?>" rel="stylesheet" type="text/css"/>	
<link href="<?php echo base_url()."template/admin/css/switchery.min.css"; ?>" rel="stylesheet" type="text/css"/>	
<link href="<?php echo base_url()."template/admin/css/admin.css"; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()."template/admin/css/style.css"; ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()."template/admin/css/component-1.css"; ?>" rel="stylesheet" type="text/css"/>	
<link href="<?php echo base_url()."template/admin/css/dropzone.min.css"; ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()."template/admin/css/jquery.plupload.queue.css"; ?>" rel="stylesheet" type="text/css"/>

<!-- Theme Styles -->
<link href="<?php echo base_url()."template/admin/css/modern.min.css"; ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()."template/admin/css/green.css"; ?>" class="theme-color" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()."template/admin/css/custom.css"; ?>" rel="stylesheet" type="text/css"/>
        
<script src="<?php echo base_url()."template/admin/scripts/modernizr.js"; ?>"></script>
<script src="<?php echo base_url()."template/admin/scripts/snap.svg-min.js"; ?>"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="html5shiv.min.js" tppabs="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="respond.min.js" tppabs="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<!-- FCKEDITOR-->
<!--<script src="<?php echo base_url()."template/admin/ckeditor/ckeditor.js"?>"></script>
<script src="<?php echo base_url()."template/admin/ckeditor/samples/js/sample.js"?>"></script>
<link rel="stylesheet" href="<?php echo base_url()."template/admin/ckeditor/samples/css/samples.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."template/admin/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css"?>">-->


</head>


<body class="page-header-fixed">
	<main class="page-content content-wrap">
    
    <?php
	//print_r(get_defined_vars());
	if(empty($l['aid']))
	{
		echo $content_for_layout;	
	}
	else
	{
		
	
		$this->load->view('navbar_view', $l);
				
		$this->load->view('sidebar_view', $l); 
		
		echo'<div class="page-inner">';
					
					$this->load->view("pagetitle_view", $p);
					
					echo'<div id="main-wrapper">';
					echo $content_for_layout;
					echo'</div>';
					
					$this->load->view("footer_view");
					
		echo'</div>';
	}
	?>
    
    
	

    <!-- Javascripts -->
    <script>
	initSample()
	</script>
    <script src="<?php echo base_url()."template/admin/scripts/jquery-2.1.4.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/jquery-ui.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/bootstrap.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/pace.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/jquery.blockui.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/jquery.slimscroll.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/switchery.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/jquery.uniform.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/classie.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/main.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/waves.min.js"; ?>" ></script>
    <script src="<?php echo base_url()."template/admin/scripts/main-1.js"; ?>" ></script>
    	<script src="<?php echo base_url()."template/admin/scripts/dropzone.min.js"; ?>"></script>
        <script src="<?php echo base_url()."template/admin/scripts/plupload.full.min.js"; ?>"></script>
        <script src="<?php echo base_url()."template/admin/scripts/jquery.plupload.queue.min.js"; ?>"></script>
        <script src="<?php echo base_url()."template/admin/scripts/modern.min.js"; ?>"></script>
        <script src="<?php echo base_url()."template/admin/scripts/form-plupload.js"; ?>"></script>
    
    <script src="<?php echo base_url()."template/admin/scripts/dashboard.js"; ?>"></script>
    <script src="<?php echo base_url()."template/admin/scripts/joomla.javascript.js"; ?>"></script>
    <script src="<?php echo base_url()."template/admin/scripts/javascript.js"; ?>"></script>
	</main>   
</body>
</html>
