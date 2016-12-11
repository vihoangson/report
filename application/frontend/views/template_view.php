<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo'
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Laptop2nd</title>

<!-- Favicons Icon -->
<link rel="icon" href="'.base_url().'template/img/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="'.base_url().'template/img/favicon.ico" type="image/x-icon">

<!-- Mobile Specific -->
<meta name="viewport" con.tent="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSS Style -->
<link href="'.base_url().'template/css/style.css" rel="stylesheet">
<!-- Progress Bar CSS -->
<link href="'.base_url().'template/css/animate.css" rel="stylesheet">
<!--<style>
	@import url("'.base_url().'template/animate.css");
	@import url("'.base_url().'template/css/bootstrap.min.css");
	@import url("'.base_url().'template/css/font-awesome.css");
	@import url("'.base_url().'template/css/typography.css");
</style>-->
<link href="'.base_url().'template/css/offcanvas.css" rel="stylesheet">

<!-- Import Bootstrap core CSS -->
<link href="'.base_url().'template/css/cp-settings.css" rel="stylesheet">
<link rel="stylesheet" href="'.base_url().'template/css/ionicons.min.css">
<link rel="stylesheet" href="'.base_url().'template/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.css">


<!-- JavaScript --> 
<script src="'.base_url().'template/jquery-ui-1.12.1.custom/jquery-migrate.js.download"></script>
<script src="'.base_url().'template/jquery-ui-1.12.1.custom/jquery.min.js"></script>
<script src="'.base_url().'template/jquery-ui-1.12.1.custom/bootstrap.min.js"></script>
<script src="'.base_url().'template/jquery-ui-1.12.1.custom/offcanvas.js"></script>

<!-- Carousel -->
<link href="'.base_url().'template/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="'.base_url().'template/owl-carousel/owl.theme.css" rel="stylesheet">
<script src="'.base_url().'template/owl-carousel/owl.carousel.js"></script>
<script src="'.base_url().'template/owl-carousel/ajax.js"></script>
<script>
	__URL = "'.site_url().'";
</script>

<!-- Google Fonts -->
<link href="'.base_url().'fonts.googleapis.com/css-family=Open+Sans-300italic,400italic,600italic,700italic,800italic,300,700,800,400,600.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- Settings Panel -->';
$this->load->view('template_panel_view');
echo'<!-- End Settings Panel -->

<!--START PAGE-->
<div class="gt_wrapper">
	<!--start header-->';
	$this->load->view('template_header_view');
    echo'<!--end header-->
	<!--logo & search-->';
 	$this->load->view('template_search_view');
    echo'<!--end logo & search-->
	<section>
    <div class=" default_width">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">';
 				$this->load->view('template_menu_view');
    			echo'
                </div>
            	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                	<div class="ui-policy">
                    <a target="_blank" href="#" class="si nth1">Giao toàn Quốc</a>
                    <a target="_blank" href="#" class="si nth2">Miễn phí vận chuyển</a>
                    <a target="_blank" href="#" class="si nth3">Miễn phí cà thẻ VISA, MASTER, ATM</a>
                    </div>
                    <div class="ui-slide">';
 					$this->load->view('template_slide_view');
    				echo'
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!--end menu & slide-->';

	echo $content_for_layout;
	
	$this->load->view('template_footer_view');
echo'</div>
<!--END PAGE-->

</body>
</html>';

?>
