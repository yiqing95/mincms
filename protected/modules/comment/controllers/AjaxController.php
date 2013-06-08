<?php namespace app\modules\comment\controllers; 
use app\core\FrontController;
use app\core\DB;
/**
*   
* 
* @author Sun < mincms@outlook.com >
*/
class AjaxController extends FrontController
{ 
	function init(){
		parent::init();
	 	$this->layout = false;
	}  
	public function actionIndex()
	{     
		$data['formId'] = $_POST['formId'];
		$data['slug'] = $_POST['slug'];  
		if(!$data['slug'] || !$data['formId']) exit;
		echo $this->render('index',$data);
	}

	 
}
