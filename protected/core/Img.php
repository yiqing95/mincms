<?php namespace app\core;  
/**
*  image 
* 
* @author Sun < mincms@outlook.com >
* @date 2013
*/
class Img
{ 
 	function get_local_img($content,$all=false){ 
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i'; 
		preg_match_all($preg,$content,$out);
		$img = $out[2];
		if($img) { 
			$num = count($img); 
			for($j=0;$j<$num;$j++){ 
				$i = $img[$j]; 
				if( (strpos($i,"http://")!==false || strpos($i,"https://")!==false ) && strpos($i,URL::base())===false)
				{
					unset($img[$j]);
				}
			}
		}
		if($all === true){
			return $img;
		}
		return $img[0]; 
	} 
	function preg_img($content){
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i'; 
		preg_match_all($preg,$content,$out);
		unset($out[1]);
		$out = array_merge($out,array());
		return $out;
	}
	function get_img($content,$all=false){ 
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i'; 
		preg_match_all($preg,$content,$out);
		$img = $out[2];  
		if($all === true){
			return $img;
		}
		return $img[0]; 
	} 
	function remove_img($content,$all=false){  
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';
		$out = preg_replace($preg,"",$content);
		return $out;
	} 
	function img_wh($img){
		$a = getimagesize(root_path().$img);
		return array('w'=>$a[0],'h'=>$a[1]);
	}
 
}