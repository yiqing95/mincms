<?php namespace app\modules\image\controllers; 
use app\core\FrontController;
use app\core\File;
use app\modules\image\libraries\Image;
/**
* 公共可访问控制器，自动生成图片需要的效果
*
* $sizes = Image::sizes('filename.gif'); 
// Returns
Object
(
    [width] => 500
    [height] => 400
)
*
*
* .htaccess
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

RewriteCond %{REQUEST_FILENAME} !\.(jpg|jpeg|png|gif)$
RewriteRule imagine/(.*)\.(jpg|jpeg|png|gif)$ /imagine/$1/$2 [NC,R,L]  


  

* @author Sun < mincms@outlook.com >
*/
class SiteController extends FrontController
{ 
	public $drive = 'Gd';// Gd  Imagick Gmagick
	public $obj;
	/**
	*
	/imagine/1=eyJyZXNpemUiOlszMDAsMjAwXX0=.jpg 
	*/
	public function actionIndex()
	{  
		$name = $_GET['name'];
		$ext = $_GET['ext'];
		$l = strpos($name,'='); 
		//生成新的文件名
		$new_name = root_path().'imagine/'.$name.'.'.$ext;
		//取得encode的数组
		$json = substr($name,$l+1);   
		$name = substr($name,0,$l); 
		$name = "upload/".$name; 
		$arr = explode('/',$name); 
		//完整文件名
		$file = $name.'.'.$ext;
		//文件所在路径 
		$file_path = root_path().$file; 
		if(!file_exists($file_path)){
			//如原文件不存在直接返回
			return;
		}
		//生成新文件所存在的路径 
		$new_dir = File::dir($new_name);
		if(!is_dir($new_dir)) mkdir($new_dir,0777,true); 
		$json = json_decode(base64_decode($json)); 
		//操作图片
		$imagine = Image::load($file_path);
 		foreach($json as $k=>$v){
			switch($k){
				case 'resize': 
					$imagine = $imagine->resize($v[0], $v[1], true, true);
					break;
				case 'crop': 
					//crop(20, 20, 180, 180);
					$imagine = $imagine->crop($v[0], $v[1], $v[3], $v[4]);
					break;
				case 'crop_resize':
					$imagine = $imagine->crop_resize($v[0], $v[1]);
					break;
				case 'rotate': 
					$imagine = $imagine->rotate($v);
					break;
				case 'flip':
					//vertical horizontal both
					$imagine = $imagine->flip($v);
					break;
				case 'watermark':
					/*
					* watermark('watermark.ext', "top left", 15);
					* watermark('watermark.ext', "bottom right");
					* watermark('watermark.ext', "center middle");
					*/
					$imagine = $imagine->watermark($v[0],$v[1],$v[2]);
					break;
				case 'border':
					//border(10, '#000000');
					$imagine = $imagine->border($v[0],$v[1]);
					break;	
				case 'mask':
					//mask('mask.ext');	
					$imagine = $imagine->mask($v);
					break;	
				case 'rounded':
					/*
					* rounded(10, "tl tr");
					* rounded(10, null, 0);
					* rounded(10);
					*/
					$imagine = $imagine->rounded($v[0],$v[1],$v[2]);
					break;	
				case 'grayscale':
					$imagine = $imagine->grayscale();
					break;
					
			}
		 
		} 
		//生成图片
    	$imagine->save($new_name);
    	echo file_get_contents($new_name);
	 	exit;
	} 
	 
}
