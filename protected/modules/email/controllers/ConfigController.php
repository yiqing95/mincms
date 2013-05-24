<?php namespace app\modules\email\controllers; 
use app\modules\email\models\Config; 
use app\core\Arr;
/**  
* @author Sun < taichiquan@outlook.com >
*/
class ConfigController extends \app\core\AuthController
{ 
 	function init(){
		parent::init();
		$this->active = array('system','email.config.index');
	}
	
	public function actionIndex()
	{   
		$a = array(array('s'=>2)); 
		$model = Config::find()->one();
		if(!$model)
	  		$model = new Config();
	 
	  	$model->scenario = 'all'; 
		if ($this->populate($_POST, $model) && $model->save()) {
		 	flash('success',__('mail settings success'));
		 	redirect(url('email/config/index'));
		} 
		echo $this->render('index',array('model'=>$model));
	 
	}
	 

	 
}
