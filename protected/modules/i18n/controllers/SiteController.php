<?php namespace app\modules\i18n\controllers; 
use app\core\Dir;
/**
*   
* @author Sun < taichiquan@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('system','i18n.site.index');
	}
	public function actionIndex($id=null,$name=null)
	{ 
		$path = base_path().'messages';
		$list = scandir($path);
		foreach($list as $vo){   
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{  
				$dirs[$vo] = $vo;
				$li = scandir($path.'/'.$vo);
				foreach($li as $v){   
					if($v !="."&& $v !=".." && $v !=".svn" )
					{
						 $dir[$vo][] = $v;
					}
				}
			}
		} 
		if($id){
			$file = $path.'/'.$name.'/'.$id;
			$content = @include $file;
		 
		}
		if($_POST){
			$lan = $_POST['lan'];
			$key = $_POST['key'];
			$value = $_POST['value'];
			$write = $path.'/'.$lan.'/'.$id;
		 
			foreach($key as $k=>$v){
				if(trim($v) && trim($value[$k]))
					$out[trim($v)] = trim($value[$k]);
			}
			file_put_contents($write,"<?php \nreturn  ".var_export($out,true).";");
		 	flash('success',__('i18n file create success') . "# ".$name."/".$id);
		 	redirect(url('i18n/site/index'));
		}
		echo $this->render('index',array(
			'dirs'=>$dirs,
			'dir'=>$dir,
			'id'=>$id,
			'name'=>$name,
			'content'=>$content
		));
	}

	 
}
