<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


	/*--- 
	*FORMAT
	*/
	function numberformat($number=0,$decimals=0,$dec_point=",",$thousands_sep=".")
	{
		return number_format($number, $decimals, $dec_point, $thousands_sep); 
	}
	
	function datefortmat ( $format="d-F-Y" , $timestamp = 0 )
	{
		return date ( format , strtotime($timestamp));
	}
	
	function rewrite($str)
	{
		   //return '';
		$str_convert=array(
		   'á'=>'a',
		   'à'=>'a',
		   'ả'=>'a',
		   'ã'=>'a',
		   'ạ'=>'a',
		   
		   'Á'=>'A',
		   'À'=>'A',
		   'Ả'=>'A',
		   'Ã'=>'A',
		   'Ạ'=>'A',
		   
		   
		   'â'=>'a',
		   'ấ'=>'a',
		   'ầ'=>'a',
		   'ẩ'=>'a',
		   'ẫ'=>'a',
		   'ậ'=>'a',
		   
		   'Â'=>'A',
		   'Ấ'=>'A',
		   'Ầ'=>'A',
		   'Ẩ'=>'A',
		   'Ẫ'=>'A',
		   'Ậ'=>'A',
		   
		   'ă'=>'a',
		   'ắ'=>'a',
		   'ằ'=>'a',
		   'ẳ'=>'a',
		   'ẵ'=>'a',
		   'ặ'=>'a',
		   
		   'Ă'=>'A',
		   'Ắ'=>'A',
		   'Ẳ'=>'A',
		   'Ẵ'=>'A',
		   'Ặ'=>'A',
		   
		   'é'=>'e',
		   'è'=>'e',
		   'ẻ'=>'e',
		   'ẽ'=>'e',
		   'ẹ'=>'e',
		   
		   'É'=>'E',
		   'È'=>'E',
		   'Ẻ'=>'E',
		   'Ẽ'=>'E',
		   'Ẹ'=>'E',
		   
		   'ê'=>'e',
		   'ế'=>'e',
		   'ề'=>'e',
		   'ể'=>'e',
		   'ễ'=>'e',
		   'ệ'=>'e',
		   
		   'Ê'=>'E',
		   'Ế'=>'E',
		   'Ề'=>'E',
		   'Ể'=>'E',
		   'Ễ'=>'E',
		   'Ệ'=>'E',
		   
		   'ó'=>'o',
		   'ò'=>'o',
		   'ỏ'=>'o',
		   'õ'=>'o',
		   'ọ'=>'o',
		   
		   'Ó'=>'O',
		   'Ò'=>'O',
		   'Ỏ'=>'O',
		   'Õ'=>'O',
		   'Ọ'=>'O',
		   
		   'ô'=>'o',
		   'ố'=>'o',
		   'ồ'=>'o',
		   'ổ'=>'o',
		   'ỗ'=>'o',
		   'ộ'=>'o',
		   
		   'Ô'=>'O',
		   'Ố'=>'O',
		   'Ồ'=>'O',
		   'Ổ'=>'O',
		   'Ỗ'=>'O',
		   'Ộ'=>'O',
		   
		   'ơ'=>'o',
		   'ớ'=>'o',
		   'ờ'=>'o',
		   'ở'=>'o',
		   'ỡ'=>'o',
		   'ợ'=>'o',
		   
		   'Ơ'=>'O',
		   'Ớ'=>'O',
		   'Ờ'=>'O',
		   'Ở'=>'O',
		   'Ỡ'=>'O',
		   'Ợ'=>'O',
		   
		   'ú'=>'u',
		   'ù'=>'u',
		   'ủ'=>'u',
		   'ũ'=>'u',
		   'ụ'=>'u',
		   
		   'Ú'=>'U',
		   'Ù'=>'U',
		   'Ủ'=>'U',
		   'Ũ'=>'U',
		   'Ụ'=>'U',
		   
		   'ư'=>'u',
		   'ứ'=>'u',
		   'ừ'=>'u',
		   'ử'=>'u',
		   'ữ'=>'u',
		   'ự'=>'u',
		   
		   'Ư'=>'U',
		   'Ứ'=>'U',
		   'Ừ'=>'U',
		   'Ử'=>'U',
		   'Ữ'=>'U',
		   'Ự'=>'U',
		   
		   'í'=>'i',
		   'ì'=>'i',
		   'ỉ'=>'i',
		   'ĩ'=>'i',
		   'ị'=>'i',
		   'đ'=>'d',
		   
		   'Í'=>'I',
		   'Ì'=>'I',
		   'Ỉ'=>'I',
		   'Ĩ'=>'I',
		   'Ị'=>'I',
		   
		   'ý'=>'y',
		   'ỳ'=>'y',
		   'ỷ'=>'y',
		   'ỹ'=>'y',
		   'ỵ'=>'y',
		   
		   'Ý'=>'Y',
		   'Ỳ'=>'Y',
		   'Ỷ'=>'Y',
		   'Ỹ'=>'Y',
		   'Ỵ'=>'Y',
		   
		   'đ'=>'d',
		   'Đ'=>'D',
		   '“'=>'',
		   '”'=>'',
		   '"'=>'',
		   ','=>'',
		   '\''=>'',
			  
		   
		);
	  
	   $str = strtr($str, $str_convert);
		  $str= preg_replace("/[^[:alnum:]+ \-]/"," ",$str);
	   return '-'.preg_replace("/ +/", "-",$str);
	
	}
	
	function create_random_string($num) {
		//Tao du lieu cho hinh ngau nhien
		$chars = array( 'a', 'A', 'b', 'B', 'c', 'C', 'd', 'D', 'e', 'E', 'f', 'F', 'g', 'G', 'h', 'H', 'i', 'I', 'j', 'J',  'k', 'K', 'l', 'L', 'm', 'M', 'n', 'N', 'o', 'p', 'P', 'q', 'Q', 'r', 'R', 's', 'S', 't', 'T',  'u', 'U', 'v', 'V', 'w', 'W', 'x', 'X', 'y', 'Y', 'z', 'Z', 
						'1', '2', '3', '4', '5', '6', '7', '8', '9','~','!','@','#','$','%','&','?');
		$max_chars = count($chars) - 1;
		for($i = 0; $i < $num; $i++) {
		  $code = ( $i == 0 ) ? $chars[rand(0, $max_chars)] : $code . $chars[rand(0, $max_chars)];
		}
		return $code;
	}
	
	function logobottom()
  	{
	  include('./path/to/config/logo_config.php');
	  return $logo;
  	}
	
	function blocks($side, $name) {//160606
    
		$bl_l = array(); $bl_r = array(); $bl_c = array(); $bl_d = array(); $now = time();
		@include('./path/to/config/blist.php');
		
		$side = strtolower($side[0]);
		$block_side = $side;
		if (strtolower($side[0]) == "l") {
			$bl = $bl_l;
		} elseif (strtolower($side[0]) == "r") {
			$bl = $bl_r;
		}  elseif (strtolower($side[0]) == "c") {
			$bl = $bl_c;
		} elseif  (strtolower($side[0]) == "d") {
			$bl = $bl_d;
		}
	
		for($bli=0;$bli < sizeof($bl); $bli++) {
			if($bl[$bli]!="") {
			$bl_ar = explode("@",$bl[$bli]);
			$abl_ar=explode("|",$bl_ar[11]);
	
			if($bl_ar[13]=='1') {
			
				$bl_acc = 0;
				if ($bl_ar[7] == 0) { $bl_acc = 1; } 
				elseif ($bl_ar[7] == 1) { $bl_acc = 1; }
				elseif ($bl_ar[7] == 2) { $bl_acc = 1; }
				elseif ($bl_ar[7] == 3) { $bl_acc = 1; }
				
				if($bl_acc == 1 && (in_array($name,$abl_ar) || in_array("all",$abl_ar))) {
	
					if ($bl_ar[0] == 0) { $block_path = './application/frontend/views/block/'; } 
					$file = $block_path.$bl_ar[6];
					
					if (!file_exists($file)) { $content = ''; }
					else { $content = $bl_ar[6]; }
					
					//$content = html_entity_decode($content);
					///////////////////////////////headlines
					
					if ($content != "") {
						if ($side == "c") {
							themecenterbox($bl_ar[1], $content, $bl_ar[10]);//160606
						} elseif ($side == "d") {
							themecenterbox($bl_ar[1], $content, $bl_ar[10]);//160606
						} else {
							themesidebox($bl_ar[1], $content, $bl_ar[10]);//160606
						}
					}
				
				}
		}	
		}
		}
	}
	

	
	function themecenterbox($title, $content, $link) {
		
		$ci =& get_instance();
		$bl = preg_replace('/.php/','',$content);
		$ci->load->view('block/'.$bl);
		
	}
	
	function themesidebox($title, $content, $link) {

		$ci =& get_instance();
		$bl = preg_replace('/.php/','',$content);
		$ci->load->view('block/'.$bl);
		
	}