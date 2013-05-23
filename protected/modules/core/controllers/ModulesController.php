<?php namespace app\modules\core\controllers; 
use app\modules\core\models\Modules;
/**  
* @author Sun < taichiquan@outlook.com >
*/
class ModulesController extends \app\core\AuthController
{ 
	public $_base;
	/**
	* 内核主要模块，不能改动。
	*/
	protected $_core_modules = array(
		'core', 'auth',
	);
	function init(){ 
		parent::init();
		$this->_base = base_path().'modules/';
		foreach($this->_core_modules as $m){
			$load = Modules::find()->where(array('name'=>$m))->one();
			if($load) continue;
			$this->load_module($m,true);
		}
	}
	
	public function actionIndex()
	{  
		 
		widget('uisort',array(
		 	'tag'=>'.drag',
	        'table'=>'modules', // database table name,must params
	        'stop'=>"$.get('".url('admin/admin/menu')."',function(data){ 
	     			$('#menu').html(data);
	     	 });
	     	"
	    ));
	    if($_POST['uisort_widget_ajax'] != 'uisort_modules'){ 
			$base = $this->_base;
			$models = Modules::find()->where(array('active'=>1))->orderBy('core asc,sort desc,id asc')->all();
			if($models){
				foreach($models as $model){
					$name = $model->name;
					$array[$name]['name'] = $name;
					$array[$name]['active'] = $model->active;
					$array[$name]['core'] = $model->core;
					$array[$name]['path'] = $base.$name;
					$array[$name]['info'] = @include $base.$name.'/info.php';
				}
			} 
			foreach (glob($base.'*') as $v)
			{
				$a = '/controllers';
				$name = str_replace($base,'',$v); 
				if(!is_dir($v)) continue; 
				$data[$name]['default'] = false;
				if(file_exists($v.'/lock')){ 
					unset($data[$name]);
					continue;
				} 
				$data[$name]['name'] = $name;
				$data[$name]['path'] = $v;
				$data[$name]['info'] = @include $v.'/info.php';
				if($array[$name]){
					unset($data[$name]); 
				} 
				$file[$name] = $name;
			}  
			if($array){
				foreach($array as $k=>$v){
					if(!in_array($k,$file)){ 
						$m = Modules::find(array('name'=>$k));
						$m->delete();
						unset($array[$k]);
					}
				}
			}
			if($array){ 
	 			$data = array_merge($data,$array); 
	 		} 
	 		  
			echo $this->render('index',array('data'=>$data,'models'=>$models,'_core_modules'=>$this->_core_modules));
		}
	}
	protected function load_module($id,$flag=false){ 
		$active = 1;
		$model = Modules::find(array('name'=>$id));
		if($model){
			if($model->active == 1)
				$active = 0;
		}
		else{
			$model = new Modules; 
	 	}
	 	$model->core = $flag;
	 	if(true === $flag) $active = 1;
		$info =  @include base_path().'modules/'.$id.'/info.php'; 
		 
		$classes = base_path().'modules/'.$id.'/class.php';  
		$model->name = $id;
		$model->label = $info['label']; 
		$model->memo = $info['memo'];
		$model->active = $active; 
		if($model->save()){
			if($active==1){
				 
			}
			 
		}
	}
	public function actionAdd(){ 
		$id = $_POST['id']; 
		$this->load_module($id);
		echo 1;
		exit;
	}
	/**
	* 安装数据库
	*/ 
	public function actionInstall($id){
		 
		
	}

	 
}
