<?php namespace app\modules\auth\controllers; 
use app\modules\auth\models\Access;
use app\core\Arr;
/**
* generate access lists
* 
* @author Sun < taichiquan@outlook.com >
*/
class AuthController extends \app\core\AuthController
{ 
	public function actionIndex()
	{ 	
	 	$dsn = \Yii::$app->db->dsn;
	 	$name = 'Tables_in_'.substr($dsn,strrpos($dsn,'dbname=')+7);  
		$tables = \Yii::$app->db->createCommand("SHOW TABLES")->queryAll();  
	    foreach($tables as $table){
	    	 $t = $table[$name];
	    	 $f = \Yii::$app->db->createCommand("SHOW COLUMNS FROM ".$t)->queryAll();  
	    	 unset($field);
	    	 foreach($f as $ff){
	    	 	$field[] = $ff['Field'];
	    	 }
	    	 $out[$t] = $field;
	    }
	   	Access::generate($out);
	    
	    $query = new \app\core\Query;
		$query->select('id, name,pid')
		      ->from('auth_access'); 
		$rows = $query->all();
		$rows = Arr::tree($rows);
 		dump($rows);
	    
	 
		echo $this->render('index');
	}

	 
}
