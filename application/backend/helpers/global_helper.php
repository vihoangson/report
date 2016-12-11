<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function structure($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
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
  
function  draw_input($name,$values='',$width='100%',$height=380,$hidden=0)
{
		include_once(APPPATH."../../fckeditor/fckeditor.php") ;
		require_once(APPPATH."../../ckfinder/ckfinder.php");
		
		//$oFCKeditor->BasePath = BASEPATH."/fckeditor/"  ;
		$oFCKeditor = new FCKeditor($name) ;
		$oFCKeditor->IncludeLatinEntities = false ;
		$oFCKeditor->Config['SkinPath']="fckeditor/editor/skins/default/"; 
		$oFCKeditor->Config['ToolbarLocation'] = 'Out:xToolbar' ;
		$oFCKeditor->Width =$width;
		$oFCKeditor->Height=$height;
		$oFCKeditor->Value= stripslashes($values);
		$oFCKeditor->Config['ImageUpload'] = false;
		$oFCKeditor->config['filebrowserBrowseUrl']='';
		$oFCKeditor->config['filebrowserImageBrowseUrl']='';
		$oFCKeditor->config['filebrowserFlashBrowseUrl']='';
		
		
		CKFinder::SetupFCKeditor( $oFCKeditor, BASEPATH.'ckfinder/' ) ;
		$oFCKeditor->Create() ;
}

function FixQuotes ($what = "") {

	
	$what=preg_replace("/'/","\'",$what);

    while (preg_match("/\\\\'/", $what)) {

        $what = ereg_replace("\\\\'","'",$what);

    }

    return $what;

}

function blocks($side, $name) {//160606
    
    $bl_l = array(); $bl_r = array(); $bl_c = array(); $bl_d = array(); $now = time();
    @include('../path/to/config/blist.php');
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
			if($bl_acc == 1) {
				if ($bl_ar[0] == 0) { $block_path = '../application/frontend/views/block/'; } 
				$file = @file("".$block_path."".$bl_ar[6]."");
				if (!$file) { $content = 'Block no loading'; }
				
				///////////////////////////////headlines
				
				if ($bl_ar[0] != 0) {
					$content = html_entity_decode($content);
				}
				if ($content != "") {
					if ($side == "c") {
						themecenterbox($bl_ar[1], $content, $bl_ar[10]);//160606
					} elseif ($side == "d") {
						themecenterbox($bl_ar[1], $content, $bl_ar[10]);//160606
					} else {
						themesidebox($bl_ar[1], $content, $bl_ar[10]);//160606
					}
				}
				
				unset($content);
			
    		}
	}	
	}
    }
}

