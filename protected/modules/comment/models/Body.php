<?php namespace app\modules\comment\models; 
use yii\helpers\Html;
 
class Body extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'comment_body';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('body'),
		   
		 );
	}
	public function rules()
	{ 
		return array( 
			array('body','required'),
			array('body','unique')
		);
	} 
 
	 
	 
}