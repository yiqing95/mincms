<?php namespace app\modules\content\models; 

use yii\helpers\Html;
class Widget extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'content_widget';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('field_id','name','memo'),
		   
		 );
	}
	public function rules()
	{ 
		return array(
			array('field_id, name', 'required'),  
		);
	} 
	 
 
	 
}