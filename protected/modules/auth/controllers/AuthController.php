<?php namespace app\modules\auth\controllers; 
use app\modules\auth\models\Access;
use app\modules\auth\models\GroupAccess;
use app\core\Arr;
/**
* generate access lists
* 
* @author Sun < taichiquan@outlook.com >
*/
class AuthController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('auth');
	}
	/**
	* 用户组绑定权限
	*/
	public function actionIndex($id)
	{ 	
		$id = (int)$id;
		$model = \app\modules\auth\models\Group::find($id);
		foreach($model->access as $g){
			$access[] =  $g->access_id;
		} 
		$d = $this->_get_modules(); 
	   	Access::generate($d); 
	    $query = new \app\core\Query;
		$query->select('id, name,pid')
		      ->from('auth_access'); 
		$rows = $query->all();
		foreach($rows as $v){
			$out[$v['id']] = $v;
		}
		$rows = Arr::_tree_id($rows); 
 	 	if($_POST){
 	 		$auth = $_POST['auth'];
 	 		GroupAccess::saveAccess($id,$auth);
 	 		flash('success',__('set access success'));
 	 		redirect(url('auth/auth/index',array('id'=>$id))); 
 	 	}
		echo $this->render('index',array(
			'rows'=>$rows,
			'out'=>$out,
			'model'=>$model,
			'id'=>$id,
			'access'=>$access
		));
	}
	
	/**
	* get all controller as key ,actions as value
	*/
	protected function _get_modules(){
		$p = base_path().'modules/';
		$lists = \app\core\Dir::listFile($p,'controllers,.php'); 
		$dirs = $lists['dir'];   
		$i=0; 
		foreach($dirs as $dir){ 
			$key = substr($dir,0,-4); 
			$name = str_replace($p,'',$key);
			$module_name =  substr($name,0,strpos($name,'/'));   
			$class = ucfirst(substr($key,strrpos($key,'/')+1)); 
			$line = @file_get_contents($dir);  
			preg_match_all('/.*class.*extends(.*)/i',$line,$out);   
		 	 
			if(false!==strpos($out[1][0],'\app\core\AuthController')) { 
				 $new_dirs[$module_name.'.'.$class."##".$i] = $dir; 
				 $i++;
			}  		

		}  
		foreach($new_dirs as $k=>$dir){ 
			$lineNumber = 0; 
			$file = fopen($dir, 'r');
			while( feof($file)===false )
			{ 
				++$lineNumber;
				$line = fgets($file);
				preg_match('/public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/', $line, $matches);
				if( $matches!==array() )
				{
					$name = $matches[1];
					$k = str_replace('Controller','',$k);
					$k = strtolower($k);
					$actions[substr($k,0,strpos($k,'##'))][ strtolower($name) ] = array(
						'name'=>$name,
						'line'=>$lineNumber
					);
				
					
				}
			}
		} 
		return $actions; 
	}

	 
}
